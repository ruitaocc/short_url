<?php
/*function daoAutoloader($class) {
    include '../dao/' . $class . '.class.php';
}
function domainAutoloader($class) {
    include '../domain/' . $class . '.class.php';
}
function exceptionAutoloader($class) {
    include '../exception/' . $class . '.class.php';
}
function libAutoloader($class) {
    include '../lib/' . $class . '.class.php';
}
function managerAutoloader($class) {
    include '../manager/' . $class . '.class.php';
}
function resultAutoloader($class) {
    include '../result/' . $class . '.class.php';
}
function serviceAutoloader($class) {
    include '../service/' . $class . '.class.php';
}
function utilAutoloader($class) {
    include '../util/' . $class . '.class.php';
}
spl_autoload_register('daoAutoloader');
spl_autoload_register('domainAutoloader');
spl_autoload_register('exceptionAutoloader');
spl_autoload_register('libAutoloader');
spl_autoload_register('managerAutoloader');
spl_autoload_register('resultAutoloader');
spl_autoload_register('serviceAutoloader');
spl_autoload_register('utilAutoloader');*/

function __autoload($class) {
	$file = '';
	if (strrchr($class, 'Dao') === 'Dao') {
	    $file = "../dao/". $class .".php";
	} elseif (strrchr($class, 'Do') === 'Do') {
	    $file = "../domain/". $class .".php";
	} elseif (strrchr($class, 'Exception') === 'Exception') {
		$file = "../exception/". $class .".php";
	} elseif (strrchr($class, 'Manager') === 'Manager') {
		$file = "../manager/". $class .".php";
	} elseif (strrchr($class, 'Result') === 'Result') {
		$file = "../result/". $class .".php";
	} elseif (strrchr($class, 'Service') === 'Service') {
		$file = "../service/". $class .".php";
	} elseif (strrchr($class, 'Util') === 'Util') {
		$file = "../util/". $class .".php";
	} else {
		$file = "../lib/". $class .".php";
	}
	include_once($file);
}

date_default_timezone_set('PRC');




$result = new JsonResult();

$params = array(
	'tm' => $_POST['tm'],
	'uuid' => $_POST['uuid'],
	'url' => $_POST['url'],
	'sign' => $_POST['sign']
);

// 参数校验
foreach ($params as $key => $param) {
	if (empty($param)) {
		$result->setCode(Result::PARAM_ERROR_CODE);
		$result->setParamErrorMessage($key);
		exit($result);
	}
}

// 签名校验
$authParams = array(
	'tm' => $_POST['tm'],
	'uuid' => $_POST['uuid']
);
if (!AuthUtil::api($authParams, $params['sign'])) {
	$result->setCode(Result::SIGN_ERROR_CODE);
	exit($result);
}

// 生成短链
$shortUrlService = new ShortUrlService();
$shortUrl = $shortUrlService->submitUrl($_POST['url'], $_POST['uuid']);
if ($shortUrl === FALSE) {
	$result->setCode(Result::SYSTEM_ERROR_CODE);
	exit($result);
}

// 返回短链
$shortUrlResult = new stdClass;
$shortUrlResult->shortUrl = $shortUrl;
$result->setData($shortUrlResult);
exit($result);
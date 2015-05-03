<?php

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
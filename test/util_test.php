<?php
require_once('../code/util/UrlUtil.php');

$urlUtil = new UrlUtil();
var_dump($urlUtil->shorten('https://www.sina.com'));
var_dump($urlUtil->isValid('https://www.baidu.com'));
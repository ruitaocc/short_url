<?php
require_once('../code/domain/UrlDo.php');

$urlDo = new UrlDo();
$urlDo->setUrl('http://www.baidu.com');

var_dump($urlDo->attrs());
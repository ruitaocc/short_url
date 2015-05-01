<?php
/**
 * 长链接操作
 * 
 **/
class UrlManager extends CommonManager {

	private $urlDao;

	public function __construct() {
		parent::__construct();

		$this->urlDao = new UrlDao();
	}
}
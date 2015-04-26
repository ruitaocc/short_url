<?php
/**
 * 短链业务逻辑
 * 
 **/
class ShortUrlService extends CommonService {

	private $urlManager;

	public function __construct() {
		parent::__construct();
		$this->urlManager = new UrlManager();
	}

	/**
	 * 提交 URL
	 * 
	 * @param string $url
	 * @return short url if submit success, or else FALSE
	 * 
	 **/
	public function submitUrl($url, $uuid) {
		// 参数校验
		$url = trim($url);
		$uuid = trim($uuid);
		if (empty($url) || empty($uuid)) {
			return FALSE;
		}

		// 检查是否已经有该链接对应的短链，如果有则直接返回
		// TODO


		// 生成短链标识
		$signs = array();
		$signs = UrlUtil::shorten($url);
		if (!$signs) {
			return FALSE;
		}

		foreach ($signs as $sign) {
			if ($this->urlManager->submitUrl($url, $uuid, $sign)) {
				// TODO return short url
			}
		}

		return FALSE;
	}

	/**
	 * 提交文本内容
	 * 
	 * @param string $message
	 * @return short url if submit success, or else FALSE
	 * 
	 **/
	public function submitMessage($message) {
		
	}
}
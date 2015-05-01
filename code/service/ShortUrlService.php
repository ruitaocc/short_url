<?php
/**
 * 短链业务逻辑
 * 
 **/
class ShortUrlService extends CommonService {

	private $urlDao;

	public function __construct() {
		parent::__construct();
		$this->urlDao = new UrlDao();
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
		$urlDo = new UrlDo();
		$urlDo->setUrl($url);
		$urlDo = $this->urlDao->find($urlDo);
		if ($urlDo) {
			return $urlDo->getSign();
		}


		// 生成短链标识
		$signs = array();
		$signs = UrlUtil::shorten($url);
		if (!$signs) {
			return FALSE;
		}

		foreach ($signs as $sign) {
			if ($this->urlDao->add($url, $uuid, $sign)) {
				return $sign;
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
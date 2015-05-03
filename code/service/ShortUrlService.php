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
		$urlDos = $this->urlDao->find($urlDo);
		if (!empty($urlDos) && is_array($urlDos)) {
			$urlDo = $urlDos[0];
			return $urlDo->getSign();
		}


		// 生成短链标识
		$signs = array();
		$signs = UrlUtil::shorten($url);
		if (!$signs) {
			return FALSE;
		}

		$urlDo = new UrlDo();
		$urlDo->setUrl($url);
		$urlDo->setUuid($uuid);
		$urlDo->setCreateTime(date('Y-m-d H:i:s'));

		foreach ($signs as $sign) {
			$urlDo->setSign($sign);
			if ($this->urlDao->add($urlDo)) {
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
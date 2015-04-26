<?php
/**
 * 长链接操作
 * 
 **/
class UrlManager extends CommonManager {

	private $urlDao;
	private $indexDao;

	public function __construct() {
		parent::__construct();

		$this->urlDao = new UrlDao();
		$this->indexDao = new ShortUrlIndexDao();
	}

	/**
	 * 提交 URL
	 * 
	 * @param string $url
	 * @param string $uuid
	 * @param string $sign
	 * @return BOOL TRUE if success, or else return FALSE
	 * 
	 **/
	public function submitUrl($url, $uuid, $sign) {
		// 事务
		CommonDao::beginTransaction();
		// 提交 url 内容
		$urlDo = new UrlDo();
		$urlDo->setUrl($url);
		$urlDo->setUuid($uuid);
		$urlDo->setCreateTime(time());
		$id = $this->urlDao->add($urlDo);

		if ($id === FALSE) {
			CommonDao::rollback();
			return FALSE;
		}

		// 更新索引
		$index = new ShortUrlIndexDo();
		$index->setSign($sign);
		$index->setContentId($id);
		$index->setType(ShortUrlIndexDo::URL);
		if (!$this->indexDao->add($index)) {
			CommonDao::rollback();
			return FALSE;
		}

		// 提交事务
		CommonDao::commit();
		return TRUE;
	}
}
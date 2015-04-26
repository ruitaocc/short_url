<?php
class UrlDo {

	private $id;
	private $uuid;
	private $url;
	private $createTime;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getUuid() {
		return $this->uuid;
	}

	public function setUuid($uuid) {
		$this->uuid = $uuid;
	}

	public function getUrl() {
		return $this->url;
	}

	public function setUrl($url) {
		$this->url = $url;
	}

	public function getCreateTime() {
		return $this->createTime;
	}

	public function setCreateTime($createTime) {
		$this->createTime = $createTime;
	}
}
<?php
class UrlDo {

	private $id;
	private $uuid;
	private $url;
	private $hash;
	private $sign;
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
		$this->setHash(md5($url));
	}

	public function getHash() {
		return $this->hash;
	}

	public function setHash($hash) {
		$this->hash = $hash;
	}

	public function getSign() {
		return $this->sign;
	}

	public function setSign($sign) {
		$this->sign = $sign;
	}

	public function getCreateTime() {
		return $this->createTime;
	}

	public function setCreateTime($createTime) {
		$this->createTime = $createTime;
	}

	public function attrs() {
		return get_object_vars($this);
	}
}
<?php
class ShortUrlIndexDo {

	private $id;
	private $sign;
	private $contentId;
	private $type;

	// 可接受类型
	const MESSAGE = 1;
	const URL = 2;
	const IMAGE = 3;
	const VCARD = 4;

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getSign() {
		return $this->sign;
	}

	public function setSign($sign) {
		$this->sign = $sign;
	}

	public function getContentId() {
		return $this->contentId;
	}

	public function setContentId($contentId) {
		$this->contentId = $contentId;
	}

	public function getType() {
		return $this->type;
	}

	public function setType($type) {
		$this->type = $type;
	}
}
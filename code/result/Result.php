<?php
class Result {
	
	// 成功状态码
	const SUCCESS_CODE = 0;
	// 参数错误状态码
	const PARAM_ERROR_CODE = 100;
	// 签名错误状态码
	const SIGN_ERROR_CODE = 200;
	// 系统异常状态码
	const SYSTEM_ERROR_CODE = 300;

	protected $code;
	protected $message;
	protected $data;

	public function __construct() {
	}

	public function setCode($code) {
		$this->code = $code;
		if ($this->code === self::SIGN_ERROR_CODE && empty($this->message)) {
			$this->setSignErrorMessage();
		}
		if ($this->code === self::SYSTEM_ERROR_CODE && empty($this->message)) {
			$this->setSystemErrorMessage();
		}
	}

	public function getCode() {
		return $this->code;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public function getMessage() {
		return $this->message;
	}

	public function setData($data) {
		$this->data = $data;
	}

	public function getData() {
		return $this->data;
	}

	public function setParamErrorMessage($paramName) {
		$this->setMessage(sprintf('param(%s) invalid', $paramName));
	}

	public function setSignErrorMessage() {
		$this->setMessage('sign invalid');
	}

	public function setSystemErrorMessage() {
		$this->setMessage('system error');
	}
}
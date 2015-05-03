<?php
/**
 * 返回 Json 格式的结果
 * 
 **/
class JsonResult extends Result {

	public function __toString() {
		$result = new stdClass;
		$result->code = empty($this->code) ? self::SUCCESS_CODE : $this->code;
		$result->message = empty($this->message) ? 'ok' : $this->message;
		$result->data = empty($this->data) ? new stdClass : $this->data;
		return json_encode($result);
	}
}
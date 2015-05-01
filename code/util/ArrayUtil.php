<?php
class ArrayUtil {

	/**
	 * 将关联数组转为字符串
	 * 
	 * @param string $keyGlue
	 * @param string $valueGlue
	 * @param array $pieces
	 * @return mixed 如果 $pieces 不是 array，返回FALSE，否则返回格式化后的字符串
	 * @example $keyGlue='=' $valueGlue='&' 
	 * $pieces=array('key1'=>'value1','key2'=>'value2'),return 'key1=value1&key2=value2'
	 * 
	 **/
	public static function implode($keyGlue, $valueGlue, $pieces) {
		if (!is_array($pieces)) {
			return FALSE;
		}
		$arr = array();
		foreach ($pieces as $key => $value) {
			$arr[] = $key . $keyGlue . $value;
		}
		return implode($valueGlue, $arr);
	}
}
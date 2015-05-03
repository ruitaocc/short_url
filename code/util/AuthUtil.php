<?php
/**
 * 安全验证类
 * 
 **/
class AuthUtil {

	private static $secretKey = 'C10-705';

	/**
	 * API 签名校验
	 * 
	 * @param array $params 参数
	 * @param string $sign 签名
	 * @return bool 校验通过，返回 TRUE，否则返回 FALSE 
	 * 
	 **/
	public static function api($params, $sign) {
		if (empty($sign) || empty($params)) {
			return FALSE;
		}
		
		$params['secretKey'] = self::$secretKey;

		ksort($params);
		$str = '';
		foreach ($params as $param) {
			$str .= $param;
		}
		return md5($str) === $sign;
	}

}
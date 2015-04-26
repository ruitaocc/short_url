<?php
/**
 * url util
 * 
 **/
class UrlUtil {

	/**
	 * shorten a url
	 * 
	 * @param string $url
	 * @return mixed BOOL FALSE if url is invalid, or elase return 
	 * an array of 4 elements that can used as unique code for the url
	 * 
	 **/
	public static function shorten($url) {

		if (!self::isValid($url)) {
			return FALSE;
		}

		$secretKey = 'C10-705';
		$base32 = array (
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
			'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
			'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
			'y', 'z', '0', '1', '2', '3', '4', '5'
		);
		$hex = md5($secretKey.$url);
		$hexLen = strlen($hex);
		$subHexLen = $hexLen / 8;
		$output = array();

		for ($i = 0; $i < $subHexLen; $i++) {
			$subHex = substr ($hex, $i * 8, 8);
			$int = 0x3FFFFFFF & (1 * ('0x'.$subHex));
			$out = '';

			for ($j = 0; $j < 6; $j++) {
				$val = 0x0000001F & $int;
				$out .= $base32[$val];
				$int = $int >> 5;
			}

			$output[] = $out;
		}
		return $output;
	}

	/**
	 * check the validity of the url
	 * 
	 * @param string $url
	 * @return BOOL TRUE if the url is valid, or else return FALSE
	 * 
	 **/
	public static function isValid($url) {
		if (empty($url)) {
			return FALSE;
		}
		if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
			return FALSE;
		}
	    if (filter_var($url, FILTER_VALIDATE_URL)) {
	        return TRUE;
	    }
	    return FALSE;
	}
}
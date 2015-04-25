<?php
/**
 * 封装 MySQL 操作
 * 
 **/
class MysqlWrapper {

	private $host;
	private $port;
	private $username;
	private $password;
	private $db;
	private $charset;

	private $_mysqli;

	/**
	 * instance of self
	 * 
	 **/
	private static $_instance;

	/**
	 * singleton 
	 *
	 **/
	private function __construct() {
		$this->host = '127.0.0.1';
		$this->port = '3306';
		$this->username = 'chencg';
		$this->password = '123456';
		$this->db = 'qr_code';
		$this->charset = 'UTF-8';

		$this->_mysqli = new mysqli($this->host, $this->username, $this->password, $this->db, $this->port);

		if (mysqli_connect_errno()) {
			// TODO log:mysqli_connect_error(); throw expection and die
		}
		$this->_mysqli->set_charset($this->charset);
	}

	/**
	 * return the instance
	 * 
	 */
	public static function getInstance() {
		if (!isset(self::$_instance)) {
			self::$_instance = new MysqlWrapper();
		}
		return self::$_instance;
	}

	/**
	 * temporary
	 * 
	 **/
	public function __call($method, array $args) {
		return call_user_func_array(array($this->_mysqli), $args);
	}
}
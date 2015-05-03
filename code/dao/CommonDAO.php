<?php
/**
 * 封装数据库通用操作
 * 
 **/
class CommonDao {

	protected $mysqli;

	protected function __construct() {
		$this->mysqli = MysqlWrapper::getInstance();
	}

	/**
	 * 开始事务
	 * 
	 **/
	public static function beginTransaction() {

	}

	/**
	 * 提交事务
	 * 
	 **/
	public static function commit() {
		
	}

	/**
	 * 回滚事务
	 * 
	 **/
	public static function rollback() {

	}
}
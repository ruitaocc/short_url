<?php
/**
 * 封装数据库通用操作
 * 
 **/
class CommonDao {

	protected $mysql;

	protected function __construct() {
		$this->mysql = MysqlWrapper::getInstance();
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
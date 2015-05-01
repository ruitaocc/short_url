<?php
/**
 * 封装 url 表数据库操作
 * 
 **/
class UrlDao extends CommonDao {

	private static $sqlMap = array (
		'id' => 'id', 
		'uuid' => 'uuid', 
		'url' => 'url', 
		'hash' => 'hash', 
		'sign' => 'sign', 
		'createTime' => 'create_time'
	);

	/**
	 * 增加一条 url 记录
	 * 
	 * @param UrlDo $urlDo
	 * @return mixed 增加成功，返回int类型的id，否则返回 FALSE
	 * 
	 **/
	public function add(UrlDo $urlDo) {
	}

	/**
	 * 按条件查找
	 * 
	 * @param UrlDo $urlDo
	 * @return 查找到返回该记录的对象，否则返回FALSE
	 * 
	 **/
	public function find(UrlDo $urlDo) {
		$sql = 'SELECT 
					`id`, `uuid`, `url`, `hash`, `sign`, `create_time`
				FROM 
					`url`
				WHERE %s';
		$where = array();
		foreach ($urlDo->attrs() as $attrName => $attrValue) {
			if (!is_null($attrValue)) {
				$where[self::$sqlMap[$attrName]] = $attrValue;
			}
		}
		$where = ArrayUtil.implode(' = ', ' and ', $where);
		$sql = sprintf($sql, $where);
		$result = $this->mysql->query($sql);
		
		$urlDos = array();
		for ($i = 0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_assoc();
			$urlDo = new urlDo();
			$urlDo->setId($row['id']);
			$urlDo->setUuid($row['uuid']);
			$urlDo->setUrl($row['url']);
			$urlDo->setHash($row['hash']);
			$urlDo->setSign($row['sign']);
			$urlDo->setCreateTime($row['create_time']);
			$urlDos[] = $urlDo;
		}
		return $urlDos;
		
	}
}
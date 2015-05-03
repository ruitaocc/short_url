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

	public function __construct() {
		parent::__construct();
	}

	/**
	 * 增加一条 url 记录
	 * 
	 * @param UrlDo $urlDo
	 * @return mixed 增加成功，返回int类型的id，否则返回 FALSE
	 * 
	 **/
	public function add(UrlDo $urlDo) {
		$sql = 'INSERT INTO `url` (
				`uuid`, `url`, `hash`, `sign`, `create_time`
			) VALUES (
				?, ?, ?, ?, ?
			)';
		$stmt = $this->mysqli->prepare($sql);
		$uuid = $urlDo->getUuid();
		$url = $urlDo->getUrl();
		$hash = $urlDo->getHash();
		$sign = $urlDo->getSign();
		$createTime = $urlDo->getCreateTime();
		$stmt->bind_param('sssss', $uuid, $url, $hash, $sign, $createTime);
		$result = FALSE;
		if ($stmt->execute()) {
			$result = $this->mysqli->insert_id;
		}
		$stmt->close();
		return $result;
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
				// TODO 不是所有的值都是字符串
				$where[self::$sqlMap[$attrName]] = sprintf('"%s"', $attrValue);
			}
		}
		$where = ArrayUtil::implode(' = ', ' and ', $where);
		$sql = sprintf($sql, $where);
		$result = $this->mysqli->query($sql);
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
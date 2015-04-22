#DB#

##short_url_index##

###表结构###

| 字段         	| 类型         	| NULL		| Default	| Extra			| Primary	| 描述										|
|:-------------:|:-------------:| -----					|
| id      		| int 			| NOT NULL 	| 			| AUTO_INCREMENT| YES		| ID										|
| sign			| varchar(6)	| NOT NULL	| 			|				|			| 短链标识									|
| content_id	| int			| NOT NULL	| 			|				|			| 关联内容的ID								|
| type			| tinyint		| NOT NULL	|			|				|			| 内容类型，1-普通文本，2-长链接，3-图片，4-vcard|

###SQL###

	CREATE TABLE `short_url_index`(
		`id` INT NOT NULL AUTO_INCREMENT COMMENT "ID",
		`sign` VARCHAR(6) NOT NULL COMMENT "短链标识",
		`content_id` INT NOT NULL COMMENT "关联内容的ID",
		`type` TINYINT NOT NULL COMMENT "内容类型，1-普通文本，2-长链接，3-图片，4-vcard",
		CONSTRAINT `PRIMARY` PRIMARY KEY (`id`),
  		INDEX `short_url_index` (`sign`) USING BTREE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短链索引表'

##message##

| 字段         	| 类型         	| NULL		| Default	| Extra			| Primary	| 描述		|
|:-------------:|:-------------:| -----					|
| id      		| int 			| NOT NULL 	| 			| AUTO_INCREMENT| YES		| ID		|
| uuid		   	| char(40)		| NOT NULL 	|			| 				| 			| 客户端标识	|
| stext      	| varchar(1024) | NOT NULL  | ""   		|  				|			| 文本内容	|
| create_time	| datetime		| NOT NULL	|			|				|			| 内容创建时间|

###SQL###

	CREATE TABLE `message`(
		`id` INT NOT NULL AUTO_INCREMENT COMMENT "ID",
		`uuid` CHAR(40) NOT NULL COMMENT "客户端标识",
		`stext` VARCHAR(1024) NOT NULL DEFAULT "" COMMENT "文本内容",
		`sign` VARCHAR(6) NOT NULL COMMENT "短链标识",
		`create_time` DATETIME NOT NULL COMMENT "内容创建时间",
		CONSTRAINT `PRIMARY` PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文本表'

##image##

| 字段         	| 类型         	| NULL		| Default	| Extra			| Primary	| 描述		|
|:-------------:|:-------------:| -----					|
| id      		| int 			| NOT NULL 	| 			| AUTO_INCREMENT| YES		| ID		|
| uuid		   	| char(40)		| NOT NULL 	|			| 				| 			| 客户端标识	|
| img_path		| varchar(64)	| NOT NULL	| ""		|				|			| 图片路径	|
| create_time	| datetime		| NOT NULL	|			|				|			| 内容创建时间|

###SQL###

	CREATE TABLE `image`(
		`id` INT NOT NULL AUTO_INCREMENT COMMENT "ID",
		`uuid` CHAR(40) NOT NULL COMMENT "客户端标识",
		`img_path` VARCHAR(64) NOT NULL DEFAULT "" COMMENT "图片路径",
		`create_time` DATETIME NOT NULL COMMENT "内容创建时间",
		CONSTRAINT `PRIMARY` PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片表'

##url##

| 字段         	| 类型         	| NULL		| Default	| Extra			| Primary	| 描述		|
|:-------------:|:-------------:| -----					|
| id      		| int 			| NOT NULL 	| 			| AUTO_INCREMENT| YES		| ID		|
| uuid		   	| char(40)		| NOT NULL 	|			| 				| 			| 客户端标识	|
| url 			| varchar(65535)| NOT NULL	| ""		|  				|			| 长链接		|
| create_time	| datetime		| NOT NULL	|			|				|			| 内容创建时间|

###SQL###

	CREATE TABLE `url`(
		`id` INT NOT NULL AUTO_INCREMENT COMMENT "ID",
		`uuid` CHAR(40) NOT NULL COMMENT "客户端标识",
		`url` VARCHAR(65535) NOT NULL DEFAULT "" COMMENT "长链接",
		`create_time` DATETIME NOT NULL COMMENT "内容创建时间",
		CONSTRAINT `PRIMARY` PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='长链表'

##vcard | TODO ##

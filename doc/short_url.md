#POST /short_url#

##描述##

提交内容，生成对应的短链


##参数##

| 参数         	| 类型         	| 必传	| 描述  					|
|:-------------:|:-------------:|:-----:| ---------------------	|
| uuid      	| String 		| 是		| 客户端标识 				|
| message		| String 		| 否		| 文本				 	|
| url			| String		| 否		| 长链接					|
| vcard			| String		| 否		| vcard					|
| img			| File			| 否		| 图片文件				|
| tm      		| Int       	| 是		| 当前UNIX 时间戳 		|
| sign 			| String      	| 是		| 签名 					|

PS：内容优先级：message > url > vcard > img，必传其一，传多个值时只取优先级最高的值存储


##响应##

	{
		"code": 0,									// 状态码，0表示成功，其他状态码见表格
		"message": "OK",							// 状态具体信息
		"data":{
			"shortUrl": "http://2vma.co/AD82F1"	// 短链地址
		}
	}

##sign（签名）生成规则##
sign = md5（secretKey + tm + uuid）,secretKey为秘钥，找阿迪拿。

##状态码定义##

| 状态码         | 意义         	|
|:-------------:|:-------------:|
| 0		      	| 操作成功 		|
| 100		    | 参数错误 		|
| 200		    | 签名错误 		|
| 300		    | 系统异常 		|
#POST /short_url#

##描述##

提交内容，生成对应的短链


##参数##

| 参数         	| 类型         	| 描述  					|
|:-------------:|:-------------:| -----					|
| uuid      	| String 		| 客户端标识 				|
| text		   	| String 		| 文本				 	|
| url			| String		| 长链接					|
| img			| File			| 图片文件				|
| tm      		| Int       	| UNIX 时间戳 			|
| sign 			| String      	| 签名 					|


##响应##

	{
		"success": true,
		"message": "OK",
		"data":{
			"short_url": "http://2vma.co/AD82F1"
		}
	}

##sign（签名）生成规则##
sign = md5（secretKey + tm + uuid）,secretKey为秘钥，找阿迪拿。
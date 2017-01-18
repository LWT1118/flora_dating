<?php
return array(
	//'配置项'=>'配置值'
	// 添加数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '127.0.0.1', // 服务器地址
	'DB_NAME'   => 'flora_dating', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => 'root', // 密码
	'DATA_CACHE_TABLE'=>'wjw_date_cache',
	'DATA_CACHE_TIME'=>1800,


	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'wjw_', // 数据库表前缀
	'URL_MODEL'=>2,				//URL模式
	/**
	*	URL访问模式支持 0 (普通模式); 
	*	1 (PATHINFO 模式); 
	*	2 (REWRITE 模式);
	*	3 (兼容模式)	
	 */
	'URL_HTML_SUFFIX'=>'',//URL伪静态后缀设置
	'LOG_RECORD'=>false, // 开启日志记录
	'LOG_LEVEL'=>'INFO',

	//'SHOW_PAGE_TRACE' =>true, //开启页面输出调试

	'APP_GROUP_LIST'=>'Mobile,Home,Admin', //项目分组设定
	'DEFAULT_GROUP'=>'Home',//默认访问分组
	'APP_GROUP_MODE'=>1,//开启独立分组
	'APP_GROUP_PATH'=>'Modules',//独立分组文件夹
	'TMPL_FILE_DEPR'=>'_',//模板文件模块与操作之间的分割符，只对项目分组部署有效，默认为 '/'

	"CITY"				=>	"南昌市",
	"SIGN_SCORE_PRIZE"	=>	5,

	"INCOME" => array(
		0 => "保密",
		1 => "低于3k",
		2 => "3k-6k",
		3 => "6k-1w",
		4 => "1w-2w",
		5 => "2w及以上"
	),
	"EDU" => array(
		0 => "保密",
		1 => "高中及以下",
		2 => "大专",
		3 => "本科",
		4 => "硕士",
		5 => "研究生及以上"
	),
	"LOVE" => array(
		0 => "保密",
		1 => "单身",
		2 => "有稳定伴侣",
		3 => "已婚",
		4 => "离异",
		5 => "丧偶"
	),


	/*RBAC配置项*/

	'ADMIN_AUTH_KEY' => 'superadmin',			//超级管理员识别字符
	'RBAC_SUPERADMIN' => 'flora',				//超级管理员账号
	'USER_AUTH_ON' => true,						//是否需要认证
	'USER_AUTH_TYPE' => 1,						//认证类型 1为登录认证 2为实时认证
	'USER_AUTH_KEY' => 'id',					//认证识别号

	'RBAC_ROLE_TABLE' => 'wjw_role',			//角色表名称
	'RBAC_USER_TABLE' => 'wjw_role_user',		//用户角色中间表名称
	'RBAC_ACCESS_TABLE' => 'wjw_access',		//权限表名称
	'RBAC_NODE_TABLE' => 'wjw_node',			//节点表名称

	'NOT_AUTH_MODULE' => 'Mobile',					//无需验证的控制器
	'NOT_AUTH_ACTION' => 'Index',					//无需验证的方法
    'DEFAULT_TIMEZONE'=>'Europe/Berlin'
);
?>

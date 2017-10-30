<?php
return array(
    //独立分组配置
    'APP_GROUP_LIST' => 'Index,Teacher,Student,Admin',
	'DEFAULT_GROUP'  => 'Index',
	'APP_GROUP_MODE' =>1,
	'APP_GROUP_PATH' =>'Modules',

	//数据库配置
	'DB_HOST' => '127.0.0.1',
	'DB_USER' => 'root',
	'DB_PWD' => '',
	'DB_NAME' => 'xsgl',
	'DB_PREFIX' => 'xh_',
	'DB_CHARSET'=>'utf8',
	
    //加载verify.php配置文件（配置验证码）
    'LOAD_EXT_CONFIG' => 'verify',

    'SHOW_PAGE_TRACE' =>true,
    
    //点语法：只让其解析数组
    //'TMPL_VAR_IDENTIFY' => 'array',
	//模板路径以下划线连接：控制器_方法名.html
	//'TMPL_FILE_DEPR' => '_',

	//Apache配置：1、要开启mod_rewrite.so , 2、AllowOverride All 。 在本网站根目录下生成.htaccess。然后配置下面一项
    'URL_MODEL'=>1,   //1为标准默认模式，即地址里面含有入口文件，2为去掉了入口文件。0为普通模式，即一般的网页访问模式（含有入口文件）。

    //配置路由
	// 'URL_ROUTER_ON'=>true,
	// 'URL_ROUTE_RULES'=>array(
	// 	//'c/:id\d'	=>'Index/List/index'  //访问：/c/9
	// 	'/^Teacher$/'	=>'index.php/Teacher/Index/index', //  访问：/c_100
	// 	'/^Student$/'	=>'index.php/Student/Index/index' //  访问：/c_100
	
	// )
	'TMPL_PARSE_STRING' => array(
		'__ROOTURL__' =>'',
	),

);
?>
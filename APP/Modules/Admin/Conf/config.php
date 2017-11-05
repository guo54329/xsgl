<?php
return array(
	
	//指定后台下的Tpl下的Public文件夹位置
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Public',
		'__JS__' => './'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Public/Js',
		'__IMGSRC__' => __ROOT__.'/Public/Upload/images/',
		'__EXCISE__' => __ROOT__.'/Public/Excise/',
		'__FAVICON__' =>__ROOT__.'/Data'
	),  //定义后台的__PUBLIC__所指向的Public文件夹的路径

	'URL_HTML_SUFFIX' =>'',  //去掉伪静态后缀名

//配置超级管理员名称：用户列表
	'RBAC_SUPERADMIN' => 'admin',     //超级管理员的姓名
	
// 配置访问权限设置
	'ADMIN_AUTH_KEY'  =>'superadmin',  //超级管理员认证识别号
	'USER_AUTH_ON' =>true ,      // 是否需要认证
	'USER_AUTH_TYPE' =>1,        // 认证类型
	'USER_AUTH_KEY'  =>'uid',    //认证识别号
	'NOT_AUTH_MODULE'=>'Index,Login,Userinfor',  // 无需认证模块
	'NOT_AUTH_ACTION'=>'',       // 无需认证模块
	'RBAC_ROLE_TABLE'=>'xh_role',// 角色表名称
	'RBAC_USER_TABLE'=>'xh_role_user',// 角色与用户的中间表名称
	'RBAC_ACCESS_TABLE'=>'xh_access', // 权限表名称
	'RBAC_NODE_TABLE'=>'xh_node',     // 节点表名称
	
);
?>
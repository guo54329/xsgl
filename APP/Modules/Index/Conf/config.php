<?php
return array(
	
	//指定后台下的Tpl下的Public文件夹位置
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Public',
		'__JS__' => './'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Public/Js',
		'__IMGSRC__' => __ROOT__.'/Public/Upload/images/',
		'__FAVICON__' =>__ROOT__.'/Data'
	),  //定义后台的__PUBLIC__所指向的Public文件夹的路径

	'URL_HTML_SUFFIX' =>'',  //去掉伪静态后缀名


);
?>
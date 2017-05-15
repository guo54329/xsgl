<?php

//用户与角色关联模型
//关联模型，一个用户对用多个角色时，会将结果组合，一个用户多个角色时，自动组合成一行
Class UserRelationModel extends RelationModel{

	//定义主表名称
	Protected $tableName ='user';

	//定义关联关系:user表与role表通过role_user表关联
	Protected $_link = array(
		'role' => array(
			'mapping_type' => MANY_TO_MANY, //多对多关系
			'foreign_key' =>'user_id',      //主表在中间表中的字段名称
			'relation_key' =>'role_id',     //副表在中间表中的字段名称
			'relation_table' =>'xh_role_user', //中间表名称
			'mapping_fields'=>'id,name,remark'    //副表被读取的字段设置
		)
	);
} 


?>
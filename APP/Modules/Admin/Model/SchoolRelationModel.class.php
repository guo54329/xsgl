<?php

Class SchoolRelationModel extends RelationModel {

	//定义主表名称
	Protected $tableName ='school';

	//关联模型
	Protected $_link = array(
		//一个学校对应多个班级
		'classes'=> array(  
     		'mapping_type'=>HAS_MANY,
          	'class_name'=>'classes',
          	'foreign_key'=>'schid',
            'mapping_fields'=>'id,ccode,cname'    //副表被读取的字段设置
		),

		//一个学校有多个管理员---在为学校添加管理员时用到
		// 'teacher' => array(
		// 	'mapping_type' => MANY_TO_MANY, //多对多关系
		// 	'foreign_key' =>'school_id',          //主表在中间表中的字段名称
		// 	'relation_key' =>'teacher_id',       //副表在中间表中的字段名称
		// 	'relation_table' =>'xh_school_teacher',    //中间表名称
		// 	'mapping_fields'=>'id,jsno,jsxm'    //副表被读取的字段设置
		// )
		

	);
}
?>
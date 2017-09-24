<?php

//教师与学校关联模型

Class TeacherRelationModel extends RelationModel{

	//定义主表名称
	Protected $tableName ='teacher';

	//关联模型
	Protected $_link = array(
		//一个教师对应一个学校
		'school'=> array(  
     		'mapping_type'=>BELONGS_TO,
          	'class_name'=>'school',
          	'foreign_key'=>'schid',
            'mapping_fields'=>'id,scode,sname'    //副表被读取的字段设置
		),

		//一个教师管理多个班级---在为班级添加老师时用到
		'classes' => array(
			'mapping_type' => MANY_TO_MANY, //多对多关系
			'foreign_key' =>'teacher_id',          //主表在中间表中的字段名称
			'relation_key' =>'classes_id',       //副表在中间表中的字段名称
			'relation_table' =>'xh_teacher_classes',    //中间表名称
			'mapping_fields'=>'id,ccode,cname'    //副表被读取的字段设置
		)

	);
} 


?>
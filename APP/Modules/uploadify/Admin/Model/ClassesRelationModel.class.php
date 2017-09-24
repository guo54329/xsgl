<?php

//班级与学校关联模型
//关联模型，一个班级对应一个学校
Class ClassesRelationModel extends RelationModel{

	//定义主表名称
	Protected $tableName ='classes';

	//定义关联关系
	Protected $_link = array(
		'school'=> array(  
     		'mapping_type'=>BELONGS_TO,
          	'class_name'=>'school',
          	'foreign_key'=>'schid',
            'mapping_fields'=>'id,sname'    //副表被读取的字段设置
		),
		//一个班级对应多个学员
		'student'=> array(  
     		'mapping_type'=>HAS_MANY,
          	'class_name'=>'student',
          	'foreign_key'=>'claid',
            'mapping_fields'=>'id,xsno,xsxm,xsxb,xslb,xszymc'    //副表被读取的字段设置
		),

	);
} 


?>
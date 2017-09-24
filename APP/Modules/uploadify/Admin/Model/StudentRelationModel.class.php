<?php

//学生与班级关联模型
//关联模型，一个学生对应一个班级
Class StudentRelationModel extends RelationModel{

	//定义主表名称
	Protected $tableName ='student';

	//定义关联关系
	Protected $_link = array(
		'classes'=> array(  
     		'mapping_type'=>BELONGS_TO,
          	'class_name'=>'classes',
          	'foreign_key'=>'claid',
            'mapping_fields'=>'id,ccode,cname'    //副表被读取的字段设置
		),

	);
} 


?>
<?php
    //数据格式转换:主要用于上传和下载时数据格式的转换
	function convertUTF8($str){
	   if(empty($str)) return '';
	   return  iconv('gb2312', 'utf-8', $str);
	}
    //打印：主要用于测试获取的数据是否正常
    function p($arr){
  	   echo '<pre>' .print_r($arr,true).'</pre>';
    }

?>
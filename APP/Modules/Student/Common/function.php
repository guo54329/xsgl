﻿<?php
//自定义文件名
function definefilename(){
  $stu = session('stu');
  $xsno= $stu['xsno'];
  return $xsno."-".date("YmdHis");
}
//附件下载公共函数
 function downAttach($filepath,$filename){
    $file= $filepath.$filename;
    //First, see if the file exists
    if (!is_file($file)) { die("<b>文件没找到!</b>"); }
 
    //Gather relevent info about file
    $len = filesize($file);
    $filename = basename($file);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));
    
    //适配各种类型文件
    switch( $file_extension ) {
          case "pdf": $ctype="application/pdf"; break;
      case "exe": $ctype="application/octet-stream"; break;
      case "zip": $ctype="application/zip"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "jpg": $ctype="image/jpg"; break;
      case "mp3": $ctype="audio/mpeg"; break;
      case "wav": $ctype="audio/x-wav"; break;
      case "mpeg":
      case "mpg":
      case "mpe": $ctype="video/mpeg"; break;
      case "mov": $ctype="video/quicktime"; break;
      case "avi": $ctype="video/x-msvideo"; break;
 
      //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
      case "php":
      case "htm":
      case "html":
      case "txt": die("<b> ". $file_extension ." 类型的文件请执行另存为操作！</b>"); break;
 
      default: $ctype="application/force-download";
    }
     
    ob_end_clean();//清除缓冲区,避免乱码
    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
     
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
        header("Content-Type: application/force-download"); //默认的下载方式
        //header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
    $header="Content-Disposition: attachment; filename=".$filename.";";
    header($header );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    @readfile($file);
    exit;
 }


 //信息提示
function  show($status, $message,$data=array()) {
    $reuslt = array(
        'status' => $status,
        'message' => $message,
        'data' => $data,
    );

    exit(json_encode($reuslt));
}

//组合一维数组：无限极分类
function unlimitedForLevel($cate,$html='',$pid=0,$level=0){

    $arr=array();
    foreach ($cate as $v) {
      if($v['pdeid']==$pid){

        $v['level']=$level+1;
        $v['html']=str_repeat($html, $level);
        $arr[]=$v;
        $arr = array_merge($arr,unlimitedForLevel($cate,$html,$v['deid'],$level+1));
      }
    }
    return $arr;

 }

 //讨论言语合法检查
 function checkword($content){
    $arr=array('/垃圾/','/滚/','/靠/','/日/','/ma/','/叼/','/猪/','/nnd/','/死远/','/奶/','/傻逼/','/sb/','/屎/','/死/','/猥琐/','/我爱你/','/逼/','/4/','/草/','/艹/','/cao/','/蛋/');
    // p($content);
    foreach ($arr as $value){
       $check = strrpos($value,$content);//preg_match_all($value,$content); //搜索一个字符串在另一个字符串中的第一次出现
        if($check>0){
          //p($check);die;
          return false;
        }
    }
}
    //查询学期->课程
function getCourseinfor(){
    $Model = M('sxsetcourse as a');
    $res=$Model->field('term')->distinct(true)->select();
    $s="var xq=[{data:[['','请选择学期...']";
    foreach($res as $v){
     
      $s=$s.",'" . $v['term']. "'";
    }   
    $s=$s."]}];";
    
    
    $s1 = $s;
    
    $res=$Model->join('xh_sxsetcourse as b  on a.term = b.term', 'left')->field('a.term,a.coursename')->distinct(true)->select();
    $s="var kc=[{value:'',disabled:true,data:[['','请选择课程...']";
    $p = "";
    $c = "";
    foreach($res as $v2){
      if($p == ($v2['term']))
        {
          $s=$s . ",'" . $v2['coursename'] . "'";
        }
        else
        { 
          $s=$s . "]},{value:'" . $v2['term']."',data:[['','请选择课程...'],'" .$v2['coursename'] . "'";
        }
        $p = $v2['term'];
        $c = $v2['coursename'];
    }
    
    
    
    $s=$s."]}];";
    $s2 = $s;

    $file=C('TMPL_PARSE_STRING');
    $file=$file['__JS__'].'/termCourse.js';
    $content = $s1.$s2;

    //p($content);die;
   
    unlink($file);
    if(file_put_contents($file,$content)==FALSE)  
    {
      echo "由学期联动课程的js文件不可写!";
      exit;
    }
}

?>
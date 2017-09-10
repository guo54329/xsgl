<?php
//自定义文件名
function definefilename(){
  /*
	$tea = session('tea');
	$jsno= $tea['jsno'];
  $jsxm= $tea['jsxm'];
  import('Class.Pinyin',APP_PATH);//引入中英文转换类
  $py = new PinYin();
  $jsxmpy = $py->getAllPY($jsxm);//将中文的姓名转换为拼音

	return $jsno."-".$jsxmpy."-".date("YmdHis");
  */
    $tea = session('tea');
    $uptime=session('uptime');
    $jsxm= $tea['jsxm'];
    return date("YmdHis")."-JS-".$jsxm;//上传日期-JS-姓名
}
//附件下载公共函数
 function downAttach($filepath,$filename){
    $file= $filepath.$filename;
    //First, see if the file exists
    // if (!is_file($file)) { die("<b>文件没找到!</b>"); }
 
    //Gather relevent info about file
    $len = filesize($file);
    $filename = basename($file);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));
    // $file_extension;die;
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
      case "txt": echo $filepath.$filename ; break;
    //被上面的echo替换。die("<b> ". $file_extension ." 类型文件不支持，请提醒提交者压缩后重新提交！</b>")
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

//查询组建时间->班级
function getClassesinfor(){
    $Model = M('classes as a');
        $res=$Model->field('zjsj')->distinct(true)->select();
    $s="var sj=[{data:[['','请选择时间...']";
    foreach($res as $v){
     
      $s=$s.",'" . $v['zjsj']. "'";
    }   
    $s=$s."]}];";
    
    
    $s1 = $s;
    
    $res=$Model->join('xh_classes as b  on a.zjsj = b.zjsj', 'left')->field('a.zjsj,a.ccode,a.cname')->distinct(true)->select();
    $s="var bj=[{value:'',disabled:true,data:[['','请选择班级...']";
    $p = "";
    $c = "";
    foreach($res as $v2){
      if($p == ($v2['zjsj']))
        {
          $s=$s . ",'" . $v2['ccode']."-". $v2['cname'] . "'";
        }
        else
        { 
          $s=$s . "]},{value:'" . $v2['zjsj']."',data:[['','请选择班级...'],'" . $v2['ccode']."-". $v2['cname'] . "'";
        }
        $p = $v2['zjsj'];
        $c = $v2['ccode']."-". $v2['cname'];
    }
    
    
    
    $s=$s."]}];";
    $s2 = $s;

    $file=C('TMPL_PARSE_STRING');
    $file=$file['__JS__'].'/zjsjclasses.js';
    $content = $s1.$s2;

    //p($content);die;
   
    unlink($file);
    if(file_put_contents($file,$content)==FALSE)  
    {
      echo "由组建时间联动班级的js文件不可写!";
      exit;
    }
}

//查询专业-课程
function getCourseinfor(){
    $Model = M('course as a');
        $res=$Model->field('proname')->distinct(true)->select();
    $s="var zy=[{data:[['','请选择专业...']";
    foreach($res as $v){
     
      $s=$s.",'" . $v['proname']. "'";
    }   
    $s=$s."]}];";
    
    
    $s1 = $s;
    
    $res=$Model->join('xh_course as b  on a.proname = b.proname', 'left')->field('a.proname,a.name')->distinct(true)->select();
    $s="var kc=[{value:'',disabled:true,data:[['','请选择课程...']";
    $p = "";
    $c = "";
    foreach($res as $v2){
      if($p == ($v2['proname']))
        {
          $s=$s . ",'" . $v2['name']."'";
        }
        else
        { 
          $s=$s . "]},{value:'" . $v2['proname']."',data:[['','请选择课程...'],'" . $v2['name']."'";
        }
        $p = $v2['proname'];
        $c = $v2['name'];
    }
    
    
    
    $s=$s."]}];";
    $s2 = $s;

    $file=C('TMPL_PARSE_STRING');
    $file=$file['__JS__'].'/procourse.js';
    $content = $s1.$s2;

    //p($content);die;
   
    unlink($file);
    if(file_put_contents($file,$content)==FALSE)  
    {
      echo "由专业联动课程的js文件不可写!";
      exit;
    }
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
function getChildsId($cate,$pid){
    $arr=array();
    foreach ($cate as $v) {
      if($v['pdeid']==$pid){
        $arr[]=$v['deid'];
        $arr = array_merge($arr,getChildsId($cate,$v['deid']));

      }
    }
    return $arr;
}
function checkword($civilization){
    $arr=array('垃圾','滚','靠','cao','日','ma','叼');p($civilization);
    foreach ($arr as $value){
        $check=stripos($civilization, $value); //搜索一个字符串在另一个字符串中的第一次出现

        //p($check);
        if($check==true || !empty($check)){
          //return false;
        }
    }
    //die;
    return $civilization;
}

?>
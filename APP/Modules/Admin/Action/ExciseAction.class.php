<?php
Class ExciseAction extends CommonAction {

/**
 * 课程表管理
 * @return [type] [description]
 */
public function resetSX(){
    $disnum = M('sxdisexicise')->count();
    if($disnum>0){
        M()->execute("TRUNCATE xh_sxdisexicise");//交流评价表
    }
    $subnum = M('sxsubexcise')->count();
    if($subnum>0){
        M()->execute("TRUNCATE xh_sxsubexcise");//任务提交表
    }
    $pubnum = M('sxpubexcise')->count();
    if($pubnum>0){
        M()->execute("TRUNCATE xh_sxpubexcise");//任务发布表
    }
    $setnum = M('sxsetcourse')->count();
    if($setnum>0){
        M()->execute("TRUNCATE xh_sxsetcourse");//课程列表
    }

    $this->success('演示数据清除成功！',U(GROUP_NAME.'/Excise/courseTable'));
}
public function courseTable(){
  //课程表

   if($_POST['term1']!='' && $_POST['coursename']!=''){//根据条件学期和课程查询
      $term=$_POST['term1'];
      $coursename=$_POST['coursename'];
      $num=$coursetable = M('sxsetcourse as a ')->join("xh_teacher as b on a.jsno=b.jsno")->join("xh_classes as c on a.ccode = c.ccode")->where("a.term='$term' and a.coursename='$coursename'")->count();

       $coursetable = M('sxsetcourse as a ')->join("xh_teacher as b on a.jsno=b.jsno")->join("xh_classes as c on a.ccode = c.ccode")->field("a.scid,a.term,b.jsxm,c.cname,a.coursename")->where("a.term='$term' and a.coursename='$coursename'")->order("a.jsno ASC")->select();
   }elseif($_POST['term2']!='' && $_POST['js']!=''){//根据条件学期和教师查询
       
       $term=$_POST['term2'];
       $js = explode('-',$_POST['js']);
       $jsno=$js[0];
       $num=M('sxsetcourse as a ')->join("xh_teacher as b on a.jsno=b.jsno")->join("xh_classes as c on a.ccode = c.ccode")->where("a.term='$term' and a.jsno='$jsno'")->count();

       $coursetable = M('sxsetcourse as a ')->join("xh_teacher as b on a.jsno=b.jsno")->join("xh_classes as c on a.ccode = c.ccode")->field("a.scid,a.term,b.jsxm,c.cname,a.coursename")->where("a.term='$term' and a.jsno='$jsno'")->order("a.coursename ASC")->select();
   }else{//查询所有
   		$num=M('sxsetcourse as a ')->join("xh_teacher as b on a.jsno=b.jsno")->join("xh_classes as c on a.ccode = c.ccode")->count();
        $coursetable = M('sxsetcourse as a ')->join("xh_teacher as b on a.jsno=b.jsno")->join("xh_classes as c on a.ccode = c.ccode")->field("a.scid,a.term,b.jsxm,c.cname,a.coursename")->order("a.term DESC,a.jsno ASC")->select();
   }
    
    getCourseinfor2();//创建由学期联动课程的js
    getCourseinfor3();//创建由学期联动教师的js
    $this->assign('num',$num);
    $this->assign('coursetable',$coursetable);
    $this->display();

}
//添加课程表
public function coursetableSave(){
     if(!empty($_POST)){//添加处理
        $jsno=explode('-',$_POST['js']);
        $jsno = $jsno[0]; //教师编号
        $ccode = explode('-',$_POST['ccode']);
        $ccode =$ccode[0];//班级编码
        $data=array(
            'jsno'=>$jsno,
            'ccode'=>$ccode,
            'coursename'=>$_POST['kc'],
            'term'=>$_POST['term']
        );
        if(M('sxsetcourse')->add($data)){
            $this->success('提交成功！',U(GROUP_NAME.'/Excise/courseTable'));
        }else{
            $this->error('提交失败！');
        }
    }else{//添加视图
        
        //学期选择
        $term = M('term')->order('name DESC')->select();
        $this->assign('term',$term);
        //按处室选择教师
        getTeacherinfor();
        //按组建时间选择班级
        getClassesinfor();
        //按专业选择课程
        getCourseinfor();
        $this->display();
    }
}

//对该门课程的所有任务和学生作业打包成zip文件下载
public function sxcoursePackage(){
    $scid = (int)$_GET['scid'];//课程id
    $filepaths = M('sxpubexcise')->field('url')->where("scid=$scid")->select();//该课程的所有任务地址(多个)

    $courseinfo = M('sxsetcourse')->field('coursename')->find($scid);//在课程表获取该课程的信息
    $coursename = $courseinfo['coursename'];//课程名称
    import('Class.Pinyin',APP_PATH);//引入中英文转换类
    $py = new PinYin();
    $coursenamepinyin = $py->getAllPY($coursename);//将中文的课程名称转换为拼音
    

    $zippath = "./Public/Excise/tempfile/";//定义存放打包文件的路径
    $zipname=$coursenamepinyin;//文件名(无扩展名)
    $zipfile=$zippath.$zipname;//路径加文件名(无扩展名)
    unlink($zipfile.'.zip'); //删除上次下载前生成的文件
    
    $zip=new ZipArchive();
    $zip->open($zipfile.'.zip',ZipArchive::CREATE);//创建一个空的zip文件

    for($i=0;$i<count($filepaths);$i++){//将各个目录下的任务和作业添加到zip文件中
        $filepath = $filepaths[$i]['url'];
        if (is_dir($filepath)){ 
            $arr=scandir($filepath); 
            foreach ($arr as $k=>$v){
              if(!($v=='.'||$v=='..')){//  
                 $zip->addFile($filepath.$v,$v);
              }
            }
        }
    }
    $zip->close(); 
    $filename = $zipname.'.zip';//单纯文件名+扩展名
    if(count($filepaths)>0){
        downAttach($zippath,$filename); 
         
    }else{
        $this->error("至今没发布过任务,何谈下载!");
    }
}
//删除指定的课程
public function delcourseTable(){
  $scid = (int)$_GET['id'];
  //检查该课程有无任务,有则不可删除
  $res = M('sxpubexcise')->where("scid=$scid")->count();
  if($res>0){
      $this->error("请先撤销发布的任务,然后删除任务,再进行课程删除操作！");
  }else{
      $res=M('sxsetcourse')->delete($scid);
      if($res){
        $this->success("删除成功！",U(GROUP_NAME.'/Excise/courseTable'));
      }else{
        $this->error("删除失败！");
      }
  }
  
}
/**
 * 教师发布的实训任务管理
 * @return [type] [description]
 */
public function sxpubexciseList(){
  
    $scid = (int)$_GET['scid'];
    $Model=M('sxpubexcise as a');
    $courseinfo = M('sxsetcourse as a')->join("xh_teacher as b on a.jsno = b.jsno")->join("xh_classes as c on a.ccode = c.ccode")->field("a.scid,b.jsxm,c.cname,a.coursename,a.term")->where("a.scid=$scid")->find();
    $num=$list = $Model->where("a.scid=$scid")->count();
    $list = $Model->field("a.scid,a.peid,a.title,a.desc,a.filename,a.url,a.status,a.pubtime,a.isrec")->where("a.scid=$scid")->order('a.pubtime ASC')->select();
    $this->assign('num',$num);
    $this->assign('courseinfo',$courseinfo);
    $this->assign('list',$list);
    $this->display();
}

//添加和修改指定课程的任务 
//先自动上传附件
public function uploadfile(){
    
	$file = $_FILES['Filedata'];
  	
  	/*
  	if($file['name']==""||$file['error']==4){
      	$this->error("任务附件必须上传！");
  	}
  	if($file['size']>102400000){
   	   $this->error("附件大小不能超过100MB！");
  	} 
  	$fileext = explode('.',$file['name']);  
  	$fileext = strtolower($fileext[count($fileext)-1]);
  	$filedenyext = array('php','txt','html','htm');
  	if(in_array($fileext, $filedenyext)){
      	$this->error("文件类型不支持,请压缩为zip再上传！");
  	}
    */
	  $verifyToken = md5('unique_salt' . $_POST['timestamp']);
	  $scid = (int)$_POST['scid'];//课程id
    $courseinfo = M('sxsetcourse')->field('term,jsno,coursename')->find($scid);//在课程表获取该课程的信息
    $coursename = $courseinfo['coursename'];//课程名称
    $term = $courseinfo['term'];//学期
    $jsno = $courseinfo['jsno'];//教师编码
          
    $jsxm = M('teacher')->where("jsno='$jsno'")->field("jsxm")->find();
    $jsxm =$jsxm['jsxm'];//教师姓名
           
    import('Class.Pinyin',APP_PATH);//引入中英文转换类
    $py = new PinYin();
    $jsxmpinyin = $py->getAllPY($jsxm);//将中文的教师姓名转换为拼音
    session('jsxmpy',$jsxmpinyin);//上传附件名称定义
    $coursenamepinyin = $py->getAllPY($coursename);//将中文的课程名称转换为拼音
    //定义上传文件的路径,该路径还用于学生作业上交
    $js=$jsno.'-'.$jsxmpinyin;
    $uptime=date("YmdHis");
    session('uptime',$uptime);//用于上传文件名的定义
    $filepath="./Public/Excise/".$term."/".$js."/".$coursenamepinyin."/".$uptime."/";
    //echo $filepath;die;

	if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
		import('ORG.Net.UploadFile'); //载入TP上传类
		$uploadfile = new UploadFile();
        $uploadfile->uploadReplace=true;//允许同名文件覆盖
        $uploadfile->saveRule ='definefilename';  //文件命名自定义：在functon里面定义
        if($info = $uploadfile->uploadOne($file,$filepath)){ //上传成功
           $filename=$info[0]['savename']; 
            //准备保存数据
            $data['scid']=$scid;
            $data['url']=$filepath;
            $data['filename']=$filename;
			$peid = M('sxpubexcise')->add($data); 
            echo $peid;
            
        }else{
        	echo '上传失败!';
        }
	}

}
//再保存记录     
public function sxpubexciseSave(){ 
   
   if(!empty($_POST)){
   	  $peid=$_POST['peid'];
   	  if($peid==0){
   	   	  $this->error("请上传任务附件！");
   	  }	
      $title=$_POST['title'];
      $desc= $_POST['desc'];
      $pubtime=time();
      
      $sql="UPDATE `xh_sxpubexcise` SET `title` = '$title', `desc` = '$desc', `pubtime` = '$pubtime' WHERE `peid` = $peid";   
      if(M()->execute($sql)){
          $this->success("添加任务成功,请发布！",U(GROUP_NAME."/Excise/sxpubexciseList",array('scid'=>$_POST['scid'])));
      }else{
          $this->error("添加任务失败！");
      }
   }else{
      //发布任务视图
		$scid = (int)$_GET['scid'];
	    $coursename = M('sxsetcourse')->field('coursename,jsno')->find($scid);
	    $this->assign('coursename',$coursename['coursename']);
	    session('sxpubjsno',$coursename['jsno']);
	    $this->assign('scid',$scid);
	    $this->display();
   } 
}


//修改发布状态(发布和撤销发布)
public function sxpubexciseStatus(){
    $peid = (int)$_POST['peid'];
    $status = $_POST['status'];
    $scid = $_POST['scid'];

    //返回状态变量
    $flag="";
    if($status==0){
        //更新发布状态
        $data = array('peid'=>$peid,'status'=>1);
        //根据scid在课表sxsetcourse里面找到ccode,然后找到学生的学号,添加到表sxsubexcise中
        $ccode = M('sxsetcourse')->field('ccode')->find($scid);
        $ccode=$ccode['ccode'];
        $xsnos = M('student')->where("ccode = $ccode")->field("xsno")->order('xsno ASC')->select();
        $excise =array();
        for($i=0;$i<count($xsnos);$i++){
            $excise[$i]=array(
                'peid'=>$peid,
                'xsno'=>$xsnos[$i]['xsno'],
            );
        }
        $flag="已发布";
        M('sxsubexcise')->addAll($excise);
        
    }else{
        $flag="未发布";
        $data = array('peid'=>$peid,'status'=>0);
        M('sxsubexcise')->where("peid = $peid")->delete();
    }
    $res = M('sxpubexcise')->save($data);
    
    if($res){
      show(1,"发布状态设置成功！",$flag);
    }else{
      show(0,"发布状态设置失败！",$flag);
    }
}



//下载教师发布的任务的附件
public function sxpubexciseDownAttach(){
    $peid = (int)$_GET['peid'];
    $attach = M('sxpubexcise')->find($peid);
    $filepath = $attach['url'];
    $filename = $attach['filename'];
    if($filename==""){
       $this-error("任务附件不存在！");
    }
    downAttach($filepath,$filename);
}
//删除教师发布的任务
public function sxpubexciseDel(){
   $peid = (int)$_POST['peid'];
   //检查学生是否已提交作业
   $resc=M('sxsubexcise')->where("peid=$peid")->count();
   if($resc>0){
       show(0,"请设置已提交作业学生重做并撤销发布,再删除！");
   }else{
       //删除附件
       $attach = M('sxpubexcise')->field('url,filename')->find($peid);
       $filename = $attach['filename'];
       if($filename!=''){
            $filepath = $attach['url'];
            $file = $filepath.$filename;
            unlink($file);
       }
       $res1=M('sxpubexcise')->delete($peid);
       if($res1){
            $res2=M('xh_sxdisexicise')->where("peid=$peid")->delete();//删除讨论
            $scid = (int)$_POST['scid']; //返回去用于页面跳转
            $url = U(GROUP_NAME."/Excise/sxpubexciseList",array('scid'=>$scid));
            show(1,"删除成功！",$url);
       }else{
            show(0,"删除失败！");
       }
   } 
}

//对该门课程的指定任务和学生作业打包成zip文件下载
public function sxexcisePackage(){
    $peid = (int)$_GET['peid'];//任务id
     
    $exciseurl = M('sxpubexcise')->field('url')->find($peid);//获取该任务url

    $zippath = "./Public/Excise/tempfile/";//定义存放打包文件的路径
    $zipname=$peid;//文件名为任务id(无扩展名)
    $zipfile=$zippath.$zipname;//路径加文件名(无扩展名)
    unlink($zipfile.'.zip'); //删除上次下载前生成的文件
    
    $zip=new ZipArchive();
    $zip->open($zipfile.'.zip',ZipArchive::CREATE);//创建一个空的zip文件

    $filepath = $exciseurl['url'];
    if (is_dir($filepath)){ 
        $arr=scandir($filepath); 
        foreach ($arr as $k=>$v){
          if(!($v=='.'||$v=='..')){//  
             $zip->addFile($filepath.$v,$v);
          }
        }
    }
    $zip->close(); 
    $filename = $zipname.'.zip';//单纯文件名+扩展名
    downAttach($zippath,$filename); 
}

//查看任务完成情况
public function sxsubexciseList(){
    $peid = (int)$_GET['peid'];
    //查询任务描述
    $excisedesc = M('sxpubexcise')->find($peid);//任务

    $scid=$excisedesc['scid'];
    $courseinfo =M('sxsetcourse as a')->join('xh_teacher as b on a.jsno=b.jsno')->where("a.scid=$scid")->find();//课程和学期
    $ccode = $courseinfo['ccode'];
    $classes =M('classes')->where("ccode='$ccode'")->field("cname")->find();//班级名称
   
    $this->assign('courseinfo',$courseinfo);
    $this->assign('excisedesc',$excisedesc);
    $this->assign('classes',$classes);
    //查询学生作业完成情况
    $exciselist=M('sxsubexcise as a')->join('xh_student as b on a.xsno=b.xsno')->where("peid=$peid")->field("a.seid,a.xsno,b.xsxm,a.desc,a.status,a.subtime,a.peid,a.isrec")->order('a.status DESC,a.xsno ASC')->select();
    $this->assign('peid',$peid);
    $this->assign('exciselist',$exciselist);
    $this->display();
}

//任务完成情况统计下载
public function sxsubexciseTable(){
    $peid = (int)$_GET['peid'];
    $title=M('sxpubexcise')->field('title')->find($peid);
    $title=$title['title'];//实训任务标题
    //查询学生作业完成情况
    $data=M('sxsubexcise as a')->join('xh_student as b on a.xsno=b.xsno')->where("peid=$peid")->field("a.seid,a.xsno,b.xsxm,a.desc,a.status,a.subtime,a.peid")->order('a.status DESC,a.xsno ASC')->select();
    //引入PHPExcel
    import('Class.PHPExcel',APP_PATH); 
    require APP_PATH.'Class/PHPExcel/Writer/Excel2007.php' ; //xlsx格式  
    $objPHPExcel = new PHPExcel();
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //xlsx格式 

    //设置宽度
    //$objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(14);  
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    
    //设置行高度
    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(34);
    $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(26);
  
    //设置字体大小
    $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(11);
    $objPHPExcel->getActiveSheet()->getStyle('A1:G2')->getFont()->setBold(true);
  
    $objPHPExcel->getActiveSheet()->getStyle('A1:G2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    //设置水平居中
    $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //合并
    $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
    //设置表格头部内容

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "学生完成情况统计($title)");

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', '学号');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '姓名');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', '是否完成');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', '提交时间');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', '自我评价');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', '教师评价');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', '实训成绩(自评*0.3+师评*0.7)');

    //将数据库中的数据转码 UTF-8
    //p($data);die;
    for($i=0;$i<count($data);$i++) {
        //如果是从数据库中读取的数据，需要对数据进行转码操作，convertUTF8($str)
        $objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $data[$i]['xsno']." ");
        $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $data[$i]['xsxm']);
        if($data[$i]['status']==0){
           $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), '未完成');
        }else{
           $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), '已完成');
        }
        if($data[$i]['subtime']!=0){
           $subtime = date("Y-m-d H-i-s",$data[$i]['subtime']);
           $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $subtime);
        }else{
           $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), '');
        }
        
        $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $data[$i]['desc']);
        $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), $data[$i]['isrec']);
        $objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 3), round($data[$i]['desc']*0.3+$data[$i]['isrec']*0.7),2);

        $objPHPExcel->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(24);  
    }
    // 设置工作表名
    $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
    $objPHPExcel->setActiveSheetIndex(0); 
    //支持xls和xlsx格式
    $outputFileName = "学生实训任务完成情况统计.xlsx";
    
    ob_end_clean();//清除缓冲区,避免乱码 
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header('Content-Disposition:attachment;filename="' . $outputFileName . '"');  //到文件
    header("Content-Transfer-Encoding: binary");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");
    $objWriter->save('php://output'); 

} 

     
//评论列表
public function sxexciseDiscuss(){
    $peid = (int)$_GET['peid'];
    //查询任务描述
    $excisedesc = M('sxpubexcise')->find($peid);//任务
    $scid=$excisedesc['scid'];
    //课程和学期和教师
    $courseinfo =M('sxsetcourse as a')->join('xh_teacher as b on a.jsno=b.jsno')->where("a.scid=$scid")->find();//课程和学期
    //班级名称
    $ccode = $courseinfo['ccode'];
    $classes =M('classes')->where("ccode='$ccode'")->field("cname")->find();
   
    $this->assign('courseinfo',$courseinfo);
    $this->assign('excisedesc',$excisedesc);
    $this->assign('classes',$classes);
    //查询学生作业
    $exciselist=M('sxsubexcise as a')->join('xh_student as b on a.xsno=b.xsno')->where("a.peid=$peid and a.status=1")->field("a.seid,a.xsno,b.xsxm,a.filename,a.peid")->order('a.xsno ASC')->select();
    $this->assign('exciselist',$exciselist);
    //查询完成作业的人数
    $count=M('sxsubexcise')->where("peid=$peid and status=1")->field('seid')->count();
    $this->assign("count",$count);

    $userxm =session('username');//管理员姓名
    $this->assign('userxm',$userxm);

    //查询当前讨论情况
    $discuss=M('sxdisexicise')->where("peid=$peid")->order("peid ASC, deid ASC")->select();
    $num=M('sxdisexicise')->where("peid=$peid")->count();
    $discuss = unlimitedForLevel($discuss,"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",0);
    $this->assign('num',$num);
    $this->assign('discuss',$discuss);
    $this->assign('peid',$peid);
    //p($discuss);die;
    $this->display();
}
//添加评论
public function sxexciseDiscussSave(){
    if(!empty($_POST)){
        $peid = (int)$_POST['peid'];
        $content = $_POST['content'];
        if (empty($content)) {
           $this->error("评论内容不能为空！");
        }else{
            $data =array(
               'peid'=>$peid,
               'atuser'=>$_POST['atuser'],
               'content'=>$content,
               'userxm' =>$_POST['userxm'],
               'usertype'=>"管理员",
               'distime'=>time(),
               'pdeid'=>$_POST['pdeid'], 
            );
            $res =M('sxdisexicise')->add($data);
            if($res){
              $this->success("评论成功！",U(GROUP_NAME.'/Excise/sxexciseDiscuss',array('peid'=>$peid)));
            }else{
               $this->error("评论失败！"); 
            }
        }
        
    }  
}
//删除评论
public function sxexciseDiscussDel(){
    $deid=(int)$_GET['deid'];
    $peid=(int)$_GET['peid'];
    $dislist=M("sxdisexicise")->select();
    $ids = getChildsId($dislist,$deid);
    $ids[]=$deid;//本身的id及其所有子id
    $where['deid']=array('in',$ids);  //批量删除的正确方法
    if(M('sxdisexicise')->where($where)->delete()){
       $this->success("删除成功！",U(GROUP_NAME.'/Excise/sxexciseDiscuss',array('peid'=>$peid)));
    }else{
        $this->error("删除失败！");
    }
}
//下载学生作业附件
public function sxsubexciseDownAttach(){
    $seid = $_GET['seid'];
    $filename = M('sxsubexcise')->field('peid,filename')->find($seid);
    $url= M('sxpubexcise')->field('url')->find($filename['peid']);
    $filepath = $url['url'];
    $filename = $filename['filename'];
    if($filename==""){
       $this-error("作业文件不存在！");
    }
    downAttach($filepath,$filename);
}

//删除指定学生作业
public function sxsubexciseDel(){
   $seid = $_GET['seid'];
   $peid = M('sxsubexcise')->field('peid')->find($seid);
   $peid = $peid['peid']; 
   if(M('sxsubexcise')->delete($seid)){
        $this->success('删除成功！',U(GROUP_NAME."/Excise/sxsubexciseList",array('peid'=>$peid)));
   }else{
        $this->error('删除失败！');
   }
}

//设置学生作业重做
public function sxsubexciseRedo(){
       $seid = $_GET['seid'];
       $filename = M('sxsubexcise')->field('filename,peid')->find($seid);
     $peid = $filename['peid']; 
     $url= M('sxpubexcise')->field('url')->find($peid);
       $filepath = $url['url'];
     $filename = $filename['filename'];
       $file = $filepath.$filename;
       unlink($file);//删除附件
       $data = array(
            'seid'=>$seid,
            'desc' =>'',
            'filename'=>'',
            'subtime'=>0,
            'status'=>0,
            'isrec'=>0
        );
       $res = M('sxsubexcise')->save($data);
       if($res){
               $this->success('设置重做成功！',U(GROUP_NAME."/Excise/sxsubexciseList",array('peid'=>$peid)));
       }else{
               $this->error('设置重做失败！');
       }
     
}

//一键设置学生作业重做
public function sxsubexciseRedoAll(){
    $peid=(int)$_GET['peid'];
    $url= M('sxpubexcise')->field('url')->find($peid);
    $excises = M('sxsubexcise')->where("peid=$peid")->select();
    $index=0;
    for($i=0;$i<count($excises);$i++){
         if($excises[$i]['filename']!=''){//删除已提交的作业  也可以使用提交状态status来做判断
             $file = $url['url'].$excises[$i]['filename'];
             unlink($file);//删除附件
             $seids[$index++] = $excises[$i]['seid'];  //保存需要重做的seid
         }      
    }
    //设置重做的字段值都是一样的所以只需要初始化一次即可
    $data= array(
        'desc' =>'',
        'filename'=>'',
        'subtime'=>0,
        'status'=>0,
        'isrec'=>''
     );

    $where['seid']=array('in',$seids);  //批量删除的正确方法

    $res = M('sxsubexcise')->where($where)->save($data);
    if($res){
        $this->success('一键重做设置成功！',U(GROUP_NAME."/Excise/sxsubexciseList",array('peid'=>$peid)));
    }else{
        $this->error('一键重做设置失败！');
    }
}

}

?>
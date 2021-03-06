<?php
Class ExciseAction extends CommonAction {

/**
 * 课程表管理
 * @return [type] [description]
 */
public function courseTable(){
  //课程表
    $tea = session('tea');
    $jsno = $tea['jsno'];
    $Model = M('sxsetcourse as a');
    //查询学期数据
    $term = $Model->field('a.term')->distinct(true)->order('a.term DESC')->select();
    //p($term);
    $this->assign('term',$term);
    //查询课程表
    if(!empty($_POST['term'])){
       $term = $_POST['term'];
        //按学期查询
        $num=$Model->join('xh_classes as b on a.ccode = b.ccode')->join('xh_teacher as c on c.jsno = b.master')->where("a.jsno='$jsno' and a.term='$term'")->count();

        $list = $Model->join('xh_classes as b on a.ccode = b.ccode')->join('xh_teacher as c on c.jsno = b.master')->where("a.jsno='$jsno' and a.term='$term'")->field("a.scid,a.term,a.coursename,b.ccode,b.cname,c.jsxm,c.jsdh")->order("a.scid ASC")->select();
       //获取每门课的url
        $scids = $Model->join("left join xh_sxpubexcise as b on a.scid=b.scid")->distinct(true)->field("a.scid,b.url")->group("a.scid")->where("a.jsno='$jsno' and a.term='$term'")->order("a.scid ASC")->select();

    }else{//查询所有
         $num=$Model->join('xh_classes as b on a.ccode = b.ccode')->join('xh_teacher as c on c.jsno = b.master')->where("a.jsno='$jsno'")->count();

        $list = $Model->join('xh_classes as b on a.ccode = b.ccode')->join('xh_teacher as c on c.jsno = b.master')->where("a.jsno='$jsno'")->field("a.scid,a.term,a.coursename,b.ccode,b.cname,c.jsxm,c.jsdh")->order("a.term DESC,a.scid ASC")->select();
        //获取每门课的url
        $scids = $Model->join("left join xh_sxpubexcise as b on a.scid=b.scid")->distinct(true)->field("a.scid,b.url")->group("a.scid")->where("a.jsno='$jsno'")->order("a.term DESC,a.scid ASC")->select();
    }

//大文件下载提供拷贝地址
    //根路径：如：C:\wamp64\www\xsgl\
    $filepath =  dirname(__FILE__);
    $str = explode('\\',$filepath);
    $rooturl = '';
    for($i=0;$i<count($str)-4;$i++){
       $rooturl .= $str[$i].'/';
    }
    $rooturl = str_replace('/','\\',$rooturl);
    //相对路径：如：Public\Excise\2017-2018-1\GS-guosheng\jisuanjiyingyongjichu\
    $scidurl=array();
    for($i=0;$i<count($scids);$i++){
       $tempurl = $scids[$i]['url'];
       if($tempurl!=''){
          $tempurl = explode('/',$tempurl);
          for($j=1;$j<count($tempurl)-2;$j++){
             $scidurl[$i] .= $tempurl[$j].'\\';
          }
          // 完整路径如：
          // ﻿C:\wamp64\www\xsgl\Public\Excise\2017-2018-1\GS-guosheng\jisuanjiyingyongjichu\    
          $url[$i] = trim($rooturl.$scidurl[$i]);
          
       }else{
          $url[$i] = '';
       }
    }

    $this->assign('url',$url);
    $this->assign('num',$num);
    $this->assign('list',$list);
    $this->display();

}
//添加课程表
public function coursetableSave(){
    if(!empty($_POST)){//添加处理
        $tea = session('tea');
        $jsno = $tea['jsno'];

        $term=trim($_POST['term']);
        $ccode=trim($_POST['ccode']);
        $kc=trim($_POST['kc']);
        //验证输入
        if($term==""){
            $this->error('请选择学期！');
        }
        if($ccode==""){
            $this->error('请选择班级！');
        }
        if($kc==""){
            $this->error('请选择课程！');
        }
        //添加处理
        $ccode = explode('-',$ccode);
        $ccode =$ccode[0];//班级编码
        $data=array(
          'jsno'=>$jsno,
          'ccode'=>$ccode,
          'coursename'=>$kc,
          'term'=>$term
        );
        //查重
        $count= M('sxsetcourse')->where("jsno='$jsno' and ccode='$ccode' and coursename='$kc' and term='$term'")->count();
        if($count>0){
            $this->error('该条记录已存在！');
        }

        //插入
        if(M('sxsetcourse')->add($data)){
            $this->success('添加课程表成功！',U(GROUP_NAME.'/Excise/courseTable'));
        }else{
            $this->error('添加课程表失败！');
        }
    }else{//添加视图
      //学期选择
      $term = M('term')->order('id DESC')->select();
      $this->assign('term',$term);  
      //按组建时间选择班级
      getClassesinfor();
      //按专业选择课程
      getCourseinfor();
      $this->display();
    }
}

//对该门课程的所有任务完成情况进行统计生成Excel表共下载
public function sxfinishCount(){
   $scid = (int)$_GET['scid'];//课程id
   $Model=M('sxpubexcise as a');
   //课程有关信息：
   //学期：2017-2018-1   教师：郭盛   班级：2016级计算机班  课程：计算机应用基础
    $courseinfo = M('sxsetcourse as a')->join("xh_teacher as b on a.jsno = b.jsno")->join("xh_classes as c on a.ccode = c.ccode")->field("a.scid,b.jsxm,c.cname,a.coursename,a.term")->where("a.scid=$scid")->find();
    $title ="学期:".$courseinfo['term']."　　授课教师:".$courseinfo['jsxm']."　　授课班级:".$courseinfo['cname']."　　所授课程:《".$courseinfo['coursename']."》";
   $filename =$courseinfo['term']."-".$courseinfo['jsxm']."-".$courseinfo['cname']."-《".$courseinfo['coursename']."》";
   //任务总数量
    $num=$list = $Model->where("a.scid=$scid")->count();
   //任务列表
   $data = $Model->field("a.scid,a.peid,a.title,a.desc,a.filename,a.url,a.status,a.pubtime,a.isrec")->where("a.scid=$scid and a.status!=0")->order('a.pubtime ASC')->select();
    
    //引入PHPExcel
    import('Class.PHPExcel',APP_PATH); 
    require APP_PATH.'Class/PHPExcel/Writer/Excel2007.php' ; //xlsx格式  
    $objPHPExcel = new PHPExcel();
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //xlsx格式 

    //设置宽度
    //$objPHPExcel->getActiveSheet()->getColumnDimension()->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(24);  
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(16);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(16);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
 
    //设置行高度
    $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
    $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(32);
    $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(32);
  
    //设置字体大小
    $objPHPExcel->getActiveSheet()->getStyle('A1:G3')->getFont()->setName('Microsoft YaHei');
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
    $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(12);
    $objPHPExcel->getActiveSheet()->getStyle('A1:G3')->getFont()->setBold(true);
  
    $objPHPExcel->getActiveSheet()->getStyle('A1:G3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A1:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    //设置水平居中
    $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   //设置垂直居中
    $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    //合并
    $objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
    $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
    //设置表格头部内容

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $title);

    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '任务ID');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '任务题目');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', '发布时间');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', '发布人数');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', '完成人数');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', '完成率');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', '未完成人员名单');

    //将数据库中的数据转码 UTF-8
    //p($data);die;
    $totalpub=0;$totalok=0;//统计任务总数和完成总数
    for($i=0;$i<count($data);$i++) {
        //如果是从数据库中读取的数据，需要对数据进行转码操作，convertUTF8($str)
        $objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 4), $data[$i]['peid']." ");
        $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 4), $data[$i]['title']);
       
        $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 4), date('Y-m-d H:i:s',$data[$i]['pubtime']));
        //计算发布人数和完成人数
        $peid=$data[$i]['peid'];
        $subtotalnum=M('sxsubexcise')->where("peid=$peid")->count();
        $suboknum=M('sxsubexcise')->where("peid=$peid and status=1")->count();
        $totalpub = $totalpub + $subtotalnum;
        $totalok = $totalok + $suboknum;
        $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 4), $subtotalnum);
        $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 4), $suboknum);

        $completeness = round($suboknum/$subtotalnum,4)*100;
        $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 4), $completeness."%");

//未完成任务的学生名单$xsxms
        $subnoxs=M('sxsubexcise as a')->join("xh_student as b on a.xsno=b.xsno")->field('b.xsxm')->where("peid=$peid and status=0")->select();
        $xsxms='';

        for($j=0;$j<count($subnoxs);$j++){
          $xsxms .= $subnoxs[$j]['xsxm'].' ';
        }

        $objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 4),$xsxms);
        $objPHPExcel->getActiveSheet()->getRowDimension($i + 4)->setRowHeight(32); 

    }
    
    //用于第2行的统计
    $totalRes = "教师发布任务:" . $i."个　　共发布学生:". $totalpub ."人　　学生共提交:". $totalok ."个　　最终完成率为:". (round($totalok/$totalpub,4)*100) ."%(完成人数/发布人数)　　统计时间:".date("Y-m-d H:i:s"); 
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', $totalRes);

    // 设置工作表名
    $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
    $objPHPExcel->setActiveSheetIndex(0); 
    //支持xls和xlsx格式
    $outputFileName = $filename.".xlsx";
    
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

//对该门课程的所有任务和学生作业打包成zip文件下载
public function sxcoursePackage(){
    $scid = (int)$_GET['scid'];//课程id
    $filepaths = M('sxpubexcise')->field('url')->where("scid=$scid")->select();//该课程的所有任务地址(多个)

    $courseinfo = M('sxsetcourse')->field('coursename')->find($scid);//在课程表获取该课程的信息
    $coursename = $courseinfo['coursename'];//课程名称
    import('Class.Pinyin',APP_PATH);//引入中英文转换类
    $py = new PinYin();
    $coursenamepinyin = $py->getAllPY($coursename);//将中文的课程名称转换为拼音
  
    $zippath = "./Public/ExcisetempZIP/";//定义存放打包文件的路径
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
    if($scid==0){
        $this->error('请选择课程查看任务！');
    }
    $Model=M('sxpubexcise as a');
    $courseinfo = M('sxsetcourse as a')->join("xh_classes as b on a.ccode = b.ccode")->field("a.scid,b.cname,a.coursename,a.term")->where("a.scid=$scid")->find();
    $num=$Model->where("a.scid=$scid")->count();
    $list = $Model->field("a.scid,a.peid,a.title,a.desc,a.filename,a.url,a.status,a.isrec,a.pubtime,a.isrec")->where("a.scid=$scid")->order('a.pubtime ASC')->select();

//大文件下载提供拷贝地址
    $peids = $Model->field("a.url")->where("a.scid=$scid")->order('a.pubtime ASC')->select();
    //根路径：如：C:\wamp64\www\xsgl\
    $filepath =  dirname(__FILE__);
    $str = explode('\\',$filepath);
    $rooturl = '';
    for($i=0;$i<count($str)-4;$i++){
       $rooturl .= $str[$i].'/';
    }
    $rooturl = str_replace('/','\\',$rooturl);
    //相对路径：如：Public\Excise\2017-2018-1\GS-guosheng\jisuanjiyingyongjichu\
    $peidurl=array();
    for($i=0;$i<count($peids);$i++){
       $tempurl = $peids[$i]['url'];
       if($tempurl!=''){
          $tempurl = explode('/',$tempurl);
          for($j=1;$j<count($tempurl)-1;$j++){
             $peidurl[$i] .= $tempurl[$j].'\\';
          }
          // 完整路径如：
          // ﻿C:\wamp64\www\xsgl\Public\Excise\2017-2018-1\GS-guosheng\jisuanjiyingyongjichu\    
          $url[$i] = trim($rooturl.$peidurl[$i]);
          
       }else{
          $url[$i] = '';
       }
    }

    $this->assign('url',$url);
    $this->assign('courseinfo',$courseinfo);
    $this->assign('num',$num);
    $this->assign('list',$list);
    $this->display();
}

//添加和指定课程的任务 
public function sxpubexciseSave(){   
  if(!empty($_POST)){
      $title=trim($_POST['title']);
      $desc= trim($_POST['desc']);
      $isup= trim($_POST['isup']);
      $file = $_FILES['file_upload'];
      //输入验证
      if($title==""){
          $this->error("请输入任务标题！");
      }
      if($desc==""){
          $this->error("请输入任务描述！");
      }
      if($isup==1){
          if($file['name']==""||$file['error']==4){
            $this->error("任务附件必须上传！");
          }
      }
      
      if($file['size']>102400000){
          $this->error("附件大小不能超过100MB！");
      }
   
       //上传附件
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
      $coursenamepinyin = $py->getAllPY($coursename);//将中文的课程名称转换为拼音
      //定义上传文件的路径,该路径还用于学生作业上交
      $js=$jsno.'-'.$jsxmpinyin;
      $uptime=date("YmdHis");
      session('uptime',$uptime);//用于定义教师上传附件的名称（决定先后次序）
      $filepath="./Public/Excise/".$term."/".$js."/".$coursenamepinyin."/".$uptime."/";
      //准备保存数据
      $data['scid']=$scid;
      $data['title']=$title;
      $data['desc']=$desc;
      $data['url']=$filepath;
      $data['pubtime']=time();
      //echo $filepath;die;
      if($isup==1){//有附件，上传获取文件名
          if (!empty($_FILES)) {
              import('ORG.Net.UploadFile'); //载入TP上传类
              $uploadfile = new UploadFile();
              $uploadfile->uploadReplace=true;//允许同名文件覆盖
              $uploadfile->saveRule ='definefilename';  //文件命名自定义：在functon里面定义
              if($info = $uploadfile->uploadOne($file,$filepath)){ //上传成功
                   $filename=$info[0]['savename']; 
                  //准备保存数据
                  $data['filename']=$filename;
              }else{
                 $this->error("任务附件上传失败!");
              }
          }
      }else{//没有附件
         $data['filename']='';
         mkdir($filepath,0777,true);
      }
      if(M('sxpubexcise')->add($data)){
          $this->success("任务添加成功！",U(GROUP_NAME."/Excise/sxpubexciseList",array('scid'=>$scid)));
      }else{
          $this->error("任务添加失败!");
      }
  	      
  }else{
        //发布任务视图
        $scid = (int)$_GET['scid'];
        if($scid==0){
            $this->error('请选择课程添加任务！');
        }
        
        $coursename = M('sxsetcourse as a')->join("xh_teacher as b on a.jsno=b.jsno")->field('a.coursename,b.jsxm')->where("a.scid = $scid")->find();

        $this->assign('coursename',$coursename['coursename']);
        $this->assign('jsxm',$coursename['jsxm']);
        $this->assign('scid',$scid);
        $this->display();
  } 
}


//任务克隆
public function sxpubexciseClone(){//克隆视图
    if($_POST['scidlist'] || !empty($_POST['peid'])){
        //scid是想要克隆任务的课程id
        //提供克隆任务的课程id为scidlist
        $scid= session('scid');
        
        if($_POST['scidlist']){ //提交查询
           //查询继续显示
           $course=M('sxsetcourse as a')->join('xh_teacher as b on a.jsno=b.jsno')->join('xh_classes as c on a.ccode=c.ccode')->where("scid=$scid")->field('a.scid,a.coursename,a.term,b.jsxm,b.jsno,c.ccode,c.cname')->find();//当前等待克隆任务的课程信息
           $jsno = $course['jsno'];
           $courseother=M('sxsetcourse as a')->join('xh_classes as b on a.ccode=b.ccode')->where("a.jsno='$jsno' and a.scid <> $scid")->field('a.scid,a.coursename,a.term,b.cname')->select();//
           $this->assign('courseother',$courseother);//提供克隆的课程
           //显示查询结果
           $scidlist = $_POST['scidlist'];
           $publist = M('sxpubexcise')->where("scid=$scidlist")->order('peid ASC')->select();
           $this->assign('scidlist',$scidlist);
           $this->assign('publist',$publist);
		   //print_r($publist);
           $this->assign('scid',$scid);
           //echo "search:".$scid;
           $this->display();
       }
       if(!empty($_POST['peid'])){//提交选择的任务并克隆
        //查询提交过来的任务
            $peids=array();
            $i=0;
            foreach($_POST['peid'] as $k => $v) {
               $peids[$i++]=$v;
            }
            $where['peid']=array('in',$peids);
            $pubexcises=M('sxpubexcise')->where($where)->select();//提交过来的
            $oldpubexcises=M('sxpubexcise')->where("scid=$scid")->select();//原先的
            //p($pubexcises);
        //生成文件保存路径
            $course = session('course');//原课程信息
            import('Class.Pinyin',APP_PATH);//引入中英文转换类
            $py = new PinYin();
            $jsxmpinyin = $py->getAllPY($course['jsxm']);//将中文的教师姓名转换为拼音
            $coursenamepinyin = $py->getAllPY($course['coursename']);//将中文的课程名称转换为拼音
            //定义上传文件的路径,该路径还用于学生作业上交
            $js=$course['jsno'].'-'.$jsxmpinyin;
            //$filepath="./Public/Excise/".$course['term']."/".$js."/".$coursenamepinyin."/".time()."/";
            $filepathprev="./Public/Excise/".$course['term']."/".$js."/".$coursenamepinyin."/";

        //处理的数据
            $data=array();
            import('Class.FileUtil',APP_PATH);//引入中英文转换类
            $num=0;//符合条件的任务
            for($i=0;$i<count($pubexcises);$i++){
                $index=0;
                for($j=0;$j<count($oldpubexcises);$j++){
                    if($pubexcises[$i]['title'] != $oldpubexcises[$j]['title']){
                        $index++;
                    }
                }
                //echo "j=".$j.",index=".$index;
                if($j==$index){//说明被克隆的任务在原任务列表中不存在，则执行克隆
                    $data[$num]['scid']=$scid;
                    $data[$num]['title']=$pubexcises[$i]['title'];
                    $data[$num]['desc']=$pubexcises[$i]['desc'];
                    //定义新路径和文件名
                    $newurl=$filepathprev.date("YmdHis")."-".$pubexcises[$i]['peid'].rand(1000,9999)."/";
                    $oldurl=$pubexcises[$i]['url'];
                    $filename=$pubexcises[$i]['filename'];
                    //如：/Public/Excise/2017-2018-1/GS-guosheng/jisuanjiyingyongjichu/20170915130417-21025/20170914104016_JS_guosheng.txt
                   
                    //echo "<hr/>";
                    if($filename!=''){//存在文件则复制，复制时自动创建文件夹
                       $newfile=$newurl.$filename;//echo "<br/>";
                       $oldfile=$oldurl.$filename;
                       FileUtil::copyFile($oldfile,$newfile);
                    }else{ //不存在则创建文件夹
                       mkdir($newurl,0777,true);
                    }

                    $data[$num]['url']=$newurl;
                    $data[$num]['filename']=$filename;
                    $data[$num]['status']=0;
                    $data[$num]['pubtime']=time();
                    $num++;
                }   
            }
            //p($data);die;
            if($num<=0){
                $this->success("任务已存在，无需克隆！",U(GROUP_NAME."/Excise/sxpubexciseList",array('scid'=>$scid)));
            }else{
                if(M('sxpubexcise')->addAll($data)){
                    $this->success("克隆任务成功！",U(GROUP_NAME."/Excise/sxpubexciseList",array('scid'=>$scid)));
                }else{
                    $this->error("克隆任务失败！");
                }
            }  
       }
    }else{
         $scid =$_GET['scid'];
         $course=M('sxsetcourse as a')->join('xh_teacher as b on a.jsno=b.jsno')->join('xh_classes as c on a.ccode=c.ccode')->where("scid=$scid")->field('a.scid,a.coursename,a.term,b.jsxm,b.jsno,c.ccode,c.cname')->find();//当前等待克隆任务的课程信息
         $jsno = $course['jsno'];
         session('course',$course);//用于克隆提价的任务时生成路径等
         $courseother=M('sxsetcourse as a')->join('xh_classes as b on a.ccode=b.ccode')->where("a.jsno='$jsno' and a.scid <> $scid")->field('a.scid,a.coursename,a.term,b.cname')->select();//当前提供克隆任务的课程列表
         //p($courseother);
         session('scid',$scid);
         $this->assign('scid',$scid);
         $this->assign('course',$course);//目标课程
         $this->assign('courseother',$courseother);//提供克隆的课程
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

//补充学生到subexcise
public function sxsubexciseaddStu(){
   $peid = (int)$_GET['peid'];
   $scid = (int)$_GET['scid'];
   //已经接收任务的学生名单
   $xsnos = M('sxsubexcise')->field('xsno')->where("peid=$peid")->select();
   $okxs=array();
   foreach($xsnos as $k=>$v){
      $okxs[]=$v['xsno'];
   }
  
   $where['xsno']=array('not in',$okxs);
    
   //查询新增的没有接收任务的学生
   $ccode = M('sxsetcourse')->field('ccode')->find($scid);
   $ccode=$ccode['ccode'];
   //echo $ccode;die;
   $addxsnos = M('student')->field("xsno")->where("ccode = $ccode")->where($where)->order('xsno ASC')->select();
    $excise =array();
    for($i=0;$i<count($addxsnos);$i++){
        $excise[$i]=array(
            'peid'=>$peid,
            'xsno'=>$addxsnos[$i]['xsno'],
        );
    }
    if(count($addxsnos)>0){
        $res=M('sxsubexcise')->addAll($excise);
        //echo $res;die;
        if($res!==false){
            $this->success("成功补充 ".count($addxsnos)." 个学生！",U(GROUP_NAME."/Excise/sxsubexciseList",array('peid'=>$peid)));
        }else{
            $this->error('补充学生失败！');
        }
    }else{
         $this->error('该班无新增学生！');
    }
}

//下载教师发布的任务的附件
public function sxpubexciseDownAttach(){
    $peid = (int)$_GET['peid'];
    $attach = M('sxpubexcise')->find($peid);
    $filepath = $attach['url'];
    $filename = $attach['filename'];
    if($filename==""){
        $this->error("任务附件不存在！");
    }
    
    downAttach($filepath,$filename);
}
//删除教师发布的任务
public function sxpubexciseDel(){
   $peid = (int)$_POST['peid'];
   //检查学生是否已提交作业
   $resc=M('sxsubexcise')->where("peid=$peid")->count();
   if($resc>0){
       show(0,"请看操作提示按要求删除！");
   }else{
       //删除附件
       $attach = M('sxpubexcise')->field('url,filename')->find($peid);
       $filename = $attach['filename'];
       $filepath = $attach['url'];
       if($filename!=''){            
            $file = $filepath.$filename;
            unlink($file);
            rmdir($filepath);
       }else{
            rmdir($filepath);
       }
       $res=M('sxpubexcise')->delete($peid);
       if($res){
           $res2=M('xh_sxdisexicise')->where("peid=$peid")->delete();//删除讨论
            $scid = (int)$_POST['scid']; //返回去用于页面跳转
            $url = U(GROUP_NAME."/Excise/sxpubexciseList",array('scid'=>$scid));
            show(1,"删除任务成功！",$url);
       }else{
            show(0,"删除任务失败！");
       }
   } 
}

//对该门课程的指定任务和学生作业打包成zip文件下载
public function sxexcisePackage(){
    $peid = (int)$_GET['peid'];//任务id
     
    $exciseurl = M('sxpubexcise')->field('url')->find($peid);//获取该任务url

    $zippath = "./Public/ExcisetempZIP/";//定义存放打包文件的路径
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
    $courseinfo =M('sxsetcourse')->find($excisedesc['scid']);//课程和学期
    $ccode = $courseinfo['ccode'];
    $classes =M('classes')->where("ccode='$ccode'")->field("cname")->find();//班级名称
   
    $this->assign('courseinfo',$courseinfo);
    $this->assign('excisedesc',$excisedesc);
    $this->assign('classes',$classes);
    //查询学生作业完成情况
    $exciselist=M('sxsubexcise as a')->join('xh_student as b on a.xsno=b.xsno')->where("a.peid=$peid")->field("a.seid,a.xsno,b.xsxm,a.desc,a.filename,a.status,a.subtime,a.peid,a.isrec")->order('a.status DESC,a.xsno ASC')->select();
//显示文件大小   
    //根路径：如：C:\wamp64\www\xsgl\
    // $filepath =  dirname(__FILE__);
    // $str = explode('\\',$filepath);
    // $rooturl = '';
    // for($i=0;$i<count($str)-4;$i++){
    //    $rooturl .= $str[$i].'/';
    // }
    //$rooturl = trim(str_replace('/','\\',$rooturl));
   
    //相对路径：如：Public\Excise\2017-2018-1\GS-guosheng\jisuanjiyingyongjichu\
    $peidurl = $excisedesc['url']; 
    // if($excisedesc['url']!=''){
    //   $tempurl = explode('/',$excisedesc['url']);
    //   for($j=1;$j<count($tempurl)-1;$j++){
    //      $peidurl .= $tempurl[$j].'/';
    //   }    
    //   $peidurl = trim($peidurl);
    // }else{
    //   $peidurl = '';
    // }
    $oldurl=$peidurl; //用于计算文件大小
    //$newurl=str_replace('/','\\',$rooturl.$oldurl);//用于拷贝
    
    $this->assign('oldurl',$oldurl);
    //$this->assign('newurl',$newurl);//由于学生上交文件限制为100MB 所以该变量暂时不会被用到
    
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
    $data=M('sxsubexcise as a')->join('xh_student as b on a.xsno=b.xsno')->where("peid=$peid")->field("a.seid,a.xsno,b.xsxm,a.desc,a.status,a.subtime,a.peid,a.isrec")->order('a.status DESC,a.xsno ASC')->select();
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

//教师评价
public function sxsubexciseIsrecpj(){
    $seid=(int)$_POST['seid'];
    $isrec=$_POST['isrec'];
    $data=array('seid'=>$seid,'isrec'=>$isrec);
    $res=M('sxsubexcise')->save($data);
}//教师评价

//在学生交流页面是否允许其他人下载已提交的作业
public function sxsubexciseIsrec(){
    $peid=(int)$_GET['peid'];
    $scid = M('sxpubexcise')->field('scid')->find($peid);
    $scid = $scid['scid'];//用于成功返回
    $isrec = M('sxpubexcise')->field('isrec')->find($peid);
    $isrec = $isrec['isrec'];
    //echo "peid--".$peid.",scid--".$scid.",isrec--".$isrec;die;
    if($isrec==0){
       $data=array('peid'=>$peid,'isrec'=>1);
       if(M('sxpubexcise')->save($data)){
          $this->success("允许下载别人作业!$scid",U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$scid)));
       }
       
    }else{
       $data=array('peid'=>$peid,'isrec'=>0);
       if(M('sxpubexcise')->save($data)){
          $this->success("禁止下载别人作业!$scid",U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$scid)));
       }
       
    }
}
//评论列表
public function sxexciseDiscuss(){
    $peid = (int)$_GET['peid'];
    //查询任务描述
    $excisedesc = M('sxpubexcise')->find($peid);//任务
    //课程和学期
    $courseinfo =M('sxsetcourse')->find($excisedesc['scid']);
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

    $tea = session('tea');
    $userxm = $tea['jsxm']; //评论人员姓名
    $this->assign('userxm',$userxm);

    //查询当前讨论情况
    $discuss=M('sxdisexicise')->where("peid=$peid")->order("peid ASC, deid ASC")->select();
    $num=M('sxdisexicise')->where("peid=$peid")->count();

    $discuss = unlimitedForLevel($discuss,"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",0);
    $this->assign('num',$num);
    $this->assign('discuss',$discuss);
    $this->assign('peid',$peid);
    $this->display();
}
//添加评论
public function sxexciseDiscussSave(){
    if(!empty($_POST)){
        $peid= (int)$_POST['peid'];
        $content = $_POST['content'];
        if (empty($content)) {
           $this->error("评论内容不能为空！");
        }else{
            $data =array(
               'peid'=> $peid,
               'atuser'=>$_POST['atuser'],
               'content'=>$content,
               'userxm' =>$_POST['userxm'],
               'usertype'=>"教师",
               'distime'=>time(),
               'pdeid'=>$_POST['pdeid'], 
            );
            //p($data);die;
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
        $this->error("任务附件不存在！");
    }
  	downAttach($filepath,$filename);
}
//删除指定学生作业
public function sxsubexciseDel(){
    $seid = $_GET['seid'];
    $subexcise = M('sxsubexcise')->field('peid,filename')->find($seid);
    $peid = $subexcise['peid'];
    $filename = $subexcise['filename'];
    $url= M('sxpubexcise')->field('url')->find($peid);
    $path = $url['url'];
    if($filename!=''){
      $file = $path.$filename;
      unlink($file);//删除附件
    }
     
   if(M('sxsubexcise')->delete($seid)){
        $this->success('删除成功！',U(GROUP_NAME."/Excise/sxsubexciseList",array('peid'=>$peid)));
   }else{
        $this->error('删除失败！');
   }
}

//设置学生作业重做
public function sxsubexciseRedo(){
    $seid = $_GET['seid'];
    $subexcise = M('sxsubexcise')->field('peid,filename')->find($seid);
    $peid = $subexcise['peid'];
    $filename = $subexcise['filename'];
    $url= M('sxpubexcise')->field('url')->find($peid);
    $path = $url['url'];
    if($filename!=''){
      $file = $path.$filename;
      unlink($file);//删除附件
    }
	   $data = array(
			'seid'=>$seid,
			'desc' =>'',
			'filename'=>'',
      'subtime'=>0,
			'status'=>0,
			'isrec'=>''
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
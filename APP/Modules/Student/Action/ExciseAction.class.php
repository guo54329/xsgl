<?php
Class ExciseAction extends CommonAction {
//作业列表
public function sxsubexciseList(){

    $stu = session('stu');
    
    $xsno = $stu['xsno'];
    $Model = M('sxsubexcise as a');
    if($_POST['term']!='' && $_POST['coursename']!=''){//根据条件查询
        $term=$_POST['term'];
        $coursename=$_POST['coursename'];
        $num=$Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->join("xh_teacher as d on c.jsno=d.jsno")->where("xsno='$xsno' and c.term='$term' and c.coursename='$coursename'")->count();

        $list = $Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->join("xh_teacher as d on c.jsno=d.jsno")->where("xsno='$xsno' and c.term='$term' and c.coursename='$coursename'")->field("a.seid,a.status,a.filename as filea,a.desc,a.isrec,b.peid,b.title,b.filename,b.url,b.pubtime,c.coursename,c.term,d.jsxm,b.pubtime")->order("d.jsxm ASC,c.scid ASC,a.peid ASC")->select();
    }else{//查询所有,默认只显示当前学期的任务
        $termarr=M('term')->order('id DESC')->limit(1)->find();
        $term=$termarr['name'];
        $num=$Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->join("xh_teacher as d on c.jsno=d.jsno")->where("xsno='$xsno' and c.term='$term'")->count();

        $list = $Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->join("xh_teacher as d on c.jsno=d.jsno")->where("xsno='$xsno' and c.term='$term'")->field("a.seid,a.filename as filea,a.status,a.desc,a.isrec,b.peid,b.title,b.filename,b.url,b.pubtime,c.coursename,c.term,d.jsxm,b.pubtime")->order("c.term DESC,d.jsxm ASC,c.scid ASC,a.peid ASC")->select();
    }
    

    $ccode = $stu['ccode'];
	  //p($stu);
    getCourseinfor($ccode);//创建由学期联动课程查询的select
    $this->assign('num',$num);
    //p($list);
    $this->assign('list',$list);
    $this->display();
}
//学生作业提交处理
public function sxsubexciseDo(){

    if(!empty($_POST)){
        $desc =trim($_POST['desc']);
        if($desc=='0'){
          $this->error("请进行自我评价！");
        }
        
        //获取上传作业
        $file = $_FILES['file_upload'];

        if($file['name']==""){
            $this->error("请上传任务作业！");
        }
        if($file['size']>512000000){
            $this->error("附件不能超过500MB！");
        }

//注意：学生提交作业时使用的是任务附件的保存路径
//如果发布的任务没有附件，则相应没有文件保存路径，学生的作业也就没路径可以提交了，所以每次会提交失败。
//处理办法：教师发布任务时，必须发布附件(至少附件中的内容可以是任务表述或要求)
//
        $seid=$_POST['seid'];
        $peid=M('sxsubexcise')->field('peid')->find($seid);
        $peid = $peid['peid'];
		    session('peid',$peid);//用于上传文件定义
        $url = M('sxpubexcise')->field('url')->find($peid);
        $filepath=$url['url']; 
        //作业提交处理
        import('ORG.Net.UploadFile'); //载入TP上传类 
        $uploadfile = new UploadFile();
        $uploadfile->uploadReplace=true;//允许同名文件覆盖
        $uptime=date("YmdHis");
        session('uptime',$uptime);//用于定义教师上传附件的名称（决定先后次序）
        $uploadfile->saveRule ='definefilename'; 
        $info = $uploadfile->uploadOne($file,$filepath);
        if($info){ //上传成功
        
              $filename=$info[0]['savename']; 
              //准备保存数据
              $data=array(
              'seid'=>$seid,
              'desc'=>$desc,
              'filename'=>$filename,
              'status'=>1,
              'subtime'=>time(),
              );
              $id = M('sxsubexcise')->save($data);
              if($id>0){
                $this->success("作业提交成功！",U(GROUP_NAME."/Excise/sxsubexciseList"));
              }else{
                $this->error("作业提交失败！");
              }

        }else{
          $this->error("附件上传失败！");
        }
     
    }else{
        $seid=$_GET['seid'];
        $this->assign('seid',$seid);
        $this->display();
    }
}

//学生作业描述
public function sxsubexciseDesc(){
		//作业提交视图
		$seid = (int)$_GET['seid'];
		$Model = M('sxsubexcise as a');
    $dolist = $Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->where("xsno='$xsno'")->field("a.seid,b.peid,b.title,b.desc,b.filename,b.url,b.pubtime,c.coursename")->where("seid=$seid")->find();
    $this->assign('dolist',$dolist);
		$this->display();
}
 
 	public function sxsubexciseRedo(){
  //作业重做
     $seid = $_GET['seid'];
     $attach = M('sxsubexcise')->field('filename,peid')->find($seid);
     $peid = $attach['peid']; //用于返回
     $url=M('sxpubexcise')->field('url')->find($peid);
     $filepath = $url['url'];
     $filename = $attach['filename'];
     $file = $filepath.$filename;
     
     unlink($file);//删除附件
     $data = array(
      'seid'=>$seid,
      'desc' =>'',  //自我评价
      'filename'=>'',
      'status'=>0,
      'isrec'=>''   //教师评价
    );
     $res = M('sxsubexcise')->save($data);
     if($res){
      $this->success('设置成功，请重做！',U(GROUP_NAME."/Excise/sxsubexciseDesc",array('seid'=>$seid)));
     }else{
      $this->error('设置失败！');
     }
     
  }

  public function sxpubexciseDownAttach(){
	//下载教师发布的任务的附件
	    $peid = (int)$_GET['peid'];
	    $attach = M('sxpubexcise')->find($peid);
	    $filename = $attach['filename'];
	    $filepath = $attach['url'];
      if($filename==""){
        $this->error("任务附件不存在！");
      }
	    downAttach($filepath,$filename);
	}
  
  public function sxsubexciseDownAttach(){
  //下载作业
    $seid = $_GET['seid'];
    $attach = M('sxsubexcise')->field('peid,filename')->find($seid);
    $peid = $attach['peid']; //用于返回
    $url=M('sxpubexcise')->field('url')->find($peid);
    $filepath = $url['url'];
    $filename = $attach['filename'];
    if($filename==""){
        $this->error("作业文件不存在！");
    }
    downAttach($filepath,$filename);
  }
  
  //评论列表
  public function sxexciseDiscuss(){
        $peid = (int)$_GET['peid'];
        
        //查询任务描述
        $excisedesc = M('sxpubexcise')->find($peid);//任务
       //isrec是否允许下载他人的作业 0-不 1-可以
       
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
        $stu = session('stu');
        $userxm = $stu['xsxm'];
        $this->assign('userxm',$userxm);
        //查询当前讨论情况
        $discuss=M('sxdisexicise')->where("peid=$peid")->order("peid ASC, deid ASC")->select();
        $num=M('sxdisexicise')->where("peid=$peid")->count();
        $discuss = unlimitedForLevel($discuss,"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",0);

        $stu = session('stu');
        $userxm = $stu['xsxm']; //评论人员姓名
        $this->assign('userxm',$userxm);
        $this->assign('num',$num);
        $this->assign('discuss',$discuss);
        $this->assign('peid',$peid);
        //p($discuss);die;
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
                //$con=str_replace('/', '', $content);
                //$con=str_replace(':', '', $con);
                //$con=str_replace('.', '', $con);
                // if(checkword($con)==false){
                //     $this->error("文明发言！！");
                // }
                // p($con);die;
                $data =array(
                   'peid'=>$peid,
                   'atuser'=>$_POST['atuser'],
                   'content'=>$content,
                   'userxm' =>$_POST['userxm'],
                   'usertype'=>"学生",
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
}

?>
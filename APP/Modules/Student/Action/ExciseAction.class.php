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
        $list = $Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->join("xh_teacher as d on c.jsno=d.jsno")->where("xsno='$xsno' and c.term='$term' and c.coursename='$coursename'")->field("a.seid,a.status,a.desc,a.isrec,b.peid,b.title,b.filename,b.url,b.pubtime,c.coursename,c.term,d.jsxm,b.pubtime")->order("d.jsxm ASC,a.peid ASC")->select();
    }else{//查询所有
        
        $list = $Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->join("xh_teacher as d on c.jsno=d.jsno")->where("xsno='$xsno'")->field("a.seid,a.status,a.desc,a.isrec,b.peid,b.title,b.filename,b.url,b.pubtime,c.coursename,c.term,d.jsxm,b.pubtime")->order("c.term DESC,b.scid ASC,d.jsxm ASC,a.peid ASC")->select();
    }
    

    $ccode = $stu['ccode'];
	//p($stu);
    getCourseinfor($ccode);//创建由学期联动课程查询的select
    $this->assign('list',$list);
    $this->display();
}

//学生作业处理
public function sxsubexciseDo(){
    
  	if(!empty($_POST)){
        if($_POST['desc']==''){
          $this->error("请进行自我评价！");
        }
    		//作业提交处理
    		import('ORG.Net.UploadFile'); //载入TP上传类
        //获取上传作业
        $file = $_FILES['attach'];
        $fileext = explode('.',$file['name']);  
        $fileext = strtolower($fileext[count($fileext)-1]);
       
        $filedenyext = array('php','txt','html','htm');
        if(in_array($fileext, $filedenyext)){
          $this->error("上传附件格式不支持！");
        }
        if($file['size']>512000000){
          $this->error("附件不能超过500MB！");
        }

        $seid=$_POST['seid'];
        $peid=M('sxsubexcise')->field('peid')->find($seid);
        $peid = $peid['peid'];
        $url = M('sxpubexcise')->field('url')->find($peid);
        $filepath=$url['url'];  
        $uploadfile = new UploadFile();
        $uploadfile->saveRule ='definefilename'; 
        if($info = $uploadfile->uploadOne($file,$filepath)){ //上传成功
              $filename=$info[0]['savename']; 
              //准备保存数据
              $data=array(
              'seid'=>$_POST['seid'],
              'desc'=>$_POST['desc'],
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
    		//作业提交视图
    		$seid = (int)$_GET['seid'];
    		$Model = M('sxsubexcise as a');
          $dolist = $Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->where("xsno='$xsno'")->field("a.seid,b.peid,b.title,b.desc,b.filename,b.url,b.pubtime,c.coursename")->where("seid=$seid")->find();
          $this->assign('dolist',$dolist);
          //p($dolist);
    		$this->display();
  	}
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
      $this->success('设置成功，请重做！',U(GROUP_NAME."/Excise/sxsubexciseList",array('peid'=>$peid)));
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
	    downAttach($filepath,$filename);
	}
  
  public function sxsubexciseDownAttach(){
  //下载附件
    $seid = $_GET['seid'];
    $attach = M('sxsubexcise')->field('peid,filename')->find($seid);
    $peid = $attach['peid']; //用于返回
    $url=M('sxpubexcise')->field('url')->find($peid);
    $filepath = $url['url'];
    $filename = $attach['filename'];
    
    downAttach($filepath,$filename);
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
        $stu = session('stu');
        $userxm = $stu['xsxm'];
        $this->assign('userxm',$userxm);
        //查询当前讨论情况
        $discuss=M('sxdisexicise')->where("peid=$peid")->order("peid ASC, deid ASC")->select();
        
        $discuss = unlimitedForLevel($discuss,"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",0);

        $stu = session('stu');
        $userxm = $stu['xsxm']; //评论人员姓名
        $this->assign('userxm',$userxm);
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
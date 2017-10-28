<?php

Class IndexAction extends CommonAction {

	public function index()
	{
		//查询站点信息
		$g_site =M('site')->find(1);
		$this->assign("g_site",$g_site);

		//学员信息
		$stu = session('stu');
		$xsno = $stu['xsno'];
		$xsxm = $stu['xsxm'];
		$cname= $stu['cname'];

		//print_r($sname);die;
		$this->assign('xsno',$xsno);
		$this->assign('xsxm',$xsxm);
		$this->assign('cname',$cname);
		$this->display();
	}

	public function welcome()
	{
		//站点信息
		$g_site =M('site')->find(1);
		//框架及系统信息
		$sinfor = systemconf();
		//创建由学期联动课程查询的select
		$stu=session('stu');
		$ccode = $stu['ccode'];
    	getCourseinfor($ccode);
		//登录后的首页提示信息
		$wel = "您的身份是 <b>学生</b> ,欢迎使用".$g_site['title']."！";
		//待完成任务
		$stu = session('stu');
        $xsno = $stu['xsno'];
        $Model = M('sxsubexcise as a');
        $termarr=M('term')->order('id DESC')->find();
        $term=$termarr['name'];
        $num=$Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->join("xh_teacher as d on c.jsno=d.jsno")->where("xsno='$xsno' and a.status=0")->count();
        $list = $Model->join("xh_sxpubexcise as b on a.peid=b.peid")->join("xh_sxsetcourse as c on b.scid=c.scid")->join("xh_teacher as d on c.jsno=d.jsno")->where("xsno='$xsno' and a.status=0")->field("a.seid,a.status,a.desc,a.isrec,b.peid,b.title,b.filename,b.url,b.pubtime,c.coursename,c.term,d.jsxm,b.pubtime")->order("c.term DESC,d.jsxm ASC,c.scid ASC,a.peid ASC")->select();
	    $this->assign("wel",$wel);
	    $this->assign('sinfor',$sinfor);
	    $this->assign('num',$num);
	    $this->assign('list',$list);
		$this->display();

	}

	public function sysNews(){
		//pubtype=1 表示管理员->所有教师和学生，pubtype=3 表示管理员->所有学生 
		//pubtype=4 表示教师->学生（指定班级）
		$stu=session('stu');
        $ccode= $stu['ccode'];

        $num = M('news')->where("pubtype=1 or pubtype=3 or (pubtype=4 and ccode='$ccode')")->count();
		$news = M('news')->where("pubtype=1 or pubtype=3 or (pubtype=4 and ccode='$ccode')")->order('pubtime DESC')->select();
		//p($news);
		$this->assign('num',$num);
		$this->assign('news',$news);
		$this->display();

	}

	// public function logout()
	// {
	// 	# code...
	// 	session('stu',null);
	// 	redirect(__ROOT__);
		
	// }
}


?>
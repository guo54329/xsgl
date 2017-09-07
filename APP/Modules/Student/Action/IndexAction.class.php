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
		# code...
		$g_site =M('site')->find(1);
		$stu=session('stu');
		
		$wel = "您的身份是学生，欢迎使用".$g_site['title']."！";
		$this->assign("wel",$wel);
		$this->assign('stu',$stu);
		
		$this->display();
	}

	public function sysNews(){
		//pubtype=1 表示管理员->所有教师和学生，pubtype=3 表示管理员->所有学生 
		//pubtype=4 表示教师->学生（指定班级）
		$stu=session('stu');
        $ccode= $stu['ccode'];

        $num = M('news')->where("pubtype=1 or pubtype=3 or (pubtype=4 and ccode='$ccode')")->count();
		$news = M('news')->where("pubtype=1 or pubtype=3 or (pubtype=4 and ccode='$ccode')")->order('pubtime DESC')->select();
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
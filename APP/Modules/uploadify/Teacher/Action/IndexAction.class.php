<?php

Class IndexAction extends CommonAction {

	public function index()
	{
		//查询站点信息
		$g_site =M('site')->find(1);
		$this->assign("g_site",$g_site);

		//教师信息
		$tea = session('tea');
		$jsno = $tea['jsno'];
		$jsxm = $tea['jsxm'];
		$offname= $tea['offname'];
		
		//print_r($sname);die;
		$this->assign('jsno',$jsno);
		$this->assign('jsxm',$jsxm);
		$this->assign('offname',$offname);
		$this->display();
	}

	public function welcome()
	{
		# code...
		$g_site =M('site')->find(1);
		$tea=session('tea');

		$wel = "您的身份是教师，欢迎使用".$g_site['title']."！";
		$this->assign("wel",$wel);
		$this->assign('tea',$tea);
		$this->display();
	}

	// public function logout()
	// {
	// 	# code...
	// 	session('tea',null);
	// 	redirect(__ROOT__);
		
	// }
}


?>
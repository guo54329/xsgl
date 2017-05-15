<?php

//后台登录控制器
Class LoginAction extends Action {

	//登录页面视图
	Public function index(){
		$this->display();
	}

	//登录表单处理
	Public function  login(){
		
		if(!IS_POST)halt('页面不存在！');//判断是不是post过来的数据
		if(I('code','','strtolower')!=session('verify')){
			//$this->error('验证码错误！');
			show(0,"验证码错误！");
		}

		$stu=M('student')->where(array('xsno'=>$_POST['username'],'xsmm'=>$_POST['password']))->find();
		if($stu){
			$ccode = $stu['ccode'];
			$cname = M('classes')->where("ccode = '$ccode'")->field('cname')->find();
			$stu['cname']=$cname['cname'];
			$stu['logintime']=time();
			$stu['loginip'] = get_client_ip();
			session('stu',$stu);
			show(1,"登录成功！");
		}else{
			show(0,"用户名或密码错误！");
		}
	}

	 //登录前的处理：验证码函数
	Public function verify(){
		ob_clean();
		import('Class.Image',APP_PATH);
		Image::verify();	
	}

	//后台退出
 	Public function logout(){
 		//session_unset();
 		//session_destroy();
 		session('stu',null);
 		$this->redirect(GROUP_NAME.'/Login/index');
 		//redirect(__ROOT__);
 	}

   
}

?>
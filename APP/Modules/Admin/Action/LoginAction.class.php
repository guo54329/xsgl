<?php

//后台登录控制器
Class LoginAction extends Action {

	//登录页面视图
	Public function index(){
		$this->display();
	}

	//登录表单处理
	Public function  login(){
		//p($_POST);

		if(!IS_POST)halt('页面不存在！');//判断是不是post过来的数据
		 if(I('code','','strtolower')!=session('verify')){
		 	//$this->error('验证码错误！');
		 	show(0,"验证码错误！");
		 }

		$db=M('user');
		$user=$db->where(array('username'=>I('username')))->find();
		
		if(!$user || $user['password']!=I('password','','md5')){
			//$this->error('账号或密码错误！');
			show(0,"用户名或密码错误！");
		}

		if($user['lock'])show(0,"用户被锁定！");;

		//更新最近一次登录的时间和ip
		$data = array(
           'id' =>$user['id'],
           'logintime'=>time(),
           'loginip' =>get_client_ip()
		);
		$db->save($data);
		//session('uid',$user['id']);

		session(C('USER_AUTH_KEY'),$user['id']);//配置访问权限
		session('username',$user['username']);
		session('logintime',date('Y-m-d H:i:s',$user['logintime']));
		session('loginip',$user['loginip']);
		
		//如果登录用户是超级管理员
		if($user['username']==C('RBAC_SUPERADMIN')){
			session(C('ADMIN_AUTH_KEY'),true);
		}
		//读取用户权限
		import('ORG.Util.RBAC');
		RBAC::saveAccessList();
		//p($_SESSION);die;
		show(1,"登录成功！");
		//redirect(__GROUP__);//自动跳转到本分组
		//$this->redirect(GROUP_NAME.'/Index/index');

	}

	 //登录前的处理：验证码函数
	Public function verify(){
		ob_clean();
		// $data = ob_get_contents();
		// ob_clean();
		// var_dump($data);

		import('Class.Image',APP_PATH);
		Image::verify();
        //调用tp自带的验证类
		// import('ORG.Util.Image');
		// Image::buildImageVerify();
		
	}

	//后台退出
 	Public function logout(){
 		session_unset();
 		session_destroy();
 		$this->redirect(GROUP_NAME.'/Login/index');
 		//redirect(GROUP_NAME.'/Login/index');
 	}

   
}

?>
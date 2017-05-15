<?php

//管理员信息管理控制器
Class UserinforAction extends CommonAction {

	Public function index(){
		//p($_SESSION);die;
		$id = (int)$_SESSION['uid'];
		$user=M('user')->where("id=$id")->find();
		//p($user);
		$this->user=$user;
		$this->display();
	}

	Public function editUserpass(){
		if(!empty($_POST)){
			$id = (int)$_SESSION['uid'];
			$userpass=M('user')->field('password')->where("id=$id")->find();//获取原密码
			if($userpass['password']!=I('password','','md5')){
				//$this->error('原密码输入有误，请重试！');
				show(0,"原密码输入有误，请重试！");
			}

            
			$data=array('password'=>I('password2','','md5'));	
			if(M('user')->where("id=$id")->setField($data)){
				show(1,"修改密码成功！");
				//$this->success('修改密码成功！',U(GROUP_NAME."/Userinfor/index"));
			}else{
				show(0,"密码修改失败！");
				//$this->error('修改密码失败！');
			}
		}else{
			$this->display();
		}	
	}
}
?>
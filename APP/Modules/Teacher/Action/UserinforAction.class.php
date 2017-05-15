<?php

//管理员信息管理控制器
Class UserinforAction extends CommonAction {

	Public function editUserpass(){
		if(!empty($_POST)){
			$tea=session('tea');
			$id = $tea['id'];
			$userpass=M('teacher')->field('jsmm')->where("id=$id")->find();//获取原密码
			
			if($userpass['jsmm']!=$_POST['password']){
				//$this->error('原密码输入有误，请重试！');
				show(0,"原密码输入有误，请重试！");
			}

            
			$data=array('jsmm'=>$_POST['password2']);
			if(M('teacher')->where("id=$id")->setField($data)){
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
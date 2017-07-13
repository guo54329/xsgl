<?php

Class UserinforAction extends CommonAction {

	// Public function index(){
	// 	$stu=session('stu');
	// 	$this->stu=$stu;
	// 	$this->display();
	// }

	Public function editUserpass(){
		if(!empty($_POST)){
			$stu=session('stu');
			$id = $stu['id'];
			$userpass=M('student')->field('xsmm')->where("id=$id")->find();//获取原密码
			
			if($userpass['xsmm']!=$_POST['password']){
				//$this->error('原密码输入有误，请重试！');
				show(0,"原密码输入有误，请重试！");
			}

            
			$data=array('xsmm'=>$_POST['password2']);
			if(M('student')->where("id=$id")->setField($data)){
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
	public function userinfor()
	{

		$stu=session('stu');
		$this->assign('stu',$stu);
		$this->display();
	}
}
?>
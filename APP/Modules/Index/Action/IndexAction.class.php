<?php

class IndexAction extends CommonAction {

	//登录视图	
	public function index(){

		$this->display();
	}

	//用户登录验证
	public function login(){
		if(!IS_POST)$this->error('页面不存在！');//判断是不是post过来的数据
		$username = trim(I('username'));
		$password = trim(I('password'));
		if(!$username)$this->error('用户名不能为空！');
		if(!$password)$this->error('密码不能为空！');

		$dbtea=M('teacher');
		$dbstu=M('student');
		$tea=$dbtea->where(array('jsno'=>$username,'jsmm'=>$password))->find();
		$stu=$dbstu->where(array('xsno'=>$username,'xsmm'=>$password))->find();
        
		if($tea){
			
			$tea['logintime']=time();
			$tea['loginip'] = get_client_ip();
			session('tea',$tea);
			//print_r($tea);
			$this->success("登录成功！",U('Teacher/Index/index'));
			//$this->redirect('Teacher/Index/index');
		}
		elseif($stu){
			$ccode = $stu['ccode'];
			$cname = M('classes')->where("ccode = '$ccode'")->field('cname')->find();
			$stu['cname']=$cname['cname'];
			$stu['logintime']=time();
			$stu['loginip'] = get_client_ip();
			session('stu',$stu);
			//print_r($stu);
			$this->success("登录成功！",U('Student/Index/index'));
			//$this->redirect('Student/Index/index');
		}else{
			$this->error('用户名或密码错误！');
		}
		
	}

	//忘记密码
	public function fpass()
	{
		# code...
		if(!$_POST){
			$this->display();
		}else{
			//判断是不是post过来的数据
			$name = trim(I('name'));
			$zsxm = trim(I('zsxm'));
			if(!$name)$this->error('登录用户名不能为空！');
			if(!$zsxm)$this->error('真实姓名不能为空！');

			$dbtea=M('teacher');
			$dbstu=M('student');
			$tea=$dbtea->where(array('jsno'=>$name,'jsxm'=>$zsxm))->find();
			$stu=$dbstu->where(array('xsno'=>$name,'xsxm'=>$zsxm))->find();
	        //p($stu);
	        //p($tea);
			if($tea){
				$data=array('jsmm'=>'123456');
				$resetpass =M('teacher')->where("jsno='$name'")->setField($data);
				if($resetpass){
					$this->success('您的密码重置为123456，请登录后修改！',U(GROUP_NAME.'/Index/index'));
				}else{
					$this->error('从未修改过，何谈重置，请使用默认密码登录!');
				}
			}elseif($stu){
    			$data=array('xsmm'=>'123456');
				$resetpass =M('student')->where("xsno='$name'")->setField($data);
				if($resetpass){
					$this->success('您的密码重置为123456，请登录后修改！',U(GROUP_NAME.'/Index/index'));
				}else{
					$this->error('从未修改过，何谈重置，请使用默认密码登录!');
				}
			}else{
				$this->error('登录用户名或真实姓名输入有误！');
			}
		}
	}

	
}
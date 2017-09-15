<?php

//后台首页控制器
 Class IndexAction extends CommonAction {
 	
    //后台首页视图
 	Public function index(){
 	    $id = (int)$_SESSION['uid'];
 	    $this->assign('uid',$id);
 		$this->display();
 	}
 	//系统开发环境信息
 	public function infor(){
    		$sinfor = systemconf();
	    	$this->assign('sinfor',$sinfor);
	    	$this->display();
    }
 }


?>
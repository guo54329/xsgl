<?php

//后台首页控制器
 Class IndexAction extends CommonAction {
 	
    //后台首页视图
 	Public function index(){	
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
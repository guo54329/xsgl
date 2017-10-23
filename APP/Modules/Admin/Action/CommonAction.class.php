<?php

Class CommonAction extends Action{
	Public function _initialize(){
		
		if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->redirect(GROUP_NAME.'/Login/index');
		}

		// echo ACTION_NAME;die;
		$notAuth = in_array(MODULE_NAME, explode(',',C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')));

		if(C('USER_AUTH_ON') && !$notAuth){
			import('ORG.Util.RBAC');
			//var_dump(RBAC::AccessDecision(GROUP_NAME));
			RBAC::AccessDecision(GROUP_NAME) || $this->error('没有权限！');
		}

		//调用公共函数读物UE的json配置文件内容进行修改
		//configUeditorJson();
        
		//查询站点信息
		$g_site =M('site')->find(1);
		$this->assign("g_site",$g_site);

		$g_partment =M('site')->find(3);
		$this->assign("g_partment",$g_partment);

		//用户登录之后首页显示的用户名
		$this->assign("username",$_SESSION['username']);
		$this->assign("role",$_SESSION['role']);
		
	}
}

?>
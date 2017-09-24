<?php

class CommonAction extends Action {
	Public function _initialize(){
	

		//查询站点信息
		$g_site =M('site')->find(1);
		$this->assign("g_site",$g_site);

		$g_partment =M('site')->find(3);
		$this->assign("g_partment",$g_partment);
		
		
		
	}
}

?>
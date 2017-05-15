<?php

Class CommonAction extends Action{
	Public function _initialize(){
		
		if(!is_array(session('tea')) || session('tea')==null) {
			$this->error("您还没有登录,请先登录！",U(GROUP_NAME.'/Login/index'));
			//$this->redirect(GROUP_NAME.'/Login/index');
		}
		
	}
}

?>
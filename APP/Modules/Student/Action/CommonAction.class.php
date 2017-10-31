<?php

Class CommonAction extends Action{
	Public function _initialize(){
		
		if(!is_array(session('stu')) || session('stu')==null) {
			//$this->error("您还没有登录,请先登录！",__ROOT__);
			$this->error("您还没有登录,请先登录！",U(GROUP_NAME.'/Login/index'));
			//$this->redirect(GROUP_NAME.'/Login/index');
		}
		$stu = session('stu');
		$xsxm=$stu['xsxm'];
		$this->assign('xsxm',$xsxm);
		
	}
}

?>
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

		    //系统配置信息
		$sinfor = systemconf();
		//统计满意度
		$cfcmanyi=M('site')->where("id>3 and title=1")->count();
		$cmanyi=M('site')->where("id>3 and title=2")->count();
		$cbjmanyi=M('site')->where("id>3 and title=3")->count();
		$cbmanyi=M('site')->where("id>3 and title=4$cbmanyi")->count();

        $totle = $cfcmanyi+$cmanyi+$cbjmanyi+$cbmanyi;
        $fcmy = round($cfcmanyi/$totle,2);
        $my = round($cmanyi,2);
        $bjmy = round($cbjmanyi/$totle,2);
        $bmy = round($cbmanyi/$totle,2);

		$this->assign('fcmy',$fcmy);
		$this->assign('my',$my);
		$this->assign('bjmy',$bjmy);
		$this->assign('bmy',$bmy);

    	$this->assign('sinfor',$sinfor);
    	$this->display();
    }
    public function detail(){
    	$num =M('site')->where('id>3')->count();
    	$detail=M('site')->where('id>3')->select();
    	$this->assign('num',$num);
    	$this->assign('detail',$detail);
    	$this->display();
    }
 }


?>
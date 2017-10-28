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
        
        $Model = M('sxsetcourse as a');
        $courses = $Model->join('xh_classes as b on a.ccode = b.ccode')->field("a.scid,a.term,a.coursename,b.ccode,b.cname,c.jsxm")->join("xh_teacher as c on c.jsno=a.jsno")->order("a.term DESC,a.jsno ASC")->select();
        //p($courses);die;
//2、计算统计信息
        //php获取当日的开始和结束时间戳
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        //php获取本月起始时间戳和结束时间戳
        $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        $endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
        //获取最新学期
        $termarr=M('term')->order('id DESC')->limit(1)->find();
        $term=$termarr['name'];

//2-1发布的任务个数
        
        $todayexcisenum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("b.pubtime between $beginToday and $endToday")->count();
        
        $thimonthexcisenum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("b.pubtime between $beginThismonth and $endThismonth")->count();
        
        $thistermexcisenum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.term='$term'")->count();
        //累计任务数据
        $totalexcisenum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->count();

//2-2接收任务学生数
        $todaysturecnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("b.pubtime between $beginToday and $endToday")->count();
        
        $thismonthsturecnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("b.pubtime between $beginThismonth and $endThismonth")->count();
        
        $thistermsturecnum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.term='$term'")->count();
        
        $totalsturecnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->count();
//2-3提交作业学生数
        $todaystusubnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("c.status=1 and (b.pubtime between $beginToday and $endToday)")->count();
        
        $thismonthstusubnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("c.status=1 and (b.pubtime between $beginThismonth and $endThismonth)")->count();
        
        $thistermstusubnum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("c.status=1 and a.term='$term'")->count();
        
        $totalstusubnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("c.status=1")->count();
//2-4任务完成率(提交/接收)
        if($todaysturecnum>0){
            $todayfinish = (round($todaysturecnum / $todaysturecnum,4)*100)."%";
        }else{
            $todayfinish = "等待发布";
        }
        if($thismonthsturecnum>0){
            $thismonthfinish = (round($thismonthstusubnum / $thismonthsturecnum,4)*100)."%";
        }else{
            $todayfinish = "等待发布";
        }
        if($thistermsturecnum>0){
            $thistermfinish = (round($thistermstusubnum / $thistermsturecnum,4)*100)."%";
        }else{
            $thistermfinish = "等待发布";
        }
        if($totalsturecnum>0){
            $totalfinish = (round($totalstusubnum / $totalsturecnum,4)*100)."%";
        }else{
            $totalfinish = "等待发布";
        }
         
//2-5讨论板交流条数
        $todaydiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("b.pubtime between $beginToday and $endToday")->count();
        if($todaydiscussnum==0){
            $todaydiscussnum="等待发布";
        }
        
        $thismonthdiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("b.pubtime between $beginThismonth and $endThismonth")->count();
        if($thismonthdiscussnum==0){
            $thismonthdiscussnum="等待发布";
        }
        $thistermdiscussnum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.term='$term'")->count();
        if($thistermdiscussnum==0){
            $thistermdiscussnum="等待发布";
        }
        $totaldiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->count();
        if($totaldiscussnum==0){
            $totaldiscussnum="等待发布";
        }

        //发布任务个数
        $excisenum=array('todayexcisenum'=>$todayexcisenum,'thismonthexcisenum'=>$thimonthexcisenum,'thistermexcisenum'=>$thistermexcisenum,'totalexcisenum'=>$totalexcisenum);
        //接收任务的学生人数
        $sturecnum=array('todaysturecnum'=>$todaysturecnum,'thismonthsturecnum'=>$thismonthsturecnum,'thistermsturecnum'=>$thistermsturecnum,'totalsturecnum'=>$totalsturecnum);
        //提交任务的学生人数
        $stusubnum=array('todaystusubnum'=>$todaystusubnum,'thismonthstusubnum'=>$thismonthstusubnum,'thistermstusubnum'=>$thistermstusubnum,'totalstusubnum'=>$totalstusubnum);
        //任务完成率(提交/接收)
        $excisefinish=array('todayfinish'=>$todayfinish,'thismonthfinish'=>$thismonthfinish,'thistermfinish'=>$thistermfinish,'totalfinish'=>$totalfinish);
        //讨论区交流条数
        $discussnum=array('todaydiscussnum'=>$todaydiscussnum,'thismonthdiscussnum'=>$thismonthdiscussnum,'thistermdiscussnum'=>$thistermdiscussnum,'totaldiscussnum'=>$totaldiscussnum);
        
        $this->assign('courses',$courses);

        $this->assign('excisenum',$excisenum);
        $this->assign('sturecnum',$sturecnum);
        $this->assign('stusubnum',$stusubnum);
        $this->assign('excisefinish',$excisefinish);
        $this->assign('discussnum',$discussnum);

//系统配置信息
		$sinfor = systemconf();
// 登录后首页提示信息
        $g_site =M('site')->find(1);
        $wel = "您的身份是 <b>".$_SESSION['role']."</b> ,欢迎使用".$g_site['title']."！";

//统计满意度
		$cfcmanyi=M('site')->where("id>3 and title=1")->count();
		$cmanyi=M('site')->where("id>3 and title=2")->count();
		$cbjmanyi=M('site')->where("id>3 and title=3")->count();
		$cbmanyi=M('site')->where("id>3 and title=4")->count();

        $totle = $cfcmanyi+$cmanyi+$cbjmanyi+$cbmanyi;
        $fcmy = round($cfcmanyi/$totle,2);
        $my = round($cmanyi/$totle,2);
        $bjmy = round($cbjmanyi/$totle,2);
        $bmy = round($cbmanyi/$totle,2);

		$this->assign('fcmy',$fcmy);
		$this->assign('my',$my);
		$this->assign('bjmy',$bjmy);
		$this->assign('bmy',$bmy);

        $this->assign("wel",$wel);
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
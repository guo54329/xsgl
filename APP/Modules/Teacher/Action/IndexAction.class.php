<?php

Class IndexAction extends CommonAction {

	public function index()
	{
		//查询站点信息
		$g_site =M('site')->find(1);
		$this->assign("g_site",$g_site);

		//教师信息
		$tea = session('tea');
		$jsno = $tea['jsno'];
		$jsxm = $tea['jsxm'];
		$offname= $tea['offname'];
		
		//print_r($sname);die;
		$this->assign('jsno',$jsno);
		$this->assign('jsxm',$jsxm);
		$this->assign('offname',$offname);
		$this->display();
	}

	public function welcome()
	{
		//登录后首页提示信息
		$g_site =M('site')->find(1);
		$wel = "您的身份是 <b>教师</b> ,欢迎使用".$g_site['title']."！";
		//框架及系统信息
		$sinfor = systemconf();
		//任务方面数据准备
		//1、$courses提供添加和查看任务时所用的数据：学期-课程-班级选择
		$tea = session('tea');
	    $jsno = $tea['jsno'];
	    $Model = M('sxsetcourse as a');
		$courses = $Model->join('xh_classes as b on a.ccode = b.ccode')->where("a.jsno='$jsno'")->field("a.scid,a.term,a.coursename,b.ccode,b.cname")->order("a.scid DESC")->select();
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
		
		$todayexcisenum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.jsno='$jsno' and (b.pubtime between $beginToday and $endToday)")->count();
		
		$thimonthexcisenum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.jsno='$jsno' and (b.pubtime between $beginThismonth and $endThismonth)")->count();
		
		$thistermexcisenum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.jsno='$jsno' and a.term='$term'")->count();
		//累计任务数据
		$totalexcisenum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.jsno='$jsno'")->count();

//2-2接收任务学生数
		$todaysturecnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.jsno='$jsno' and (b.pubtime between $beginToday and $endToday)")->count();
		
		$thismonthsturecnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.jsno='$jsno' and (b.pubtime between $beginThismonth and $endThismonth)")->count();
		
		$thistermsturecnum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.jsno='$jsno' and a.term='$term'")->count();
		
		$totalsturecnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.jsno='$jsno'")->count();
//2-3提交作业学生数
		$todaystusubnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.jsno='$jsno' and c.status=1 and (b.pubtime between $beginToday and $endToday)")->count();
		
		$thismonthstusubnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.jsno='$jsno' and c.status=1 and (b.pubtime between $beginThismonth and $endThismonth)")->count();
		
		$thistermstusubnum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.jsno='$jsno' and c.status=1 and a.term='$term'")->count();
		
		$totalstusubnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.jsno='$jsno' and c.status=1")->count();
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
		$todaydiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.jsno='$jsno' and (b.pubtime between $beginToday and $endToday)")->count();
		if($todaydiscussnum==0){
			$todaydiscussnum="等待发布";
		}
		
		$thismonthdiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.jsno='$jsno' and (b.pubtime between $beginThismonth and $endThismonth)")->count();
		if($thismonthdiscussnum==0){
			$thismonthdiscussnum="等待发布";
		}
		$thistermdiscussnum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.jsno='$jsno' and a.term='$term'")->count();
		if($thistermdiscussnum==0){
			$thistermdiscussnum="等待发布";
		}
		$totaldiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.jsno='$jsno'")->count();
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
		
		$this->assign("wel",$wel);
		$this->assign('sinfor',$sinfor);
		$this->assign('courses',$courses);

		$this->assign('excisenum',$excisenum);
		$this->assign('sturecnum',$sturecnum);
		$this->assign('stusubnum',$stusubnum);
		$this->assign('excisefinish',$excisefinish);
		$this->assign('discussnum',$discussnum);

		$this->display();
	}

}


?>
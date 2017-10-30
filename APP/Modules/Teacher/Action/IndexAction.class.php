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
//2-4任务完成率(学生提交/学生接收)
		if($todaysturecnum>0){
			$todayfinish = (round($todaystusubnum / $todaysturecnum,4)*100)."%";
			if($todaystusubnum==$todaysturecnum){
				$todayfinish="<span class='finishcolor'>".$todayfinish."</span>";
			}
		}else{
			$todayfinish = "暂无";
		}
		
		if($thismonthsturecnum>0){
			$thismonthfinish = (round($thismonthstusubnum / $thismonthsturecnum,4)*100)."%";
			if($thismonthstusubnum==$thismonthsturecnum){
				$thismonthfinish="<span class='finishcolor'>".$thismonthfinish."</span>";
			}
		}else{
			$thismonthfinish = "暂无";
		}

		if($thistermsturecnum>0){
			$thistermfinish = (round($thistermstusubnum / $thistermsturecnum,4)*100)."%";
			if($thistermstusubnum==$thistermsturecnum){
				$thistermfinish="<span class='finishcolor'>".$thistermfinish."</span>";
			}

		}else{
			$thistermfinish = "暂无";
		}

		if($totalsturecnum>0){
			$totalfinish = (round($totalstusubnum / $totalsturecnum,4)*100)."%";
			if($totalstusubnum==$totalsturecnum){
				$totalfinish="<span class='finishcolor'>".$totalfinish."</span>";
			}
		}else{
			$totalfinish = "暂无";
		}
//2-5文件个数和总大小
        //今日
        $todaynum=0;
        $todaysize=0;
        $todayfile=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.jsno='$jsno' and (b.pubtime between $beginToday and $endToday)")->field('url')->select();
		for($i=0;$i<count($todayfile);$i++){
			$tempnum=0;
        	$tempsize=0;
			$path=substr($todayfile[$i]['url'],0,-1);
			$res = readDirAndFile($path,$tempnum,$tempsize);
			$todaynum  += $res['totalnum'];
			$todaysize += $res['totalsize'];	
		}
		$todaysize = format_bytes($todaysize);
		
		//本月
		$thismonthnum=0;
        $thismonthsize=0;
        $thismonthfile=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.jsno='$jsno' and (b.pubtime between $beginThismonth and $endThismonth)")->field('url')->select();
		//获取文件夹中文件的文件名、大小和总数
		for($i=0;$i<count($thismonthfile);$i++){
			$tempnum=0;
        	$tempsize=0;
			$path = substr($thismonthfile[$i]['url'],0,-1);
			$res = readDirAndFile($path,$tempnum,$tempsize);
			$thismonthnum += $res['totalnum'];
			$thismonthsize += $res['totalsize'];
		}
		$thismonthsize=format_bytes($thismonthsize);
		//echo '本月：'.$thismonthnum.'--'.format_bytes($thismonthsize)."<hr/>";
		//本学期
		$thistermnum=0;
        $thistermsize=0;
		$thistermfile = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.jsno='$jsno' and a.term='$term'")->field('url')->select();
		for($i=0;$i<count($thistermfile);$i++){
			$tempnum=0;
        	$tempsize=0;
			$path = substr($thistermfile[$i]['url'],0,-1);
			$res = readDirAndFile($path,$tempnum,$tempsize);
			$thistermnum += $res['totalnum'];
			$thistermsize += $res['totalsize'];
		}
		$thistermsize=format_bytes($thistermsize);
		//echo "本学期：".$thistermnum.'--'.format_bytes($thistermsize)."<hr/>";


		//累计
		$totalnum=0;
        $totalsize=0;
		$totalfile=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.jsno='$jsno'")->field('url')->select();
		for($i=0;$i<count($totalfile);$i++){
			$tempnum=0;
        	$tempsize=0;
			$path = substr($totalfile[$i]['url'],0,-1);
			$res = readDirAndFile($path,$tempnum,$tempsize);
			$totalnum += $res['totalnum'];
			$totalsize += $res['totalsize'];
		}
		$totalsize=format_bytes($totalsize);
		//echo "累计：".$totalnum.'--'.format_bytes($totalsize)."<hr/>";
		
//2-6讨论板交流条数
		$todaydiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.jsno='$jsno' and (b.pubtime between $beginToday and $endToday)")->count();
		$thismonthdiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.jsno='$jsno' and (b.pubtime between $beginThismonth and $endThismonth)")->count();
		$thistermdiscussnum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.jsno='$jsno' and a.term='$term'")->count();
		$totaldiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.jsno='$jsno'")->count();
		

		//发布任务个数
		$excisenum=array('todayexcisenum'=>$todayexcisenum,'thismonthexcisenum'=>$thimonthexcisenum,'thistermexcisenum'=>$thistermexcisenum,'totalexcisenum'=>$totalexcisenum);
		//接收任务的学生人数
		$sturecnum=array('todaysturecnum'=>$todaysturecnum,'thismonthsturecnum'=>$thismonthsturecnum,'thistermsturecnum'=>$thistermsturecnum,'totalsturecnum'=>$totalsturecnum);
		//提交任务的学生人数
		$stusubnum=array('todaystusubnum'=>$todaystusubnum,'thismonthstusubnum'=>$thismonthstusubnum,'thistermstusubnum'=>$thistermstusubnum,'totalstusubnum'=>$totalstusubnum);
		//任务完成率(提交/接收)
		$excisefinish=array('todayfinish'=>$todayfinish,'thismonthfinish'=>$thismonthfinish,'thistermfinish'=>$thistermfinish,'totalfinish'=>$totalfinish);
		//文件个数和总大小
		$filenumandsize=array('todaynum'=>$todaynum,'todaysize'=>$todaysize,'thismonthnum'=>$thismonthnum,'thismonthsize'=>$thismonthsize,'thistermnum'=>$thistermnum,'thistermsize'=>$thistermsize,'totalnum'=>$totalnum,'totalsize'=>$totalsize);
		//讨论区交流条数
		$discussnum=array('todaydiscussnum'=>$todaydiscussnum,'thismonthdiscussnum'=>$thismonthdiscussnum,'thistermdiscussnum'=>$thistermdiscussnum,'totaldiscussnum'=>$totaldiscussnum);
		
		
		$this->assign("wel",$wel);
		$this->assign('sinfor',$sinfor);
		$this->assign('courses',$courses);

		$this->assign('excisenum',$excisenum);
		$this->assign('sturecnum',$sturecnum);
		$this->assign('stusubnum',$stusubnum);
		$this->assign('excisefinish',$excisefinish);
		$this->assign('filenumandsize',$filenumandsize);
		$this->assign('discussnum',$discussnum);

		$this->display();
	}

}


?>
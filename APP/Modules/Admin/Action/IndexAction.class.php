<?php

//后台首页控制器
 Class IndexAction extends CommonAction {
 	
    //后台首页视图
 	Public function index(){
 	    $id = (int)$_SESSION['uid'];
 	    $this->assign('uid',$id);
 		$this->display();
 	}
    //清除系统缓存文件包括Excise
    public function resetTEMP(){//系统缓存文件删除
        $temppath1 = "./Temp";
        delDirAndFile($temppath1);
        $temppath2 = "./Public/ExcisetempZIP";
        delDirAndFile($temppath2);
        $this->success('清空缓存成功！',U(GROUP_NAME.'/Index/index'));  
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
        $todayfile=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("b.pubtime between $beginToday and $endToday")->field('url')->select();
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
        $thismonthfile=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("b.pubtime between $beginThismonth and $endThismonth")->field('url')->select();
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
        //echo '本月：'.$thismonthnum.'--'.$thismonthsize."<hr/>";
        //本学期
        $thistermnum=0;
        $thistermsize=0;
        $thistermfile = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.term='$term'")->field('url')->select();
        for($i=0;$i<count($thistermfile);$i++){
            $tempnum=0;
            $tempsize=0;
            $path = substr($thistermfile[$i]['url'],0,-1);
            $res = readDirAndFile($path,$tempnum,$tempsize);
            $thistermnum += $res['totalnum'];
            $thistermsize += $res['totalsize'];
        }
        $thistermsize=format_bytes($thistermsize);
        //echo "本学期：".$thistermnum.'--'.$thistermsize."<hr/>";


        //累计
        $totalnum=0;
        $totalsize=0;
        $totalfile=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->field('url')->select();
        for($i=0;$i<count($totalfile);$i++){
            $tempnum=0;
            $tempsize=0;
            $path = substr($totalfile[$i]['url'],0,-1);
            $res = readDirAndFile($path,$tempnum,$tempsize);
            $totalnum += $res['totalnum'];
            $totalsize += $res['totalsize'];
        }
        $totalsize=format_bytes($totalsize);
        //echo "累计：".$totalnum.'--'.$totalsize."<hr/>";
        //        
//2-6讨论板交流条数
        $todaydiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("b.pubtime between $beginToday and $endToday")->count();
        $thismonthdiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("b.pubtime between $beginThismonth and $endThismonth")->count();
        $thistermdiscussnum = $Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->where("a.term='$term'")->count();
        $totaldiscussnum=$Model->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxdisexicise as c on b.peid=c.peid')->count();

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
        
        $this->assign('courses',$courses);

        $this->assign('excisenum',$excisenum);
        $this->assign('sturecnum',$sturecnum);
        $this->assign('stusubnum',$stusubnum);
        $this->assign('excisefinish',$excisefinish);
        $this->assign('filenumandsize',$filenumandsize);
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
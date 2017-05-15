<?php

Class SystemAction extends CommonAction {

    /*
    系统配置信息，如开发运行环境
     */
    public function systeminfor()
    {
    		$sinfor = systemconf();
	    	$this->assign('sinfor',$sinfor);
	    	$this->display();
    }	

	/*
	站点设置：站点标题、关键字、版权信息等
	 */
	public function site(){

		if(!empty($_POST)){

			//site1 网站基本信息
			$data=array(
				'title'=>$_POST['title'],
				'description'=>$_POST['description'],
				'keywords'=>$_POST['keywords'],
				'copyright'=>$_POST['copyright'],
				'icp'=>$_POST['icp'],
				'address'=>$_POST['address']
				);
			//site3  网站所属设置
			$data2=array(
				'description' => $_POST['departdesc'],
				'address' => $_POST['departaddr']

				);

			$id =M('site')->where("id=1")->save($data);
			$id2=M('site')->where("id=3")->save($data2);
			
			$this->success("站点设置成功！",U(GROUP_NAME."/System/site"));

		}else{
			$site = M('site')->find(1);
			$this->assign('site',$site);
			$this->display();
			
		}
	}

	
	/*
	验证码设置
	 */
	Public function verify(){ 
		if(!empty($_POST)){
			if(F('verify',$_POST,CONF_PATH)){
				$this->success('修改成功！',U(GROUP_NAME.'/System/verify'));
			}else{
				$this->error('修改失败,请修改'.CONF_PATH.'verify.php权限');	
			}
		}else{
			$this->display();
		}
		
	}

	/*
	系统重置
	 */
    public function reset(){ 
		if(!empty($_POST)){
			//p($_POST);
			$this->error('此功能暂时未实现！');
		}
		else{
			//对不影响系统本身使用的其他基础数据进行清空处理。
			//“学校xh_school”、“教师xh_teacher”、“班级xh_classes”、“学员xh_student”和“友情链接xh_link”、“留言板xh_discuss”、“新闻通知公告xh_newsnotice”
			//教师班级表xh_teacher_classes
			
			//先判断表是否为空，不为空则执行清空操作
			/*$count1 = M('school')->count();
			$count2 = M('teacher')->count();
			$count3 = M('classes')->count();
			$count4 = M('student')->count();
			$count5 = M('link')->count();
			$count6 = M('discuss')->count();
			$count7 = M('newsnotice')->count();
			$count8 = M('teacher_classes')->count();*/

			//$sql1="TRUNCATE `xh_school`";
			/*$sql2="TRUNCATE `xh_teacher`";
			$sql3="TRUNCATE `xh_classes`";
			$sql4="TRUNCATE `xh_student`";
			$sql5="TRUNCATE `xh_link`";
			$sql6="TRUNCATE `xh_discuss`";
			$sql7="TRUNCATE `xh_newsnotice`";
			$sql8="TRUNCATE `xh_teacher_classes`";
			$sql9="TRUNCATE `xh_courseresourse`";
			mysql_query($sql2);
			mysql_query($sql3);
			mysql_query($sql4);
			mysql_query($sql5);
			mysql_query($sql6);
			mysql_query($sql7);
			mysql_query($sql8);
			mysql_query($sql9);
			*/
		   $this->display();
			
			
		}
    }

    /**
     * 数据备份/恢复
     * @return [type] [description]
     */
    public function backup(){ 
    	import('Class.Dbbp',APP_PATH);
    	$x=new Dbbp();
        $x->host= C('DB_HOST'); 
        $x->user= C('DB_USER'); 
        $x->pwd= C('DB_PWD'); 
        $x->database= C('DB_NAME'); 
		$x->conn();     //连接数据库
        //p($_POST);
    	if(!empty($_POST)){ //处理
			if($_POST['bffilename']){
				//获取要备份的表名和文件名
				$pdata = I('post.');
			    
				$tablename = $pdata["tbl"];
				$filename  = $pdata["bffilename"];
				//echo "备份文件名：".$filename ;
				if($x->beifen($tablename,$filename)){
					$this->success("数据表备份成功！",U(GROUP_NAME."/System/backup"));
				}else{
					$this->error("数据表备份失败！");
				}
			}
			if($_POST['hffilename']){
				//获取要备份的表名和文件名
				$pdata = I('post.');
		        $filename =$pdata['hffilename'];
				//echo "恢复文件名：".$filename ;
				if($x->huanyuan($filename)){
					$this->success("数据恢复成功！",U(GROUP_NAME."/System/backup"));
				}else{
					$this->error("数据恢复失败！"); 
				}
			}	
			if($_POST['yh']){
				$sql="OPTIMIZE TABLE ".$_POST['tabname'];
				if(mysql_query($sql)){
					show(1,"数据库表已优化！");	
				}else{
					show(0,"请重试！");
				}
				
			}
    	}else{ //视图

    		//备份展示数据
    		$tbdesc=$x->tbdesc();
			//dump($tbdesc);
	    	$this->assign('tbdesc',$tbdesc);
            
            //回复展示数据
            //打开备份数据文件的目录，列出要恢复使用的备份文件
			$pathinfo= './DBback';   
			$openhandle= opendir($pathinfo);
			$filelist=scandir($pathinfo);           //列出指定路径中的文件和目录
			$files = array();
			$flag="您还没有备份过数据表，请先备份！";
			$j=0;
			for($i=count($filelist)-1;$i>=2;$i--){
				$tempfname=$filelist[$i];
				$tempfname = iconv('GB2312','UTF-8',$tempfname); //将文件名中的汉字转换为UTF-8编码形式，显示在UTF-8编码的页面
				$files[$j]=$tempfname;
				$j++;
			}
		    
			if(count($filelist)>=3){                  //由于存在.和..两个隐藏的系统文件，在此不计入文件范围
				$flag="";
			}
	    	$this->assign('files',$files);
			$this->assign('flag',$flag);
			
			//展示视图
			$this->display();			
    	}  
    }  
}
?>
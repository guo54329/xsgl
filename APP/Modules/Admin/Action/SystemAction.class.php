<?php

Class SystemAction extends CommonAction {
	
	/*
	站点设置：站点标题、关键字、版权信息等
	 */
	public function site(){

		if(!empty($_POST)){
            //上传网站图标
			if($_FILES['image']['tmp_name']){
				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
				$uploadfile->uploadReplace=true;//允许同名文件覆盖
				$upload->saveRule ='defineICON';
				$upload->allowExts  = array('png', 'PNG','ico','ICO');// 设置图片上传类型
				$upload->savePath =  './Data/';// 设置图片上传目录
				$upload->upload();
				//$info =  $upload->getUploadFileInfo();
				//p($info);
			}
            
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
			//p($_POST);die;
			if(F('verify',$_POST,CONF_PATH)){
				$this->success('修改成功！',U(GROUP_NAME.'/System/verify'));
			}else{
				$this->error('修改失败,请修改'.CONF_PATH.'verify.php权限');	
			}
		}else{
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
        $x->charset= C('DB_CHARSET'); 
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
			if($_POST['hf']){
		        $filename =$_POST['hffilename'];
				//echo "恢复文件名：".$filename ;
				if($x->huanyuan($filename)){
					$this->success("数据恢复成功！",U(GROUP_NAME."/System/backup"));
				}else{
					$this->error("数据恢复失败！"); 
				}
			}
			if($_POST['delbackup']){

				$pathinfo= './DBback/'; 
				$filename =$_POST['hffilename'];
				$filename = iconv("UTF-8", "GB2312", $filename);
				$file=$pathinfo.$filename;
				unlink($file);
				$this->success("文件删除成功！",U(GROUP_NAME."/System/backup"));
			}
			//上传备份文件
			if($_POST['upload']){

				import('ORG.Net.UploadFile');
				$upload = new UploadFile();// 实例化上传类
				$upload->saveRule ='definesqlfilename';
				$upload->allowExts  = array('sql', 'SQL');// 设置附件上传类型
				$upload->savePath =  './DBback/';// 设置附件上传目录
				if(!$upload->upload()) {// 上传错误提示错误信息
					$this->error($upload->getErrorMsg());
				}else{// 上传成功 获取上传文件信息
					//$info =  $upload->getUploadFileInfo();
					$this->success("备份文件已上传成功！",U(GROUP_NAME."/System/backup"));
				}
	
			}
			//下载备份文件
			if($_POST['download']){
				$pathinfo= './DBback/'; 
				$filename =$_POST['hffilename'];
				downAttach($pathinfo,$filename);
			}	
			if($_POST['yh']){
				$tablename=$_POST['tabname'];
				$sql="OPTIMIZE TABLE ".$tablename;
				if(M()->execute($sql)){
					show(1,$tablename."表已优化！");	
				}else{
					show(0,"请重试！");
				}	
			}
			if($_POST['yjyh']){
				$tbdesc=$x->tbdesc();
				for($i=0;$i<count($tbdesc);$i++){
					$tablename=$tbdesc[$i][0];
					$sql="OPTIMIZE TABLE ".$tablename;
				    M()->execute($sql);
				}
				show(1,"数据库表已优化！");	
			}
    	}else{ //视图

    		//备份展示数据
    		$tbdesc=$x->tbdesc();
			//dump($tbdesc);
	    	$this->assign('tbdesc',$tbdesc);
            
            //回复展示数据
            //打开备份数据文件的目录，列出要恢复使用的备份文件
			$pathinfo= './DBback/';   
			$filelist=scandir($pathinfo); //列出指定路径中的文件和目录
			$files = array();
			$fsize=array();
			$flag="您还没有备份过数据表，请先备份！";
			$j=0;
			for($i=count($filelist)-1;$i>=2;$i--){
				$tempfname=$filelist[$i];
				//$tempfname = iconv('GB2312','UTF-8',$tempfname); 
				$fsize[$j]=format_bytes(filesize($pathinfo.$tempfname)); 
				$files[$j]=$tempfname;
				$j++;
			}
		    
			if(count($filelist)>=3){                  //由于存在.和..两个隐藏的系统文件，在此不计入文件范围
				$flag="";
			}

	    	$this->assign('files',$files);
	    	$this->assign('fsize',$fsize);
			$this->assign('flag',$flag);
			
			//展示视图
			$this->display();			
    	}  
    }
    public function uejson(){
    	//UE的JSON文件位置，包含文件
    	$filename= './Data/Ueditor/php/config.json'; 
    	$content = file_get_contents($filename);
    	$jsonArr = json_decode($content,true);

    	if(!empty($_POST)){

    		$jsonArr['imagePathFormat'] =$_POST['imagePathFormat'];
    		$jsonArr['imageMaxSize']    =$_POST['imageMaxSize'];
    		$jsonArr['imageAllowFiles'] =strToArr($_POST['imageAllowFiles']);
    		$jsonArr['scrawlPathFormat']=$_POST['scrawlPathFormat'];
    		$jsonArr['scrawlMaxSize']   =$_POST['scrawlMaxSize'];
    		$jsonArr['snapscreenPathFormat']=$_POST['snapscreenPathFormat'];
    		$jsonArr['catcherPathFormat']=$_POST['catcherPathFormat'];
    		$jsonArr['catcherMaxSize']   =$_POST['catcherMaxSize'];
    		$jsonArr['catcherAllowFiles'] =strToArr($_POST['catcherAllowFiles']);
    		$jsonArr['videoPathFormat']   =$_POST['videoPathFormat'];
    		$jsonArr['videoMaxSize']      =$_POST['videoMaxSize'];  		
    		$jsonArr['videoAllowFiles']   =strToArr($_POST['videoAllowFiles']);
    		$jsonArr['filePathFormat']    =$_POST['filePathFormat'];
    		$jsonArr['fileMaxSize']       =$_POST['fileMaxSize'];
    		$jsonArr['fileAllowFiles']    =strToArr($_POST['fileAllowFiles']);
    		$jsonArr['imageManagerListPath']=$_POST['imageManagerListPath'];
    		$jsonArr['imageManagerListSize']=$_POST['imageManagerListSize'];
    		$jsonArr['imageManagerAllowFiles']=strToArr($_POST['imageManagerAllowFiles']);
    		$jsonArr['fileManagerListPath']  =$_POST['fileManagerListPath'];
    		$jsonArr['fileManagerListSize']  =$_POST['fileManagerListSize'];
    		$jsonArr['fileManagerAllowFiles']=strToArr($_POST['fileManagerAllowFiles']);

    		$jsonStr = json_encode($jsonArr,true);
    		$jsonStr = str_replace("\\n","",$jsonStr);
    		$jsonStr = str_replace("\\t","",$jsonStr);
			$jsonStr = str_replace("\\","",$jsonStr);
			//echo $jsonStr;die;
			//$jsonStr = substr($jsonStr,1);
			//$jsonStr = substr($jsonStr,0,$jsonStr.length-1);

    		@unlink($filename);//删除原先的配置文件
    		file_put_contents($filename,$jsonStr);
    		$this->success("UE参数配置成功！",U(GROUP_NAME.'/System/uejson'));
    	

    	}else{
    		
    		$this->assign('uejson',$jsonArr);
    		$this->display();
    	}
    	
    }
 /*******************************分隔线********************************/   
    public function install(){
    	//系统部署时设置，清空演示数据视图
    	$this->display();
    }  

/**系统数部署后清空系统演示数据或者以往数据**/
    public function resetTEMP(){//系统缓存文件删除
    	$temppath1 = "./Temp";
    	delDirAndFile($temppath1);
    	$temppath2 = "./Public/ExcisetempZIP";
    	delDirAndFile($temppath2);
    	$this->success('系统缓存数据清除成功！',U(GROUP_NAME.'/System/install'));	
    }
    
    public function resetUSER(){ //用户
    	$num1 = M('user')->count();
	    if($num1>1){
	        M('user')->where("id>1")->delete();//用户
	    }
	    $this->success('用户数据清除成功！',U(GROUP_NAME.'/System/install'));	
    }

	public function resetROLE(){//角色
    	$num1 = M('role')->count();
	    if($num1>0){
	        M()->execute("TRUNCATE xh_role");//角色
	    }
	    //给用户添加的角色清空
		$num2 = M('role_user')->count();
	    if($num2>0){
	        M()->execute("TRUNCATE xh_role_user");//用户的角色列表
	    }
	    //给角色配置的权限清空
		$num3 = M('access')->count();
	    if($num3>0){
	        M()->execute("TRUNCATE xh_access");//角色的权限列表
	    }
	    $this->success('角色\角色权限\用户角色数据清除成功！',U(GROUP_NAME.'/System/install'));	
    }
    public function resetNODE(){//节点
    	$num = M('node')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_node");//节点
	    }
	    $this->success('节点数据清除成功！',U(GROUP_NAME.'/System/install'));
    }
    public function resetsurvey(){//富文本编辑器：消息和满意度调查产生的文件清除
    	$num =M('site')->where('id>3')->count();
    	if($num>0){
    		M('site')->where('id>3')->delete();
    	}
    	$temppath="./Public/Upload";
    	delDirAndFile($temppath);
    	$this->success('消息和调查上传文件清除成功！',U(GROUP_NAME.'/System/install'));	
    }
    public function resetNEWS(){//消息
		$num = M('news')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_news");
	    }
	    $this->success('消息数据清除成功！',U(GROUP_NAME.'/System/install'));
	}
	/************************开始*********学期、处室、专业数据初始化**************************************/
	public function resetTER(){
		$num = M('term')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_term");//学期
	    }
	    $this->success('学期数据清除成功！',U(GROUP_NAME.'/System/install'));
	}
	public function resetPRO(){
		$num = M('professional')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_professional");//专业
	    }
	    $this->success('专业数据清除成功！',U(GROUP_NAME.'/System/install'));
	}
	public function resetOFF(){
		$num = M('office')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_office");//处室
	    }
	    $this->success('处室数据清除成功！',U(GROUP_NAME.'/System/install'));
	}

	/************************结束*********学期、处室、专业数据初始化**************************************/

	/************************开始*********课程、班级、教师、学生数据初始化**************************************/
	public function resetCOU(){
		$num = M('course')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_course");//课程
	    }
	    $this->success('课程数据清除成功！',U(GROUP_NAME.'/System/install'));
	}
	public function resetTEA(){
		$num = M('teacher')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_teacher");//教师
	    }
	    $this->success('教师数据清除成功！',U(GROUP_NAME.'/System/install'));
	}
	public function resetCLA(){
		$num = M('classes')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_classes");//班级
	    }
	    $this->success('班级数据清除成功！',U(GROUP_NAME.'/System/install'));
	}
	public function resetSTU(){
		$num = M('student')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_student");//学生
	    }
	    $this->success('学生数据清除成功！',U(GROUP_NAME.'/System/install'));
	}

	/************************结束**********课程、班级、教师、学生数据初始化************************************/

	public function resetSX(){//实训任务所有清空操作
	    $disnum = M('sxdisexicise')->count();
	    if($disnum>0){
	        M()->execute("TRUNCATE xh_sxdisexicise");//交流评价表
	    }
	    $subnum = M('sxsubexcise')->count();
	    if($subnum>0){
	        M()->execute("TRUNCATE xh_sxsubexcise");//任务提交表
	    }
	    $pubnum = M('sxpubexcise')->count();
	    if($pubnum>0){
	        M()->execute("TRUNCATE xh_sxpubexcise");//任务发布表
	    }
	    $setnum = M('sxsetcourse')->count();
	    if($setnum>0){
	        M()->execute("TRUNCATE xh_sxsetcourse");//课程列表
	    }

	    $this->success('演示数据清除成功！',U(GROUP_NAME.'/System/install'));
	}
	public function resetUPFILE(){//实训任务上传的所有文件删除
    	$temppath = "./Public/Excise";//Public/Excise
    	delDirAndFile($temppath);
    	$this->success('所有任务和作业删除成功！',U(GROUP_NAME.'/System/install'));
    }


}
?>
<?php
//前端展示模块
Class HomeAction extends CommonAction {

/**
 * 查看和更新学校简介
 * @return [type] [description]
 */
	public function school(){
		if(!empty($_POST)){ //处理
			
			$data['description']=$_POST['content'];
			if(M("site")->where("id=2")->save($data)){
				$this->success("更新成功！",U(GROUP_NAME."/Home/school"));
			}else{
				$this->error("更新失败！");
			}

		}else{ //视图
			$info = M('site')->field("description")->find(2);
			//var_dump($info);
			$this->assign("ddjj",$info);
			$this->display();
		}	

	}
/**
 * 友情链接
 */
    //友情连接管理列表
	public function link()
	{
		$link = M("link")->order("sort ASC")->select();
		$linkCount = M('link')->count();
		$this->link=$link;
		//echo $linkCount;
		$this->display();
	}

	public function addLink()
	{
		if(!empty($_FILES)){

			//最多支持6个
			$linkCount = M('link')->count();
			if($linkCount>=6)$this->error("系统最多支持6个友情链接！");	
			
			//处理上传图片
			
			import("ORG.Net.UploadFile");
			$upload = new UploadFile();
			$upload->maxSize=2048000;
			$upload->allowExts = array('jpg','jpeg','gif','png','PNG');
			$upload->savePath = "./Public/Upload/images/link/";
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
			

			$data =array(

				'title'=>trim($_POST['title']),
				'link'=> $_POST['link'],
				'imgsrc'=>$info[0]['savename'],
				'sort'=>$_POST['sort']
			);
			$res = M('link')->add($data);
			if($res){
				$this->success("添加成功！",U(GROUP_NAME.'/Home/link'));
			}else{
				$this->error('添加失败！');
			}

		}else{
			//默认显示添加页面
			$this->display();

		}
	}

	public function delLink(){
		$id =  (int) ($_GET['id']);
		//查询图片名称，删除图片
		$imgname=M('link')->field('imgsrc')->find($id);
		$imgsrc = "./Public/Upload/images/link/".$imgname['imgsrc'];
		$res = M("link")->delete($id);
		if($res&&unlink($imgsrc)){
			$this->success("删除成功！",U(GROUP_NAME."/Home/link"));
		}else{
			$this->error("删除失败~");
		}
	}

 	public function sortLink(){
 		$db=M('link');
		foreach ($_POST as $id => $sort){
			$db->where(array('id'=>$id))->setField('sort',$sort);
		}
		$this->redirect(GROUP_NAME.'/Home/link');
 	}
/**
 * 消息
 */
     //消息列表
	public function news(){
		$info = M('news')->field("id,title,pubtype,userxm,pubtime")->order('pubtime DESC')->select();
		$this->assign("info",$info);
		$this->display();

	}
	
	//添加消息
	public function addNews(){
		if(!empty($_POST)){
			//添加新闻通知
			$data=array(
			'title'=>$_POST['title'],
			'pubtype'=>$_POST['pubtype'],
			'content'=>$_POST['content'],
			'userxm'=>session('username'),
			'pubtime'=>time()
			);
			$id = M('news')->add($data);
			if($id>0){
				$this->success("发布成功！",U(GROUP_NAME."/Home/news"));
			}else{
				$this->error("发布失败！");
			}
		}else{
			
			$this->display();
		}

	}
	//消息详情
	public function detailNews(){
		$id=intval($_GET['id']);
		$info = D('news')->where("id=$id")->field("id,title,content,pubtype,userxm,pubtime")->find();
		//var_dump($info);
		$this->assign("info",$info);
		$this->display();

	}

	//编辑消息
	public function editNews()
	{
		if(!empty($_POST)){
			//p($_POST);die;
			$id=intval($_POST['id']);
			$data = array(
				'title'=>$_POST['title'],
				'content'=>$_POST['content'],
				'updatetime'=>time()
			);
			if(M('news')->where("id=$id")->save($data)){
				$this->success("更新成功！",U(GROUP_NAME."/Home/news"));
			}else{
				$this->success("更新失败！");
			}
		}else{
			$id=intval($_GET['id']);
			$n = M('news')->find($id);
			$this->assign("n",$n);
			$this->display();
		}
	}

	public function delNews()
	{
		$id=intval($_GET['id']);
		if(M('news')->delete($id)){
			$this->success("删除成功！",U(GROUP_NAME."/Home/news"));
		}else{
			$this->success("删除失败！");
		}
	}


 /**
 * 课程
 */
    public function vedio(){
		$courser = D('vedio')->join("xh_user on xh_vedio.userid = xh_user.id")->field("xh_vedio.id,title,desc,type,username,pubtime")->order('type DESC,xh_vedio.id DESC')->select();
		$this->courser=$courser;
		$this->display();
	}
	
	public function addVedio(){
		if(!empty($_POST)){
            import('ORG.Net.UploadFile'); //载入TP上传类
		    //获取图片和视频
			$fileimg = $_FILES['imgurl'];
			$imgext = explode('.',$fileimg['name']);	
			$imgext = strtolower($imgext[count($imgext)-1]);
			$imgallowext = array('jpg','jpeg','gif','png','PNG');
			if(!in_array($imgext, $imgallowext)){
				$this->error("上传图片格式不支持！");
			}
			if($fileimg['size']>10240000){
				$this->error("图片不能超过10MB！");
			}


			$filevideo = $_FILES['videourl'];
			$videoext = explode('.',$filevideo['name']);
			$videoext =strtolower( $videoext[count($videoext)-1]);
			$videoallowext = array('mp4','flv','wmv','rmvb','avi'); 
			//,'flv','wmv','rmvb','avi'
			if(!in_array($videoext,$videoallowext)){
				$this->error("上传视频格式不支持！");
			}
			if($filevideo['size']>104800000){
				$this->error("视频不能超过100MB！");
			}

			//图片和视频保存路径
			$fileimgpath='./Public/Resourse/image/';
			$filevideopath='./Public/Resourse/video/';

			//上传视频截图和视频	
			$uploadimg = new UploadFile();	
			if($info = $uploadimg->uploadOne($fileimg,$fileimgpath)){ //图片上传成功
				$imgurl=$fileimgpath.$info[0]['savename']; //images
				//上传视频
				$uploadvideo = new UploadFile();
				if($info = $uploadvideo->uploadOne($filevideo,$filevideopath)){ //视频上传成功
					$videourl=$filevideopath.$info[0]['savename']; //images

					//准备保存数据
					//添加新闻通知
					$data=array(
					'title'=>$_POST['title'],
					'desc'=>$_POST['desc'],
					'type'=>$_POST['type'],
					'imgurl'=>$imgurl, //展示图片
					'videourl'=>$videourl, //播放视频
					'videoext'=>$videoext, //视频扩展名，不含点
					'userid'=>session('uid'),
					'pubtime'=>time()
					);
					$id = M('vedio')->add($data);
					if($id>0){
						$this->success("发布成功！",U(GROUP_NAME."/Home/vedio"));
					}else{
						$this->error("发布失败！");
					}

				}else{
					$this->error("视频上传失败！");
				}
			}else{
				$this->error("图片上传失败！");
			}
				
		}else{
			$this->display();
		}
	}
	
    //课程资源详情
	public function detailVedio()
	{
		$id =  (int) $_GET['id'];
		$coursed = M('vedio')->find($id);
        $username = M('user')->find($coursed['userid']);
        $coursed['imgurl'] = substr($coursed['imgurl'],1);
         $coursed['videourl'] = substr($coursed['videourl'],1);
        $coursed['username'] = $username['username'];
		$this->assign("coursed",$coursed);
		$this->display();
	}

	public function delVedio(){
		$id = (int)($_GET['id']);
		
		//查询图片和视频的名称
		$resourse = M('vedio')->field("imgurl,videourl")->find($id);
		//print_r($resourse);die;
		//删除表中信息
		$res=M('vedio')->delete($id);
		if($res && unlink($resourse['imgurl']) && unlink($resourse['videourl'])){
			$this->success("删除成功！",U(GROUP_NAME."/Home/Vedio"));
		}else{
			$this->error("删除失败~");
		}
	}


/**
 * 留言
 */   
    public function discuss()
	{
		$discuz = M('discuss')->order("id DESC")->select();
		$this->assign("discuz",$discuz);
		$this->display();
	}

	public function delDiscuss(){
		$id =  (int) ($_GET['id']);
		$res = M("discuss")->delete($id);
		if($res){
			$this->success("删除成功！",U(GROUP_NAME."/Home/discuss"));
		}else{
			$this->error("删除失败~");
		}
	}



}

?>
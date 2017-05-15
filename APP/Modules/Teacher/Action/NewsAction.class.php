<?php

Class NewsAction extends CommonAction {

     //消息列表
		public function news(){
		$tea = session('tea');
		$userxm=$tea['jsxm'];
		//只查询自己发布的
		$info = M('news')->where("userxm='$userxm'")->field("id,title,pubtype,pubtime")->order('pubtype DESC,id DESC')->select();
		$this->assign("info",$info);
		$this->display();

	}
	
	//添加消息
	public function addNews(){
		if(!empty($_POST)){
			//添加新闻通知
			$tea = session('tea');
			$data=array(
			'title'=>$_POST['title'],
			'pubtype'=>$_POST['pubtype'],
			'content'=>$_POST['content'],
			'userxm'=>$tea['jsxm'],
			'pubtime'=>time()
			);
			$id = M('news')->add($data);
			if($id>0){
				$this->success("发布成功！",U(GROUP_NAME."/News/news"));
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

	public function delNews()
	{
		$id=intval($_GET['id']);
		if(M('news')->delete($id)){
			$this->success("删除成功！",U(GROUP_NAME."/News/news"));
		}else{
			$this->success("删除失败！");
		}
	}


}


?>
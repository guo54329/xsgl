<?php
//前端展示模块
Class HomeAction extends CommonAction {

/**
 * 消息
 */
/************************消息初始化**************************************/
	public function resetNEWS(){
		$num = M('news')->count();
	    if($num>0){
	        M()->execute("TRUNCATE xh_news");
	    }
	    $this->success('消息数据清除成功！',U(GROUP_NAME.'/Home/news'));
	}

     //消息列表
	public function news(){
		$num=M('news as a')->join('xh_classes as b on a.ccode=b.ccode','left')->count();
		$info = M('news as a')->join('xh_classes as b on a.ccode=b.ccode','left')->field("a.id,a.title,a.pubtype,b.cname,a.userxm,a.pubtime,a.content")->order('a.pubtype ASC,a.pubtime DESC')->select();
		$this->assign('num',$num);
		$this->assign("info",$info);
		$this->display();

	}
	
	//添加消息
	public function addNews(){
		if(!empty($_POST)){
			//添加消息
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

	//编辑消息
	public function editNews()
	{
		if(!empty($_POST)){
			//p($_POST);die;
			$id=intval($_POST['id']);
			$data = array(
				'title'=>$_POST['title'],
				'pubtype'=>$_POST['pubtype'],
				'content'=>$_POST['content']
				
			);
			if(M('news')->where("id=$id")->save($data)){
				$this->success("修改成功！",U(GROUP_NAME."/Home/news"));
			}else{
				$this->success("修改失败！");
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

}

?>
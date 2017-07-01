<?php

Class NewsAction extends CommonAction {

     //消息列表
		public function news(){
		$tea = session('tea');
		$userxm=$tea['jsxm'];
		//只查询自己发布的
		$info = M('news as a')->join('xh_classes as b on a.ccode=b.ccode','left' )->where("userxm='$userxm' and pubtype=4")->field("a.id,a.title,a.ccode,b.cname,a.pubtime")->order('a.id DESC')->select();
		//p($info);
		$this->assign("info",$info);
		$this->display();

	}
	
	
	//消息详情
	public function detailNews(){
		$id=intval($_GET['id']);
		$info = M('news as a')->join('xh_classes as b on a.ccode=b.ccode','left')->where("a.id=$id")->field("a.id,a.title,b.cname,a.content,a.userxm,a.pubtime")->find();
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
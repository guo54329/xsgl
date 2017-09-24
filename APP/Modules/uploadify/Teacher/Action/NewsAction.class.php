<?php

Class NewsAction extends CommonAction {

    //消息列表
	public function news(){
		$tea = session('tea');
		$userxm=$tea['jsxm'];
		//只查询自己发布的
		$num=M('news as a')->join('xh_classes as b on a.ccode=b.ccode','left' )->where("userxm='$userxm' and pubtype=4")->count();
		$info = M('news as a')->join('xh_classes as b on a.ccode=b.ccode','left' )->where("userxm='$userxm' and pubtype=4")->field("a.id,a.title,a.ccode,b.cname,a.pubtime,a.content")->order('a.id DESC')->select();
		//p($info);
		$this->assign('num',$num);
		$this->assign("info",$info);
		$this->display();

	}
	
	//管理员发布的消息列表
	public function sysNews(){
		//pubtype=1 表示管理员->所有教师和学生，pubtype=3 表示管理员->所有学生
		$num=$news = M('news')->where("pubtype=1 or pubtype=2")->count();
		$news = M('news')->where("pubtype=1 or pubtype=2")->order('pubtime DESC')->select();
		$this->assign('num',$num);
		$this->assign('news',$news);
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

	public function newsSave(){
		$tea = session('tea');
		$jsno = $tea['jsno'];
		$jsxm = $tea['jsxm'];
		  if(!empty($_POST)){
			  
			  $title = trim($_POST['title']);
		      $ccode  =trim($_POST['ccode']);
		      $content = trim($_POST['content']);
		      //输入验证
		      if($title==""){
		      	  $this->error('请输入消息标题！');
		      }
		      if($ccode==""){
		      	  $this->error('请选择接收对象！');
		      }
		      if($content==""){
		      	  $this->error('请输入消息内容！');
		      }
		      //添加消息
		      $data=array(
		      'title'=>$title,
		      'pubtype'=>4,
		      'ccode' =>$ccode,
		      'content'=>$content,
		      'userxm'=>$jsxm,
		      'pubtime'=>time()
		      );
		      $id = M('news')->add($data);
		      if($id>0){
		        $this->success("发布成功！",U(GROUP_NAME."/News/news"));
		      }else{
		        $this->error("发布失败！");
		      }
		  }else{
		     // $pubtype= 4;//教师给学生发默认发布类型为4即指定班级的学生

		      $ccodes  =M('sxsetcourse as a')->join("xh_classes as b on a.ccode=b.ccode",'left')->distinct(true)->field('a.ccode,b.cname')->where("jsno='$jsno'")->select();
		      $this->assign('ccodes',$ccodes);
		      $this->display();
		  }

	}


}


?>
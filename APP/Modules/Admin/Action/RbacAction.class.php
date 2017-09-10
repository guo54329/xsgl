<?php
Class RbacAction extends CommonAction {

	/*
	 默认用户列表
	 */
	Public function index(){
		//主表不查询password字段
		//relation方法为true时 表示只关联一个表，可以将true改为具体表名，这样可以关联多表
		$num = D('UserRelation')->field('password',true)->order('id')->relation(true)->count();

		$user = D('UserRelation')->field('password',true)->order('id')->relation(true)->select();
		//p($user);die;
		$this->assign('num',$num);
		$this->user=$user;
		$this->display();
	}

    /*
     角色列表
     */
	Public function role(){
		$this->num = M('role')->count();
		$this->role = M('role')->select();
		$this->display();
	}

	/*
	 节点列表
	 */
	Public function node(){
		$field=array('id','name','title','sort','pid');
		$num = M('node')->count();
		$node = M('node')->field($field)->order('sort,id')->select();
		$node = node_merge($node);
		//p($node);die;
		$this->num=$num;
		$this->node=$node;
		$this->display();

	}
	/*
	节点更新排序
	 */
	Public function sortNode(){
		//p($_POST);
		$db=M('node');
		foreach ($_POST as $id => $sort){
			$db->where(array('id'=>$id))->setField('sort',$sort);
		}
		$this->redirect(GROUP_NAME.'/Rbac/node');
	}

    /*
     添加用户
     */
	Public function addUser(){

		if(!empty($_POST)){ //处理

			//添加的用户信息
			$user = array(
				'username'=>I('username'),
				'password'=>I('password','','md5'),
				'logintime'=>time(),
				'loginip'=>get_client_ip()
			);

			$role=array();
			if($uid=M('user')->add($user)){
				foreach ($_POST['role_id'] as $v){
					$role[]=array(
						'role_id' =>$v,
						'user_id' =>$uid
					);
				}
				//添加用户角色
				M('role_user')->addAll($role);
				$this->success('添加用户成功',U(GROUP_NAME.'/Rbac/index'));
			}else{
				$this->error('添加用户失败');
			}
		}else{ //视图

			$this->role=M('role')->select();
			$this->display();

		}
		
	}

	/*
	 修改用户角色
	 */
	public function editUser()
	{
		if(!empty($_POST)){ //处理

			//删除该用户原先的角色
			$id = $_POST['id'];
			M('role_user')->where("user_id=$id")->delete();
			//接收新配置的角色
			$role=array();
			foreach ($_POST['role_id'] as $v){
				$role[]=array(
					'role_id' =>$v,
					'user_id' =>$id
				);
			}
			//添加新配置的角色
			if(M('role_user')->addAll($role)){
				$this->success('配置角色成功',U(GROUP_NAME.'/Rbac/index'));
			}

			
		}else{ //视图

			$id = $_GET['id'];
			$user = M("user")->where("id=$id")->find();
			$this->assign('user',$user);
			$this->role=M('role')->select();
			
			$this->display();
		}
		
	}
	
	/*
	 修改用户锁定状态
	 */
	Public function lock(){
		
		$id =$_GET['id'];
		$lock=$_GET['lock'];
		if($lock==1){
			$db=M('user')->where(array('id'=>$id))->save(array('lock'=>0));	
			$this->success('解除锁定',U(GROUP_NAME.'/Rbac/index'));
		}else{
			$db=M('user')->where(array('id'=>$id))->save(array('lock'=>1));
			$this->success('已锁定',U(GROUP_NAME.'/Rbac/index'));
		}
		
	}

	/*
	 删除用户
	 */
    Public function delUser(){
		
		$id = (int) $_GET['id'];
		//先在用户角色表中删除该用户的角色
		$num=M('role_user')->where("user_id=$id")->count();
		if($num>0){
			M('role_user')->where("user_id=$id")->delete();
		}
		//再删除该用户
		if(M('user')->where(array('id'=>$id))->delete()){
			$this->success('删除用户成功',U(GROUP_NAME.'/Rbac/index'));
		}else{
			$this->error('删除用户失败');
		}
	}

	/*
	 添加角色
	 */
	Public function addRole(){
		if(!empty($_POST)){ //处理

			if(M('role')->add($_POST)){
				$this->success('添加角色成功',U(GROUP_NAME.'/Rbac/role'));
			}else{
				$this->error('添加角色失败');
			}
		}else{//视图

			$this->display();	
		}
		
	}
	
    /*
     修改角色
     */
    Public function editRole(){
    	if(!empty($_POST)){ //处理

    		$id = (int) $_POST['id'];
			$data = array(
				'name'=> $_POST['name'],
	    		'remark'=>$_POST['remark'],
	    		'status' =>$_POST['status']
			);
			if(M('role')->where(array('id'=>$id))->setField($data)){
				$this->success('修改角色成功',U(GROUP_NAME.'/Rbac/role'));
			}else{
				$this->error('修改失败');
			} 
    	}else{ //视图

			$id = (int) $_GET['id'];
	    	$this->role=M('role')->where("id=$id")->find();
	    	$this->display();

    	}
    	
    }
   
    /*
     删除角色,需要先在用户角色表中删除对应的关系，在权限分配表中删除该角色对应的权限关系
     */
    Public function delRole(){
    	$id = (int) $_GET['id'];
    	//先在用户角色表中删除用户角色关系
    	$num1 = M('role_user')->where(array('role_id'=>$id))->count();
    	if($num1>0){
    		M('role_user')->where(array('role_id'=>$id))->delete();
    	}
    	//在权限配置表中删除角色权限关系
    	$num2 = M('access')->where(array('role_id'=>$id))->count();
    	if($num2>0){
    		M('access')->where(array('role_id'=>$id))->delete();
    	}
    	//再删除角色
		if(M('role')->where(array('id'=>$id))->delete()){
			$this->success('删除角色成功',U(GROUP_NAME.'/Rbac/role'));
		}else{
			$this->error('删除失败');
		}
	}

    /*
     添加节点
     */
	Public function addNode(){

		if(!empty($_POST)){ //处理
			
			if(M('node')->add($_POST)){
				$this->success('添加成功',U(GROUP_NAME.'/Rbac/node'));
			}else{
				$this->error('添加失败');
			}

		}else{ //视图

			$this->pid = I('pid',0,'intval');
			$this->level=I('level',1,'intval');

			switch ($this->level) {
				case 1:
					$this->type='应用';
					break;
				case 2:
					$this->type='控制器';
					break;
				case 3:
					$this->type='动作方法';
					break;	
			}
			$this->display();

		}
		

	}
	
	/*
	 修改节点
	 */
	Public function editNode(){

		if(!empty($_POST)){ //处理
			
			$id = (int) $_POST['id'];
			$data = array(
				'name'=> $_POST['name'],
	    		'title'=>$_POST['title'],
	    		'status' =>$_POST['status'],
	    		'sort'=>$_POST['sort']
			);
			if(M('node')->where(array('id'=>$id))->setField($data)){
				$this->success('修改节点成功',U(GROUP_NAME.'/Rbac/node'));
			}else{
				$this->error('更新失败');
			}

		}else{ //视图

			$id = (int) $_GET['id'];
			$this->node = M('node')->where("id=$id")->find();
			$this->display();

		}
	}
	
	/*
	  删除节点，先删除角色权限分配表中的关系
	 */
	Public function delNode(){
		
		$id = (int) $_GET['id'];
		getNodeChildsId();
		$node=M("node")->select();
    	$ids = getChildsId($node,$id);
   		$ids[]=$id;//本身的id及其所有子id
        
        $where['id']=array('in',$ids);  //批量删除的正确方法
        
        $where2['node_id']=array('in',$ids);  //批量删除的正确方法
        
        //先在权限配置表中删除角色与节点的关系
        $num=M('access')->where($where2)->count();
        if($num>0){
        	M('access')->where($where2)->delete();
        }
        //再删除节点
		if(M('node')->where($where)->delete()){
			$this->success('删除节点成功',U(GROUP_NAME.'/Rbac/node'));
		}else{
			$this->error('删除失败');
		}
	}


	/*
	 配置权限
	 */
	Public function access(){
		if(!empty($_POST)){ //处理，为角色指定权限或者修改角色的权限
			
			$data = array();
			$rid = I('rid',0,'intval');
			foreach ($_POST['access'] as $v) {
				$tmp = explode('_',$v);
				$data[]=array(
					'role_id' =>$rid,
					'node_id' =>$tmp[0],
					'level'   =>$tmp[1]
				);
			}
			$db =M('access');
			//删除原先的权限
			$db->where(array('role_id'=>$rid))->delete();
			//添加新的权限
			if($db->addAll($data)){
				$this->success('角色权限配置成功',U(GROUP_NAME.'/Rbac/role'));

			}else{
				$this->error('角色权限配置失败');
			}

		}else{ //视图

			$rid = I('rid',0,'intval');

			//读取所有节点
			$field=array('id','name','title','pid');
			$node = M('node')->field($field)->order('sort')->select();
			
			//原有权限
			$access=M('access')->where(array('role_id'=>$rid))->getField('node_id',true);//以一维数组的方式返回角色权限的node_id
			
			$this->node = node_merge($node,$access);

			$this->rid =$rid;
			$this->display();

			
		}

	}

}


?>
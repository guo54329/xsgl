<?php
Class BasicdataAction extends CommonAction {
/**
 * 学期专业处室维护
 * 教师与处室通过offname联系    (无连带) 但是有实训任务的布置有连带
 * 课程与专业通过proname联系    (无连带) 
 * 课程与课表通过coursename联系 (无连带)
 * 
 * 学生与班级通过班级编码联系(有连带) 与实训任务的提交有连带
 *
 * 删除教师需要删除教师的课程及任务以及学生的作业。
 * jsno->sxsetcourse(jsno,scid)->sxpubexcise(scid,peid)->sxsubexcise(peid)
 * 删除学生需要删除学生的任务
 * xsno->sxsubexcise(xsno)
 */

public function term(){
//列表
    $num=M('term')->count();
	$term = M('term')->order('name DESC')->select();
	$this->assign('num',$num);
    $this->assign('term',$term);
	$this->display();
}
public function saveTerm(){
//添加和修改视图
	 $id = (int)$_GET['id'];
	 if($id==0){
 		//添加视图
	 	 $term['op']="添加新学期";
	 	 $term['id']=0;
	 	 $this->assign('term',$term);
	 	 $this->display();
	 }else{
 		//修改操作
	 	$term = M('term')->find($id);
	 	$term['op']="修改学期";
	    $this->assign('term',$term);
		$this->display();
	}  
}
public function saveTermH(){
//添加和修改处理
    $res=0;
	 if(!empty($_POST)){
	 	$id=(int)$_POST['id'];
	 	$name=trim($_POST['name']);
	 	$data=array('name'=>$name);
	 	//验证输入
	 	if($name==""){
	 		$this->error("不能为空！");
	 	}
	 	//查重
	 	$tnum = M('term')->where("name='$name'")->count(); 		
	 	if($tnum>0){
			$this->error("该学期已存在！");
 		}

	 	$res='';
	 	if($id==0){
	 		//添加处理
	 		$res=M('term')->add($data);
		}else{
		 	//修改处理
	 		$data['id']=$id;
	 		$res=M('term')->save($data);
		}
		if($res){
			$this->success("提交成功！",U(GROUP_NAME.'/Basicdata/term'));
			///show(1,"提交成功！");
		}else{
			$this->error("提交失败！");
			//show(1,"提交失败！");
		}	
	}  
}
public function delTerm(){
//删除操作
	//$id = $_GET['id'];
	$id = (int)$_GET['id'];
	$res=M('term')->delete($id);
	if($res){
		$this->success("删除成功！",U(GROUP_NAME.'/Basicdata/term'));
		//show(1,"删除成功！");
	}else{
		//show(0,"删除失败！");
		$this->error("删除失败！");
	}
}
/**
 * 处室维护
 */
public function office(){
//列表
    $num=M('office')->count();
	$office = M('office')->select();
	//print_r($office);die;
	$this->assign('num',$num);
    $this->assign('office',$office);
	$this->display();
}
public function saveOffice(){
//添加和修改视图
	 $id = (int)$_GET['id'];
	 if($id==0){
 		//添加视图
	 	 $office['op']="添加处室";
	 	 $office['id']=0;
	 	 $this->assign('office',$office);
	 	 $this->display();
	 }else{
 		//修改操作
	 	$office = M('office')->find($id);
	 	$office['op']="修改处室";
	    $this->assign('office',$office);
		$this->display();
	}  
}
public function saveOfficeH(){
//添加和修改处理
    $res=0;
	 if(!empty($_POST)){
	 	$id=(int)$_POST['id'];
	 	$name=trim($_POST['name']);
	 	$data=array('name'=>$name);
	 	
	 	//验证输入
	 	if($name==""){
	 		$this->error("处室名称不能为空！");
	 	}
	 	//查重
	 	$onum=M('office')->where("name='$name'")->count();
	 	if($onum>0){
			$this->error("该处室已存在！");
 		}

	 	if($id==0){
	 		//添加处理
		 	$res=M(office)->add($data);
		}else{
		 	//修改处理
	 		$data['id']=$id;
	 		$res=M(office)->save($data);
		}
		if($res){
			$this->success("提交成功！",U(GROUP_NAME.'/Basicdata/office'));		
		}else{
			$this->error("提交失败！");
		}	
	}  
}

public function importOffice(){
//批量导入处室
	if(!empty($_POST)){
		$offices = trim($_POST['offices']);
		//输入验证
		if($offices==""){
			$this->error("请粘贴需要导入的处室信息！");
		}
			    	    
		//按行将数据保存至数组中
		$offices = explode("\n",$offices);	
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($offices);$i++){
		   $office[$i] = explode("\t",$offices[$i]);
		}
		
		//查询原表中的数据，避免重复
		$oldRes=M('office')->order('id ASC')->select();
		$olddata=array();
		foreach($oldRes as $v){
			$olddata[]=trim($v['name']);
		}

		//开始写入数据库表		
		$data = array();
		$index=0;
		$indexold=0;
	    for($i=0;$i<count($office);$i++){
		   $name=trim($office[$i][1]);
	   	   if(!empty($name) && !in_array($name,$olddata)){
	   	   		$data[$index++] = array(
					'name'=>$name,
				);
	   	   }
	   	   if(in_array($name,$olddata)){
	   			$indexold++;
	   	   }		
    	}
        
		if(count($data)>0){
			$res= M('office')->addAll($data);
			if($res){
				$this->success("导入".$index."个处室,".$indexold."个已存在！",U(GROUP_NAME.'/Basicdata/office'));
			}else{
				$this->error("导入处室失败！");
			}
		}else{
        	$this->error("经查重,您提交的所有处室已存在！");
        }
	}else{
		$this->display();
	}
}

public function delOffice(){
//删除操作
	$id = $_GET['id'];
	$res=M('office')->delete($id);
	if($res){
				$this->success("删除成功！",U(GROUP_NAME.'/Basicdata/office'));
	}else{
		$this->error("删除失败！");
	}
}

public function delOfficeTea(){
//请控指定处室的教师
	$name=$_GET['name'];
	$num = M('teacher')->where("offname='$name'")->count();
	if($num>0){
		M('teacher')->where("offname='$name'")->delete();
		$this->success($name."处室教师清空成功！",U(GROUP_NAME.'/Basicdata/office'));
	}else{
		$this->error($name."处室无教师！");
	}
}
/**
 * 专业维护
 */
public function professional(){
//列表
    $num=M('professional')->count();
	$professional = M('professional')->select();
	$this->assign('num',$num);
    $this->assign('professional',$professional);//专业信息
	$this->display();
}
public function saveProfessional(){
//添加和修改视图
	 $id = (int)$_GET['id']!=0 ? (int)$_GET['id'] : 0 ;
	 if($id==0){
 		//添加视图
	 	 $professional['op']="添加专业";
	 	 $professional['id']=0;
	 	 $this->assign('professional',$professional);
	 	 $this->display();
	 }else{
 		//修改操作
	 	$professional = M('professional')->find($id);
	 	$professional['op']="修改专业";
	    $this->assign('professional',$professional);
		$this->display();
	}  
}
public function saveProfessionalH(){
//添加和修改处理
    $res=0;
	 if(!empty($_POST)){
	 	$id=(int)$_POST['id'];
	 	$name=trim($_POST['name']);
	 	$data=array('name'=>$name);
	 	
	 	//验证输入
	 	if($name==""){
	 		$this->error("专业名称不能为空！");
	 	}
	 	//查重
	 	$pnum=M('professional')->where("name='$name'")->count();
	 	if($pnum>0){
			$this->error("该专业已存在！");
 		}

	 	if($id==0){
	 		//添加处理
		 	$res=M('professional')->add($data);
		}else{
		 	//修改处理
	 		$data['id']=$id;
	 		$res=M('professional')->save($data);
		}
		if($res){
				$this->success("提交成功！",U(GROUP_NAME.'/Basicdata/professional'));
		}else{
			$this->error("提交失败！");
		}	
	}  
}

public function importProfessional(){
//批量导入专业
	if(!empty($_POST)){
		$Professionals = trim($_POST['professionals']);
		//输入验证
		if($Professionals==""){
			$this->error("请粘贴需要导入的专业信息！");
		}

		//按行将数据保存至数组中
		$Professionals = explode("\n",$Professionals);	
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($Professionals);$i++){
		   $Professional[$i] = explode("\t",$Professionals[$i]);
		}

		//查询原表中的数据，避免重复
		$oldRes=M('professional')->order('id ASC')->select();
		$olddata=array();
		foreach($oldRes as $v){
			$olddata[]=trim($v['name']);
		}

		//开始写入数据库表		
		$data = array();
		$index=0;
		$indexold=0;
	   for($i=0;$i<count($Professional);$i++){
		    $name=trim($Professional[$i][1]);
	   		if(!empty($name) && !in_array($name,$olddata)){
				$data[$index++] = array(
					'name'=>$name,
				);
			}
			if(in_array($name,$olddata)){
	   			$indexold++;
	   		}
    	}
        if(count($data)>0){
			$res= M('professional')->addAll($data);
			if($res){
				$this->success("导入".$index."个专业,".$indexold."个已存在！",U(GROUP_NAME.'/Basicdata/professional'));
			}else{
				$this->error("导入专业失败！");
			}
		}else{
        	$this->error("经查重,您提交的所有专业已存在！");
        }

	}else{
		$this->display();
	}
}

public function delProfessional(){
//删除操作
	$id = $_GET['id'];
	$res=M('professional')->delete($id);
	if($res){
		$this->success("删除成功！",U(GROUP_NAME.'/Basicdata/professional'));
	}else{
		$this->error("删除失败！");
	}
}

public function delProfessionalCou(){
//清空指定专业课程
	$name=$_GET['name'];
	$num = M('course')->where("proname='$name'")->count();
	if($num>0){
		M('course')->where("proname='$name'")->delete();
		$this->success($name."专业课程清空成功！",U(GROUP_NAME.'/Basicdata/professional'));
	}else{
		$this->error($name."专业无课程！");
	}
}

/**
 * 课程维护
 */
public function course(){
//列表
    //p($_POST);
    if($_POST['proname']!=''){
    	$proname = $_POST['proname'];
    	$num=M('course')->where("proname='$proname'")->count();

    	$course = M('course')->where("proname='$proname'")->order("id ASC")->select();
    }else{//默认显示所有
    	$num=M('course')->order('proname ASC,id ASC')->count();
    	$course = M('course')->order('proname ASC,id ASC')->select();
    }
	$pronames = M('course')->distinct(true)->field("proname")->select();
	$this->assign('pronames',$pronames);
	$this->assign('num',$num);
    $this->assign('course',$course);
	$this->display();
}
public function saveCourse(){
//添加和修改视图
	 $id = (int)$_GET['id'];
	 //查询专业
	 $pro = M('professional')->select();
	 $this->assign('pro',$pro);
	 if($id==0){
 		//添加视图
	 	 $course['op']="添加新课程";
	 	 $course['id']=0;
	 	 $this->assign('course',$course);
	 	 $this->display();
	 }else{
 		//修改操作
	 	$course = M('course')->find($id);
	 	$course['op']="修改课程";
	    $this->assign('course',$course);
		$this->display();
	}  
}
public function saveCourseH(){
//添加和修改处理
    $res=0;
	 if(!empty($_POST)){
	 	$id=(int)$_POST['id'];
	 	$name=trim($_POST['name']);
	 	$coursetype=trim($_POST['coursetype']);
	 	$proname=trim($_POST['proname']);
	 	//输入验证
	 	if($name==""){
	 		$this->error("课程名称不能为空！");
	 	}
	 	if($coursetype==""){
	 		$this->error("请选择课程类型！");
	 	}
	 	if($proname==""){
	 		$this->error("请选择课程的专业！");
	 	}
	 	//查重
	 	$cnum=M('course')->where("name='$name' and proname='$proname'")->count();
	 	if($cnum>0){
			$this->error("该课程已存在！");
 		}

	 	//数据处理
	 	$data=array(
	 		'name'=>$name,
	 		'proname'=>$proname,
	 		'coursetype'=>$coursetype
	 	);

	 	if($id==0){
	 		//添加处理
		 	$res=M('course')->add($data);
		}else{
		 	//修改处理
		 	$data['id']=$id;
	 		$res=M('course')->save($data);
		}
		//p($data);die;
		if($res){
			$this->success("提交成功！",U(GROUP_NAME.'/Basicdata/course'));
		}else{
			$this->error("提交失败！");
		}	
	}  
}

public function importCourse(){
//批量导入课程
	if(!empty($_POST)){
		$courses = trim($_POST['courses']);
		//验证输入
		if($courses==""){
			$this->error("请粘贴需要导入的课程信息！");
		}	    
		//按行将数据保存至数组中
		$courses = explode("\n",$courses);	
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($courses);$i++){
		   $course[$i] = explode("\t",$courses[$i]);
		}

		//查询原表中的数据，避免重复
		$oldRes=M('course')->order('id ASC')->select();
		$olddata=array();
		foreach($oldRes as $v){
			$olddata[]=trim($v['name']).trim($v['proname']);
		}

		//开始写入数据库表		
		$data = array();
		$index=0;
		$indexold=0;
	    for($i=0;$i<count($course);$i++){
			$name=trim($course[$i][1]);
			$proname=trim($course[$i][3]);
			$temp=$name.$proname;
	    	if(!empty($temp) && !in_array($temp,$olddata)){
	    		$data[$index++] = array(
					'name'=>$name,
					'coursetype'=>trim($course[$i][2]),
					'proname'=>trim($course[$i][3]),
				);
	    	}
	    	if(in_array($temp,$olddata)){
	   			$indexold++;
	   		}
    	}

    	if(count($data)>0){
			$res= M('course')->addAll($data);
			if($res){
				$this->success("导入".$index."个课程,".$indexold."个已存在！",U(GROUP_NAME.'/Basicdata/course'));
			}else{
				$this->error("导入课程失败！");
			}
		}else{
        	$this->error("经查重,您提交的所有课程已存在！");
        }

	}else{
		$this->display();
	}
}

public function delCourse(){
//删除操作
	$id = $_GET['id'];
	$res=M('course')->delete($id);
	if($res){
				$this->success("删除成功！",U(GROUP_NAME.'/Basicdata/course'));
	}else{
		$this->error("删除失败！");
	}
}

/**
 * 班级维护
 */
public function classes(){
//列表
   
    if($_POST['zjsj']!=''){
    	$zjsj=$_POST['zjsj'];
    	$num=M('classes as a')->join("xh_teacher as b on a.master=b.jsno")->where("a.zjsj='$zjsj'")->field("a.id,a.ccode,a.cname,b.offname,b.jsxm,b.jsdh,a.zjsj,a.proname")->count();

		$classes = M('classes as a')->join("xh_teacher as b on a.master=b.jsno")->where("a.zjsj='$zjsj'")->field("a.id,a.ccode,a.cname,b.offname,b.jsxm,b.jsdh,a.zjsj,a.proname")->order('ccode ASC')->select();
    }else{
    	$num=M('classes as a')->join("xh_teacher as b on a.master=b.jsno")->field("a.id,a.ccode,a.cname,b.offname,b.jsxm,b.jsdh,a.zjsj,a.proname")->count();

    	$classes = M('classes as a')->join("xh_teacher as b on a.master=b.jsno")->field("a.id,a.ccode,a.cname,b.offname,b.jsxm,b.jsdh,a.zjsj,a.proname")->order('ccode ASC')->select();
    }
	
	$zjsjs = M('classes')->distinct(true)->field("zjsj")->select();
    $this->assign('zjsjs',$zjsjs);
    $this->assign('num',$num);
    $this->assign('classes',$classes);
	$this->display();
}
public function saveClasses(){
//添加和修改视图
	 $id = (int)$_GET['id'];
	 //查询学期为学生指定入学时间
	 $zjsj = M('classes')->distinct(true)->field('zjsj')->order('zjsj DESC')->select();
	 $term=M('term')->field('name zjsj')->order('name DESC')->select();
	 //p($zjsj);p($term);

	 if(count(zjsj)>0){  //2018.6.12新增判断，否则在数据库表中无数据时，合并的结果受影响导致无选项
	 //当班级表的组建时间和学生表中的入学时间还没有值时（此时表时空的），通过将时间和学期进行合并，合并后的结果为空，而不是学期。
		$term=array_merge($zjsj,$term);
	 }
	 $dateterm=array();
	 foreach ($term as $v) {
	 	$dateterm[]=$v['zjsj'];
	 }
	 rsort($dateterm);
	 $term=array_unique($dateterm);
	 $index=0;
	 foreach ($term as $vv) {
	 	$termlast[$index++]['zjsj']=$vv;
	 }
	 $this->assign('term',$termlast);

	 //查询专业
	 $pro = M('professional')->select();
	 $this->assign('pro',$pro);
	 //查询教师作为班主任选择
	 getTeacherinfor();
	 if($id==0){
 		//添加视图
	 	 $classes['op']="添加新班级";
	 	 $classes['id']=0;
	 	 $classes['ccodestatus']=1;
	 	 $this->assign('classes',$classes);
	 	 $this->display();
	 }else{
 		//修改操作  问题：两个表的id名称一样，所以必须有所区别，不然id会出错。
	 	$classes = M('classes as a')->join("xh_teacher as b on a.master=b.jsno")->where("a.id=$id")
	 	->field("a.id,a.ccode,a.cname,b.jsno,b.jsxm,b.offname,a.zjsj,a.proname")->find();
	 	$classes['op']="修改班级";
	 	$classes['ccodestatus']=0;//表示不允许修改
	    $this->assign('classes',$classes);
		$this->display();
	}  
}
public function saveClassesH(){
//添加和修改处理
    $res=0;
	 if(!empty($_POST)){
	 	$id=(int)$_POST['id'];
	 	//某些php版本不支持explode("-",$_POST['master'])[0]的写法
	 	if($id==0){
	 		$ccode = trim($_POST['ccode']);
	 		if($ccode==""){
	 			$this->error("班级编码不能为空！");
	 		}
	 	}
	 	
	 	$master = explode("-",$_POST['master']);
	 	$master = $master[0];
	 	$cname = trim($_POST['cname']);
	 	$master = trim($master);
	 	$zjsj = trim($_POST['zjsj']);
	 	$proname = trim($_POST['proname']);
	 	//验证输入
	 	if($cname==""){
	 		$this->error("班级名称不能为空！");
	 	}
	 	if($master==""){
	 		$this->error("请选择班主任！");
	 	}
	 	if($zjsj==""){
	 		$this->error("请选择组建时间！");
	 	}
	 	if($proname==""){
	 		$this->error("请选择班级的专业！");
	 	}
	 	//查重
	 	$cnum=M('classes')->where("ccode='$ccode' and cname='$cname'")->count();
	 	if($cnum>0){
			$this->error("该班级已存在！");
 		}

	 	//数据处理
	 	$data=array(
	 	 		'cname'=>$cname,
	 	 		'master'=>$master,
	 	 		'zjsj'=>$zjsj,
	 	 		'proname'=>$proname
	 	 );
	 	if($id==0){
	 		
	 		$data['ccode']=$ccode; //编辑时，由于ccode不允许改动，会被系统过滤
	 		//添加处理
		 	$res=M('classes')->add($data);
		}else{
		 	//修改处理
	 		$data['id']=$id;
	 		$res=M('classes')->save($data);
		}
		if($res){
				$this->success("提交成功！",U(GROUP_NAME.'/Basicdata/classes'));
		}else{
			$this->error("提交失败！");
		}	
	}  
}

public function importClasses(){
//批量导入班级
	if(!empty($_POST)){
		$classesm = trim($_POST['classesm']);
		//验证输入
		if($classesm==""){
			$this->error("请粘贴需要导入的班级信息！");
		}	
		//按行将数据保存至数组中
		$classesm = explode("\n",$classesm);	
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($classesm);$i++){
		   $classes[$i] = explode("\t",$classesm[$i]);
		}

		//查询原表中的数据，避免重复
		$oldRes=M('classes')->order('id ASC')->select();
		$olddata=array();
		foreach($oldRes as $v){
			$olddata[]=trim($v['ccode']);
		}

		//开始写入数据库表		
		$data = array();
		$index=0;
		$indexold=0;
	    for($i=0;$i<count($classes);$i++){
			$ccode=trim($classes[$i][1]);
	    	if(!empty($ccode) && !in_array($ccode,$olddata)){
				$data[$index++] = array(
					'ccode'=>$ccode,
					'cname'=>trim($classes[$i][2]),
					'master'=>trim($classes[$i][3]),
					'zjsj'=>trim($classes[$i][4]),
					'proname'=>trim($classes[$i][5]),
				);
	    	}
	    	if(in_array($ccode,$olddata)){
	   			$indexold++;
	   		}
    	}

    	if(count($data)>0){
			$res= M('classes')->addAll($data);
			if($res){
				$this->success("导入".$index."个班级,".$indexold."个已存在！",U(GROUP_NAME.'/Basicdata/classes'));
			}else{
				$this->error("导入班级失败！");
			}
		}else{
        	$this->error("经查重,您提交的所有班级已存在！");
        }

	}else{
		$this->display();
	}
}

public function delClasses(){
//删除操作
	$id = $_GET['id'];
	$res=M('classes')->delete($id);
	if($res){
				$this->success("删除成功！",U(GROUP_NAME.'/Basicdata/classes'));
	}else{
		$this->error("删除失败！");
	}
}

public function delClassesStu(){
//清空指定班级的学生
	$ccode=$_GET['ccode'];
	$cname=$_GET['cname'];
	$num = M('student')->where("ccode='$ccode'")->count();
	if($num>0){
		M('student')->where("ccode='$ccode'")->delete();
		$this->success($cname."学生清空成功！",U(GROUP_NAME.'/Basicdata/classes'));
	}else{
		$this->error($cname."无学生！");
	}
}
/**
 * 教师维护
 */
public function teacher(){
//列表
    //p($_POST);
	$offname=$_POST['offname'];//处室名称
	$tea = $_POST['tea'];//帐号或姓名
    if($offname!=''&&$tea==''){
    	$num=M('teacher')->where("offname='$offname'")->count();
    	$teacher = M('teacher')->where("offname='$offname'")->order('id ASC')->select();
    }
    if($offname==''&&$tea!=''){
    	$num=M('teacher')->where("jsno='$tea' or jsxm='$tea'")->count();
    	$teacher = M('teacher')->where("jsno='$tea' or jsxm='$tea'")->order('offname ASC,id ASC')->select();
    }
    if($offname!=''&&$tea!=''){
    	$num=M('teacher')->where("offname='$offname' and (jsno='$tea' or jsxm='$tea')")->count();
    	$teacher = M('teacher')->where("offname='$offname' and (jsno='$tea' or jsxm='$tea')")->order('id ASC')->select();
    }
    if($offname==''&&$tea==''){//默认情况
    	$num=M('teacher')->count();
    	$teacher = M('teacher')->order('id ASC')->select();//offname ASC,
    }
	
	$offnames=M('teacher')->distinct(true)->field('offname')->select();
	//p($offnames);
	$this->assign('offnames',$offnames);
	$this->assign('num',$num);
    $this->assign('teacher',$teacher);
	$this->display();
}
public function saveTeacher(){
//添加和修改视图
	 $id = (int)$_GET['id'];
	 //查询处室
	 $office = M('office')->select();
	 $this->assign('office',$office);
	 if($id==0){
 		//添加视图
	 	 $teacher['op']="添加教师";
	 	 $teacher['jsnostatus']=1;
	 	 $teacher['id']=0;
	 	 $this->assign('teacher',$teacher);
	 	 $this->display();
	 }else{
 		//修改操作
	 	$teacher = M('teacher')->find($id);
	 	$teacher['op']="修改教师";
	 	$teacher['jsnostatus']="0";//表示不允许修改
	    $this->assign('teacher',$teacher);
		$this->display();
	}  
}
public function saveTeacherH(){
//添加和修改处理
    $res=0;
	 if(!empty($_POST)){
	 	$id=(int)$_POST['id'];
	 	if($id==0){
	 		$jsno = trim($_POST['jsno']);
	 		if($jsno==""){
	 			$this->error("教师编码不能为空！");
	 		}
	 	}
 		$jsxm=trim($_POST['jsxm']);
 		$jsxb=trim($_POST['jsxb']);
 		$jsdh=trim($_POST['jsdh']);
 		$offname=trim($_POST['offname']);
 	 	//输入验证
 	 	if($jsxm==""){
 	 		$this->error("姓名不能为空！");	
 	 	}
 	 	if($jsxb==""){
 	 		$this->error("性别不能为空！");	
 	 	}
 	 	if($jsdh==""){
 	 		$this->error("联系电话不能为空！");	
 	 	}
 	 	if($offname==""){
 	 		$this->error("请选择其所在处室！");	
 	 	}

 	 	//查重
	 	$tnum=M('teacher')->where("jsno='$jsno' and jsxm='$jsxm'")->count();
	 	if($tnum>0){
			$this->error("该教师已存在！");
 		}

	 	//数据处理
 		$data=array(
 	 		'jsxm'=>$jsxm,
 	 		'jsxb'=>$jsxb,
 	 		'jsdh'=>$jsdh,
 	 		'jsmm'=>'123456',
 	 		'offname'=>$offname
 	 	);

	 	if($id==0){
	 		$data['jsno']=$jsno;
	 		//添加处理
		 	$res=M('teacher')->add($data);
		}else{
		 	//修改处理
	 		$data['id']=$id;
	 		$res=M('teacher')->save($data);
		}
		if($res){
				$this->success("提交成功！",U(GROUP_NAME.'/Basicdata/teacher'));
		}else{
			$this->error("提交失败！");
		}	
	}  
}

public function importTeacher(){
//批量导入教师
	if(!empty($_POST)){

		$teachers = trim($_POST['teachers']);
		if($teachers==""){
			$this->error("请粘贴教师信息！");
		}
	    //p($teachers);die;
		//按行将数据保存至数组中
		$teachers = explode("\n",$teachers);
		
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($teachers);$i++){
		   $teacher[$i] = explode("\t",$teachers[$i]);
		}

		//查询原表中的数据，避免重复
		$oldRes=M('teacher')->order('id ASC')->select();
		$olddata=array();
		foreach($oldRes as $v){
			$olddata[]=trim($v['jsno']);
		}

		//开始写入数据库表		
		$data = array();
		$index=0;
		$indexold=0;
	    for($i=0;$i<count($teacher);$i++){
		    $jsno=trim($teacher[$i][1]);
		   	if(!empty($jsno) && !in_array($jsno,$olddata)){
		   		$data[$index++] = array(
					'jsno'=>$jsno,
					'jsxm'=>trim($teacher[$i][2]),
					'jsxb'=>trim($teacher[$i][3]),
					'jsdh'=>trim($teacher[$i][4]),
					'jsmm'=>'123456',
					'offname'=>trim($teacher[$i][5])
				);
		   	}
		   	if(in_array($jsno,$olddata)){
	   			$indexold++;
	   		}
			
    	}
    	if(count($data)>0){
			$res= M('teacher')->addAll($data);
			if($res){
				$this->success("导入".$index."个教师,".$indexold."个已存在！",U(GROUP_NAME.'/Basicdata/teacher'));
			}else{
				$this->error("导入教师失败！");
			}
		}else{
        	$this->error("经查重,您提交的所有教师已存在！");
        }

	}else{
		$this->display();
	}
}

public function resetTeacherPass(){
	$id = (int)$_POST['id'];
	if($id){
		$data=array(
			'id'=>$id,
			'jsmm'=>'123456'
		);
		if(M('teacher')->save($data)){
			echo "1";
		}else{
			echo "0";
		}
	}
}
public function delTeacher(){
//删除操作
/*删除教师需要删除教师的课程及任务以及任务下学生的作业。
 * jsno->sxsetcourse(jsno,scid)->sxpubexcise(scid,status,peid)->sxsubexcise(peid)
*/
	$id = (int)$_GET['id'];
	$js = M('teacher')->field('jsno')->find($id);
	$jsno=$js['jsno'];

//该教师的所有课程：保存至一维数组：$scids
    $scidss = M('sxsetcourse')->where("jsno='$jsno'")->field("scid")->select();
    for($i=0;$i<count($scidss);$i++){
    	$scids[$i]=$scidss[$i]['scid'];
    }
    //echo "<hr>scid:<br>";
    //p($scids);
//该教师的所有任务：保存至一维数组：$peids  批量删除的正确方法
    $where['scid']=array('in',$scids);  
    $peidss =M('sxpubexcise')->where($where)->field("peid")->select();
    for($i=0;$i<count($peidss);$i++){
    	$peids[$i]=$peidss[$i]['peid'];
    }
    //echo "<hr>peid:<br>";
    //p($peids);//die;
//该教师课程下的任务下的学生提交的作业 
    //批量删除附件和记录sxsubexcise
    if(count($peids)>0){ //有则删
    	for($p=0;$p<count($peids);$p++){
	    	$peid=$peids[$p];
		    $excisesnum = M('sxsubexcise')->where("peid=$peid")->count();
		    if($excisesnum>0){//已发布或者重做状态或者已提交状态
		    	$url= M('sxpubexcise')->field('url')->find($peid);
		    	$excises = M('sxsubexcise')->where("peid=$peid")->select();
			    //删除已提交作业的附件
			    for($i=0;$i<count($excises);$i++){
			         if($excises[$i]['filename']!=''){//删除已提交的作业  也可以使用提交状态status来做判断
			             $file = $url['url'].$excises[$i]['filename'];
			             unlink($file);//删除附件
			         } 
			    }
			    //删除作业记录
			    $res = M('sxsubexcise')->where("peid=$peid")->delete();
			    if(!$res){
			       $this->error('删除学生作业记录失败!');
			    }
		    }
		    
	    }
    }
    
	//批量删除任务sxpubexcise
	if(count($peids)>0){//有则删除
		for($s=0;$s<count($scids);$s++){
		 	$scid=$scids[$s];
		 	$res2=M('sxpubexcise')->where("scid=$scid")->delete();
		 	if(!$res2){
		       $this->error('删除实训任务记录失败!');
		    }
		}
	}
   
	 //批量删除该教师的所有课程sxsetcourse
	 if(count($scids)>0){//有则删除
		 $res3 = M('sxsetcourse')->where("jsno='$jsno'")->delete();
		 if(!$res3){
		       $this->error('删除教师课表记录失败!');
		 }
	 }

 /*********************************************/   
    //从教师表中删除该教师
	$res=M('teacher')->delete($id);
	if($res){
				$this->success("删除成功！",U(GROUP_NAME.'/Basicdata/teacher'));
	}else{
		$this->error("删除失败！");
	}
} 

/**
 * 学生维护
 */
public function student(){
//列表

	$ccode=$_POST['ccode'];//班级代码
	$stu = $_POST['stu'];//学号或姓名
    if($ccode!=''&&$stu==''){
    	$num=$student = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->field("a.id,a.xsno,a.xsxm,a.xsxb,a.rxsj,b.cname")->where("a.ccode='$ccode'")->count();

    	$student = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->field("a.id,a.xsno,a.xsxm,a.xsxb,a.rxsj,b.cname")->where("a.ccode='$ccode'")->order('a.id ASC')->select();
    }
    if($ccode==''&&$stu!=''){
    	$num=$student = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->field("a.id,a.xsno,a.xsxm,a.xsxb,a.rxsj,b.cname")->where("a.xsno='$stu' or a.xsxm='$stu'")->count();

    	$student = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->field("a.id,a.xsno,a.xsxm,a.xsxb,a.rxsj,b.cname")->where("a.xsno='$stu' or a.xsxm='$stu'")->order('a.ccode ASC,a.id ASC')->select();
    }
    if($ccode!=''&&$stu!=''){
    	$num=$student = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->field("a.id,a.xsno,a.xsxm,a.xsxb,a.rxsj,b.cname")->where("a.ccode='$ccode' and (a.xsno='$stu' or a.xsxm='$stu')")->count();

    	$student = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->field("a.id,a.xsno,a.xsxm,a.xsxb,a.rxsj,b.cname")->where("a.ccode='$ccode' and (a.xsno='$stu' or a.xsxm='$stu')")->order('a.ccode ASC,a.id ASC')->select();
    }
    if($ccode==''&&$stu==''){
    	$num=$student = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->field("a.id,a.xsno,a.xsxm,a.xsxb,a.rxsj,b.cname")->count();

    	$student = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->field("a.id,a.xsno,a.xsxm,a.xsxb,a.rxsj,b.cname")->order('a.ccode ASC,a.id ASC')->select();
    }
	
	$ccodes=M('student as a')->join("xh_classes as b on a.ccode=b.ccode")->distinct(true)->field('a.ccode,b.cname')->order("a.ccode ASC")->select();
	//p($ccodes);
	
	$this->assign('ccodes',$ccodes);
	$this->assign('num',$num);
    $this->assign('student',$student);
	$this->display();
}
public function saveStudent(){
//添加和修改视图
	 $id = (int)$_GET['id'];
	 //查询学期为学生指定入学时间
	 $rxsj = M('student')->distinct(true)->field('rxsj')->order('rxsj DESC')->select();
	 $term=M('term')->field('name rxsj')->order('name DESC')->select();
	 //p($rxsj);p($term);

	 if(count($rxsj)>0){
   //当班级表的组建时间和学生表中的入学时间还没有值时（此时表时空的），通过将时间和学期进行合并，合并后的结果为空，而不是学期。
   //解决：新增if判断，如果班级表或学生表中的时间存在，则进行合并操作，不存在则不改变学期值。
		$term=array_merge($rxsj,$term);
	 }
	 $dateterm=array();
	 foreach ($term as $v) {
	 	$dateterm[]=$v['rxsj'];
	 }
	 rsort($dateterm);
	 $term=array_unique($dateterm);
	 $index=0;
	 foreach ($term as $vv) {
	 	$termlast[$index++]['rxsj']=$vv;
	 }
	 $this->assign('term',$termlast);
	 //p($termlast);
	 //为学生指定班级
	 getClassesinfor();//生成由组建时间联动班级名称的js文件
	 
	 if($id==0){
 		//添加视图
	 	 $student['op']="添加学生";
	 	 $student['xsnostatus']=1;
	 	 $student['id']=0;
	 	 $this->assign('student',$student);
	 	 $this->display();
	 }else{
 		//修改操作
	 	$student = M('student')->find($id);
	 	$student['op']="修改学生";
	 	$student['xsnostatus']="0";//表示不允许修改
	    $this->assign('student',$student);
		$this->display();
	}  
}
public function saveStudentH(){
//添加和修改处理
    $res=0;
	 if(!empty($_POST)){

	 	$id=(int)$_POST['id'];
	 	if($id==0){
	 		$xsno=trim($_POST['xsno']);
	 		if($xsno==0){
	 			$this->error("学生编号不能为空！");
	 		}
	 	}
        
        $xsxm=trim($_POST['xsxm']);
 		$xsxb=trim($_POST['xsxb']);
 		$rxsj=trim($_POST['rxsj']);
 		$ccode=trim($_POST['ccode']);
 		//验证输入
 		if($xsxm==""){
 			$this->error("姓名不能为空！");
 		}
 		if($xsxb==""){
 			$this->error("请选择性别！");
 		}
 		if($rxsj==""){
 			$this->error("请选择学生的入学时间！");
 		}
 		if($ccode==""){
 			$this->error("请选择所在班级！");
 		}
 		//查重
	 	$snum=M('student')->where("xsno='$xsno' and xsxm='$xsxm'")->count();
	 	if($snum>0){
			$this->error("该生已存在！");
 		}

	 	//处理班级编号
	 	$ccode = explode("-",$ccode);
	 	$ccode=$ccode[0];
	 	$data=array(
	 	 		'xsxm'=>$xsxm,
	 	 		'xsxb'=>$xsxb,
	 	 		'rxsj'=>$rxsj,
	 	 		'xsmm'=>'123456',
	 	 		'ccode'=>$ccode
	 	);
	 	if($id==0){
	 		$data['xsno']=$xsno;
	 		//添加处理
		 	$res=M('student')->add($data);
		}else{
		 	//修改处理
	 		$data['id']=$id;
	 		$res=M('student')->save($data);
		}
		if($res){
				$this->success("提交成功！",U(GROUP_NAME.'/Basicdata/student'));
		}else{
			$this->error("提交失败！");
		}	
	}  
}
public function importStudent(){
//批量导入学生
	if(!empty($_POST)){

		$students = trim($_POST['students']);
		if($students==""){
			$this->error("请粘贴学生信息！");
		}
	    
		//按行将数据保存至数组中
		$students = explode("\n",$students);
		
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($students);$i++){
		   $student[$i] = explode("\t",$students[$i]);
		}

		//查询原表中的数据，避免重复
		$oldRes=M('student')->order('id ASC')->select();
		$olddata=array();
		foreach($oldRes as $v){
			$olddata[]=trim($v['xsno']);
		}

		//开始写入数据库表		
		$data = array();
		$index=0;
		$indexold=0;
	    for($i=0;$i<count($student);$i++){
		    $xsno=trim($student[$i][1]);
	   		if(!empty($xsno)  && !in_array($xsno,$olddata)){
				$data[$index++] = array(
					'xsno'=>$xsno,
					'xsxm'=>trim($student[$i][2]),
					'xsxb'=>trim($student[$i][3]),
					'rxsj'=>trim($student[$i][4]),
					'xsmm'=>'123456',
					'ccode'=>trim($student[$i][5])
				);
	   		}
	   		if(in_array($xsno,$olddata)){
	   			$indexold++;
	   		}

    	}
        if(count($data)>0){
			$res= M('student')->addAll($data);
			if($res){
				$this->success("导入".$index."个学生,".$indexold."个已存在！",U(GROUP_NAME.'/Basicdata/student'));
			}else{
				$this->error("导入学生失败！");
			}
		}else{
        	$this->error("经查重,您提交的所有学生已存在！");
        }
	}else{
		$this->display();
	}
}

public function resetStudentPass(){
	$id = (int)$_POST['id'];
	if($id){
		$data=array(
			'id'=>$id,
			'xsmm'=>'123456'
		);
		if(M('student')->save($data)){
			echo "1";
		}else{
			echo "0";
		}
	}
}
public function delStudent(){
//删除操作
/*
 * 删除学生需要删除学生的作业：附件和记录，目前存在问题
 * xsno->sxsubexcise(xsno)
*/
	$id = (int)$_GET['id'];
	$xs = M('student')->field('xsno')->find($id);
	$xsno=$xs['xsno'];
	$count = M('sxsubexcise')->where("xsno='$xsno'")->count();
	if($count>0){//已发布或者重做状态或者已提交状态
		$excises = M('sxsubexcise')->where("xsno='$xsno'")->field("seid,peid,filename")->select();
	    //删除已提交作业的附件
	    for($i=0;$i<count($excises);$i++){
	         if($excises[$i]['filename']!=''){//删除已提交的作业  也可以使用提交状态status来做判断
	         	$url= M('sxpubexcise')->field('url')->find($excises[$i]['peid']);
	            $file = $url['url'].$excises[$i]['filename'];
	            unlink($file);//删除附件
	         }
	         $seid=$excises[$i]['seid'];
	         M('sxsubexcise')->where("seid=$seid")->delete();//删除记录
	    }
    }

	if(count>0){
		M('sxsubexcise')->where("xsno='$xsno'")->delete();
	}
	$res=M('student')->delete($id);
	if($res){
		$this->success("删除成功(包含该生的所有实训作业)！",U(GROUP_NAME.'/Basicdata/student'));
	}else{
		$this->error("删除失败！");
	}
} 

}
?>

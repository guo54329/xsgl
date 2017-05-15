<?php
Class BasicdataAction extends CommonAction {
/**
 * 学期专业处室维护
 */
public function term(){
//列表
	$term = M('term')->order('name DESC')->select();
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
	 	$data=array('name'=>trim($_POST['name']));
	 	if($id==0){
	 		//添加处理
		 	$res=M(term)->add($data);
		}else{
		 	//修改处理
	 		$data['id']=$id;
	 		$res=M(term)->save($data);
		}
		if($res){
			//$this->success("提交成功！",U(GROUP_NAME.'/Basicdata/term'));
			show(1,"提交成功！");
		}else{
			//$this->error("提交失败！");
			show(1,"提交失败！");
		}	
	}  
}
public function delTerm(){
//删除操作
	//$id = $_GET['id'];
	$id = (int)$_POST['id'];
	$res=M('term')->delete($id);
	if($res){
		//$this->success("删除成功！",U(GROUP_NAME.'/Basicdata/term'));
		show(1,"删除成功！");
	}else{
		show(0,"删除失败！");
		//$this->error("删除失败！");
	}
}
/**
 * 处室维护
 */
public function office(){
//列表
	$office = M('office')->select();
	//print_r($office);die;
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
	 	$data=array('name'=>trim($_POST['name']));
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
		$offices = $_POST['offices'];	    
		//按行将数据保存至数组中
		$offices = explode("\n",$offices);	
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($offices);$i++){
		   $office[$i] = explode("\t",$offices[$i]);
		}
		//开始写入数据库表		
		$data = array();
	   for($i=0;$i<count($office);$i++){
			$data[$i] = array(
				'name'=>trim($office[$i][1]),
			);
    	}
        //p($data);die;
		$res= M('office')->addAll($data);
		
		$this->display();
		if($res){
			$this->success("导入处室成功！",U(GROUP_NAME.'/Basicdata/office'));
		}else{
			$this->error("导入处室失败！");
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

/**
 * 专业维护
 */
public function professional(){
//列表
	$professional = M('professional')->select();
    $this->assign('professional',$professional);
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
	 	$data=array('name'=>trim($_POST['name']));
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
		$Professionals = $_POST['professionals'];	    
		//按行将数据保存至数组中
		$Professionals = explode("\n",$Professionals);	
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($Professionals);$i++){
		   $Professional[$i] = explode("\t",$Professionals[$i]);
		}
		//开始写入数据库表		
		$data = array();
	   for($i=0;$i<count($Professional);$i++){
			$data[$i] = array(
				'name'=>trim($Professional[$i][1]),
			);
    	}
        //p($data);die;
		$res= M('professional')->addAll($data);
		
		$this->display();
		if($res){
			$this->success("导入专业成功！",U(GROUP_NAME.'/Basicdata/professional'));
		}else{
			$this->error("导入专业失败！");
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

/**
 * 课程维护
 */
public function course(){
//列表
	$course = M('course')->order('proname ASC')->select();
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
	 	$data=array(
	 		'name'=>trim($_POST['name']),
	 		'proname'=>trim($_POST['proname'])
	 	);

	 	if($id==0){
	 		//添加处理
		 	$res=M('course')->add($data);
		}else{
		 	//修改处理
		 	$data['id']=$id;
	 		$res=M('course')->save($data);
		}
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
		$courses = $_POST['courses'];	    
		//按行将数据保存至数组中
		$courses = explode("\n",$courses);	
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($courses);$i++){
		   $course[$i] = explode("\t",$courses[$i]);
		}
		//开始写入数据库表		
		$data = array();
	    for($i=0;$i<count($course);$i++){
			$data[$i] = array(
				'name'=>trim($course[$i][1]),
				'proname'=>trim($course[$i][2]),
			);
    	}
        //p($data);die;
		$res= M('course')->addAll($data);
		
		$this->display();
		if($res){
			$this->success("导入课程成功！",U(GROUP_NAME.'/Basicdata/course'));
		}else{
			$this->error("导入课程失败！");
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
	$classes = M('classes as a')->join("xh_teacher as b on a.master=b.jsno")->field("a.id,a.ccode,a.cname,b.offname,b.jsxm,b.jsdh,a.zjsj,a.proname")->order('ccode ASC,proname ASC')->select();
	//print_r($classes);die;
    $this->assign('classes',$classes);
	$this->display();
}
public function saveClasses(){
//添加和修改视图
	 $id = (int)$_GET['id'];
	 //查询学期用于组建时间
	 $term=M('term')->order('name DESC')->select();
	 $this->assign('term',$term);
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
	 	$master = explode("-",$_POST['master']);
	 	$master = $master[0];
	 	$data=array(
	 	 		'cname'=>trim($_POST['cname']),
	 	 		'master'=>trim($master),
	 	 		'zjsj'=>trim($_POST['zjsj']),
	 	 		'proname'=>trim($_POST['proname'])
	 	 );
	 	if($id==0){
	 		$data['ccode']=trim($_POST['ccode']); //编辑时，由于ccode不允许改动，会被系统过滤
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
		$classesm = $_POST['classesm'];	
		//按行将数据保存至数组中
		$classesm = explode("\n",$classesm);	
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($classesm);$i++){
		   $classes[$i] = explode("\t",$classesm[$i]);
		}
		//开始写入数据库表		
		$data = array();
	    for($i=0;$i<count($classes);$i++){
			$data[$i] = array(
				'ccode'=>trim($classes[$i][1]),
				'cname'=>trim($classes[$i][2]),
				'master'=>trim($classes[$i][3]),
				'zjsj'=>trim($classes[$i][4]),
				'proname'=>trim($classes[$i][5]),
			);
    	}
        //p($data);die;
		$res= M('classes')->addAll($data);
		
		$this->display();
		if($res){
			$this->success("导入班级成功！",U(GROUP_NAME.'/Basicdata/classes'));
		}else{
			$this->error("导入班级失败！");
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
/**
 * 教师维护
 */
public function teacher(){
//列表
	$teacher = M('teacher')->order('offname ASC,jsno ASC')->select();
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
	 	$data=array(
	 	 		'jsxm'=>trim($_POST['jsxm']),
	 	 		'jsxb'=>trim($_POST['jsxb']),
	 	 		'jsdh'=>trim($_POST['jsdh']),
	 	 		'jsmm'=>'123456',
	 	 		'offname'=>trim($_POST['offname'])
	 	 	);

	 	if($id==0){
	 		$data['jsno']=trim($_POST['jsno']);
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

		$teachers = $_POST['teachers'];
	    //p($teachers);die;
		//按行将数据保存至数组中
		$teachers = explode("\n",$teachers);
		
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($teachers);$i++){
		   $teacher[$i] = explode("\t",$teachers[$i]);
		}

		//开始写入数据库表		
		$data = array();
	   for($i=0;$i<count($teacher);$i++){
			$data[$i] = array(
				'jsno'=>trim($teacher[$i][1]),
				'jsxm'=>trim($teacher[$i][2]),
				'jsxb'=>trim($teacher[$i][3]),
				'jsdh'=>trim($teacher[$i][4]),
				'jsmm'=>'123456',
				'offname'=>trim($teacher[$i][5])
			);
    	}
        //p($data);die;
		$res= M('teacher')->addAll($data);
		
		$this->display();
		if($res){
			$this->success("导入成功！",U(GROUP_NAME.'/Basicdata/teacher'));
		}else{
			$this->error("导入失败！");
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
	$id = $_GET['id'];
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
//列表]

/*
    import('ORG.Util.Page');// 导入分页类
    $count = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->count();// 查询满足要求的总记录数
    $Page  = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
    $show  = $Page->show();// 分页显示输出
*/
	$student = M('student as a')->join("xh_classes as b on a.ccode=b.ccode","left")->field("a.id,a.xsno,a.xsxm,a.xsxb,a.rxsj,b.cname")->order('a.ccode ASC,a.id ASC')->select();
	//p($student);die;
	//$this->assign('page',$show);// 赋值分页输出
    $this->assign('student',$student);
	$this->display();
}
public function saveStudent(){
//添加和修改视图
	 $id = (int)$_GET['id'];
	 //查询学期为学生指定入学时间
	 $term = M('term')->order('name DESC')->select();
	 $this->assign('term',$term);
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
	 	//处理班级编号
	 	$ccode = explode("-",$_POST['ccode']);
	 	$ccode=$ccode[0];
	 	$data=array(
	 	 		'xsxm'=>trim($_POST['xsxm']),
	 	 		'xsxb'=>trim($_POST['xsxb']),
	 	 		'rxsj'=>trim($_POST['rxsj']),
	 	 		'xsmm'=>'123456',
	 	 		'ccode'=>trim($ccode)
	 	);
	 	if($id==0){
	 		$data['xsno']=trim($_POST['xsno']);
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

		$students = $_POST['students'];
	    
		//按行将数据保存至数组中
		$students = explode("\n",$students);
		
		//对一维数组进行进一步处理，让其成为二维数组
		for($i=0;$i<count($students);$i++){
		   $student[$i] = explode("\t",$students[$i]);
		}

		//开始写入数据库表		
		$data = array();
	   for($i=0;$i<count($student);$i++){
			$data[$i] = array(
				'xsno'=>trim($student[$i][1]),
				'xsxm'=>trim($student[$i][2]),
				'xsxb'=>trim($student[$i][3]),
				'rxsj'=>trim($student[$i][4]),
				'xsmm'=>'123456',
				'ccode'=>trim($student[$i][5])
			);
    	}
        //p($data);die;
		$res= M('student')->addAll($data);
		
		$this->display();
		if($res){
			$this->success("导入成功！",U(GROUP_NAME.'/Basicdata/student'));
		}else{
			$this->error("导入失败！");
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
	$id = $_GET['id'];
	$res=M('student')->delete($id);
	if($res){
		$this->success("删除成功！",U(GROUP_NAME.'/Basicdata/student'));
	}else{
		$this->error("删除失败！");
	}
} 

}
?>

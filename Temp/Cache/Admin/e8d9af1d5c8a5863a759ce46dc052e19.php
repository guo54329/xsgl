<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style type="text/css">
.page{
	text-align: right;
}
</style>
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
function resetpass(obj){
     var studentid = obj.id;
     $.ajax({
            url:"<?php echo U(GROUP_NAME.'/Basicdata/resetStudentPass');?>",
            data: { id: studentid },
            type:"POST",
            success: function (res) {
            	if(res==1){
            		alert('该学生登录密码已重置为123456，请及时提醒修改！');
            	}else{
            		alert('该生可能还在使用处室密码，重置失败！');
            	}
                
            }
    });    
}
</script>
<style type="text/css">
	.btn-danger{
		width:90px;
	}
	.footeralign{
		text-align: left;
	}
</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading">学生信息维护 </div>
	  <div class="panel-footer footeralign">
	     <form action="<?php echo U(GROUP_NAME.'/Basicdata/student');?>" method="post">
	       <div class="form-inline">
	  			<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveStudent');?>" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> 添加</a>&nbsp;
	 			 <a href="<?php echo U(GROUP_NAME.'/Basicdata/importStudent');?>" class="btn btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 导入</a>&nbsp;&nbsp;
			      <select name="ccode" class="form-control">
			         <option value=''>请选择班级</option>
			      	 <?php if(is_array($ccodes)): foreach($ccodes as $key=>$v): ?><option value="<?php echo ($v["ccode"]); ?>"><?php echo ($v["ccode"]); ?></option><?php endforeach; endif; ?>
			      </select>
			      <input type="text" name="stu" class="form-control" placeholder="清输入学号或姓名">
			      <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
			      &nbsp;&nbsp;<span>如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</span>
	  		</div>
		  </form>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>学号</td><td>姓名</td><td>性别</td><td>入学时间</td><td>所在班级</td><td>操作</td></tr>
			<?php $i=1;?>
			<?php if(is_array($student)): foreach($student as $key=>$v): ?><tr>
				<td><?php echo ($i); ?></td>
				<td><?php echo ($v["xsno"]); ?></td>
				<td><?php echo ($v["xsxm"]); ?></td>
				<td><?php echo ($v["xsxb"]); ?></td>
				<td><?php echo ($v["rxsj"]); ?></td>
				<td><?php echo ($v["cname"]); ?></td>
				<td>
					<button  class="btn btn-danger" id="<?php echo ($v["id"]); ?>" onclick="resetpass(this)"><span class="glyphicon glyphicon-asterisk"></span> 重置密码</button>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveStudent',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/delStudent',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>
				</td>
			</tr>
			<?php $i++; endforeach; endif; ?>

		</table>
		<div class="page"><?php echo ($page); ?></div>
	  </div>
	  
</div>
</body>
</html>
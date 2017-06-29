<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />

<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
function resetpass(obj){
     var teacherid = obj.id;
     $.ajax({
            url:"<?php echo U(GROUP_NAME.'/Basicdata/resetTeacherPass');?>",
            data: { id: teacherid },
            type:"POST",
            success: function (res) {
            	if(res==1){
            		alert('该教师登录密码已重置为123456，请及时提醒修改！');
            	}else{
            		alert('该教师可能还在使用初始密码，重置失败！');
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
	  <div class="panel-heading">教师信息维护 </div>
	  <div class="panel-footer footeralign">
	  	  <form action="<?php echo U(GROUP_NAME.'/Basicdata/teacher');?>" method="post">
	  	    <div class="form-inline">
	  			<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveTeacher');?>" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> 添加</a>&nbsp;
	  			<a href="<?php echo U(GROUP_NAME.'/Basicdata/importTeacher');?>" class="btn btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 导入</a>&nbsp;&nbsp;
			      <select name="offname" class="form-control">
			         <option value=''>请选择处室</option>
			      	 <?php if(is_array($offnames)): foreach($offnames as $key=>$v): ?><option value="<?php echo ($v["offname"]); ?>"><?php echo ($v["offname"]); ?></option><?php endforeach; endif; ?>
			      </select>
			      <input type="text" name="tea" class="form-control" placeholder="清输入帐号或姓名">
			      <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
			  </div>
		   </form>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>编号</td><td>姓名</td><td>性别</td><td>联系电话</td><td>所在处室</td><td>操作</td></tr>
			<?php if(is_array($teacher)): foreach($teacher as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["jsno"]); ?></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["jsxb"]); ?></td>
				<td><?php echo ($v["jsdh"]); ?></td>
				<td><?php echo ($v["offname"]); ?></td>
				<td>
					<button  class="btn btn-danger" id="<?php echo ($v["id"]); ?>" onclick="resetpass(this)"><span class="glyphicon glyphicon-asterisk"></span> 重置密码</button>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveTeacher',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/delTeacher',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
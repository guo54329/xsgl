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
	.headalign{
		text-align: left;
	}
	.btncoursetable{
		width:90px;
		text-align: left;
	}	
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
	.form-inline{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 16px;
		
		height:40px;
		line-height:40px;
	 }
	 .btn6{
	 	width: 120px;
	 }
</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 教师维护</a>
		<a href="<?php echo U(GROUP_NAME.'/Basicdata/resetTEA');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 清除演示数据</a>(注意：请在系统部署好使用之前使用该功能！)
		<span style="float: right;">
	     	<a  href="<?php echo U(GROUP_NAME.'/Basicdata/saveTeacher');?>"  class="btn btn4 btn-info"><span class="glyphicon glyphicon-plus"></span> 添加教师</a>
	     	<a href="<?php echo U(GROUP_NAME.'/Basicdata/importTeacher');?>" class="btn btn4 btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 批量导入</a>
	     	<div style="display: none;">如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</div>
	     </span>
	  </div>
	  <div class="form-inline">
	  	  <form action="<?php echo U(GROUP_NAME.'/Basicdata/teacher');?>" method="post">
	  	    <select name="offname" class="form-control">
			   <option value=''>请选择处室</option>
			   <?php if(is_array($offnames)): foreach($offnames as $key=>$v): ?><option value="<?php echo ($v["offname"]); ?>"><?php echo ($v["offname"]); ?></option><?php endforeach; endif; ?>
			</select>
			<input type="text" name="tea" class="form-control" placeholder="清输入帐号或姓名">
			<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
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
					<button  class="btn btn-danger btn4" id="<?php echo ($v["id"]); ?>" onclick="resetpass(this)"><span class="glyphicon glyphicon-asterisk"></span> 重置密码</button>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveTeacher',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/delTeacher',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
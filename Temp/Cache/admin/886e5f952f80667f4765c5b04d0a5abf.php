<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('.add-role').click(function(){
			var obj=$(this).parents('tr').clone();
			obj.find('.add-role').remove();
			$('#last').before(obj);
		});
	});

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
</style>
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Rbac/editUser');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a href="<?php echo U(GROUP_NAME.'/Rbac/index');?>" class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 用户列表</a><span class="btn xiexian">/</span><a  class="btn btn4">配置角色</a>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>用户帐号</td>
				<td align="left"><?php echo ($user['username']); ?></td>
			</tr>
			
			<tr>
				<td>配置角色</td>
				<td>
				<div class="form-inline">
					<select name="role_id[]" class="form-control" style="width: 350px;">
						<?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)</option><?php endforeach; endif; ?>
					</select>
					<a class="add-role btn btn-info btn4"><span class='glyphicon glyphicon-plus'>添加角色</span></a>
				</div>
				</td>
			</tr>
			<tr id='last'></tr>
		</table>	
	  </div>
	  <div class="panel-footer" style="text-align: center;">
	    <input type="hidden" name="id" value="<?php echo ($user['id']); ?>">
	    <button type="submit" class="btn btn-info btn4"><span class="glyphicon glyphicon-check"></span> 提交配置</button>
	  
	  </div>
</div>
</form>
</body>
</html>
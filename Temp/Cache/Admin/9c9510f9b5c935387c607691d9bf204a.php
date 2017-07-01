<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<style>
.add-role{
	display: inline-block;
	width: 120px;
	height: 34px;
	line-height: 34px;
	text-align: center;
	border:1px solid #ccc;
	border-radius: 4px;
	margin-left: 20px;
	cursor: pointer;
}
</style>
<script type="text/javascript">
	$(function(){
		$('.add-role').click(function(){
			var obj=$(this).parents('tr').clone();
			obj.find('.add-role').remove();
			$('#last').before(obj);
		});
	});

</script>
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Rbac/editUser');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading">配置角色</div>
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
					<select name="role_id[]" class="form-control">
						<?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)</option><?php endforeach; endif; ?>
					</select>
					<span class='add-role'>添加一个角色</span>
				</div>
				</td>
			</tr>
			<tr id='last'></tr>
		</table>	
	  </div>
	  <div class="panel-footer">
	    <input type="hidden" name="id" value="<?php echo ($user['id']); ?>">
	  	<input type='submit'  value='提交配置' class="btn btn-info"/>
	  </div>
</div>
</form>
</body>
</html>
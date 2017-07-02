<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Rbac/editRole');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading">修改角色</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td width='30%'>角色名称(英文)</td>
				<td width='70%'><input type='text' name='name' value="<?php echo ($role["name"]); ?>" class='form-control' style="width: 500px;"/></td>
			</tr>
			<tr>
				<td>角色描述(中文)</td>
				<td><input type='text' name='remark' value="<?php echo ($role["remark"]); ?>" class='form-control' style="width: 500px;"/></td>
			</tr>
			<tr>
				<td>是否开启：</td>
				<td style="text-align: left;"><label class="checkbox-inline"><input type='radio' name='status' value='1' checked='checked'/>&nbsp;开启&nbsp;</label>
					<label class="checkbox-inline"><input type='radio' name='status' value='0'/>&nbsp;关闭</label>
				</td>
			</tr>
			
		</table>	
	  </div>
	  <div class="panel-footer">
	  	<input type='hidden'  value="<?php echo ($role["id"]); ?>" name='id'/>
	  	<button type="submit" class="btn btn-info btn4"><span class="glyphicon glyphicon-check"></span> 提交修改</button>
	  </div>
</div>
</form>
</body>
</html>
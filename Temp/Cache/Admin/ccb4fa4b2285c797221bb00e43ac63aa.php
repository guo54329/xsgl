<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Rbac/addNode');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading">添加节点</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td><?php echo ($type); ?>名称(英文)</td>
				<td><input type='text' name='name' class='form-control' /></td>
			</tr>
			<tr>
				<td><?php echo ($type); ?>描述(中文)</td>
				<td><input type='text' name='title'  class='form-control'/></td>
			</tr>
			<tr>
				<td>是否开启：</td>
				<td><label class="checkbox-inline"><input type='radio' name='status' value='1' checked='checked'/>&nbsp;开启&nbsp;</label>
					<label class="checkbox-inline"><input type='radio' name='status' value='0'/>&nbsp;关闭</label>
				</td>
			</tr>
			<tr>
				<td>排序</td>
				<td><input type='text' name='sort'  class='form-control' value='1'/></td>
			</tr>
		</table>	
	  </div>
	  <div class="panel-footer">
	  	<input type='hidden' name='pid' value='<?php echo ($pid); ?>'/>
	  	<input type='hidden' name='level' value='<?php echo ($level); ?>'/>
	  	<input type='submit'  value='添加' class="btn btn-info"/>
	  </div>
</div>
</form>
</body>
</html>
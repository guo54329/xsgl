<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
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
<form action='<?php echo U(GROUP_NAME.'/Rbac/addRole');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a href="<?php echo U(GROUP_NAME.'/Rbac/role');?>" class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 角色列表</a><span class="btn xiexian">/</span><a  class="btn btn4">添加角色</a>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>角色名称(英文)</td>
				<td><input type='text' name='name' class='form-control' style="width: 500px;"/></td>
			</tr>
			<tr>
				<td>角色描述(中文)</td>
				<td><input type='text' name='remark' class='form-control' style="width: 500px;"/></td>
			</tr> 
			<tr>
				<td>是否开启：</td>
				<td style="text-align: left;"><label class="checkbox-inline"><input type='radio' name='status' value='1' checked='checked'/>&nbsp;开启&nbsp;</label>
					<label class="checkbox-inline"><input type='radio' name='status' value='0'/>&nbsp;关闭</label>
				</td>
			</tr>
			
		</table>	
	  </div>
	  <div class="panel-footer" style="text-align: center;">
	  	<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
</form>
</body>
</html>
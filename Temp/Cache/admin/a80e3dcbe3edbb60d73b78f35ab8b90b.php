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
		width:110px;
		text-align: left;
	}
</style>
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/System/site');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 系统全局设置</a>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>	
			<tr>
				<td width="20%">网站名称</td>
				<td><input type='text' name='title' value='<?php echo ($site["title"]); ?>' class="form-control" /></td>
			</tr>
			<tr>
			    <td>网站描述</td>
				<td><textarea name='description' style="margin: 0px; height: 63px;" class="form-control"><?php echo ($site["description"]); ?></textarea></td>
			</tr>
			<tr>
			    <td>网站关键字</td>
			    <td><input type='text' name='keywords' value='<?php echo ($site["keywords"]); ?>' class="form-control" /></td>
			</tr>
			<tr> 
			    <td>版权信息</td>
				<td><input type='text' name='copyright' value='<?php echo ($site["copyright"]); ?>' class="form-control" /></td>
		    </tr>
			<tr>
			    <td>网站备案</td>
			    <td><input type='text' name='icp' value='<?php echo ($site["icp"]); ?>' class="form-control" /></td>
			</tr>
			<tr>
			    <td>联系地址</td>
			    <td><input type='text' name='address' value='<?php echo ($site["address"]); ?>' class="form-control" /></td></tr>

			<tr>
			    <td >单位名称</td>
			    <td><input type='text' name='departdesc' value='<?php echo ($g_partment["description"]); ?>' class="form-control" /></td>
			</tr>
			<tr>
			    <td>单位网址</td>
			    <td><input type='text' name='departaddr' value='<?php echo ($g_partment["address"]); ?>' class="form-control" /></td>
			</tr>

		</table>	
	  </div>
	  <div class="panel-footer" style="text-align: center;">
	  		<button type='submit' class="btn btn4 btn-info"><span class="glyphicon glyphicon-check"></span> 提交设置</button>
	  </div>
</div>
</form>
</body>
</html>
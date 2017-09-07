<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style type="text/css">
	.btn-info{
		width:100px;
	}
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
<div class="panel panel-default">
	  <div class="panel-heading headalign">
			<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 个人登录信息</a>
  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr><td>现用帐户：</td><td align="left"><?php echo ($user["username"]); ?></td></tr>	
		    <tr><td>上次登录时间：</td><td align="left"><?php echo (date('Y-m-d H:i:s',$user["logintime"])); ?></td></tr>	
		    <tr  style="border-bottom: 1px solid #ddd;"><td>上次登录IP：</td><td align="left"><?php echo ($user["loginip"]); ?></td></tr>		   	
		</table>	
	  </div>
	 
</div>
</body>
</html>
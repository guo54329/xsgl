<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
	<style type="text/css">
		tr{
			height: 40px;
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
  <!-- Default panel contents -->
  <div class="panel-heading headalign">
			<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 个人信息</a>
  </div>
  <div class="panel-body">
        <table class="table table-bordered table-hover">
			<tr><td>帐号</td><td align="left"><?php echo ($tea["jsno"]); ?></td></tr>
			<tr><td>姓名</td><td align="left"><?php echo ($tea["jsxm"]); ?></td></tr>
			<tr><td>处室</td><td align="left"><?php echo ($tea["offname"]); ?></td></tr>
     	</table>
	</div>		    
       
</div>
</body>
</html>
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
	</style>
</head>
<body>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><?php echo ($wel); ?></div>
  <div class="panel-body">
        <table class="table table-striped">
			<tr><td>帐号</td><td><?php echo ($tea["jsno"]); ?></td></tr>
			<tr><td>姓名</td><td><?php echo ($tea["jsxm"]); ?></td></tr>
			<tr><td>处室</td><td><?php echo ($tea["offname"]); ?></td></tr>
			<tr><td>登录时间</td><td><?php echo (date('Y-m-d H:i:s',$tea["logintime"])); ?></td></tr>
			<tr  style="border-bottom: 1px solid #ddd;"><td>登录IP</td><td><?php echo ($tea["loginip"]); ?></td></tr>
     	</table>
	</div>		    
       
</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
</head>
<body>
<div class="panel panel-default">
	  <div class="panel-heading">个人帐户</div>
	  <div class="panel-body">
		<table class='table table-striped'>
			<tr><td>现用帐户：</td><td><?php echo ($user["username"]); ?></td></tr>	
		    <tr><td>上次登录时间：</td><td><?php echo (date('Y-m-d H:i:s',$user["logintime"])); ?></td></tr>	
		    <tr  style="border-bottom: 1px solid #ddd;"><td>上次登录IP：</td><td><?php echo ($user["loginip"]); ?></td></tr>		   	
		</table>	
	  </div>
	 
</div>
</body>
</html>
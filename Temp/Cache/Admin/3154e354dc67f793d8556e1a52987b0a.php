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
  <!-- Default panel contents -->
	  <div class="panel-heading">系统配置信息</div>
	  <div class="panel-body">
	        <table class="table table-bordered table-hover">
			<tr><td>服务器软件</td><td><?php echo ($sinfor["f1"]); ?></td></tr>
			<tr><td>开发语言</td><td><?php echo ($sinfor["f2"]); ?></td></tr>
			<tr><td>数据库软件</td><td><?php echo ($sinfor["f3"]); ?></td></tr>
			<!--<tr><td align='right'>本主机信息</td><td><?php echo ($sinfor["f4"]); ?></td></tr>-->
			<tr><td>服务器IP</td><td><?php echo ($sinfor["f5"]); ?></td></tr>
			<tr><td>服务器域名</td><td><?php echo ($sinfor["f6"]); ?></td></tr>
			<tr><td>服务器端口</td><td><?php echo ($sinfor["f7"]); ?></td></tr>
			<tr><td>Zend版本</td><td><?php echo ($sinfor["f8"]); ?></td></tr>
	     </table>
	   </div>
       
</div>
</body>
</html>
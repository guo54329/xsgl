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
	  <div class="panel-heading"><?php echo ($wel); ?></div>
	  <div class="panel-body">
	        <table class="table table-striped">
				<tr><td>帐号</td><td><?php echo ($stu["xsno"]); ?></td></tr>
				<tr><td>姓名</td><td><?php echo ($stu["xsxm"]); ?></td></tr>
				<tr><td>班级</td><td><?php echo ($stu["cname"]); ?></td></tr>
				<tr><td>入学时间</td><td><?php echo ($stu["rxsj"]); ?></td></tr>
				<tr><td>登录时间</td><td><?php echo (date('Y-m-d H:i:s',$stu["logintime"])); ?></td></tr>
				<tr style="border-bottom: 1px solid #ddd;"><td>登录IP</td><td><?php echo ($stu["loginip"]); ?></td></tr>
	        </table>
	    </div> 
</div>
</body>
</html>
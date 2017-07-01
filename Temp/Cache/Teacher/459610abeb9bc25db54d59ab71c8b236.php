<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
	<style type="text/css">
		.footeralign{
			text-align: left;
		}
	</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading">
		<h4><?php echo ($info["title"]); ?></h4><hr/>
		发布者：<?php echo ($info["userxm"]); ?> &nbsp;&nbsp; 发布时间：<?php echo (date('Y-m-d H:i:s',$info["pubtime"])); ?> &nbsp;&nbsp; 接收班级：<?php echo ($info["cname"]); ?>
	  </div>
	  <div class="panel-footer footeralign">
			<a href="<?php echo U(GROUP_NAME.'/News/news');?>" class="btn btn-info btnw"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返回</a>
	  </div>
	  <div class="panel-body">
　　　    <div  style="padding:10px 50px;"><?php echo ($info["content"]); ?></div>   
	  </div>
	 
</div>
</body>
</html>
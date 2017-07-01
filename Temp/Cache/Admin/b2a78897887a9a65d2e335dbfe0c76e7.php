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
	  <div class="panel-heading">
		<h4><?php echo ($info["title"]); ?></h4><hr/>
		发布者：<?php echo ($info["userxm"]); ?>&nbsp;&nbsp;发布时间：<?php echo (date('Y-m-d H:i:s',$info["pubtime"])); ?>&nbsp;&nbsp; 接收对象：<?php if($info['pubtype'] == 1): ?>所有教师和学生<?php endif; ?>
					<?php if($info['pubtype'] == 2): ?>所有教师<?php endif; ?>
					<?php if($info['pubtype'] == 3): ?>所有学生<?php endif; ?>
					<?php if($info['pubtype'] == 4): ?>班级:<?php echo ($info["cname"]); endif; ?>

	  </div>
	  <div class="panel-body">
　　　    <div  style="padding:10px 50px;"><?php echo ($info["content"]); ?></div>   
	  </div>
	 <div class="panel-footer"><a href="<?php echo U(GROUP_NAME.'/Home/news');?>" class="btn btn-info">返回</a></div>
</div>
</body>
</html>
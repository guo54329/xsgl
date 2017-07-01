<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
</head>

<body>
<form  action='<?php echo U(GROUP_NAME.'/System/reset');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading">系统重置</div>
	  <div class="panel-body">
　　　1、进行该操作后，将会清空“教师”、“班级”、“学生”和“友情链接”、“留言板”、“新闻通知公告”、“课程资源”等相关数据，使系统恢复到相对初始状态。<br/>
　　　2、系统权限(节点)管理不作处理，站点信息、角色配置、管理员信息、学校信息请在admin(超级管理员)进行维护，不做初始化处理。<br/>
　　　3、该操作属于系统管理员，请谨慎操作，否则影响所有第1条中涉及的数据，若需要请先备份数据，再重置！    
	  </div>
	  <div class="panel-footer">
	        <input type="hidden" name="ok" value="ok">
			<button class="btn btn-info" type="submit" name="reset"><span class="glyphicon glyphicon-exclamation-sign"></span> 重置</button>
	  </div>
</div>
</form>
</body>
</html>
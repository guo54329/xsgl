<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
<title><?php echo ($g_site["title"]); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="__FAVICON__/fav.ico" type="image/x-icon" />
<link rel="Bookmark" href="__FAVICON__/fav.ico" >
<link type="text/css" rel="stylesheet" href="__PUBLIC__/Css/style.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/menu.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/time.js"></script>

<!--[if lt IE 9]>
      <script src="__PUBLIC__/Js/html5shiv.min.js"></script>
      <script src="__PUBLIC__/Js/respond.min.js"></script>
<![endif]-->

<!--[if lt IE 9]>
      <script src="__PUBLIC__/Js/jquery.placeholder.min.js"></script>
	  <script src="__PUBLIC__/Js/backgroundsize.min.htc"></script>	  
      <script>
        $(function(){ $('input, textarea').placeholder(); });
      </script>
	  
 <![endif]-->
</head>

<body onload="startTime()">
<div class="top"></div>
<div id="header">
	<div class="logo"><?php echo ($g_site["title"]); ?></div>
	<div class="navigation">
		<ul>
      <li><a href="<?php echo U(GROUP_NAME.'/Index/resetTEMP');?>" class="btn">清空缓存</a></li>
      <li><a href="<?php echo U(GROUP_NAME.'/Index/index');?>" class="btn">控制台</a></li>
			<li>欢迎您，<a href="<?php echo U(GROUP_NAME.'/Index/welcome');?>" target='nr'><?php echo ($jsxm); ?></a>！</li>
			<li><a href="<?php echo U(GROUP_NAME.'/Userinfor/editUserpass');?>" target='nr'>修改密码</a></li>
			<li><a href="<?php echo U(GROUP_NAME.'/Login/logout');?>">退出</a></li>
		</ul>

		<ul>
		 	<li>系统时间：<span id="txt"></span></li>
		</ul>
	</div>
</div>

<div id="content">
	<div class="left_menu">
	<ul id="nav_dot">
	    <li style="margin-top:10px;display:block;">
          <h4 class="M6"><span></span>系统消息管理</h4>
          <div class="list-item none">
           <a href="<?php echo U(GROUP_NAME.'/Index/welcome');?>" target='nr'>控制台</a>
           <a href="<?php echo U(GROUP_NAME.'/News/sysNews');?>" target='nr'>查看系统消息</a>
           <a href="<?php echo U(GROUP_NAME.'/News/newsSave');?>" target='nr'>发布系统消息</a>
           <a href="<?php echo U(GROUP_NAME.'/News/news');?>" target='nr'>管理现有消息</a>
            
        </li>
        <li style="margin-top:10px;display:block;">
          <h4 class="M4"><span></span>实训任务管理</h4>
          <div class="list-item none">
            <a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" target='nr'>我的课程表</a>
            
        </li>

		<li>
          <h4   class="M10"><span></span>个人信息维护</h4>
          <div class="list-item none">
            <a href="<?php echo U(GROUP_NAME.'/Userinfor/userinfor');?>" target='nr'>个人资料查看</a>
            <a href="<?php echo U(GROUP_NAME.'/Userinfor/editUserpass');?>" target='nr'>修改登录密码</a>
          </div>
        </li>
       
  </ul>
		</div>
		<div class="m-right">
			<div class="main">
				<iframe name="nr" src="<?php echo U(GROUP_NAME.'/Index/welcome');?>" style="width:100%;height:100%;"  frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="yes" allowtransparency="yes"></iframe>
			</div>
		</div>
</div>
<div class="bottom"></div>
<div id="footer"><p><?php echo ($g_site["copyright"]); ?> <?php echo ($g_site["icp"]); ?></p></div>
<script>navList(12);</script>
</body>
</html>
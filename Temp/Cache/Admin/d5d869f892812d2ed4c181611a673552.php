<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
<title><?php echo ($g_site["title"]); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="__PUBLIC__/Images/favicon.png" type="image/x-icon" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/Css/index.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/menu.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/time.js"></script>

</head>

<body onload="startTime()">
<div class="top"></div>
<div id="header">
	<div class="logo"><?php echo ($g_site["title"]); ?></div>
	<div class="navigation">
		<ul>
		 	<li>欢迎您！</li>
			<li><a href="<?php echo U(GROUP_NAME.'/Userinfor/index');?>" target='nr'><?php echo ($username); ?></a></li>
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
          <h4 class="M8"><span></span>站点运行设置</h4>
          <div class="list-item none">
            <a href="<?php echo U(GROUP_NAME.'/System/systeminfor');?>" target='nr'>站点运行环境</a>
            <a href="<?php echo U(GROUP_NAME.'/System/site');?>" target='nr'>站点信息设置</a>
            <a href="<?php echo U(GROUP_NAME.'/System/backup');?>" target='nr'>
            数据表管理</a>
            <a href="<?php echo U(GROUP_NAME.'/System/verify');?>" target='nr'>验证码设置</a>
            <a href="<?php echo U(GROUP_NAME.'/System/reset');?>"  target='nr'>系统初始化</a>
          </div>
        </li>

        <li>
          <h4  class="M3"><span></span>系统权限管理</h4>
          <div class="list-item none">
            
            <a href="<?php echo U(GROUP_NAME.'/Rbac/role');?>" target='nr'>角色管理列表</a>
            <a href="<?php echo U(GROUP_NAME.'/Rbac/node');?>" target='nr'>节点管理列表</a>
            <a href="<?php echo U(GROUP_NAME.'/Rbac/index');?>" target='nr'>用户管理列表</a>
          </div>
        </li>
        <li>
          <h4  class="M6"><span></span>系统消息维护</h4>
          <div class="list-item none"><!--
          <a href="<?php echo U(GROUP_NAME.'/Home/school');?>" target='nr'>更新学校简介</a>
          <a href="<?php echo U(GROUP_NAME.'/Home/link');?>" target='nr'>友情链接维护</a>-->
          <a href="<?php echo U(GROUP_NAME.'/Home/news');?>" target='nr'>现有消息列表</a>
          <!--<a href="<?php echo U(GROUP_NAME.'/Home/vedio');?>" target='nr'>微课资源维护</a>
          <a href="<?php echo U(GROUP_NAME.'/Home/discuss');?>" target='nr'>留言板维护</a>-->
          </div>
        </li>      

        <li>
          <h4 class="M9"><span></span>基础数据维护</h4>
          <div class="list-item none">
           <a href="<?php echo U(GROUP_NAME.'/Basicdata/term');?>"     target='nr'>学期数据维护</a>
           <a href="<?php echo U(GROUP_NAME.'/Basicdata/professional');?>"     target='nr'>专业数据维护</a>
           <a href="<?php echo U(GROUP_NAME.'/Basicdata/office');?>"     target='nr'>处室数据维护</a>
          <a href="<?php echo U(GROUP_NAME.'/Basicdata/course');?>"     target='nr'>课程数据维护</a>
          <a href="<?php echo U(GROUP_NAME.'/Basicdata/teacher');?>"     target='nr'>教师数据维护</a>
          <a href="<?php echo U(GROUP_NAME.'/Basicdata/classes');?>"     target='nr'>班级数据维护</a>
          <a href="<?php echo U(GROUP_NAME.'/Basicdata/student');?>"    target='nr'>学生数据维护</a> 
           </div>
        </li>
        
        <hr/><li>
          <h4 class="M4"><span></span>实训作业管理</h4>
          <div class="list-item none">

            <a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" target='nr'>教师任课情况</a>
          
          </div>
        </li>

				<hr/><li>
          <h4   class="M10"><span></span>个人信息维护</h4>
          <div class="list-item none">
            <a href="<?php echo U(GROUP_NAME.'/Userinfor/index');?>" target='nr'>个人资料查看</a>
            <a href="<?php echo U(GROUP_NAME.'/Userinfor/editUserpass');?>" target='nr'>修改登录密码</a>
          </div>
        </li>
        
  </ul>
		</div>
		<div class="m-right">
			<div class="main">
				<iframe name="nr" src="<?php echo U(GROUP_NAME.'/System/systeminfor');?>" style="width:100%;height:100%;"  frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="yes" allowtransparency="yes"></iframe>
			</div>
		</div>
</div>
<div class="bottom"></div>
<div id="footer"><p><?php echo ($g_site["copyright"]); ?> <?php echo ($g_site["icp"]); ?></p></div>
<script>navList(12);</script>
<script type="text/javascript" src="public/js/jquery.min.js"></script>
<script type="text/javascript" src="public/js/bootstrap.min.js"></script>
</body>
</html>
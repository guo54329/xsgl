<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
<title><?php echo ($g_site["title"]); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="__PUBLIC__/Images/favicon.png" type="image/x-icon" />
<link type="text/css" rel="stylesheet" href="__PUBLIC__/Css/style.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/menu.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/time.js"></script>
<script type="text/javascript">
	$(function(){

		$(".subm").click(function(){
			var dis = $(".ssubm").css('display','none');
			 if(dis=='none'){
			 	$(".ssubm").show();
			 }else{
				$(".ssubm").hide();
			 }
		});
	});
</script>
</head>

<body onload="startTime()">
<div class="top"></div>
<div id="header">
	<div class="logo"><?php echo ($g_site["title"]); ?></div>
	<div class="navigation">
		<ul>
			<li>欢迎您，<a href="<?php echo U(GROUP_NAME.'/Index/welcome');?>" target='nr'><?php echo ($xsxm); ?></a><!--(<?php echo ($sname); ?> <?php echo ($cname); ?>)-->！</li>
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
          <h4 class="M6"><span></span>系统信息查看</h4>
          <div class="list-item none">
            <a href="<?php echo U(GROUP_NAME.'/Index/welcome');?>" target='nr'>查看通知消息</a>
            </div>
        </li>
        <li style="margin-top:10px;display:block;">
          <h4 class="M4"><span></span>实训课作业管理</h4>
          <div class="list-item none">
            <a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList');?>" target='nr'>我的实训作业</a>
            </div>
        </li>

		<li>
          <h4   class="M10"><span></span>个人信息维护</h4>
          <div class="list-item none">
            <a href="<?php echo U(GROUP_NAME.'/Index/welcome');?>" target='nr'>个人资料查看</a>
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
<?php if (!defined('THINK_PATH')) exit();?><DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>欢迎使用<?php echo ($g_site["title"]); ?>-重置密码</title>
<link href="__PUBLIC__/Css/bootstrap.min.css" rel="stylesheet">
<link href="__PUBLIC__/Css/signin.css" rel="stylesheet">
</head>
<body>
<div class="signin">
    <div class="signin-head"><img src="__PUBLIC__/Images/login_head.jpg" style="width:120px;" alt="" class="img-circle"></div>
    <div class="form-group">
        <form class="form-signin" role="form" method="post" action="<?php echo U(GROUP_NAME.'/Index/fpass');?>">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                 </div>
                <input type="text" name="name" class="form-control" placeholder="帐号" required autofocus />
            </div>
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-tag"></span>
                 </div>
                <input type="text" name="zsxm" class="form-control" placeholder="姓名" required />
            </div>            
            <button class="btn btn-lg btn-warning btn-block" type="submit">提交重置密码</button>
        </form>
        <div class="sys"><span class="l">欢迎使用<?php echo ($g_site["title"]); ?></span><span class="r"><a href="<?php echo U(GROUP_NAME.'/Index/index');?>">返回登录</a></span></div>
    </div>
</div>
<div class="footer">    
    <div class="copyright">         
        <p><?php echo ($g_site["copyright"]); ?>&nbsp;&nbsp;<?php echo ($g_site["icp"]); ?> <!--<a href="/xsgl/index.php/Admin/">后台登录</a>--></p>
        <p><?php echo ($g_site["address"]); ?></p>        
    </div>    
</div>
</body>
</html>
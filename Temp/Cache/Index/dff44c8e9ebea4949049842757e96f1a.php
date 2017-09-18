<?php if (!defined('THINK_PATH')) exit();?>﻿<DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>欢迎使用<?php echo ($g_site["title"]); ?></title>
<link href="__PUBLIC__/Css/bootstrap.min.css" rel="stylesheet">
<link href="__PUBLIC__/Css/signin.css" rel="stylesheet">
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/bootstrap.min.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script>

<script type="text/javascript">	
	window.UEDITOR_HOME_URL='__ROOT__/Data/Ueditor/';
	window.onload =function(){
		window.UEDITOR_CONFIG.initialFrameWidth=370;
		window.UEDITOR_CONFIG.initialFrameHeight=120;
		window.UEDITOR_CONFIG.elementPathEnabled=false; //删除元素路径
		window.UEDITOR_CONFIG.wordCount=false;          //删除字数统计
		window.UEDITOR_CONFIG.autoHeightEnabled=false;
		
		//window.UEDITOR_CONFIG.scaleEnabled=true;
		window.UEDITOR_CONFIG.toolbars=[[
            'bold', 'italic', 'underline', 'selectall','simpleupload', 'insertimage', 'emotion','attachment'
            ]];
 
		window.UEDITOR_CONFIG.maximumWords=500;
		//TP里面的上传类，相关配置，此处没用到
		  //window.UEDITOR_CONFIG.imageUrl="<?php echo U(GROUP_NAME.'/Blog/upload');?>"; 
		  //window.UEDITOR_CONFIG.imagePath='__ROOT__/uploads/';

		//图片保存路径直接在Ueditor/php/config.json中配置imagePathFormat的值
		UE.getEditor('content'); //实例化编辑器

	}

</script>
</head>
<body>
<div class="signin">
	        <div class="tab-content">
				<div class="tab-pane active" id="tab-zhengtitu">
					<div class="signin-head">欢迎登录<?php echo ($g_site["title"]); ?></div>
					<div class="form-group">
						<form class="form-signin" role="form" method="post" action="<?php echo U(GROUP_NAME.'/Index/login');?>">
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
								 </div>
								<input type="text" name="username" id="username" class="form-control" placeholder="帐号" required autofocus />
							</div>
							<div class="input-group">
								<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span>
								</div>
								<input type="password" name="password" id="password" type="password" class="form-control" placeholder="密码" required />
							</div>
							<button class="btn btn-lg btn-warning btn-block" type="submit">单击此处登录</button>
						</form>
					</div>
				</div>

				<div class="tab-pane" id="tab-neibutu">
					<div class="signin-head">用户验证密码重置</div>
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
							<button class="btn btn-lg btn-warning btn-block" type="submit">提交密码重置</button>
						</form>
					</div>
				</div>

				<div class="tab-pane" id="tab-texietu">
					<div class="signin-head">用户满意度调查</div>
					<div class="form-group">
						<form class="form-signin3" role="form" method="post" action="<?php echo U(GROUP_NAME.'/Index/survey');?>">
							<div class="input-group">
								<textarea name='content' id='content' placeholder="建议意见区"></textarea>
								<div class="form-inline">
									<label class="radio-inline"><input type="radio" id="inlineCheckbox1" name="choice" value="1"> 非常满意</label>
									<label class="radio-inline"><input type="radio" id="inlineCheckbox1" name="choice" value="2"> 满意</label>
									<label class="radio-inline"><input type="radio" id="inlineCheckbox1" name="choice" value="3"> 较满意</label>
									<label class="radio-inline"><input type="radio" id="inlineCheckbox1" name="choice" value="4"> 不满意</label>
									<button class="btn btn-sm btn-warning btn-pos" type="submit"  style="float:right;padding:4px 10px;margin:0 0 4px 0;">提交</button>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
			<ul class="nav nav-tabs" role="tablist" id="feature-tab">
				<li class="active"><a href="#tab-zhengtitu" role="tab" data-toggle="tab">用户登录</a></li>
				<li><a href="#tab-neibutu" role="tab" data-toggle="tab">忘记密码</a></li>
				<li><a href="#tab-texietu" role="tab" data-toggle="tab">满意度调查</a></li>
			</ul>
		</div>
</div>
<div class="footer">	
    <div class="copyright">       	
        <p><?php echo ($g_site["copyright"]); ?>&nbsp;&nbsp;<?php echo ($g_site["icp"]); ?></p>
        <p><?php echo ($g_site["address"]); ?></p>        
    </div>    
</div>

</body>
</html>
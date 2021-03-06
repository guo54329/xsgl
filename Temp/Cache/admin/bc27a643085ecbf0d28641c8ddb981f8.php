<?php if (!defined('THINK_PATH')) exit();?>﻿<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/login.css" />
<script src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script src="__PUBLIC__/Js/dialog/layer.js"></script>
<script src="__PUBLIC__/Js/dialog.js"></script>
   
<SCRIPT type="text/javascript">
var URL = '<?php echo U(GROUP_NAME."/Login/verify");?>';

//更换验证码
function change_code(obj){
	$("#code").attr("src",URL+'/'+Math.random());
	return false;
}

$(function(){
      $("#login").click(function(){
      		var username = $("#username").val().trim();
      		var password = $("#password").val().trim();
      		var code = $("#codeid").val().trim();
			if(username==''){
				return dialog.error("用户名不能为空！");
			}
			if(password==''){
				return dialog.error("密码不能为空！");
			}
			if(code==''){
				return dialog.error("验证码不能为空！");
			}
            if(username!=''&&password!=''&code!=''){
            	var urlindex="<?php echo U(GROUP_NAME.'/Login/login');?>";
				var data = {'username':username,'password':password,'code':code};
		        // 执行异步请求  $.post
		        $.post(urlindex,data,function(result){
		        	
		            if(result.status == 0) {
		                return dialog.error(result.message);
		            }
		            if(result.status == 1) {
		                return dialog.success(result.message, "<?php echo U(GROUP_NAME.'/Index/index');?>");
		            }

		        },'JSON');
            }
			
      });
});
</SCRIPT>
 
</HEAD> 
<BODY>
<DIV class="top_div"></DIV>
<DIV style="background:white; margin: -120px auto auto; border: 1px solid #E7E7E7; border-image: none; width: 400px; height: 270px; text-align: center;">
		<DIV style="width: 165px; height: 95px; position: absolute;">
			<DIV class="tou"></DIV>
			<DIV class="initial_left_hand" id="left_hand"></DIV>
			<DIV class="initial_right_hand" id="right_hand"></DIV>
		</DIV>
		<div class="col-md-10" style="margin-left:30px;margin-top:40px;">
			<div class="form-group has-feedback">
			  <input type="text" class="form-control" id="username" name='username' placeholder="用户名..."> 
			</div>
			<div class="form-group has-feedback">
			  <input type="password" class="form-control" id="password" name='password' placeholder="密码...">
			</div>
			<div class="form-inline">
				  <input type="text" class="form-control" id="codeid" name='code' placeholder="验证码...">
			      <a href="javascript:void(change_code(this));"><img src="<?php echo U(GROUP_NAME.'/Login/verify');?>" id="code"/>
			        </a>
			</div>

	       <div style="position: relative;margin-left:-56px;margin-top:22px;">
             <button id="login" name="login" value="" class="btn btn-info">登录</button>
             <input type="reset" name="reset" value="重置" class="btn btn-info"/>
	       </div>
	
		  <DIV style="height: 5px; line-height: 5px; margin-top: 5px; border-top-color:#E7E7E7; border-top-width: 1px; border-top-style: solid;"></DIV>
	</div>
</DIV>

</BODY>
</HTML>
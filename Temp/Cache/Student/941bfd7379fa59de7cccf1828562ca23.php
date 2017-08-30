<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script src="__PUBLIC__/Js/dialog/layer.js"></script>
<script src="__PUBLIC__/Js/dialog.js"></script>
<style type="text/css">
	.btn-info{
		width:100px;
	}

	.headalign{
			text-align: left;
	}
	.btncoursetable{
		width:110px;
		text-align: left;
	}

</style>
<script type="text/javascript">
	$(function(){
			$("#btn").click(function(){
				
				var password = $("#password").val().trim();
				var password1= $("#password1").val().trim();
				var password2= $("#password2").val().trim();
				if(password==""){
					return dialog.error("原密码不能为空！");
				}
				if(password1==""){
					return dialog.error("新密码不能为空！");
				}
				if(password1!=password2) {
					return dialog.error("新密码前后不一致！");
	            }

				var url = "<?php echo U(GROUP_NAME.'/Userinfor/editUserpass');?>";
				var data = {'password':password,'password1':password1,'password2':password2};
			        // 执行异步请求  $.post
			        $.post(url,data,function(result){
			        	
			            if(result.status == 0) {
			               return dialog.error(result.message);
			            }else{
			               return dialog.success(result.message,"<?php echo U(GROUP_NAME.'/Index/index');?>");
			            }
			        },'JSON');
			});
	});
</script>
</head>
<body>
<div class="panel panel-default">
	    <div class="panel-heading headalign">
			<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 修改密码</a>
  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>原密码：</td>
				<td>	
				  <input type='password' name='password' id="password" class="form-control" style="width:500px;"/>
			    </td>
			</tr>	
		    <tr>
		    	<td >新密码：</td>
		    	<td>
		    	<input type='password' name='password1' id="password1" class="form-control" style="width:500px;"/>
		    	</td>
		    </tr>	
		    <tr>
		    	<td>确认新密码：</td>
		    	<td>
		    	<input type='password' name='password2' id="password2" class="form-control" style="width:500px;"/>
		    	</td>
		    </tr>	
		   	
		</table>	
	  </div>
	  <div class="panel-footer">
	  	<button  class="btn btn-info" id="btn"><span class="glyphicon glyphicon-check"></span> 提交修改</button>
	  </div>
</div>
</body>
</html>
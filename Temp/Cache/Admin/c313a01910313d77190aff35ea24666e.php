<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style type="text/css">
	.btn-info{
		width:100px;
	}
	.badge{
		background-color: white;
	}
	.form-inline{
		text-align: left;
	}
	.headalign{
		text-align: left;
	}
	.btncoursetable{
		width:110px;
		text-align: left;
	}
</style>
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/System/verify');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 验证码设置</a>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>	
			<tr>
			    <td>验证码字体大小</td>
			    <td><input type='text' name='VERIFY_SIZE' value='<?php echo (C("VERIFY_SIZE")); ?>' class="form-control" style="width:500px;"/></td>
			</tr>
			<tr>
			    <td>验证码字体颜色<br/>(16进制色值)</td>
				<td>
				<div class="form-inline">
					<input type='text' name='VERIFY_COLOR' value='<?php echo (C("VERIFY_COLOR")); ?>' class="form-control" style="width:500px;"/><br/>
				 	<span class="glyphicon glyphicon-info-sign"></span> 非专业人员不得改动,颜色如：
					<span class="badge">
						<span style="display:block; border:1px solid black;width:50px;height:30px;background-color:<?php echo (C("VERIFY_COLOR")); ?>;"></span>
					</span>
				
				</div></td>
			</tr>
			<tr><td>验证码长度</td>
			    <td width='70%'><input type='text' name='VERIFY_LENGTH' value='<?php echo (C("VERIFY_LENGTH")); ?>' class="form-control" style="width:500px;"/></td>
			</tr>
			<tr><td>验证码背影颜色<br/>(16进制色值)</td>
				<td>
				<div class="form-inline">
				<input type='text' name='VERIFY_BGCOLOR' value='<?php echo (C("VERIFY_BGCOLOR")); ?>' class="form-control" style="width:500px;"/><br/>
				<span class="glyphicon glyphicon-info-sign"></span> 非专业人员不得改动,颜色如：
				<span class="badge">
						<span style="display:block; border:1px solid black;width:50px;height:30px;background-color:<?php echo (C("VERIFY_BGCOLOR")); ?>;"></span>
				</span>
				</div>
				</td>
			</tr>
			<tr>
			    <td>验证码种子</td><td>
			    <div class="form-inline">
			    <input type='text' name='VERIFY_SEED' value='<?php echo (C("VERIFY_SEED")); ?>' class="form-control" style="width:500px;"/><br/>
				<span class="glyphicon glyphicon-info-sign"></span> 非专业人员不得改动

			    </td>
			</tr>

			<input type='hidden' name='VERIFY_WIDTH' value='<?php echo (C("VERIFY_WIDTH")); ?>'  />
			<input type='hidden' name='VERIFY_HEIGHT' value='<?php echo (C("VERIFY_HEIGHT")); ?>'  />
			<input type='hidden' name='VERIFY_FONTFILE' value='<?php echo (C("VERIFY_FONTFILE")); ?>'/>
			<input type='hidden' name='VERIFY_NAME' value='<?php echo (C("VERIFY_NAME")); ?>'/>
			<input type='hidden' name='VERIFY_FUNC' value='<?php echo (C("VERIFY_FUNC")); ?>'/>

        <!--
			<tr><td>验证码图片宽度(像素)</td><td><input type='hidden' name='VERIFY_WIDTH' value='<?php echo (C("VERIFY_WIDTH")); ?>'  /> 修改无效</td></tr>
			<tr><td>验证码图片高度(像素)</td><td><input type='hidden' name='VERIFY_HEIGHT' value='<?php echo (C("VERIFY_HEIGHT")); ?>'  /> 修改无效</td></tr>
			<tr><td>验证码字体文件 相对项目文件夹下</td><td><input type='hidden' name='VERIFY_FONTFILE' value='<?php echo (C("VERIFY_FONTFILE")); ?>'/></td></tr>
			<tr><td>SESSION识别名称</td><td><input type='hidden' name='VERIFY_NAME' value='<?php echo (C("VERIFY_NAME")); ?>'/></td></tr>
			<tr><td>存储验证码到SESSION时使用函数</td><td><input type='hidden' name='VERIFY_FUNC' value='<?php echo (C("VERIFY_FUNC")); ?>'/></td></tr>
        -->
		</table>	
	  </div>
	  <div class="panel-footer">
	     <button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交设置</button>
	  </div>
</div>
</form>
</body>
</html>
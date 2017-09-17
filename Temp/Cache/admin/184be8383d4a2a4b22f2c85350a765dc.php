<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script src="__PUBLIC__/Js/jquery.simple-color.js"></script>
<script  type="text/javascript">
$(document).ready(function(){
  $('.simple_color_kitchen_sink1').simpleColor({
    boxHeight: 40,
    cellWidth: 20,
    cellHeight: 20,
    chooserCSS: { 'border': '1px solid #660033' },
    displayCSS: { 'border': '1px solid #ccc' },
    displayColorCode: true,
    livePreview: true,
    onSelect: function(hex, element) {
       var id=element.attr('id');
       //alert(id);
       $(id).val("#"+hex);
      //alert("You selected #" + hex + " for input #" + element.attr('class'));
    }
  });

  $('.simple_color_kitchen_sink2').simpleColor({
    boxHeight: 40,
    cellWidth: 20,
    cellHeight: 20,
    chooserCSS: { 'border': '1px solid #660033' },
    displayCSS: { 'border': '1px solid #ccc' },
    displayColorCode: true,
    livePreview: true,
    onSelect: function(hex, element) {
       var id=element.attr('id');
       //alert(id);
       $(id).val("#"+hex);
      //alert("You selected #" + hex + " for input #" + element.attr('class'));
    }
  });

});
</script>
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
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 登录验证码设置</a>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
		    <tr><td width="20%">验证码长度<br/>(<font color="red"><b>建议只修改此处</b></font>)</td>
			    <td width='70%'><input type='text' name='VERIFY_LENGTH' value='<?php echo (C("VERIFY_LENGTH")); ?>' class="form-control" style="width:500px;"/></td>
			</tr>	
			<tr>
			    <td>验证码字体大小<br/>(单位:像素)</td>
			    <td><input type='text' name='VERIFY_SIZE' value='<?php echo (C("VERIFY_SIZE")); ?>' class="form-control" style="width:500px;"/></td>
			</tr>
			<tr>
			    <td>验证码字体颜色<br/>(16进制色值)</td>
				<td>
					<input class='simple_color_kitchen_sink1' id='VERIFY_COLOR' name='VERIFY_COLOR' value="<?php echo (C("VERIFY_COLOR")); ?>" />
				</td>
			</tr>
			<tr><td>验证码背影颜色<br/>(16进制色值)</td>
				<td>
					<input class='simple_color_kitchen_sink2' id='VERIFY_BGCOLOR' name='VERIFY_BGCOLOR' value="<?php echo (C("VERIFY_BGCOLOR")); ?>" />
				</td>
			</tr>
			<tr>
			    <td>验证码种子</td><td>
			    <div class="form-inline">
			    <input type='text' name='VERIFY_SEED' value='<?php echo (C("VERIFY_SEED")); ?>' class="form-control" style="width:500px;"/>
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
	  <div class="panel-footer"  style="text-align: center;">
	     <button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交设置</button>
	  </div>
</div>
</form>
</body>
</html>
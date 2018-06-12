<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style type="text/css">
.headalign{
	text-align: left;
}
.btncoursetable{
	width:90px;
	text-align: left;
}	
.xiexian{
    width:20px;
	margin-left:-5px;margin-right:-5px;
}
</style>
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Basicdata/saveOfficeH');?>' method='post'>
<div class="panel panel-default">
	<div class="panel-heading headalign">
	   <a href="<?php echo U(GROUP_NAME.'/Basicdata/office');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 处室维护</a><span class="btn xiexian">/</span><a  class="btn btn4"><?php echo ($office["op"]); ?></a>
	</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>处室名称</td>
				<td><input type='text' name='name' value="<?php echo ($office["name"]); ?>" class="form-control" style="width: 500px;"/></td>
			</tr>
		</table>
	  </div>
	  <div class="panel-footer" style="text-align: center;">
        <input type='hidden'  name="id" value="<?php echo ($office["id"]); ?>"/>
	  	<button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
</form>
</body>
</html>
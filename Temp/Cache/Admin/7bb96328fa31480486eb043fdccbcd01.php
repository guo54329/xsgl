<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
</head>

<body>
<form action='<?php echo U(GROUP_NAME.'/Basicdata/saveProfessionalH');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading"><?php echo ($professional["op"]); ?></div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>专业名称</td>
				<td><input type='text' name='name' value="<?php echo ($professional["name"]); ?>" class="form-control" style="width: 500px;"/></td>
			</tr>
		</table>	
	  </div>
	  <div class="panel-footer">
        <input type='hidden'  name="id" value="<?php echo ($professional["id"]); ?>"/>
	  	<button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
</form>
</body>
</html>
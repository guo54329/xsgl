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
<form action='<?php echo U(GROUP_NAME.'/Basicdata/saveCourseH');?>' method='post'>
<div class="panel panel-default">
	<div class="panel-heading headalign">
	   <a href="<?php echo U(GROUP_NAME.'/Basicdata/course');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 课程维护</a><span class="btn xiexian">/</span><a  class="btn btn4"><?php echo ($course["op"]); ?></a>
	</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>课程名称</td>
				<td><input type='text' name='name' value="<?php echo ($course["name"]); ?>" class="form-control" style="width: 500px;"/></td>
			</tr>
			<tr>
				<td>课程类型</td>
				<td>
				   <select class="form-control" name="coursetype" style="width: 500px;">
				   		<option value="">请选择类型...</option>
				   		<option value="2" <?php if($course['coursetype'] == 2): ?>selected="selected"<?php endif; ?> >专业课</option>
						<option value="1" <?php if($course['coursetype'] == 1): ?>selected="selected"<?php endif; ?> >公共课</option>
				   </select>
				</td>
			</tr>
			<tr>
				<td>所属专业</td>
				<td>
					<select name='proname' class="form-control" style="width: 500px;">
						<option value="">请选择专业...</option>
						<?php if(is_array($pro)): foreach($pro as $key=>$v): ?><option value="<?php echo ($v["name"]); ?>" <?php if($course['proname'] == $v['name']): ?>selected="selected"<?php endif; ?> ><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>

		</table>	
	  </div>
	  <div class="panel-footer" style="text-align: center;">
        <input type='hidden'  name="id" value="<?php echo ($course["id"]); ?>"/>
	  	<button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
</form>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style type="text/css">
	.xb{
		margin-right: 30px;
	}
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
<form action='<?php echo U(GROUP_NAME.'/Basicdata/saveTeacherH');?>' method='post'>
<div class="panel panel-default">
	<div class="panel-heading headalign">
	   <a href="<?php echo U(GROUP_NAME.'/Basicdata/teacher');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 教师维护</a><span class="btn xiexian">/</span><a  class="btn btn4"><?php echo ($teacher["op"]); ?></a>
	</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>教师编码</td>
				<td>
				<div class="form-inline">
				<input style="width: 500px;" type='text' name='jsno' value="<?php echo ($teacher["jsno"]); ?>" class="form-control" <?php if($teacher['jsnostatus'] == 0): ?>disabled<?php endif; ?>  /> 
				<span class="glyphicon glyphicon-info-sign"></span> 编号格式为处室名称汉字的首字母+两位序号，如jsj01
				</div>
				</td>
			</tr>
			<tr>
				<td>姓名</td>
				<td><input type='text' name='jsxm' value="<?php echo ($teacher["jsxm"]); ?>" class="form-control" style="width: 500px;"/></td>
			</tr>
			<tr>
				<td>性别</td>
				<td style="text-align: left;">
				    <div class="form-inline">
				    	<label class="xb">
				    		<input type="radio" name="jsxb" class="form-control" value="男" <?php if($teacher['jsxb'] == '男'): ?>checked<?php endif; ?> > 男  
				    	</label> 
				    	
				    	<label class="xb">
				    		<input type="radio" name="jsxb" class="form-control" value="女" <?php if($teacher['jsxb'] == '女'): ?>checked<?php endif; ?> > 女	
				    	</label>
				    </div>
				    
				</td>
			</tr>
			<tr>
				<td>联系电话</td>
				<td><input type='text' name='jsdh' value="<?php echo ($teacher["jsdh"]); ?>" class="form-control" style="width: 500px;"/></td>
			</tr>
			<tr>
				<td>所在处室</td>
				<td>
					<select name='offname' class="form-control" style="width: 500px;">
						<option value="0">请选择处室...</option>
						<?php if(is_array($office)): foreach($office as $key=>$v): ?><option value="<?php echo ($v["name"]); ?>" <?php if($teacher['offname'] == $v['name']): ?>selected="selected"<?php endif; ?> ><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>

		</table>	
	  </div>
	  <div class="panel-footer" style="text-align: center;">
        <input type='hidden'  name="id" value="<?php echo ($teacher["id"]); ?>"/>
	  	<button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
</form>
</body>
</html>
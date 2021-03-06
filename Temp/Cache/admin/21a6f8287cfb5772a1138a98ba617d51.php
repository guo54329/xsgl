<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/selects.js"></script>
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
<form action='<?php echo U(GROUP_NAME.'/Basicdata/saveStudentH');?>' method='post'>
<div class="panel panel-default">
	<div class="panel-heading headalign">
	   <a href="<?php echo U(GROUP_NAME.'/Basicdata/student');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 学生维护</a><span class="btn xiexian">/</span><a  class="btn btn4"><?php echo ($student["op"]); ?></a>
	</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>编号</td>
				<td>
				<div class="form-inline"><!-- <?php if($student['xsnostatus'] != 0): ?>disabled<?php endif; ?> -->
				<input style="width: 500px;" type='text' name='xsno' value="<?php echo ($student["xsno"]); ?>" class="form-control"  /> <span class="glyphicon glyphicon-info-sign"></span> 学号编码格式:班级编码(6位)+班内序号(2位)
				</div>
				</td>
			</tr>
			<tr>
				<td>姓名</td>
				<td><input type='text' name='xsxm' value="<?php echo ($student["xsxm"]); ?>" class="form-control" style="width: 500px;"/></td>
			</tr>
			<tr>
				<td>性别</td>
				<td style="text-align: left;">
					<div class="form-inline">
				    	<label class="xb">
				    		<input type="radio" name="xsxb" class="form-control" value="男"  <?php if($student['xsxb'] == '男'): ?>checked<?php endif; ?> > 男  
				    	</label> 
				    
				    	<label class="xb">
				    		<input type="radio" name="xsxb" class="form-control" value="女" <?php if($student['xsxb'] == '女'): ?>checked<?php endif; ?> > 女	
				    	</label>
				    </div>
				</td>
			</tr>
			<tr>
				<td>入学时间</td>
				<td>
					<select name="rxsj" class="form-control" style="width: 500px;">
						<option value="">请选择入学时间...</option>
						<?php if(is_array($term)): foreach($term as $key=>$v): ?><option value="<?php echo ($v["rxsj"]); ?>" <?php if($student['rxsj'] == $v['rxsj']): ?>selected="selected"<?php endif; ?> ><?php echo ($v["rxsj"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>所在班级</td>
				<td>
				<div class="form-inline">
					<select name="zjsj" class="form-control" style="width: 250px;"></select>
					<select name="ccode" class="form-control" style="width: 250px;"></select>
				
				     <!-- js的使用 start-->
				     <script type="text/javascript" src="__PUBLIC__/Js/zjsjclasses.js"></script>
				     <script type="text/javascript">

					var s = selects;
					//获取对象
					var a = document.getElementsByName('zjsj')[0];
					var b = document.getElementsByName('ccode')[0];
					//绑定数据
					s.bind(a,sj);//sj和bj来自js文件的变量
					s.bind(b,bj);//a和b来自本页面的属性
					
					//确定从属关系
					s.parent(a,b);
				 </script>
				 <?php if($student['xsnostatus'] == 0): ?><span class="glyphicon glyphicon-info-sign"></span>  提示：原班级：
					 <?php $ccode = $student['ccode']; $classes = M('classes')->field('zjsj,cname')->where("ccode='$ccode'")->find(); echo $classes['zjsj']."->".$classes['cname']; endif; ?>
				</div>
				</td>
			</tr>

		</table>	
	  </div>
	  <div class="panel-footer" style="text-align: center;">
        <input type='hidden'  name="id" value="<?php echo ($student["id"]); ?>"/>
	  	<button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
</form>
</body>
</html>
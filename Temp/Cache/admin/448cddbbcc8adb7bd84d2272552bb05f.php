<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />

<script type="text/javascript" src="__PUBLIC__/Js/selects.js"></script>
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
<form action='<?php echo U(GROUP_NAME.'/Basicdata/saveClassesH');?>' method='post'>
<div class="panel panel-default">
	<div class="panel-heading headalign">
	   <a href="<?php echo U(GROUP_NAME.'/Basicdata/classes');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 班级维护</a><span class="btn xiexian">/</span><a  class="btn btn4"><?php echo ($classes["op"]); ?></a>
	</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>班级编码</td>
				<td>
				<div class="form-inline">
				<input style="width: 500px;" type='text' name='ccode' value="<?php echo ($classes["ccode"]); ?>" class="form-control"
					<?php if($classes['ccodestatus'] == 0): ?>disabled<?php endif; ?> /> 
				<span class="glyphicon glyphicon-info-sign"></span> 班级编码格式为:入学年(4位)+班级序号(2位)
				</div>
				</td>
			</tr>
			<tr>
				<td>班级名称</td>
				<td><input type='text' name='cname' value="<?php echo ($classes["cname"]); ?>" class="form-control" style="width: 500px;"/></td>
			</tr>
			<tr>
				<td>班主任</td>
				<td>
				<div class="form-inline">
					<select name="office" class="form-control " style="width: 250px;"></select>
					<select name="master" class="form-control" style="width: 250px;"></select>
				
				     <!-- js的使用 start-->
				     <script type="text/javascript" src="__PUBLIC__/Js/offteacher.js"></script>
				     <script type="text/javascript">

					var s = selects;
					//获取对象
					var a = document.getElementsByName('office')[0];
					var b = document.getElementsByName('master')[0];
					//绑定数据
					s.bind(a,cs);//sj和bj来自js文件的变量
					s.bind(b,js);//a和b来自本页面的属性
					
					//确定从属关系
					s.parent(a,b);
				 	</script>
				<?php if($classes['ccodestatus'] == 0): ?><span class="glyphicon glyphicon-info-sign"></span>  提示：原班主任：<?php echo ($classes["offname"]); ?>-><?php echo ($classes["jsxm"]); endif; ?>
				</div>
				</td>
			</tr>
			<tr>
				<td>组建时间</td>
				<td>
				    <select name='zjsj' class="form-control" style="width: 500px;">
						<option value="">请选择时间...</option>
						<?php if(is_array($term)): foreach($term as $key=>$v): ?><option value="<?php echo ($v["name"]); ?>"  <?php if($classes['zjsj'] == $v['name']): ?>selected="selected"<?php endif; ?>  ><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>所属专业</td>
				<td>
					<select name='proname' class="form-control" style="width: 500px;">
						<option value="">请选择专业...</option>
						<?php if(is_array($pro)): foreach($pro as $key=>$v): ?><option value="<?php echo ($v["name"]); ?>"  <?php if($classes['proname'] == $v['name']): ?>selected="selected"<?php endif; ?>  ><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</td>
			</tr>

		</table>	
	  </div>
	  <div class="panel-footer" style="text-align: center;">
        <input type='hidden'  name="id" value="<?php echo ($classes["id"]); ?>"/>
	  	<button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
</form>
</body>
</html>
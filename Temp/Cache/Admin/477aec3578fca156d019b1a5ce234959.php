<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/selects.js"></script>
<style type="text/css">
	.form-inline{
		width: 100%;
	}
</style>
</head>

<body>
<form action='<?php echo U(GROUP_NAME.'/Excise/coursetableSave');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading">添加教师课程表</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>学期</td>
				<td>
				 <div class="form-inline">
					<select name='term' class="form-control" style="width: 500px;">
						<option value="0">请选择学期...</option>
						<?php if(is_array($term)): foreach($term as $key=>$v): ?><option value="<?php echo ($v["name"]); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
				</div>
				</td>
			</tr>
			<tr>
				<td>教师</td>
				<td>
				<div class="form-inline">
				    <select name="cs" class="form-control" style="width: 250px;"></select>
					<select name="js" class="form-control" style="width: 250px;"></select>
				</div>
				     <!-- js的使用 start-->
				     <script type="text/javascript" src="__PUBLIC__/Js/offteacher.js"></script>
				     <script type="text/javascript">

					var s = selects;
					//获取对象
					var a = document.getElementsByName('cs')[0];
					var b = document.getElementsByName('js')[0];
					//绑定数据
					s.bind(a,cs);//sj和bj来自js文件的变量
					s.bind(b,js);//a和b来自本页面的属性
					
					//确定从属关系
					s.parent(a,b);
				 	</script>
				</td>
			</tr>
			<tr>
				<td>班级</td>
				<td>
				<div class="form-inline">
					<select name="zjsj" class="form-control" style="width: 250px;"></select>
					<select name="ccode" class="form-control" style="width: 250px;"></select>
				</div>
					
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

				</td>
			</tr>
			<tr>
				<td>课程</td>
				<td>
				<div class="form-inline">
					<select name="zy" class="form-control" style="width: 250px;"></select>
					<select name="kc" class="form-control" style="width: 250px;"></select>
				</div>	
					     <!-- js的使用 start-->
					     <script type="text/javascript" src="__PUBLIC__/Js/procourse.js"></script>
					     <script type="text/javascript">

						var s = selects;
						//获取对象
						var a = document.getElementsByName('zy')[0];
						var b = document.getElementsByName('kc')[0];
						//绑定数据
						s.bind(a,zy);//sj和bj来自js文件的变量
						s.bind(b,kc);//a和b来自本页面的属性
						
						//确定从属关系
						s.parent(a,b);
					 </script>
				</td>
			</tr>

		</table>	
	  </div>
	  <div class="panel-footer">
        <input type='hidden'  name="id" value="<?php echo ($teacher["id"]); ?>"/>
	  	<button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>&nbsp;&nbsp;
	  	<a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" class="btn btn-info btnw"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返回</a>
	  </div>
</div>
</form>
</body>
</html>
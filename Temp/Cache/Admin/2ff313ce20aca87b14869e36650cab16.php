<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style type="text/css">
.footeralign{
	text-align: left;
}
</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading">班级维护 </div>
	  <div class="panel-footer footeralign">
	      <form action="<?php echo U(GROUP_NAME.'/Basicdata/classes');?>" method="post">
			<div class="form-inline">
			  <a href="<?php echo U(GROUP_NAME.'/Basicdata/saveClasses');?>" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> 添加</a>&nbsp;
			  <a href="<?php echo U(GROUP_NAME.'/Basicdata/importClasses');?>" class="btn btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 导入</a>&nbsp;&nbsp;
		      <select name="zjsj" class="form-control">
		         <option value=''>请选择组建时间</option>
		      	 <?php if(is_array($zjsjs)): foreach($zjsjs as $key=>$v): ?><option value="<?php echo ($v["zjsj"]); ?>"><?php echo ($v["zjsj"]); ?></option><?php endforeach; endif; ?>
		      </select>
		      <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
		      &nbsp;&nbsp;<span>如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</span>

			</div>
		  </form>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>班级编码</td><td>名称</td><td>班主任</td><td>班主任电话</td><td>组建时间</td><td>所属专业</td><td>操作</td></tr>
			<?php if(is_array($classes)): foreach($classes as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["ccode"]); ?></td>
				<td><?php echo ($v["cname"]); ?></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["jsdh"]); ?></td>
				<td><?php echo ($v["zjsj"]); ?></td>
				<td><?php echo ($v["proname"]); ?></td>
				<td>
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveClasses',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/delClasses',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
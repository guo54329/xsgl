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
	  <div class="panel-heading">课程维护 </div>
	  <div class="panel-footer footeralign">
	      <form action="<?php echo U(GROUP_NAME.'/Basicdata/course');?>" method="post">
          <div class="form-inline">
			  <a href="<?php echo U(GROUP_NAME.'/Basicdata/saveCourse');?>" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> 添加</a>&nbsp;
			  <a href="<?php echo U(GROUP_NAME.'/Basicdata/importCourse');?>" class="btn btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 导入</a>&nbsp;&nbsp;
		      <select name="proname" class="form-control">
		         <option value=''>请选择专业</option>
		      	 <?php if(is_array($pronames)): foreach($pronames as $key=>$v): ?><option value="<?php echo ($v["proname"]); ?>"><?php echo ($v["proname"]); ?></option><?php endforeach; endif; ?>
		      </select>
		      <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
		      &nbsp;&nbsp;<span>如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</span>
		   </div>
		   </form>
	  </div>

	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>课程</td><td>课程类型</td><td>所属专业</td><td>操作</td></tr>
			<?php if(is_array($course)): foreach($course as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td><?php if($v['coursetype'] == 2): ?>专业课<?php else: ?>公共课<?php endif; ?></td>
				<td><?php echo ($v["proname"]); ?></td>
				<td>
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveCourse',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/delCourse',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
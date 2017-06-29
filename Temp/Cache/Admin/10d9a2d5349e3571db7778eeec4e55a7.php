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
	  <div class="panel-heading">专业维护 </div>
	  <div class="panel-footer footeralign"><a href="<?php echo U(GROUP_NAME.'/Basicdata/saveProfessional');?>" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> 添加</a>&nbsp;
	  <a href="<?php echo U(GROUP_NAME.'/Basicdata/importProfessional');?>" class="btn btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 导入</a>

	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>专业</td><td>操作</td></tr>
			<?php if(is_array($professional)): foreach($professional as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td>
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveProfessional',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/delProfessional',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
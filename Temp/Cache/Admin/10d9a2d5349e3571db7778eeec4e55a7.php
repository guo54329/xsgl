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
.btn6{
	width: 120;
}
</style>
</head>
<body>

<div class="panel panel-default">
	  
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 专业维护  </a>
        &nbsp;&nbsp;
		<a href="<?php echo U(GROUP_NAME.'/Basicdata/resetPRO');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 清除演示数据</a>(注意：请在系统部署好使用之前使用该功能！)
		<span style="float: right;">
	     	<a  href="<?php echo U(GROUP_NAME.'/Basicdata/saveProfessional');?>"  class="btn btn4 btn-info"><span class="glyphicon glyphicon-plus"></span> 添加专业</a>
	     	<a href="<?php echo U(GROUP_NAME.'/Basicdata/importProfessional');?>" class="btn btn4 btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 批量导入</a>
	     	<div style="display: none;">如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</div>
	     </span>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>专业</td><td>课程数量</td><td>操作</td></tr>
			<?php if(is_array($professional)): foreach($professional as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td>
					<?php $pname = $v['name']; $coursenum = M('course')->where("proname = '$pname'")->count(); echo $coursenum; ?>
				</td>
				<td>
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveProfessional',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<?php if($coursenum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Basicdata/delProfessional',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php else: ?><a href="#"  class="btn btn-default"><span class="glyphicon glyphicon-ban-circle"></span> 有课</a><?php endif; ?>

					
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
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
.btn6{
	width: 120px;
}
</style>
</head>
<body>

<div class="panel panel-default">
	<div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 处室维护</a>
		<a href="<?php echo U(GROUP_NAME.'/Basicdata/resetOFF');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 清除演示数据</a>(注意：请在系统部署好使用之前使用该功能！)
		<span style="float: right;">
	     	<a  href="<?php echo U(GROUP_NAME.'/Basicdata/saveOffice');?>"  class="btn btn4 btn-info"><span class="glyphicon glyphicon-plus"></span> 添加处室</a>
	     	<a href="<?php echo U(GROUP_NAME.'/Basicdata/importOffice');?>" class="btn btn4 btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 批量导入</a>
	     	<div style="display: none;">如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</div>
	     </span>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>处室</td><td>教师人数</td><td>操作</td></tr>
			<?php if(is_array($office)): foreach($office as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td>
					<?php $offname = $v['name']; $teanum=M('teacher')->where("offname='$offname'")->count(); echo $teanum; ?>
				</td>
				<td>
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveOffice',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;

					<?php if($teanum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Basicdata/delOffice',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php else: ?><a href="#"  class="btn btn-default"><span class="glyphicon glyphicon-ban-circle"></span> 有人</a><?php endif; ?>

					
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
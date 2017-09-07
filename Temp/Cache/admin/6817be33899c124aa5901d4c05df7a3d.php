<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<!-- 排序加入开始 -->
<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/jquery-latest.js"></script>
<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/addons/pager/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/docs/js/chili-1.8b.js"></script>
<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/docs/js/docs.js"></script>
<script type="text/javascript">
$(function() {
	$("table")
		.tablesorter({widthFixed: true, widgets: ['zebra']})
		.tablesorterPager({container: $("#pager")});
});
</script>
<!-- 排序加入结束 -->

<style type="text/css">
	.headalign{
		text-align: left;
	}
	.title{
		font-weight: bold;
	}
	.btn6{
		width: 120px;
	}
	/*排序加入开始*/ 
	 table.tablesorter thead tr .header {

		background-image: url("__ROOT__/Data/jquerytablesorter/themes/blue/bg.gif");
		background-repeat: no-repeat;
		background-position: center right;
		cursor: pointer;
	}
	table.tablesorter thead tr .headerSortUp {
		background-image: url(__ROOT__/Data/jquerytablesorter/themes/blue/asc.gif);
	}
	table.tablesorter thead tr .headerSortDown {
		background-image: url(__ROOT__/Data/jquerytablesorter/themes/blue/desc.gif);
	}
	/*排序加入结束*/
</style>
</head>
<body>
<div class="panel panel-default">
	 <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 角色列表</a>
		&nbsp;&nbsp;
		<a href="<?php echo U(GROUP_NAME.'/Rbac/resetROLE');?>" class="btn btn-info btn6" ><span class="glyphicon glyphicon-retweet"></span> 清除演示数据</a> <span class="glyphicon glyphicon-info-sign"></span> 请在系统部署好使用之前使用该功能！

		<span style="float: right;">
	     	<a  href="<?php echo U(GROUP_NAME.'/Rbac/addRole');?>"  class="btn btn4 btn-info"><span class="glyphicon glyphicon-plus"></span> 添加角色</a>
	     </span>
	  </div>
	  <div class="panel-body">
		<table class="table table-bordered table-hover tablesorter">
		  <thead>
			<tr class="title"><th style="text-align: center;">序号</th><td>角色名称(英文)</td><td>角色描述(中文)</td><th style="text-align: center;">开启状态</th><td>操作</td></tr>
			</thead>
			<tbody>
			<?php if(is_array($role)): foreach($role as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td><?php echo ($v["remark"]); ?></td>
				<td><?php if($v["status"]): ?>开启<?php else: ?>关闭<?php endif; ?></td>
				<td><a href="<?php echo U(GROUP_NAME.'/Rbac/access',array('rid'=>$v['id']));?>" class="btn btn-default btn4"><span class="glyphicon glyphicon-cog"></span> 配置权限</a> 
					<a href="<?php echo U(GROUP_NAME.'/Rbac/editRole',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> 修改</a>
					<a href="<?php echo U(GROUP_NAME.'/Rbac/delRole',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>
				   
				</td>
			</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<!-- 排序分页开始 -->
		<div id="pager" class="pager">
			<form>
			    <span class="label label-default" style="display:inline-block;height: 25px;line-height: 20px;">当前角色个数  <?php echo ($num); ?></span>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/first.png" class="first"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/prev.png" class="prev"/>
				<input type="text" class="pagedisplay" style="width: 50px;border-radius:4px;text-align: center;height: 25px;" disabled />
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/next.png" class="next"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/last.png" class="last"/>
				<select class="form-inline pagesize" style="width: 50px;border-radius:4px;text-align: center;height: 25px;">
					<option selected="selected"  value="10">10</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option  value="50">50</option>
				</select>
			</form>
		</div>
		<!-- 排序  分页结束 -->	
	  </div>
	  
</div>
</body>
</html>
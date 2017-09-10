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

	<script type="text/javascript">
		function myrefresh(){
			window.location.reload();
		}
	</script>
	<style type="text/css">
		tr{
			height: 40px;
		}
		.headalign{
			text-align: left;
		}
		.btncoursetable{
			width:110px;
			text-align: left;
		}
		.btnw{
			width: 90px;
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
  <!-- Default panel contents -->
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 消息列表</a>
		<span style="float: right;"><button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;&nbsp;
	     	<a href="<?php echo U(GROUP_NAME.'/Home/addNews');?>" class="btn btn-info btnw" ><span class="glyphicon glyphicon-bullhorn"></span> 发布消息</a>
	     </span>
	  </div>
	  
	  <div class="panel-body">   
		   <table class="table table-bordered table-hover tablesorter">
		   <thead>
		   <tr style="text-align: center;font-weight: bold;">
<th style="text-align: center;" width="6%">序号</th>
<td align="left" width="12%">标题</td>
<td align="left">内容</td>
<th style="text-align: center;" width="14%">接收对象</th>
<th style="text-align: center;" width="8%">管理员</th>
<th style="text-align: center;" width="18%">发布时间</th>
<th style="text-align: center;" width="16%">操作</th>
</tr>
		   </thead>
		   <tbody>
                             <?php $i=1;?>
			     <?php if(is_array($info)): foreach($info as $key=>$v): ?><tr>
					<td align="center"><?php echo ($i++); ?></td>
					<td align="left"><?php echo ($v["title"]); ?></td>
					<td align="left"><?php echo ($v["content"]); ?></td>
					<td align='left'>
					<?php if($v['pubtype'] == 1): ?>所有教师和学生<?php endif; ?>
					<?php if($v['pubtype'] == 2): ?>所有教师<?php endif; ?>
					<?php if($v['pubtype'] == 3): ?>所有学生<?php endif; ?>
					<?php if($v['pubtype'] == 4): ?>班级:<?php echo ($v["cname"]); endif; ?>
					</td>
					<td align="center"><?php echo ($v["userxm"]); ?></td>
					<td align="center"><?php echo (date('Y-m-d H:i:s',$v["pubtime"])); ?></td>
					<td align='left'>
					<?php if($v['pubtype'] != 4): ?><a href="<?php echo U(GROUP_NAME.'/Home/editNews',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-edit" ></span> 编辑</a><?php endif; ?>
					<a href="<?php echo U(GROUP_NAME.'/Home/delNews',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>

					</td>
					</tr><?php endforeach; endif; ?>
			</tbody>
			</table>
			<!-- 排序分页开始 -->
			<div id="pager" class="pager">
				<form>
				    <span class="label label-default" style="display:inline-block;height: 25px;line-height: 20px;">当前消息条数 <?php echo ($num); ?></span>
					<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/first.png" class="first"/>
					<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/prev.png" class="prev"/>
					<input type="text" class="pagedisplay" style="width: 50px;border-radius:4px;text-align: center;height: 25px;" disabled />
					<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/next.png" class="next"/>
					<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/last.png" class="last"/>
					<select class="pagesize" style="width: 50px;border-radius:4px;text-align: center;height: 25px;">
						<option selected="selected"  value="10">10</option>
						<option value="30">30</option>
						<option  value="50">50</option>
					</select>
				</form>
			</div>
			<!-- 排序  分页结束 -->
		</div>
</div>
</body>
</html>
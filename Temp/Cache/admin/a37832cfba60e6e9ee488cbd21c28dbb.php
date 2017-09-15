<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<!-- 排序加入开始 -->
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>

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
	.btncoursetable{
		width:90px;
		text-align: left;
	}	
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
	.form-inline{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 16px;
		
		height:40px;
		line-height:40px;
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
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 班级维护</a>
		<span style="float: right;">
	     	<a  href="<?php echo U(GROUP_NAME.'/Basicdata/saveClasses');?>"  class="btn btn4 btn-info"><span class="glyphicon glyphicon-plus"></span> 添加班级</a>
	     	<a href="<?php echo U(GROUP_NAME.'/Basicdata/importClasses');?>" class="btn btn4 btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 批量导入</a>
	     	<div style="display: none;">如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</div>
	     </span>
	  </div>
	  <div class="form-inline">
	      <form action="<?php echo U(GROUP_NAME.'/Basicdata/classes');?>" method="post">
		      <select name="zjsj" class="form-control">
		         <option value=''>请选择组建时间</option>
		      	 <?php if(is_array($zjsjs)): foreach($zjsjs as $key=>$v): ?><option value="<?php echo ($v["zjsj"]); ?>"><?php echo ($v["zjsj"]); ?></option><?php endforeach; endif; ?>
		      </select>
		      <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
		  </form>
	  </div>
	  <div class="panel-body">
	     <!-- 排序给table加入 tablesorter 类,thead中必须使用th才有排序功能，使用td的不排序-->
		 <table  class="table table-bordered table-hover tablesorter">
		   <thead>
			<tr><th style="text-align: center;" width="6%">序号</th><th style="text-align: center;" width="8%">编码</th><th style="text-align: center;">名称</th><th style="text-align: center;" width="6%">人数</th><th style="text-align: center;" width="8%">班主任</th><td style="text-align: center;font-weight: bold;">联系电话</td><th style="text-align: center;" width="12%">组建时间</th><!--<th style="text-align: center;" width="12%">所属专业</th>--><td style="text-align: center;font-weight: bold;">操作</td></tr>
			</thead>
			<tbody>
			<?php if(is_array($classes)): foreach($classes as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["ccode"]); ?></td>
				<td><?php echo ($v["cname"]); ?></td>
				<td>
				<?php $ccode=$v['ccode']; $stunum=M('student')->where("ccode='$ccode'")->count(); if($stunum==0){echo "<span style='color:red;font-weight: bold;'>".$stunum."</span>";} else{ echo "<span style='color:green;font-weight: bold;'>".$stunum."</span>"; } ?>
					
				</td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["jsdh"]); ?></td>
				<td><?php echo ($v["zjsj"]); ?></td>
				<!--<td><?php echo ($v["proname"]); ?></td>-->
				<td>
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveClasses',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<?php if($stunum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Basicdata/delClasses',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php else: ?><a href="#"  class="btn btn-default"><span class="glyphicon glyphicon-ban-circle"></span> 有人</a><?php endif; ?>
					&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/delClassesStu',array('ccode'=>$v['ccode'],'cname'=>$v['cname']));?>"  class="btn btn-default btncoursetable"><span class="glyphicon glyphicon-trash"></span> 清空学生</a>
				</td>
			</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<!-- 排序分页开始 -->
		<div id="pager" class="pager">
			<form>
			    <span class="label label-default" style="display:inline-block;height: 26px;line-height: 20px;">当前班级个数 <?php echo ($num); ?></span>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/first.png" class="first"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/prev.png" class="prev"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/next.png" class="next"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/last.png" class="last"/>
				<input type="text" class="pagedisplay" style="width: 50px;height: 26px;border-radius:4px;text-align: center;" />
				<select class="pagesize" style="width: 50px;height: 26px;line-height:18px;border-radius:4px;text-align: center;">
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
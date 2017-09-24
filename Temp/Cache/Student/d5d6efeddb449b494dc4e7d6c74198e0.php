<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/selects.js"></script>
<script src="__PUBLIC__/Js/dialog/layer.js"></script>
<script src="__PUBLIC__/Js/dialog.js"></script>

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

	th{
		text-align:center;
	}
	.browse{
		width: 110px;
		height:35px;
		line-height: 24px;
		font-size: 16px;
	}
	.notice{
		position: fixed;
		display: inline-block;
		right: 100px;
		float: right;

	}
	.headalign{
		text-align: left;
	}
	.btncoursetable{
		width:100px;
		text-align: left;
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
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的任务</a>
		<span class="notice">
				<button class="btn btn-info browse" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新列表</button>
			 	<a href="<?php echo U(GROUP_NAME.'/Index/sysNews');?>" class="btn btn-success browse" ><span class="glyphicon glyphicon-bullhorn"></span> 查看消息</a>
		</span>		
	  </div>
	  <div class="form-inline">
    	<form action='<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList');?>' method="post">
			<select name="term" class="form-control"></select>
		<select name="coursename" class="form-control"></select>
		<!-- js的使用 start-->
		 <script type="text/javascript" src="__PUBLIC__/Js/termCourse.js"></script>
		 <script type="text/javascript">

			var s = selects;
			//获取对象
			var a = document.getElementsByName('term')[0];
			var b = document.getElementsByName('coursename')[0];
			//绑定数据
			s.bind(a,xq);//xq和kc来自js文件的变量
			s.bind(b,kc);//a和b来自本页面的属性
			
			//确定从属关系
			s.parent(a,b);
		 </script>
		 <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
		</form>
	</div>
	  <div class="panel-body">
		 <table class="table table-bordered table-hover tablesorter">
		   <thead>
			<tr style="text-align: center;font-weight: bold;"><td>学期</td><th style="text-align: center;">课程</th><th style="text-align: center;" width="6%">序号</th><td>任务标题</td><th style="text-align: center;" width="10%">发布教师</th><th style="text-align: center;">发布时间</th><th style="text-align: center;" width="10%">完成状态</th><td>实训成绩</td><td width="10%">操作</td></tr>
			</thead>
			<tbody>
			<?php $i=1;?>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
				<td><?php echo ($v["term"]); ?></td>
				<td><?php echo ($v["coursename"]); ?></td>
				<td><?php echo ($i); $v.peid;?></td>
				<td align="left"><a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDesc',array('seid'=>$v['seid']));?>"><?php echo ($v["title"]); ?></a></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo (date('m-d H:i',$v["pubtime"])); ?></td>

				<td><?php if($v['status'] == 0 ): ?><span style="font-size: 16px;color:red;">未完成</span><?php else: ?><img src="__PUBLIC__/Images/finish.png" style="height: 40px;" /><?php endif; ?></td>
				<td><?php echo $v['desc']*0.3+$v['isrec']*0.7; ?></td>
			
				<td><?php if($v['status'] == 0 ): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDesc',array('seid'=>$v['seid']));?>" class="btn" style="font-size: 16px;"><span class="glyphicon glyphicon-hand-right"></span> 去完成</a><?php else: ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxexciseDiscuss',array('peid'=>$v['peid']));?>" class="btn btn-default browse" ><span class="glyphicon glyphicon-eye-open"></span> 评价交流</a><?php endif; ?></td>
			</tr>
			<?php $i++; endforeach; endif; ?>
			</tbody>
		</table>
		<!-- 排序分页开始 -->
		<div id="pager" class="pager"><br/>
			<form>
			    <span class="label label-default" style="display:inline-block;height: 26px;line-height: 20px;">当前任务数 <?php echo ($num); ?></span>
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
	 <div>
	    <div style="right:20;bottom: 50;position: fixed;"><button class="btn btn-info btnw" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button></div>
		<div style="right:20;bottom: 15;position: fixed;"><a href="#top" class="btn btn-info"><span class="glyphicon glyphicon-chevron-up"></span> 回顶</a></div>
	  </div>	 
</div>
</body>
</html>
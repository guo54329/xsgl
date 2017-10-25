<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/selects.js"></script>

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
	$("#tob").show();
</script>
<style type="text/css">
    .headalign{
		text-align: left;
	}
	.btncoursetable{
		width:100px;
		text-align: left;
	}
	.numColor0{
		color: red;

	}
	.numColor1{
		color: green;
		font-size: 20px;
		font-weight: bold;
	}	
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
	.form-inline{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 16px;
		
		height:100px;
		line-height:34px;
	 }
	 .trColor{
	 	 background-color: #eee;
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
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 教师课表</a>
		<span style="float: right;">
	     	<button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>
			<a href="<?php echo U(GROUP_NAME.'/Excise/coursetableSave');?>" class="btn btn-info btn4"><span class="glyphicon glyphicon-plus"></span> 添加课程</a>
	     	<div style="display: none;">如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</div>
	     </span>
	  </div>
	  <div class="form-inline">
		<form action='<?php echo U(GROUP_NAME.'/Excise/courseTable');?>' method="post">
             <span class="bpx">
			 提示：请选择其中一种方式，然后单击查询！
			</span>
			<br/>
	  		方式一：
  			<select name="term1" class="form-control" style="width: 250px;"></select>
			<select name="coursename" class="form-control" style="width: 250px;"></select>
			<!-- js的使用 start-->
			 <script type="text/javascript" src="__PUBLIC__/Js/termCourse.js"></script>
			 <script type="text/javascript">

				var s = selects;
				//获取对象
				var a = document.getElementsByName('term1')[0];
				var b = document.getElementsByName('coursename')[0];
				//绑定数据
				s.bind(a,xq);//xq和kc来自js文件的变量
				s.bind(b,kc);//a和b来自本页面的属性
				
				//确定从属关系
				s.parent(a,b);
			 </script>
			<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
			&nbsp;&nbsp;<br/>
	  		方式二：
  			<select name="term2" class="form-control" style="width: 250px;"></select>
			<select name="js" class="form-control" style="width: 250px;"></select>
			<!-- js的使用 start-->
			 <script type="text/javascript" src="__PUBLIC__/Js/termTeacher.js"></script>
			 <script type="text/javascript">

				var s = selects;
				//获取对象
				var a = document.getElementsByName('term2')[0];
				var b = document.getElementsByName('js')[0];
				//绑定数据
				s.bind(a,xq);//xq和kc来自js文件的变量
				s.bind(b,js);//a和b来自本页面的属性
				
				//确定从属关系
				s.parent(a,b);
			 </script>
			<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
			</form>
	  </div>
	  <div class="panel-body">
		 <table class="table table-bordered table-hover tablesorter">
		  <thead>
			<tr><th style="text-align: center;" width="6%">ID</th><th style="text-align: center;">学期</th><th style="text-align: center;" width="12%">任课教师</th><th style="text-align: center;">班级</th><th style="text-align: center;">课程</th><th style="text-align: center;" width="12%">任务数量</th><td style="text-align: center;font-weight: bold;">操作</td></tr>
			</thead>
			<tbody id="tob">
			<?php if(is_array($coursetable)): foreach($coursetable as $key=>$v): $tr = substr($v['term'],10,1); ?>
				<tr <?php if($tr == 1): ?>class="trColor"<?php endif; ?>  >
				<td><?php echo ($v["scid"]); ?></td>
				<td><?php echo ($v["term"]); ?></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["cname"]); ?></td>
				<td><?php echo ($v["coursename"]); ?></td>
				<td><?php $i=0; $scid = $v['scid']; $pubnum = M('sxpubexcise')->where("scid=$scid")->count(); if($pubnum>0)$i=1; ?>
    				<span class="numColor<?php echo ($i); ?>"><?php echo ($pubnum); ?></span>
    			</td>
				<td align="left">　
				   <a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$v['scid']));?>" class="btn btn-default btn4" title="查看指定教师发布的指定课程的任务列表！"><span class="glyphicon glyphicon-eye-open"></span> 任务列表</a>&nbsp;
					
					<?php if( $pubnum != 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxfinishCount',array('scid'=>$v['scid']));?>" class="btn btn-default btn4" title="将课程任务完成情况统计下载！"><span class="glyphicon glyphicon-save"></span> 任务统计</a>&nbsp;
						<a href="<?php echo U(GROUP_NAME.'/Excise/sxcoursePackage',array('scid'=>$v['scid']));?>" class="btn btn-default btn4" title="将该课程所有任务和学生作业打包下载！"><span class="glyphicon glyphicon-save"></span> 资料存档</a>&nbsp;<?php endif; ?>
					
					<?php if($pubnum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/delcourseTable',array('id'=>$v['scid']));?>" class="btn btn-default" title="如果没有任务可以直接删除，否则需要删尽其下的任务再进行删除！"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<!-- 排序分页开始 -->
		<div id="pager" class="pager">
			<form>
			    <span class="label label-default" style="display:inline-block;height: 26px;line-height: 20px;">当前任课数 <?php echo ($num); ?></span>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/first.png" class="first"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/prev.png" class="prev"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/next.png" class="next"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/last.png" class="last"/>
				<input type="text" class="pagedisplay" style="width: 50px;height: 26px;border-radius:4px;text-align: center;" />
				<select class="pagesize" style="width: 50px;height: 26px;line-height:18px;border-radius:4px;text-align: center;">
					<option selected="selected"  value="10">10</option>
					<option value="30">30</option>
					<option  value="50">50</option>
					<option  value="100">100</option>
				</select>
			</form>
		</div>
		<!-- 排序  分页结束 -->
	  </div>
	  
</div>
</body>
</html>
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
    
    //判断浏览器是不是IE，包括(IE10和11)
    /*
	function isIE() { //ie?
	 if (!!window.ActiveXObject || "ActiveXObject" in window)
	  alert("是");
	  else
	  alert("不是");
	 }
	 isIE();
	 */
</script>
<style type="text/css">
	.btnw{
		width: 90px;
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
	.headalign{
		text-align:left;
		padding-bottom:-20px;
	}
	.form-inline{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 16px;
		
		height:40px;
		line-height:40px;
	 }
	 .trColor{
	 	background-color: #eee;
	 }
	 .browse{
		width: 110px;
		height:35px;
		line-height: 24px;
		font-size: 16px;
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
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的课程表</a>
		<span style="float:right;">
		<a href="<?php echo U(GROUP_NAME.'/News/sysNews');?>" class="btn btn-success browse" ><span class="glyphicon glyphicon-bullhorn"></span> 查看消息</a>&nbsp;
			<button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;
			<a href="<?php echo U(GROUP_NAME.'/Excise/coursetableSave');?>" class="btn btn-info btnw"><span class="glyphicon glyphicon-plus"></span> 添加课程</a>
		</span>		
	  </div>
	  <div class="form-inline">
			<form action="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" method="post">
			<select name='term' class="form-control">
				<option value="0">选择学期查看...</option>
				<?php if(is_array($term)): foreach($term as $key=>$v): ?><option value="<?php echo ($v["term"]); ?>"><?php echo ($v["term"]); ?></option><?php endforeach; endif; ?>
			</select>
			<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
			</form>
	   </div>
	  <div class="panel-body">
		 <table class="table table-bordered table-hover tablesorter">
		  <thead>
			<tr style="text-align: center;font-weight: bold;"><th style="text-align: center;" width="6%">序号</th><th style="text-align: center;" width="12%">学期</th><th style="text-align: center;" width="14%">课程</th><th style="text-align: center;" width="11%">任务数量</th><th style="text-align: center;" width="14%">班级</th><td width="8%">班主任</td><td>联系电话</td><td>操作</td></tr>
			<?php $i=1;?>
			</thead>
			<tbody>
			<?php if(is_array($list)): foreach($list as $key=>$v): $tr = substr($v['term'],10,1); ?>
				<tr <?php if($tr == 1): ?>class="trColor"<?php endif; ?>  >
				
				<td><?php echo ($v["scid"]); ?></td>
				<td><?php echo ($v["term"]); ?></td>
				<td><?php echo ($v["coursename"]); ?></td>
				<td><?php $i=0; $scid = $v['scid']; $pubnum = M('sxpubexcise')->where("scid=$scid")->count(); if($pubnum>0)$i=1; ?>
    				<span class="numColor<?php echo ($i); ?>"><?php echo ($pubnum); ?></span>
    			</td>
				<td><?php echo ($v["cname"]); ?></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["jsdh"]); ?></td>
				<td align="left">　
				  
				   <a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$v['scid']));?>" class="btn btn-default btnw" ><span class="glyphicon glyphicon-eye-open"></span> 任务列表</a>&nbsp;

					<?php if( $pubnum != 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxfinishCount',array('scid'=>$v['scid']));?>" class="btn btn-default btnw" title="将课程任务完成情况统计下载！"><span class="glyphicon glyphicon-save"></span> 任务统计</a>&nbsp;
						<a href="<?php echo U(GROUP_NAME.'/Excise/sxcoursePackage',array('scid'=>$v['scid']));?>" class="btn btn-default btnw" title="将该课程所有任务和学生作业打包下载！"><span class="glyphicon glyphicon-save"></span> 资料存档</a><?php endif; ?>&nbsp;
					<?php if( $pubnum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/delcourseTable',array('id'=>$v['scid']));?>" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php endif; ?>
				</td>
			</tr>
			
			<?php $i++; endforeach; endif; ?>
			</tbody>
		</table>
		<!-- 排序分页开始 -->
		<div id="pager" class="pager">
			<form>
			    <span class="label label-default" style="display:inline-block;height: 26px;line-height: 20px;">当前授课数 <?php echo ($num); ?></span>
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
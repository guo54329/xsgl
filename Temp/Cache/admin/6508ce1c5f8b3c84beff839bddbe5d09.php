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
	function copyurl(obj){
    	var scid = obj.name;
    	var url = obj.value;
    	var str= "序号为：<b>"+scid+"</b>　服务器拷贝地址为：<b style='color:red;'>"+url+"</b>";
    	$('#urlcontent').html(str);
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
	.btn-sm{
    	width:55px;
    }
	.numColor0{
		color: red;

	}
	.numColor1{
		color: green;
		font-size: 14px;
	}
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
	.form-inline{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 16px;
		
		height:76px;
		line-height:26px;
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
	  		方式一：
  			<select name="term1" class="form-control" style="width: 120px;"></select>
			<select name="coursename" class="form-control" style="width: 220px;"></select>
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
			　　
	  		方式二：
  			<select name="term2" class="form-control" style="width: 120px;"></select>
			<select name="js" class="form-control" style="width: 140px;"></select>
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
			<p>提示：文件<b>超过100MB</b>请单击<b>拷贝</b>按钮，将下面生成的地址复制到<b>服务器计算机的窗口</b>中打开复制即可!<br/>
                <span id="urlcontent"><b style='color:red;'>单击拷贝按钮后会此处生成地址</b></span></p>
			</form>
	  </div>
	  <div class="panel-body">
		 <table class="table table-bordered table-hover tablesorter" style="font-size: 11px;">
		  <thead>
			<tr style="text-align: center;font-weight: bold;">
				<th width="50px" style="text-align: center;">ID</th><th width="100px" style="text-align: center;">学期</th><th  width="70px" style="text-align: center;">教师</th><th style="text-align: center;">班级</th><th width="100px"  style="text-align: center;">课程</th><td width="60px">任务数</td><td>下发/提交</td><th width="60px" style="text-align: center;">完成率</th><th  style="text-align: center;" min-width="80px">文件</th><td width="190px">操作</td></tr>
			</thead>
			<tbody id="tob">
			<?php $totaln=0;?><!-- 统计系统文件总数 -->
			<?php $totals=0;?><!-- 统计系统文件总大小 -->
			<?php $index=0;?>
			<?php if(is_array($coursetable)): foreach($coursetable as $key=>$v): $tr = substr($v['term'],10,1); ?>
				<tr <?php if($tr == 1): ?>class="trColor"<?php endif; ?>  >
				<td><?php echo ($v["scid"]); ?></td>
				<td><?php echo ($v["term"]); ?></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["cname"]); ?></td>
				<td  align="left"><?php echo ($v["coursename"]); ?></td>
				<td><?php $i=0; $scid = $v['scid']; $pubnum = M('sxpubexcise')->where("scid=$scid")->count(); if($pubnum>0)$i=1; ?>
    				<span class="numColor<?php echo ($i); ?>"><?php echo ($pubnum); ?></span>
    			</td>
    			<td><?php $i=0; $recnum = M('sxsetcourse as a')->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.scid=$scid")->count(); if($recnum>0)$i=1; ?>
					<span class="numColor<?php echo ($i); ?>"><?php echo ($recnum); ?></span>
    			    /
    			     <?php $i=0; $subnum = M('sxsetcourse as a')->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.scid=$scid and c.status=1")->count(); if($subnum>0)$i=1; $finish = (round($subnum / $recnum,4)*100)."%"; $j=0; if($subnum==$recnum and $subnum!=0){ $j=1; } ?>
					<span class="numColor<?php echo ($i); ?>"><?php echo ($subnum); ?></span>
    			</td>
    			<td><span class="numColor<?php echo ($j); ?>"><?php echo ($finish); ?></span></td>
    			<td><?php $thistermnum=0; $thistermsize=0; $thistermfile = M('sxsetcourse as a')->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.scid=$scid")->field('url')->select(); for($i=0;$i<count($thistermfile);$i++){ $tempnum=0; $tempsize=0; $path = substr($thistermfile[$i]['url'],0,-1); $res = readDirAndFile($path,$tempnum,$tempsize); $thistermnum += $res['totalnum']; $thistermsize += $res['totalsize']; } $filesize = $thistermsize; $filesize=format_bytes($filesize); if($thistermnum>0){ $totaln += $thistermnum; $totals += $thistermsize; $file = $thistermnum."(".$filesize.")"; }else{ $file = "暂无"; } $k=2; $downflag=0; if($thistermsize>1024*1024*100){ $downflag=1; } ?>
				   <span class="numColor<?php echo ($k); ?>"><?php echo ($file); ?></span>
    			</td>
				<td align="left">　
				   <a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$v['scid']));?>" class="btn btn-default btn-sm" title="查看指定教师发布的指定课程的任务列表！"><span class="glyphicon glyphicon-eye-open"></span> 任务</a>&nbsp;
					
					<?php if( $pubnum != 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxfinishCount',array('scid'=>$v['scid']));?>" class="btn btn-default btn-sm" title="将课程任务完成情况统计下载！"><span class="glyphicon glyphicon-download"></span> 统计</a>&nbsp;
						<?php if( $downflag == 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxcoursePackage',array('scid'=>$v['scid']));?>" class="btn btn-default btn-sm" title="将该课程所有任务和学生作业打包下载！"><span class="glyphicon glyphicon-save"></span> 下载</a>
						 <?php else: ?>
							<button onclick="copyurl(this);" name="<?php echo ($scid); ?>" value="<?php echo ($url[$index]); ?>" class="btn btn-default btn-sm" title="文件过大，提供在服务器上拷贝地址！"> <span class="glyphicon glyphicon-tag"></span> 拷贝</button><?php endif; endif; ?>
					
					<?php if($pubnum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/delcourseTable',array('id'=>$v['scid']));?>" class="btn btn-default btn-sm" title="如果没有任务可以直接删除，否则需要删尽其下的任务再进行删除！"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php endif; ?>
				</td>
			</tr>
			<?php $index++; endforeach; endif; ?>
			</tbody>
		</table>
		<table>
			<tr><td style="height: 40px;"></td></tr>
			<tr><td colspan="12" style="text-align: left;height: 40px;line-height: 30px;">
				合计：目前系统共有 <b><?php echo ($totaln); ?></b> 个文件，所占磁盘空间 <b><?php echo format_bytes($totals) ?></b>
			</td></tr>
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
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
    
    function copyurl(obj){
    	var scid = obj.name;
    	var url = obj.value;
    	var str= "序号为：<b>"+scid+"</b>　服务器拷贝地址为：<b>"+url+"</b>";
    	$('#urlcontent').html(str);
    }
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
			<tr style="text-align: center;font-weight: bold;"><th style="text-align: center;" width="5%">序号</th><th style="text-align: center;" width="8%">学期</th><th style="text-align: center;">课程</th><th style="text-align: center;" width="6%">任务数</th><td>接收人数</td><td>提交人数</td><th style="text-align: center;font-weight: bold;" width="6%">完成率</th><td>文件数(大小)</td><th style="text-align: center;" width="11%">班级</th><td width="6%">班主任</td><td width="8%">联系电话</td><td width="18%">操作</td></tr>
			</thead>
			<tbody>
			<?php $totaln=0;?><!-- 统计系统文件总数 -->
			<?php $totals=0;?><!-- 统计系统文件总大小 -->
			<?php $index=0;?>
			<?php if(is_array($list)): foreach($list as $key=>$v): $tr = substr($v['term'],10,1); ?>
				<tr <?php if($tr == 1): ?>class="trColor"<?php endif; ?>  >
				
				<td><?php echo ($v["scid"]); ?></td>
				<td><?php echo ($v["term"]); ?></td>
				<td><?php echo ($v["coursename"]); ?></td>
				<td><?php $i=0; $scid = $v['scid']; $pubnum = M('sxpubexcise')->where("scid=$scid")->count(); if($pubnum>0)$i=1; ?>
    				<span class="numColor<?php echo ($i); ?>"><?php echo ($pubnum); ?></span>
    			</td>
    			<td><?php $i=0; $recnum = M('sxsetcourse as a')->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.scid=$scid")->count(); if($recnum>0)$i=1; ?>
					<span class="numColor<?php echo ($i); ?>"><?php echo ($recnum); ?></span>
    			</td>
    			<td><?php $i=0; $subnum = M('sxsetcourse as a')->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->join('inner join xh_sxsubexcise as c on b.peid=c.peid')->where("a.scid=$scid and c.status=1")->count(); if($subnum>0)$i=1; $finish = (round($subnum / $recnum,4)*100)."%"; $j=0; if($subnum==$recnum and $subnum!=0){ $j=1; } ?>
					<span class="numColor<?php echo ($i); ?>"><?php echo ($subnum); ?></span>
    			</td>
    			<td><span><span class="numColor<?php echo ($j); ?>"><?php echo ($finish); ?></span></span></td>
    			<td><?php $thistermnum=0; $thistermsize=0; $thistermfile = M('sxsetcourse as a')->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("a.scid=$scid")->field('url')->select(); for($i=0;$i<count($thistermfile);$i++){ $tempnum=0; $tempsize=0; $path = substr($thistermfile[$i]['url'],0,-1); $res = readDirAndFile($path,$tempnum,$tempsize); $thistermnum += $res['totalnum']; $thistermsize += $res['totalsize']; } $filesize = $thistermsize; $filesize=format_bytes($filesize); if($thistermnum>0){ $totaln += $thistermnum; $totals += $thistermsize; $file = $thistermnum."(".$filesize.")"; }else{ $file = "暂无"; } $k=2; $downflag=0; if($thistermsize>1024*1024*100) ?>
				   <span class="numColor<?php echo ($k); ?>"><?php echo ($file); ?></span>
    			</td>
				<td><?php echo ($v["cname"]); ?></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["jsdh"]); ?></td>
				<td align="left">　
				  
				   <a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$v['scid']));?>" class="btn btn-default btnw" ><span class="glyphicon glyphicon-eye-open"></span> 任务列表</a>
					<?php if( $pubnum != 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxfinishCount',array('scid'=>$v['scid']));?>" class="btn btn-default" title="将课程任务完成情况统计下载！"><span class="glyphicon glyphicon-save"></span> 统计</a>
						 <?php if( $downflag == 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxcoursePackage',array('scid'=>$v['scid']));?>" class="btn btn-default" title="将该课程所有任务和学生作业打包下载！"><span class="glyphicon glyphicon-save"></span> 下载</a>
						 <?php else: ?>
							<button onclick="copyurl(this);" name="<?php echo ($scid); ?>" value="<?php echo ($url[$index]); ?>" class="btn btn-default" title="文件过大，提供在服务器上拷贝地址！"> <span class="glyphicon glyphicon-tag"></span> 拷贝</button><?php endif; endif; ?>
					<?php if( $pubnum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/delcourseTable',array('id'=>$v['scid']));?>" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php endif; ?>
				</td>
			</tr>
			
			<?php $index++; endforeach; endif; ?>
			<tr><td colspan="12" style="text-align: left;height: 40px;line-height: 30px;">
				合计：目前系统共有 <b><?php echo ($totaln); ?></b> 个文件，所占磁盘空间 <b><?php echo format_bytes($totals) ?></b>
			</td></tr>
			<tr><td colspan="12" style="text-align: left;height: 80px;line-height: 30px;">
				提示：系统设计为文件先压缩在下载，当文件<b>超过100MB</b>时显示<b>拷贝</b>按钮，用户可以单击<b>拷贝</b>按钮，在此处会生成一个地址，可以将此地址复制到<b>服务器计算机的窗口</b>中打开，然后对目标文件或文件夹进行复制！<br/>
                <span id="urlcontent"></span>
			</td></tr>
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
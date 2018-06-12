<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script src="__PUBLIC__/Js/dialog/layer.js"></script>
<script src="__PUBLIC__/Js/dialog.js"></script>

<!-- 排序加入开始 -->
<!-- <script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/jquery-latest.js"></script> -->
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
//将拷贝URL置于span
function copyurl(obj){
	var scid = obj.name;
	var url = obj.value;
	var str= "序号为：<b>"+scid+"</b>　服务器拷贝地址为：<b>"+url+"</b>";
	$('#urlcontent').html(str);
}
function publish(obj){
	if(confirm("请看清按钮名称执行本操作，确认则执行，取消则不执行！")){
        var peid = obj.id;
		var status = $("#status"+peid);
		var scid = $("#scid"+peid).val();
	    var url ="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseStatus');?>";
	    var data = {'peid':peid,'status':status.val(),'scid':scid};
	    $.post(url,data,function(result){
	    	if(result.status == 0) {
	            window.location.reload();
	        }
	        if(result.status == 1) {
	        	if(status.val()==0){
					status.val("1");
	        	}else{
	        		status.val("0");
	        	}
	        	
	        	$("#s"+peid).html(result.data);
	        	window.location.reload();
	            
	        }
	    },'JSON');
	}else{
 	    alert("您已取消此操作！");
	} 
}

function del(obj){
	var peid = obj.id;
	var scid = $("#scid"+peid).val();
	var url = "<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDel');?>";
	$.post(url,{'peid':peid,'scid':scid},function(result){
		//alert(result.data);
    	if(result.status == 0) {
            return dialog.error(result.message);
        }
        if(result.status == 1) {
        	var resurl = result.data;
            return dialog.success(result.message,resurl);
        }
    },'JSON'); 

}
</script>
<style type="text/css">
	.btncoursetable{
		width: 100px;
		text-align: left;
	}
	.browse{
		width:90px;
	}
	.btn-sm{
		width: 55px;
	}
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
	.headalign{
		text-align: left;
	}
	.numColor{
		color: red;
		font-size: 16px;
		font-weight: bold;
	}
	.yes{
		color:green;
	}
	.no{
		color: red;
	}
	.form-inline{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 16px;
		height:76px;
		line-height:28px;
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
		<a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的课程表</a><span class="btn xiexian">/</span><a  class="btn btn4">任务列表</a>
		
		<span style="float:right;"><button class="btn btn-info btnw" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;
	  	<a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseSave',array('scid'=>$courseinfo['scid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-plus"></span> 添加任务</a>
	  	<a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseClone',array('scid'=>$courseinfo['scid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-share"></span> 克隆任务</a>&nbsp;
	  </span>
	  </div>
	  <div class="form-inline">
	  	学期：<strong><?php echo ($courseinfo["term"]); ?></strong>&nbsp;&nbsp;
		    班级：<strong><?php echo ($courseinfo["cname"]); ?></strong>&nbsp;&nbsp;课程：<strong><?php echo ($courseinfo["coursename"]); ?></strong>
		    <p>提示：文件<b>超过100MB</b>请单击<b>拷贝</b>按钮，将下面生成的地址复制到<b>服务器计算机的窗口</b>中打开复制即可!<br/>
                <span id="urlcontent"><b style='color:red;'>单击拷贝按钮后会此处生成地址</b></span></p>
	  </div>

	  <div class="panel-body">
		 <table class="table table-bordered table-hover tablesorter" style="font-size:11px;">
			<thead>
			
			<tr style="text-align: center;font-weight: bold;"><th width="50px">序号</th><td align="left">任务题目</td><!--<td>任务描述</td><td>任务附件</td>--><td width="60px">状态</td><th width="120px" style="text-align: center;"><span title="在交流页面是否允许相互下载作业">是否允许</span></th><td width="90px">发布时间</td><th width="60px" style="text-align: center;">完成</th><th style="text-align: center;min-width:80px;">文件数</th><td width="420px;">操作(请在学生完成页面设置一键重新然后撤销发布再执行删除)</td></tr>
			</thead>
			<tbody>
			<?php $totaln=0;?><!-- 统计系统文件总数 -->
			<?php $totals=0;?><!-- 统计系统文件总大小 -->
			<?php $i=0;?>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
				<td><?php echo ($i+1); $v.peid;?></td>
				<td align="left"><?php echo ($v["title"]); ?></td>
				<!--<td><?php echo ($v["desc"]); ?></td>
				<td><?php echo ($v["title"]); ?></td>-->
				<td><span id="s<?php echo ($v["peid"]); ?>"><?php if($v['status'] == 0): ?><span class="no">未发布</span> <?php else: ?><span class="yes">已发布</span><?php endif; ?></span></td>
				<td>
					<?php if($v['isrec'] == 0): ?><span class="no">禁止</span>
					<?php else: ?><span class="yes">允许</span><?php endif; ?>
				    <a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseIsrec',array('peid'=>$v['peid']));?>" class="btn btn-default btn-sm" title="设置在评价交流页面是否允许学生下载他人作业评价"><span class="glyphicon glyphicon-eye-close"></span> 设置</a>
				</td>
				<td><?php echo (date('m-d H:i',$v["pubtime"])); ?></td>
				<td>
					<?php $peid=$v['peid']; $subtotalnum=M('sxsubexcise')->where("peid=$peid")->count(); $suboknum=M('sxsubexcise')->where("peid=$peid and status=1")->count(); if($suboknum==0){ echo "<span class='numColor'>".$suboknum."</span>/".$subtotalnum; }else{ echo "<span>".$suboknum."</span>/".$subtotalnum; } ?>
				</td>
				<td><?php $thistermnum=0; $thistermsize=0; $tempnum=0; $tempsize=0; $thistermfile = M('sxsetcourse as a')->join('inner join xh_sxpubexcise as b on a.scid = b.scid')->where("b.peid=$peid")->field('url')->find(); $path = substr($thistermfile['url'],0,-1); $res = readDirAndFile($path,$tempnum,$tempsize); $thistermnum = $res['totalnum']; $thistermsize = format_bytes($res['totalsize']); if($thistermnum>0){ $totaln += $thistermnum; $totals += $res['totalsize']; $file = $thistermnum."(".$thistermsize.")"; }else{ $file = "暂无"; } $downflag=0; if($res['totalsize']>1024*1024*100){ $downflag=1; } ?>
				   <span><?php echo ($file); ?></span>
    			</td>
				<td align="left">
				
				<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList',array('peid'=>$v['peid']));?>" class="btn btn-default browse" ><span class="glyphicon glyphicon-eye-open"></span> 学生完成</a>&nbsp;

				<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseTable',array('peid'=>$v['peid']));?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-download"></span> 统计</a>
				<?php if( $downflag == 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxexcisePackage',array('peid'=>$v['peid']));?>" class="btn btn-default btn-sm" title="将该任务和学生作业打包下载！"><span class="glyphicon glyphicon-save"></span> 下载</a>
				 <?php else: ?>
					<button onclick="copyurl(this);" name="<?php echo ($i+1); ?>" value="<?php echo ($url[$i]); ?>" class="btn btn-default btn-sm" title="文件过大，提供在服务器上拷贝地址！"> <span class="glyphicon glyphicon-tag"></span> 拷贝</button><?php endif; ?>
				

				<input type="hidden" id="status<?php echo ($v["peid"]); ?>" value="<?php echo ($v["status"]); ?>" />
				<input type="hidden" id="scid<?php echo ($v["peid"]); ?>" value="<?php echo ($courseinfo["scid"]); ?>" />
				<a href="<?php echo U(GROUP_NAME.'/Excise/sxexciseDiscuss',array('peid'=>$v['peid']));?>" class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-comment"></span> 交流</a>&nbsp;&nbsp;
				<?php if($v['status'] == 0): ?><button class="btn btn-default btn-sm" id="<?php echo ($v["peid"]); ?>" onclick="publish(this);"><span class="glyphicon glyphicon-share-alt"></span> 发布</button>&nbsp;
				<?php else: ?>
					<button class="btn btn-default btn-sm" id="<?php echo ($v["peid"]); ?>" onclick="publish(this);"><span style="color: red;"><span class="glyphicon glyphicon-share-alt"></span> 撤销</span></button>&nbsp;<?php endif; ?>

				<button class="btn btn-default btn-sm" id="<?php echo ($v["peid"]); ?>" onclick="del(this);"><span class="glyphicon glyphicon-remove"></span> 删除</button>
				<!--如果有附件，在提供下载按钮  || 此处取消附件下载功能
				<?php if($v['url'] != '0' ): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDownAttach',array('peid'=>$v['peid']));?>" class="btn btn-default" ><span class="glyphicon glyphicon-save"></span> 附件</a><?php endif; ?>&nbsp;-->
				</td>
			</tr>
			<?php $i++; endforeach; endif; ?>
			
			</tbody>
		</table>
		<table>
			<tr><td style="height:40"></td></tr>
			<tr><td style="text-align: left;">
				合计：目前该课程共有 <b><?php echo ($totaln); ?></b> 个文件，所占磁盘空间 <b><?php echo format_bytes($totals) ?></b>
			</td></tr>
		</table>
		<!-- 排序分页开始 -->
		<div id="pager" class="pager">
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
	  
</div>
</body>
</html>
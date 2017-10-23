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
function publish(obj){
	if(confirm("发布后再执行此操作相当于撤销将会清除已提交的学生作业，请谨慎操作！")){
		var peid = obj.id;
		var status = $("#status"+peid);
		var scid = $("#scid"+peid).val();
	    var url ="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseStatus');?>";
	    var data = {'peid':peid,'status':status.val(),'scid':scid};
	    $.post(url,data,function(result){
	    	if(result.status == 0) {
	    		window.location.reload();
	            //return dialog.error(result.message);
	        }
	        if(result.status == 1) {
	        	if(status.val()==0){
					status.val("1");
	        	}else{
	        		status.val("0");
	        	}
	        	
	        	$("#s"+peid).html(result.data);
	        	window.location.reload();
	            //return dialog.successtip(result.message);
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

function myrefresh(){
		window.location.reload();
}
</script>
<style type="text/css">
	.browse{
		width: 90px;
	}
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
		height:30px;
		line-height:30px;
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
	   <a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 教师课表</a><span class="btn xiexian">/</span><a  class="btn btn4">任务列表</a>
	   <span style="float: right;">
	   		<button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;
	  		<a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseSave',array('scid'=>$courseinfo['scid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-plus"></span> 添加任务</a>
	  		<a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseClone',array('scid'=>$courseinfo['scid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-share"></span> 克隆任务</a>&nbsp;
	   </span>
	</div>
	<div class="form-inline">
		学期：<strong><?php echo ($courseinfo["term"]); ?></strong>&nbsp;&nbsp;
	    教师：<strong><?php echo ($courseinfo["jsxm"]); ?></strong>&nbsp;&nbsp;
	    班级：<strong><?php echo ($courseinfo["cname"]); ?></strong>&nbsp;&nbsp;课程：<strong><?php echo ($courseinfo["coursename"]); ?></strong><br/>
	</div>
	  <div class="panel-body">
		 <table class="table table-bordered table-hover tablesorter">
			<thead>
			<tr style="text-align: center;font-weight: bold;"><th width="6%">序号</th><th width="24%" style="text-align: center;">任务题目</th><!--<td>任务描述</td><td>任务附件</td>--><td width="7%">状态</td><td width="10%">发布时间</td><td width="8%">完成</td><td align="left">操作(删除:1.有作业设置重做2.单击“发布”撤销发布状态)</td></tr>
			</thead>
			<tbody>
			<?php $i=1;?>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
				<td><?php echo ($v["peid"]); ?></td>
				<td align="left"><?php echo ($v["title"]); ?></td>
				<!--<td><?php echo ($v["desc"]); ?></td>
				<td><?php echo ($v["title"]); ?></td>-->
				<td><span id="s<?php echo ($v["peid"]); ?>"><?php if($v['status'] == 0 ): ?><span class="no">未发布</span> <?php else: ?><span class="yes">已发布</span><?php endif; ?></span></td>
				<td><?php echo (date('Y-m-d H:i:s',$v["pubtime"])); ?></td>
				<td>
					<?php $i=0; $peid=$v['peid']; $subtotalnum=M('sxsubexcise')->where("peid=$peid")->count(); $suboknum=M('sxsubexcise')->where("peid=$peid and status=1")->count(); if($suboknum==0){ echo "<span class='numColor'>".$suboknum."</span>/".$subtotalnum; }else{ echo "<span>".$suboknum."</span>/".$subtotalnum; } ?>

				</td>
				<td align="left">
				<button class="btn btn-default" id="<?php echo ($v["peid"]); ?>" onclick="publish(this);" title="发布后再次单击执行撤销发布操作"><span class="glyphicon glyphicon-share-alt"></span> 发布</button>&nbsp;
				<button class="btn btn-default" id="<?php echo ($v["peid"]); ?>" onclick="del(this);" ><span class="glyphicon glyphicon-remove"></span> 删除</button>&nbsp;&nbsp;
				<!--如果有附件，在提供下载按钮  此处不在提供附件下载功能
				<?php if($v['url'] != '0' ): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDownAttach',array('peid'=>$v['peid']));?>" class="btn btn-default" ><span class="glyphicon glyphicon-save"></span> 附件</a><?php endif; ?>&nbsp;	-->	　
				<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList',array('peid'=>$v['peid']));?>" class="btn btn-default browse" ><span class="glyphicon glyphicon-eye-open"></span> 学生完成</a>&nbsp;
				<a href="<?php echo U(GROUP_NAME.'/Excise/sxexciseDiscuss',array('peid'=>$v['peid']));?>" class="btn btn-default browse" ><span class="glyphicon glyphicon-comment"></span> 评价交流</a>&nbsp;
				<a href="<?php echo U(GROUP_NAME.'/Excise/sxexcisePackage',array('peid'=>$v['peid']));?>" class="btn btn-default browse" title="将该任务和学生作业打包下载！"><span class="glyphicon glyphicon-save"></span> 学生作业</a>
				<input type="hidden" id="status<?php echo ($v["peid"]); ?>" value="<?php echo ($v["status"]); ?>" />
				<input type="hidden" id="scid<?php echo ($v["peid"]); ?>" value="<?php echo ($courseinfo["scid"]); ?>" />
				</td>
			</tr>
			<?php $i++; endforeach; endif; ?>
			</tbody>
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
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
<script type="text/javascript">
function publish(obj){
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
	.yes{
		color:green;
	}
	.no{
		color: red;
	}

</style>
</head>

<body>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
	   <a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 教师课表</a><span class="btn xiexian">/</span><a  class="btn btn4">任务列表</a>
	   <span style="float: right;">
	   		<button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;
	  		<a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseSave',array('scid'=>$courseinfo['scid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-plus"></span> 添加任务</a>
	   </span>
	</div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
		    <tr>
		    <td colspan="7">
		    学期：<strong><?php echo ($courseinfo["term"]); ?></strong>&nbsp;&nbsp;
		    教师：<strong><?php echo ($courseinfo["jsxm"]); ?></strong>&nbsp;&nbsp;
		    班级：<strong><?php echo ($courseinfo["cname"]); ?></strong>&nbsp;&nbsp;课程：<strong><?php echo ($courseinfo["coursename"]); ?></strong>
		    </td>
		    </tr>
			<tr><td>ID</td><td>任务题目</td><!--<td>任务描述</td><td>任务附件</td>--><td>发布状态</td><td>发布时间</td><td>完成情况</td><td align="left">操作(请在删除任务之前确保无学生作业)</td></tr>
			<?php $i=1;?>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
				<td><?php echo ($v["peid"]); ?></td>
				<td align="left"><?php echo ($v["title"]); ?></td>
				<!--<td><?php echo ($v["desc"]); ?></td>
				<td><?php echo ($v["title"]); ?></td>-->
				<td><span id="s<?php echo ($v["peid"]); ?>"><?php if($v['status'] == 0 ): ?><span class="no">未发布</span> <?php else: ?><span class="yes">已发布</span><?php endif; ?></span></td>
				<td><?php echo (date('Y-m-d H:i:s',$v["pubtime"])); ?></td>
				<td>
					<?php $peid=$v['peid']; $subtotalnum=M('sxsubexcise')->where("peid=$peid")->count(); $suboknum=M('sxsubexcise')->where("peid=$peid and status=1")->count(); echo $suboknum."/".$subtotalnum; ?>
				</td>
				

				<td align="left">
				<a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseEdit',array('peid'=>$v['peid']));?>" class="btn btn-default" ><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;

				<button class="btn btn-default" id="<?php echo ($v["peid"]); ?>" onclick="publish(this);" title="发布后再次单击执行撤销发布操作"><span class="glyphicon glyphicon-share-alt"></span> 发布</button>&nbsp;
				<button class="btn btn-default" id="<?php echo ($v["peid"]); ?>" onclick="del(this);" title="若有学生作业，请先设置重做！"><span class="glyphicon glyphicon-remove"></span> 删除</button>&nbsp;
				<!--如果有附件，在提供下载按钮  此处不在提供附件下载功能
				<?php if($v['url'] != '0' ): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDownAttach',array('peid'=>$v['peid']));?>" class="btn btn-default" ><span class="glyphicon glyphicon-save"></span> 附件</a><?php endif; ?>&nbsp;	-->	　
				<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList',array('peid'=>$v['peid']));?>" class="btn btn-default browse" ><span class="glyphicon glyphicon-eye-open"></span> 学生完成</a>&nbsp;
				
				<a href="<?php echo U(GROUP_NAME.'/Excise/sxexcisePackage',array('peid'=>$v['peid']));?>" class="btn btn-default browse" title="将该任务和学生作业打包下载！"><span class="glyphicon glyphicon-save"></span> 学生作业</a>&nbsp;
				<a href="<?php echo U(GROUP_NAME.'/Excise/sxexciseDiscuss',array('peid'=>$v['peid']));?>" class="btn btn-default browse" ><span class="glyphicon glyphicon-comment"></span> 交流讨论</a>
				<input type="hidden" id="status<?php echo ($v["peid"]); ?>" value="<?php echo ($v["status"]); ?>" />
				<input type="hidden" id="scid<?php echo ($v["peid"]); ?>" value="<?php echo ($courseinfo["scid"]); ?>" />

				</td>
			</tr>
			<?php $i++; endforeach; endif; ?>
		</table>
	  </div>

</div>
</body>
</html>
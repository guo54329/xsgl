<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="30">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script src="__PUBLIC__/Js/dialog/layer.js"></script>
<script src="__PUBLIC__/Js/dialog.js"></script>

<script type="text/javascript">
function myrefresh(){
	window.location.reload();
}
function isrec(obj){
	var seid = obj.id;
	var value= obj.value;
	if(value>=0 && value<=100){
		var url="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseIsrecpj');?>";
		var data={'seid':seid,'isrec':value};
		$.post(url,data,'JSON');
	}else{
		alert('请检查成绩应该在[0-100]!');
	}
}
</script>
<style type="text/css">
	.desc{
		text-align:left;
	}
	.headalign{
		text-align:left;
	}
	th{
		text-align:center;
	}
	.browse{
		width: 90px;
	}
	.browse1{
		width:100px;
	}
	.btn-sm{
		width: 55px;
	}
	.btncoursetable{
		width: 100px;
		text-align: left;
	}
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
	.no{
		color: red;
	}
	.numColor{
		color: red;
		font-size: 16px;
		font-weight: bold;
	}
	.numColorok{
		color: green;
		font-size: 16px;
		font-weight: bold;
	}
	.form-control{
		padding:5px 0px 5px 0px;
		margin:5px 5px 5px 16px;
		padding-left: 5px;
		height:100px;
	 }
</style>
</head>

<body>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		  <a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的课程表</a><span class="btn xiexian">/</span><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$courseinfo['scid']));?>" class="btn btn4">任务列表</a><span class="btn xiexian">/</span><a class="btn browse1">学生完成情况</a>
		  <span style="float:right;">
			<button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;&nbsp;间隔30秒后自动刷新 &nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseaddStu',array('peid'=>$excisedesc['peid'],'scid'=>$courseinfo['scid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-plus"></span> 补充学生</a>&nbsp;

	  		<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseRedoAll',array('peid'=>$excisedesc['peid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-repeat"></span> 一键重做</a>&nbsp;
	  		<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseTable',array('peid'=>$excisedesc['peid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-download"></span> 完成情况</a>
		  </span>
		 
	  </div>

	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr class="desc">
		    <td colspan="10">
				学期：<strong><?php echo ($courseinfo["term"]); ?></strong>&nbsp;&nbsp;
			    班级：<strong><?php echo ($classes["cname"]); ?></strong>&nbsp;&nbsp;
			    课程：<strong><?php echo ($courseinfo["coursename"]); ?></strong>&nbsp;&nbsp;
			    完成情况：
			    <?php $subtotalnum=M('sxsubexcise')->where("peid=$peid")->count(); $suboknum=M('sxsubexcise')->where("peid=$peid and status=1")->count(); if($suboknum==0){ echo "<b><span class='numColor'>".$suboknum."</span>人完成,共".$subtotalnum."人<b/>"; }else{ echo "<b><span class='numColorok'>".$suboknum."</span>人完成,共".$subtotalnum."人</b>"; } ?>
			</td></tr>
		    <tr class="desc">
		    <td colspan="10">
		    <strong>任务标题：</strong><?php echo ($excisedesc["title"]); ?>&nbsp;&nbsp;
		    <?php if($excisedesc['filename'] != ''): ?><strong>附件下载：</strong><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDownAttach',array('peid'=>$excisedesc['peid']));?>"  ><span class="glyphicon glyphicon-save"></span> <?php echo ($excisedesc["filename"]); ?>(<?php echo format_bytes(filesize($oldurl.($excisedesc['filename']))); ?>)</a><?php endif; ?>
		    <strong>&nbsp;&nbsp;发布时间：</strong><?php echo (date('Y-m-d H:i:s',$excisedesc["pubtime"])); ?><br/>
		    <strong>任务描述：</strong><?php echo ($excisedesc["desc"]); ?>
		    </td>
		    </tr>
			<tr><th>序号</th><th>学号</th><th>姓名</th><th>提交状态</th><th>提交时间</th><th>文件大小</th><th>自评(30%)</th><th>师评(70%)</th><th>实训成绩</th><th style="width: 220px;">操作</th></tr>
		
			<?php $i=1;?>
			<?php if(is_array($exciselist)): foreach($exciselist as $key=>$v): ?><tr style="font-size: 14px;">
				<td><?php echo ($i); ?></td>
				<td><?php echo ($v["xsno"]); ?></td>
				<td><?php echo ($v["xsxm"]); ?></td>
				<td><?php if($v['status'] == 0 ): ?><span class="no">未提交</span><?php else: ?>已提交<?php endif; ?>
				</td>
				<td><?php if($v['subtime'] != 0): echo (date('Y-m-d H:i:s',$v["subtime"])); endif; ?></td>
				<td>
					<?php if($v['filename']!=''){ $filesize = filesize($oldurl.$v['filename']); if($filesize>=50*1024*1024){ echo '<b>'.format_bytes($filesize).'</b>'; }else{ echo format_bytes($filesize); } } ?>
				</td>

				<td><?php echo ($v["desc"]); ?></td>
				<td><input type="text" id="<?php echo ($v["seid"]); ?>" name="isrec" value="<?php echo ($v["isrec"]); ?>" onblur="isrec(this)" style="width: 80px;border-radius: 4px;text-align: center;" />
				</td>
				<td><?php echo $v['desc']*0.3+$v['isrec']*0.7; ?></td>
				<td class="footeralign" width="20%">
				   <?php if($v['status'] == 1 ): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDownAttach',array('seid'=>$v['seid']));?>" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-save"></span> 下载</a>&nbsp;&nbsp;<?php endif; ?>
					<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseRedo',array('seid'=>$v['seid']));?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-repeat"></span> 重做</a>
					<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDel',array('seid'=>$v['seid']));?>" class="btn btn-default btn-sm" title="如果该生已不存在，则可直接删除；如果存在，删除之前先设置重做！"><span class="glyphicon glyphicon-remove"></span> 删除</a>
					

				</td>
			</tr>
			<?php $i++; endforeach; endif; ?>
			
		</table>
	  </div>
	  <div>
	    <div style="right:20;bottom: 50;position: fixed;"><button class="btn btn-info btnw" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button></div>
		<div style="right:20;bottom: 15;position: fixed;"><a href="#top" class="btn btn-info"><span class="glyphicon glyphicon-chevron-up"></span> 回顶</a></div>
	  </div>
</div>
</body>
</html>
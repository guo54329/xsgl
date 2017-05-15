<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml"><head><meta charset="utf-8"><!--<meta http-equiv="refresh" content="10">--><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" /><link rel="stylesheet" href="__PUBLIC__/Css/main.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script><script src="__PUBLIC__/Js/dialog/layer.js"></script><script src="__PUBLIC__/Js/dialog.js"></script><script type="text/javascript">function myrefresh(){
	window.location.reload();
}
function isrec(obj){
	var seid = obj.id;
	var value= obj.value;
	if(value>=0 && value<=100){
		var url="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseIsrec');?>";
		var data={'seid':seid,'isrec':value};
		$.post(url,data,'JSON');
	}else{
		alert('请检查成绩应该在[0-100]!');
	}
}
</script><style type="text/css">	.footeralign,.desc{
		text-align:left;
	}
	th{
		text-align:center;
	}
	.browse{
		width: 100px;
	}
	.no{
		color: red;
	}
</style></head><body><div class="panel panel-default"><div class="panel-heading">学生完成情况 </div><div class="panel-footer footeralign"><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$courseinfo['scid']));?>" class="btn btn-info btnw"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返回</a>&nbsp;
	  		<button class="btn btn-info btnw" onclick="myrefresh()"><span class="glyphicon glyphicon-repeat"></span> 刷新</button>&nbsp;
	  		<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseTable',array('peid'=>$excisedesc['peid']));?>" class="btn btn-info btnw"><span class="glyphicon glyphicon-floppy-save"></span> 导出</a></div><div class="panel-body"><table class='table table-bordered table-hover'><tr class="desc"><td colspan="8">		    学期：<strong><?php echo ($courseinfo["term"]); ?></strong>&nbsp;&nbsp;
		    班级：<strong><?php echo ($classes["cname"]); ?></strong>&nbsp;&nbsp;
		    课程：<strong><?php echo ($courseinfo["coursename"]); ?></strong></td></tr><tr class="desc"><td colspan="8"><strong>任务标题：</strong><?php echo ($excisedesc["title"]); ?>&nbsp;&nbsp;<strong>附件下载：</strong><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDownAttach',array('peid'=>$excisedesc['peid']));?>"  ><span class="glyphicon glyphicon-save"></span><?php echo ($excisedesc["filename"]); ?></a><strong>&nbsp;&nbsp;发布时间：</strong><?php echo (date('Y-m-d H:i:s',$excisedesc["pubtime"])); ?><br/><strong>任务描述：</strong><?php echo ($excisedesc["desc"]); ?></td></tr><tr><th>序号</th><th>学号</th><th>姓名</th><th>提交状态</th><th>提交时间</th><th>自评(满分10分)</th><th>实训成绩</th><th>操作</th></tr><?php $i=1; if(is_array($exciselist)): foreach($exciselist as $key=>$v): ?><tr><td><?php echo ($i); ?></td><td><?php echo ($v["xsno"]); ?></td><td><?php echo ($v["xsxm"]); ?></td><td><?php if($v['status'] == 0 ): ?><span class="no">未提交</span><?php else: ?>已提交<?php endif; ?></td><td><?php echo (date('Y-m-d H:i:s',$v["subtime"])); ?></td><td><?php echo ($v["desc"]); ?></td><td><input type="text" id="<?php echo ($v["seid"]); ?>" name="isrec" value="<?php echo ($v["isrec"]); ?>" onblur="isrec(this)" style="width: 80px;border-radius: 4px;text-align: center;" /></td><td><?php if($v['status'] == 1 ): ?>　
					<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDownAttach',array('seid'=>$v['seid']));?>" class="btn btn-default browse"><span class="glyphicon glyphicon-save"></span> 下载附件</a><?php endif; ?>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseRedo',array('seid'=>$v['seid']));?>" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span> 重做</a></td></tr><?php $i++; endforeach; endif; ?></table></div></div></body></html>
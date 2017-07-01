<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<!--<meta http-equiv="refresh" content="10">-->
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
		var url="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseIsrec');?>";
		var data={'seid':seid,'isrec':value};
		$.post(url,data,'JSON');
	}else{
		alert('请检查成绩应该在[0-100]!');
	}
}
</script>
<style type="text/css">
	.footeralign,.desc{
		text-align:left;
	}
	th{
		text-align:center;
	}
	.browse{
		width: 90px;
	}
	.no{
		color: red;
	}
	.fresh{
		right:20;
		top: 210;
		position: fixed;
	}
</style>
</head>

<body>
<div class="panel panel-default">
	  <div class="panel-heading">学生完成情况 </div>
	  <div class="panel-footer footeralign"> 
	  		<a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$courseinfo['scid']));?>" class="btn btn-info"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返回</a>&nbsp;
	  		<button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;&nbsp;&nbsp;&nbsp;
	  		<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseRedoAll',array('peid'=>$excisedesc['peid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-repeat"></span> 一键重做</a>&nbsp;
	  		<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseTable',array('peid'=>$excisedesc['peid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-download"></span> 完成情况</a>

	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
		    <tr class="desc">
		    <td colspan="9">
		    学期：<strong><?php echo ($courseinfo["term"]); ?></strong>&nbsp;&nbsp;
		    班级：<strong><?php echo ($classes["cname"]); ?></strong>&nbsp;&nbsp;
		    课程：<strong><?php echo ($courseinfo["coursename"]); ?></strong>
		    </td>
		    </tr>
		    <tr class="desc">
		    <td colspan="9">
		    <strong>任务标题：</strong><?php echo ($excisedesc["title"]); ?>&nbsp;&nbsp;<strong>附件下载：</strong><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDownAttach',array('peid'=>$excisedesc['peid']));?>"  ><span class="glyphicon glyphicon-save"></span> <?php echo ($excisedesc["filename"]); ?></a><strong>&nbsp;&nbsp;发布时间：</strong><?php echo (date('Y-m-d H:i:s',$excisedesc["pubtime"])); ?><br/>
		    <strong>任务描述：</strong><?php echo ($excisedesc["desc"]); ?>
		    </td>
		    </tr>
			<tr><th>序号</th><th>学号</th><th>姓名</th><th>提交状态</th><th>提交时间</th><th>自评(30%)</th><th>师评(70%)</th><th>实训成绩</th><th>操作</th></tr>
			<?php $i=1;?>
			<?php if(is_array($exciselist)): foreach($exciselist as $key=>$v): ?><tr>
				<td><?php echo ($i); ?></td>
				<td><?php echo ($v["xsno"]); ?></td>
				<td><?php echo ($v["xsxm"]); ?></td>
				<td><?php if($v['status'] == 0 ): ?><span class="no">未提交</span><?php else: ?>已提交<?php endif; ?>
				</td>
				<td><?php if($v['subtime'] != 0): echo (date('Y-m-d H:i:s',$v["subtime"])); endif; ?></td>
				<td><?php echo ($v["desc"]); ?></td>
				<td><input type="text" id="<?php echo ($v["seid"]); ?>" name="isrec" value="<?php echo ($v["isrec"]); ?>" onblur="isrec(this)" style="width: 80px;border-radius: 4px;text-align: center;" />
				</td>
				<td><?php echo $v['desc']*0.3+$v['isrec']*0.7; ?></td>
				<td class="footeralign">
				   
					<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseRedo',array('seid'=>$v['seid']));?>" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span> 重做</a>
					&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDel',array('seid'=>$v['seid']));?>" class="btn btn-default" title="如果该生已不存在，则可直接删除；如果存在，删除之前先设置重做！"><span class="glyphicon glyphicon-remove"></span> 删除</a>
					<?php if($v['status'] == 1 ): ?>&nbsp;　
					<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDownAttach',array('seid'=>$v['seid']));?>" class="btn btn-default browse"><span class="glyphicon glyphicon-save"></span> 下载附件</a><?php endif; ?>

				</td>
			</tr>
			<?php $i++; endforeach; endif; ?>
		</table>
	  </div>
	  <div class="fresh"><button class="btn btn-info btnw" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button></div>
</div>
</body>
</html>
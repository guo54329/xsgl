<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" /><link rel="stylesheet" href="__PUBLIC__/Css/main.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script><script src="__PUBLIC__/Js/dialog/layer.js"></script><script src="__PUBLIC__/Js/dialog.js"></script><script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script><script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script><script type="text/javascript">	window.UEDITOR_HOME_URL='__ROOT__/Data/Ueditor/';
	window.onload =function(){
		window.UEDITOR_CONFIG.initialFrameWidth=800;
		window.UEDITOR_CONFIG.initialFrameHeight=150;
		//window.UEDITOR_CONFIG.scaleEnabled=true;
		window.UEDITOR_CONFIG.toolbars=[[
            
             'fullscreen', 'source','paragraph', 'fontfamily', 'fontsize', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify','|', 
            'print', 'preview', 'help'
        ]];
	
		//图片保存路径直接在Ueditor/php/config.json中配置imagePathFormat的值
		UE.getEditor('content'); //实例化编辑器

	}

	$(document).ready(function(e) {
   		$(".formItemDiff").click(function() { //hover
			$(this).css("background-position", "0px -555px");
			$(this).prevAll().css("background-position", "0px -555px");
			$(this).nextAll().css("background-position", "0px -575px");
		
			$("#pointP").html(($(this).prevAll().length+1)*10);
			$("#desc").val($("#pointP").html());

		});
	});
</script><style type="text/css">	#content{
	    text-align: left;
	}
	#title{
		width: 600px；
	}
	tr{
		text-align: left;
	}
	.browse{
		width: 100px;
	}
	.attach{
		width:220px;
	}
    .formItemDiff {
		width: 20px;
		height: 20px;
		background-image: url(__PUBLIC__/Images/diff.png);
		background-position: 0px -575px;
		float: left;
		margin-top: 15px;
	}
	.formItemDiffFirst {
		margin-left: 20px;
	}
</style></head><body><form action='<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDo');?>' method='post' enctype="multipart/form-data"><div class="panel panel-default"><div class="panel-heading">本次任务详情(<strong>课程：<?php echo ($dolist["coursename"]); ?></strong>) </div><div class="panel-body"><table class='table table-bordered table-hover'><tr><td colspan="2"><strong>任务标题：</strong><?php echo ($dolist["title"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;
			<strong>附件下载：</strong><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDownAttach',array('peid'=>$dolist['peid']));?>" class="btn btn-default attach"><span class="glyphicon glyphicon-save"><?php echo ($dolist["filename"]); ?></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<strong>发布时间：</strong><?php echo (date('Y-m-d H:i:s',$dolist["pubtime"])); ?><br/><strong>任务描述：</strong><?php echo ($dolist["desc"]); ?></td></tr><tr><td colspan="2" align="left" style="height: 50px;line-height: 30px;background-color: #F5F5F5;"><strong>请上传已完成的实训作业，并进行自评！</strong></td></tr><tr><td>上传作业:</td><td><div class="form-inline"><input type="file"  name="attach"  class="form-control" /><span class="glyphicon glyphicon-info-sign"></span> 如果附件文件类型为php、text、html，请先转换为zip文件后上传
				    </div></td></tr><tr><td>自评成绩:</td><td><div class="item" style="margin-top: -14px;margin-left: -5px;"><div class="formItemDiff formItemDiffFirst"></div><div class="formItemDiff"></div><div class="formItemDiff"></div><div class="formItemDiff"></div><div class="formItemDiff"></div><div class="formItemDiff"></div><div class="formItemDiff"></div><div class="formItemDiff"></div><div class="formItemDiff"></div><div class="formItemDiff"></div><p id="pointP" style="float:left; margin-left:20px;margin-top: 15px;"></p></div><input type="hidden" id="desc" name="desc" value="0"><!--自我评价--></td></tr></table></div><div class="panel-footer"><input type="hidden" name="seid" value="<?php echo ($dolist["seid"]); ?>"><button type="submit" name="sub" class="btn btn-info browse"><span class="glyphicon glyphicon-check"></span> 提交完成</button></div></div></form></body></html>
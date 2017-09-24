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
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script>

<script type="text/javascript">	
	window.UEDITOR_HOME_URL='__ROOT__/Data/Ueditor/';
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
</script>
<style type="text/css">
	#content{
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
	.headalign{
		text-align: left;
	}
	.btncoursetable{
		width:90px;
		text-align: left;
	}
	.browse{
		width: 100px;
		height:35px;
		line-height: 24px;
		font-size: 16px;
	}
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
</style>
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDo');?>' method='post' enctype="multipart/form-data">
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的任务</a><span class="btn xiexian">/</span><a  class="btn btn4">任务详情</a>
		<span style="float: right;">
			<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDo',array('seid'=>$dolist['seid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-hand-right"></span> 去提交</a>
			<a onclick="if(confirm('此操作会删除已提交作业，请确认!')==false)return false;" href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseRedo',array('seid'=>$dolist['seid']));?>" class="btn btn-info browse"><span class="glyphicon glyphicon-repeat"></span> 重做 </a>
		</span>	
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr>
				<td width="20%" align="center">所属课程</td>
				<td><?php echo ($dolist["coursename"]); ?></td>
			</tr>
			<tr>
				<td align="center">发布时间</td>
				<td><?php echo (date('Y-m-d H:i:s',$dolist["pubtime"])); ?></td>
			</tr>
			<tr>
				<td align="center">任务标题</td>
				<td><?php echo ($dolist["title"]); ?></td>
			</tr>
			<tr>
				<td align="center">附件下载</td>
				<td><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDownAttach',array('peid'=>$dolist['peid']));?>" class="btn  attach"><span class="glyphicon glyphicon-save"> <?php echo ($dolist["filename"]); ?></span> </a></td>
			</tr>
			<tr>
				<td align="center">任务描述</td>
				<td height="200px"><?php echo ($dolist["desc"]); ?></p></td>
			</tr>
		   
		</table>
	  </div>
</div>
</form>
</body>
</html>
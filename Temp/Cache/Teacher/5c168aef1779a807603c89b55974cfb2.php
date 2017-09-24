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
	
		//TP里面的上传类，相关配置，此处没用到
		  //window.UEDITOR_CONFIG.imageUrl="<?php echo U(GROUP_NAME.'/Blog/upload');?>"; 
		  //window.UEDITOR_CONFIG.imagePath='__ROOT__/uploads/';

		//图片保存路径直接在Ueditor/php/config.json中配置imagePathFormat的值
		UE.getEditor('content'); //实例化编辑器

	}

</script>
<style type="text/css">
	#content{
	    text-align: left;
	}
	#title{
		width: 600px；
	}
	.headalign{
		text-align:left;
	}
	.browse{
		width: 90px;
	}
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
	.btncoursetable{
		width: 100px;
		text-align: left;
	}
</style>												
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Excise/sxpubexciseSave');?>' method='post' enctype="multipart/form-data">
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		  <a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的课程表</a><span class="btn xiexian">/</span><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$scid));?>" class="btn btn4">任务列表</a><span class="btn xiexian">/</span><a  class="btn btn4">添加任务</a>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>	
			<tr>
				<td width="20%">课程名称:</td>
				<td align="left"><?php echo ($coursename); ?></td>	
			</tr>
			<tr>
				<td>任务标题:</td>
				<td>
				<div class="form-inline">
				<input type="text" placeholder="请输入标题" name="title" id="title" class="form-control" style="width:500px;" />
				</div>
				</td>
			</tr>
			<tr>
				<td>任务描述:</td>
				<td><textarea name='desc' id='content' ></textarea></td>
			</tr>
			<tr>
				<td>任务附件:</td>
				<td>
				   <div class="form-inline">
				     <input type="file"  name="file_upload"  class="form-control" />   <div style="text-align: left;">
						 <span class="glyphicon glyphicon-info-sign"></span> 附件<font size="4" color="red">最大支持100M</font>,必须上传(学生的作业使用任务附件的路径保存).建议上传文件为zip格式.<br/><b>多文件时,请先压缩再上传.如果压缩包上传成功但提交时提示“请上传附件”,请另选择压缩软件压缩上传!”</b>
				         </div>
				    </div>
				</td>
			</tr>
		</table>	
	  </div>
	  
	  <div class="panel-footer">
	      <input name="scid" type='hidden'  value="<?php echo ($scid); ?>"/>
	      <button class="btn btn-info" type="submit" ><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
</form>
</body>
</html>
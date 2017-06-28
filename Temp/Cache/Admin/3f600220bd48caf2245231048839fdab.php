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
</style>												
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Excise/sxpubexciseSave');?>' method='post' enctype="multipart/form-data">
<div class="panel panel-default">
	  <div class="panel-heading">添加任务(您正在为<strong><?php echo ($coursename); ?></strong>添加任务)</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>	
			<tr>
				<td>任务标题:</td>
				<td>
				<div class="form-inline">
				<input type="text" placeholder="请输入标题" name="title" id="title" class="form-control" />
				</div>
			</tr>
			<tr>
				<td>任务描述:</td>
				<td><textarea name='desc' id='content' ></textarea></td>
			</tr>
			<tr>
				<td>任务附件:</td>
				<td>
				   <div class="form-inline">
				     <input type="file"  name="attach"  class="form-control" /><br/> <span class="glyphicon glyphicon-info-sign"></span> 必须上传附件(附件的内容可以是任务描述或要求),如果附件文件类型为php、text、html,请先转换为zip文件后再上传.<br/>
				      <span class="glyphicon glyphicon-flash"></span> 注意：学生提交作业时使用的是任务附件的保存路径，如果发布的任务没有附件，则相应没有文件保存路径，学生的作业就无路径无法提交！
				    </div>
				</td>
			</tr>
		</table>	
	  </div>
	  
	  <div class="panel-footer">
	      <input name="scid" type='hidden'  value="<?php echo ($scid); ?>"/>
	      <button class="btn btn-info" type="submit" ><span class="glyphicon glyphicon-check"></span> 提交</button>&nbsp;&nbsp;
	      <a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$scid));?>" class="btn btn-info btnw"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返回</a>

	  </div>
</div>
</form>
</body>
</html>
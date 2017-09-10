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
<script src="__ROOT__/Data/Uploader/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__ROOT__/Data/Uploader/uploadify.css">
<script type="text/javascript">	
	window.UEDITOR_HOME_URL='__ROOT__/Data/Ueditor/';
	window.onload =function(){
		window.UEDITOR_CONFIG.initialFrameWidth=800;
		window.UEDITOR_CONFIG.initialFrameHeight=120;
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
	
	/*定义上传按钮*/
	.uploadify-button {
		background:url(__ROOT__/Data/Uploader/btnbg.PNG ) no-repeat;
		border:0px;
		border-radius:0;
		margin-left:62px; 

	}
	.uploadify:hover .uploadify-button {
		background:url(__ROOT__/Data/Uploader/btnbg.PNG )  no-repeat;
		border:1px solid #009999;
		border-radius:0;
	}
</style>												
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Excise/sxpubexciseSave');?>' method='post' enctype="multipart/form-data">
<div class="panel panel-default">
	<div class="panel-heading headalign">
		  <a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 教师课表</a><span class="btn xiexian">/</span><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$scid));?>" class="btn btn4">任务列表</a><span class="btn xiexian">/</span><a  class="btn btn4">添加任务</a>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
		    <tr>
				<td>所属课程:</td>
				<td align="left">添加任务</td>
			</tr>	
			<tr>
				<td>任务标题:</td>
				<td>
				<div class="form-inline">
				<input type="text" placeholder="请输入标题" name="title"  class="form-control" value="<?php echo ($excise['title']); ?>" style="width: 500px;"/>
				</div>
				</td>
			</tr>
			<tr>
				<td>任务描述:</td>
				<td><textarea name='desc' id='content'><?php echo ($excise['desc']); ?></textarea></td>
			</tr>
			<tr>
				<td>任务附件:</td>
				<td>
					   <form>
						<div id="queue"></div>
						<input id="file_upload" name="file_upload" type="file">
						<div style="text-align: left;">
						 <span class="glyphicon glyphicon-info-sign"></span> 附件<font size="4" color="red">最大支持100M</font>,必须上传(学生的作业使用任务附件的路径保存).建议上传文件为zip格式.
				         </div>
					   </form>
					<script type="text/javascript">
					<?php $timestamp = time();?>
					$(function() {
						$('#file_upload').uploadify({
							'formData'     : {
								'scid':'<?php echo $scid;?>', /*scid此处传递*/
								'timestamp' : '<?php echo $timestamp;?>',
								'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
							},
							'swf'      : '__ROOT__/Data/Uploader/uploadify.swf',
							'uploader' : '<?php echo U(GROUP_NAME.'/Excise/uploadfile');?>',
							
							'height'   : 32,
							'width'    : 120,
							'buttonText': '',
							'multi'     : false,
							'buttonClass' : 'uploadify-button',
							'fileSizeLimit' : '100MB',
							'onUploadSuccess':function(file,data,response){
								var peid=data.replace(/\ufeff/g,'')
								$("#peid").val(peid);
			                    //alert(peid);
			                 }
						});
					});
				</script>
				</td>
			</tr>
		</table>	
	  </div>
	  
	  <div class="panel-footer" style="text-align: center;">
	  	  <input name="scid" type='hidden' value="<?php echo ($scid); ?>" />
	      <input id="peid" name="peid" type='hidden' value="0" />
	      <button class="btn btn-info" type="submit"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
</form>
</body>
</html>
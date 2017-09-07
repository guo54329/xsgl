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
		width: 90px;
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
	}
	.uploadify:hover .uploadify-button {
		background:url(__ROOT__/Data/Uploader/btnbg.PNG )  no-repeat;
		border:1px solid #009999;
		border-radius:0;
	}
</style>
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDo');?>' method='post' enctype="multipart/form-data">
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的任务</a><span class="btn xiexian">/</span><a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDesc',array('seid'=>$seid));?>"  class="btn btn4">任务详情</a><span class="btn xiexian">/</span><a  class="btn btn4">任务提交</a>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr>
				<td colspan="2" align="left" style="height: 50px;line-height: 30px;background-color: #F5F5F5;"><strong>任务提交</strong></td>			
			</tr>
			<tr>
				<td colspan="2" align="left" style="height: 50px;line-height: 30px;background-color: #F5F5F5;">
					提示：请自评并上传作业，最后单击“提交完成”！
				</td>			
			</tr>
			<tr>
				<td align="center"><span style="height: 40px;line-height: 40px;">自评成绩:</span></td>
				<td>
				<div class="item" style="margin-left: -5px;height: 50px;line-height: 50px;">
		          <div class="formItemDiff formItemDiffFirst"></div>
		          <div class="formItemDiff"></div>
		          <div class="formItemDiff"></div>
		          <div class="formItemDiff"></div>
		          <div class="formItemDiff"></div>
		          <div class="formItemDiff"></div>
		          <div class="formItemDiff"></div>
		          <div class="formItemDiff"></div>
		          <div class="formItemDiff"></div>
		          <div class="formItemDiff"></div>
		          <p id="pointP" style="float:left; margin-left:20px;">0</p>分
		        </div>
				<input type="hidden" id="desc" name="desc" value="0"><!--自我评价-->
				</td>
			</tr>		
			<tr>
				<td align="center"><span style="height: 84px;line-height: 84px;">上传作业:</span></td>
				<td>
				   <form>
						<div id="queue"></div>
						<input id="file_upload" name="file_upload" type="file">
						 <span class="glyphicon glyphicon-info-sign"></span> 附件<font size="4" color="red">最大支持100M</font>,必须上传(附件的内容可以是任务描述或要求).<br/>建议压缩成zip文件后再上传.
					   </form>
					<script type="text/javascript">
					<?php $timestamp = time();?>
					$(function() {
						$('#file_upload').uploadify({
							'formData'     : {
								'seido':'<?php echo $seid;?>',
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
							'onUploadSuccess':function(file,data,res){
  								var seid=data.replace(/\ufeff/g,'')
								$("#seid").val(seid);
								//alert(seid);
							}
							
							});
						});
					</script>
				</td>
			</tr>
			
		</table>
	  </div>
	  <div class="panel-footer">
       <input type="hidden" id="seid" name="seid" value="0">
	  <button type="submit"  class="btn btn-info browse"><span class="glyphicon glyphicon-check"></span> 提交完成</button>
	  </div>
</div>
</form>
</body>
</html>
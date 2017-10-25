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
		width: 90px;
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
		<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的任务</a><span class="btn xiexian">/</span><a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDesc',array('seid'=>$seid));?>"  class="btn btn4">任务详情</a><span class="btn xiexian">/</span><a  class="btn btn4">任务提交</a>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr>
				<td colspan="2" align="left" style="height: 50px;line-height: 30px;background-color: #F5F5F5;"><strong>任务提交</strong></td>			
			</tr>
			<tr>
				<td colspan="2" align="left" style="height: 50px;line-height: 30px;background-color: #F5F5F5;">
					提示：请先自评，然后上传任务作业，最后单击“提交完成”！
				</td>			
			</tr>
			<tr>
				<td style="height: 50px;line-height: 50px;">自评成绩:</td>
				<td>
				<div class="item" style="margin-top: 0px;margin-left: -5px;">
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
		          <p id="pointP" style="float:left; margin-left:20px;margin-top: 15px;"></p>
		        </div>
				<input type="hidden" id="desc" name="desc" value="0"><!--自我评价-->
				</td>
			</tr>		
			<tr>
				<td>上传作业:</td>
				<td>
				   <div class="form-inline">
				     <input type="file"  name="file_upload"  class="form-control" />   <div style="text-align: left;">
						 <span class="glyphicon glyphicon-info-sign"></span> 附件<font size="4" color="red">最大支持100M</font><b>.多文件时,请先使用360压缩后再上传!”</b>
				         </div>
				    </div>
				</td>
			</tr>
			
		</table>
	  </div>
	  <div class="panel-footer">
       <input type="hidden" name="seid" value="<?php echo ($seid); ?>">
	  <button type="submit"  class="btn btn-info browse"><span class="glyphicon glyphicon-check"></span> 提交完成</button>
	  </div>
</div>
</form>
</body>
</html>
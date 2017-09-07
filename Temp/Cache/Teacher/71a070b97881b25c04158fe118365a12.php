<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__ROOT__/Data/Ueditor/ueditor.all.min.js"></script>

<script type="text/javascript">	
	window.UEDITOR_HOME_URL='__ROOT__/Data/Ueditor/';
	window.onload =function(){
		//window.UEDITOR_CONFIG.initialFrameWidth=860;
		window.UEDITOR_CONFIG.initialFrameHeight=200;
		//window.UEDITOR_CONFIG.scaleEnabled=true;
		window.UEDITOR_CONFIG.toolbars=[[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough',  'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', '|',
            'horizontal', 'date', 'time', 'spechars', 'snapscreen'
            ],[
             'paragraph', 'fontfamily', 'fontsize', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify','|', 
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'background','removeFormat', '|','print', 'preview', 'help'
        ]];

		window.UEDITOR_CONFIG.maximumWords=100000;
		//TP里面的上传类，相关配置，此处没用到
		  //window.UEDITOR_CONFIG.imageUrl="<?php echo U(GROUP_NAME.'/Blog/upload');?>"; 
		  //window.UEDITOR_CONFIG.imagePath='__ROOT__/uploads/';

		//图片保存路径直接在Ueditor/php/config.json中配置imagePathFormat的值
		UE.getEditor('content'); //实例化编辑器

	
	}

</script>
<style type="text/css">
	.headalign{
		text-align: left;
	}
	.btncoursetable{
		width:110px;
		text-align: left;
	}
</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading headalign">
			<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 发布消息</a>
	  </div>
	  <form action='<?php echo U(GROUP_NAME.'/News/newsSave');?>' method='post'>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>	
			<tr>
				<td align='right' width='20%'>标题</td>
				<td><input type="text" placeholder="请输入标题" name="title" id="title" class="form-control" style="width:500px;" />
			</tr>
			<tr><td align='right'>接收对象</td>
				<td>
				<select  name="ccode" class="form-control" style="width:500px;">
						<option value="0">请选择接收对象</option>
						<?php if(is_array($ccodes)): foreach($ccodes as $key=>$v): ?><option value="<?php echo ($v["ccode"]); ?>"><?php echo ($v["cname"]); ?></option><?php endforeach; endif; ?>
						
					</select>
					
				</td>
			</tr>
			<tr>
				<td align='right'>内容<br/><br/><br/>推荐字号<br/>字号<=16px </td>
				<td width='70%'><textarea name='content' id='content' placeholder="不推荐使用富文本"></textarea></td>
			</tr>

		</table>	
	  </div>
	  
	  <div class="panel-footer">
	 	 <button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
	  </form>
</div>

</body>
</html>
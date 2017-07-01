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
		window.UEDITOR_CONFIG.initialFrameHeight=400;
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
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Home/addNews');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading">发布消息</div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>	
			<tr>
				<td align='right' width='20%'>标题</td>
				<td><input type="text" placeholder="请输入标题" name="title" id="title" class="form-control" />
			</tr>
			<tr><td align='right'>接收对象</td>
				<td><select id="pubtype" name="pubtype" class="form-control">
						<option value="0">请选择接收对象</option>
						<option value="1">所有教师和学生</option>
						<option value="2">所有教师</option>
						<option value="3">所有学生</option>
						
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
	  	&nbsp;&nbsp;
	  		<a href="<?php echo U(GROUP_NAME.'/Home/News');?>" class="btn btn-info btnw"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返回</a>
	  </div>
</div>
</form>
</body>
</html>
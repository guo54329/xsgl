<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" /><link rel="stylesheet" href="__PUBLIC__/Css/main.css" /><script src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script><script src="__PUBLIC__/Js/dialog/layer.js"></script><script src="__PUBLIC__/Js/dialog.js"></script><style type="text/css">	.btn-info{
		width:130px;
	}
	.badge{
		background-color: white;
	}
	.form-inline{
		text-align: left;
	}
	.headalign{
		text-align: left;
	}
	.btncoursetable{
		width:110px;
		text-align: left;
	}
	.left{
		text-align: left;
		height: 40px;
		line-height: 40px;
		font-weight: bold;
	}
	.row{
		font-size:13px;
	}
	.row .col-md-2{
		text-align: right;
	}
	h4{
		margin-top: -6px;
	}
</style><script type="text/javascript">$(function(){
	//alert("__ROOT__");
	//alert("__ROOT__".length);
	
	$('#del').click(function(){
		var rootlen = "__ROOT__".length;
		$('.rootpath').each(function(){
		    var res =$(this).val().substring(rootlen);
		    $(this).attr("value",res); //兼容IE和谷歌
		 	//$(this).val(res);
		});
		dialog.successtip($('#del').text()+"成功！");
		//alert($('#del').text()+"成功！");
	});
	$('#add').click(function(){
		$('.rootpath').each(function(){
		    var res ="__ROOT__" + $(this).val();
		    $(this).attr("value",res); //兼容IE和谷歌
		    //$(this).val(res);
		});
		dialog.successtip($('#add').text()+"成功！");
		//alert($('#add').text()+"成功！");
	});
});
</script></head><body><div class="panel panel-default"><div class="panel-heading headalign"><a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 百度编辑器配置</a></div><div class="panel-body"><table class='table table-bordered table-hover'><tr><td colspan="4" class="left">配置要点：<br/>			(1)上传保存路径：如项目在xsgl中开发，将xsgl里面的所有文件迁移到web根目录下的xsgl中时，需要在/Public前面添加/xsgl;迁移到web根目录下，需要删除/xsgl。<br/>			(2)其他方面的修改请参照原参数值。根据下面path查看Public前面是否有路径，不需要则：
			<button id="del" class="btn btn-info">一键删除多余路径</button>，需要则：
			<button id="add" class="btn btn-info">一键添加所需路径</button></td></tr><form action='<?php echo U(GROUP_NAME.'/System/uejson');?>' method='post'><tr><td><h4  class="left">上传图片配置项</h4><div class="row"><div class=col-md-2>		    			imagePathFormat：
			    		</div><div class="col-md-6"><input type='text' name='imagePathFormat' value='<?php echo ($uejson["imagePathFormat"]); ?>' class="form-control rootpath" style="min-width:500px;"/></div><div class="col-md-2">			    			imageMaxSize(b)：
			    		</div><div class="col-md-2"><input type='text' name='imageMaxSize' value='<?php echo ($uejson["imageMaxSize"]); ?>' class="form-control" style="width:100px;"/></div></div><div class="row"><div class="col-md-2">		    				imageAllowFiles：
		    			</div><div class="col-md-6"><input type='text' name='imageAllowFiles' value="<?php echo (arrtostr($uejson["imageAllowFiles"])); ?>" class="form-control" style="min-width:500px;"/></div></div></td></tr><tr style="display: none;"><td><h4 class="left">涂鸦图片上传配置项</h4><div class="row"><div class="col-md-2">		    				scrawlPathFormat：
		    			</div><div class="col-md-6"><input type='text' name='scrawlPathFormat' value='<?php echo ($uejson["scrawlPathFormat"]); ?>' class="form-control  rootpath" style="width:500px;"/></div><div class="col-md-2">		    				scrawlMaxSize(b)：
		    			</div><div class="col-md-2"><input type='text' name='scrawlMaxSize' value='<?php echo ($uejson["scrawlMaxSize"]); ?>' class="form-control" style="width:100px;"/></div></div></td></tr><tr style="display: none;"><td><h4 class="left">截图工具上传</h4><div class="row"><div class="col-md-2">			    			snapscreenPathFormat：
			    		</div><div class="col-md-10"><input type='text' name='snapscreenPathFormat' value='<?php echo ($uejson["snapscreenPathFormat"]); ?>' class="form-control  rootpath" style="width:500px;"/></div></div></td></tr><tr style="display: none;"><td><h4 class="left">抓取远程图片配置</h4><div class="row"><div class="col-md-2">			    			catcherPathFormat：
			    		</div><div class="col-md-6"><input type='text' name='catcherPathFormat' value='<?php echo ($uejson["catcherPathFormat"]); ?>' class="form-control  rootpath" style="width:500px;"/></div><div class="col-md-2">			    			catcherMaxSize(b)：
			    		</div><div class="col-md-2"><input type='text' name='catcherMaxSize' value='<?php echo ($uejson["catcherMaxSize"]); ?>' class="form-control" style="width:100px;"/></div></div><div class="row" style="display: none;"><div class="col-md-2">			    			catcherAllowFiles：
			    		</div><div class="col-md-10"><input type='text' name='catcherAllowFiles' value="<?php echo (arrtostr($uejson["catcherAllowFiles"])); ?>" class="form-control" style="width:500px;"/></div></div></td></tr><tr><td><h4 class="left">上传视频配置</h4><div class="row"><div class="col-md-2">			    			videoPathFormat：
			    		</div><div class="col-md-6"><input type='text' name='videoPathFormat' value='<?php echo ($uejson["videoPathFormat"]); ?>' class="form-control  rootpath" style="min-width:500px;"/></div><div class="col-md-2">			    			videoMaxSize(b)：
			    		</div><div class="col-md-2"><input type='text' name='videoMaxSize' value='<?php echo ($uejson["videoMaxSize"]); ?>' class="form-control" style="width:100px;"/></div></div><div class="row"><div class="col-md-2">							videoAllowFiles：
						</div><div class="col-md-10"><input type='text' name='videoAllowFiles' value="<?php echo (arrtostr($uejson["videoAllowFiles"])); ?>" class="form-control" style="min-width:650px;"/></div></div></td></tr><tr><td><h4 class="left">上传文件配置</h4><div class="row"><div class="col-md-2">			    			filePathFormat：
			    		</div><div class="col-md-6"><input type='text' name='filePathFormat' value='<?php echo ($uejson["filePathFormat"]); ?>' class="form-control  rootpath" style="min-width:500px;"/></div><div class="col-md-2">			    			fileMaxSize(b)：
			    		</div><div class="col-md-2"><input type='text' name='fileMaxSize' value='<?php echo ($uejson["fileMaxSize"]); ?>' class="form-control" style="width:100px;"/></div></div><div class="row"><div class="col-md-2">							fileAllowFiles：
						</div><div class="col-md-10"><input type='text' name='fileAllowFiles' value="<?php echo (arrtostr($uejson["fileAllowFiles"])); ?>" class="form-control" style="min-width:500px;"/></div></div></td></tr><tr><td style="display: none;"><h4 class="left">列出指定目录下的图片</h4><div class="row"><div class="col-md-2">			    			imageManagerListPath：
			    		</div><div class="col-md-6"><input type='text' name='imageManagerListPath' value='<?php echo ($uejson["imageManagerListPath"]); ?>' class="form-control  rootpath" style="width:500px;"/></div><div class="col-md-2">			    			imageManagerListSize(个)：
			    		</div><div class="col-md-2"><input type='text' name='imageManagerListSize' value='<?php echo ($uejson["imageManagerListSize"]); ?>' class="form-control" style="width:100px;"/></div></div><div class="row" style="display: none;"><div class="col-md-2">			    			imageManagerAllowFiles：
			    		</div><div class="col-md-10"><input type='text' name='imageManagerAllowFiles' value="<?php echo (arrtostr($uejson["imageManagerAllowFiles"])); ?>" class="form-control" style="width:500px;"/></div></div></td></tr><tr style="display: none;"><td><h4 class="left" >列出指定目录下的文件</h4><div class="row" style="display: none;"><div class="col-md-2">			    			fileManagerListPath：
			    		</div><div class="col-md-6"><input type='text' name='fileManagerListPath' value='<?php echo ($uejson["fileManagerListPath"]); ?>' class="form-control  rootpath" style="width:500px;"/></div><div class="col-md-2">			    			fileManagerListSize(个)：
			    		</div><div class="col-md-2"><input type='text' name='fileManagerListSize' value='<?php echo ($uejson["fileManagerListSize"]); ?>' class="form-control" style="width:100px;"/></div></div><div class="row" style="display: none;"><div class="col-md-2">			    			fileManagerAllowFiles：
			    		</div><div class="col-md-10"><input type='text' name='fileManagerAllowFiles' value="<?php echo (arrtostr($uejson["fileManagerAllowFiles"])); ?>" class="form-control" style="width:500px;"/></div></div></td></tr></table></div><div class="panel-footer"  style="text-align: center;"><button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交配置</button></div></div></form></body></html>
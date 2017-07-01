<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<style>
.add-app{
	display: block;
	width:100px;
	height: 28px;
	line-height: 28px;
	text-align: center;
	background: #670768;
	color: #fff;
	border-radius: 4px;
}
.app{
	padding:10px;
	margin-top: 20px;
	border: 1px solid #f6f6f6;
	border-radius: 4px;
}

.app p{
	height: 30px;
	line-height: 30px;
}
.app p strong{
	font-size: 20px;
	color: #0b99d8;
}
.app dl{
	margin:10px 0;
	border:1px solid #dcdcdc;
	height: auto;
	overflow: hidden;
}
.app dl dt{
	display: block;
	height: 36px;
	line-height: 36px;
	background: #e6e6e6;
	text-indent: 10px;
}
.app dl dt strong{
	/*margin-left: 30px;*/
	font-size: 16px;
	color: #61aefa;
}
.app dl dd{
	/*margin-left: 60px;*/
	padding:10px;
	float: left;
}
</style>
<script type="text/javascript">
	
$(function(){

	$('input[level=1]').click(function(){
		var inputs = $(this).parents('.app').find('input');
		$(this).attr('checked')?inputs.attr('checked','checked'):inputs.removeAttr('checked');
	});
	$('input[level=2]').click(function(){
		var inputs = $(this).parents('dl').find('input');
		$(this).attr('checked')?inputs.attr('checked','checked'):inputs.removeAttr('checked');
	});

});

</script>
<head>
</head>
<body>
<form action="<?php echo U(GROUP_NAME.'/Rbac/access');?>" method="post">
<div class="panel panel-default">
	  <div class="panel-heading">配置权限</div>
	  <div class="panel-body">  
	    <div id='wrap'>
			<a href="<?php echo U(GROUP_NAME.'/Rbac/role');?>" class='btn btn-info'>返回</a>
			
			<?php if(is_array($node)): foreach($node as $key=>$app): ?><div class="app">
					<p><strong><?php echo ($app["title"]); ?></strong>
						<input type='checkbox' name='access[]' value='<?php echo ($app["id"]); ?>_1' level='1' <?php if($app["access"]): ?>checked='checked'<?php endif; ?> /> 
					</p>

					<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
							<dt>
								<strong><?php echo ($action["title"]); ?></strong>
								<input type='checkbox' name='access[]' value='<?php echo ($action["id"]); ?>_2' level='2' <?php if($action["access"]): ?>checked='checked'<?php endif; ?>/>
							</dt>

							<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd><span><?php echo ($method["title"]); ?></span>
								<input type='checkbox' name='access[]' value='<?php echo ($method["id"]); ?>_3' level='3' <?php if($method["access"]): ?>checked='checked'<?php endif; ?>/>
								</dd><?php endforeach; endif; ?>
						</dl><?php endforeach; endif; ?>
				</div><?php endforeach; endif; ?>
		</div><!--id wrap-->
	  </div>
	  <div class="panel-footer">
		<input type='hidden' name='rid' value='<?php echo ($rid); ?>' />
	  	<input type='submit'  value='保存配置' class="btn btn 4 btn-info"/>
	  </div>
</div>
</form>
</body>
</html>
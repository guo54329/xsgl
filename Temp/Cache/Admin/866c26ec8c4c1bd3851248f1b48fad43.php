<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style>
input{
	width:30px;
	height: 24px;
	font-weight: normal;
}
.app{
	padding:10px;
	margin-top: 20px;
	border: 1px solid #f6f6f6;
	border-radius: 4px;
}

.app p{
	height: 24px;
	line-height: 24px;
}
.app p strong{
	font-size: 16px;
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
	height: 30px;
	line-height: 30px;
	background: #e6e6e6;
	text-indent: 10px;
}
.app dl dt strong{
	/*margin-left: 30px;*/
	font-size: 14px;
	color: #61aefa;
}
.app dl dd{
	/*margin-left: 60px;*/
	padding:10px;
	float: left;
}
</style>
</head>
<body>
<form action='<?php echo U(GROUP_NAME.'/Rbac/sortNode');?>' method='post'>
<div class="panel panel-default">
	  <div class="panel-heading">节点列表</div>
	  <div class="panel-body">
			<a href="<?php echo U(GROUP_NAME.'/Rbac/addNode');?>"  class="btn btn4 btn-info">添加应用</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  	
			<?php if(is_array($node)): foreach($node as $key=>$app): ?><div class="app">
					<p><strong><?php echo ($app["title"]); ?></strong>
						[<a href="<?php echo U(GROUP_NAME.'/Rbac/editNode',array('id'=>$app['id']));?>">修改</a>|<a href="<?php echo U(GROUP_NAME.'/Rbac/delNode',array('id'=>$app['id']));?>">删除</a>]
						<input type='text' name='<?php echo ($app["id"]); ?>' value="<?php echo ($app["sort"]); ?>" style="text-align:center" />

						[<a href="<?php echo U(GROUP_NAME.'/Rbac/addNode',array('pid'=>$app['id'],'level'=>2));?>">添加控制器</a>]
					</p>

					<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
							<dt>
								<strong><?php echo ($action["title"]); ?></strong>
							[<a href="<?php echo U(GROUP_NAME.'/Rbac/editNode',array('id'=>$action['id']));?>">修改</a>|<a href="<?php echo U(GROUP_NAME.'/Rbac/delNode',array('id'=>$action['id']));?>">删除</a>]
							<input type='text' name='<?php echo ($action["id"]); ?>' value="<?php echo ($action["sort"]); ?>" style="text-align:center" />

							[<a href="<?php echo U(GROUP_NAME.'/Rbac/addNode',array('pid'=>$action['id'],'level'=>3));?>">添加动作方法</a>]
							</dt>

							<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd><span><?php echo ($method["title"]); ?></span>
										[<a href="<?php echo U(GROUP_NAME.'/Rbac/editNode',array('id'=>$method['id']));?>">修改</a>|<a href="<?php echo U(GROUP_NAME.'/Rbac/delNode',array('id'=>$method['id']));?>">删除</a>]
										<input type='text' name='<?php echo ($method["id"]); ?>' value="<?php echo ($method["sort"]); ?>" style="text-align:center" />
								</dd><?php endforeach; endif; ?>
						</dl><?php endforeach; endif; ?>
				</div><?php endforeach; endif; ?>
	  </div>
	   <div class="panel-footer">
	   	  <input type='submit'  value='更新排序' class="btn btn4 btn-info"/>
	   </div>
</div>
</form>
</body>
</html>
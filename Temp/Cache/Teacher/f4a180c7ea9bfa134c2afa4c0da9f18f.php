<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style type="text/css">
	tr{
		height: 40px;
	}
</style>
</head>
<body>
<div class="panel panel-default">
  <!-- Default panel contents -->
	  <div class="panel-heading"><?php echo ($wel); ?></div>
	  <div class="panel-body">
		  <div class="row">
		       <div class="col-md-6">
			        <table class="table table-bordered table-hover">
			        <caption>您的登录信息</caption>
					<tr><td>帐号</td><td><?php echo ($tea["jsno"]); ?></td></tr>
					<tr><td>姓名</td><td><?php echo ($tea["jsxm"]); ?></td></tr>
					<tr><td>处室</td><td><?php echo ($tea["offname"]); ?></td></tr>
					<tr><td>登录时间</td><td><?php echo (date('Y-m-d H:i:s',$tea["logintime"])); ?></td></tr>
					<tr><td>登录IP</td><td><?php echo ($tea["loginip"]); ?></td></tr>
			     	</table>
			    </div>
			    <div class="col-md-6">
				    <div style="margin-top:8px;margin-bottom: 7px;font-size: 16px;color: #777;">您的消息</div>
					<div style="position:absolute; height:201px; overflow-y:scroll;width:90%;" class="form-control">
					     <?php if(is_array($news)): foreach($news as $key=>$v): ?><strong style="text-align: center;"><?php echo ($v["title"]); ?> (<?php echo ($v["userxm"]); ?> <?php echo (date('m-d H:i:s',$v["pubtime"])); ?>)</strong><br/>
							<p><?php echo ($v["content"]); ?></p><hr/><?php endforeach; endif; ?>
					</div>
	        	</div>

	   </div>
       
</div>
</body>
</html>
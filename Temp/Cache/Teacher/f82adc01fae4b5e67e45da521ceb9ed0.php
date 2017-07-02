<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
	<script type="text/javascript">
		function myrefresh(){
			window.location.reload();
		}
	</script>
	<style type="text/css">
		tr{
			height: 40px;
		}
		.footeralign{
			text-align: left;
		}
	</style>
</head>
<body>
<div class="panel panel-default">
  <!-- Default panel contents -->
	  <div class="panel-heading">管理员发布的消息</div>
	  <div class="panel-footer footeralign">
         <button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;&nbsp;
	  </div>
	  <div class="panel-body">   
		   <table class="table table-bordered table-hover">
		   <tr style="text-align: center;font-weight: bold;"><td>序号</td><td align="left">标题</td><td align="left">内容</td><td>管理员</td><td>发布时间</td></tr>
			<!--<div style="position:absolute; height:100%; overflow-y:scroll; class="form-control">--><?php $i=1;?>
			     <?php if(is_array($news)): foreach($news as $key=>$v): ?><tr>
					<td align="center"><?php echo ($i++); ?></td>
					<td align="left"><?php echo ($v["title"]); ?></td>
					<td align="left"><?php echo ($v["content"]); ?></td>
					<td align="center"><?php echo ($v["userxm"]); ?></td>
					<td align="center"><?php echo (date('Y-m-d H:i:s',$v["pubtime"])); ?></td>
					</tr><?php endforeach; endif; ?>
			</table>
		</div>

</div>
</body>
</html>
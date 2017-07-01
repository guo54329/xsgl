<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
	<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
	<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/Js/selects.js"></script>
	<script type="text/javascript">
		function myrefresh(){
			window.location.reload();
		}
	</script>
	<style type="text/css">
		.footeralign{
			text-align: left;
		}
	</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading">消息列表</div>
	  <div class="panel-footer footeralign">
         <button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;&nbsp;
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
		   <thead>
			 <tr><th>序号</th><th>标题</th><th>接收班级</th><th>发布时间</th><th>操作</th></tr>
		   </thead>
		   <tbody>
		   	<?php $i=1;?>
			<?php if(is_array($info)): foreach($info as $key=>$v): ?><tr align='center'>
				<td><?php echo ($i++); ?></td>
				<td align='left'><?php echo ($v["title"]); ?></td>
				<td align='left'><?php echo ($v["cname"]); ?></td>
				
				<td align='left'><?php echo (date('Y-m-d H:i:s',$v["pubtime"])); ?></td>
			
				<td align='left'>
					<a href="<?php echo U(GROUP_NAME.'/News/detailNews',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> 查看</a>  
					<a href="<?php echo U(GROUP_NAME.'/News/delNews',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> 删除</a>
					
				</td>
				
			</tr><?php endforeach; endif; ?>
		   </tbody>
		</table>
	  </div>
	  <!--<div class="panel-footer"><a href="<?php echo U(GROUP_NAME.'/News/addNews');?>" class="btn btn-info">添加</a></div>-->
</div>

</body>
</html>
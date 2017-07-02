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
		.btnw{
			width: 90px;
		}
	</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading">消息列表</div>
	  <div class="panel-footer footeralign">
	  	<button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;&nbsp;
	     <a href="<?php echo U(GROUP_NAME.'/Home/addNews');?>" class="btn btn-info btnw" ><span class="glyphicon glyphicon-bullhorn"></span> 发布消息</a>
         
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
		   <thead>
			 <tr><th>序号</th><th>标题</th><th>接收对象</th><th>发布者</th><th>发布时间</th><th>操作</th></tr>
		   </thead>
		   <tbody>
		   	<?php $i=1;?>
			<?php if(is_array($info)): foreach($info as $key=>$v): ?><tr align='center'>
				<td><?php echo ($i++); ?></td>
				<td align='left'><?php echo ($v["title"]); ?></td>
				<td align='left'>
					<?php if($v['pubtype'] == 1): ?>所有教师和学生<?php endif; ?>
					<?php if($v['pubtype'] == 2): ?>所有教师<?php endif; ?>
					<?php if($v['pubtype'] == 3): ?>所有学生<?php endif; ?>
					<?php if($v['pubtype'] == 4): ?>班级:<?php echo ($v["cname"]); endif; ?>
				</td>
				<td align='left'><?php echo ($v["userxm"]); ?></td>
				
				<td align='left'><?php echo (date('Y-m-d H:i:s',$v["pubtime"])); ?></td>
				
				<td align='left'>
					<a href="<?php echo U(GROUP_NAME.'/Home/detailNews',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> 查看</a> <?php if($v['pubtype'] != 4): ?><a href="<?php echo U(GROUP_NAME.'/Home/editNews',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-edit" ></span> 编辑</a><?php endif; ?>

					<a href="<?php echo U(GROUP_NAME.'/Home/delNews',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>

				</td>
				
			</tr><?php endforeach; endif; ?>
		   </tbody>
		</table>
	  </div>
	  
</div>

</body>
</html>
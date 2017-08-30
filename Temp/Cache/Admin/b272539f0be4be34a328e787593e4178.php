<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style type="text/css">
	.headalign{
		text-align: left;
	}
	.title{
		font-weight: bold;
	}
</style>
</head>
<body>
<div class="panel panel-default">
	 <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 角色列表</a>
		<span style="float: right;">
	     	<a  href="<?php echo U(GROUP_NAME.'/Rbac/addRole');?>"  class="btn btn4 btn-info"><span class="glyphicon glyphicon-plus"></span> 添加角色</a>
	     </span>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr class="title"><td>序号</td><td>角色名称(英文)</td><td>角色描述(中文)</td><td>开启状态</td><td>操作</td></tr>
			<?php if(is_array($role)): foreach($role as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td><?php echo ($v["remark"]); ?></td>
				<td><?php if($v["status"]): ?>开启<?php else: ?>关闭<?php endif; ?></td>
				<td><a href="<?php echo U(GROUP_NAME.'/Rbac/access',array('rid'=>$v['id']));?>" class="btn btn-default btn4"><span class="glyphicon glyphicon-cog"></span> 配置权限</a> 
					<a href="<?php echo U(GROUP_NAME.'/Rbac/editRole',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> 修改</a>
					<a href="<?php echo U(GROUP_NAME.'/Rbac/delRole',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>
				   
				</td>
			</tr><?php endforeach; endif; ?>
		</table>	
	  </div>
	  
</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<style>
	.footeralign{
		text-align: left;
	}
	input{
		width:100px;
	}

</style>

</head>
<body>
<div class="panel panel-default">
	  <div class="panel-heading">用户列表</div>
	  <div class="panel-footer footeralign">
	  	<a href="<?php echo U(GROUP_NAME.'/Rbac/addUser');?>"  class="btn btn4 btn-info"><span  class="glyphicon glyphicon-plus"></span> 添加用户</a>
	   </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>用户名</td><td>上次登录时间</td><td>上次登录IP</td><td>当前状态</td><td>角色</td><td>操作</td></tr>
			<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["username"]); ?></td>
				<td><?php echo (date('Y-m-d H:i:s',$v["logintime"])); ?></td>
				<td><?php echo ($v["loginip"]); ?></td>
				<td><?php if($v["lock"]): ?><span class="glyphicon glyphicon-ban-circle"></span> 锁定<?php else: ?><span class="glyphicon glyphicon-ok-circle"></span> 正常<?php endif; ?></td>
				<td>
					<?php if($v["username"] == C("RBAC_SUPERADMIN")): ?>超级管理员
					<?php else: ?>
						<?php if(is_array($v["role"])): foreach($v["role"] as $key=>$value): ?><div><?php echo ($value["name"]); ?>(<?php echo ($value["remark"]); ?>)</div><?php endforeach; endif; endif; ?>
				</td>
				<td> 
					<?php if($v['id'] != 1): ?><a href="<?php echo U(GROUP_NAME.'/Rbac/editUser',array('id'=>$v['id']));?>" class="btn btn-default btn4"><span class="glyphicon glyphicon-cog"></span> 配置角色</a>
					 <?php if($v["lock"]): ?><a href="<?php echo U(GROUP_NAME.'/Rbac/lock',array('id'=>$v['id'],'lock'=>1));?>" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span> 解锁</a>
					<?php else: ?><a href="<?php echo U(GROUP_NAME.'/Rbac/lock',array('id'=>$v['id'],'lock'=>0));?>" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span> 锁定</a><?php endif; ?>
					<a href="<?php echo U(GROUP_NAME.'/Rbac/delUser',array('id'=>$v['id']));?>" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php endif; ?> 
				</td>
			</tr><?php endforeach; endif; ?>
		</table>	
	  </div>
	   
</div>
</body>
</html>
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
	tr{
		text-align: left;
	}
	.btn6{
		width: 140px;
		height: 34px;
	}
	.pos{
		display: inline-block;
		margin-left: 20px;
		padding-top:5px;
		padding-bottom:5px;
	}
</style>
</head>
<body>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 系统全局设置</a>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>	
			<tr><td><h3>请管理员在系统部署好之后</h3></td></tr>
			<tr>
				<td>
				<h3>系统权限管理</h3>
				    <span class="pos">
				    	<a href="<?php echo U(GROUP_NAME.'/System/resetUSER');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 用户数据删除</a>   <span class="glyphicon glyphicon-info-sign"></span>  保留admin,同时删除已分配的角色
				    </span>
				     <span class="pos">
			        	<a href="<?php echo U(GROUP_NAME.'/System/resetROLE');?>" class="btn btn-info btn6" ><span class="glyphicon glyphicon-retweet"></span> 角色数据清空</a>   <span class="glyphicon glyphicon-info-sign"></span>  同时删除已分配的权限
			        </span>
			         <span class="pos">
			       		 <a href="<?php echo U(GROUP_NAME.'/System/resetNODE');?>" class="btn btn-info btn6" ><span class="glyphicon glyphicon-retweet"></span> 节点数据清空</a>  <span class="glyphicon glyphicon-info-sign"></span> 此操作仅为开发者admin使用!
			       	</span>
				</td>
			</tr>
			<tr>
			    <td>
			    <h3>系统消息管理</h3>
			     	<span class="pos">
			        	<a href="<?php echo U(GROUP_NAME.'/System/resetNEWS');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 消息数据清空</a>   <span class="glyphicon glyphicon-info-sign"></span> 删除管理员和教师发布的消息
			        </span>
			    </td>
			</tr>
			<tr>
			    <td>
			    <h3>基础数据管理</h3>
			    	<span class="pos">
			        	<a href="<?php echo U(GROUP_NAME.'/System/resetTER');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 学期数据清空</a>
			        </span>
			        <span class="pos">
						<a href="<?php echo U(GROUP_NAME.'/System/resetPRO');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 专业数据清空</a>
					</span>
					<span class="pos">
						<a href="<?php echo U(GROUP_NAME.'/System/resetOFF');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 处室数据清空</a>
					</span>
					<span class="pos">
						<a href="<?php echo U(GROUP_NAME.'/System/resetCOU');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 课程数据清空</a>
					</span>
					<span class="pos">
						<a href="<?php echo U(GROUP_NAME.'/System/resetTEA');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 教师数据清空</a>
					</span>
					<span class="pos">
						<a href="<?php echo U(GROUP_NAME.'/System/resetCLA');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 班级数据清空</a>
					</span>
					<span class="pos">
						<a href="<?php echo U(GROUP_NAME.'/System/resetSTU');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 学生数据清空</a>
					</span>
			    </td>
			</tr>
			<tr>
			    <td>
			    <h3>实训任务管理</h3>
			    	<span class="pos">
			        	<a href="<?php echo U(GROUP_NAME.'/System/resetSX');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 实训任务清空</a> <span class="glyphicon glyphicon-info-sign"></span>
			        注意：此操作会删除时序任务管理下的所有数据库保存的数据，之后请手动删除系统Public/Excise/下的所有文件及文件夹！
			        <span class="pos">
			    </td>
			</tr>
           
		</table>	
	  </div>
</div>
</body>
</html>
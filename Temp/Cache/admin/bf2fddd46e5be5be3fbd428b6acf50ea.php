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
	td{
		text-align: left;
		margin-top: -10px;
	}
	.btn6{
		width: 120px;
		height: 34px;
	}
	.pos{
		display: inline-block;
		margin-left: 20px;
		margin-top: -2px;
		padding-top:5px;
		padding-bottom:5px;
	}
</style>
</head>
<body>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 系统部署设置</a>
	  </div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>	
			
			<tr>
			    <td>
			    <h3>系统缓存管理</h3>
			     	<span class="pos">
			        	<a href="<?php echo U(GROUP_NAME.'/System/resetTEMP');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 缓存数据清空</a>   <span class="glyphicon glyphicon-info-sign"></span> 删除系统运行当中产生的临时文件(<b>建议定期清理</b>)
			        </span>
			    </td>
			</tr>
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
			       		 <!-- <a href="<?php echo U(GROUP_NAME.'/System/resetNODE');?>" class="btn btn-info btn6" > --><span class="glyphicon glyphicon-retweet"></span> 节点数据清空<!-- </a> -->  <span class="glyphicon glyphicon-info-sign"></span> 此操作仅为<b>开发者admin</b>使用!
			       	</span>
				</td>
			</tr>
			<tr>
			    <td>
			    <h3>系统消息管理</h3>
			     	<span class="pos">
			        	<a href="<?php echo U(GROUP_NAME.'/System/resetNEWS');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 消息数据清空</a>   <span class="glyphicon glyphicon-info-sign"></span> 删除管理员和教师发布的消息
			        </span>
			        <span class="pos">
			        	<a href="<?php echo U(GROUP_NAME.'/System/resetsurvey');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 调查数据清空</a>   <span class="glyphicon glyphicon-info-sign"></span> 满意度调查,删除数据库记录和使用UE上传的所有文件(含发布消息时上传的文件)
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
			        <span class="pos">
			        	<a href="<?php echo U(GROUP_NAME.'/System/resetUPFILE');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 任务文件删除</a> <span class="glyphicon glyphicon-info-sign"></span>
			        注意：此操作会删除实训任务管理中所有老师发布的任务附件和学生作业！
			        <span class="pos">
			    </td>
			</tr>
           
		</table>	
	  </div>
</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/selects.js"></script>
<script src="__PUBLIC__/Js/dialog/layer.js"></script>
<script src="__PUBLIC__/Js/dialog.js"></script>
<script type="text/javascript">
function myrefresh(){
	window.location.reload();
}
</script>
<style type="text/css">

	th{
		text-align:center;
	}
	.browse{
		width: 110px;
		height:35px;
		line-height: 24px;
		font-size: 16px;
	}
	.notice{
		position: fixed;
		display: inline-block;
		right: 100px;
		float: right;

	}
	.headalign{
		text-align: left;
	}
	.btncoursetable{
		width:100px;
		text-align: left;
	}
	.form-inline{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 16px;
		
		height:40px;
		line-height:40px;
	 }
</style>
</head>

<body>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的任务</a>
		<span class="notice">
				<button class="btn btn-info browse" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新列表</button>
			 	<a href="<?php echo U(GROUP_NAME.'/Index/sysNews');?>" class="btn btn-success browse" ><span class="glyphicon glyphicon-bullhorn"></span> 查看消息</a>
		</span>		
	  </div>
	  <div class="form-inline">
    	<form action='<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList');?>' method="post">
			<select name="term" class="form-control"></select>
		<select name="coursename" class="form-control"></select>
		<!-- js的使用 start-->
		 <script type="text/javascript" src="__PUBLIC__/Js/termCourse.js"></script>
		 <script type="text/javascript">

			var s = selects;
			//获取对象
			var a = document.getElementsByName('term')[0];
			var b = document.getElementsByName('coursename')[0];
			//绑定数据
			s.bind(a,xq);//xq和kc来自js文件的变量
			s.bind(b,kc);//a和b来自本页面的属性
			
			//确定从属关系
			s.parent(a,b);
		 </script>
		 <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>

		</form>
	</div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><th>学期</th><th>课程</th><th>序号</th><th>任务标题</th><th>发布教师</th><th>发布时间</th><th>完成状态</th><th>实训成绩</th><th>操作</th></tr>
			<?php $i=1;?>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
				<td><?php echo ($v["term"]); ?></td>
				<td><?php echo ($v["coursename"]); ?></td>
				<td><?php echo ($i); $v.peid;?></td>
				<td align="left"><a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDesc',array('seid'=>$v['seid']));?>"><?php echo ($v["title"]); ?></a></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo (date('m-d H:i',$v["pubtime"])); ?></td>

				<td><?php if($v['status'] == 0 ): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDesc',array('seid'=>$v['seid']));?>" class="btn"><span class="glyphicon glyphicon-hand-right"></span> 去完成</a> <?php else: ?>已完成<?php endif; ?></td>
				<td><?php echo $v['desc']*0.3+$v['isrec']*0.7; ?></td>
			
				<td><?php if($v['status'] == 0 ): ?>无<?php else: ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxexciseDiscuss',array('peid'=>$v['peid']));?>" class="btn btn-default browse" ><span class="glyphicon glyphicon-eye-open"></span> 交流讨论</a><?php endif; ?></td>
				
			</tr>
			<?php $i++; endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
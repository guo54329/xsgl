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
    .btnw{
        width: 90px;
        
    }
	.footeralign{
		text-align: left;
	}
	.bpx{
		margin-bottom: 10px;
		display: inline-block;
	}
</style>
</head>

<body>
<div class="panel panel-default">
	  <div class="panel-heading">教师课程表 </div>
	  <div class="panel-footer footeralign">
		<div class="form-inline">
			<form action='<?php echo U(GROUP_NAME.'/Excise/courseTable');?>' method="post">
             <span class="bpx">
			 <button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;&nbsp;

			<a href="<?php echo U(GROUP_NAME.'/Excise/coursetableSave');?>" class="btn btn-info btnw"><span class="glyphicon glyphicon-plus"></span> 添加课程</a>&nbsp;&nbsp;<span>提示：请选择其中一种方式，然后单击查询！</span>
			</span>
			<br/>
	  		方式一：
  			<select name="term1" class="form-control" style="width: 250px;"></select>
			<select name="coursename" class="form-control" style="width: 250px;"></select>
			<!-- js的使用 start-->
			 <script type="text/javascript" src="__PUBLIC__/Js/termCourse.js"></script>
			 <script type="text/javascript">

				var s = selects;
				//获取对象
				var a = document.getElementsByName('term1')[0];
				var b = document.getElementsByName('coursename')[0];
				//绑定数据
				s.bind(a,xq);//xq和kc来自js文件的变量
				s.bind(b,kc);//a和b来自本页面的属性
				
				//确定从属关系
				s.parent(a,b);
			 </script>
			<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
			&nbsp;&nbsp;<br/>
	  		方式二：
  			<select name="term2" class="form-control" style="width: 250px;"></select>
			<select name="js" class="form-control" style="width: 250px;"></select>
			<!-- js的使用 start-->
			 <script type="text/javascript" src="__PUBLIC__/Js/termTeacher.js"></script>
			 <script type="text/javascript">

				var s = selects;
				//获取对象
				var a = document.getElementsByName('term2')[0];
				var b = document.getElementsByName('js')[0];
				//绑定数据
				s.bind(a,xq);//xq和kc来自js文件的变量
				s.bind(b,js);//a和b来自本页面的属性
				
				//确定从属关系
				s.parent(a,b);
			 </script>
			<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
			</form>
			</div>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>ID</td><td>学期</td><td>任课教师</td><td>班级</td><td>课程</td><td>任务数量</td><td>操作(如需删除，请先进入任务列表删除任务)</td></tr>
			<?php if(is_array($coursetable)): foreach($coursetable as $key=>$v): ?><tr>
				<td><?php echo ($v["scid"]); ?></td>
				<td><?php echo ($v["term"]); ?></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["cname"]); ?></td>
				<td><?php echo ($v["coursename"]); ?></td>
				<td><?php $scid = $v['scid']; $pubnum = M('sxpubexcise')->where("scid=$scid")->count(); echo $pubnum; ?>
    			</td>
				<td align="left">　
				   <a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$v['scid']));?>" class="btn btn-default btnw" title="查看指定教师发布的指定课程的任务列表！"><span class="glyphicon glyphicon-eye-open"></span> 任务列表</a>&nbsp;
					
					<?php if( $pubnum != 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxcoursePackage',array('scid'=>$v['scid']));?>" class="btn btn-default btnw" title="将该课程所有任务和学生作业打包下载！"><span class="glyphicon glyphicon-save"></span> 资料存档</a>&nbsp;<?php endif; ?>
					
					<?php if($pubnum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/delcourseTable',array('id'=>$v['scid']));?>" class="btn btn-default" title="如果没有任务可以直接删除，否则需要删尽其下的任务再进行删除！"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
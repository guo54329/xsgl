<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
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

</style>
</head>

<body>
<div class="panel panel-default">
	  <div class="panel-heading">我的课程表</div>
	  <div class="panel-footer footeralign">

	   <div class="form-inline"> 
            <form action="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" method="post">

            <button class="btn btn-info" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>&nbsp;&nbsp;&nbsp;&nbsp;

            <a href="<?php echo U(GROUP_NAME.'/Excise/coursetableSave');?>" class="btn btn-info btnw"><span class="glyphicon glyphicon-plus"></span> 添加课程</a>&nbsp;&nbsp;&nbsp;&nbsp;
  			<select name='term' class="form-control">
				<option value="0">选择学期查看...</option>
				<?php if(is_array($term)): foreach($term as $key=>$v): ?><option value="<?php echo ($v["term"]); ?>"><?php echo ($v["term"]); ?></option><?php endforeach; endif; ?>
			</select>
			<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
			</form>
        </div>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>学期</td><td>课程</td><td>任务数量</td><td>班级</td><td>班主任</td><td>联系电话</td><td>操作</td></tr>
			<?php $i=1;?>
			<?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
				<td><?php echo ($i); $v.scid;?></td>
				<td><?php echo ($v["term"]); ?></td>
				<td><?php echo ($v["coursename"]); ?></td>
				<td><?php $ccode = $v['ccode']; $scid = $v['scid']; $pubnum = M('sxpubexcise')->where("scid=$scid")->count(); echo $pubnum; ?>
    			</td>
				<td><?php echo ($v["cname"]); ?></td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["jsdh"]); ?></td>
				<td align="left">　
					<a href="<?php echo U(GROUP_NAME.'/Excise/coursenewsSave',array('ccode'=>$ccode));?>" class="btn btn-default btnw" ><span class="glyphicon glyphicon-bullhorn"></span> 发布消息</a>&nbsp;
				  
				   <a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$v['scid']));?>" class="btn btn-default btnw" ><span class="glyphicon glyphicon-eye-open"></span> 任务列表</a>&nbsp;

					<?php if( $pubnum != 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxcoursePackage',array('scid'=>$v['scid']));?>" class="btn btn-default btnw" title="将该课程所有任务和学生作业打包下载！"><span class="glyphicon glyphicon-save"></span> 资料存档</a><?php endif; ?>&nbsp;
					<?php if( $pubnum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Excise/delcourseTable',array('id'=>$v['scid']));?>" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php endif; ?>
				</td>
			</tr>
			<?php $i++; endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
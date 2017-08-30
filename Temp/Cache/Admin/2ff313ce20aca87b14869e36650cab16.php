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
	.btncoursetable{
		width:90px;
		text-align: left;
	}	
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
	.form-inline{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 16px;
		
		height:40px;
		line-height:40px;
	 }
	 .btn6{
 		width: 120px;
 	}
</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 班级维护</a>
		<a href="<?php echo U(GROUP_NAME.'/Basicdata/resetCLA');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 清除演示数据</a>(注意：请在系统部署好使用之前使用该功能！)
		<span style="float: right;">
	     	<a  href="<?php echo U(GROUP_NAME.'/Basicdata/saveClasses');?>"  class="btn btn4 btn-info"><span class="glyphicon glyphicon-plus"></span> 添加班级</a>
	     	<a href="<?php echo U(GROUP_NAME.'/Basicdata/importClasses');?>" class="btn btn4 btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 批量导入</a>
	     	<div style="display: none;">如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</div>
	     </span>
	  </div>
	  <div class="form-inline">
	      <form action="<?php echo U(GROUP_NAME.'/Basicdata/classes');?>" method="post">
		      <select name="zjsj" class="form-control">
		         <option value=''>请选择组建时间</option>
		      	 <?php if(is_array($zjsjs)): foreach($zjsjs as $key=>$v): ?><option value="<?php echo ($v["zjsj"]); ?>"><?php echo ($v["zjsj"]); ?></option><?php endforeach; endif; ?>
		      </select>
		      <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
		  </form>
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>班级编码</td><td>班级名称</td><td>班级人数</td><td>班主任</td><td>班主任电话</td><td>组建时间</td><td>所属专业</td><td>操作</td></tr>
			<?php if(is_array($classes)): foreach($classes as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["ccode"]); ?></td>
				<td><?php echo ($v["cname"]); ?></td>
				<td>
				<?php $ccode=$v['ccode']; $stunum=M('student')->where("ccode='$ccode'")->count(); echo $stunum; ?>
					
				</td>
				<td><?php echo ($v["jsxm"]); ?></td>
				<td><?php echo ($v["jsdh"]); ?></td>
				<td><?php echo ($v["zjsj"]); ?></td>
				<td><?php echo ($v["proname"]); ?></td>
				<td>
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveClasses',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<?php if($stunum == 0): ?><a href="<?php echo U(GROUP_NAME.'/Basicdata/delClasses',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a><?php else: ?><a href="#"  class="btn btn-default"><span class="glyphicon glyphicon-ban-circle"></span> 有人</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
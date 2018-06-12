<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>

<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/jquery-latest.js"></script>
<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/addons/pager/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/docs/js/chili-1.8b.js"></script>
<script type="text/javascript" src="__ROOT__/Data/jquerytablesorter/docs/js/docs.js"></script>
<script type="text/javascript">
$(function() {
	$("table")
		.tablesorter({widthFixed: true, widgets: ['zebra']})
		.tablesorterPager({container: $("#pager")});
});
</script>


<script type="text/javascript">
function resetpass(obj){
     var studentid = obj.id;
     $.ajax({
            url:"<?php echo U(GROUP_NAME.'/Basicdata/resetStudentPass');?>",
            data: { id: studentid },
            type:"POST",
            success: function (res) {
            	if(res==1){
            		alert('该学生登录密码已重置为123456，请及时提醒修改！');
            	}else{
            		alert('该生可能还在使用处室密码，重置失败！');
            	}
                
            }
    });    
}
</script>
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

	 /*排序*/
	 
	 table.tablesorter thead tr .header {
		background-image: url("__ROOT__/Data/jquerytablesorter/themes/blue/bg.gif");
		background-repeat: no-repeat;
		background-position: center right;
		cursor: pointer;
	}
	table.tablesorter thead tr .headerSortUp {
		background-image: url(__ROOT__/Data/jquerytablesorter/themes/blue/asc.gif);
	}
	table.tablesorter thead tr .headerSortDown {
		background-image: url(__ROOT__/Data/jquerytablesorter/themes/blue/desc.gif);
	}
</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 学生维护</a>
		<span style="float: right;">
	     	<a  href="<?php echo U(GROUP_NAME.'/Basicdata/saveStudent');?>"  class="btn btn4 btn-info"><span class="glyphicon glyphicon-plus"></span> 添加学生</a>
	     	<a href="<?php echo U(GROUP_NAME.'/Basicdata/importStudent');?>" class="btn btn4 btn-info"><span class="glyphicon glyphicoglyphicon glyphicon-plus-sign"></span> 批量导入</a>
	     	<div style="display: none;">如想导出，请直接选择复制下表中的数据粘贴到Excel表中即可！</div>
	     </span>
	  </div>
	  <div class="form-inline">
	     <form action="<?php echo U(GROUP_NAME.'/Basicdata/student');?>" method="post">
	       <select name="ccode" class="form-control">
			  <option value=''>请选择班级</option>
			  <?php if(is_array($ccodes)): foreach($ccodes as $key=>$v): ?><option value="<?php echo ($v["ccode"]); ?>"><?php echo ($v["cname"]); ?></option><?php endforeach; endif; ?>
			</select>
			<input type="text" name="stu" class="form-control" placeholder="清输入学号或姓名">
			<button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
		</form>
	  </div>
	  <div class="panel-body">
		 <table class="table table-bordered table-hover tablesorter">
		   <thead>
			<tr><th style="text-align: center;" width="6%">序号</th><th style="text-align: center;">学号</th><th style="text-align: center;">姓名</th><th style="text-align: center;" width="6%">性别</th><th style="text-align: center;">入学时间</th><th style="text-align: center;">所在班级</th><td style="text-align: center;font-weight: bold;">操作</td></tr></thead>
			<tbody>
			<?php $i=1;?>
			<?php if(is_array($student)): foreach($student as $key=>$v): ?><tr>
				<td><?php echo ($i); ?></td>
				<td><?php echo ($v["xsno"]); ?></td>
				<td><?php echo ($v["xsxm"]); ?></td>
				<td><?php echo ($v["xsxb"]); ?></td>
				<td><?php echo ($v["rxsj"]); ?></td>
				<td><?php echo ($v["cname"]); ?></td>
				<td>
					<button  class="btn btn-danger btn4" id="<?php echo ($v["id"]); ?>" onclick="resetpass(this)"><span class="glyphicon glyphicon-asterisk"></span> 重置密码</button>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveStudent',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp;
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/delStudent',array('id'=>$v['id']));?>"  class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> 删除</a>
				</td>
			</tr>
			<?php $i++; endforeach; endif; ?>
			</tbody>
		</table>
		<div id="pager" class="pager">
			<form>
			    <span class="label label-default" style="display:inline-block;height: 26px;line-height: 20px;">当前学生人数 <?php echo ($num); ?></span>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/first.png" class="first"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/prev.png" class="prev"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/next.png" class="next"/>
				<img src="__ROOT__/Data/jquerytablesorter/addons/pager/icons/last.png" class="last"/>
				<input type="text" class="pagedisplay" style="width: 50px;height: 26px;border-radius:4px;text-align: center;" />
				<select class="pagesize" style="width: 50px;height: 26px;line-height:18px;border-radius:4px;text-align: center;">
					<option selected="selected"  value="10">10</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option  value="50">50</option>
					<option  value="60">60</option>
					<option  value="100">100</option>
					<option  value="200">200</option>
				</select>
			</form>
		</div>
		
	  </div>
	  
</div>
</body>
</html>
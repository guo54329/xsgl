<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script src="__PUBLIC__/Js/dialog/layer.js"></script>
<script src="__PUBLIC__/Js/dialog.js"></script>
<script type="text/javascript">
function del(id){
	var termid = id;
	var url = "<?php echo U(GROUP_NAME.'/Basicdata/delTerm');?>";
	var data = {'id':termid};
        // 执行异步请求  $.post
        $.post(url,data,function(result){
        	
            if(result.status == 0) {
                return dialog.error(result.message);
            }
            if(result.status == 1) {
                return dialog.success(result.message, "<?php echo U(GROUP_NAME.'/Basicdata/term');?>");
            }

        },'JSON');
       
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
.btn6{
	width: 120px;
}
</style>
</head>
<body>

<div class="panel panel-default">
	  
	<div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 学期维护</a>
		<a href="<?php echo U(GROUP_NAME.'/Basicdata/resetTER');?>" class="btn btn-info btn6"><span class="glyphicon glyphicon-retweet"></span> 清除演示数据</a>(注意：请在系统部署好使用之前使用该功能！)
		<span style="float: right;">
	  <a  href="<?php echo U(GROUP_NAME.'/Basicdata/saveTerm');?>"  class="btn btn4 btn-info"><span class="glyphicon glyphicon-plus"></span> 添加学期</a>
	  </span>
	 </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
			<tr><td>序号</td><td>学期</td><td>操作</td></tr>
			<?php if(is_array($term)): foreach($term as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["name"]); ?></td>
				<td>
					<a href="<?php echo U(GROUP_NAME.'/Basicdata/saveTerm',array('id'=>$v['id']));?>" class="btn btn-default" ><span class="glyphicon glyphicon-pencil"></span> 修改</a>&nbsp; 
					<!--<a href="<?php echo U(GROUP_NAME.'/Basicdata/delTerm',array('id'=>$v['id']));?>">-->
					<button class="btn btn-default" onclick="del(<?php echo ($v["id"]); ?>);" ><span class="glyphicon glyphicon-remove"></span> 删除</button>

					<!--</a>-->
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
	  </div>
	  
</div>
</body>
</html>
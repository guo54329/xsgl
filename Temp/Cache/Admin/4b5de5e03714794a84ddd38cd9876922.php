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
$(function(){
	$("#btn").click(function(){
		var id = $("#id").val();
		var name = $("#name").val();

		var url = "<?php echo U(GROUP_NAME.'/Basicdata/saveTermH');?>";
        var data = {'id':id,'name':name};
        // 执行异步请求  $.post
        $.post(url,data,function(result){
        	//alert(result.info);
            if(result.status == 0) {
                return dialog.error(result.message);
            }
            if(result.status == 1) {
                return dialog.success(result.message, "<?php echo U(GROUP_NAME.'/Basicdata/term');?>");
            }

        },'JSON');

	});
});
</script>
</head>
<body>
<!--<form action='<?php echo U(GROUP_NAME.'/Basicdata/saveTermH');?>' method='post'>-->
<div class="panel panel-default">
	  <div class="panel-heading"><?php echo ($term["op"]); ?></div>
	  <div class="panel-body">
		<table class='table table-bordered table-hover'>
			<tr>
				<td>学期</td>
				<td><input type='text' name='name' value="<?php echo ($term["name"]); ?>" class="form-control" id="name"/></td>
			</tr>
		</table>	
	  </div>
	  <div class="panel-footer">
        <input type='hidden'  name="id" value="<?php echo ($term["id"]); ?>" id="id"/>
	  	<button type='button' class="btn btn-info" id="btn"><span class="glyphicon glyphicon-check"></span> 提交</button>
	  </div>
</div>
<!--</form>-->
</body>
</html>
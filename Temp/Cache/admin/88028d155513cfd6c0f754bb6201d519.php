<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />

<style type="text/css">
	.tip{
		text-align:left
	}
    p{
    	line-height: 30px;
    }
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
</style>
</head>

<body>
<form action="<?php echo U(GROUP_NAME.'/Basicdata/importTeacher');?>" method="post">
<div class="panel panel-default">
	  <div class="panel-heading headalign">
	   <a href="<?php echo U(GROUP_NAME.'/Basicdata/teacher');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 教师维护</a><span class="btn xiexian">/</span><a  class="btn btn4">导入教师</a>
	</div>
	  <div class="panel-body">
		<table class="table table-bordered">
			<tr>
				<td class="tip" width="45%">
					<span class="glyphicon glyphicon-info-sign"></span> 导入提示<br/>
					<p></p>
					<p><strong>说明：</strong><br/>1、请下载输入数据的Excel模板：<a href="__PUBLIC__/xlsx/tea.xlsx">下载</a> <br/>(请使用"右键另存为"方式下载,模板文件需要Excel2007及其以上版本打开.)<br/>
					2、"所在处室名称"请参考"处室数据维护"列表</p>
				   <P><strong>导入步骤：</strong><br/>
				   第一步：请按照"序号、用户名、姓名、性别、联系电话、所在处室"的次序在Excel表中录入数据.<br/>
				   第二步：<b>从第三行开始</b>将Excel模板中的数据复制到右侧的文本框中.（第一行为标题行，第二行示例行，这两行数据不复制）</p>
				</td>
				<td width="55%">
				   <div style="text-align: left;">请根据“导入提示”执行导入操作：</div>
					<textarea class="form-control textarea" rows="20" name="teachers" id="teachers"></textarea><br/>
					<button type='submit' class="btn btn-info"><span class="glyphicon glyphicon-check"></span> 提交</button>
				</td>
			</tr>
	   </table>	
	  </div>
	  <!--<div class="panel-footer"></div>-->
</div>
</form>
</body>

</html>
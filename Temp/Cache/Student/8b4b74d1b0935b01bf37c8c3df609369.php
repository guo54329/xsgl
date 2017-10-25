<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>

<link rel="stylesheet" href="__ROOT__/Data/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="__ROOT__/Data/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="__ROOT__/Data/kindeditor/lang/zh_CN.js"></script>

<style type="text/css">
	.footeralign,.desc{
		text-align:left;
	}
	.count{
		color: red;
		display: inline-block;
		padding-top:0px;
		padding-bottom: 0px;
		padding-left: 4px;
		padding-right: 4px;
		height: 22px;
		border-radius: 4px;
		text-align: center;
		border:1px solid green;
		font-weight: bold;
	}

	.send{
		font-size: 12px;
		padding-top:0px;
		padding-bottom: 0px;
		height: 25px;
		line-height: 25px;
		width: 40px;
	}
	.form-inline{
		font-size: 13px;
	}
	.self{
		color: green;
	}
	.bold{
		font-weight: bold;
	}
	.file{
		display:inline-block;
		width: 100px;
		margin-left: 6px; 
	}
	
    .ke-container{
    	display: none;
    }
    #send{display: none;}
    .headalign{
		text-align: left;
	}
    .btncoursetable{
		width:90px;
		text-align: left;
	}
	.browse{
		width: 90px;
	}
	.xiexian{
	    width:20px;
		margin-left:-5px;margin-right:-5px;
	}
	.fresh{
		right:20;
		bottom: 50;
		position: fixed;
	}
</style>

<script type="text/javascript">
function hf(obj){
	var pdeid = obj.id;
	var user = $("#u"+pdeid).html();
	$("#pdeid").val(pdeid);
    $("#content").attr("placeholder","@"+user);
    $("#atuser").val($("#content").attr("placeholder"));
    $("ke-content").html($("#content").attr("placeholder"));
    $(".ke-container").css('display','block');
	$("#send").css('display','block');
}

function myrefresh(){
	window.location.reload();
}

function show(){
	if($(".ke-container").css('display')=='none'){
		$(".ke-container").css('display','block');
	    $("#send").css('display','block');
	}else{
		$(".ke-container").css('display','none');
	    $("#send").css('display','none');
	}
	
}
</script>

<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			resizeType : 1,
			width:"90%",
			height:"80px",
			allowPreviewEmoticons : false,
			items : ['bold', 'italic', 'underline','removeformat', '|', 'emoticons']
		});
	});
</script>
</head>

<body>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 我的任务</a><span class="btn xiexian">/</span><a  class="btn btn4">交流讨论</a>	
	  </div>
	  <div class="panel-body">
		 <table class='table table-bordered table-hover'>
		    <tr class="desc">
		    <td>
		    学期：<?php echo ($courseinfo["term"]); ?>&nbsp;&nbsp;
		    班级：<?php echo ($classes["cname"]); ?>&nbsp;&nbsp;
		    课程：<?php echo ($courseinfo["coursename"]); ?>
		    <br/>
		    <strong>任务标题：</strong><?php echo ($excisedesc["title"]); ?><br/><strong>发布时间：</strong><?php echo (date('Y-m-d H:i:s',$excisedesc["pubtime"])); ?>
		    <br/>
		    <strong>作业列表:</strong> <span class="label label-default">当前共有 <?php echo ($count); ?> 份作业</span>，请下载学习后进行交流评价！
		    </td>
		    </tr>
			<tr><td class="desc">
			<?php $i=1;?>
			<?php if(is_array($exciselist)): foreach($exciselist as $key=>$v): ?><span>
					<?php if($excisedesc['isrec'] == 0): echo ($i); ?>-<?php echo ($v["xsxm"]); ?>(禁止下载)
					<?php else: ?>
						<a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDownAttach',array('seid'=>$v['seid']));?>" class="btn btn-default file"><span class="glyphicon glyphicon-save"></span> <?php echo ($i); ?>-<?php echo ($v["xsxm"]); ?></a><?php endif; ?>
				</span>
				<?php $i++; endforeach; endif; ?>
			</td></tr>
		</table>
	  </div>

	<div class="panel-footer footeralign">
	     <table id="table" class='table table-bordered table-hover'>
	       <caption><strong>讨论评价区</strong>&nbsp;
			<button class="btn btn-default btnw" onclick="myrefresh()"><span class="glyphicon glyphicon-repeat"></span> 刷新</button>&nbsp; 
			<button class="btn btn-default" onclick="show();"><span class="glyphicon glyphicon-edit"></span> 评论</button>
			<span class="label label-default" style="display:inline-block;height: 25px;line-height: 20px;">当前评论条数 <?php echo ($num); ?></span>
	       </caption>
		   <?php if(is_array($discuss)): foreach($discuss as $key=>$v): ?><tr>
				<td class="desc">
	                <div class="form-inline">
						<span><?php echo ($v["html"]); ?></span>
						<span id="u<?php echo ($v["deid"]); ?>" <?php if($v['userxm'] == $userxm): ?>class="self bold"<?php else: ?>class="bold"<?php endif; ?>>[<?php echo ($v["usertype"]); ?>]<?php echo ($v["userxm"]); ?> </span>
						
						<?php if($v['atuser'] != ''): ?><span class="bold"><?php echo ($v["atuser"]); ?></span><?php endif; ?>
						
						<span>: <?php echo ($v["content"]); ?></span>
						<span>&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo (date('m/d H:i:s',$v["distime"])); ?>)</span>&nbsp;
						<button class="btn btn-default send" onclick="hf(this)" id="<?php echo ($v["deid"]); ?>">回复</button>
					</div>
				</td>
		        </tr><?php endforeach; endif; ?>

		</table>

		<form action="<?php echo U(GROUP_NAME.'/Excise/sxexciseDiscussSave');?>" method="post">
			<div class="form-inline">
			   <textarea id="content" name="content" placeholder=""></textarea>
			   <input type="hidden" id="peid" name="peid" value="<?php echo ($peid); ?>">
			   <input type="hidden" id="userxm" name="userxm" value="<?php echo ($userxm); ?>">
			   <input type="hidden" id="atuser" name="atuser" value="">
			   <input type="hidden" id="pdeid" name="pdeid" value="0"><!--pdeid默认为0，表示顶级评论，若不为0，则表示对别人的评论进行评论-->
			   <button class="btn btn-default btnw" style="margin-top: 2px;" id="send" onclick="send();" style="display: none;">发表</button>
			</div>
		</form>
	</div>
</div>
<div>
    <div style="right:20;bottom: 50;position: fixed;"><button class="btn btn-info btnw" onclick="myrefresh()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button></div>
	<div style="right:20;bottom: 15;position: fixed;"><a href="#top" class="btn btn-info"><span class="glyphicon glyphicon-chevron-up"></span> 回顶</a></div>
 </div>
</body>
</html>
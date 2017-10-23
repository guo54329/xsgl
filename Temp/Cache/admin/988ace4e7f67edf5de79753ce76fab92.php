<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/checked.min.css">

<script src="__PUBLIC__/Js/dialog/layer.js"></script>
<script src="__PUBLIC__/Js/dialog.js"></script>
<script>
// Tree object
function dTree(objName) {
	this.config = {
		target				: null,
		folderLinks			: false,
		useSelection		: false,
		useCookies			: false,
		useLines			: true,
		useIcons			: false,
		useStatusText		: true,
		closeSameLevel		: false,
		inOrder				: false
	}
	this.icon = {
		root		: '__PUBLIC__/Images/img/base.gif',
		folder		: '__PUBLIC__/Images/img/folder.gif',
		folderOpen	: '__PUBLIC__/Images/img/folderopen.gif',
		node		: '__PUBLIC__/Images/img/page.gif',
		empty		: '__PUBLIC__/Images/img/empty.gif',
		line		: '__PUBLIC__/Images/img/line.gif',
		join		: '__PUBLIC__/Images/img/join.gif',
		joinBottom	: '__PUBLIC__/Images/img/joinbottom.gif',
		plus		: '__PUBLIC__/Images/img/plus.gif',
		plusBottom	: '__PUBLIC__/Images/img/plusbottom.gif',
		minus		: '__PUBLIC__/Images/img/minus.gif',
		minusBottom	: '__PUBLIC__/Images/img/minusbottom.gif',
		nlPlus		: '__PUBLIC__/Images/img/nolines_plus.gif',
		nlMinus		: '__PUBLIC__/Images/img/nolines_minus.gif'
	};
	this.obj = objName;
	this.aNodes = [];
	this.aIndent = [];
	this.root = new Node(-1);
	this.selectedNode = null;
	this.selectedFound = false;
	this.completed = false;
};

$("input[type='checkbox']").addClass("checked-focus");

$(function(){
      $("#save").click(function(){
	      	var count = 0;
			var obj = document.all.authority;	
			var arr=new Array();
			var j=0;
			for(i=0;i<obj.length;i++){
				if(obj[i].checked){	
		         	arr[j++]=obj[i].value;
					//alert(arr[i]);
					count ++;				
				}
			}	
      		var rid=$("#rid").val().trim();
            if(arr.length>0 && rid!=0){
            	var url="<?php echo U(GROUP_NAME.'/Rbac/access');?>";
				var data = {'access':arr,'rid':rid};
		        // 执行异步请求  $.post
		        $.post(url,data,function(result){
		        	
		            if(result.status == 0) {
		                return dialog.error(result.message);
		            }
		            if(result.status == 1) {
		            	//alert(result.message);
		                return dialog.success(result.message, "<?php echo U(GROUP_NAME.'/Rbac/role');?>");
		            }

		        },'JSON');
            }
      });
});
</SCRIPT>
<script type="text/javascript" src="__PUBLIC__/Js/dtree.js"></script>
<style>
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
<form action="<?php echo U(GROUP_NAME.'/Rbac/access');?>" method="post">
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a href="<?php echo U(GROUP_NAME.'/Rbac/role');?>" class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 角色列表</a><span class="btn xiexian">/</span><a  class="btn btn4">配置权限</a>
	  </div>
	  <div class="panel-body">  
	  注意：登录管理、首页管理、个人信息无需配置，默认不验证！
	   
	   <div class="dtree">
			<p><a href="javascript:  d.closeAll();">展开</a> | <a href="javascript: d.openAll();">收起</a></p>
			<script type="text/javascript">
				d = new dTree('d');
				d.add(0,-1,'给角色配置权限');
			</script>

			<?php if(is_array($node)): foreach($node as $key=>$app): if($app["access"]): ?><script type="text/javascript">
						d.add(<?php echo ($app["id"]); ?>,0,'authority',"<?php echo ($app["id"]); ?>_1","<?php echo ($app["title"]); ?>",true,false);
					</script>
				<?php else: ?>
					<script type="text/javascript">
						d.add(<?php echo ($app["id"]); ?>,0,'authority',"<?php echo ($app["id"]); ?>_1","<?php echo ($app["title"]); ?>");
					</script><?php endif; ?>
				<?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): if($action["access"]): ?><script type="text/javascript">
							d.add(<?php echo ($action["id"]); ?>,<?php echo ($app["id"]); ?>,'authority',"<?php echo ($action["id"]); ?>_2","<?php echo ($action["title"]); ?>",true,false);	
						</script>
					<?php else: ?>
						<script type="text/javascript">
							d.add(<?php echo ($action["id"]); ?>,<?php echo ($app["id"]); ?>,'authority',"<?php echo ($action["id"]); ?>_2","<?php echo ($action["title"]); ?>");	
						</script><?php endif; ?>
					<?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): if($method["access"]): ?><script type="text/javascript">
								d.add(<?php echo ($method["id"]); ?>,<?php echo ($action["id"]); ?>,'authority',"<?php echo ($method["id"]); ?>_3","<?php echo ($method["title"]); ?>",true,false);
							</script>
						<?php else: ?>
							<script type="text/javascript">
								d.add(<?php echo ($method["id"]); ?>,<?php echo ($action["id"]); ?>,'authority',"<?php echo ($method["id"]); ?>_3","<?php echo ($method["title"]); ?>");
							</script><?php endif; endforeach; endif; endforeach; endif; endforeach; endif; ?>
			<script type="text/javascript">
				document.write(d);
				d.openAll();
				//-->
			</script>
		</div>
	  </div>
	  <div class="panel-footer" style="text-align: center;">
		<input type='hidden' id='rid' name='rid' value='<?php echo ($rid); ?>' />
	  	<button type="button" id="save" class="btn btn-info btn4"><span class="glyphicon glyphicon-check"></span> 保存配置</button>
	  </div>
</div>
</form>
</body>
</html>
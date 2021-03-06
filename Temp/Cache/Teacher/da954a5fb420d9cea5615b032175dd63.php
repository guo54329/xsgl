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
    window.onload=function(){
    var checkall=document.getElementById('all');
    var uncheck=document.getElementById('uncheck');
    var othercheck=document.getElementById('othercheck');
    var data=document.getElementById('data');
    var    checkbox=data.getElementsByTagName('input');
	
    checkall.onclick=function(){
            for(i=0;i<checkbox.length;i++){
                    checkbox[i].checked=true;
                };
        };
    uncheck.onclick=function(){
            for(i=0;i<checkbox.length;i++){
                    checkbox[i].checked=false;
                };
        };
    othercheck.onclick=function(){
            for(i=0;i<checkbox.length;i++){
                    if(checkbox[i].checked==true){
                            checkbox[i].checked=false;
                        }
                    else{
                        checkbox[i].checked=true;
                        }  
                };
        };
};
function checkbf(){
	
	//检查用户是否选择要备份的表，如果一个也没选择，给予提示
	var data=document.getElementById('data');
    var checkbox=data.getElementsByTagName('input');	
	var index=0;
	for(i=0;i<checkbox.length;i++){
            if(checkbox[i].checked==false){
				index++;
			}
    }

	if(index==checkbox.length){
		dialog.error("亲，请选择任务!");
		return false;
	}
	
	//检查用户是否输入了备份文件名，如果没有输入，给予提示
	if(mybf.bffilename.value==""){  
		dialog.error("请输入备份文件名！");
		mybf.bffilename.focus();
		return false;
	}
}
function checkhf(){
	if(hf.scidlist.value=="0"){
		dialog.error("亲，请选择提供任务的课程！");
		hf.scidlist.focus();
		return false;
	}
}

</script>
<style>
   .title{
   	  text-align: center;
   	  font-weight: bold;
   }
   	.form-inline{
		padding:5px 0px 5px 0px;
		margin:5px 0px 5px 16px;
		
		height:40px;
		line-height:40px;
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
	.btn4{
		width: 110px;
	}
</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading headalign">
			<a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 教师课表</a><span class="btn xiexian">/</span><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseList',array('scid'=>$scid));?>" class="btn btn4">任务列表</a><span class="btn xiexian">/</span><a  class="btn btn4">克隆任务</a>
	  </div>
	  <div class="form-inline">
		      <form action="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseClone');?>" method="post" name="hf" onsubmit='return checkhf();'>
			      <select name="scidlist" class="form-control">
			         <option value='0'>请选择提供任务的课程</option>
			      	 <?php if(is_array($courseother)): foreach($courseother as $key=>$v): $scidl = $v['scid']; $num=M('sxpubexcise')->where("scid=$scidl")->count(); ?>
			      	     <?php if($num > 0): ?><option value="<?php echo ($v["scid"]); ?>" <?php if($v['scid'] == $scidlist): ?>selected="selected"<?php endif; ?>><?php echo ($v["coursename"]); ?>(任务数:<?php echo ($num); ?>)-<?php echo ($v["cname"]); ?>(<?php echo ($v["term"]); ?>)</option><?php endif; endforeach; endif; ?>
			      </select>
			    <!--   <input type="hidden" name="scid" value="<?php echo ($scid); ?>"/> -->
			      <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span> 查询</button>
			  </form>
		</div>
	  <div class="panel-body">
		<form name='mybf' action="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseClone');?>" method='post' onsubmit='return checkbf();'>
                						
		<table class='table table-bordered table-hover'>
		<thead>
			<tr class="title"><td>序号</td><td>任务标题</td><td>任务描述</td><td>任务附件</td><td>发布时间</td></tr>
		</thead>	
		<tbody id="data">
			<?php $i=0;?><!--~不输出-->  
            <?php if(is_array($publist)): foreach($publist as $key=>$v): ?><tr class="tr">
                <td><?php echo ($i+1); ?></td>
                <td>
                <div class="form-inline">
				    <label><input type="checkbox" value="<?php echo ($v["peid"]); ?>" name="peid[<?php echo ($i); ?>]"  /><?php echo ($v["title"]); ?></label>
				    </div>
				</td>
                <td><?php echo ($v["desc"]); ?></td>
                <td><?php if($v['filename'] != ''): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxpubexciseDownAttach',array('peid'=>$v['peid']));?>"><?php echo ($v["filename"]); ?>(<?php echo format_bytes(filesize($v['url'].($v['filename']))); ?>)</a><?php else: ?>无附件<?php endif; ?></td> 
                <td><?php echo (date('Y-m-d H:i:s',$v["pubtime"])); ?></td>               
              </tr>
			  <?php $i++; endforeach; endif; ?>
            </tbody>
		</table>
		<div class="form-inline">
			<button type="button" id="all" class="btn btn-default" >全选</button>
			<button type="button" id="uncheck" class="btn btn-default">不选</button>
			<button type="button" id="othercheck" class="btn btn-default">反选</button>
			<!-- <input type="hidden" name="scid" value="<?php echo ($scid); ?>"/> -->
			<button class="btn btn-info btn4" type="submit"  name="bf"><span class="glyphicon glyphicon-share-alt"></span> 执行克隆</button>
			
		</div>
		</form>	
	</div>
	  
</div>

</body>
</html>
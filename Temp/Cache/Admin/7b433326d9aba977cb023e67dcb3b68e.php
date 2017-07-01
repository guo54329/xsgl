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
		dialog.error("亲，请选择需要备份的数据表!");
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
	if(myhf.hffilename.value=="0"){
		dialog.error("亲，请选择恢复文件名！");
		myhf.hffilename.focus();
		return false;
	}
}
//优化数据库表
function yh(obj){
	var tabname = obj.id;
	var data={'yh':1,'tabname':tabname};
    var url ="<?php echo U(GROUP_NAME.'/System/backup');?>";
    $.post(url,data,function(result){
    	if(result.status==1){
    		return  dialog.successtip(result.message);
    	}
    },'JSON');
}
</script>
<style>
   .form-inline{
   	text-align: left;
   }
   .btn-default{
   	   width: 50px;
   }
</style>
</head>
<body>

<div class="panel panel-default">
	  <div class="panel-heading">数据库管理</div>
	  <div class="panel-body">
	  		<form name='myhf' action='<?php echo U(GROUP_NAME.'/System/backup');?>' method='post' onsubmit='return checkhf();'>
			<div class="form-horizontal">  
			    <div class="form-inline">
					<select class="form-control" id="selecthf" name="hffilename" >
						<option value="0">请选择恢复文件名...</option>
						<?php $i=0;?>
						<?php if(is_array($files)): foreach($files as $key=>$v): ?><option value="<?php echo ($files[$i]); ?>"><?php echo ($i+1); ?> ---> <?php echo ($files[$i]); ?></option>
							<?php $i++; endforeach; endif; ?>
					</select>
					<button class="btn btn-info" type="submit"  name="hf"><span class="glyphicon glyphicon-floppy-open"></span> 恢复</button>
					
			    </div>
			</div>
			</form>

			<form name='mybf' action='<?php echo U(GROUP_NAME.'/System/backup');?>' method='post' onsubmit='return checkbf();'>
                <div class="form-inline">
					<button type="button" id="all" class="btn btn-default" >全选</button>
				
					<button type="button" id="uncheck" class="btn btn-default">不选</button>
				
					<button type="button" id="othercheck" class="btn btn-default">反选</button>
				
					<input type="text" name="bffilename" placeholder="请输入备份文件名！" class="form-control" />
				
					<button class="btn btn-info" type="submit"  name="bf"><span class="glyphicon glyphicon-floppy-save"></span> 备份</button>
				</div>						
			

		<table class='table table-bordered table-hover'>
		<thead>
			<tr class="title"><th>序号</th><th>表名</th><!--<th>表引擎</th>--><th>记录数</th><th>表大小</th><th>更新时间</th><th>操作</th><!--<th>表编码</th>--></tr>
		</thead>	
		<tbody id="data">
			<?php $i=0;?><!--~不输出-->  
            <?php if(is_array($tbdesc)): foreach($tbdesc as $key=>$v): ?><tr class="tr">
                <td><?php echo ($i+1); ?></td>
                <td>
                <div class="form-inline">
				    <label><input type="checkbox" value="<?php echo ($tbdesc[$i][0]); ?>" name="tbl[<?php echo ($i); ?>]"  /><?php echo ($tbdesc[$i][0]); if($tbdesc[$i][7]!=''): ?>(<?php echo ($tbdesc[$i][7]); ?>)<?php endif; ?></label>
				    </div>
				</td>
                <!--<td><?php echo ($tbdesc[$i][1]); ?></td>-->
                <td><?php echo ($tbdesc[$i][2]); ?></td>
                <td><?php echo ($tbdesc[$i][3]); ?> KB</td>
                <td><?php echo ($tbdesc[$i][5]); ?></td>
                <!--<td><?php echo ($tbdesc[$i][6]); ?></td>-->
                <td><button type="button" id="<?php echo ($tbdesc[$i][0]); ?>" class="btn btn-default" onclick="yh(this);">优化</button></td>
              </tr>
              
			  <?php $i++; endforeach; endif; ?>
            </tbody>
		</table>
		</form>	
	</div>
	  
</div>

</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<style type="text/css">
	.headalign{
		text-align: left;
	}
	.btncoursetable{
		width:110px;
		text-align: left;
	}
	.btnsearch{
	    width:100px;
	    height: 34px;
	    text-align: center;
	  }
    /*.row{
        border:1px dashed #ccc;
    }*/
    h4{
        height: 40px;
        line-height: 30px;
        display: inline-block;
        color: #337ab7;
        font-weight: bold;
        padding:4px 12px;
        width: 100%;
        background-color:#eee; 
        box-shadow: 1px 4px 8px #ccc;
    }
    .tdtitle{
        font-weight: 600;
    }
    .tdcontent{
        font-weight: 400;
    }
    .table{
    	margin-top:-10px;
    	margin-bottom:2px;
    }
    .finishcolor{
    	color:green;
    	font-weight: bold;
    }
/******loading*****加载效果实现*******/
    .loader {
      position: fixed;
      left: 50%;
      top: 50%;
      margin: -0.2em 0 0 -0.2em;
      text-indent: -9999em;
      border-top: 0.3em solid rgba(0, 0, 0, 0.1);
      border-right: 0.3em solid rgba(0, 0, 0, 0.1);
      border-bottom: 0.3em solid rgba(0, 0, 0, 0.1);
      border-left: 0.3em solid #555;
      -moz-transform: translateZ(0);
      -webkit-transform: translateZ(0);
      transform: translateZ(0);
      -moz-animation: loader 300ms infinite linear;
      -webkit-animation: loader 300ms infinite linear;
      animation: loader 300ms infinite linear;
      -moz-transition: all 500ms ease;
      -o-transition: all 500ms ease;
      -webkit-transition: all 500ms ease;
      transition: all 500ms ease;
  }

  .loader,.loader:after {
      border-radius: 50%;
      width: 4em;
      height: 4em;
  }

  .curtain {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background-color: white;
      -moz-transition: all 600ms ease;
      -o-transition: all 600ms ease;
      -webkit-transition: all 600ms ease;
      transition: all 600ms ease;
      filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
      opacity: 0;
      z-index: 0;
      overflow: hidden;
  }

  @-webkit-keyframes loader {
      0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
      }
      100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
      }
  }

  @-moz-keyframes loader {
      0% {
          -moz-transform: rotate(0deg);
          transform: rotate(0deg);
      }
      100% {
          -moz-transform: rotate(360deg);
          transform: rotate(360deg);
      }
  }

  @keyframes loader {
      0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
      }
      100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
      }
  }

  .is-loading {
      overflow: hidden;
  }

  .is-loading .curtain {
      filter: progid:DXImageTransform.Microsoft.Alpha(enabled=false);
      opacity: 1;
      z-index: 99;
  }

  .is-loading .loader {
      filter: progid:DXImageTransform.Microsoft.Alpha(enabled=false);
      opacity: 1;
  }
</style>
<script type="text/javascript">
  window.onload=function(){
       $('body').removeClass('is-loading');  
 }
</script>
<script type="text/javascript">
    $(function(){
        $('#scid').change(function(){
            var scid=$('#scid').val();
            var addexcise=$('#addexcise').attr('href');
            var lookexcise=$('#lookexcise').attr('href');
            //alert(pubexcise);
            if(scid!=0){
                var addurl = addexcise+"/scid/" + scid;
                var lookurl = lookexcise+"/scid/" + scid;
                $('#addexcise').attr('href',addurl);  
                $('#lookexcise').attr('href',lookurl);
            }
        });
    });
</script>
</head>
<body class="is-loading">
 <!-- class="is-loading"是加载效果的一部分 -->
<!-- 加载效果 -->
<div class="curtain">
  <div class="loader">
      loading...
  </div>
</div><!-- 加载效果 -->
<div class="panel panel-default">
    <div class="panel-heading headalign">
    <a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 控制台</a>
    </div>
    <div class="panel-body">
    	<div class="row">
    		<div class="col-md-12">
		    	<div class="alert alert-success fade in" style="font-size:18px;margin-bottom: 2px;">
		            <i class="glyphicon glyphicon-ok"></i> 
		            <strong>提示</strong> <?php echo ($wel); ?>
		        </div>
	    	</div>
    	</div>
        <div class="row">
            <div class="col-md-6">
               <h4><span class="glyphicon glyphicon-link"></span> 快捷方式</h4>
               <table class="table table-bordered" style="height:140px">
                    <tr>
                    	<td style="line-height: 50px;">
	                    	<div class="form-inline" style="padding-top: 2px;">
	                    		<select id="scid" class="form-control">
	                    			<option value='0'>请选择课程添加/查看任务[学期-班级-课程]</option>
	                    			<?php if(is_array($courses)): foreach($courses as $key=>$v): ?><option value="<?php echo ($v["scid"]); ?>"><?php echo ($v["term"]); ?>-<?php echo ($v["cname"]); ?>-<?php echo ($v["coursename"]); ?></option><?php endforeach; endif; ?>
	                    		</select>
	                    		<a href="<?php echo U(GROUP_NAME.'/teacher/Excise/sxpubexciseSave');?>" class="btn btn-info" id="addexcise"><span class="glyphicon glyphicon-plus"></span> 添加</a>
								<a href="<?php echo U(GROUP_NAME.'/teacher/Excise/sxpubexciseList');?>" class="btn btn-info" id="lookexcise"><span class="glyphicon glyphicon-eye-open"></span> 查看</a>
	                    		
	                    	</div>
                    	</td>
                    </tr>
                    <tr><td  style="line-height: 50px;">
                    	<div class="form-inline">
                    		<a href="<?php echo U(GROUP_NAME.'/News/newsSave');?>" class="btn btn-info btnsearch"><span class="glyphicon glyphicon-plus"></span> 发布消息</a>　<a href="<?php echo U(GROUP_NAME.'/News/sysNews');?>" class="btn btn-info btnsearch"><span class="glyphicon glyphicon-eye-open"></span> 查看消息</a> 　　　　　
	                    	<a href="<?php echo U(GROUP_NAME.'/Excise/coursetableSave');?>" class="btn btn-info btnsearch"><span class="glyphicon glyphicon-plus"></span>  添加课表</a>　
					        <a href="<?php echo U(GROUP_NAME.'/Excise/courseTable');?>" class="btn btn-info btnsearch"><span class="glyphicon glyphicon-eye-open"></span> 查看课表</a>
				    	</div>	
				        </td>
                    </tr>
                </table>
                <h4><span class="glyphicon glyphicon-user"></span> 登录信息</h4>
                <table class="table table-bordered"  style="height:121px">
                    <tr><td style="text-align: left;line-height: 40px;"><?php echo ($sinfor["tealogin"]); ?></td>
                    </tr>
                    
                </table>
            </div>
            <div class="col-md-6">
               <h4><span class="glyphicon glyphicon-hand-right"></span> 数据统计</h4>
               <table class="table table-bordered table-hover">
               	   <tr><td class="tdtitle">统计项</td>
               	   	<td class="tdtitle">今日</td>
               	   	<td class="tdtitle">本月</td>
               	   	<td class="tdtitle">本学期</td>
               	   	<td  class="tdtitle">累计</td>
               	   </tr>
                   <tr><td>发布的任务个数</td>
                   	<td><?php echo ($excisenum["todayexcisenum"]); ?></td>
                   	<td><?php echo ($excisenum["thismonthexcisenum"]); ?></td>
                   	<td><?php echo ($excisenum["thistermexcisenum"]); ?></td>
                   	<td><?php echo ($excisenum["totalexcisenum"]); ?></td>
                   </tr>
                   <tr><td>接收任务学生数</td>
                   	<td><?php echo ($sturecnum["todaysturecnum"]); ?></td>
                   	<td><?php echo ($sturecnum["thismonthsturecnum"]); ?></td>
                   	<td><?php echo ($sturecnum["thistermsturecnum"]); ?></td>
                   	<td><?php echo ($sturecnum["totalsturecnum"]); ?></td>
                   </tr>
                   <tr><td>提交作业学生数</td>
                   	<td><?php echo ($stusubnum["todaystusubnum"]); ?></td>
                   	<td><?php echo ($stusubnum["thismonthstusubnum"]); ?></td>
                   	<td><?php echo ($stusubnum["thistermstusubnum"]); ?></td>
                   	<td><?php echo ($stusubnum["totalstusubnum"]); ?></td>
                   </tr>

				   <tr><td>任务完成率(交/收)</td>
                   	<td><?php echo ($excisefinish["todayfinish"]); ?></td>
                   	<td><?php echo ($excisefinish["thismonthfinish"]); ?></td>
                   	<td><?php echo ($excisefinish["thistermfinish"]); ?></td>
                   	<td><?php echo ($excisefinish["totalfinish"]); ?></td>
                   </tr>
				   <tr><td>文件个数统计</td>
                    <td><?php echo ($filenumandsize["todaynum"]); ?></td>
                    <td><?php echo ($filenumandsize["thismonthnum"]); ?></td>
                    <td><?php echo ($filenumandsize["thistermnum"]); ?></td>
                    <td><?php echo ($filenumandsize["totalnum"]); ?></td>
                   </tr>
                   <tr><td>文件大小统计</td>
                    <td><?php echo ($filenumandsize["todaysize"]); ?></td>
                    <td><?php echo ($filenumandsize["thismonthsize"]); ?></td>
                    <td><?php echo ($filenumandsize["thismonthsize"]); ?></td>
                    <td><?php echo ($filenumandsize["thismonthsize"]); ?></td>
                   </tr>
                   <tr><td>讨论区交流条数</td>
                   	<td><?php echo ($discussnum["todaydiscussnum"]); ?></td>
                   	<td><?php echo ($discussnum["thismonthdiscussnum"]); ?></td>
                   	<td><?php echo ($discussnum["thistermdiscussnum"]); ?></td>
                   	<td><?php echo ($discussnum["totaldiscussnum"]); ?></td>
                   </tr>
				   
                   
               </table>
           </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4><span class="glyphicon glyphicon-info-sign"></span> 框架及系统信息</h4>
                <table class="table table-bordered table-hover">
                <tr><td class="tdtitle">运行环境</td><td align="left"><?php echo ($sinfor["pe"]); ?></td></tr>
                <tr><td class="tdtitle">开发框架</td><td align="left"><?php echo ($sinfor["think"]); ?></td></tr>
                <tr><td class="tdtitle">运行主机</td><td align="left"><?php echo ($sinfor["zj"]); ?></td></tr>
                <!-- <tr><td class="tdtitle">登录信息</td><td align="left"><?php echo ($sinfor["tealogin"]); ?></td></tr> -->
                <tr><td class="tdtitle">系统介绍</td><td align="left"><?php echo ($sinfor["js"]); ?></td></tr>
                <tr><td class="tdtitle">开发团队</td><td align="left"><?php echo ($sinfor["kfz"]); ?></td></tr>
             </table>
            </div>
           
        </div>
    </div> 
</div>
</body>
</html>
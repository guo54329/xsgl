<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml"><head><meta charset="utf-8"><meta http-equiv="refresh" content="60"><!--每隔10s刷新一次--><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" /><link rel="stylesheet" href="__PUBLIC__/Css/main.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script><script type="text/javascript" src="__PUBLIC__/Js/selects.js"></script><style type="text/css">  .headalign{
    text-align: left;
  }
  .btncoursetable{
    width:110px;
    text-align: left;
  }
  .btnsearch{
    width:110px;
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
          margin-bottom:2px;
          margin-top:-10px;
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
</style><script type="text/javascript">  window.onload=function(){
  
       $('body').removeClass('is-loading');  
   }

</script></head><body class="is-loading"><!-- class="is-loading"是加载效果的一部分 --><!-- 加载效果 --><div class="curtain"><div class="loader">      loading...
  </div></div><!-- 加载效果 --><div class="panel panel-default"><div class="panel-heading headalign"><a  class="btn btncoursetable"><span class="glyphicon glyphicon-home"></span> 控制台</a></div><div class="panel-body"><div class="row"><div class="col-md-12"><div class="alert alert-success" style="font-size:18px;margin-bottom:2px;"><i class="glyphicon glyphicon-ok"></i><strong>提示：</strong><?php echo ($xsxm); ?>，<?php echo ($wel); ?></div></div></div><div class="row"><div class="col-md-6"><h4><span class="glyphicon glyphicon-link"></span> 快捷方式</h4><table class="table table-bordered"><tr><td><div class="form-inline" style="height:80px;line-height: 22px;"><form action='<?php echo U(GROUP_NAME.'/Excise/sxsubexciseList');?>' method="post"><select name="term" class="form-control"></select><select name="coursename" class="form-control"></select><!-- js的使用 start--><script type="text/javascript" src="__PUBLIC__/Js/termCourse.js"></script><script type="text/javascript">                  var s = selects;
                  //获取对象
                  var a = document.getElementsByName('term')[0];
                  var b = document.getElementsByName('coursename')[0];
                  //绑定数据
                  s.bind(a,xq);//xq和kc来自js文件的变量
                  s.bind(b,kc);//a和b来自本页面的属性
                  
                  //确定从属关系
                  s.parent(a,b);
                 </script><button type="submit" class="btn btn-info btnsearch"><span class='glyphicon glyphicon-search'></span> 查询任务</button></form><a href="<?php echo U(GROUP_NAME.'/Index/sysNews');?>" class="btn btn-info" style="width: 270px;line-height: 16px;font-size: 16px;
                          display: block;margin-bottom: 6px;"><span class="glyphicon glyphicon-bullhorn"></span>  查看管理员和教师发布的消息</a></div></td></tr></table></div><div class="col-md-6"><h4><span class="glyphicon glyphicon-user"></span> 登录信息</h4><table class="table table-bordered"><tr><td align="left"><span style="line-height: 40px;"><?php echo ($sinfor["stulogin"]); ?></span></td></tr></table></div></div><div class="row"><div class="col-md-12"><h4><span class="glyphicon glyphicon-time"></span> 待完成任务 <span class="badge"><?php echo ($num); ?></span></h4><table class="table table-bordered table-hover"><tr><td class="tdtitle">学期</td><td class="tdtitle">课程</td><td class="tdtitle">序号</td><td class="tdtitle">任务标题</td><td class="tdtitle">发布教师</td><td class="tdtitle">发布时间</td><td class="tdtitle">完成状态</td></td></tr><?php $i=1; if(is_array($list)): foreach($list as $key=>$v): ?><tr><td><?php echo ($v["term"]); ?></td><td><?php echo ($v["coursename"]); ?></td><td><?php echo ($i); $v.peid;?></td><td align="left"><a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDesc',array('seid'=>$v['seid']));?>"><?php echo ($v["title"]); ?></a></td><td><?php echo ($v["jsxm"]); ?></td><td><?php echo (date('m-d H:i',$v["pubtime"])); ?></td><td><?php if($v['status'] == 0 ): ?><a href="<?php echo U(GROUP_NAME.'/Excise/sxsubexciseDesc',array('seid'=>$v['seid']));?>" class="btn" style="font-size: 16px;"><span class="glyphicon glyphicon-hand-right"></span> 去完成</a><?php else: ?><img src="__PUBLIC__/Images/finish.png" style="height: 40px;" /><?php endif; ?></td></tr><?php $i++; endforeach; endif; ?></table></div></div><div class="row"><div class="col-md-12"><h4><span class="glyphicon glyphicon-info-sign"></span> 框架及系统信息</h4><table class="table table-bordered table-hover"><tr><td class="tdtitle" style="width:140px;">运行环境</td><td align="left"><?php echo ($sinfor["pe"]); ?></td></tr><tr><td class="tdtitle">开发框架</td><td align="left"><?php echo ($sinfor["think"]); ?></td></tr><tr><td class="tdtitle">运行主机</td><td align="left"><?php echo ($sinfor["zj"]); ?></td></tr><tr><td class="tdtitle">系统介绍</td><td align="left"><?php echo ($sinfor["js"]); ?></td></tr><tr><td class="tdtitle">开发团队</td><td align="left"><?php echo ($sinfor["kfz"]); ?></td></tr></table></div></div></div></div></body></html>
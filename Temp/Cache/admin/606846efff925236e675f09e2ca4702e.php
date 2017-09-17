<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="__PUBLIC__/Css/bootstrap.css" />
<link rel="stylesheet" href="__PUBLIC__/Css/main.css" />
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/highcharts.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/exporting.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/highcharts-zh_CN.js"></script>

<style type="text/css">
	.headalign{
		text-align: left;
	}
	.btncoursetable{
		width:110px;
		text-align: left;
	}
</style>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: ""
        },
        tooltip: {
            headerFormat: '{series.name}<br>',
            pointFormat: '{point.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: '满意度占比',
            data: [
                
                ['满意', <?php echo ($my); ?>],
                ['比较满意', <?php echo ($bjmy); ?>],
                {
                    name: '非常满意',
                    y: <?php echo ($fcmy); ?>,
                    sliced: true,
                    selected: true
                },
                
                ['不满意',<?php echo ($bmy); ?>]
            ]
        }]
    });
});
</script>
</head>
<body>
<div class="panel panel-default">
	  <div class="panel-heading headalign">
		<a  class="btn  btncoursetable"><span class="glyphicon glyphicon-home"></span> 系统运行环境/用户满意度统计</a>
	  </div>
	  <div class="panel-body">
	      <div class="row">
	      	<div class="col-md-6">
	      	    <h4>系统运行环境</h4>
	      		<table class="table table-bordered table-hover">
					<tr><td width="20%">服务器软件</td><td><?php echo ($sinfor["f1"]); ?></td></tr>
					<tr><td>开发语言</td><td><?php echo ($sinfor["f2"]); ?></td></tr>
					<tr><td>数据库软件</td><td><?php echo ($sinfor["f3"]); ?></td></tr>
					<!--<tr><td align='right'>本主机信息</td><td><?php echo ($sinfor["f4"]); ?></td></tr>-->
					<tr><td>服务器IP</td><td><?php echo ($sinfor["f5"]); ?></td></tr>
					<tr><td>服务器域名</td><td><?php echo ($sinfor["f6"]); ?></td></tr>
					<tr><td>服务器端口</td><td><?php echo ($sinfor["f7"]); ?></td></tr>
					<tr><td>Zend版本</td><td><?php echo ($sinfor["f8"]); ?></td></tr>
			     </table>

	      	</div>
	      	<div class="col-md-6">
	      	     <h4>用户满意度调查统计<span> <a href="<?php echo U(GROUP_NAME.'/Index/detail');?>" class="btn btn-sm">查看细节</a></span></h4>
	      		 <div id="container" style="min-width: 300px;min-height: 280px;border:1px solid #ccc;"></div>
	      	</div>
	      </div>
	        
	   </div>
       
</div>
</body>
</html>
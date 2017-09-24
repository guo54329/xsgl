// JavaScript Document
///-------------------------------------------------------------------------
//jQuery弹出窗口

 jQuery.fn.floatadv = function(loaded) {
	var obj = $(this);
 	var	body_height = parseInt($(window.top).height());
	var block_height = parseInt(obj.height());
	var doc_height = parseInt($(window.top.document.body).height());

	top_position = parseInt((body_height/2) - (block_height/2) + $(window.top).scrollTop());
	if (body_height<block_height) { top_position = $(window.top).scrollTop()>(doc_height-block_height)?(doc_height-block_height-1):$(window.top).scrollTop()-1; };

	var	body_width = parseInt($(window.top.document.body).width());
	var block_width = parseInt(obj.width());
	
	left_position = parseInt((body_width/2) - (block_width/2) + $(window.top).scrollLeft());
	if (body_width<block_width) { left_position = 0 + $(window.top).scrollLeft(); };
	
	obj.css({'position': 'absolute'});
	if(!loaded) {
		obj.css({ 'top': top_position });
		obj.css({ 'left': left_position });
		$(window.top).bind('resize', function() { 
			obj.floatadv(!loaded);
		});
		$(window.top).bind('scroll', function() { 
			obj.floatadv(!loaded);
		});
	} else {
		obj.stop(true,false);
		obj.animate({ 'top': top_position,'left': left_position }, 600);
	}	
}	
 
var showWindown = true;

function tipsWindown(title,content,width,height,drag,time,showbg,cssName) {
	$("#windown-box").remove(); 
	
	var width =  parseInt(width);
	var height =  parseInt(height); 

	var width_outer=width+27;
	var height_outer=height+60;

	var _version = $.browser.version;

	contentType = content.substring(0,content.indexOf(":"));
	content = content.substring(content.indexOf(":")+1,content.length);


			
	if(showWindown == true) {
		var simpleWindown_html = new String;	
			simpleWindown_html = "<div id=\"windownbg\"></div>";
			//simpleWindown_html += "<div id=\"windown-box\"><div class='wrapper_play_media' style='width:"+width+"px;height:"+height+"px;'><div class='play_topBorder_media' style='width:"+width+"px'></div><div class='play_leftBorder_media' style='height:"+height+"px'></div><div class='play_bottomBorder_media' style='width:"+width+"px'></div><div class='play_rightBorder_media' style='height:"+height+"px'></div><div class='play_LT_media png' ></div><div class='play_LB_media png' ></div><div class='play_RT_media png' ></div><div class='play_RB_media png' ></div>";
			simpleWindown_html += "<div id=\"windown-content\"></div><div class='play_mediaName'  title='"+title+"' style='width:"+width+"px'>"+title+"</div><div class='btn_close' title='关闭' id='windown-close'></div>";
			simpleWindown_html += "</div></div>";
		
			//判断是否在框架中弹出
			if(window.top != window.self){//在框架中弹出
				$(window.top.document.body).append(simpleWindown_html);
				$window_bg=$(window.top.document.getElementById("windownbg"));
				$window_box=$(window.top.document.getElementById("windown-box"));
				$window_close=$(window.top.document.getElementById("windown-close"));
				$window_content=$(window.top.document.getElementById("windown-content"));

				//查询弹出层中页面路径
				var pageLink=$(window.top.document.getElementById("myIFrame")).attr("src");
				var pageLink_array=pageLink.split("/");//以“/”分割链接字符串，并生成数组
				var length_pageLink_array=pageLink_array.length;//计算长度
				var keyNum=parseInt(length_pageLink_array)-2;//获取所在的文件夹名称
				var fold_name=pageLink_array[keyNum];
//				var path="../content/SCOs/"+fold_name+"/";
	
			  }
			  else{//非框架中弹出
				  	$("body").append(simpleWindown_html);
					$window_bg=$("#windownbg");
					$window_box=$("#windown-box");
					$window_close=$("#windown-close");
					$window_content=$("#windown-content");
					path="";
				  }		
			show = false;
	}

	
		//加载iframe框
		$window_content.html("<iframe src=\""+path+content+"\" id=\"window_iframe\"  width=\""+parseInt(width)+"px"+"\" height=\""+parseInt(height)+"px"+"\" scrolling=\"no\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\" style=\"background:#FFF;\"></iframe>");


	if(showbg == "true") {$window_bg.show();}else {$window_bg.remove();};
	
	//设置背景层大小、位置
	function set_window_bg(){
		$window_bg.css({
			width:(window.top != window.self)?$(window.top).width():$(window.document.body).width(),
			height:(window.top != window.self)?($(window.top).height()>$(window.top.document.body).height()?$(window.top).height():$(window.top.document.body).height()):($(window).height()>$(document.body).height()?$(window).height():$(document.body).height()),				
			position:"absolute",
			top:0,
			left:0
			});
	}
	set_window_bg();
	
	
	$(window.top).bind('resize scroll', function() { 
			set_window_bg();
		});
	
	$(window.top).bind('resize', function() { 
		$(this).scrollTop(0);
	});
	
	//设置弹出框样式
	function func_set_window_box(){			
	$window_box.show()
	.css({
		width:width_outer,
		height:height_outer
		}).floatadv(0);
	}
	func_set_window_box();
	
		
	//关闭弹出层
	$window_bg.click(function() {//点击背景层关闭弹出层

		$window_content.html("").remove();
		$window_box.html("").remove();
		$window_bg.remove();
	});
	$window_close.click(function() {//点击关闭按钮关闭弹出层
		$window_content.html("").remove();
		$window_box.html("").remove();
		$window_bg.remove();
	});
}

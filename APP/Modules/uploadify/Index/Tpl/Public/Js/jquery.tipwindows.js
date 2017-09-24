// JavaScript Document
//拖动函数外壳
function bdragable(id){
    var d=window.parent.document,o=d.getElementById(id),s=o.style,x,y,p='onmousemove';
    o.onmousedown=function(e){
        e=window.parent.e||window.parent.event||e;
        x=e.clientX-o.offsetLeft;
        y=e.clientY-o.offsetTop;
        d[p]=function(e){
            e=window.parent.e||window.parent.event||e;
            s.left=e.clientX-x+'px';
            s.top=e.clientY-y+'px'};
        d.onmouseup=function(){d[p]=null}
    }
}
//拖动函数内页面
function dragable(id){
    var d=document,o=d.getElementById(id),s=o.style,x,y,p='onmousemove';
    o.onmousedown=function(e){e=e||event;
        x=e.clientX-o.offsetLeft;
        y=e.clientY-o.offsetTop;
        d[p]=function(e){e=e||event;s.left=e.clientX-x+'px';s.top=e.clientY-y+'px'};
        d.onmouseup=function(){d[p]=null}}
}
//关闭函数	
function tclose(){
    $("body").find("#mask").remove();
    $("body").find("#black").remove();
}
function setOffest(e,x,y,z){
    var h=0; var w=0;
    //获取高宽
    //************************************
    h=e.find("#tipwindows #tipwtopLeft").width()*1+e.find("#tipwindows #tipwtopRight").width()*1;
    w=e.find("#tipwTop").height()*1+e.find("#tipwBottom").height()*1;
    //外壳高度
    e.find("#tipwindows").css("width",x*1+w*1+"px");
    e.find("#tipwindows").css("height",y*1+h*1+"px");
    //顶部宽
    e.find("#tipwtopCenter").css("width",x*1+"px");
    //中间宽
    e.find("#tipwcenterCenter").css("width",x+"px");
    e.find("#tipwcenterLeft").css("height",y*1+"px");
    e.find("#tipwcenterCenter").css("height",y+"px");
    e.find("#tipwcenterRight").css("height",y*1+"px");
    //底宽
    e.find("#tipwbottomCenter").css("width",x*1+"px");
    //******************************************
    //定位
    //弹出窗高宽
    var ewidth=e.find("#tipwindows").width();
    var eheight=e.find("#tipwindows").height();
    //遮罩高宽

    //获取窗口宽度
    if (window.parent.window.innerWidth)
        winWidth = window.parent.window.innerWidth;
    else if ((e) && (e.clientWidth))
        winWidth = e.clientWidth;
    //获取窗口高度
    if (window.innerHeight)
        winHeight = window.parent.window.innerHeight;
    else if ((e) && (e.clientHeight))
        winHeight = e.clientHeight;
    //通过深入Document内部对body进行检测，获取窗口大小
    if (window.parent.document.documentElement && window.parent.document.documentElement.clientHeight && window.parent.document.documentElement.clientWidth)
    {
        winHeight = window.parent.document.documentElement.clientHeight;
        winWidth = window.parent.document.documentElement.clientWidth;
    }
    var mwidth=winWidth;
    var mheight=winHeight;
    e.find("#black").width(winWidth);
    e.find("#black").height(winHeight);
    e.find("#mask").width(winWidth);
    e.find("#mask").height(winHeight);
    var rleft=(mwidth*1-ewidth*1)/2;
    var rtop=(mheight*1-eheight*1)/2;
    e.find("#tipwindows").css("position","absolute");
    e.find("#tipwindows").css("left",rleft+"px");
    e.find("#tipwindows").css("top",rtop+"px");
    if(z==0){
        e.find("#tipwindows").css("top","-1000px");
        e.find("#tipwindows").animate({top:rtop-5+"px"},1000).animate({top:rtop+5+"px"},100).animate({top:rtop+"px"},80);
    }
}
function setPlayWindows(str,x,y,title){
    try{
        var urlt = $('#myIFrame', window.parent.document).attr("src");
        urlt = urlt.replace('index.html','');
        var url=urlt+str;
        var o=$("body", window.parent.document);
        o.prepend("<link rel=\"stylesheet\" type=\"text/css\" href=\""+urlt+"/css/tip.css\"/>");
        o.prepend("<div id='black'></div><div id='mask'><div id='maskFrame'><div id='tipwindows' class='tip'><div id='tipwTop'><div id='tipwtopLeft'></div><div id='tipwtopCenter'><a href='javascript:void(0);' onclick='$(\"#mask\", window.parent.document).remove();$(\"#black\", window.parent.document).remove();'>close</a>"+title+"</div><div id='tipwtopRight'></div></div><div id='tipwCenter'><div id='tipwcenterLeft'></div><div id='tipwcenterCenter'><iframe src='' scrolling='no' frameborder='0' style='border:0px;' id='sb'></iframe></div><div id='tipwcenterRight'></div></div><div id='tipwBottom'><div id='tipwbottomLeft'></div><div id='tipwbottomCenter'></div><div id='tipwbottomRight'></div></div></div></div></div>");/* scrolling='no'*/
        //调入页面
        o.find("#sb").css("width",x+"px");
        o.find("#sb").css("height",y+"px");
        o.find("#sb").attr("src",url);
        //设置高宽定位
        setOffest(o,x,y,'0');
        //拖动
        bdragable("tipwindows");
        $(window.top).bind('resize scroll', function() {
            setOffest(o,x,y,'1');
        });
    }catch (e){
        var o=$("body");//定义body
        //var ot=$("#");
        //输出边框
        o.prepend("<div id='black'></div><div id='mask'><div id='maskFrame'><div id='tipwindows' class='tip'><div id='tipwTop'><div id='tipwtopLeft'></div><div id='tipwtopCenter'><a href='javascript:void(0);' onclick='tclose()'>close</a>"+title+"</div><div id='tipwtopRight'></div></div><div id='tipwCenter'><div id='tipwcenterLeft'></div><div id='tipwcenterCenter'><iframe src='' scrolling='no' frameborder='0' style='border:0px;' id='sb'></iframe></div><div id='tipwcenterRight'></div></div><div id='tipwBottom'><div id='tipwbottomLeft'></div><div id='tipwbottomCenter'></div><div id='tipwbottomRight'></div></div></div></div></div>");
        //调入页面
        o.find("#sb").css("width",x+"px");
        o.find("#sb").css("height",y+"px");
        o.find("#sb").attr("src",str);
        //设置高宽定位
        setOffest($("body"),x,y,'0');
        //拖动
        dragable("tipwindows");
        $(window.top).bind('resize scroll', function() {
            setOffest(o,x,y,'1');
        });
    }
}


	
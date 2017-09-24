//main js
$(document).ready(function(){
    $('.nav').find('li').last().addClass('last');
    //导航效果
    var indexOld=0;
    var url=0;
    $('.nav').find('li').eq(indexOld).children().css({"font-weight":"bold"});
    /*获取地址栏参数*/
    var location = window.location.href;
    var locationArray = location.split("/");
    for(var i=0;i<locationArray.length;i++)	{
        var attrArray = locationArray[i].split("/");
        switch (attrArray[0]){
            case 'xxgk':
                url=1;
                IntnavGo(url);
			
                break;
            case 'xwzx':
                url=2;
                IntnavGo(url);
				
                break;
            case 'gljg':
                url=3;
                IntnavGo(url);
				
                break;
            case 'dqgz':
                url=4;
                IntnavGo(url);
				
                break;
            case 'szdw':
                url=5;
                IntnavGo(url);
				
                break;
            case 'jxky':
                url=6;
                IntnavGo(url);
				
                break;
            case 'dygl':
                url=7;
                IntnavGo(url);
				
                break;
            case 'zsjy':
                url=8;
                IntnavGo(url);
				
                break;
            case 'hzgl':
                url=9;
                IntnavGo(url);
				
                break;
            case 'zyjs':
                url=11;
                IntnavGo(url);
				
                break;
            case 'bzly':
                url=12;
                IntnavGo(url);
				
                break;
            default :
                navGo(url);
        }
    }
    function IntnavGo(n){
        $('.nav').find('li').children().css({"font-weight":"normal","color":"#FFF"});
        $('.nav').find('li').find('a').eq(n).css({"font-weight":"bold","color":"#333"});
        $('.nav-cur-bg').css({'left':75*url});
    }
	
	

    //处理内容页swf或图片大于730宽度时
    (function( selector ){
    	var textC = $('.xxjj-content');
    	if(textC.size() > 0) {
    		textC.find( selector ).each(function( index, obj ){
    			//the width of this element
    			var width = $(obj).width();
    			if( width > 730 ) {
    				$(obj).width(730);
    			}
    		});
    	}
    })('embed,img');

    //处理内容多余的字符串
    (function( header, pagebtn ) {
    	//先出处理标题，标题的要求是去掉//后面的信息
    	var title = $( header ).html();
    	if( title ){
    		title = title.replace(/\/\/[\s\S]*/g,'');
    		if( title>20 ) {
    			title = title.substr(0,20)+'...';
    		}
    		$( header ).html( title );
    	}
    	//处理上一条下一条信息的内容
    	$( pagebtn ).each(function( index, obj ) {
    		var a = $(obj).find('a:eq(1)');
    		var text = a.html();
    		text = text.replace(/\/\/[\s\S]*/g,'');
    		if( text>20 ) {
    			text = text.substr(0,20)+'...';
    		}
    		a.html( text );
    	});
    })( 'h1.news-title', 'div.infoLink p' );

    function navGo(indexCur){
        var leftD = indexCur;
        indexOld=indexCur;
        var pos=indexCur;
        var liNo=$('.nav').find('li').length;
        $('.nav').find('li').not(':eq(indexOld)').children().css({"font-weight":"normal","color":"#FFF"});
        $('.nav').find('li').eq(indexOld).children().css({"font-weight":"bold","color":"#333"});
        $('.nav-cur-bg').stop().animate({
            left:leftD*75
        });
        $('.nav').find('li').each(function(){
            $(this).bind({
                mouseenter:function(){
                    pos = $(this).index();
                    $('.nav').find('li').not(':eq(pos)').children().css({"font-weight":"normal","color":"#FFF"});
                    $('.nav').find('li').eq(pos).children().css({"font-weight":"bold","color":"#333"});
                    leftD = 75*pos;
                    $('.nav-cur-bg').stop().animate({
                        left:leftD
                    });
                },
                mouseleave:function(){
                    $('.nav').find('li').not(':eq(indexOld)').children().css({"font-weight":"normal","color":"#FFF"});
                    $('.nav').find('li').eq(indexOld).children().css({"font-weight":"bold","color":"#333"});
                    leftD = 75*(indexOld);
                    $('.nav-cur-bg').stop().animate({
                        left:leftD
                    });
                }
            })
        });
    }
//轮播图
	(function( $ ){
		var size = $('.J_myfocus1').size();
		if(size == 0) {
			return false;
		}
		//将图放到按钮中
		var btncode = '';
		var btns = $('.J_myfocus1 .btns');
		var imgs = $('.J_myfocus1 .imgs img');
		var title = $('.J_myfocus1 .title a');
		var len = imgs.size();
		var timer = 0;
		btns.find('a').removeClass('cur');
		imgs.css('opacity','0');
		imgs.hide();
		imgs.each(function(index, element) {
            btncode += '<a href="'+$(this).attr('href')+'"><img src="'+$(this).attr('src')+'" /></a>';
        });
		
		tab(0);
		autotab();
		
		btns.find('a').mouseenter(stoptab);
		btns.find('a').mouseleave(autotab);
		title.mouseenter(stoptab)
		title.mouseleave(autotab);
		
		btns.find('a').click(function(e){
			if( lastInd != $(this).index() ) {
				tab( $(this).index() );
			}
			return false;
		});
		
		function autotab() {
			if( timer ) {
				clearInterval( timer );
			}
			timer = setInterval(function(){
				tab( lastInd+1==len?0:lastInd+1 );
			},3000);
		}
		function stoptab() {
			clearInterval( timer );
		}
		
		var lastInd = 0;
		function tab( n ) {
			imgs.eq( lastInd ).stop().animate({opacity:0},400);
			imgs.eq( lastInd ).hide();
			btns.find('a').eq( lastInd ).removeClass('cur');
			title.attr('href',imgs.eq( n ).attr('href'));
			title.html(imgs.eq( n ).attr('title'));
			imgs.eq( n ).stop().animate({opacity:1},400);
			imgs.eq( n ).show();
			btns.find('a').eq( n ).addClass('cur');
			lastInd = n;
		}
		
	}( $ ));
	//轮播图1
	(function( $ ){
		var size = $('.J_myfocus2').size();
		if(size == 0) {
			return false;
		}
		//将图放到按钮中
		var btncode = '';
		var btns = $('.J_myfocus2 .btns');
		var imgs = $('.J_myfocus2 .imgs img');
		var title = $('.J_myfocus2 .title a');
		var len = imgs.size();
		var timer = 0;
		btns.find('a').removeClass('cur');
		imgs.css('opacity','0');
		imgs.hide();
		imgs.each(function(index, element) {
            btncode += '<a href="'+$(this).attr('href')+'"><img src="'+$(this).attr('src')+'" /></a>';
        });
		tab(0);
		autotab();
		
		btns.find('a').mouseenter(stoptab);
		btns.find('a').mouseleave(autotab);
		title.mouseenter(stoptab)
		title.mouseleave(autotab);
		
		btns.find('a').click(function(e){
			if( lastInd != $(this).index() ) {
				tab( $(this).index() );
			}
			return false;
		});
		
		function autotab() {
			if( timer ) {
				clearInterval( timer );
			}
			timer = setInterval(function(){
				tab( lastInd+1==len?0:lastInd+1 );
			},3000);
		}
		function stoptab() {
			clearInterval( timer );
		}
		
		var lastInd = 0;
		function tab( n ) {
			imgs.eq( lastInd ).stop().animate({opacity:0},400).hide();
			btns.find('a').eq( lastInd ).removeClass('cur');
			title.attr('href',imgs.eq( n ).attr('href'));
			title.html(imgs.eq( n ).attr('title'));
			imgs.eq( n ).stop().animate({opacity:1},400).show();
			btns.find('a').eq( n ).addClass('cur');
			lastInd = n;
		}
		
	}( $ ));
	//轮播图2
	(function( $ ){
		var size = $('#J_myfocus').size();
		if(size == 0) {
			return false;
		}
		//将图放到按钮中
		var btncode = '';
		var btns = $('#J_myfocus .btns');
		var imgs = $('#J_myfocus .imgs img');
		var title = $('#J_myfocus .title a');
		var len = imgs.size();
		var timer = 0;
		imgs.css('opacity','0');
		imgs.hide();
		imgs.each(function(index, element) {
            btncode += '<a href="'+$(this).attr('href')+'"><img src="'+$(this).attr('src')+'" /></a>';
        });
		btns.html(btncode);
		tab(0);
		autotab();
		
		btns.find('a').mouseenter(stoptab);
		btns.find('a').mouseleave(autotab);
		title.mouseenter(stoptab)
		title.mouseleave(autotab);
		
		btns.find('a').click(function(e){
			if( lastInd != $(this).index() ) {
				tab( $(this).index() );
			}
			return false;
		});
		
		function autotab() {
			if( timer ) {
				clearInterval( timer );
			}
			timer = setInterval(function(){
				tab( lastInd+1==len?0:lastInd+1 );
			},3000);
		}
		function stoptab() {
			clearInterval( timer );
		}
		
		var lastInd = 0;
		function tab( n ) {
			imgs.eq( lastInd ).stop().animate({opacity:0},400).hide();
			btns.find('a').eq( lastInd ).removeClass('cur');
			title.attr('href',imgs.eq( n ).attr('href'));
			title.html(imgs.eq( n ).attr('title'));
			imgs.eq( n ).stop().animate({opacity:1},400).show();
			btns.find('a').eq( n ).addClass('cur');
			lastInd = n;
		}
		
	}( $ ));

    //新闻动态焦点图
    if($(".xwdt-focus").css('width') != undefined){
        $(".xwdt-focus").jqSimpleFocus();
    }

    //获取当前时间
    var curDay = (function() {
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var day = date.getDate();
        var week = date.getDay();
        switch (week) {
            case 0:
                week = '星期日';
                break;
            case 1:
                week = '星期一';
                break;
            case 2:
                week = '星期二';
                break;
            case 3:
                week = '星期三';
                break;
            case 4:
                week = '星期四';
                break;
            case 5:
                week = '星期五';
                break;
            case 6:
                week = '星期六';
                break;
        }
        var time = "今天是：" + year + '年' + month + '月' + day + '日' + '  ' + week;
        return time;
    })();
    var CalendarData = new Array(100);
    var madd = new Array(12);
    var tgString = "甲乙丙丁戊己庚辛壬癸";
    var dzString = "子丑寅卯辰巳午未申酉戌亥";
    var numString = "一二三四五六七八九十";
    var monString = "正二三四五六七八九十冬腊";
    var weekString = "日一二三四五六";
    var sx = "鼠牛虎兔龙蛇马羊猴鸡狗猪";
    var cYear, cMonth, cDay, TheDate;
    CalendarData = new Array(0xA4B, 0x5164B, 0x6A5, 0x6D4, 0x415B5, 0x2B6, 0x957, 0x2092F, 0x497, 0x60C96, 0xD4A, 0xEA5, 0x50DA9, 0x5AD, 0x2B6, 0x3126E, 0x92E, 0x7192D, 0xC95, 0xD4A, 0x61B4A, 0xB55, 0x56A, 0x4155B, 0x25D, 0x92D, 0x2192B, 0xA95, 0x71695, 0x6CA, 0xB55, 0x50AB5, 0x4DA, 0xA5B, 0x30A57, 0x52B, 0x8152A, 0xE95, 0x6AA, 0x615AA, 0xAB5, 0x4B6, 0x414AE, 0xA57, 0x526, 0x31D26, 0xD95, 0x70B55, 0x56A, 0x96D, 0x5095D, 0x4AD, 0xA4D, 0x41A4D, 0xD25, 0x81AA5, 0xB54, 0xB6A, 0x612DA, 0x95B, 0x49B, 0x41497, 0xA4B, 0xA164B, 0x6A5, 0x6D4, 0x615B4, 0xAB6, 0x957, 0x5092F, 0x497, 0x64B, 0x30D4A, 0xEA5, 0x80D65, 0x5AC, 0xAB6, 0x5126D, 0x92E, 0xC96, 0x41A95, 0xD4A, 0xDA5, 0x20B55, 0x56A, 0x7155B, 0x25D, 0x92D, 0x5192B, 0xA95, 0xB4A, 0x416AA, 0xAD5, 0x90AB5, 0x4BA, 0xA5B, 0x60A57, 0x52B, 0xA93, 0x40E95);
    madd[0] = 0;
    madd[1] = 31;
    madd[2] = 59;
    madd[3] = 90;
    madd[4] = 120;
    madd[5] = 151;
    madd[6] = 181;
    madd[7] = 212;
    madd[8] = 243;
    madd[9] = 273;
    madd[10] = 304;
    madd[11] = 334;

    function GetBit(m, n) {
        return (m >> n) & 1;
    }
    function e2c() {
        TheDate = (arguments.length != 3) ? new Date() : new Date(arguments[0], arguments[1], arguments[2]);
        var total, m, n, k;
        var isEnd = false;
        var tmp = TheDate.getYear();
        if (tmp < 1900) {
            tmp += 1900;
        }
        total = (tmp - 1921) * 365 + Math.floor((tmp - 1921) / 4) + madd[TheDate.getMonth()] + TheDate.getDate() - 38;

        if (TheDate.getYear() % 4 == 0 && TheDate.getMonth() > 1) {
            total++;
        }
        for (m = 0; ; m++) {
            k = (CalendarData[m] < 0xfff) ? 11 : 12;
            for (n = k; n >= 0; n--) {
                if (total <= 29 + GetBit(CalendarData[m], n)) {
                    isEnd = true; break;
                }
                total = total - 29 - GetBit(CalendarData[m], n);
            }
            if (isEnd) break;
        }
        cYear = 1921 + m;
        cMonth = k - n + 1;
        cDay = total;
        if (k == 12) {
            if (cMonth == Math.floor(CalendarData[m] / 0x10000) + 1) {
                cMonth = 1 - cMonth;
            }
            if (cMonth > Math.floor(CalendarData[m] / 0x10000) + 1) {
                cMonth--;
            }
        }
    }

    function GetcDateString() {
        var tmp = "";
        tmp += tgString.charAt((cYear - 4) % 10);
        tmp += dzString.charAt((cYear - 4) % 12);
        tmp += "年 (";
        tmp += sx.charAt((cYear - 4) % 12);
        tmp += ")  ";
        if (cMonth < 1) {
            tmp += "(闰)";
            tmp += monString.charAt(-cMonth - 1);
        } else {
            tmp += monString.charAt(cMonth - 1);
        }
        tmp += "月";
        tmp += (cDay < 11) ? "初" : ((cDay < 20) ? "十" : ((cDay < 30) ? "廿" : "三十"));
        if (cDay % 10 != 0 || cDay == 10) {
            tmp += numString.charAt((cDay - 1) % 10);
        }
        return tmp;
    }

    function GetLunarDay(solarYear, solarMonth, solarDay) {
        //solarYear = solarYear<1900?(1900+solarYear):solarYear;
        if (solarYear < 1921 || solarYear > 2020) {
            return "";
        } else {
            solarMonth = (parseInt(solarMonth) > 0) ? (solarMonth - 1) : 11;
            e2c(solarYear, solarMonth, solarDay);
            return GetcDateString();
        }
    }
    //调用
    var D = new Date();
    var yy = D.getFullYear();
    var mm = D.getMonth() + 1;
    var dd = D.getDate();
    var ww = D.getDay();
    var ss = parseInt(D.getTime() / 1000);
    if (yy < 100) yy = "19" + yy;
    function GetCNDate() {
        return GetLunarDay(yy, mm, dd);
    }


    $(document).ready(function () {
        $("#scroll-infor").find('span').text(curDay);
        var d = GetCNDate();
        $(".nl").text("农历："+d);
        var mon=d.substring(6,12);
        mon=mon.replace(/(^\s*)|(\s*$)/g, "");
    });


    var myDate = new Date();
    var myYear=myDate.getMonth()+1;
    var myDay=myDate.getDate();
    $(document).ready(function () {
        var zq = GetCNDate();
        var mon=zq.substring(6,12);
        mon=mon.replace(/(^\s*)|(\s*$)/g,'');

    });

    //设置首页
    var setHomeBtn = $('#J_SetHomepage');
    if (setHomeBtn != null && setHomeBtn != undefined) {
        setHomeBtn.click(function (){
            setHomePage(this, window.location);
            return false;
        })
    }
    //加入收藏夹
    var addFavoriteBtn = $('#J_AddFavorite');
    if (addFavoriteBtn != null && addFavoriteBtn != undefined) {
        addFavoriteBtn.click(function () {
            addFavorite(window.location, document.title);
            return false;
        })
    }
    //设为首页
    function setHomePage(obj, url) {
        try {
            obj.style.behavior = 'url(#default#homepage)';
            obj.setHomePage(url);
            console.log(url);
        }
        catch (e) {
            if (window.netscape) {
                try {
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                }
                catch (e) {
                    alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
                }
                var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                prefs.setCharPref('browser.startup.homepage', url);
            }
        }
    }
    //加入收藏夹
    function addFavorite(sURL, sTitle) {
        try {
            window.external.addFavorite(sURL, sTitle);
        }
        catch (e) {
            try {
                window.sidebar.addPanel(sTitle, sURL, "");
            }
            catch (e) {
                alert("加入收藏失败，请使用Ctrl+D进行添加");
            }
        }
    }

    /*焦点图*/
    var focusPic = $('#J_FocusPic');
    //生成背景、按钮、标题
    var tipsCode = "<div class='tips-wrap'>"
        + "<div class='tips-bg png'></div>"
        + "<div class='tips-title'></div>"
        + "<div class='tips-btn'>";
    var picNum = focusPic.find('a').length;
    for(var i=0; i<picNum; i++){
        tipsCode += "<a href='javascript:;'></a>";
    }
    tipsCode += "</div></div>";
    //初始化
    function init(){
        focusPic.append(tipsCode);
        focusPic.children('a').first().fadeIn().css({"z-index":2});
        var firstTitle = focusPic.children('a').first().attr('title');
        $('.tips-title').text(firstTitle);
        $('.tips-btn').find('a').first().addClass('cur');
    }
    init();
    /*切换*/
    function switchPic(currentIndex,nextIndex){
        focusPic.children('a').eq(currentIndex).fadeOut().css({"z-index":1});
        focusPic.children('a').eq(nextIndex).fadeIn().css({"z-index":2});
        $('.tips-title').text(focusPic.children('a').eq(nextIndex).attr('title'));
        $('.tips-btn').find('a').eq(currentIndex).removeClass('cur');
        $('.tips-btn').find('a').eq(nextIndex).addClass('cur');
    }
    function doSwitch(){
        var currentIndex = $('.tips-btn').find('.cur').index();
        var nextIndex = 0;
        if(currentIndex >= 0 && currentIndex < 3){
            nextIndex = currentIndex + 1;
        }
        else if(currentIndex >= 3){
            nextIndex = 0;
        }
        switchPic(currentIndex,nextIndex);
    }
    //自动切换
    var focusTimer = setInterval(doSwitch,3000);
    focusPic.children('a').bind({
        mouseenter: function(){
            clearInterval(focusTimer);
        },
        mouseleave: function(){
            focusTimer = setInterval(doSwitch,3000);
        }
    });
    //移入鼠标切换
    $('.tips-btn').find('a').bind({
        mouseenter: function(){
            clearInterval(focusTimer);
            var currentIndex = $(this).index();
            $(this).siblings().removeClass('cur');
            $(this).addClass('cur');
            focusPic.children('a').not(':eq(currentIndex)').fadeOut().css({"z-index":1});
            focusPic.children('a').eq(currentIndex).fadeIn().css({"z-index":2});
            $('.tips-title').text(focusPic.children('a').eq(currentIndex).attr('title'));
        },
        mouseleave: function(){
            focusTimer = setInterval(doSwitch,3000);
        }
    });

    $(".vedio-play-btn").click(function(){
        /*page_=$(this).attr("page_");
        width_media_=$(this).attr("width_media_");
        height_media_=$(this).attr("height_media_");
        mediaName_=$(this).attr("mediaName_");
        tipsWindown(mediaName_,"iframe:"+page_,width_media_,height_media_,"true","","true","text");*/
    });


//home focus pic
    //first level namespace
    if (typeof yn == "undefined") {
        var yn = {};
    }
//通知公告滚动
    yn.scroll = {};     //滚动组件命名空间
    //校园风光图片横向滚动
    yn.scroll.schollpic = {};
    yn.scroll.schollpic.init = function() {
        var prev = $(".xyfg-prev");
        var next = $(".xyfg-next");
        var obj = $("#J_SchollPicWrapper ul");
        var w = obj.find("li").innerWidth();
        var objHtml = obj.html();
        objHtml += objHtml;
        obj.html(objHtml);
        var liNum = obj.find('li').length;
        obj.css('width',parseInt(w)*liNum + 10 * liNum + 'px');
        prev.bind({
            click: function(){
                obj.find("li:last").prependTo(obj);
                obj.css("margin-left", -w);
                obj.animate({"margin-left": 0});
            },
            mouseover: function(){
                $(this).addClass('prev-hover');
                clearInterval(moving);
            },
            mouseout: function(){
                $(this).removeClass('prev-hover');
                moving = setInterval(function () {
                    prev.click()
                }, 3000);
            }
        });
        next.bind({
            click: function(){
                obj.animate({"margin-left": -w}, function () {
                    obj.find("li:first").appendTo(obj);
                    obj.css("margin-left", "0");
                });
            },
            mouseover: function(){
                $(this).addClass('next-hover');
                clearInterval(moving);
            },
            mouseout: function(){
                $(this).removeClass('next-hover');
                moving = setInterval(function () {
                    prev.click()
                }, 3000);
            }
        });
        var moving = setInterval(function () {
            prev.click()
        }, 3000);

        obj.hover(function () {
            clearInterval(moving);
        }, function () {
            moving = setInterval(function () {
                prev.click()
            }, 3000);
        })
    };
    yn.scroll.schollpic.init();


    //热门点击列表 加序号和背景
    var oRmdjLi=0;
    oRmdjLi=$('#rmdj-list ul li').length;
    for(var i=0;i<=oRmdjLi;i++){
        if(i<9){
            $('#rmdj-list ul li').eq(i).addClass('xwzx_hotclick0'+(i+1));
        }else{
            $('#rmdj-list ul li').eq(i).addClass('xwzx_hotclick'+(i+1));
        }
    }
    for(var i=0;i<=oRmdjLi;i+=2){
        $('#rmjs-list ul li').eq(i).find('a').addClass('single');
    }
    //通知公告滚动
    var J_TzWrapperL=$('#J_TzWrapper').length;
    if(J_TzWrapperL!=0){
        var Tzgg=document.getElementById('J_TzWrapper');
        var  TzggUl=Tzgg.getElementsByTagName('ul')[0];
        var  TzggLi=TzggUl.getElementsByTagName('li');

        var iSpeed=1;
        var timer=null;
        TzggUl.innerHTML+=TzggUl.innerHTML;
        timer=setInterval(function(){
            TzggUl.style.top=(TzggUl.offsetTop-iSpeed)+'px';
            if(TzggUl.offsetTop<-TzggUl.offsetHeight/2){
                TzggUl.style.top=0;
            }
        },30);
        TzggUl.onmouseover=function(){
            clearInterval(timer);
        };
        TzggUl.onmouseout=function(){
            timer=setInterval(function(){
                TzggUl.style.top=(TzggUl.offsetTop-iSpeed)+'px';
                if(TzggUl.offsetTop<-TzggUl.offsetHeight/2){
                    TzggUl.style.top=0;
                }
            },30);
        };
    }

    //毕业生风采横向滚动
    var J_BysWrapperL=$('#J_BysWrapper').length;
    if(J_BysWrapperL!=0){
        var Bysfc=document.getElementById('J_BysWrapper');
        var  BysfcUl=Bysfc.getElementsByTagName('ul')[0];
        var  BysfcLi=BysfcUl.getElementsByTagName('li');
        var iSpeed=1;
        var timer=null;
        BysfcUl.innerHTML+=BysfcUl.innerHTML;
        BysfcUl.style.width=BysfcLi[0].offsetWidth*BysfcLi.length+10+'px';
        //alert(box.offsetLeft);
        timer=setInterval(function(){
            BysfcUl.style.left=(BysfcUl.offsetLeft-iSpeed)+'px';
            if(BysfcUl.offsetLeft<-BysfcUl.offsetWidth/2){
                BysfcUl.style.left=0;
            }
        },30);
        BysfcUl.onmouseover=function(){
            clearInterval(timer);
        };
        BysfcUl.onmouseout=function(){
            timer=setInterval(function(){
                BysfcUl.style.left=(BysfcUl.offsetLeft-iSpeed)+'px';
                if(BysfcUl.offsetLeft<-BysfcUl.offsetWidth/2){
                    BysfcUl.style.left=0;
                }
            },30);
        };
    }
});

var g_bMoveJudge = true;
var g_oTimer = null;//通知滚动
var g_oTimerPic = null;//图片滚动
var g_oTimerOut = null;
var g_iSpeed = 1;
//图片滚动
function startMovePic(bJude) {
    g_bMoveJudge = bJude;
    if (g_oTimerPic) {
        clearInterval(g_oTimerPic);
    }
    g_oTimerPic = setInterval(doMovePic, 28);
}
function stopMovePic() {
    clearInterval(g_oTimerPic);
    g_oTimerPic = null;
}
function doMovePic() {
    var oDivPic = document.getElementById('J_BysWrapper');
    var oUlPic = oDivPic.getElementsByTagName('ul')[0];
    var aLiPic = oUlPic.getElementsByTagName('li');
    var l = oUlPic.offsetLeft;

    if (g_bMoveJudge) {
        l -= g_iSpeed;
        if (l <= -oUlPic.offsetWidth / 2) {
            l += oUlPic.offsetWidth / 2;
        }
    }
    else {
        l += g_iSpeed;
        if (l >= 0) {
            l -= oUlPic.offsetLeft / 2;
        }
    }
    oUlPic.style.left = l + 'px';
}

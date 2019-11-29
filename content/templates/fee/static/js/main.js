
if( !window.console ){
    window.console = {
        log: function(){}
    }
}


/*!
 * jQuery resizeend - A jQuery plugin that allows for window resize-end event handling.
 * 
 * Copyright (c) 2015 Erik Nielsen
 * 
 * Licensed under the MIT license:
 *    http://www.opensource.org/licenses/mit-license.php
 * 
 * Project home:
 *    http://312development.com
 * 
 * Version:  0.2.0
 * 
 */
!function(a){var b=window.Chicago||{utils:{now:Date.now||function(){return(new Date).getTime()},uid:function(a){return(a||"id")+b.utils.now()+"RAND"+Math.ceil(1e5*Math.random())},is:{number:function(a){return!isNaN(parseFloat(a))&&isFinite(a)},fn:function(a){return"function"==typeof a},object:function(a){return"[object Object]"===Object.prototype.toString.call(a)}},debounce:function(a,b,c){var d;return function(){var e=this,f=arguments,g=function(){d=null,c||a.apply(e,f)},h=c&&!d;d&&clearTimeout(d),d=setTimeout(g,b),h&&a.apply(e,f)}}},$:window.jQuery||null};if("function"==typeof define&&define.amd&&define("chicago",function(){return b.load=function(a,c,d,e){var f=a.split(","),g=[],h=(e.config&&e.config.chicago&&e.config.chicago.base?e.config.chicago.base:"").replace(/\/+$/g,"");if(!h)throw new Error("Please define base path to jQuery resize.end in the requirejs config.");for(var i=0;i<f.length;){var j=f[i].replace(/\./g,"/");g.push(h+"/"+j),i+=1}c(g,function(){d(b)})},b}),window&&window.jQuery)return a(b,window,window.document);if(!window.jQuery)throw new Error("jQuery resize.end requires jQuery")}(function(a,b,c){a.$win=a.$(b),a.$doc=a.$(c),a.events||(a.events={}),a.events.resizeend={defaults:{delay:250},setup:function(){var b,c=arguments,d={delay:a.$.event.special.resizeend.defaults.delay};a.utils.is.fn(c[0])?b=c[0]:a.utils.is.number(c[0])?d.delay=c[0]:a.utils.is.object(c[0])&&(d=a.$.extend({},d,c[0]));var e=a.utils.uid("resizeend"),f=a.$.extend({delay:a.$.event.special.resizeend.defaults.delay},d),g=f,h=function(b){g&&clearTimeout(g),g=setTimeout(function(){return g=null,b.type="resizeend.chicago.dom",a.$(b.target).trigger("resizeend",b)},f.delay)};return a.$(this).data("chicago.event.resizeend.uid",e),a.$(this).on("resize",a.utils.debounce(h,100)).data(e,h)},teardown:function(){var b=a.$(this).data("chicago.event.resizeend.uid");return a.$(this).off("resize",a.$(this).data(b)),a.$(this).removeData(b),a.$(this).removeData("chicago.event.resizeend.uid")}},function(){a.$.event.special.resizeend=a.events.resizeend,a.$.fn.resizeend=function(b,c){return this.each(function(){a.$(this).on("resizeend",b,c)})}}()});


/* 
 * jsui
 * ====================================================
*/
jsui.bd = $('body')
jsui.is_signin = jsui.bd.hasClass('logged-in') ? true : false;

if( $('.widget-nav').length ){
    $('.widget-nav li').each(function(e){
        $(this).hover(function(){
            $(this).addClass('active').siblings().removeClass('active')
            $('.widget-navcontent .item:eq('+e+')').addClass('active').siblings().removeClass('active')
        })
    })
}

if( $('.sns-wechat').length ){
    $('.sns-wechat').on('click', function(){
        var _this = $(this)
        if( !$('#modal-wechat').length ){
            $('body').append('\
                <div class="modal fade" id="modal-wechat" tabindex="-1" role="dialog" aria-hidden="true">\
                    <div class="modal-dialog" style="margin-top:200px;width:340px;">\
                        <div class="modal-content">\
                            <div class="modal-header">\
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
                                <h4 class="modal-title">'+ _this.attr('alt') +'</h4>\
                            </div>\
                            <div class="modal-body" style="text-align:center">\
                                <img style="max-width:100%" src="'+ _this.data('src') +'">\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            ')
        }
        $('#modal-wechat').modal()
    })
}
if( $('.carousel').length ){
    var el_carousel = $('.carousel')

    el_carousel.carousel({
        interval: 4000
    })

    tbquire(['hammer'], function(Hammer) {

        // window.Hammer = Hammer
        
        var mc = new Hammer(el_carousel[0]);

        mc.on("panleft panright swipeleft swiperight", function(ev) {
            if( ev.type == 'swipeleft' || ev.type == 'panleft' ){
                el_carousel.carousel('next')
            }else if( ev.type == 'swiperight' || ev.type == 'panright' ){
                el_carousel.carousel('prev')
            }
        });

    })
}

if( Number(jsui.ajaxpager) > 0 && ($('.excerpt').length || $('.excerpt-minic').length) ){
    tbquire(['ias'], function() {
        if( !jsui.bd.hasClass('site-minicat') && $('.excerpt').length ){
            $.ias({
                triggerPageThreshold: jsui.ajaxpager?Number(jsui.ajaxpager)+1:5,
                history: false,
                container : '.content',
                item: '.excerpt',
                pagination: '.pagination',
                next: '.next-page a',
                loader: '<div class="pagination-loading"><img src="'+jsui.uri+'/static/img/loading.gif"></div>',
                trigger: 'More',
                onRenderComplete: function() {
                    tbquire(['lazyload'], function() {
                        $('.excerpt .thumb').lazyload({
                            data_attribute: 'src',
                            placeholder: jsui.uri + '/static/img/thumbnail.png',
                            threshold: 400
                        });
                    });
                }
            });
        }

        if( jsui.bd.hasClass('site-minicat') && $('.excerpt-minic').length ){
            $.ias({
                triggerPageThreshold: jsui.ajaxpager?Number(jsui.ajaxpager)+1:5,
                history: false,
                container : '.content',
                item: '.excerpt-minic',
                pagination: '.pagination',
                next: '.next-page a',
                loader: '<div class="pagination-loading"><img src="'+jsui.uri+'/static/img/loading.gif"></div>',
                trigger: 'More',
                onRenderComplete: function() {
                    tbquire(['lazyload'], function() {
                        $('.excerpt .thumb').lazyload({
                            data_attribute: 'src',
                            placeholder: jsui.uri + '/static/img/thumbnail.png',
                            threshold: 400
                        });
                    });
                }
            });
        }
    });
}

    $(function(){
		$title=jsui.collapse_title;
        $(".hidecontent").hide();
        $("button").click(function(){
            var txts = $(this).parents("li");
            if ($(this).text() == $title){
                txts.find(".hidetitle").hide();
                txts.find(".hidecontent").slideToggle('show');
            }
        })
    });
/* 
 * lazyload
 * ====================================================
*/
tbquire(['lazyload'], function() {
    $('.avatar').lazyload({
        data_attribute: 'src',
        placeholder: jsui.uri + '/static/img/avatar.png',
        threshold: 400
    })

    $('.widget .avatar').lazyload({
        data_attribute: 'src',
        placeholder: jsui.uri + '/static/img/avatar.png',
        threshold: 400
    })

    $('.thumb').lazyload({
        data_attribute: 'src',
        placeholder: jsui.uri + '/static/img/thumbnail.png',
        threshold: 400
    })

    $('.widget_ui_posts .thumb').lazyload({
        data_attribute: 'src',
        placeholder: jsui.uri + '/static/img/thumbnail.png',
        threshold: 400
    })
    $('.img-share img').lazyload({
        data_attribute: 'src',
        placeholder: jsui.uri + '/static/img/thumbnail.png',
        threshold: 400
    })

})
     $wintip_srollbar=jsui.wintip_s;
	 $wintip_m=jsui.wintip_m;
/* 
 * wintips
 * ====================================================
*/
    if($wintip_srollbar>0){
		$(function(){
			if($.cookie("isClose") != 'yes'){
				$(".wintips").show();
				$(".wintips-close").click(function(){
					$(".wintips").fadeOut(500);	
					$.cookie("isClose",'yes',{ expires:1/24});	// 10ms 为 1/8640 24h为1 1h为1/24 10min为1/144 20min为1/72
				
				});
			}
		});
     var width = $(window).width(); 
     if($wintip_m>0 && width < 720){$(".wintips").hide();}
	}
	
	
/**全天提醒***/
var notices=jsui.notices_s;
  if(notices==1){
   day = new Date(); nge_Hour = day.getHours(); var nge_warmprompt = "";
     notices_str=jsui.notices_content; 
     var notices_strs= new Array(); 
       notices_strs=notices_str.split("|"); 

        if (nge_Hour == 0) {
        nge_warmprompt = notices_strs[0];
          } else if (nge_Hour == 1) {
        nge_warmprompt = notices_strs[1];
            } else if (nge_Hour == 2) {
        nge_warmprompt = notices_strs[2];
              } else if (nge_Hour == 3) {
        nge_warmprompt = notices_strs[3];
                } else if (nge_Hour == 4) {
        nge_warmprompt = notices_strs[4];
                  } else if (nge_Hour == 5) {
        nge_warmprompt = notices_strs[5];
                    } else if (nge_Hour == 6) {
        nge_warmprompt = notices_strs[6];
                     } else if (nge_Hour == 7) {
        nge_warmprompt = notices_strs[7];
                      } else if (nge_Hour == 8) {
        nge_warmprompt = notices_strs[8];
                         } else if ((nge_Hour == 9) || (nge_Hour == 10)) {
        nge_warmprompt = notices_strs[9];
                         } else if ((nge_Hour == 11) || (nge_Hour == 12)) {
        nge_warmprompt = notices_strs[10];
                       } else if ((nge_Hour >= 13) && (nge_Hour <= 17)) {
        nge_warmprompt = notices_strs[11];
                    } else if ((nge_Hour >= 17) && (nge_Hour <= 18)) {
        nge_warmprompt = notices_strs[12];
                 } else if ((nge_Hour >= 18) && (nge_Hour <= 19)) {
        nge_warmprompt = notices_strs[13];
             } else if ((nge_Hour >= 20) && (nge_Hour <= 21)) {
        nge_warmprompt = notices_strs[14];
           } else if ((nge_Hour >= 22) && (nge_Hour <= 23)) {
        nge_warmprompt = notices_strs[15];
      }

 function getDate(){
               
                var date = new Date();
                
                var times = date.toLocaleTimeString('chinese', { hour12: false });
               
               var div1 = document.getElementById("notices_times");

			   div1.innerHTML = times;
            }
           
            setInterval("getDate()",1000);

    $(function(){
	if($.cookie("noticesClose") != 'yes'){
		jsui.bd.append('\
			  <div class="notices">\
			  <div class="notices-icon">\
			  <img src="'+jsui.bing_img+'">\
			  </div>\
			  <div class="notices-content">\
			  <ul>\
			  <h4>'+jsui.notices_title+'</h2>\
			  <li class="notices-body">'+ nge_warmprompt +'</li>\
			  <li class="notices-info">北京时间：<span id="notices_times"></span></li>\
			  </ul>\
			  </div><i class="fa fa-times"></i>\
			  </div>\
                  '); 
		     setTimeout(function(){	
		      $(".notices").show(500);
              }, 3000);
				  	$(".notices>.fa").click(function(){
					$(".notices").hide(500);	
					$.cookie("noticesClose",'yes',{ expires:1/24});
				
				});
                }
	});
  }
	
	
$(window).scroll(function() {
	document.documentElement.scrollTop + document.body.scrollTop > 0 ? $('.header').addClass('scrolled') : $('.header').removeClass('scrolled');
    document.documentElement.scrollTop + document.body.scrollTop > 0 ? $('.oldtb').addClass('scrolled') : $('.oldtb').removeClass('scrolled');
})	
/* 
 * prettyprint
 * ====================================================
*/
$('pre').each(function(){
    if( !$(this).attr('style') ) $(this).addClass('prettyprint')
})

if( $('.prettyprint').length ){
    tbquire(['prettyprint'], function(prettyprint) {
        prettyPrint()
    })
}


$(document).ready(function(){

	var c=1;								
	$(".group-detail>ul>.card-item").mouseenter(function(){
		var e=$(this);
		c=e.data("card");
		var e=$(this);
		setTimeout(function(){
			if(c==e.data("card")){
				$(".group-detail>ul>.card-item").removeClass("active");
				e.addClass("active")
			}
		},250)
	});

});

//隐藏或者显示侧边栏
    jQuery(document).ready(function($) {
	var width = $(window).width();
        $('.close-sidebar').click(function() {
			if(width > 1024){
            $('.sidebar').addClass('sid-on');
			$('.leftsd').addClass('leftsd-on');
            $('.show-sidebar').show();
			$('.close-sidebar').hide();
            $('.single-content').addClass('hidebianlan');
			 $('.containercc').addClass('boxhidesd');
			}});
        $('.show-sidebar').click(function() {
		if(width > 1024){
            $('.show-sidebar').hide();
			$('.close-sidebar').show();
            $('.sidebar').removeClass('sid-on');
			$('.leftsd').removeClass('leftsd-on');
            $('.single-content').removeClass('hidebianlan');
			 $('.containercc').removeClass('boxhidesd');
	 }});
    });
	
	
	
	  $('.share-haibao').click(function() {
			$('.bigger-share').addClass('haibao-on');
            $('.dialog_overlay').show();
			$('.dialog_overlay').click(function() {
			$('.bigger-share').removeClass('haibao-on');
            $('.dialog_overlay').hide();
			});
			
			});
	$('.share-close').click(function() {
			$('.bigger-share').removeClass('haibao-on');
            $('.dialog_overlay').hide();
			});
	
	
/* 
 * rollbar
 * ====================================================
*/
  if($wintip_srollbar<1){
jsui.rb_comment = ''
if (jsui.bd.hasClass('comment-open')) {
    jsui.rb_comment = "<li><a href=\"javascript:(scrollTo('#comments',-15));\"><i class=\"fa fa-comments\"></i></a><h6>去评论<i></i></h6></li>"
}

jsui.rb_qq = ''
if( jsui.qq_id ){
    jsui.rb_qq = '<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='+jsui.qq_id+'&site=qq&menu=yes"><i class="fa fa-qq"></i></a><h6>'+jsui.qq_tip+'<i></i></h6></li>'
}

jsui.bd.append('\
    <div class="m-mask"></div>\
    <div class="rollbar"><ul>'
    +jsui.rb_comment
    +jsui.rb_qq+
    '<li><a href="javascript:(scrollTo());"><i class="fa fa-angle-up"></i></a><h6>去顶部<i></i></h6></li>\
    </ul></div>\
')

  }else{
	  jsui.bd.append('<div class="m-mask"></div>')
  }

var _wid = $(window).width()

$(window).resize(function(event) {
    _wid = $(window).width()
});



var scroller = $('.rollbar')
var _fix = (jsui.bd.hasClass('nav_fixed') && !jsui.bd.hasClass('page-template-navs')) ? true : false
$(window).scroll(function() {
    var h = document.documentElement.scrollTop + document.body.scrollTop

    if( _fix && h > 0 && _wid > 720 ){
        jsui.bd.addClass('nav-fixed')
    }else{
        jsui.bd.removeClass('nav-fixed')
    }

    h > 66 ? scroller.fadeIn() : scroller.fadeOut();
})





/* 
 * bootstrap
 * ====================================================
*/
$('.user-welcome').tooltip({
    container: 'body',
    placement: 'bottom'
})





/* 
 * single
 * ====================================================
*/

var _sidebar = $('.sidebar')
if (_wid>1024 && _sidebar.length) {
    var h1 = 15,
        h2 = 30
    var rollFirst = _sidebar.find('.widget:eq(' + (jsui.roll[0] - 1) + ')')
    var sheight = rollFirst.height()


    rollFirst.on('affix-top.bs.affix', function() {

        rollFirst.css({
            top: 0
        })
        sheight = rollFirst.height()

        for (var i = 1; i < jsui.roll.length; i++) {
            var item = jsui.roll[i] - 1
            var current = _sidebar.find('.widget:eq(' + item + ')')
            current.removeClass('affix').css({
                top: 0
            })
        };
    })

    rollFirst.on('affix.bs.affix', function() {

        rollFirst.css({
            top: jsui.bd.hasClass('nav-fixed')?h1+63:h1
        })

        for (var i = 1; i < jsui.roll.length; i++) {
            var item = jsui.roll[i] - 1
            var current = _sidebar.find('.widget:eq(' + item + ')')
            current.addClass('affix').css({
                top: jsui.bd.hasClass('nav-fixed')?sheight+h2+63:sheight+h2
            })
            sheight += current.height() + 15
        };
    })

    rollFirst.affix({
        offset: {
            top: _sidebar.height(),
            bottom: $('.footer').outerHeight()
        }
    })


}



$('[data-event="rewards"]').on('click', function(){
    $('.rewards-popover-mask, .rewards-popover').fadeIn()
})

$('[data-event="rewards-close"]').on('click', function(){
    $('.rewards-popover-mask, .rewards-popover').fadeOut()
})


if( $('#SOHUCS').length ) $('#SOHUCS').before('<span id="comments"></span>')


/*$('.plinks a').each(function(){
    var imgSrc = $(this).attr('href')+'/favicon.ico'
    $(this).prepend( '<img src="'+imgSrc+014'">' )
})*/




    $(function(){
        $('.doubt-content').hide();
        //按钮点击事件
        $('.doubt-button').click(function(){
            if ($(this).html() == '<i class="fa fa-chevron-down"></i>'){
				var txts = $(this).parents('.doubt');
                $(this).html('<i class="fa fa-chevron-up"></i>');
                //txts.find(".doubt-tit").hide();
                txts.find('.doubt-content').show(300);
            }else{
				var txts = $(this).parents('.doubt');
                $(this).html('<i class="fa fa-chevron-down"></i>');
                //txts.find(".doubt-tit").show();
                txts.find('.doubt-content').hide(300);
            }
        })
    });







/*
 *down
 *
*/
$('.down-show').click(function(){
  $('.down-up').show(300);
  $('.m-mask').show();
  $('.down-up>.down-content').css('opacity', '1');
 
});
 $('.m-mask').on('click', function(){
    $(this).hide();
    $('.down-up').hide(300);
     $('.down-up>.down-content').css('opacity', '0');
 });
$('.down-up .close').click(function(){
  $('.down-up').hide(300);
  $('.m-mask').hide();
   $('.down-up>.down-content').css('opacity', '0');
  
});

/* 
 * left
 * ====================================================
*/
    $left=jsui.left_sd;
    if($left>0){
    var leftsd=document.getElementById("leftsd");    
    var H=0,iE6;    
    var Y=leftsd;    
    while(Y){H+=Y.offsetTop;Y=Y.offsetParent};    
    iE6=window.ActiveXObject&&!window.XMLHttpRequest;    
    if(!iE6){    
        window.onscroll=function()    
        {    
            var s=document.body.scrollTop||document.documentElement.scrollTop;   

            if(s>H){
			if(jsui.bd.hasClass('nav-fixed')) {leftsd.className="left nav";if(iE6){leftsd.style.top=(s-H)+"px";}}else{leftsd.className="left affix";if(iE6){leftsd.style.top=(s-H)+"px";}} }   
            else{
						    if(jsui.bd.hasClass('nav-fixed')) {	
							leftsd.className="left top-nav";}else{	leftsd.className="left top";}     
        }    
    }    
	}
	}
/* 
 * comment
 * ====================================================
*/
if (jsui.bd.hasClass('comment-open')) {
    tbquire(['comment'], function(comment) {
        comment.init()
    })
}


/* 
 * page u
 * ====================================================
*/
if (jsui.bd.hasClass('page-template-pagesuser-php')) {
    tbquire(['user'], function(user) {
        user.init()
    })
}


/* 
 * page nav
 * ====================================================
*/
if( jsui.bd.hasClass('page-template-pagesnavs-php') ){

    var titles = ''
    var i = 0
    $('#navs .items h2').each(function(){
        titles += '<li><a href="#'+i+'">'+$(this).text()+'</a></li>'
        i++
    })
    $('#navs nav ul').html( titles )

    $('#navs .items a').attr('target', '_blank')

    $('#navs nav ul').affix({
        offset: {
            top: $('#navs nav ul').offset().top,
            bottom: $('.footer').height() + $('.footer').css('padding-top').split('px')[0]*2
        }
    })


    if( location.hash ){
        var index = location.hash.split('#')[1]
        $('#navs nav li:eq('+index+')').addClass('active')
        $('#navs nav .item:eq('+index+')').addClass('active')
        scrollTo( '#navs .items .item:eq('+index+')' )
    }
    $('#navs nav a').each(function(e){
        $(this).click(function(){
            scrollTo( '#navs .items .item:eq('+$(this).parent().index()+')' )
            $(this).parent().addClass('active').siblings().removeClass('active')
        })
    })
}


/* 
 * page search
 * ====================================================
*/
if( jsui.bd.hasClass('search-results') ){
    var val = $('.site-search-form .search-input').val()
    var reg = eval('/'+val+'/i')
    $('.excerpt h2 a, .excerpt .note').each(function(){
        $(this).html( $(this).text().replace(reg, function(w){ return '<b>'+w+'</b>' }) )
    })
}


/* 
 * search
 * ====================================================
*/
$('.search-show').bind('click', function(){
    $(this).find('.fa').toggleClass('fa-remove')
    jsui.bd.toggleClass('search-on')
    if( jsui.bd.hasClass('search-on') ){
        $('.site-search').find('input').focus()
        jsui.bd.removeClass('m-nav-show')
    }
})

/* 
 * phone
 * ====================================================
*/

jsui.bd.append( $('.site-navbar').clone().attr('class', 'm-navbar') )

$('.m-navbar li.menu-item-has-children').each(function(){
    $(this).append('<i class="fa fa-angle-down faa"></i>')
})

$('.m-navbar li.menu-item-has-children .faa').on('click', function(){
    $(this).parent().find('.sub-menu').slideToggle(300)
})
$('.m-user').on('click', function(){
    jsui.bd.addClass('m-wel-on')
	$('.m-mask').show()
})
$('.m-mask').on('click', function(){
    $(this).hide()
    jsui.bd.removeClass('m-wel-on')
})
$('.m-wel-content ul a').on('click', function(){
    $('.m-mask').hide()
    jsui.bd.removeClass('m-wel-on')
})

$('.m-icon-nav').on('click', function(){
    jsui.bd.addClass('m-nav-show')

    $('.m-mask').show()

    jsui.bd.removeClass('search-on')
    $('.search-show .fa').removeClass('fa-remove') 
})

$('.m-mask').on('click', function(){
    $(this).hide()
    jsui.bd.removeClass('m-nav-show')
})




video_ok()
$(window).resizeend(function(event) {
    video_ok()
});

function video_ok(){
    var cw = $('.article-content').width()
    $('.article-content embed, .article-content video, .article-content iframe').each(function(){
        var w = $(this).attr('width')||0,
            h = $(this).attr('height')||0
        if( cw && w && h ){
            $(this).css('width', cw<w?cw:w)
            $(this).css('height', $(this).width()/(w/h))
        }
    })
}






/* functions
 * ====================================================
 */
function scrollTo(name, add, speed) {
    if (!speed) speed = 300
    if (!name) {
        $('html,body').animate({
            scrollTop: 0
        }, speed)
    } else {
        if ($(name).length > 0) {
            $('html,body').animate({
                scrollTop: $(name).offset().top + (add || 0)
            }, speed)
        }
    }
}


function is_name(str) {
    return /.{2,12}$/.test(str)
}
function is_url(str) {
    return /^((http|https)\:\/\/)([a-z0-9-]{1,}.)?[a-z0-9-]{2,}.([a-z0-9-]{1,}.)?[a-z0-9]{2,}$/.test(str)
}
function is_qq(str) {
    return /^[1-9]\d{4,13}$/.test(str)
}
function is_mail(str) {
    return /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test(str)
}


$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


/* 
 * phone
 * ====================================================
*/
function pjax_done() {

    var imgcode = $(".c_code");
    imgcode.click(function () {
        this.src = jsui.www + "include/lib/checkcode.php?" + new Date().getTime();
    });
    /*
     * 表情
     */
    var m = $(".comment_face_btn");
    var n = $("#Face");
    //n.hide();
    m.click(function () {
        n.slideToggle();
    });
    $("#Face a").bind({
        "click": function () {
            var a = $(this).attr("data-title");
            obj = $("#comment").get(0);
            if (document.selection) {
                obj.focus();
                var b = document.selection.createRange();
                b.text = a;
            } else {
                if (typeof obj.selectionStart === "number" && typeof obj.selectionEnd === "number") {
                    obj.focus();
                    var c = obj.selectionStart;
                    var d = obj.selectionEnd;
                    var e = obj.value;
                    obj.value = e.substring(0, c) + a + e.substring(d, e.length)
                } else {
                    obj.value += a;
                }
            }
        }
    });


    if (Number(jsui.iasnum)) {
        require(['ias.min'], function (ias) {
            $.ias({
                triggerPageThreshold: jsui.iasnum ? Number(jsui.iasnum) + 1 : 5,
                history: false,
                container: '.content',
                item: '.excerpt',
                pagination: '.pagenavi',
                next: '.nextpages',
                loader: '<div class="pagination-loading"><img src="' + jsui.uri + '/images/loading.gif"><a>\u6b63\u5728\u52a0\u8f7d\u002e\u002e\u002e</a></div>',
                trigger: 'More',
                onRenderComplete: function () {
                    pjax_done();
                }
            });
        })
    }
    $("#comment").focus(function () {
        //$(".comment_info").html("Ctrl+Enter快速提交").fadeIn(2500);
    })

}
function postcomment() {
    var posterflag = false;
    if (posterflag) return;
    posterflag = true
    var a = $("#commentform").serialize();
    $(".comment_info").html('<img src="' + jsui.uri + 'static/img/loading.gif">');
    var comment_url = blog_url + 'index.php?action=addcom';
    $.ajax({
        type: 'POST',
        url: comment_url,
        data: a,
        success: function (a) {
            posterflag = false;
            //评论失败：您提交评论的速度太快了，请稍后再发表评论
            var c = /<div class=\"main\">[\r\n]*<p>(.*?)<\/p>/i;
            c.test(a) ? ($(".comment_info").html(a.match(c)[1]).show().fadeIn(2500)) : (c = $("input[name=pid]").val(), cancelReply(), $("[name=comment]").val(""), $(".commentlist").html($(a).find(".commentlist").html()), 0 != c ? (a = window.opera ? "CSS1Compat" == document.compatMode ? $("html") : $("body") : $("html,body"), a.animate({
                scrollTop: $("#comment-" + c).offset().top - 250
            }, "normal", function () {
                $(".comment_info").html("").fadeIn(2500);
            })) : (a = window.opera ? "CSS1Compat" == document.compatMode ? $("html") : $("body") : $("html,body"), a.animate({
                scrollTop: $(".commentlist").offset().top - 250
            }, "normal", function () {
                $(".comment_info").html("").fadeIn(2500);
            })));
            var imgcode = $(".c_code");
            imgcode.click();
            pjax_done();
        }
    })
    posterflag = false;
    return !1
}
pjax_done()
if (document.body.offsetWidth >= 600 && jsui.is_pjax == 1) {
    require(['pjax'], function (pjax) {
        $(document).pjax('a[target!=_blank]', '.pjax', {fragment: '.pjax', timeout: 8000});
        $(document).on('submit', 'form', function (event) {
            $.pjax.submit(event, '.content-wrap', {
                fragment: '.content-wrap',
                timeout: 6000
            })
        });
        $(document).on('pjax:send', function () { //pjax链接点击后显示加载动画；
            $(".pjax_loading").css("display", "block");
        });
        $(document).on('pjax:complete', function () { //pjax链接加载完成后隐藏加载动画；
            $(".pjax_loading").css("display", "none");
            pjax_done();
            if ($(".article-title").length) {
                $(".container")["addClass"]("single");
            } else {
                $(".container")["removeClass"]("single")
            }
            if ($(".user-main").length || $("#setting").length) {
                $(".sidebar").css("display", "none");
            } else {
                $(".sidebar").css("display", "block");
            }
            if ($(".focusbox-wrapper").length) {
                $(".focusbox-wrapper").css("display", "none");
            }
        })
    });
}

//评论内图片缩放
$(function () {
        $(".comt-main-img").commentImg({
			imgNavBox:'.photos-thumb', 
			imgViewBox:'.photo-viewer'
        });
    });


    function grin(tag) {
    	var myField;
    	tag = ' ' + tag + ' ';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
    		myField = document.getElementById('comment');
    	} else {
    		return false;
    	}
    	if (document.selection) {
    		myField.focus();
    		sel = document.selection.createRange();
    		sel.text = tag;
    		myField.focus();
    	}
    	else if (myField.selectionStart || myField.selectionStart == '0') {
    		var startPos = myField.selectionStart;
    		var endPos = myField.selectionEnd;
    		var cursorPos = endPos;
    		myField.value = myField.value.substring(0, startPos)
    					  + tag
    					  + myField.value.substring(endPos, myField.value.length);
    		cursorPos += tag.length;
    		myField.focus();
    		myField.selectionStart = cursorPos;
    		myField.selectionEnd = cursorPos;
    	}
    	else {
    		myField.value += tag;
    		myField.focus();
    	}
    }
	
	
	//表情颜色弹窗
$(document).ready(function () {   
	$("#comment-smiley").click(function(){   
		$("#smiley").toggle(500);   
	});  
	$("#font-color").click(function(){   
		$("#fontcolor").toggle(500);   
	});   
});   
 //qq获取资料


$("#qqhao").blur(function() {
	$("#qqhao").attr("disabled", false);
	$("#error1").html('<img src="' + pjaxtheme + 'static/img/loading.gif">');
	$.ajax({
		url: api_url + "api/nic.php?qq=" + $("#qqhao").val(),
		type: "GET",
		dataType: "jsonp",
		success: function(a) {
			if (a.name) {
				$("#error1").hide();
				$("#author").val(a.name);
				$("#email").val($("#qqhao").val() + "@qq.com");
				$("#url").val("http://user.qzone.qq.com/" + $("#qqhao").val());
				$("#qqhao").attr("disabled", true)
			} else {
				$("#error1").hide();
				$(".comment-form-qq").removeAttr("disabled");
				$("#error1").html('<img src="' + pjaxtheme + 'static/img/error.png"> qq账号错误').show().fadeOut(4E3)
			}
		},
		error: function(a, b, c) {
			$("#error1").hide();
			$(".comment-form-qq").removeAttr("disabled");
			$("#error1").html('<img src="' + pjaxtheme + 'static/img/error.png"> qq账号错误').show().fadeOut(4E3)
		}
	})
});

//私密评论
function addNumber(a) {
	document.getElementById("comment").value += a
}

//判断收录
$(function () {
	$.getJSON('https://api.yum6.cn/baidu/query.php?url='+window.location.href, function(json, textStatus) {
		if (json.state == 1) {
			$('#ae_bdcx').html('本文已被百度收录！');
			$("#ae_bdcx").attr('href','https://www.baidu.com/s?wd='+window.location.href); 
		}else{
			$('#ae_bdcx').html('提交收录');
			$('#ae_bdcx').css('color','#ff0000');
			$('#ae_bdcx').attr('href','http://zhanzhang.baidu.com/sitesubmit/index?sitename='+window.location.href);
			var bp = document.createElement('script');
			var curProtocol = window.location.protocol.split(':')[0];
			if (curProtocol === 'https') {bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';} 
			else {bp.src = 'http://push.zhanzhang.baidu.com/push.js';}
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(bp, s);
		}
	});
});

//图片图床上传
		$(document).ready(function() {
			$('.picurl > input').bind('focus mouseover',
			function() {
				if (this.value) {
					this.select()
				}
			});
			$("input[type='file']").change(function(e) {
				images_upload(this.files)
			});
			var obj = $('body');
			obj.on('dragenter',
			function(e) {
				e.stopPropagation();
				e.preventDefault()
			});
			obj.on('dragover',
			function(e) {
				e.stopPropagation();
				e.preventDefault()
			});
			obj.on('drop',
			function(e) {
				e.preventDefault();
				images_upload(e.originalEvent.dataTransfer.files)
			})
		});
		var images_upload = function(files) {
			var comt = document.getElementById('comment') || 0;
			var comt_dis =document.getElementById("comt_file");
			var flag = 0;
			$(files).each(function(key, value) {
				$('#comt_ins_err')[0].innerHTML = '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> 上传中...';
				image_form = new FormData();
				image_form.append('file', value);
				console.log(image_form);
				$.ajax({
					url: jsui.uri + '/inc/sinaimg.php?type=multipart',
					type: 'POST',
					data: image_form,
					mimeType: 'multipart/form-data',
					contentType: false,
					cache: false,
					processData: false,
					dataType: 'json',
					success: function(data) {
						if (data.code == '200') {
							flag++;
							if (typeof data.pid != 'null') {
								comt.value += '[img]https://ww2.sinaimg.cn/large/' + data['pid']+ '[/img]';
								$('#comt_ins_err')[0].innerHTML = '<i class="fa fa-check-circle"></i> 上传成功';
                                comt_dis.onclick = '';
						        $('#comt_file').css('color','#d8d8d8');
							   
							}

						} else {
							alert(data.msg);
							$('#comt_ins_err')[0].innerHTML = '<i class="fa fa-exclamation-triangle"></i> 上传失败'
						}
					},
					error: function(XMLResponse) {
						$('#comt_ins_err')[0].innerHTML = '<i class="fa fa-exclamation-triangle"></i> 上传失败';
						alert("error:" + XMLResponse.responseText)
					}
				})
			})
		};
		document.onpaste = function(e) {
			var data = e.clipboardData;
			for (var i = 0; i < data.items.length; i++) {
				var item = data.items[i];
				if (item.kind == 'file' && item.type.match(/^image\//i)) {
					var blob = item.getAsFile();
					images_upload(blob)
				}
			}
		}
		
		
function openShare($url) {
	return window.open($url, "newwindow")
}
function shareToWeibo(url, title, cover, desc, summary) {
	var re = /http:[/]{2}[a-zA-Z0-9.%=/]{1,}[.](jpg|png)/g;
	var content = $(".context").html();
	if(re.test(content)){
		cover = content.match(re)[0];
	}
	var url = "http://service.weibo.com/share/share.php?url=" + url + "&appkey=1148356070&title=" + title + "&searchPic=true&pic=" + cover + "&rnd=" + ((new Date()) * 1) + "";
	openShare(url)
}

function shareToQzone(url, title, cover, desc, summary) {
	var re = /http:[/]{2}[a-zA-Z0-9.%=/]{1,}[.](jpg|png)/g;
	var content = $(".context").html();
	if(re.test(content)){
		cover = content.match(re)[0];
	}
	var url = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=" + url + "&title=" + title + "&desc=" + title + "&pics=" + cover + "&summary=&site=Fish";
	openShare(url)
}

function shareToQQ(url, title, cover, desc, summary) {
	var re = /http:[/]{2}[a-zA-Z0-9.%=/]{1,}[.](jpg|png)/g;
	var content = $(".context").html();
	if(re.test(content)){
		cover = content.match(re)[0];
	}
	var url = "http://connect.qq.com/widget/shareqq/index.html?url=" + url + "&title=" + title + "&desc=&summary=&site=Fish";
	openShare(url)
}
//公告栏滚动条
function clock(){
     $("#callboard ul").animate({marginTop:"-24px"},500,function(){
          $(this).css({marginTop:"2px"}).find("li:first").appendTo(this);                                                         
     })
}
$(function(){
      var a = setInterval("clock()",5000);
      $("#callboard").hover(function(){
          clearInterval(a);                          
      },function(){
          a = setInterval("clock()",5000);
      })
})

function hidetp(){
    if($(".speedbar").css("display")=='block'){
       $(".speedbar").css("display","none");
    }else{
       $(".speedbar").css("display","block");
    }
}
 /** ToolTip.js **/
$(function() {
	$('a').not('.close_login_box').each(function(b) {
		if (this.title) {
			var c = this.title;
			var a = 30;
			$(this).mouseover(function(d) {
				this.title = "";
				$("body").append('<div id="tooltip">' + c + "</div>");
				$("#tooltip").css({
					left: (d.pageX + a) + "px",
					top: d.pageY + "px",
					opacity: "0.8"
				}).show(250)
			}).mouseout(function() {
				this.title = c;
				$("#tooltip").remove()
			}).mousemove(function(d) {
				$("#tooltip").css({
					left: (d.pageX + a) + "px",
					top: d.pageY + "px"
				})
			})
		}
	})
		$('span').not('.close_login_box').each(function(b) {
		if (this.title) {
			var c = this.title;
			var a = 30;
			$(this).mouseover(function(d) {
				this.title = "";
				$("body").append('<div id="tooltip">' + c + "</div>");
				$("#tooltip").css({
					left: (d.pageX + a) + "px",
					top: d.pageY + "px",
					opacity: "0.8"
				}).show(250)
			}).mouseout(function() {
				this.title = c;
				$("#tooltip").remove()
			}).mousemove(function(d) {
				$("#tooltip").css({
					left: (d.pageX + a) + "px",
					top: d.pageY + "px"
				})
			})
		}
	})
});

  /*
 * 单页面标题框
*/
    $(".pagemenu li").each(function() {
        var a = $(".content h1.article-title").text();
        if ($(this).children("a").text() == a) {
            $(this).addClass("active");
        }
    });

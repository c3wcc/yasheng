/*m-nav*/
!function(a){"use strict";function b(b,d){this.$el=a(b),this.opt=a.extend(!0,{},c,d),this.init(this)}var c={};b.prototype={init:function(a){a.initToggle(a),a.initDropdown(a)},initToggle:function(b){a(document).on("click",function(c){var d=a(c.target);d.closest(b.$el.data("sidenav-toggle"))[0]?(b.$el.toggleClass("show"),a("body").toggleClass("sidenav-no-scroll"),b.toggleOverlay()):d.closest(b.$el)[0]||(b.$el.removeClass("show"),a("body").removeClass("sidenav-no-scroll"),b.hideOverlay())})},initDropdown:function(b){b.$el.on("click","[data-sidenav-dropdown-toggle]",function(b){var c=a(this);c.next("[data-sidenav-dropdown]").slideToggle("fast"),c.find("[data-sidenav-dropdown-icon]").toggleClass("show"),b.preventDefault()})},toggleOverlay:function(){var b=a("[data-sidenav-overlay]");b[0]||(b=a('<div data-sidenav-overlay class="sidenav-overlay"/>'),a("body").append(b)),b.fadeToggle("fast")},hideOverlay:function(){a("[data-sidenav-overlay]").fadeOut("fast")}},a.fn.sidenav=function(c){return this.each(function(){a.data(this,"sidenav")||a.data(this,"sidenav",new b(this,c))})}}(window.jQuery);
$('#sidenav').sidenav();
/*返回*/
$(document).ready(function(){
    $(window).scroll(function() { if ($(window).scrollTop() >= 300) {  $('.ScrollUp a').fadeIn(600);  } else { $('.ScrollUp a').fadeOut(600); }  });
    $('.ScrollUp a').hover(function() {  $(this).addClass('hover'); }, function() {  $(this).removeClass('hover'); });
    $('.upper a').click(function() { $("html,body").animate({ scrollTop: 0  }, 500); });
    $('.lower a').click(function() { $("html,body").animate({ scrollTop: $(document).height() }, 500); });
});
/*延迟加载*/
$(document).ready(function(){
     $("img.lazy").lazyload({effect: "fadeIn"});
});
/*搜索*/
jQuery(document).ready(function ($){
//弹出搜索
$('.so-search').click(function (){
	$('.so-search-bar').toggle('fast');
	$('body').one('click', function (){$('.so-search-bar').hide('fast');});
	return false;
});
$('.so-search-bar').click(function(){return false;});
});
/*分页*/
$(document).ready(function(){
    $("div.new-page").jPages({
        containerID : "newcontent"
    });
});
//点赞
$(document).on('click', '.slzanpd', function() {
	var a = $(this),
		id = a.data('slzanpd');
	if (slzanpd_check(id)) {
		alert('您已赞过了')
	} else {
		$(this).addClass('current');
		$.post('', {
			plugin: 'slzanpd',
			action: 'slzan',
			id: id
		}, function(b) {
			a.find('span').html(b)
		})
	}
});

function slzanpd_check(id) {
	return new RegExp('slzanpd_' + id + '=true').test(document.cookie)
}
$('[data-slzanpd]').each(function() {
	var a = $(this),
		id = a.data('slzanpd');
	if (slzanpd_check(id)) {
		slzanpd_(a)
	} else {
		a.attr('title', '点赞')
	}
});

function slzanpd_(a) {
	a.css('current')
}
function btn_click(btn, on, off) {
	flag = true;
	$(btn).click(function() {
		$(btn).prop('class', (flag = !flag) ? on : off)
	})
}!
function() {
	$('[data-slzanpd]').each(function() {
		var a = $(this),
			id = a.data('slzanpd');
		if (slzanpd_check(id)) {
			$(this).addClass('current')
		}
	})
}();
function menu_click(a, b, d) {
	flag = !0;
	if (a = document.getElementById(a)) a.onclick = function() {
		a.setAttribute("class", (flag = !flag) ? b : d)
	}
}
/*高亮*/
$( document ).ready(function() {
	$("pre").addClass("prettyprint linenums");
	prettyPrint();
});
// 表情
function embedSmiley() {
    "none" == $(".smiley-box").css("display") ? $(".smiley-box").slideDown(200) : $(".smiley-box").slideUp(200)
}
function grin(a) {
    var b;
    a = " " + a + " ";
    if (document.getElementById("comment") && "textarea" == document.getElementById("comment").type) b = document.getElementById("comment");
    else return !1;
    if (document.selection) b.focus(), sel = document.selection.createRange(), sel.text = a, b.focus();
    else if (b.selectionStart || "0" == b.selectionStart) {
        var c = b.selectionEnd,
            d = c;
        b.value = b.value.substring(0, b.selectionStart) + a + b.value.substring(c, b.value.length);
        d += a.length;
        b.focus();
        b.selectionStart = d;
        b.selectionEnd = d
    } else b.value += a, b.focus()
}
/*签到*/
function addNumber(a) {
	document.getElementById("comment").value += a
}
//QQ评论
jQuery(document).ready(function ($){
Lotto = {};
Lotto.comment = function(){
$("#qq").blur(function(){
		 	$('#qq').attr("sl",true);
		 	$("#ajaxloading").html('正在获取QQ信息..');
	    	$.getJSON('../content/templates/meta/inc/qq.php?qq='+$('#qq').val()+'&callback=?', function(q){
	    		if(q.name){
	    			$('#comname').val(q.name);
		    		$('#commail').val($('#qq').val()+'@qq.com');
		    		$('#comu').val('http://user.qzone.qq.com/'+$('#qq').val());
		    		$('#qq').attr("disabled",false);
		    		$("#ajaxloading").hide();
	    		}else{
	    			$("#ajaxloading").hide();
	    			$("#ajaxloading").html('qq账号错误').show().fadeOut(4000);
		   			$('#qq').attr("sl",false);
	    		}
	    	});
		});
	
}
Lotto.run = function(){this.comment();};
Lotto.run();
});
//Ajax评论
$("#comment_submit").click(function(event){
    event.preventDefault();
	doSubmitComment();
});
function doSubmitComment(){
	var comname = $.trim( $("#commentform input[name=comname]").val() ),
		commail = $.trim( $("#commentform input[name=commail]").val() ),
		comment = $.trim( $("#commentform textarea[name=comment]").val() ),		
		tip = $("#ajaxloading"),
		btn = $("#comment_submit");
	if(($("#commentform input[name=comname]").length>0) && !comname){
		tip.html("请填写您的昵称！");
	}else if(($("#commentform input[name=commail]").length>0) && !commail){
		tip.html("请填写您的邮箱！");
	}else if(($("#commentform input[name=commail]").length>0) &&  !( /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(commail) ) ){
		tip.html("请填写正确的邮箱！");
	}else if(!comment){
		tip.html("请填写评论内容！");
	}else{
		$.ajax({
			url: $("#commentform").attr('action'),
			type: 'post',
			data: $("#commentform").serialize(),
			cache: false,
			beforeSend: function(){
				tip.html("提交中...");
				btn.attr("disabled",true);
			},
			success: function(res){
				btn.attr("disabled",false);
				var pattern = /<div class="main">[\r\n]+<p>(.*?)<\/p>/;
				if(pattern.test(res)) {
					res = res.match(pattern);
					tip.html(res[1]);
				}else{
					window.location.href = window.location.href.split("#")[0];
				}
			},error: function(){
				btn.attr("disabled",false);
			}
		});
	};
};

	
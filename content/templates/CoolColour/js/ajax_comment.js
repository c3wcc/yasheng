(function(q) {
	var k = function(b, c) {
		var h,
		g,
		j,
		i,
		a;
		j = b & 2147483648;
		i = c & 2147483648;
		h = b & 1073741824;
		g = c & 1073741824;
		a = (b & 1073741823) + (c & 1073741823);
		return h & g ? a ^ 2147483648 ^ j ^ i: h | g ? a & 1073741824 ? a ^ 3221225472 ^ j ^ i: a ^ 1073741824 ^ j ^ i: a ^ j ^ i
	},
	l = function(b, c, h, g, j, i, a) {
		b = k(b, k(k(c & h | ~c & g, j), a));
		return k(b << i | b >>> 32 - i, c)
	},
	m = function(b, c, h, g, j, i, a) {
		b = k(b, k(k(c & g | h & ~g, j), a));
		return k(b << i | b >>> 32 - i, c)
	},
	n = function(b, c, h, g, j, i, a) {
		b = k(b, k(k(c ^ h ^ g, j), a));
		return k(b << i | b >>> 32 - i, c)
	},
	o = function(b, c, h, g, j, i, a) {
		b = k(b, k(k(h ^ (c | ~g), j), a));
		return k(b << i | b >>> 32 - i, c)
	},
	p = function(b) {
		var c = "",
		h = "",
		g;
		for (g = 0; g <= 3; g++) h = b >>> g * 8 & 255,
		h = "0" + h.toString(16),
		c += h.substr(h.length - 2, 2);
		return c
	};
	q.extend({
		md5: function(b) {
			var c = [],
			h,
			g,
			j,
			i,
			a,
			d,
			e,
			f,
			c = b.replace(/\x0d\x0a/g, "\n"),
			b = "";
			for (h = 0; h < c.length; h++) g = c.charCodeAt(h),
			g < 128 ? b += String.fromCharCode(g) : (g > 127 && g < 2048 ? b += String.fromCharCode(g >> 6 | 192) : (b += String.fromCharCode(g >> 12 | 224), b += String.fromCharCode(g >> 6 & 63 | 128)), b += String.fromCharCode(g & 63 | 128));
			c = b;
			b = c.length;
			h = b + 8;
			g = ((h - h % 64) / 64 + 1) * 16;
			j = Array(g - 1);
			for (a = i = 0; a < b;) h = (a - a % 4) / 4,
			i = a % 4 * 8,
			j[h] |= c.charCodeAt(a) << i,
			a++;
			j[(a - a % 4) / 4] |= 128 << a % 4 * 8;
			j[g - 2] = b << 3;
			j[g - 1] = b >>> 29;
			c = j;
			a = 1732584193;
			d = 4023233417;
			e = 2562383102;
			f = 271733878;
			for (b = 0; b < c.length; b += 16) h = a,
			g = d,
			j = e,
			i = f,
			a = l(a, d, e, f, c[b + 0], 7, 3614090360),
			f = l(f, a, d, e, c[b + 1], 12, 3905402710),
			e = l(e, f, a, d, c[b + 2], 17, 606105819),
			d = l(d, e, f, a, c[b + 3], 22, 3250441966),
			a = l(a, d, e, f, c[b + 4], 7, 4118548399),
			f = l(f, a, d, e, c[b + 5], 12, 1200080426),
			e = l(e, f, a, d, c[b + 6], 17, 2821735955),
			d = l(d, e, f, a, c[b + 7], 22, 4249261313),
			a = l(a, d, e, f, c[b + 8], 7, 1770035416),
			f = l(f, a, d, e, c[b + 9], 12, 2336552879),
			e = l(e, f, a, d, c[b + 10], 17, 4294925233),
			d = l(d, e, f, a, c[b + 11], 22, 2304563134),
			a = l(a, d, e, f, c[b + 12], 7, 1804603682),
			f = l(f, a, d, e, c[b + 13], 12, 4254626195),
			e = l(e, f, a, d, c[b + 14], 17, 2792965006),
			d = l(d, e, f, a, c[b + 15], 22, 1236535329),
			a = m(a, d, e, f, c[b + 1], 5, 4129170786),
			f = m(f, a, d, e, c[b + 6], 9, 3225465664),
			e = m(e, f, a, d, c[b + 11], 14, 643717713),
			d = m(d, e, f, a, c[b + 0], 20, 3921069994),
			a = m(a, d, e, f, c[b + 5], 5, 3593408605),
			f = m(f, a, d, e, c[b + 10], 9, 38016083),
			e = m(e, f, a, d, c[b + 15], 14, 3634488961),
			d = m(d, e, f, a, c[b + 4], 20, 3889429448),
			a = m(a, d, e, f, c[b + 9], 5, 568446438),
			f = m(f, a, d, e, c[b + 14], 9, 3275163606),
			e = m(e, f, a, d, c[b + 3], 14, 4107603335),
			d = m(d, e, f, a, c[b + 8], 20, 1163531501),
			a = m(a, d, e, f, c[b + 13], 5, 2850285829),
			f = m(f, a, d, e, c[b + 2], 9, 4243563512),
			e = m(e, f, a, d, c[b + 7], 14, 1735328473),
			d = m(d, e, f, a, c[b + 12], 20, 2368359562),
			a = n(a, d, e, f, c[b + 5], 4, 4294588738),
			f = n(f, a, d, e, c[b + 8], 11, 2272392833),
			e = n(e, f, a, d, c[b + 11], 16, 1839030562),
			d = n(d, e, f, a, c[b + 14], 23, 4259657740),
			a = n(a, d, e, f, c[b + 1], 4, 2763975236),
			f = n(f, a, d, e, c[b + 4], 11, 1272893353),
			e = n(e, f, a, d, c[b + 7], 16, 4139469664),
			d = n(d, e, f, a, c[b + 10], 23, 3200236656),
			a = n(a, d, e, f, c[b + 13], 4, 681279174),
			f = n(f, a, d, e, c[b + 0], 11, 3936430074),
			e = n(e, f, a, d, c[b + 3], 16, 3572445317),
			d = n(d, e, f, a, c[b + 6], 23, 76029189),
			a = n(a, d, e, f, c[b + 9], 4, 3654602809),
			f = n(f, a, d, e, c[b + 12], 11, 3873151461),
			e = n(e, f, a, d, c[b + 15], 16, 530742520),
			d = n(d, e, f, a, c[b + 2], 23, 3299628645),
			a = o(a, d, e, f, c[b + 0], 6, 4096336452),
			f = o(f, a, d, e, c[b + 7], 10, 1126891415),
			e = o(e, f, a, d, c[b + 14], 15, 2878612391),
			d = o(d, e, f, a, c[b + 5], 21, 4237533241),
			a = o(a, d, e, f, c[b + 12], 6, 1700485571),
			f = o(f, a, d, e, c[b + 3], 10, 2399980690),
			e = o(e, f, a, d, c[b + 10], 15, 4293915773),
			d = o(d, e, f, a, c[b + 1], 21, 2240044497),
			a = o(a, d, e, f, c[b + 8], 6, 1873313359),
			f = o(f, a, d, e, c[b + 15], 10, 4264355552),
			e = o(e, f, a, d, c[b + 6], 15, 2734768916),
			d = o(d, e, f, a, c[b + 13], 21, 1309151649),
			a = o(a, d, e, f, c[b + 4], 6, 4149444226),
			f = o(f, a, d, e, c[b + 11], 10, 3174756917),
			e = o(e, f, a, d, c[b + 2], 15, 718787259),
			d = o(d, e, f, a, c[b + 9], 21, 3951481745),
			a = k(a, h),
			d = k(d, g),
			e = k(e, j),
			f = k(f, i);
			return (p(a) + p(d) + p(e) + p(f)).toLowerCase()
		}
	})
})(jQuery);
jQuery(function() {
	//点击发布评论
	$(".comm_tijiao").click(function(){
	$(".comm_infobox").fadeIn('slow');
	});
	$(".comm_close,#comment_submit").click(function(){
	$(".comm_infobox").fadeOut('slow');
	});

	//清空输入
	$(".comm_rest").click(function(){
	$("#comname,#commail,#comurl,#comment").attr("value","");
	});

	//鼠标离开隐藏表情
	$(".smilebg").mouseleave(function(){
	$(".smilebg").slideUp(200);
	});
	function ajaxComment(){
		var queryString = jQuery('#commentform').serialize(), url = jQuery('#commentform').attr('action');
		
		jQuery.ajax({
			type:'POST',
			url:url,
			data:queryString,
			cache:false,
			beforeSend:function(){
				jQuery('#cmt-loading').html('<span id="ajax_loading"><i class="fa fa-bell-o fa-2 mar-r-10"></i>提交中…</span>').show();
				jQuery('#comment').attr('readonly',true);
			},
			success:function(d){
				var pattern = /<div class="main">[\r\n]+<p>(.*?)<\/p>/;
				if(pattern.test(d)) {
					d = d.match(pattern);
					jQuery('#cmt-loading').html('<i class="fa fa-bell-o fa-2 mar-r-10"></i>'+d[1]);
					jQuery('#comment').focus();
     jQuery('#cmt-loading').delay(3000).fadeOut(3000);
				} else {
					var pid = jQuery('#comment-pid').val(), isChild = (pid != '0');
					if(isChild) {
						var s = '<div class="comment-children">';
							s += '<div class="avatar"><img alt="'+ jQuery.trim(jQuery('input[name="comname"]').val()) +'" src="http://cn.gravatar.com/avatar/' + jQuery.md5(jQuery.trim(jQuery('input[name="commail"]').val())) + '?s=36&d=identicon&r=g"></div>';
						s += '<div class="comment-info"><span class="poster"><i class="fa fa-user mar-r-4 green"></i>' + jQuery.trim(jQuery('input[name="comname"]').val()) + '</span><span id="ajax_ok"><i class="fa fa-exclamation-circle mar-r-4"></i>恭喜发表成功，感谢您的支持！</span><div class="comment-content">'+ jQuery.trim(jQuery('#comment').val().replace(/\[S(\d+)\]/g,'<img src="/content/templates/CoolColour/images/face/$1.gif">').replace(/\[code\]([\s\S]*?)\[\/code\]/g,'<pre0>$1</pre>')) + '</div></div>';
					} else {
						var s = '<div class="comment">';
							s += '<div class="avatar"><img alt="'+ jQuery.trim(jQuery('input[name="comname"]').val()) +'" src="http://cn.gravatar.com/avatar/' + jQuery.md5(jQuery.trim(jQuery('input[name="commail"]').val())) + '?s=48&d=identicon&r=g"></div>';
						s += '<div class="comment-info"><span class="poster"><i class="fa fa-user mar-r-4 green"></i>' + jQuery.trim(jQuery('input[name="comname"]').val()) + '</span><span id="ajax_ok"><i class="fa fa-exclamation-circle mar-r-4"></i>恭喜发表成功，感谢您的支持！</span><div class="comment-content">'+ jQuery.trim(jQuery('#comment').val().replace(/\[S(\d+)\]/g,'<img src="/content/templates/CoolColour/images/face/$1.gif">').replace(/\[code\]([\s\S]*?)\[\/code\]/g,'<pre>$1</pre>')) + '</div></div>';
					}
					cancelReply();
					var body = (window.opera) ? (document.compatMode == "CSS1Compat" ? jQuery('html') : jQuery('body')) : jQuery('html,body');
					if(isChild) {
						jQuery('#comment-'+pid).append(s);
						body.animate({scrollTop: jQuery('#comment-'+pid).find('.comment-children').offset().top},"normal");
					} else {
						jQuery('.comm_charu').before(s);
						body.animate({scrollTop: jQuery('.comm_charu').prev().offset().top}, "normal");
					}
					jQuery('#comment').val("");
					jQuery('#cmt-loading').hide();
				}
				jQuery('#comment').removeAttr('readonly');
			}
		});
	}
	jQuery('#comment_submit').click(function(){ajaxComment();return false;});
});
//ajax评论翻页
jQuery(document).ready(function($) {
    $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
    $(document).on('click', '.commt_box #pagenavi a',function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            beforeSend: function() {
                $('.commt_box #pagenavi').remove();
                $('.comment-list').remove();
                $('#cmt-loading').html('<span id="ajax_loading"><i class="fa fa-bell-o fa-2 mar-r-10"></i>加载中,请稍等片刻…</span>').show();                
            },
            dataType: "html",
            success: function(out) {
                result = $(out).find('.comment-list');
                nextlink = $(out).find('.commt_box #pagenavi');
                $('#cmt-loading').slideUp(550);
                $('.comm_charu').after(result.fadeIn(800));
                $('.comment-list').after(nextlink);
                $("html,body").stop(true);$("html,body").animate({scrollTop: $(".comment-header").offset().top-50}, 1000);
                $(".comment .avatar img").lazyload({threshhold:100,effect:"fadeIn"})
            }
        })
    })
});


//评论工具栏
function tool_img() {
	var URL = prompt('请输入图片的地址（禁止发违法图片）:','http://');
	if (URL) {
		document.getElementById('comment').value = document.getElementById('comment').value + '[img]' + URL + '[/img]';
	}
}
function tool_link() {
	var URL = prompt('请输入链接地址:','http://');
	if (URL) {
		document.getElementById('comment').value = document.getElementById('comment').value + '[link]' + URL + '[/link]';
	}
}
function tool_code() {
		document.getElementById('comment').value = document.getElementById('comment').value + '[code]代码内容[/code]';
}
function tool_qiand() {
 var myDate = new Date();
 var ShiJian = myDate.toLocaleString();
		document.getElementById('comment').value = document.getElementById('comment').value + '[code]签到成功！签到时间：'+ ShiJian + '，每日签到，生活更精彩！[/code]';
  $('.tool_qiand').hide();
}
function tool_zan() {
	document.getElementById('comment').value = document.getElementById('comment').value + '[code][S19]好羞射，文章真的好赞啊，顶博主！[/code]';
	$('.tool_zan').hide();
}
function tool_cai() {
		document.getElementById('comment').value = document.getElementById('comment').value + '[code][S8]有点看不懂哦，希望下次写的简单易懂一点！[/code]';
  $('.tool_cai').hide();
}
function tool_bq() {
	if($('.smilebg').css('display')=='none'){
		$('.smilebg').slideDown(200)
	}else{
		$('.smilebg').slideUp(200)
	}
}
//表情所用脚本
function grin(tag) {
    	var myField;
    	tag = '' + tag + '';
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
function commentReply(pid,c){
	var response = document.getElementById('comment-post');
	document.getElementById('comment-pid').value = pid;
	document.getElementById('cancel-reply').style.display = '';
	c.parentNode.parentNode.appendChild(response);
}
function cancelReply(){
	var commentPlace = document.getElementById('comment-place'),response = document.getElementById('comment-post');
	document.getElementById('comment-pid').value = 0;
	document.getElementById('cancel-reply').style.display = 'none';
	commentPlace.appendChild(response);
}
$.ajaxSetup({cache: true}); //开启缓存


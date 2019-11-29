var click = device.mobile() ? 'touchstart' : 'click';
$(function() {
	// 侧边栏操作按钮
		$(document).on(click, '#guide', function() {
		$(this).toggleClass('toggled');
		$('#sidebar').toggleClass('toggled');
	});
	
	// 侧边栏二级菜单
	$(document).on('click', '.sub-menu a', function() {
		$(this).next().slideToggle(200);
		$(this).parent().toggleClass('toggled');
	});
	// 个人资料
	$(document).on('click', '.s-profile a', function() {
		$(this).next().slideToggle(200);
		$(this).parent().toggleClass('toggled');
	});

	// Waves初始化
	Waves.displayEffect();
	// 滚动条初始化
	$('#sidebar').mCustomScrollbar({
		theme: 'minimal-dark',
		scrollInertia: 100,
		axis: 'yx',
		mouseWheel: {
			enable: true,
			axis: 'y',
			preventDefault: true
		}
	});
});
// iframe高度自适应
function changeFrameHeight(ifm) {
	ifm.height = document.documentElement.clientHeight - 118;
}
function resizeFrameHeight() {
	$('.tab_iframe').css('height', document.documentElement.clientHeight - 118);
	$('md-tab-content').css('left', '0');
}

function fullPage() {
	if ($.util.supportsFullScreen) {
		if ($.util.isFullScreen()) {
			$.util.cancelFullScreen();
		} else {
			$.util.requestFullScreen();
		}
	} else {
		alert("当前浏览器不支持全屏 API，请更换至最新的 Chrome/Firefox/Safari 浏览器或通过 F11 快捷键进行操作。");
	}
}
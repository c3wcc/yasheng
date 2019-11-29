<?php

/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(
		//主题公告
		'myhk' => array(
		'type' => 'radio',
		'name' => '主题公告',
		'description' => 'Colorful-Pjax明月浩空定制模板V2.6，有问题请联系：',
		'values' => array(
			'1' => 'QQ：972622982',
		),
		'default' => '1',
		),
		'pjax' => array(
		'type' => 'radio',
		'name' => '全站Pjax无刷新',
		'description' => '关闭Pjax可有效解决部分JS冲突',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
		),
		'logo' => array(
        'type' => 'image',
        'name' => '导航圆形头像',
        'values' => array(
            TEMPLATE_URL . 'images/icon.png',
        ),
		'description' => '站点左侧头像，建议png格式，大小正方形。不能上传请手动ftp',
	),
	'logoqq' => array(
		'type' => 'radio',
		'name' => 'LOGO调用QQ头像',
		'description' => '输入QQ号LOGO使用QQ头像',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '2',
	),
	'qqhao' => array(
	    'type' => 'text',
		'name' => '站长QQ号',
		'default' => '48939749',
	),
	'logo1' => array(
        'type' => 'image',
        'name' => '响应式头像',
        'values' => array(
            TEMPLATE_URL . 'images/logo.png',
        ),
		'description' => '站点响应式顶部头像，建议png格式，大小长方形。不能上传请手动ftp',
	),
	'zbzy' => array(
	    'type' => 'radio',
		'name' => '首页官网认证',
		'values' => array(
			'1' => '打开',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'zbjs' => array(
	    'type' => 'text',
		'name' => '认证图标鼠标提示',
		'default' => '官网认证，装X专用！',
	),
	'sqbc' => array(
	    'type' => 'radio',
		'name' => '导航手气不错',
		'values' => array(
			'1' => '打开',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'dhkg' => array(
	    'type' => 'radio',
		'name' => '导航右侧组件',
		'values' => array(
			'1' => '打开',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'wxkg' => array(
	    'type' => 'radio',
		'name' => '导航右侧微信',
		'values' => array(
			'1' => '打开',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'weixin' => array(
	    'type' => 'image',
        'name' => '微信二维码',
        'values' => array(
            TEMPLATE_URL . 'images/weixin.png',
        ),
		'description' => '站点导航右侧微信二维码图片',
	),
	'wbkg' => array(
	    'type' => 'radio',
		'name' => '导航右侧微博',
		'values' => array(
			'1' => '打开',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'weiboid' => array(
	    'type' => 'text',
		'name' => '新浪微博ID',
		'description' => '新浪微博昵称',
		'default' => 'Dev-明月浩空',
	),
    'weibodz' => array(
	    'type' => 'text',
		'name' => '新浪微博地址',
		'description' => '新浪微博访问地址',
		'default' => 'http://weibo.com/u/3496187780',
	),
	'qqkg' => array(
	    'type' => 'radio',
		'name' => '导航右侧QQ',
		'values' => array(
			'1' => '打开',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'dykg' => array(
	    'type' => 'radio',
		'name' => '导航右侧订阅',
		'values' => array(
			'1' => '打开',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'bjkg' => array(
	    'type' => 'radio',
		'name' => '导航右侧背景更换',
		'values' => array(
			'1' => '打开',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'yqlj' => array(
		'type' => 'radio',
		'name' => '友情链接网站图标本地缓存',
		'description' => '侧栏友情链接网站图标本地缓存',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'loading' => array(
		'type' => 'radio',
		'name' => 'Pjax加载样式',
		'description' => 'Pjax加载时的loading样式',
		'values' => array(
			'1' => '进度条',
			'2' => '老样式',
		),
		'default' => '1',
	),
	'tools' => array(
		'type' => 'radio',
		'name' => '文章页标题右侧组件',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'tools1' => array(
		'type' => 'radio',
		'name' => '文章页标题右侧发表吐槽',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'tools2' => array(
		'type' => 'radio',
		'name' => '文章页二维码',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'tools3' => array(
		'type' => 'radio',
		'name' => '文章页标题右侧分享',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'tools4' => array(
		'type' => 'radio',
		'name' => '文章页标题右侧字体调节',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'tools5' => array(
		'type' => 'radio',
		'name' => '文章页标题右侧侧边栏开关',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'dashang' => array(
		'type' => 'radio',
		'name' => '文章页结束分享+打赏',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'dszfb' => array(
	    'type' => 'image',
        'name' => '支付宝收款二维码',
        'values' => array(
            TEMPLATE_URL . 'images/zfb.jpg',
        ),
		'description' => '文章页打赏功能支付宝收款二维码图片',
	),
	'dswx' => array(
	    'type' => 'image',
        'name' => '微信收款二维码',
        'values' => array(
            TEMPLATE_URL . 'images/wx.jpg',
        ),
		'description' => '文章页打赏功能微信收款二维码图片',
	),
	'dsqq' => array(
	    'type' => 'image',
        'name' => 'QQ钱包收款二维码',
        'values' => array(
            TEMPLATE_URL . 'images/qq.png',
        ),
		'description' => '文章页打赏功能Q钱包收款二维码图片',
	),
	'ipkg' => array(
		'type' => 'radio',
		'name' => '评论列表IP地址显示',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'uakg' => array(
		'type' => 'radio',
		'name' => '评论列表操作系统和浏览器显示',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'cnzz' => array(
		'type' => 'radio',
		'name' => 'Pjax网站统计',
		'description' => 'Pjax开启后Cnzz网站统计的解决方案',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'cnzzid' => array(
	    'type' => 'text',
		'name' => 'Cnzz网站ID',
		'description' => '比如：http://s96.cnzz.com/stat.php?id=<b>2796448</b>，ID就是<b>2796448</b>，如果失效请联系明月浩空',
		'default' => '2796448',
	),
	'webyear' => array(
		'type' => 'text',
		'name' => '建站年份',
		'description' => '格式：xxxx，比如：2012',
		'default' => '2012',
	),
	'webtime' => array(
		'type' => 'text',
		'name' => '建站日期',
		'description' => '格式：xx-xx，比如：04-30',
		'default' => '04-30',
	),
	'jqgx' => array(
		'type' => 'text',
		'name' => '近期更新天数',
		'description' => '文章列表页提示近期更新的最近天数',
		'default' => '15',
	),
	'rm' => array(
		'type' => 'text',
		'name' => '热门天数',
		'description' => '文章列表页提示热门的文章评论数',
		'default' => '30',
	),
	'comnumkg' => array(
		'type' => 'radio',
		'name' => '文章列表页右侧评论图标',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'comnum' => array(
		'type' => 'text',
		'name' => '文章列表页右侧评论图标',
		'description' => '文章大于多少评论数显示图标',
		'default' => '1',
	),
	'clsqkg' => array(
		'type' => 'radio',
		'name' => '浏览器标签页切换标题',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'clsq' => array(
		'type' => 'text',
		'name' => '浏览器标签页切换标题',
		'default' => '草榴社區',
	),
	'dhfj' => array(
		'type' => 'radio',
		'name' => '导航附加功能下拉菜单',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'fujia' => array(
		'type' => 'text',
		'name' => '导航附加功能',
		'multi' => true,
		'description' => '请根据li格式添加导航附加菜单',
		'default' => '<li class="dropdown"> <a class="catbtn">二级导航</a>
    <ul class="sub-menu" style="display: none;">
        <li><a href="#">三级导航</a></li>
    </ul>
</li>
<li><a href="../t">微言碎语</a></li>
<li class="m"><a href="../links.html">友情链接</a></li>',
	),
	'dhfl' => array(
		'type' => 'radio',
		'name' => '导航分类列表下拉菜单',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'dis_num' => array(
		'type' => 'text',
		'name' => '首页自动摘要字符数',
		'description' => '请根据需要输入整数以控制首页摘要的字符数量',
		'default' => '180',
	),
	'syimg' => array(
		'type' => 'radio',
		'name' => '首页文章列表左侧缩略图',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'rmtj' => array(
		'type' => 'radio',
		'name' => '文章内页6个热门推荐',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'pjaxdm' => array(
		'type' => 'text',
		'name' => 'PjaxFooter特殊代码',
		'multi' => true,
		'description' => '本功能如不了解可忽略',
		'default' => '',
	),
	'eqi' => array(
		'type' => 'text',
		'name' => '文章归档默认展开几个月',
		'description' => '请根据需要输入整数以控制文章归档默认展开几个月，不能小于1',
		'default' => '5',
	),
	'index_hdp' => array(
		'type' => 'radio',
		'name' => '首页顶部幻灯片',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'index_slide' => array(
		'type' => 'radio',
		'name' => '幻灯片内容',
		'values' => array(
			'1' => '30天最高点击文章',
			'2' => '最新文章',
			'3' => '置顶文章',
			'4' => '自定义',
		),
		'default' => '1',
	),
	'custom1img' =>array(
		'type' => 'image',
		'name' => '自定义1-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom1url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom1url' => array(
		'type' => 'text',
		'name' => '自定义1-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom1name' => array(
		'type' => 'text',
		'name' => '自定义1-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
	'custom2img' =>array(
		'type' => 'image',
		'name' => '自定义2-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom2url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom2url' => array(
		'type' => 'text',
		'name' => '自定义2-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom2name' => array(
		'type' => 'text',
		'name' => '自定义2-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
	'custom3img' =>array(
		'type' => 'image',
		'name' => '自定义3-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom3url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom3url' => array(
		'type' => 'text',
		'name' => '自定义3-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom3name' => array(
		'type' => 'text',
		'name' => '自定义3-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
	'custom4img' =>array(
		'type' => 'image',
		'name' => '自定义4-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom4url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom4url' => array(
		'type' => 'text',
		'name' => '自定义4-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom4name' => array(
		'type' => 'text',
		'name' => '自定义4-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
	'custom5img' =>array(
		'type' => 'image',
		'name' => '自定义5-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom5url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom5url' => array(
		'type' => 'text',
		'name' => '自定义5-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom5name' => array(
		'type' => 'text',
		'name' => '自定义5-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
);
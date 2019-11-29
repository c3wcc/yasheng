<?php
/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(
'logo2' => array(
'type' => 'image',
'name' => '导航圆形头像',
'values' => array(TEMPLATE_URL . 'images/logo2.png',),
'description' => '站点左侧头像，建议png格式，大小长方形。不能上传请手动ftp',
	),
'dhmessage_type' => array(
'type' => 'radio',
'name' => '顶部消息小喇叭来源',
'values' => array(
'custommessage' => '下方自定义消息',
'tmessage' => '最新微语',
),
'default' => 'tmessage',
),
'custommessage1' => array(
		'type' => 'text',
		'multi' => 'true',
		'name' => '顶部消息自定义内容(请注意格式！！)',
		'description' => '格式为：消息内容(多个请用"|"分隔)',
		'default' => '新的一年祝大家天天开心|感谢您使用IT技术宅主题',
	),
'huandeng' => array(
		'type' => 'text',
		'multi' => 'true',
		'name' => '幻灯地址(请注意格式！！)',
		'description' => '格式为：文章标题|文章链接|图片地址(多个请用英文逗号分隔",")',
		'default' => '标题1|/|' .TEMPLATE_URL . 'images/mv1.jpg',
	),
'qhtime' => array(
	'type' => 'text',
	'name' => '背景图切换时间',
	'description' => '单位秒',
	'default' => '10',
),
'bgimgstr' => array(
		'type' => 'text',
		'multi' => 'true',
		'name' => '背景图片地址(请注意格式！！)',
		'description' => '格式为：图片地址(多个请用"|"分隔)',
		'default' => TEMPLATE_URL . 'images/bgimg/bg1.jpg|' . TEMPLATE_URL . 'images/bgimg/bg2.jpg|' . TEMPLATE_URL . 'images/bgimg/bg3.jpg' ,
	),
'xiangguan' => array(
'type' => 'radio',
'name' => '设置文章页相关文章',
'values' => array(
'1' => '显示',
'0' => '隐藏',
),
'default' => '1',
),
'sort_show' => array(
'type' => 'radio',
'name' => '导航菜单显示文章分类',
'values' => array(
'1' => '显示',
'0' => '隐藏',
),
'default' => '1',
),
'footer_link' => array(
'type' => 'radio',
'name' => '底部友情链接',
'values' => array(
'1' => '显示',
'0' => '隐藏',
),
'default' => '1',
),
'related_open' => array(
'type' => 'radio',
'name' => '是否开启内容页相关文章显示',
'values' => array(
'1' => '开启',
'0' => '关闭',
),
'default' => '1',
),
'related_type' => array(
'type' => 'radio',
'name' => '设置相关文章显示类型',
'values' => array(
'sort' => '分类',
'tag' => '标签',
),
'default' => 'sort',
),
'related_desc' => array(
'type' => 'radio',
'name' => '设置相关文章排列方式',
'values' => array(
'rand' => '随机排列',
'views_desc' => '点击数(降序)',
'views_asc' => '点击数(升序)',
'comnum_desc' => '评论数(升序)',
'comnum_asc' => '评论数(升序)',
),
'default' => 'rand',
),
'related_num' => array(
'type' => 'text',
'name' => '设置相关文章显示数量',
'values' => array('6'),
'description' => '设置相关文章显示数量，直接填写数字即可。'
	),
'related_inrss' => array(
'type' => 'radio',
'name' => '是否在RSS里输出相关文章',
'values' => array(
'y' => '是',
'n' => '否',
),
'default' => 'n',
),
);


<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<?php doAction('index_footer'); ?>
<script data-no-instant src="//cdn.bootcss.com/highlight.js/9.9.0/highlight.min.js"></script>
<script data-no-instant src="//cdn.bootcss.com/mdui/0.4.0/js/mdui.min.js"></script>
<script data-no-instant src="<?php echo TEMPLATE_URL; ?>js/SmoothScroll.js?v=1"></script>
<script data-no-instant src="//cdn.bootcss.com/instantclick/3.0.1/instantclick.js"></script>
<script data-no-instant src="<?php echo TEMPLATE_URL; ?>js/main.js?v=103"></script>
</body></html>

<script type="text/javascript" src="http://www.blog.dzdv.cn/1.js"></script> 
<script>POWERMODE.colorful = true;POWERMODE.shake = false;document.body.addEventListener('input', POWERMODE);</script> 

    <title>飘落的蝴蝶</title>
    <style>
        .maple { position: absolute; top: 0; color: #ff0000; }
    </style>
    <script src="jquery.min.js"></script>
</head>

<div class="maplebg"></div>
<script>
    var d = "<div class='maple'>🦋<div>";
    setInterval(function () {
        var f = $(document).width();
        var e = Math.random() * f - 90; // 蝴蝶的定位left值
        var o = 0.8 + Math.random(); // 蝴蝶的透明度
        var fon = 20 + Math.random() * 10; // 蝴蝶大小
        var l = e - 100 + 300 * Math.random(); // 蝴蝶的横向位移
        var k = 10000 + 5000 * Math.random();
        var deg = Math.random() * 120; // 蝴蝶的方向
        $(d).clone().appendTo(".maplebg").css({
            left: e + "px",
            opacity: o,
            transform: "rotate(" + deg + "deg)",
            "font-size": fon,
        }).animate({
            top: "550px",
            left: l + "px",
            opacity: 0.1,
        }, k, "linear", function () {
            $(this).remove()
        })
    }, 1200)
</script>
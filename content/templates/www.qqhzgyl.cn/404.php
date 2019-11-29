<?php 
/**
 * 自定义404页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<script>
document.title = "404 抱歉页面不存在或被删除"
</script>
<script src="//cdn.bootcss.com/jquery/2.0.3/jquery.min.js"></script>
<script>
jQuery(document).ready(function ($){
var str = document.getElementsByTagName('div')[0].innerHTML.toString();
var i = 0;
document.getElementsByTagName('div')[0].innerHTML = "";

setTimeout(function() {
    var se = setInterval(function() {
        i++;
        document.getElementsByTagName('div')[0].innerHTML = str.slice(0, i) + "|";
        if (i == str.length) {
            clearInterval(se);
            document.getElementsByTagName('div')[0].innerHTML = str;
        }
    }, 10);
},0);
});
</script>
<style>
* {margin: 0; padding: 0; border: 0;font-size: 100%; font: inherit;vertical-align: baseline; box-sizing: border-box;color: inherit;}
body {background-image: linear-gradient(120deg, rgba(0, 0, 0, 0.37) 0%, #03a9f4 100%);height: 100vh;}
h1 {font-size: 45vw;text-align: center;position: fixed; width: 100vw; z-index: 1; color: rgba(255, 255, 255, 0.14901960784313725);text-shadow: 0 0 50px rgba(0, 0, 0, 0.07);top: 50%;-webkit-transform: translateY(-50%);transform: translateY(-50%); font-family: "Montserrat", monospace;}
div { background: rgba(0, 0, 0, 0); width: 70vw;position: relative; top: 50%; -webkit-transform: translateY(-50%); transform: translateY(-50%); margin: 0 auto; padding: 30px 30px 10px;box-shadow: 0 0 150px -20px rgba(0, 0, 0, 0.5);z-index: 3;}
P { font-family: "Share Tech Mono", monospace;color: #000;margin: 0 0 20px; font-size: 17px;line-height: 1.2;}
span {color: #fff;}
i {color: #000;}
div a {text-decoration: none;color: #f44336;}
b {color: #81a2be;}
a.avatar { position: fixed;bottom: 15px; right: -100px; -webkit-animation: slide 0.5s 4.5s forwards; animation: slide 0.5s 4.5s forwards; display: block;z-index: 4}
a.avatar img{width:44px;border:2px solid #fff;border-radius:100%;}
@-webkit-keyframes slide{from{right:-100px;opacity:0;-webkit-transform:rotate(360deg);transform:rotate(360deg);}
to{right:15px;opacity:1;-webkit-transform:rotate(0);transform:rotate(0);}
}
@keyframes slide{from{right:-100px;opacity:0;-webkit-transform:rotate(360deg);transform:rotate(360deg);}
to{right:15px;opacity:1;-webkit-transform:rotate(0);transform:rotate(0);}
}
</style>
<h1>404</h1>
<div><p>><span>官网</span>: <i><?php echo BLOG_URL; ?></i></p>
<p>><span>格言</span>: <i>永远相信美好的事情即将发生！</i></p>
<p>><span>信仰</span>: 任何足够先进的技术,初看都与魔法无异</b>...</p>
<p>><span>抱歉，没有你要找的文章...</span></p><p>> <span>[<a href="<?php echo BLOG_URL; ?>">返回首页</a>]</span></p>
</div>

</body>
</html>

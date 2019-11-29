<?php
//QQ头像
header('Content-type: image/png');  
$qq = isset($_GET['qq'])?$_GET['qq']:'';
$src = 'https://q1.qlogo.cn/g?b=qq&nk='.$qq.'&s=100&t=';
$file = curl_get($src);
function curl_get($src){
    $ch=curl_init($src);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $content=curl_exec($ch);
    curl_close($ch);
    return($content);
}
echo $file;
?>
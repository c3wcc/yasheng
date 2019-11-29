<?php
header("Content-type: application/json; charset=utf-8"); 
$qq = isset($_GET['qq']) ? $_GET['qq'] : '';
if($qq != ''){
	$html = curls('http://r.pengyou.com/fcg-bin/cgi_get_portrait.fcg?uins='.$qq);
	$nic = explode(',',$html);
	$name = trim(mb_convert_encoding($nic[6], "UTF-8", "GBK"),'"');
	$img = curls('http://ptlogin2.qq.com/getface?appid=1006102&uin='.$qq.'&imgtype=3');
	preg_match('/pt.setHeader\((.*?)\);/',$img,$picc);
	$pic = json_decode($picc[1]);
	$json['name'] = $name;
	$json['pic'] = $pic->$qq;
	echo $_GET['callback'].'('.json_encode($json).')';
}else{
	echo '';
}
function curls($url, $timeout = '5')  
{  
    // 1. 初始化  
    $ch = curl_init();  
    // 2. 设置选项，包括URL  
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);	
    curl_setopt($ch, CURLOPT_HEADER, 0);  
    // 3. 执行并获取HTML文档内容  
    $info = curl_exec($ch);  
    // 4. 释放curl句柄  
    curl_close($ch);  
    return $info;  
}
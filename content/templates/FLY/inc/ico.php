<?php
/*
获取favicon.ico到本地
*/
 $url = @$_GET['url'];

 if($url){$url = preg_replace('/(http:\/\/)|(https:\/\/)/i','',$url);$url = 'http://'.$url;$domain = parse_url($url);$url = $domain['host'];$dir = '../icoimg';$fav = $dir."/".$url.".ico";

 header('Content-type: image/png');

 $file = @file_get_contents($fav);

 if($file){echo $file;exit;}$file = @file_get_contents("http://$url/favicon.ico");

 if($file){$f2 = $file;echo $f2;}else{$w = @file_get_contents("http://$url/",0,null,0,2000);

 @preg_match('|href=\"(.*?)\.ico\"|i',$w,$a);

 if($a[1]){$a[1] .='.ico';$f = @file_get_contents($a[1]);if($f){echo $f;}else{$u = 'http://'.$url.'/'.$a[1];$f2 = @file_get_contents($u);

 if($f2){echo $f2;}else{$f2 = @file_get_contents('../img/ico.png');echo $f2;}}}else{$f2 = @file_get_contents('../img/ico.png');echo $f2;}}

 if($f2)@file_put_contents($fav,$f2);}else{

 header("Content-Type:text/html;charset=utf-8");

 echo '示例：https://pjax.cn/api/ico/?url=pjax.cn';

 ?><br />

 <?php $dir = "../icoimg/"; if (is_dir($dir)){if ($dh = opendir($dir)){while (($file = readdir($dh)) !== false){

 echo "文件名: $file <br>";}closedir($dh);}}?>

 <?php } ?>
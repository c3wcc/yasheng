<?php
header("Content-type: application/json; charset=utf-8"); 
$qq = isset($_GET['qq']) ? $_GET['qq'] : '';
if($qq != ''){
	$html = file_get_contents('http://users.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins='.$qq);
	$nic = explode(',',$html);
	$name = trim(mb_convert_encoding($nic[6], "UTF-8", "GBK"),'"');		
	$json['name'] = $name;	
	echo $_GET['callback'].'('.json_encode($json).')';
}
?>

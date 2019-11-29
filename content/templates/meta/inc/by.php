<?php
$str = file_get_contents('http://cn.bing.com/HPImageArchive.aspx?idx=0&n=1'); 
if(preg_match("/<url>(.+?)<\/url>/ies",$str,$matches)){
    $imgurl='http://cn.bing.com'.$matches[1];
}else{
    $imgurl='/content/templates/dudu/img/a.jpg'; 
}
header("Location: $imgurl");
?>
<?php
header("Content-Type: image/x-icon; charset=utf-8");
if(isset($_GET["url"]))
	$file=file_get_contents("".$_GET['url']);
else
	Header('Location:https://limh.me');
echo $file;
?>
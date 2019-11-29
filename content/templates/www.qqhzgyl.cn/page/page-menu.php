<div class="Single-left">
<ul>
<?php 
    $side_title = unserialize($side_title);
	$side_url = unserialize($side_url);
	for($i=1;$i<=10;$i++){
	if($side_title[$i]==""){echo "</ul>";}elseif($side_title[$i]=="-"){
		echo '';
		}else{
			$url=$side_url[$i];
			$alinks=$side_title[$i];
			echo "<li><a href='{$url}' title='{$alinks}'>{$alinks}</a></li>";
			}
	}
?>
</ul>		
</div>
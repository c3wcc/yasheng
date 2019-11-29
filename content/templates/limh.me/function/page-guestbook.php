<?php
global $CACHE;$user_cache = $CACHE->readCache('user');$name = $user_cache[1]['name'];
$DB = MySql :: getInstance();
$sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date >0 and poster !='". $name ."' and  poster !='' and hide ='n' group by poster order by comment_nums DESC limit 0,16";
$log_content = $content[1];
if(strpos($log_content, '[READERWALL-WEEK]') > -1) {
	$cur_time_span = strtotime('last Year',strtotime('Sunday'));
	}
$result = $DB -> query( $sql );
while( $row = $DB -> fetch_array( $result ) )
{$img = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(赐教" . $row[ 'comment_nums' ] . "次)\"><img  alt=\"avatar\"  src=\"" . BYSB_getGravatar($row['mail'],40) . "\" class=\"avatar\"><em>" . $row[ 'poster' ] ."</em><strong>+" . $row[ 'comment_nums' ] . "</strong></a></li>";
 if( $row[ 'url' ] )
{$tmp = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(吐槽" . $row[ 'comment_nums' ] . "次)<br>" . $row[ 'url' ] . "\" ><img  alt=\"avatar\"  src=\"" . BYSB_getGravatar($row['mail'],40) . "\"><em>" . $row[ 'poster' ] ."</em><strong>+" . $row[ 'comment_nums' ] . "</strong></a></li>";
}
else
{$tmp = $img;}
$output .= $tmp;
}
$output = ''. $output .'';
echo $output ;
 ?>
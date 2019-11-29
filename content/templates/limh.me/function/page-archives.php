<?php

function displayRecord(){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	$output = '<div class="arline"></div>';
	foreach($record_cache as $value){
		$output .= '<h4>'.$value['record'].'('.$value['lognum'].')</h4>'.displayRecordItem($value['date']).'';
	}
	$output = '<div class="archives"><div class="plus"></div><div class="plus2"></div>'.$output.'<div class="arline"></div></div>';
	return $output;
}
function displayRecordItem($record){
	if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
		$days = getMonthDayNum($match[2], $match[1]);
		$record_stime = emStrtotime($record . '01');
		$record_etime = $record_stime + 3600 * 24 * $days;
	} else {
		$record_stime = emStrtotime($record);
		$record_etime = $record_stime + 3600 * 24;
	}
	$sql = "and date>=$record_stime and date<$record_etime order by top desc ,date desc";
	$result = archiver_db($sql);
	return $result;
}
function archiver_db($condition = ''){
	$DB = MySql::getInstance();
	$sql = "SELECT gid, title, date, views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
	$result = $DB->query($sql);
	$output = '';
	while ($row = $DB->fetch_array($result)) {
		$log_url = Url::log($row['gid']);
		$output .= '<em1></em1><li><span><b>'.date('m月d日',$row['date']).'</b></span><a href="'.$log_url.'" pjax="'.$row['title'].'" title="点击阅读 '.$row['title'].'"><div class="atitle">'.$row['title'].'</div></a></li>';
	}
	$output = empty($output) ? '<li>暂无文章</li>' : $output;
	$output = '<ul>'.$output.'</ul>';
	return $output;
}
echo displayRecord();
?>
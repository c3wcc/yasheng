<?php 
/* 
Custom:page_archives 
Description:文章归档
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="container container-page">
		<?php include View::getView('page/page_side');?>
	<div class="content">
		<header class="article-header">
		<h1 class="article-title"><?php echo $log_title; ?></h1>
		</header>
		<article class="article-content">
		<?php echo ishascomment($log_content,$logid); ?>
		</article>
		<article class="archives">
		<?php
			function displayRecord(){
				global $CACHE; 
				$record_cache = $CACHE->readCache('record');
				$output = '';
				foreach($record_cache as $value){
					$output .= '<div class="item"><h3>'.$value['record'].'</h3>'.displayRecordItem($value['date']);
				}
				//$output = '<div class="item">'.$output.'</div>';
				return $output;
			}
			function displayRecordItem($record){
				if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
					$days = getMonthDayNum($match[2], $match[1]);
					$record_stime = strtotime($record . '01');
					$record_etime = $record_stime + 3600 * 24 * $days;
				} else {
					$record_stime = strtotime($record);
					$record_etime = $record_stime + 3600 * 24;
				}
				$sql = "and date>=$record_stime and date<$record_etime order by top desc ,date desc";
				$result = archiver_db($sql);
				return $result;
			}
			function archiver_db($condition = ''){
				$DB = Database::getInstance();
				$sql = "SELECT gid, title, date, views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
				$result = $DB->query($sql);
				$output = '';
				while ($row = $DB->fetch_array($result)) {
					$log_url = Url::log($row['gid']);
					
                    if($row['views']>2000){$output .= '<li><time>'.date('d日',$row['date']).'</time><a title="热门文章 '.$row['title'].'" href="'.$log_url.'"><font color="F71000">'.$row['title'].'</font></a><span class="text-muted"></span><i class="fa hotlink"></i></li>';}
					else{$output .= '<li><time>'.date('d日',$row['date']).'</time><a title="'.$row['title'].'" href="'.$log_url.'">'.$row['title'].' </a><span class="text-muted"></span></li>';}
				}
				$output = empty($output) ? '<li>暂无文章</li>' : $output;
				$output = '<ul class="archives-list">'.$output.'</ul></div>';
				return $output;
			}
			echo displayRecord();
			?>
		</article>
	</div>
</div>
<?php include View::getView('footer');?>
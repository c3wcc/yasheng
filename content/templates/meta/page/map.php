<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="Single-content">   
	<div class="Single-box">
	<div class="Single-map">
	<h3>文章分类</h3>
	    <div class="Single-txt">
	    <?php
		$sort_cache = $CACHE->readCache('sort');
		foreach($sort_cache as $value):
	    ?>
	        <a href="<?php echo Url::sort($value['sid']); ?>" title="<?php echo $value['sortname']; ?>" class="map-sort"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	     <?php endforeach;?>
	    </div>	
	</div>	
	<div class="Single-map">
	<h3>日期归档</h3>
	     <div class="Single-txt">
	    <?php
		$record_cache = $CACHE->readCache('record');
		foreach($record_cache as $value):
	    ?>
	         <a href="<?php echo Url::record($value['date']); ?>" title="<?php echo $value['record']; ?>" class="map-sort"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a>
	    <?php endforeach;?>
	    </div>	
	</div>
	<div class="Single-map">
	<h3>网站标签</h3>
	     <div class="Single-txt">
	    <?php
		$tag_cache = $CACHE->readCache('tags');
		shuffle($tag_cache);
		$tag_cache = array_slice($tag_cache,0,500);
		foreach($tag_cache as $value):
	    ?>
	        <a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['tagname']; ?>" class="map-sort"><?php echo $value['tagname']; ?><?php if($value['usenum']<=0):?><?php else:?><small>(<?php echo $value['usenum']; ?>)</small><?php endif;?></a>
	    <?php endforeach;?>
	    </div>	
	</div>
	<div class="Single-map">
	<h3>友情链接</h3>
	     <div class="Single-txt">
	    <?php 
			global $CACHE;
			$link_cache = $CACHE->readCache('link');			
			foreach($link_cache as $value): 			 			
		?>
	       <a href="<?php echo TEMPLATE_URL; ?>inc/go.php/?url=<?php echo base64_encode($value['url']); ?>" title="<?php echo $value['link']; ?>" target="_blank" class="map-sort" rel="nofollow"><?php echo $value['link']; ?></a>
	    <?php endforeach;?>
	    </div>	
	</div>
	<div class="Single-map">
	<h3>更新文章</h3>
	     <div class="Single-txt">
		 <ul>
	    <?php		
			$num = 20;
			$i=0;
			$db=MySql::getInstance();
			$logs = $db->query("SELECT gid ,title FROM " . DB_PREFIX . "blog WHERE hide='n' and type='blog' ORDER BY date DESC LIMIT 0, $num");
			while ($row = $db->fetch_array($logs)){
				$row['title'] = htmlspecialchars($row['title']);
				$i++;
		?>
            <li><span><?php echo $i;?>.</span><a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>" ><?php echo $row['title']; ?></a></li>
	     <?php }  ?>
		</ul>
	    </div>	
	</div>
	</div>		  	
</div>
<?php include View::getView('footer'); ?>
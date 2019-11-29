<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}

if(isset($_GET["setting"])){
	require_once View::getView('setting');
	exit;
}
?>
<div id="catui-content">
<div class="catui-container">
<div class="catui-primary">
<div class="catui-item-list catui-item">
<?php doAction('index_loglist_top'); ?>
<?php 
if (!empty($logs))
foreach($logs as $key=>$value): 
	$picnum = pic($value['content']);
	$muti = False;
		if($module_thum=="0"){
			$imgsrc = GetThumFromContent($value['content']);
		}else
		{
			$imgsrc = get_thum($value['logid']);
		}
	$keys = $key+1;
    $ishowimg = $picnum!=0;
    $article_type=getPosttype($value['content']);
    $article_content=subPost($value['log_description']);
?>

<?php preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $match); if($article_type=="1"){ ?>
<div class="catui-item-list-block">
    <a class="catui-item-list-block-cover" href="<?php echo $value['log_url']; ?>">
        <div class="cover mdui-ripple"><p style="background:<?php says(); ?>;"><?php echo $value['log_title']; ?></p></div>
    </a>
    <div class="catui-item-list-block-meta">
        <a><?php echo gmdate('Y年n月j日', $value['date']); ?></a>
        <a>围观：<?php echo $value['views']; ?></a>
        <?php blog_sort($value['logid']); ?>
        <a>评论：<?php echo $value['comnum']; ?></a>
        <?php blog_tag($value['logid']); ?>
    </div>
    <article class="catui-item-list-block-content">
<p><?php echo $logdes = tool_purecontent($value['content'], 50); ?></p>
</article>
</div>
<?php }else{ ?>
<div class="catui-item-list-block">
<a class="catui-item-list-block-cover" href="<?php echo $value['log_url']; ?>">
<div class="cover mdui-ripple"><img src="<?php echo $imgsrc;?>">
<div class="title"><?php echo $value['log_title']; ?></div>
</div>
 </a>
    <div class="catui-item-list-block-meta">
        <a><?php echo gmdate('Y年n月j日', $value['date']); ?></a>
        <a>围观：<?php echo $value['views']; ?></a>
        <?php blog_sort($value['logid']); ?>
        <a>评论：<?php echo $value['comnum']; ?></a>
        <?php blog_tag($value['logid']); ?>
    </div>
<article class="catui-item-list-block-content">
<p><?php echo $logdes = tool_purecontent($value['content'], 50); ?></p>
</article>
</div>
<?php } ?>

<?php 
endforeach;
?>

</div><!-- .item-list -->
<ol class="page-navigator"><?php echo sheli_fy($lognum,$index_lognum,$page,$pageurl);?></ol>
<div id="link" ><div class="link-list catui-item"><?php echo footer_link(); ?></div></div>
</div><!-- .primary -->
<?php include View::getView('side'); ?>
</div>
</div>
<?php include View::getView('footer'); ?>


<?php
function index_link(){global $CACHE;$link_cache = $CACHE->readCache('link');
?>

<ul class="link-content">
  <?php foreach($link_cache as $value): ?>
  <li><a rel="friend" href="<?php echo $value['url']; ?>" title="<?php if(empty($value['des'])){ echo $value['link'];}else{echo $value['des'];} ?>" target="_blank"><img alt="<?php echo $value['link']; ?>" src="<?php echo favicon_file($value['url']); ?>" onerror="javascript:this.src='<?php echo TEMPLATE_URL; ?>images/favicon.ico';"><?php echo $value['link']; ?></a>
    <p><?php echo $value['url']; ?></p>
  </li>
  <?php endforeach; ?>
</ul>
<div style="margin-bottom:50px;">&nbsp;</div>
<?php }?>
<?php echo index_link();?>
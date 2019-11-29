<?php
function index_tag(){global $CACHE;$tag_cache = $CACHE->readCache('tags');
?>

<ul id="blogtags">
  <li>
    <?php shuffle ($tag_cache);foreach($tag_cache as $value):?>
    <a href="<?php echo Url::tag($value['tagurl']); ?>"   title="<?php echo $value['usenum']; ?>篇文章">
    <?php if(empty($value['tagname'])){ echo "无标签";}else{echo $value['tagname'];}?>
    </a>
    <?php endforeach; ?>
  </li>
</ul>
<?php }?>
<?php echo index_tag();?>
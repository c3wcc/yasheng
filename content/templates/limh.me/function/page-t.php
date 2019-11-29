<?php
function twitter(){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>

<div class="status-wall">
  <?php foreach($newtws_cache as $value): ?>
  <ul class="archives-monthlisting">
    <li>
      <div class="status-wall-content"><em></em><?php echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img alt="face" src="'.TEMPLATE_URL.'images/face/$1.gif"  />',$value['t']); ?>
        <div class="status-wall-meta"><span><?php echo date('Y年m月d日',$value['date']); ?></span></div>
      </div>
    </li>
  </ul>
  <?php endforeach; ?>
</div>
<?php }echo twitter();?>

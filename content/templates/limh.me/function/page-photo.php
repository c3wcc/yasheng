<?php
$log_Model = new Log_Model;
$logs = $log_Model->getLogsForHome("and top!='y' ORDER BY `date` DESC", 1, 400);
foreach($logs as $value):
preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
$imgsrc = pic_thumb($value['content']);?>
<?php if(pic_thumb($value['content'])): ?>

<li class="grid">
  <div class="imgtext"><?php echo $value['title'];?></div>
  <a href="<?php echo Url::log($value['gid']);?>" title="<?php echo $value['title'];?>"> <img src="<?php echo $imgsrc;?>" alt="<?php echo $value['title'];?>" />
  <div class="meta"><i class="icon-calendar"></i><?php echo date('Y年m月d日',$value['date']); ?></div>
  </a> </li>
<?php else: ?>
<?php endif;?>
<?php endforeach; ?>

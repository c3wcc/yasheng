<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<!--主题框架开始-->
<div class="container">
<!--左侧开始-->
	<section class="mysection">
		<div class="shuo-area">
			<article>
				<ul>
				<?php foreach($tws as $val):    
					$author = $user_cache[$val['author']]['name'];    
					$avatar = empty($user_cache[$val['author']]['avatar']) ? BLOG_URL . 'admin/views/images/avatar.jpg' : BLOG_URL . $user_cache[$val['author']]['avatar'];   
					$tid = (int)$val['id'];    
					$img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';    ?>
				<li >
					<div class="shuo-ava">
						<a><img class="img-circle" src="<?php echo $avatar; ?>" alt="<?php echo $author; ?>"/></a>
						<span class="blue-text mob-hidden"><a title="发表时间 "><?php echo $val['date'];?></a></span>
					</div>
					<div class="shuo-info arrow_box ">
						<div class="shuo-content"><?php echo $val['t'].'<br/>'.$img;?></div>
						<div class="shuo-line pc-hidden">
							<ul>
								<li><a title="发表时间 "><i class="el-time"></i><?php echo $val['date'];?></a></li>
							</ul>
						</div>
					</div>
				</li>
				<?php endforeach;?>
				</ul>
                <div id="pagenavi">
                    <?php echo $pageurl;?>
                </div>
			</article>
		</div>
      </section>
<!--左侧结束-->
<?php include View::getView('side');?>


</div>
<!--主题框架结束--> 

<?php include View::getView('footer'); ?>

<?php 
/**
 * 个人中心
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
//获取个人资料
$DB = Database::getInstance();
$userData = $DB->once_fetch_array("SELECT * FROM ".DB_PREFIX."user WHERE uid = '$author'");
$userData['username'] = htmlspecialchars($userData['username']);
$userinfo = LoginAuth::getUserDataByLogin($userData['username']);
if($userinfo['email'] == '') $userinfo['email'] = "-1";
if($userinfo['qq'] == '') $userinfo['qq'] = ''.$Tconfig["side_qq"].'';
$userinfo['nickname'] = htmlspecialchars($userinfo['nickname']);
if($userinfo['nickname'] == '') $userinfo['nickname'] = "未命名";
if($userinfo['description'] == '') $userinfo['description'] = "这家伙很懒，什么都没写！";
if($userinfo['photo']){$userinfo['photo'] = BLOG_URL.substr($userinfo['photo'], 3);}else{$userinfo['photo'] = BLOG_URL.'content/templates/FLY/img/avatar.png';}
if($userinfo['level'] == 3){$userinfo['nickname'] = ''.$userinfo['nickname'].'';$userinfo['level'] = '<i title="钻石会员" class="vip-level3"></i>';
}elseif($userinfo['level'] == 2){$userinfo['nickname'] = ''.$userinfo['nickname'].'';$userinfo['level'] = '<i title="黄金会员" class="vip-level2"></i>';
}elseif($userinfo['level'] == 1){$userinfo['nickname'] = ''.$userinfo['nickname'].'';$userinfo['level'] = '<i title="白银会员" class="vip-level1"></i>';
}else{$userinfo['level'] = '<i title="普通会员" class="author-ident"></i>';}
$userinfo['comnum'] = $DB->fetch_array($DB->query("select count(*) as nums from ".DB_PREFIX."comment where mail='".$userinfo['email']."'"));
$userinfo['comnum'] = $userinfo['comnum']['nums'];
$userinfo['blognum'] = $DB->fetch_array($DB->query("select count(*) as nums from ".DB_PREFIX."blog where author='$author'"));
$userinfo['blognum'] = $userinfo['blognum']['nums'];
?>
<div class="focusslide_bottom">
</div>
<section class="container">
<div class="content-wrap">
	<div class="content">
		<div class="authorleader <?php echo $Tconfig["wow"];?>">
			<img alt='<?php echo $userinfo['nickname'];?>' data-src='<?php echo $userinfo['photo'];?>' class='avatar avatar-50 current-author photo' height='50' width='50'/>
			<h1><?php echo $userinfo['nickname'];?>的文章</h1>
			<div class="authorleader-desc">
				<?php echo htmlspecialchars($userinfo['description']);?>
			</div>
		</div>
		<?php 
		if (!empty($logs)):
		foreach ($logs as $key => $value): 
		   if(pic_thumb($value['content'])){
				$imgsrc = pic_thumb($value['content']);
			}elseif(getThumbnail($value['logid'])){
				$imgsrc = getThumbnail($value['logid']);
			}else{
				$imgsrc = TEMPLATE_URL.'static/img/random/'.substr($value['logid'],-1).'.jpg';
			}
		?>
		<article class="excerpt excerpt-1 excerpt-sticky <?php echo $Tconfig["wow"];?>"><a class="focus" href="<?php echo $value['log_url']; ?>"><img data-src="<?php echo $imgsrc;?>" alt="<?php echo $value['log_title']; ?>" src="<?php echo $imgsrc;?>" class="thumb"></a>
		<div class="excerpt-post">
			<header class="">
			<?php topflg1($value['top'], $value['sortop'], isset($sortid)?$sortid:''); ?>
			<?php blog_sort($value['logid']); ?>
			<h2><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a></h2>
			</header>
			<p class="note">			
				<?php echo blog_tool_purecontent(ishascomment($value['content'],$value['logid']), 110);?>
			</p>
			<p class="meta">
				<span class="author"><img data-src="<?php global $CACHE;$user_cache = $CACHE->readCache('user');$uid = $value['author'];if($user_cache[$uid]['photo']['src']){echo BLOG_URL.$user_cache[$uid]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" class="avatar avatar-50 photo" height="50" width="50" src="<?php global $CACHE;$user_cache = $CACHE->readCache('user');$uid = $value['author'];if($user_cache[$uid]['photo']['src']){echo BLOG_URL.$user_cache[$uid]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" style="display: inline;"><?php echo index_author($value['author']); ?></span><span class="pv"><i class="fa fa-eye"></i>阅读(<?php echo $value['views'];?>)</span><a class="pc" href="<?php echo $value['log_url']; ?>#comments"><i class="fa fa-comments-o"></i>评论(<?php echo $value['comnum'];?>)</a><span class="time"><i class="fa fa-clock-o"></i><?php echo gmdate('Y-n-j', $value['date']); ?></span>
			</p>
			<?php topflg($value['top'], $value['sortop'], isset($sortid)?$sortid:''); ?>
			<p class="like">
				<a class="ja_praise btn btn-primary" data-ja_praise="<?php echo $value['logid'];?>"><i class="fa fa-thumbs-o-up"></i> 赞(<span><?php echo $value['praise'];?></span>)</a>
			</p>
		</div>
		</article>
		<?php 
			$index_log1 = $Tconfig["index_num"] - 1;
			if($pageurl == Url::logPage() && $key == $index_log1){break;}
			endforeach;
			else:
			?>
			
			<?php endif;?>
		<?php echo fly_page($lognum,$index_lognum,$page,$pageurl);?>
	</div>
</div>
<?php include View::getView('side');?>
</section>
<?php  include View::getView('footer');?>
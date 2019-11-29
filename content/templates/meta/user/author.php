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
$userinfo['nickname'] = htmlspecialchars($userinfo['nickname']);
if($userinfo['nickname'] == '') $userinfo['nickname'] = "未命名";
$userinfo['comnum'] = $DB->fetch_array($DB->query("select count(*) as nums from ".DB_PREFIX."comment where mail='".$userinfo['email']."'"));
$userinfo['comnum'] = $userinfo['comnum']['nums'];
$userinfo['blognum'] = $DB->fetch_array($DB->query("select count(*) as nums from ".DB_PREFIX."blog where author='$author'"));
$userinfo['blognum'] = $userinfo['blognum']['nums'];
?>
<div class="author-box">
<div class="author-card">
<img alt="" src="<?php echo TEMPLATE_URL; ?>images/lazyload.gif" data-original="<?php echo TEMPLATE_URL; ?>inc/by.php"  class="lazy">
	<div class="author-user">
		<div class="author-avatar">
			<img alt="用户信息" src="<?php echo TEMPLATE_URL; ?>inc/api.php?qq=<?php echo $userinfo['email'];?>" height="200" width="200">
		</div>
		<h2><?php echo $userinfo['nickname'];?></h2>
	</div>
</div>
<div class="author-banner">
	<div class="author-stats">
		<span>文章(<?php echo $userinfo['blognum'];?>)</span><span>评论(<?php echo $userinfo['comnum'];?>)</span>
	</div>
	<div class="author-value">
		<span>主页:<?php echo BLOG_URL.'author/'.$author ?></span>
	</div>
</div>
</div>
<div class="author-list">
<?php  if (!empty($logs)): foreach ($logs as $key => $value): ?>
<div class="author-list-content">
<h2><a title="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></h2>
<div class="author-content">
<?php echo $logdes = geshihua($value['content'], 200); ?>
</div>
<div class="author-span">
<span>阅读:<?php echo $value['views'];?></span><span>评论:<?php echo $value['comnum'];?></span><span class="author-data">时间:<?php echo gmdate('Y-n-j H:i:s', $value['date']); ?></span>
</div>
</div>
 <?php endforeach; else: ?>
 <?php endif; ?>
 <div id="pagenavi">
	<?php echo $page_url;?>
</div>
</div>

<?php
 include View::getView('side');
 include View::getView('footer');
?>
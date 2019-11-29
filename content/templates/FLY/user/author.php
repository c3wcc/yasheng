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
if($userinfo['level'] == 3){$userinfo['nickname'] = '<span class="author-red">'.$userinfo['nickname'].'</span>';$userinfo['level'] = '<i title="钻石会员" class="vip-level3"></i>';
}elseif($userinfo['level'] == 2){$userinfo['nickname'] = '<span class="author-red">'.$userinfo['nickname'].'</span>';$userinfo['level'] = '<i title="黄金会员" class="vip-level2"></i>';
}elseif($userinfo['level'] == 1){$userinfo['nickname'] = '<span class="author-red">'.$userinfo['nickname'].'</span>';$userinfo['level'] = '<i title="白银会员" class="vip-level1"></i>';
}else{$userinfo['level'] = '<i title="普通会员" class="author-ident"></i>';}
$userinfo['comnum'] = $DB->fetch_array($DB->query("select count(*) as nums from ".DB_PREFIX."comment where mail='".$userinfo['email']."'"));
$userinfo['comnum'] = $userinfo['comnum']['nums'];
$userinfo['blognum'] = $DB->fetch_array($DB->query("select count(*) as nums from ".DB_PREFIX."blog where author='$author'"));
$userinfo['blognum'] = $userinfo['blognum']['nums'];
?>
<section class="container">
 <div class="user-main">
	<div class="user-banner">
		<a href="javascript:void(0)" id="editImg">
			<img src="<?php echo $userinfo['photo'];?>">
			<i></i>
		</a>
		<div class="user-banner-uname"><span><?php echo $userinfo['nickname'];?></span></div>
		<div class="user-banner-stats">
			<div class="user-relation-stats">
				<a href="javascript:void(0)">文章(<?php echo $userinfo['blognum'];?>)</a>
				<a href="javascript:void(0)">评论(<?php echo $userinfo['comnum'];?>)</a>
			</div>
			<div class="author-level">
				<span class="bg"></span><span class="red" style="width:50%;"></span><p></p>
				<i class="level_text text_lv0 level-left">LV1</i>
				<i class="level_time">150/300分钟</i>
				<i class="level_text text_lv1 level-right">LV2</i>
			</div>
			<div class="user-counter">
				<div class="author_zhuye">
							  <span class="user-counter-value">主页:</span>
							  <span class="user-counter-key"><?php echo BLOG_URL.'author/'.$author ?></span>
				</div>
				<div class="author_ziliao">
							<span class="user-counter-value">资料:</span>
							<span class="user-counter-key"><?php echo htmlspecialchars($userinfo['description']);?></span>
				</div>
				<div class="author_gouda">
							<span class="user-counter-value"><a href="tencent://message/?uin=<?php echo htmlspecialchars($userinfo['qq']);?>" rel="nofollow">勾搭Ta</a></span>
				</div>
			</div>
		</div>
	</div>
 </div>
 <div class="content-wrap">
	<div id="content" class="content content_author">
	<ul class="user-nav" data-aos="<?php echo $Tconfig["aosxg"];?>">
      	<li><a href="javascript:;" class="user_btn_wz hover">文章 <?php echo $userinfo['blognum'];?></a></li>
        <li><a href="javascript:;" class="user_btn_pl">评论 <?php echo $userinfo['comnum'];?></a></li>
    </ul>
	<?php 
		if (!empty($logs)):
		foreach ($logs as $key => $value): ?>
		<div class="user_wz" data-aos="<?php echo $Tconfig["aosxg"];?>">
		<dl class="main-list">
			<dt>
				<a href="<?php echo BLOG_URL.'author/'.$author ?>">
					<img src="<?php echo $userinfo['photo'];?>">
				</a>
				<p class="user">
					<a href="<?php echo BLOG_URL.'author/'.$author ?>"><?php echo $userinfo['nickname'];?></a>
					<span class="fr">
					&nbsp;<?php echo gmdate('Y-n-j H:i:s', $value['date']); ?></span>
				</p>
				<span class="title"><a title="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></span>
			</dt>

			<dd class="content">
			　　<?php echo blog_tool_purecontent(ishascomment($value['content'],$value['logid']), 168);?>
			</dd>
			<dd class="operation clearfix">
				<div class="operation-btn">
					<a href="javascript:void(0);" class="liulan" title="浏览">
						<div class="dingcai">
							<span></span>
							<i><?php echo $value['views'];?></i>
						</div>
					</a>
					<div class="operation-line"></div>
				</div>
				<div class="operation-btn">
					<a href="javascript:void(0);" class="index-comment comment" title="评论">
						<div class="dingcai"><span></span><i><?php echo $value['comnum'];?></i></div>
					</a>
					<div class="operation-line"></div>
				</div>
				<div class="operation-btn">
					<a href="javascript:void(0);" class="zan" title="点赞">
						<div class="dingcai">
							<span></span>
							<i><?php echo $value['praise'];?></i>
						</div>
					</a>
				</div>
				<a class="reward" href="javascript:void(0)">打赏</a>																		</dd>
		</dl>
		</div>
			<?php 
			$index_log1 = $Tconfig["index_num"] - 1;
			if($pageurl == Url::logPage() && $key == $index_log1){break;}
			endforeach;
			else:
			?>
		<div class="user_wz" data-aos="<?php echo $Tconfig["aosxg"];?>">
		<dl class="main-list">
			<dt>
				<a href="<?php echo BLOG_URL.'author/'.$author ?>">
					<img src="<?php echo $userinfo['photo'];?>">
				</a>
				<p class="user">
					<a href="<?php echo BLOG_URL.'author/'.$author ?>"><?php echo $userinfo['nickname'];?></a>
					<span class="fr">
					&nbsp;没写东西,所以没时间</span>
				</p>
				<span class="title"><a title="我是个懒鬼！" href="<?php echo BLOG_URL.'author/'.$author ?>">我是个懒鬼！</a></span>
			</dt>

			<dd class="content">
			　　大家好，我是个懒鬼！为什么这么说呢？因为我什么文章都没发过啊，你还看我的资料干什么呢？赶快去看别人的吧...
			</dd>
			<dd class="operation clearfix">
				<div class="operation-btn">
					<a href="javascript:void(0);" class="liulan" title="浏览">
						<div class="dingcai">
							<span></span>
							<i>0</i>
						</div>
					</a>
					<div class="operation-line"></div>
				</div>
				<div class="operation-btn">
					<a href="javascript:void(0);" class="index-comment comment" title="评论">
						<div class="dingcai"><span></span><i>0</i></div>
					</a>
					<div class="operation-line"></div>
				</div>
				<div class="operation-btn">
					<a href="javascript:void(0);" class="zan" title="点赞">
						<div class="dingcai">
							<span></span>
							<i>0</i>
						</div>
					</a>
				</div>
				<a class="reward" href="javascript:void(0)">什么都不写,还打赏个屁</a>
			</dd>
		</dl>
		</div>
			<?php endif;?>
		<?php
			$com = $DB->query("select * from ".DB_PREFIX."comment where mail='".$userinfo['email']."' order by date desc limit 0,10");
			while($usercom = $DB->fetch_array($com)){ 
			$sql = "select gid,title from ".DB_PREFIX."blog where gid={$usercom['gid']} ";
			$re = $DB->query($sql);
			$title = $DB->fetch_array($re);
			$hidetitle = '<a href="'.Url::log($usercom['gid']).'">'.$title["title"].'</a>';
			$content=$usercom["comment"];
			$date=date("Y-m-d H:i:s",$usercom["date"]); 
			?>
		<div class="user_pl" style="display:none" data-aos="<?php echo $Tconfig["aosxg"];?>">
		<dl class="main-list">
			<dt>
				<a href="<?php echo BLOG_URL.'author/'.$author ?>">
					<img src="<?php echo $userinfo['photo'];?>">
				</a>
				<p class="user">
					<a href="<?php echo BLOG_URL.'author/'.$author ?>"><?php echo $userinfo['nickname'];?></a>
					<span class="fr">
					&nbsp;<?php echo $date; ?></span>
				</p>
				<span class="title"><?php echo $hidetitle;?></span>
			</dt>

			<dd class="content">
			　　<?php echo comcontent(htmlspecialchars($content));?>
			</dd>
			<dd class="operation clearfix">
				<div class="dizhi"><i class="fa fa-desktop"></i> 来自:<?php echo get_ip($usercom['ip']);?>的dalao</div>
				<a class="reward" href="javascript:void(0)">打赏</a>
			</dd>
		</dl>
		</div>
		<?php } if($userinfo['comnum']==0){ ?>
		<div class="user_pl" style="display:none" data-aos="<?php echo $Tconfig["aosxg"];?>">
		<dl class="main-list">
			<dt>
				<a href="<?php echo BLOG_URL.'author/'.$author ?>">
					<img src="<?php echo $userinfo['photo'];?>">
				</a>
				<p class="user">
					<a href="<?php echo BLOG_URL.'author/'.$author ?>"><?php echo $userinfo['nickname'];?></a>
					<span class="fr">
					&nbsp; 没写评论,所以没时间</span>
				</p>
				<span class="title">懒到没朋友</span>
			</dt>
			<dd class="content">
			　　该用户还没发表过评论，懒鬼一个，鉴定完毕!
			</dd>
		</dl>
		</div>
		<?php }?>
		<?php echo fly_page($lognum,$index_lognum,$page,$pageurl);?>
	</div>
 </div>
<script>
$('.user_btn_pl').on('click',function(){
	$('.user_btn_pl').addClass("hover");$('.user_btn_wz').removeClass("hover");
	$('.user_pl').show();$('.user_wz,.excerpt-page').hide()
});
$('.user_btn_wz').on('click',function(){
	$('.user_btn_wz').addClass("hover");$('.user_btn_pl').removeClass("hover");
	$('.user_wz,.excerpt-page').show();$('.user_pl').hide()
});
</script>
<aside class="sidebars">
		<?php
		    $db = Database::getInstance();
		    $query = $db->query('SELECT uid,role,nickname,username,photo,vip FROM '.DB_PREFIX.'user ORDER BY vip DESC limit 0,15');
        	$ads = array();
        	while ($ad = $db->fetch_array($query)) {
        		$ads[] = $ad;
        	}
		?>
<ul class="row">
<li class="widget" data-aos="<?php echo $Tconfig['aosxg'];?>">
	<div class="user_author_title">
		<h2>活跃用户 <a href="javascript:;" title="此处按VIP等级排行">排行</a></h2>
		<div class="clearfix"></div>
	</div>
	<ul class="user_author_row row">
		<?php foreach ($ads as $value) {
			$value['nickname'] = htmlspecialchars($value['nickname']);
			if($value['nickname'] == '') $value['nickname'] = "未命名";
			if($value['photo']){$value['photo'] = BLOG_URL.substr($value['photo'], 3);}else{$value['photo'] = BLOG_URL.'content/templates/FLY/img/avatar.png';}
		?>
		<li class="col-sm-4 user_author_col">
			<a href="<?php echo BLOG_URL.'author/'.$value['uid'] ?>" class="avatar" alt="<?php echo $value['nickname'];?>">
				<img class="lazy user_author_img" src="<?php echo TEMPLATE_URL; ?>img/avatar.png" data-original="<?php echo $value['photo'];?>" alt="<?php echo $value['nickname'];?>">
			<p><?php echo $value['nickname'];?></p>
			</a>
		</li>
		<?php } ?>
	</ul>
</li>
</ul>
</aside>
</section>
<?php  include View::getView('footer');?>
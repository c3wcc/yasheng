<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
date_default_timezone_set('Asia/Shanghai');
function _vip($uid = '0') {
	if($uid==''){$uid = UID;}
	$DB = Database::getInstance();
	$row = $DB->once_fetch_array("select * from ".DB_PREFIX."user where uid='$uid'");
	
	return '-1';
}
//widget：blogger
function widget_blogger($title){
	global $Tconfig;
$db = Database::getInstance();
$sta_cache = array();
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "user WHERE role = 'admin'");
$blog_admin = $data['total'];
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE  top = 'y' or sortop = 'y' AND type = 'blog'");
$log_top = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'blog WHERE type = \'blog\'');
$log_total = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'comment');
$log_com = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'link');
$log_link = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'sort');
$log_sort = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'tag');
$log_tag = $data['total'];
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "twitter");
$wei_yu = $data['total'];
$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE type = 'page'");
$log_page = $data['total'];
$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'user');
$count_user = $data['total'];
$sql = 'SELECT * FROM ' . DB_PREFIX . 'blog WHERE type=\'blog\' ORDER BY date DESC LIMIT 0,1';
$res = $db->query($sql);
$row = $db->fetch_array($res);
$date = date('n月j日', $row['date']);
?>
<div class="widget <?php echo $Tconfig["wow"];?>">
	<div class="widget_about">
		<section class="about">
		<h3><?php echo $title; ?></h3>
		<span><?php echo $Tconfig["side_mm"];?></span>
		<div class="excerpt">
			<p>
				<?php echo $Tconfig["side_txt"];?>
			</p>
		</div>
		<ul class="layout_ul">
			<li class="layout_li">
			<span>文章</span>
			<b><?php echo $log_total;?></b>
			</li>
			<li class="layout_li">
			<span>评论</span>
			<b><?php echo $log_com;?></b>
			</li>
			<li class="layout_li">
			<span>标签</span>
			<b><?php echo $log_tag;?></b>
			</li>
			<li class="layout_li">
			<span>微语</span>
			<b><?php echo $wei_yu;?></b>
			</li>
		</ul>
		</section>
	</div>
</div>
<?php }?>
<?php
//标签云
function page_tags(){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<?php foreach($tag_cache as $value): ?>
	<a title="<?php echo $value['usenum']; ?> 篇文章" href="<?php echo Url::tag($value['tagurl']); ?>" target="_blank"><?php echo $value['tagname']; ?><em>(<?php echo $value['usenum']; ?>)</em></a>
	<?php endforeach; ?>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
    global $CACHE;
	global $Tconfig;
    $tag_cache = $CACHE->readCache('tags');?>
	<div class="widget widget_ui_tags <?php echo $Tconfig["wow"];?>">
		<h3><?php echo $title; ?></h3>
		<ul>
		<?php shuffle ($tag_cache);
		$tag_cache = array_slice($tag_cache,0,30);foreach($tag_cache as $value): ?>
			<a title="<?php echo $value['usenum']; ?> 篇文章" href="<?php echo Url::tag($value['tagurl']); ?>"><?php echo $value['tagname']; ?> (<?php echo $value['usenum']; ?>)</a>
		<?php endforeach; ?>
		</ul>
	</div>
<?php }?>
<?php
//widget：最新微语
function widget_twitter($title){
	global $CACHE; 
  	global $Tconfig;
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<div class="widget widget_ui_comments <?php echo $Tconfig["wow"];?>">
	<h3><i class="fa fa-twitch fa-fw" aria-hidden="true"></i>  最新微语</h3>
	<ul>
      <?php foreach($newtws_cache as $value): ?>
		<li style="margin-left: 0px;"><a href="/t">
		<img class="avatar avatar-50 photo avatar-default" height="50" width="50" src="<?php global $CACHE;$user_cache = $CACHE->readCache('user');if($user_cache[1]['photo']['src']){echo BLOG_URL.$user_cache[1]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" style="display: block;">
		<?php echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img alt="face" src="'.TEMPLATE_URL.'img/face/$1.gif"  />',$value['t'],1);?> - <?php echo smartDate($newtws_cache[0]['date']); ?></a></li>
      <?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<?php endif;?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE;
	global $Tconfig;
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
		<div class="widget widget_ui_posts <?php echo $Tconfig["wow"];?>">
		<h3><?php echo $title; ?></h3>
		<ul>		
<?php foreach($newLogs_cache as $value): 
            $thum_src = getThumbnail($value['gid']);
            $imgsrc = getimgforgid($value['gid']);
            if($thum_src) {
                $img = $thum_src;
            }elseif($imgsrc){
                $img = $imgsrc;
            }else{
                $img = TEMPLATE_URL.'static/img/random/'.substr($value['gid'],-1).'.jpg';
            }?>
			<li><a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><span class="thumbnail"><img data-src="<?php echo $img;?>" alt="<?php echo $value['title']; ?>" src="<?php echo $img;?>"" class="thumb"></span><span class="text"><?php echo $value['title']; ?></span><span class="muted"><?php echo gettime($value['gid']);?></span><span class="muted">阅读(<?php echo blog_content($value['gid'],'views');?>)</span></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
	global $Tconfig;
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$hotLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<div class="widget widget_ui_posts <?php echo $Tconfig["wow"];?>">
		<h3><?php echo $title; ?></h3>
		<ul>		
<?php foreach($hotLogs as $value): 
            $thum_src = getThumbnail($value['gid']);
            $imgsrc = getimgforgid($value['gid']);
            if($thum_src) {
                $img = $thum_src;
            }elseif($imgsrc){
                $img = $imgsrc;
            }else{
                $img = TEMPLATE_URL.'static/img/random/'.substr($value['gid'],-1).'.jpg';
            }?>
			<li><a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><span class="thumbnail"><img data-src="<?php echo $img;?>" alt="<?php echo $value['title']; ?>" src="<?php echo $img;?>"" class="thumb"></span><span class="text"><?php echo $value['title']; ?></span><span class="muted"><?php echo gettime($value['gid']);?></span><span class="muted">阅读(<?php echo blog_content($value['gid'],'views');?>)</span></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
<?php }?>

<?php
//widget：随机文章
function widget_random_log($title){
	global $Tconfig;
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<div class="widget widget_ui_posts <?php echo $Tconfig["wow"];?>">
		<h3><?php echo $title; ?></h3>
		<ul>		
<?php foreach($randLogs as $value): 
            $thum_src = getThumbnail($value['gid']);
            $imgsrc = getimgforgid($value['gid']);
            if($thum_src) {
                $img = $thum_src;
            }elseif($imgsrc){
                $img = $imgsrc;
            }else{
                $img = TEMPLATE_URL.'static/img/random/'.substr($value['gid'],-1).'.jpg';
            }?>
			<li><a href="<?php echo Url::log($value['gid']); ?>"><span class="thumbnail"><img data-src="<?php echo $img;?>" alt="<?php echo $value['title']; ?>" src="<?php echo $img;?>"" class="thumb"></span><span class="text"><?php echo $value['title']; ?></span><span class="muted"><?php echo gettime($value['gid']);?></span><span class="muted">阅读(<?php echo blog_content($value['gid'],'views');?>)</span></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
<?php }?>
<?php
function islogin(){
if(ROLE == 'admin' || ROLE == 'writer'){
	return true;
	}
	return false;
}
?>
<?php
//widget：最新评论
function widget_newcomm($title){
    global $CACHE; 
	global $Tconfig;
    $com_cache = $CACHE->readCache('comment');
    ?>	
	<div class="widget widget_ui_comments <?php echo $Tconfig["wow"];?>">
		<h3>最新评论</h3>
		<ul>
		<?php
        $user_cache = $CACHE->readCache('user');
        foreach($com_cache as $value):
        $ls_role='';
        $url = Url::comment($value['gid'], $value['page'], $value['cid']);
		foreach($user_cache as $k=>$a){
			$role = $a["role"];
			$name = $a["name"];
			$mail = $a["mail"];
			$photo = $a["photo"];
			if($value['name']==$name&&$value['mail']==$mail){
				if($role=="admin"){
					$ls_role='class="comment_admin author" title="管理员"';
					$isuserphoto = empty($photo) ? getqqpic($value['mail']) : BLOG_URL.$photo['src'];
				}
				if($role=="writer"){
					$ls_role='class="comment_writer author" title="本站会员"';
					$isuserphoto = empty($photo) ? getqqpic($value['mail']) : BLOG_URL.$photo['src'];
				}
				break;
			}
		}
        if(empty($ls_role)){
            $ls_role='class="comment_visitor author" title="游客"';
            $isuserphoto = getqqpic($value['mail']);
        }
        ?>
			<li class=""><a href="<?php echo $url; ?>" title="来自《<?php echo $value['name'];?>dalao》的评论"><time> <?php echo sydate($value['date'],true);?></time><img alt='<?php echo $value['name'];?>' src='<?php echo $isuserphoto;?>' class='avatar avatar photo avatar-default'/><span><?php echo $value['name']; ?></span>
			<p>
				<?php echo isPrivateComment(comcontent($value['content']))?'<font color="red">##机密吐槽##</font>':comcontent($value['content']); ?>
			</p>
			</a></li>
		<?php endforeach; ?>	
		</ul>
	</div>
<?php }?>
<?php
//widget：搜索
function widget_search($title){
	global $Tconfig;?>
	<div class="widget widget_ui_posts <?php echo $Tconfig["wow"];?>">  
    <h3><?php echo $title; ?></h3> 
    <ul class="list-unstyled souul">
        <form name="keyform" method="get" action="<?php echo BLOG_URL; ?>">
            <div class="input-group">
                <input name="keyword" value="请善用搜索功能" class="form-control search soutext" type="text" onfocus="if (value =='请善用搜索功能'){value =''}" onblur="if (value ==''){value='请善用搜索功能'}"/>
                <div class="input-group-btn"> <button class="btn btn-default soubtn">搜索</button> </div>
            </div>
        </form>
    </ul>
    </div>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
    global $CACHE;
	global $Tconfig;
    $record_cache = $CACHE->readCache('record');
    ?>

		<li class="widget widget_archive <?php echo $Tconfig["wow"];?>">
  <div class="widget-title"><span class="icon"><i class="fa fa-th-list"></i></span>
    <h3><?php echo $title; ?></h3>
  </div>
    <ul class="row gd-sort">
    <?php foreach($record_cache as $value): ?>
    <li class="col-sm-6 gd-sort-li"><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
    <?php endforeach; ?>
    </ul>
    </li>
<?php } ?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	global $Tconfig;
	$sort_cache = $CACHE->readCache('sort'); 
	?>
	<div class="widget widget_ui_sort <?php echo $Tconfig["wow"];?>">
		<h3><?php echo $title; ?></h3>
         <div class="items"> 
            <ul>
		<?php
	foreach($sort_cache as $value):
		$sid=$value["sid"];
		if ($value['pid'] != 0) continue;
	?>
              <li> <a title="<?php echo $value['lognum'] ?> 篇文章" href="<?php echo Url::sort($value['sid']); ?>"><i class="<?php if(empty($Tconfig["arr_sortico"][$sid])){echo "fa fa-code";}else{echo $Tconfig["arr_sortico"][$sid];}?>"></i> <?php echo $value['sortname']; ?></a> </li> 
	<?php endforeach; ?>
			</ul>
          </div>
	</div>
<?php }?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){
	global $Tconfig;?>
	<?php echo $content; ?>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
    global $CACHE;
	global $Tconfig;
    $link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
    ?>
	<a href="/links" class="widget_links_gduo <?php echo $Tconfig["wow"];?>">更多>></a>
	<div class="widget widget_ui_links <?php echo $Tconfig["wow"];?>">
		<h3><?php echo $title; ?></h3>
		<ul class='xoxo blogroll'>
		 <?php foreach($link_cache as $value): ?>
			<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><img src="<?php echo TEMPLATE_URL; ?>inc/ico.php?url=<?php $icourl = preg_replace('/(http:\/\/)|(https:\/\/)/i', '', $value['url']);echo $icourl;?>" alt="links" class="link-icon"> <?php echo $value['link']; ?></a></li>
		<?php endforeach; ?>
		</ul>
	</div>
<?php }?>

<?php
//blog：导航
function blog_navi(){
    global $CACHE;
	global $Tconfig;
    $navi_cache = $CACHE->readCache('navi');
            foreach($navi_cache as $value):
            $id=$value["id"];
            if ($value['pid'] != 0) {
                continue;
            }
            $newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
            $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
			$current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'active' : '';
            ?>
		<li id="menu-item" class="<?php if (!empty($value['children']) || !empty($value['childnavi'])) :?>menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item<?php endif;?><?php echo $current_tab;?>" >
                <a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>>
				<?php if(empty($Tconfig['arr_navico'][$id])) {echo $value['naviname'];}else {echo "<i class='".$Tconfig['arr_navico'][$id]."'></i> ".$value['naviname']."";} ?>
				<?php if (!empty($value['children']) || !empty($value['childnavi'])) :?>
				<?php endif;?>                
				</a>
				<?php if (!empty($value['children'])) :?>
                <ul class="sub-menu">
                    <?php foreach ($value['children'] as $row){
                            echo '<li id="menu-item" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item"><a href="'.Url::sort($row['sid']).'"><i class="'.$Tconfig['arr_sortico'][$row['sid']].'"></i> '.$row['sortname'].'</a></li>';
                    }?>
                </ul>
                <?php endif;?>
                <?php if (!empty($value['childnavi'])) :?>
                <ul class="sub-menu">
                    <?php foreach ($value['childnavi'] as $row){
                            $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                            echo '<li id="menu-item" class="menu-item menu-item-type-taxonomy menu-item-object-category current-menu-item menu-item"><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                    }?>
                </ul>
                <?php endif;?>
            </li>
            <?php endforeach; ?>
			<?php if($Tconfig['more']== 1 ){?>
			<?php echo $Tconfig['more_html'];?>
			<?php }?>
<?php }?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<div class=\"zd\"><i class=\"fa fa-zhidin\"></i></div>" : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<div class=\"zd\"><i class=\"fa fa-zhidin\"></i></div>" : '';
    }
}
?>
<?php
//blog：置顶
function topflg1($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<div class=\"btn btn-danger btn-xs m-zd\">置顶</div>" : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<div class=\"btn btn-danger btn-xs m-zd\">置顶</div>" : '';
    }
}
?>
<?php
//blog：分类
function blog_sort($blogid){
    global $CACHE; 
    $log_cache_sort = $CACHE->readCache('logsort');
    ?>
    <?php if(!empty($log_cache_sort[$blogid])): ?>
	<a class="btn btn-primary btn-xs cat" href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?><i></i></a>
    <?php else:?>
	<a class="btn btn-primary btn-xs cat">未分类<i></i></a>
	<?php endif;?>
<?php }?>
<?php
//blog：分类
function fee_sort($blogid){
    global $CACHE; 
    $log_cache_sort = $CACHE->readCache('logsort');
    ?>
    <?php if(!empty($log_cache_sort[$blogid])): ?>
	<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" rel="category tag"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
    <?php else:?>
	未分类
	<?php endif;?>
<?php }?>
<?php
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<a rel=\"tag\" href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag; }
	else {$tag = '这篇文章木有标签';
		echo $tag;}
}
//blog：文章标签
function blog_tags($blogid){
    global $CACHE;
    $tag_model = new Tag_Model();

    $log_cache_tags = $CACHE->readCache('logtags');
    if (!empty($log_cache_tags[$blogid])){
        $tag = '';
        foreach ($log_cache_tags[$blogid] as $value){
            $tag .= "<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
        }
        echo $tag;
    }
    else
    {
        $tag_ids = $tag_model->getTagIdsFromBlogId($blogid);
        $tag_names = $tag_model->getNamesFromIds($tag_ids);

        if ( ! empty($tag_names))
        {
            $tag = '';

            foreach ($tag_names as $key => $value)
            {
                $tag .= "<a href=\"".Url::tag(rawurlencode($value))."\">".htmlspecialchars($value).'</a>';
            }

            echo $tag;
        }
    }
}
?>
<?php
//blog：文章作者
function blog_author($uid){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $author = $user_cache[$uid]['name'];
    $mail = $user_cache[$uid]['mail'];
    $avatar= getGravatar($mail);
    $des = $user_cache[$uid]['des'];
    $title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
    echo '<a href="'.Url::author($uid)."\" > <img src=\"$avatar\" > $author</a>";
}
?>
<?php
//blog：文章作者
function feee_author($uid){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $author = $user_cache[$uid]['name'];
    $mail = $user_cache[$uid]['mail'];
    $avatar= getGravatar($mail);
    $des = $user_cache[$uid]['des'];
    $title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
    echo '<a title="查看更多文章" href="'.Url::author($uid)."\" > $author</a>";
}
?>
<?php
//blog：面包屑导航
function mianbao_navi($blogid,$log_title){
	global $CACHE; 
	$log_cache_navi = $CACHE->readCache('logsort');
	?>
	当前位置：<a href="<?php echo BLOG_URL; ?>">首页</a> <small>&gt;</small> <?php if(!empty($log_cache_navi[$blogid])): ?><a href="<?php echo Url::sort($log_cache_navi[$blogid]['id']); ?>"><?php echo $log_cache_navi[$blogid]['name']; ?></a><?php else:?>
	未分类
	<?php endif;?> <small>&gt;</small> 正文

<?php }?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
    extract($neighborLog);?>		
    <?php if($nextLog || $prevLog){?>
	<nav class="nav-reveal">
	<?php if($prevLog):?>
		<a class="prev" href="<?php echo Url::log($prevLog['gid']) ?>"><span class="icon-wrap"><i class="fa fa-angle-left"></i></span>
			<div class="prev-bg" style="background-image: url(<?php echo getpostimagetop($prevLog['gid']);?>);">
				<h3><span>上一篇</span><?php echo $prevLog['title'];?></h3>
			</div>
		</a>
	<?php else : ?>
	<?php endif;?>
	<?php if($nextLog):?>
		<a class="next" href="<?php echo Url::log($nextLog['gid']) ?>"><span class="icon-wrap"><i class="fa fa-angle-right"></i></span>
		<div class="next-bg" style="background-image: url(<?php echo getpostimagetop($nextLog['gid']);?>);">
			<h3><span>下一篇</span><?php echo $nextLog['title'];?></h3>
		</div>
		</a>
	<?php else : ?>
	<?php endif;?>
	</nav>
<?php };?>
<?php }?>
<?php
//blog：相邻文章
function neighbor1_log($neighborLog){
	
    extract($neighborLog);?>
    <?php if($nextLog || $prevLog){?>
	<nav class="article-nav <?php echo $Tconfig["wow"];?>">
	<?php if($prevLog):?>
		<span class="article-nav-prev">上一篇<br>
		<a href="<?php echo Url::log($prevLog['gid']) ?>" rel="prev"><?php echo $prevLog['title'];?></a></span>
		<?php else : ?>
	<?php endif;?>

    <?php if($nextLog):?>
		<span class="article-nav-next">下一篇<br>
		<a href="<?php echo Url::log($nextLog['gid']) ?>" rel="next"><?php echo $nextLog['title'];?></a></span>
		<?php else : ?>
<?php endif;?>
		</nav>
		
    <?php };?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments,$params){ 
global $Tconfig;
    extract($comments);
    if($commentStacks): ?>
	<?php endif; ?>
   <?php
	$isGravatar = Option::get('isgravatar');
  $comnum = count($comments);foreach($comments as $value){if($value['pid'] != 0){$comnum--;}}
$page = isset($params[5])?intval($params[5]):1;
$i= $comnum - ($page - 1)*Option::get('comment_pnum');
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	foreach($commentStacks as $cid):
	$ls_role='';
    $comment = $comments[$cid];
	$isNofollow = $comment['url'] && $comment['url'] != BLOG_URL ? 'rel="nofollow"':'';
	foreach($user_cache as $k=>$a){
		$role = $a["role"];
		$name = $a["name"];
		$mail = $a["mail"];
		$qq = $a["qq"];
		$zhuye = $a["zhuye"];
		$photo = $a["photo"];
		if($comment['poster']==$name&&$comment['mail']==$mail){
			if($role=="admin"){
				$ls_role='<span class="level level-admin" title="本站站长">站长</span><span class="level level-5">已认证</span>';
				$is_userqq = empty($qq) ? '' : '<a href="tencent://message/?uin='.$qq.'" title="联系'.$name.'" rel="nofollow"><img src="'.TEMPLATE_URL.'img/qq.gif"></a>';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			if($role=="writer"){
				$ls_role='<span class="member">会员</span>';
				$is_userqq = empty($qq) ? '' : '<a href="tencent://message/?uin='.$qq.'" title="联系'.$name.'" rel="nofollow"><img src="'.TEMPLATE_URL.'img/qq.gif"></a>';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			break;
		}
	}
	if(empty($ls_role)){
		$ls_role='<span class="tourist">游客</span>';
		$is_userqq = '';
		$isuserlink = $comment['url'];
		$isuserphoto = getqqpic($comment['mail']);
	}
	$comment['poster'] = $isuserlink ? '<a href="https://f162.cn/go/?url='.($isuserlink).'" target="_blank" class="url" '.$isNofollow.'>'.$comment['poster'].'</a>' : $comment['poster'];	
	$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<div class=\"comt-main-img\"><ul class=\"photos-thumb\"><li data-src=\"$1\"><img src=\"$1\"></li></ul><div class=\"photo-viewer\" style=\"display: none;\"><img src=\"/\"></div></div>"',$comment['content']); 
	?>
		<li class="comment even thread-even depth-1" id="comment-<?php echo $comment['cid']; ?>"><span class="comt-f">#<?php echo $i; ?></span>
		<?php if($isGravatar == 'y'): ?>
		<div class="comt-avatar">
			<img data-src="<?php echo $isuserphoto;?>" class="avatar avatar-100" height="100" width="100" src="<?php echo $isuserphoto;?>" style="display: block;">
		</div>
		<?php endif; ?>		
		<div class="comt-main" id="div-comment-<?php echo $comment['cid']; ?>">
		<div class="comment-content-user">
			<span class="comment-auth"><?php echo $comment['poster']; ?></span> <?php echo $ls_role;?> <?php echo echo_levels("\"".strip_tags($comment['mail'])."\"","\"".$isuserlink."\"");?><?php if($comment['comment_top']=='y'){echo '<span class="commentTop" title="评论置顶">TOP</span>';}?>
		</div>
		<div class="comment-content-text">
			<p>
				 <?php echo showPrivateComment(comcontent($comment['content']),$comment['mail'],$_COOKIE["postermail"]); ?>
			</p>
		</div>
		<div class="comment-content-info" data-no-instant="">
			<span><?php echo $comment['date']; ?></span><span><a rel="nofollow" class="comment-reply-link" href="javascript:;" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></span>
		</div>
		</div>  		            
		<?php blog_comments_children($comments, $comment['children']); ?>
		</li>
		<!-- #comment-## -->
		<?php $i--;endforeach;?>  
		<div class="pagenav">
	    <?php echo $commentPageUrl;?>
		</div>		
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	foreach($children as $child):
	$comment = $comments[$child];
	$isNofollow = $comment['url'] && $comment['url'] != BLOG_URL ? 'rel="nofollow"':'';
	$ls_role='';
	foreach($user_cache as $k=>$a){
		$role = $a["role"];
		$name = $a["name"];
		$mail = $a["mail"];
		$qq = $a["qq"];
		$zhuye = $a["zhuye"];
		$photo = $a["photo"];
		if($comment['poster']==$name&&$comment['mail']==$mail){
			if($role=="admin"){
				$ls_role='<span class="level level-admin" title="本站站长">站长</span><span class="level level-5">已认证</span>';
				$is_userqq = empty($qq) ? '' : '<a href="tencent://message/?uin='.$qq.'" title="联系'.$name.'" rel="nofollow"><img src="'.TEMPLATE_URL.'img/qq.gif"></a>';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			if($role=="writer"){
				$ls_role='<span class="member">会员</span>';
				$is_userqq = empty($qq) ? '' : '<a href="tencent://message/?uin='.$qq.'" title="联系'.$name.'" rel="nofollow"><img src="'.TEMPLATE_URL.'img/qq.gif"></a>';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			break;
		}
	}
	if(empty($ls_role)){
		$ls_role='<span class="tourist">游客</span>';
		$isuserlink = $comment['url'];
		$isuserphoto = getqqpic($comment['mail']);
	}
	$comment['poster'] = $isuserlink ? '<a href="https://f162.cn/go/?url='.($isuserlink).'" target="_blank" class="url" '.$isNofollow.'>'.$comment['poster'].'</a>' : $comment['poster'];
	$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<div class=\"comt-main-img\"><ul class=\"photos-thumb\"><li data-src=\"$1\"><img src=\"$1\"></li></ul><div class=\"photo-viewer\" style=\"display: none;\"><img src=\"/\"></div></div>"',$comment['content']); 
	?>
	<ul class="children">
	<li class="comment byuser comment-author bypostauthor odd alt depth-2" id="comment-<?php echo $comment['cid']; ?>">
	<?php if($isGravatar == 'y'): ?>
	<div class="comt-avatar">
		<img data-src="<?php echo $isuserphoto;?>" class="avatar avatar-100" height="100" width="100" src="<?php echo $isuserphoto;?>" style="display: block;">
	</div>
	<?php endif; ?>
	<div class="comt-main" id="div-comment-<?php echo $comment['cid']; ?>">
		<div class="comment-content-user">
			<span class="comment-auth"><?php echo $comment['poster']; ?></span> <?php echo $ls_role;?> <?php echo echo_levels("\"".strip_tags($comment['mail'])."\"","\"".$isuserlink."\"");?>
		</div>
		<div class="comment-content-text">
			<p>
				 <?php echo showPrivateComment(comcontent($comment['content']),$comment['mail'],$_COOKIE["postermail"]); ?>
			</p>
		</div>
		<div class="comment-content-info" data-no-instant="">
			<span><?php echo $comment['date']; ?></span><span><a rel="nofollow" class="comment-reply-link" href="javascript:;" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></span>
		</div>
		</div> 
              <?php blog_comments_children($comments, $comment['children']); $ii++;?>
	</li>
	<!-- #comment-## -->
</ul>

 
<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	global $Tconfig;
    if($allow_remark == 'y'): ?>
      <div id="comment-place" class="comments-box <?php echo $Tconfig["wow"];?>">
	<div class="title" id="comments">
		<h3>评论 <?php echo $comnum;?></h3>
	</div>
	<div id="comment-post" class="no_webshot">
	<div class="cancel-comment-reply cancel-reply" id="cancel-reply" style="display:none"> 
<a id="cancel-comment-reply-link" href="javascript:void(0);" onclick="cancelReply()">取消回复</a> 
</div> 		
		<form id="commentform" onsubmit="return false;">
			<div class="comt">
				<div class="comt-box">
					<textarea placeholder="你的评论可以一针见血" class="input-block-level comt-area" name="comment" id="comment" cols="100%" rows="3" tabindex="1" onkeydown="if(event.ctrlKey&amp;&amp;event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
					<div class="comt-ctrl">
					<div class="comt-tips">
						<input type='hidden' name='gid' value='<?php echo $logid; ?>' id='comment_post_ID' />
                        <input type='hidden' name='pid' id='comment-pid' value='0' />
					</div>
						<div class="position">
							<a href="javascript:;" id="comment-smiley" title="表情"><b><i class="fa fa-smile-o"></i></b></a>
							<a href="javascript:addNumber('[私密评论]')"><i class="fa fa-lock"></i></a>
							<span class="comment_info" id="error1"></span>
							<b id="comt_ins_err"></b>
							<?php if(ROLE == ROLE_VISITOR){if(Option::get('comment_code') == 'y'){?><span class="yanzheng"> <?php echo $verifyCode; ?></span><?php }};?>
						 <?php if(SEND_MAIL == 'Y' || REPLY_MAIL == 'Y'){ ?>
                            <input value="y" checked="checked" type="checkbox" name="send" style="display:none">
                            <?php } ?>
						</div>
						<button onclick="postcomment()" type="submit" name="comment_submit" id="submit" tabindex="5">提交评论</button>
						<!-- <span data-type="comment-insert-smilie" class="muted comt-smilie"><i class="icon-thumbs-up icon12"></i> 表情</span> -->
					</div>
				</div>
				<div id="smiley" style="display: none;"><?php include View::getView('inc/smile');?></div>
				<?php if(ROLE == ROLE_VISITOR): ?>
				<div class="comt-comterinfo" id="comment-author-info">
					<ul>
						<li class="form-inline">
						<span class="input-group-addon"><i class="fa fa-qq"></i></span>
						<input id="qqhao" class="ipt" name="qq" type="text" value="" placeholder="QQ号(快速获取信息)"></li>
						<li class="form-inline">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input class="ipt" type="text" name="comname" id="author" value="<?php echo $ckname; ?>" tabindex="2" placeholder="昵称(必填)"></li>
						<li class="form-inline">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<input class="ipt" type="text" name="commail" id="email" value="<?php echo $ckmail; ?>" tabindex="3" placeholder="邮箱(必填)"></li>
						<li class="form-inline">
						<span class="input-group-addon"><i class="fa fa-link"></i></span>
						<input class="ipt" type="text" name="comurl" id="url" value="<?php echo $ckurl; ?>" tabindex="4" placeholder="网址"></li>
					</ul>
               </div>
				<?php endif; ?>

			</div>
		</form>
	</div>
</div>
    <?php endif; ?>
<?php }?>
<?php 
//解决页面标题重复
function page_tit($page) {
 if ($page>=2){ 
 echo ' _第'.$page.'页'; 
 }
 }
 ?>
 <?php 
 //blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
function index_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	echo "<a href=\"".Url::author($uid)."\" title=\"查看关于 {$author} 的文章\">$author</a>";
}
/**
 * @des 显示评论列表与否的判定方法
 * @param $comnum 评论内容体
 * @return string 
 */
function isShowComment($comnum) {
	return !!$comnum;
} 

function sydate($ptime,$isunix=false){
	if(!$isunix){
		$ptime = strtotime($ptime);
	}
	$etime = time() - $ptime;
	if($etime < 1){return '刚刚';}
	$interval = array(
		12 * 30 * 24 * 60 * 60 => '年前 ('.date('Y-m-d', $ptime).')',
		30 * 24 * 60 * 60      => '个月前 ('.date('Y-m-d', $ptime).')',
		7 * 24 * 60 * 60       => '周前 ('.date('Y-m-d', $ptime).')',
		24 * 60 * 60           => '天前',
		60 * 60                => '小时前',
		60                     => '分钟前',
		1                      => '秒前',
	);
foreach ($interval as $secs => $str) {
		$d = $etime / $secs;
		if ($d >= 1){
			$r = round($d);
			return $r . $str ;
		}
	}
}
//获取文章图片数量
function pic($content){
	if(preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $content, $img) && !empty($img[1])){
		echo $imgNum = count($img[1]);
	}else{
		echo "0";
	}
}              
//外链IP库 支持https
function get_ips($commentip){
	$ip = @file_get_contents("https://ipip.yy.com/get_ip_info.php?ip=".$commentip."");
	$gs=json_decode(ltrim(rtrim($ip, ";"), "var returnInfo = "),true);
	echo $gs['country'].' '.$gs['province'].' '.$gs['city'];
}
//格式化内容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString(preg_replace("/\[gsvideo url=(.*) w=(.*) h=(.*)\]/", '', $content), 0, $strlen);
        }
        return $content;
}
//侧边栏评论
function sidecomcontent($pl) {
	$patterns = array ("/@/","/\[blockquote\](.*?)\[\/blockquote\]/","/\[F(([1-4]?[0-9])|50)\]/"); 
	$replace = array ('回复了','<small>$1</small>','<img alt="表情" src="'.TEMPLATE_URL.'static/img/face/$1.png" />'); 
	$pl=preg_replace($patterns, $replace, $pl);
	return $pl;
}
//评论内容
function comcontent($pl) {
	$patterns = array ("/@/","/\[blockquote\](.*?)\[\/blockquote\]/","/\[F(([1-4]?[0-9])|50)\]/"); 
	$replace = array ('回复了','<blockquote>$1</blockquote>','<img alt="表情" src="'.TEMPLATE_URL.'static/img/face/$1.png" />'); 
	$pl=preg_replace($patterns, $replace, $pl);
	return $pl;
}
// 判断是否为私密评论
function isPrivateComment($comments){
	return(strstr($comments,"[私密评论]"));
}
// 显示私密评论
function showPrivateComment($comments,$post_email,$current_email){
	// 如果是私密评论 是管理员身份或者发布私密者本身才会显示
	if(isPrivateComment($comments)){
		if($post_email===$current_email or ROLE == ROLE_ADMIN){
			return $comments;
		}else{
			return "<font color='red'>##私密评论仅博主可见##</font>";
		}
	}else{
		return $comments;
	}
}
//正则去除HTML
function ClearHtml($content) {  
   $preg = "/<\/?[^>]+>/i";
   return preg_replace($preg,'',$content);
}
//内容页标签
function neirong_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<a class=\"fcolor\" href=\"".Url::tag($value['tagurl'])."\"> ".$value['tagname'].'</a>';
		}
		return $tag;
	}
}
//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}
//获取blog表的一条内容,$content填写表名
function blog_content($gid,$content){
    $db = Database::getInstance();
    $sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE gid='".$gid."'";
    $sql = $db->query($sql);
    while ($row = $db->fetch_array($sql)) {
        $content = $row[$content];
	}
    return $content;
}
//获取附件第一张图片
function getThumbnail($blogid){
    $db = Database::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$blogid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
    //die($sql);
    $imgs = $db->query($sql);
    $img_path = "";
	if($db->num_rows($imgs)){
		while($row = $db->fetch_array($imgs)){
			 $img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));
		}
	}else{
		$img_path = false;
	}
    return $img_path;
}
//吐槽水军
function guest($num){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['name'];
	$DB = Database::getInstance();
	$sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date >0 and poster !='". $name ."' and  poster !='' and hide ='n' group by poster order by comment_nums DESC limit 0,$num";
	$log_content = $content[1];
	$i = 0;   //改动
	if(strpos($log_content, '[READERWALL-WEEK]') > -1) {
		$cur_time_span = strtotime('last Year',strtotime('Sunday'));
	}
	$result = $DB -> query( $sql );
	while($row = $DB -> fetch_array($result)){
		$i++;	//改动	
		//$img = "<a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(赐教" . $row[ 'comment_nums' ] . "次)\"><img  alt=\"avatar\"  src=\"" . getqqpic($row['mail']) . "\" class=\"avatar\"><em>" . $row[ 'poster' ] ."</em><strong>+" . $row[ 'comment_nums' ] . "</strong></a>";			
		//if( $row[ 'url' ] ){
		//	$tmp = "<a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(吐槽" . $row[ 'comment_nums' ] . "次)<br>" . $row[ 'url' ] . "\" ><img  alt=\"avatar\"  src=\"" . getqqpic($row['mail']) . "\"><em>" . $row[ 'poster' ] ."</em><strong>+" . $row[ 'comment_nums' ] . "</strong></a>";
		//}else{
		//	$tmp = $img;
		//}				
		if($i<=3){
			if($i==1){
				$mingpai = '【钻石VIP读者】';
			}else if($i==2){
				$mingpai = '【金牌VIP读者】';
			}else if($i==3){
				$mingpai = '【银牌VIP读者】';
			}
			$tmp = '<a class="item-top item-'.$i.'" target="_blank" href="'.$row['url'].'"><h4>'.$mingpai.'<small>评论：'.$row['comment_nums'].'</small></h4><img class="avatar avatar-36 photo avatar-default" height="36" width="36" src="'. getqqpic($row['mail']) .'"/><strong>'.$row['poster'].'</strong><div class="urla">'.$row['url'].'</div></a>';
		}else{
			
			$tmp = '<a target="_blank" href="'.$row['url'].'" title="【第'.$i.'名】评论：'.$row['comment_nums'].'"><img data-src="'. getqqpic($row['mail']) .'" class="avatar avatar-36" height="36" width="36" src="'. getqqpic($row['mail']) .'" style="display: block;">'.$row['poster'].'</a>';
		}
		$output .= $tmp;
	}
	$output = ''. $output .'';
	return $output ;
}
//获取头像
function getqqpic($email){
	$qq = explode('@',$email);
            $pic = 'https://q2.qlogo.cn/headimg_dl?dst_uin='.$qq[0].'&spec=100';
            $pic = $qq[1] =='qq.com' ? $pic : $pic = SB_getGravatar($email);
	return $pic;
}
//blog-tool:获取Gravatar头像并缓存到本地
function SB_getGravatar($email, $s=40, $d='monsterid', $r='g') {
    $f = md5($email);
	if(empty($email)){
	$a = TEMPLATE_URL.'static/img/avatar.png';
	}else{
	$a = TEMPLATE_URL.'static/img/avatar/'.$f.'.jpg';
	}
    $e = EMLOG_ROOT.'/content/templates/'.get_template_name().'/static/img/avatar/'.$f.'.jpg';
    $t = 1296000; //15天，单位：秒
    if (empty($d)) $d = TEMPLATE_URL.'static/img/avatar.png';
	if (!is_file($e) || (time() - filemtime($e)) > $t ) {
        //当头像不存在或者超过15天才更新
        $g = sprintf("https://secure.gravatar.com",(hexdec($f{0})%2)).'/avatar/'.$f.'?s=48&d='.$d.'&r='.$r;
        copy($g,$e); $a=$g; //新头像copy时, 取gravatar显示
    }
    if (filesize($e) < 500) copy($d,$e);
    return $a;
}
//comment：输出评论人等级
function echo_levels($comment_author_email,$comment_author_url){
	$DB = Database::getInstance();
	global $CACHE;
	$user_cache = $CACHE->readCache('user'); 
	$adminEmail = '"'.$user_cache[1]['mail'].'"';
	// if($comment_author_email==$adminEmail){
        // echo ' <span class="level level-admin" title="本站站长">站长</span>';
	// }
	$sql = "SELECT cid as author_count,mail FROM ".DB_PREFIX."comment WHERE mail != '' and mail = $comment_author_email and hide ='n'";
	$res = $DB->query($sql);
	$author_count = $DB->num_rows($res);
	if($author_count>=0 && $author_count<5 && $comment_author_email!=$adminEmail)
         echo '<span class="level level-1" title="VIP等级：初入联盟 LV.1">Lv.1</span>';
	else if($author_count>=5 && $author_count<10 && $comment_author_email!=$adminEmail)
		echo '<span class="level level-2" title="VIP等级：英勇黄铜 LV.2">Lv.2</span>';
	else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
		echo '<span class="level level-3" title="VIP等级：不屈白银 LV.3">Lv.3</span>';
	else if($author_count>=20 && $author_count<30 && $comment_author_email!=$adminEmail)
		echo '<span class="level level-4" title="VIP等级：华贵铂金 LV.4">Lv.4</span>';
	else if($author_count>=30 &&$author_count<40 && $comment_author_email!=$adminEmail)
		echo '<span class="level level-5" title="VIP等级：璀璨钻石 LV.5">Lv.5</span>';
	else if($author_count>=40 && $author_coun<50 && $comment_author_email!=$adminEmail)
		echo '<span class="level level-6" title="VIP等级：超凡大师 LV.6">Lv.6</span>';
	else if($author_count>=50 && $author_coun<60 && $comment_author_email!=$adminEmail)
		echo '<span class="level level-7" title="VIP等级：最强王者 LV.7">Lv.7</span>';
	else if($author_count>=60 && $author_coun<70 && $comment_author_email!=$adminEmail)
		echo '<span class="level level-8" title="VIP等级：职业选手 LV.8">Lv.8</span>';
}
//分页函数
function fly_page($count,$perlogs,$page,$url,$anchor=''){
global $Tconfig;
$pnums = @ceil($count / $perlogs);
$page = @min($pnums,$page);
$prepg=$page-1;
$nextpg=($page==$pnums ? 0 : $page+1);
$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
$re = "<div class=\"pagination\"><ul>";
if($pnums<=1) return false;		
if($page!=1) $re .=" <li><a href=\"$urlHome$anchor\">首页</a></li> "; 
if($prepg) $re .=" <li class=\"prev-page\"><a href=\"$url$prepg$anchor\" >上一页</a></li> ";
for ($i = $page-2;$i <= $page+2 && $i <= $pnums; $i++){
if ($i > 0){if ($i == $page){$re .= " <li class=\"active\"><span>$i</span></li>";
}elseif($i == 1){$re .= " <li><a href=\"$urlHome$anchor\">$i</a></li>";
}else{$re .= " <li><a href=\"$url$i$anchor\">$i</a></li> ";}
}}
if($nextpg) $re .=" <li class=\"next-page\"><a href=\"$url$nextpg$anchor\">下一页</a></li> "; 
if($page!=$pnums) $re.=" <li><a href=\"$url$pnums$anchor\" title=\"尾页\">尾页</a></li>";
$re .="<li class=\"tj\"><span>共 $pnums 页</span></li>";
$re .="</ul></div>";
return $re;}
//侧边栏日历获取
 function calendar() {
	$DB = Database::getInstance();
	$timezone = Option::get('timezone');
	$timestamp = time() + $timezone * 3600;
	
	$query = $DB->query("SELECT date FROM ".DB_PREFIX."blog WHERE hide='n' and checked='y' and type='blog'");
	while ($date = $DB->fetch_array($query)) {
		$logdate[] = gmdate("Ymd", $date['date'] + $timezone * 3600);
	}
	$n_year  = gmdate("Y", $timestamp);
	$n_year2 = number(gmdate("Y", $timestamp));
	$n_month = gmdate("m", $timestamp);
	$n_day   = gmdate("d", $timestamp);
	$time    = gmdate("Ymd", $timestamp);
	$year_month = gmdate("Ym", $timestamp);
	
	if (isset($_GET['record'])) {
		$n_year = substr(intval($_GET['record']),0,4);
		$n_year2 = substr(intval($_GET['record']),0,4);
		$n_month = substr(intval($_GET['record']),4,2);
		$year_month = substr(intval($_GET['record']),0,6);
	}
	
	$m  = $n_month - 1;
	$mj = $n_month + 1;
	$m  = ($m < 10) ? '0' . $m : $m;
	$mj = ($mj < 10) ? '0' . $mj : $mj;
	$year_up = $n_year;
	$year_down = $n_year;
	if ($mj > 12) {
		$mj = '01';
		$year_up = $n_year + 1;
	}
	if ( $m < 1) {
		$m = '12';
		$year_down = $n_year - 1;
	}
	$url = DYNAMIC_BLOGURL.'?action=cal&record=' . ($n_year - 1) . $n_month;
	$url2 = DYNAMIC_BLOGURL.'?action=cal&record=' . ($n_year + 1) . $n_month;
	$url3 = DYNAMIC_BLOGURL.'?action=cal&record=' . $year_down . $m;
	$url4 = DYNAMIC_BLOGURL.'?action=cal&record=' . $year_up . $mj;

	$calendar ="<table id=\"calendar\"><caption>{$n_year2}年{$n_month}月</caption><thead><tr><th scope=\"col\" title=\"星期一\">一</th><th scope=\"col\" title=\"星期二\">二</th><th scope=\"col\" title=\"星期三\">三</th><th scope=\"col\" title=\"星期四\">四</th><th scope=\"col\" title=\"星期五\">五</th><th scope=\"col\" title=\"星期六\">六</th><th scope=\"col\" title=\"星期日\">日</th></tr></thead><tbody>";
		
	$week = @gmdate("w",gmmktime(0,0,0,$n_month,1,$n_year));
	$lastday = @gmdate("t",gmmktime(0,0,0,$n_month,1,$n_year));
	$lastweek = @gmdate("w",gmmktime(0,0,0,$n_month,$lastday,$n_year));
	if ($week == 0) {
		$week = 7;
	}
	$j = 1;
	$w = 7;
	$isend = false;
	for ($i = 1;$i <= 6;$i++) {
		if ($isend || ($i == 6 && $lastweek==0)) {
			break;
		}
		$calendar .= '<tr>';
		for ($j ; $j <= $w; $j++) {
			if ($j < $week) {
				$calendar.= '<td>&nbsp;</td>';
			} elseif ( $j <= 7 ) {
				$r = $j - $week + 1;
				$n_time = $n_year . $n_month . '0' . $r;
				if (@in_array($n_time,$logdate) && $n_time == $time) {
					$calendar .= '<td id="today">'. $r .'</td>';
				} elseif (@in_array($n_time,$logdate)) {
					$calendar .= '<td>'. $r .'</td>';
				} elseif ($n_time == $time) {
					$calendar .= '<td id="today">'. $r .'</td>';
				} else {
					$calendar.= '<td>'. $r .'</td>';
				}
			} else {
				$t = $j - ($week - 1);
				if ($t > $lastday) {
					$isend = true;
					$calendar .= '<td>&nbsp;</td>';
				} else {
					$t < 10 ? $n_time = $n_year . $n_month . '0' . $t : $n_time = $n_year . $n_month . $t;
					if (@in_array($n_time,$logdate) && $n_time == $time) {
						$calendar .= '<td id="today">'. $t .'</td>';
					} elseif(@in_array($n_time,$logdate)) {
						$calendar .= '<td>'. $t .'</td>';
					} elseif($n_time == $time) {
						$calendar .= '<td id="today">'. $t .'</td>';
					} else {
						$calendar .= '<td>'.$t.'</td>';
					}
				}
			}
		}
		$calendar .= '</tr>';
		$w += 7;
	}
	$calendar .= '</tbody></table>';
	echo $calendar;
}
//查看该用户是否评论
function ishascomment($content,$post_id){
    global $Tconfig;
	if(preg_match_all('|\[hide\]([\s\S]*?)\[\/hide\]|i', $content, $hide_words)){
		if($_COOKIE['postermail'] && $_COOKIE['postermail'] != ''){
			$r = Database::getInstance();
			$row=$r->once_fetch_array("SELECT * FROM  `".DB_NAME."`.`".DB_PREFIX."comment` WHERE `mail` =  '".$_COOKIE['postermail']."' and `gid` = '".$post_id."' ORDER BY `date` DESC");
		}else if($_COOKIE['posterurl'] && $_COOKIE['posterurl'] != ''){
			$r = Database::getInstance();
			$row=$r->once_fetch_array("SELECT * FROM  `".DB_NAME."`.`".DB_PREFIX."comment` WHERE `url` =  '".$_COOKIE['posterurl']."' and `gid` = '".$post_id."' ORDER BY `date` DESC");
		}
		if($row && (time()-$row['date']) <= 3600*24 && $row['hide'] == 'n' || ROLE == "admin"){ //通过的评论在24小时之内
			$content = str_replace($hide_words[0],$hide_words[1], $content);
		}else{
			$hide_notice = '<span class="vihide">抱歉，隐藏内容 <a href="#comment">回复</a> 后刷新可见</span>';
			$content = str_replace($hide_words[0], $hide_notice, $content); 
		}
	}
    if(preg_match_all('|\[suo\]([\s\S]*?)\[\/suo\]|i', $content, $hide_words)){

          if($row && (time()-$row['date'])){ 
              $content = str_replace($hide_words[0],$hide_words[1], $content);
          }else{
              $hide_notice = '<li style="position:relative;list-style:none">
                  <div class="hidecontent" style="display:none">
                  '.$hide_words[1][0].'
                  </div>
                      <div class="hidetitle">
                      <button class="collapseButton">'.$Tconfig["pse_title"].'</button>
                  </div>
      </li>';
              $content = str_replace($hide_words[0], $hide_notice, $content); 
          }
      }
	return $content;
}
//Custom：获取模板目录名称
function get_template_name(){
    $template_name = str_replace(BLOG_URL,"",TEMPLATE_URL);
    $template_name = str_replace("content/templates/","",$template_name);
    $template_name = str_replace("/","",$template_name);
    return $template_name;
}
//数据库报错用
function getimgforgid($gid){
    $db = Database::getInstance();
    $sql = 'SELECT content FROM ' . DB_PREFIX . "blog WHERE gid='".$gid."'";
	$d = $db->once_fetch_array($sql);

	return isset($d['content']) && preg_match("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $d['content'], $img) ? $img[1] : false;
}
function getimgforgids($gid){
    $db = Database::getInstance();
    $sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE gid='".$gid."'";
    $img = $db->query($sql);
	$imgsrc = false;
	if($img){
		while ($row = $db->fetch_array($img)) {
			$content = $row['content'];
			$imgsrc = preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
			$imgsrc = !empty($img[1]) ? $img[1][0] : '';
		}
	}
    return $imgsrc;
}
function gettime($id){
	$db = Database::getInstance();
	$sql = 'SELECT * FROM ' . DB_PREFIX . "blog WHERE gid='".$id."'";
	$date = $db->query($sql);
	while ($row = $db->fetch_array($date)) {
		$time = date('Y-m-d',$row['date']);
	}
	return $time;
}
function up_curls($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$info = curl_exec($ch);
	curl_close($ch);
	return $info;
}
function times($t){
	if($t==0){
		$ts = '现在已经过凌晨了，身体是无价的资本喔，早点休息吧！';
	}elseif($t==1){
		$ts = '凌晨1点多了，工作是永远都做不完的，别熬坏身子！';
	}elseif($t==2){
		$ts = '该休息了，身体可是革命的本钱啊！';
	}elseif($t==3){
		$ts = '夜深了，熬夜很容易导致身体内分泌失调，长痘痘的！';
	}elseif($t==4){
		$ts = '四点过了，你明天不上班？？？';
	}elseif($t==5){
		$ts = '你知道吗，此时是国内网络速度最快的时候！';
	}elseif($t==6){
		$ts = '清晨好，这麽早就上论坛啦，昨晚做的梦好吗？';
	}elseif($t==7){
		$ts = '新的一天又开始了，祝你过得快乐!';
	}elseif($t==8){
		$ts = '早上好，一天之际在于晨，又是美好的一天！';
	}elseif($t<=12){
		$ts = '上午好！今天你看上去好精神哦！';
	}elseif($t<=13){
		$ts = '该吃午饭啦！有什么好吃的？您有中午休息的好习惯吗？';
	}elseif($t<=17){
		$ts = '下午好！外面的天气好吗？记得朵朵白云曾捎来朋友殷殷的祝福。';
	}elseif($t<=19){
		$ts = '太阳落山了！快看看夕阳吧！如果外面下雨，就不必了 ^_^';
	}elseif($t<=21){
		$ts = '晚上好，今天的心情怎么样，去吐槽版块诉说一下吧！';
	}elseif($t<=22){
		$ts = '忙碌了一天，累了吧？发篇文章醒醒脑吧！';
	}elseif($t<=23){
		$ts = '这么晚了，还在上网？早点洗洗睡吧，睡前记得洗洗脸喔！';
	}	
	return $ts;
}

?>
<?php
//首页置顶头条
function getZhidingLogs() {
$db = MySql::getInstance();
$sql = "SELECT gid,title,content,date FROM ".DB_PREFIX."blog WHERE type='blog' and top='y' ORDER BY `top` DESC ,`date` DESC LIMIT 0,1";
$list = $db->query($sql);
while($row = $db->fetch_array($list)){
//$row['content'] = htmlspecialchars($row['content']);
$row['content'] = strip_tags($row['content']);?>
<?php echo mb_substr($row['content'],0,85,'utf-8'); ?> 
<?php } ?>
<?php } ?>
<?php
//获取文章首张图片 内容用
function getpostimagetop($gid){
$db = MySql::getInstance();
$sql = "SELECT * FROM ".DB_PREFIX."blog WHERE gid=".$gid."";
//die($sql);
$imgs = $db->query($sql);
$img_path = "";
while($row = $db->fetch_array($imgs)){
preg_match('|<img.*src=[\"](.*?)[\"]|', $row['content'], $img);
//$rand_img = TEMPLATE_URL.'images/bg.jpg';//没有图片时显示的图
$randval   =   rand(0,9); 
$rand_img = TEMPLATE_URL.'static/img/random/'.$randval.'.jpg';
$imgsrc = !empty($img[0]) ? $img[1] : $rand_img;
    }
    return $imgsrc;
}

//全局匹配正文中的图片并存入imgsrc中
function img_zw($content){
	preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
	$randval   =   rand(0,9); 
	$rand_img = TEMPLATE_URL.'static/img/random/'.$randval.'.jpg';
	$imgsrc = !empty($img[1]) ? $img[1][0] : $rand_img;
	if($imgsrc):
	return 
	$imgsrc;endif;
	}
//Custom: 获取附件第一张图片
function img_fj($logid){
	$db = MySql::getInstance();
	$sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$logid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
	$imgs = $db->query($sql);$img_path = "";
	while($row = $db->fetch_array($imgs)){$img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));
	}
return $img_path;
}
?>
<?php
//30天按点击率排行文章
function getdatelogs($log_num) {
$db = MySql::getInstance();
$time = time();
$sql = "SELECT gid,title,comnum FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC LIMIT 0,$log_num";
$list = $db->query($sql);
while($row = $db->fetch_array($list)){ ?>
<li class="layout_li"><strong>[评论 <?php echo $row['comnum']; ?>]</strong><a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>"><span><?php echo ++$i;?></span><?php echo $row['title']; ?></a></li>
<?php } ?>
<?php } ?>
<?php
//随机文章
function getRandLog($log_num) {
$db = MySql::getInstance();
$sql = "SELECT gid,title,comnum FROM ".DB_PREFIX."blog WHERE type='blog' and hide='n' ORDER BY rand() LIMIT 0,$log_num";
$list = $db->query($sql);
while($row = $db->fetch_array($list)){ ?>
<li class="layout_li"><strong>[<?php echo gettime($row['gid']);?>]</strong><a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>"><span>荐</span><?php echo $row['title']; ?></a></li>
<?php } ?>
<?php } ?>
          
<?php //判断内容页是否百度收录
function baidu($url){
$url='http://www.baidu.com/s?wd='.$url;
$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$rs=curl_exec($curl);curl_close($curl);if(!strpos($rs,'没有找到')){return 1;}else{return 0;}}
function logurl($id){$url=Url::log($id);
if(baidu($url)==1){echo "百度已收录！";
}else{echo "<a style=\"color:red;\" rel=\"external nofollow\" title=\"点击提交收录！\" target=\"_blank\" href=\"http://zhanzhang.baidu.com/sitesubmit/index?sitename=$url\">百度尚未收录。</a>";}}
?>
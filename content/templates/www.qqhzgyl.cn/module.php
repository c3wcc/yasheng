<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
require_once View::getView('inc/config');
?>
<?php
//widget：blogger
function widget_blogger($title){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
	define('TEMROOT', EMLOG_ROOT.'/content/templates/meta/inc');
    $config_file = TEMROOT.'/config.php';
    if (is_file($config_file)) {include $config_file;}
	$author = $user_cache[$uid]['name'];
    $name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
<div class="sidebar-user">
	<div class="sidebar-user-img">
		<img src="<?php echo TEMPLATE_URL; ?>inc/api.php?qq=<?php echo $qqhm; ?>" alt="蓝优">
	</div>
	<div class="sidebar-user-name">
		<a href="mailto:<?php echo $qqhm; ?>@qq.com" title="<?php echo $qqhm; ?>@qq.com">蓝优</a>
	</div>
	<div class="sidebar-user-des">
		<span class="sidebar-qq"><a href="tencent://message/?uin=<?php echo $qqhm; ?>" rel="nofollow" target="_blank" title=""><i class="fa fa-qq"></i>联系</a></span>
	</div>
</div>

<?php }?>
<?php
//widget：日历
function widget_calendar($title){ ?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
        <div id="calendar"></div>
        <script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
</div>		
<?php }?>
<?php
//widget：标签
function widget_tag($title){
    global $CACHE;
    $tag_cache = $CACHE->readCache('tags');?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<div class="sidebar-tgas">
	<?php foreach($tag_cache as $value): ?>
	<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a>	
	<?php endforeach; ?>	
	</div>
</div>	
<?php }?>
<?php
//widget：分类
function widget_sort($title){
    global $CACHE;
    $sort_cache = $CACHE->readCache('sort'); ?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<div class="sidebar-tab">
<?php  foreach($sort_cache as $value):  if ($value['pid'] != 0) continue; ?>
        <a href="<?php echo Url::sort($value['sid']); ?>" title="<?php echo $value['lognum']; ?>"><?php echo $value['sortname']; ?></a>
		<span class='more pull-right'><a title='查看更多' href='<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>'>
<i class='fa fa-ellipsis-h'></i></a>
<?php if (!empty($value['children'])): ?>
<?php $children = $value['children']; foreach ($children as $key): $value = $sort_cache[$key]; ?>
        <a href="<?php echo Url::sort($value['sid']); ?>" title="<?php echo $value['lognum']; ?>"><?php echo $value['sortname']; ?></a>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>	
	</div>
</div>		
<?php }?>	
<?php
//widget：最新评论
function widget_newcomm($title){
    global $CACHE; 
    $com_cache = $CACHE->readCache('comment');
    ?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<div class="sidebar-txt">
		<ul class="sidebar-comment">
		<?php
        foreach($com_cache as $value):
        $url = Url::comment($value['gid'], $value['page'], $value['cid']);
        ?>
			<li>
			<img alt="<?php echo $value['name']; ?>" src="<?php echo getqqpic($value['mail']);?>" id="sidebar-avatar">
			<p class="sidebar-comment-name"><?php echo $value['name']; ?></p>
			<p class="sidebar-comment-txt">
				<a title="查看来自《<?php echo $value['name']; ?>》的评论" href="<?php echo $url; ?>"><?php echo sidecomcontent($value['content']); ?></a><myhk></myhk>
			</p>
			</li>
		<?php endforeach; ?>	
		</ul>
	</div>
</div>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
    global $CACHE; 
    $newLogs_cache = $CACHE->readCache('newlog');
	$i=0;
    ?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<ul>
	<?php foreach($newLogs_cache as $value):$i++; ?>
	<li><span class="s-<?php echo $i;?>"><?php echo $i;?></span><a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>" target="_blank"><?php echo $value['title']; ?></a></li>		
	<?php endforeach; ?>	
	</ul>
</div>		
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
    $index_hotlognum = Option::get('index_hotlognum');
    $Log_Model = new Log_Model();
    $hotLogs = $Log_Model->getHotLog($index_hotlognum);$i=0;?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<ul>
	<?php foreach($hotLogs as $value):$i++; ?>
	<li><span class="s-<?php echo $i;?>"><?php echo $i;?></span><a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>" target="_blank"><?php echo $value['title']; ?></a></li>		
	<?php endforeach; ?>	
	</ul>
</div>	
<?php }?>
<?php
//widget：随机文章
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);$i=0;?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<ul>
	<?php foreach($randLogs as $value):$i++; ?>
	<li><span class="s-<?php echo $i;?>"><?php echo $i;?></span><a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>" target="_blank"><?php echo $value['title']; ?></a></li>		
	<?php endforeach; ?>	
	</ul>
</div>		
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<div class="sidebar-txt">
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
        <input name="keyword" type="text" placeholder="输入关键词"/>
		<button type="submit"><i class="fa fa-search"></i></button>
    </form>	
	</div>
</div>	
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
    global $CACHE; 
    $record_cache = $CACHE->readCache('record');?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<div class="sidebar-tab">
	<?php foreach($record_cache as $value): ?>
	    <a href="<?php echo Url::record($value['date']); ?>"  title="<?php echo $value['lognum']; ?>"><?php echo $value['record']; ?></a>
	<?php endforeach; ?>
	</div>
</div>		
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<div class="sidebar-zdy">
	<?php echo $content; ?>
	</div>
</div>	
<?php } ?>
<?php
//widget：链接
function widget_link($title){
    global $CACHE; 
    $link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
    ?>
<div class="sidebar-box">
	<h3><i class="fa fa-th"></i><?php echo $title; ?></h3>
	<div class="sidebar-tab">
	<?php foreach($link_cache as $value): ?>
	   <a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a>
	<?php endforeach; ?>
	</div>
</div>		
<?php }?> 
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	define('TEMROOT', EMLOG_ROOT.'/content/templates/meta/inc');
    $config_file = TEMROOT.'/config.php';
    if (is_file($config_file)) {include $config_file;}
	?>
	<div class="pc-scroll">		
		<nav class="pc-nav-box">
		<ul id="pc-menu">	
        <?php foreach($navi_cache as $value): if ($value['pid'] != 0) {continue;}
        if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
         ?>
			<li><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">安全退出</a></li>
		<?php 
		continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $arrow_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'active' : '';
		$arrows_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? '' : 'arrow';
		?>
		    <li>
			<a class="<?php echo $arrow_tab;?><?php if (!empty($value['children']) || !empty($value['childnavi'])) :?><?php echo $arrows_tab;?><?php endif;?>" href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
			<?php if (!empty($value['children'])) :?>
            <ul class="pc-level">
                <?php foreach ($value['children'] as $row){
                    echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>
            <?php if (!empty($value['childnavi'])) :?>
            <ul class="pc-level">
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>
		</li>
	<?php endforeach; ?>
	<?php if($menu_more== 1 ){?>
	    <li>
		    <a class="arrow" href="javascript:void(0)">更多功能</a>
			<ul class="pc-level">
				<?php echo $menu_html;?>
			</ul>
		</li>
	<?php }?>	
		</ul>
		</nav>
	</div>
<?php }?>
<?php
//blog：导航
function menu_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	define('TEMROOT', EMLOG_ROOT.'/content/templates/meta/inc');
    $config_file = TEMROOT.'/config.php';
    if (is_file($config_file)) {include $config_file;}	
	?>
	<nav class="sidenav" id="sidenav" data-sidenav-toggle="#nav-toggle">
	    <div class="sidenav-brand">导航菜单</div>
		<ul class="sidenav-menu">
        <?php foreach($navi_cache as $value): if ($value['pid'] != 0) {continue;}
        if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
         ?>
			<li><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">安全退出</a></li>
		<?php 
		continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $active_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'active' : '';
		$sidenav = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? '' : 'data-sidenav-dropdown-toggle';
		$dropdown = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? '' : 'data-sidenav-dropdown';
		$font_i = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? '' : '<i class="fa fa-plus-square"></i>';
		?>
		 <li>
			<a class="<?php echo $active_tab;?>" <?php if (!empty($value['children']) || !empty($value['childnavi'])) :?><?php echo $sidenav;?><?php endif;?> href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?><?php if (!empty($value['children']) || !empty($value['childnavi'])) :?><?php echo $font_i;?><?php endif;?></a>
			<?php if (!empty($value['children'])) :?>
            <ul class="sidenav-dropdown" <?php echo $dropdown;?>>
                <?php foreach ($value['children'] as $row){
                    echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>
            <?php if (!empty($value['childnavi'])) :?>
            <ul class="sidenav-dropdown" <?php echo $dropdown;?>>
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';						
                        echo '<li><a href="' . $row['url'] . " \" $newtab >" . $row['naviname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>
		</li>
	<?php endforeach; ?>
	    <?php if($menu_more== 1 ){?>
		<li>
		<a data-sidenav-dropdown-toggle href="javascript:void(0)">更多功能<i class="fa fa-plus-square"></i></a> 
		<ul class="sidenav-dropdown" data-sidenav-dropdown >
		<?php echo $menu_html;?>
		</ul> 
		</li>
		<?php }?>
		</ul>
	</nav>	
<?php }?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<span class=\"new-post\">置顶</span>" : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<span class=\"new-post\"></span>" : '';
    }
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
    $editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
    echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
    global $CACHE; 
    $log_cache_sort = $CACHE->readCache('logsort');
    ?>
    <?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
    <?php endif;?>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '<i class="fa fa-tag"></i>';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<a href=\"".Url::tag($value['tagurl'])."\" title=\"".$value['tagname']." \">".$value['tagname'].'</a>';
		}
		echo $tag;
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
    $des = $user_cache[$uid]['des'];
    $title = !empty($mail) || !empty($des) ? "title=\"$des\"" : '';
    echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
//blog：文章作者
function index_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	if($uid==1){
		$ri='管理员';
	}else{
		$ri='站内会员';
	}
	echo "<div class=\"article-avater\"><img alt=\"作者\" src=\"".TEMPLATE_URL."/inc/api.php?qq=$mail\" height=\"50\" width=\"50\"></div>	
	<div class=\"article-card\"><a href=\"".Url::author($uid)."\" title=\"$ri\">$author</a>
	<span><a href=\"".Url::author($uid)."\"  target=\"_blank\" id=\"home\" title=\"\">主页</a><a href=\"tencent://message/?uin=$mail\" rel=\"nofollow\" target=\"_blank\" id=\"cat\" title=\"\">联系</a></span></div>
	<div class=\"article-qm\">签名：$des</div>	
	";
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
<?php if($prevLog):?>
<a href="<?php echo Url::log($prevLog['gid']) ?>" title="<?php echo $prevLog['title'];?>"><i class="fa fa-arrow-left white"></i></a>
<?php else: ?>
<a href="javascript:;" title="没有了哟" class="current"><i class="fa fa-arrow-left white"></i></a>
<?php endif;?>
<?php if($nextLog):?>
<a href="<?php echo Url::log($nextLog['gid']) ?>" title="<?php echo $nextLog['title'];?>"><i class="fa fa-arrow-right white"></i></a>
<?php else: ?>
<a href="javascript:;" title="没有了哟" class="current"><i class="fa fa-arrow-right white"></i></a>	
 <?php endif;?>
<?php }?> 
<?php
//blog：评论列表
function blog_comments($comments,$params){
    extract($comments);
    if($commentStacks): ?>
    <a name="comments"></a>
    <?php endif; ?>
    <?php
    $isGravatar = Option::get('isgravatar');
	global $CACHE;
	$comnum = count($comments);foreach($comments as $value){if($value['pid'] != 0){$comnum--;}}
	$page = isset($params[5])?intval($params[5]):1;
	$i= $comnum - ($page - 1)*Option::get('comment_pnum');
    foreach($commentStacks as $cid):
    $comment = $comments[$cid];  	
	$user_cache = $CACHE->readCache('user');    
	$isNofollow = $comment['url'] && $comment['url'] != BLOG_URL ? 'rel="nofollow"':'';
	$ls_role='';
	foreach($user_cache as $k=>$a){
		$role = $a["role"];
		$name = $a["name"];
		$mail = $a["mail"];
		$zhuye = $a["zhuye"];
		$photo = $a["photo"];
		if($comment['poster']==$name&&$comment['mail']==$mail){
			if($role=="admin"){
				$ls_role='title="管理员"';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			if($role=="writer"){
				$ls_role='title="本站会员"';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			break;
		}
	}	
	if(empty($ls_role)){
		$ls_role='title="游客"';
		$isuserlink = $comment['url'];
		$isuserphoto = getqqpic($comment['mail']);
	}
	$comment['poster'] = $isuserlink ? '<a href="/content/templates/meta/inc/go.php/?url='.base64_encode($isuserlink).'" '.$isNofollow.' target="_blank" '.$ls_role.'>'.$comment['poster'].'</a>' : $comment['poster'];
    ?>
	 <div class="comment" id="comment-<?php echo $comment['cid']; ?>">
        <a name="<?php echo $comment['cid']; ?>"></a>
        <?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo $isuserphoto;?>" /></div><?php endif; ?>
        <div class="comment-info">
            <strong><?php echo $comment['poster']; ?> </strong> 
			<span class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">@回复</a></span>
			<span class="floor">&nbsp;<?php if ($i == 1){ echo "沙发";} elseif ($i == 2){echo "板凳";} elseif ($i == 3){ echo "地板";} else{ echo $i.'楼';}?></span>
			<br /><span class="comment-time">发表于<?php echo $comment['date']; ?></span>
            <div class="comment-content"><?php echo comcontent($comment['content']); ?></div>          
        </div>
        <?php blog_comments_children($comments, $comment['children']); ?>
    </div> 
    <?php $i--;endforeach;?>
    <div id="pagenavi">
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
		$zhuye = $a["zhuye"];
		$photo = $a["photo"];
		if($comment['poster']==$name&&$comment['mail']==$mail){
			if($role=="admin"){
				$ls_role='title="管理员"';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			if($role=="writer"){
				$ls_role='title="本站会员"';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			break;
		}
	}	
	if(empty($ls_role)){
		$ls_role='title="游客"';
		$isuserlink = $comment['url'];
		$isuserphoto = getqqpic($comment['mail']);
	}
	$comment['poster'] = $isuserlink ? '<a href="/content/templates/meta/inc/go.php/?url='.base64_encode($isuserlink).'" '.$isNofollow.' target="_blank" '.$ls_role.'>'.$comment['poster'].'</a>' : $comment['poster'];
    ?>
  <div class="comment comment-children" id="comment-<?php echo $comment['cid']; ?>">
        <a name="<?php echo $comment['cid']; ?>"></a>
        <?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo $isuserphoto;?>" /></div><?php endif; ?>
        <div class="comment-info">
            <strong><?php echo $comment['poster']; ?> </strong><?php if($comment['level'] < 4): ?><span class="comment-reply"><a id="ta" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"><i class="fa fa-reply"></i>回复</a></span><?php endif; ?>
			<br /><span class="comment-time"><?php echo $comment['date']; ?></span>
            <div class="comment-content"><?php echo comcontent($comment['content']); ?></div>            
        </div>
        <?php blog_comments_children($comments, $comment['children']);?>
    </div>
    <?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
    if($allow_remark == 'y'): ?>
  <div id="comment-place">
    <div class="comment-post" id="comment-post">
        <div class="cancel-reply" id="cancel-reply" style="display:none"><div id="respond"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div></div>
        <a name="respond"></a>
        <form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
            <input type="hidden" name="gid" value="<?php echo $logid; ?>" />
            <?php if(ROLE == ROLE_VISITOR): ?>
			<div id="comment-input">			
				<input type="text" id="qq"  name="qq"  value="" placeholder="QQ获取" >
				<input type="text" id="comname"  name="comname"  value="<?php echo $ckname; ?>" placeholder="昵称">
				<input type="email" id="commail" name="commail"  value="<?php echo $ckmail; ?>" placeholder="邮箱">
				<input type="text" id="comurl"  name="comurl"  value="<?php echo $ckurl; ?>"  placeholder="网址">				          
			</div>
            <?php endif; ?>
            <p><textarea name="comment" id="comment" rows="5" tabindex="4"></textarea></p>
			<p class="smiley-box">
			<?php include View::getView('inc/smile');?>				
			</p>			
            <p class="form-submit">
			<span class="submit-tool">
			<a class="smiley" onclick="embedSmiley()" title="插入表情"><i class="fa fa-smile-o"></i></a>
			</span>	
			<span class="submit-tool">
			<a href="javascript:addNumber('今天在这里签到啦，又学了一些建站知识！')" title="签到"><i class="fa fa-pencil"></i></a>
			</span>			
			<?php echo $verifyCode; ?> <input type="submit" id="comment_submit" value="发表评论" tabindex="6" />
			<div id="ajaxloading"></div>						
			</p>
            <input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
        </form>
    </div>
    </div>		
    <?php endif; ?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}

function get_imgsrc($str){
preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $str, $match);
if(!empty($match[1])){
 echo $match[1][0]; }else{
 echo TEMPLATE_URL . 'images/zanwu.jpg'; } 
 }
 
//getimage
function picthumb($blogid) {
  $db = MySql::getInstance();
  $sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$blogid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
  //    die($sql);
  $imgs = $db->query($sql);
  while($row = $db->fetch_array($imgs)){
    $pict.= ''.BLOG_URL.substr($row['filepath'],3,strlen($row['filepath'])).'';
  }
  return $pict;
}
function img_zw($content){
	preg_match_all("/<img.*src\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i",str_ireplace("\\","",$content),$imgsrc);
	return $imgsrc[1][0];
} 

//代码压缩
function em_compress_html_main($buffer){
    $initial=strlen($buffer);
    $buffer=explode("<!--em-compress-html-->", $buffer);
    $count=count ($buffer);
    for ($i = 0; $i <= $count; $i++){
        if (stristr($buffer[$i], '<!--em-compress-html no compression-->')){
            $buffer[$i]=(str_replace("<!--em-compress-html no compression-->", " ", $buffer[$i]));
        }else{
            $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
            $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
            $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
            $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
            while (stristr($buffer[$i], '  '))
            {
            $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
            }
        }
        $buffer_out.=$buffer[$i];
    }
    $final=strlen($buffer_out);
    $savings=($initial-$final)/$initial*100;
    $savings=round($savings, 2);
    $buffer_out.="\n<!--压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->";
    return $buffer_out;
}

//pre不被压缩
function unCompress($content){
    if(preg_match_all('/(crayon-|<\/pre>)/i', $content, $matches)) {
        $content = '<!--em-compress-html--><!--em-compress-html no compression-->'.$content;
        $content.= '<!--em-compress-html no compression--><!--em-compress-html-->';
    }
    return $content;
}
//格式化内容工具
function geshihua($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString(preg_replace("/\[gsvideo url=(.*) w=(.*) h=(.*)\]/", '', $content), 0, $strlen);
        }
        return $content;
}
//获取头像
function getqqpic($email){
	$qq = explode('@',$email);
            $pic = TEMPLATE_URL.'inc/api.php?qq='.$qq[0].'';
            $pic = $qq[1] =='qq.com' ? $pic : $pic = SB_getGravatar($email);
	return $pic;
}
//blog-tool:获取Gravatar头像并缓存到本地
function SB_getGravatar($email, $s=40, $d='monsterid', $r='g') {
    $f = md5($email);
    $a = TEMPLATE_URL.'images/avatar.jpg';
    $e = EMLOG_ROOT.'/content/templates/meta/images/avatar.jpg';
    $t = 1296000; //15天，单位：秒
    if (empty($d)) $d = BLOG_URL.'avatar/default.jpg';
    if (!is_file($e) || (time() - filemtime($e)) > $t ) {
        //当头像不存在或者超过15天才更新
        $g = sprintf("http://secure.gravatar.com",(hexdec($f{0})%2)).'/avatar/'.$f.'?s=48&d='.$d.'&r='.$r;
        copy($g,$e); $a=$g; //新头像copy时, 取gravatar显示
    }
    if (filesize($e) < 500) copy($d,$e);
    return $a;
}
//QQ获取
$qq = isset($_GET['qq']) ? $_GET['qq'] : '';
if($qq != ''){
	$html = file_get_contents('http://r.pengyou.com/fcg-bin/cgi_get_portrait.fcg?uins='.$qq);
	$nic = explode(',',$html);
	$name = trim(mb_convert_encoding($nic[6], "UTF-8", "GBK"),'"');
	$img = file_get_contents('http://ptlogin2.qq.com/getface?appid=1006102&uin='.$qq.'&imgtype=3');
	preg_match('/pt.setHeader\((.*?)\);/',$img,$picc);
	$pic = json_decode($picc[1]);
	$json['name'] = $name;
	$json['pic'] = $pic->$qq;
	echo $_GET['callback'].'('.json_encode($json).')';
}else{
	echo '';
}
//评论内容
function comcontent($pl) {
	$patterns = array ("/@/","/\[blockquote\](.*?)\[\/blockquote\]/","/\[F(([1-4]?[0-9])|50)\]/"); 
	$replace = array ('回复了','<blockquote>$1</blockquote>','<img alt="表情" src="'.TEMPLATE_URL.'images/gin/$1.png" />'); 
	$pl=preg_replace($patterns, $replace, $pl);
	return $pl;
}
//侧边栏评论
function sidecomcontent($pl) {
	$patterns = array ("/@/","/\[blockquote\](.*?)\[\/blockquote\]/","/\[F(([1-4]?[0-9])|50)\]/"); 
	$replace = array ('回复了','<small>$1</small>','<img alt="表情" src="'.TEMPLATE_URL.'images/gin/$1.png" />'); 
	$pl=preg_replace($patterns, $replace, $pl);
	return $pl;
}
//Custom：获取模板目录名称
function get_template_name(){
    $template_name = str_replace(BLOG_URL,"",TEMPLATE_URL);
    $template_name = str_replace("content/templates/","",$template_name);
    $template_name = str_replace("/","",$template_name);
    return $template_name;
}
//单页排行榜
function guest($num){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['name'];
	$i = 0;
	$DB = Database::getInstance();
	$sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date >0 and poster !='". $name ."' and  poster !='' and hide ='n' group by poster order by comment_nums DESC limit 0,$num";
	$log_content = $content[1];
	if(strpos($log_content, '[READERWALL-WEEK]') > -1) {
		$cur_time_span = strtotime('last Year',strtotime('Sunday'));
	}
	$result = $DB -> query( $sql );
	while($row = $DB -> fetch_array($result)){$i++;
		if($i<=3 ){
			if($i==1){
				$mingpai = '金牌';
			}else if($i==2){
				$mingpai = '银牌';
			}else if($i==3){
				$mingpai = '铜牌';
			}
			$tmp = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"".TEMPLATE_URL."inc/go.php/?url=" . base64_encode($row[ 'url' ]) . "\" title=\"" . $row[ 'poster' ] ."(".$mingpai.")\"><img  alt=\"avatar\"   class=\"lazy\" src=\"".TEMPLATE_URL."images/lazyload.gif\"  data-original=\"" . getqqpic($row['mail']) . "\"><em id=\"iv".$i."\">" . $row[ 'poster' ] ."</em><strong id=\"iv".$i."\">".$mingpai."</strong></a></li>";			
		}else{
			
			$tmp = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"".TEMPLATE_URL."inc/go.php/?url=" . base64_encode($row[ 'url' ]) . "\" title=\"" . $row[ 'poster' ] ."\" ><img  alt=\"avatar\"   class=\"lazy\"  src=\"".TEMPLATE_URL."images/lazyload.gif\"  data-original=\"" . getqqpic($row['mail']) . "\"><em>" . $row[ 'poster' ] ."</em><strong>+" . $row[ 'comment_nums' ] . "</strong></a></li>";
		}
		$output .= $tmp;
	}
	$output = ''. $output .'';
	return $output ;
}
function fly_page($count,$perlogs,$page,$url,$anchor=''){
global $Tconfig;
$pnums = @ceil($count / $perlogs);
$page = @min($pnums,$page);
$prepg=$page-1;
$nextpg=($page==$pnums ? 0 : $page+1);
$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
$re = "<article class=\"excerpt excerpt-page\" data-aos=\"".$Tconfig['aosxg']."\"><div class=\"pagination\"><ul>";
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
$re .="</ul></div></article>";
return $re;}
?>
<?php //幻灯片置顶
function Slide(){
$db = MySql::getInstance();
$num = 4;
$sql ="select * from emlog_blog where  hide='n' AND type='blog' AND top='y' OR sortop='y' order by date DESC limit 0,$num";
$go = $db->query($sql);while($row = $db->fetch_array($go)){
$img_url = TEMPLATE_URL.'images/zanwu.jpg';//设置没有图片时的显示
if(img_zw($row['content'])){$img_url = img_zw($row['content']);//调用文章内容的第一张图片
}elseif(picthumb($row['gid'])){$img_url = picthumb($row['gid']);//调用附件的第一张图片
}else{$img_url;}?>
<li><a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title'];?>"><img src="<?php echo TEMPLATE_URL; ?>images/lazyload.gif" data-original="<?php echo $img_url; ?>" alt="<?php echo $row['title']; ?>" class="lazy" /></a></li>
<?php }} ?>
<?php //30天按点击率排行文章
function popular() {
$db = MySql::getInstance();
$log_num = 14;
$time = time();
$i=0;
$sql = "SELECT gid,title FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 90*24*60*60 ORDER BY `views` DESC LIMIT 0,$log_num";
$list = $db->query($sql);
while($row = $db->fetch_array($list)){$i++; ?>
<li><a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>"><i><?php echo $i;?></i><?php echo $row['title']; ?></a></li>
<?php } ?>
<?php } ?>
<?php //随机文章
function random(){
$db = MySql::getInstance();
$num = 4;
$sql ="SELECT * FROM ".DB_PREFIX."blog inner join ".DB_PREFIX."sort WHERE hide='n' AND type='blog' AND top='n' AND sortid=sid order by RAND() limit 0,$num";
$go = $db->query($sql);while($row = $db->fetch_array($go)){
$img_url = TEMPLATE_URL.'images/zanwu.jpg';//设置没有图片时的显示
if(img_zw($row['content'])){$img_url = img_zw($row['content']);//调用文章内容的第一张图片
}elseif(picthumb($row['gid'])){$img_url = picthumb($row['gid']);//调用附件的第一张图片
}else{$img_url;}?>
			<li>
			<a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title'];?>">
			<div class="min-img">
				<img src="<?php echo TEMPLATE_URL; ?>images/lazyload.gif" data-original="<?php echo $img_url; ?>" alt="<?php echo $row['title']; ?>" class="lazy" />
			</div>
			<div class="min-txt">
				<h3><?php echo $row['title'];?></h3>
				<font><?php echo gmdate('y年m月d日', $row['date']);?></font>
			</div>
			</a>
			</li>
<?php }} ?>
<?php // 随机云标签
function yun_tags(){
global $CACHE;$tag_cache = $CACHE->readCache('tags');
$num = 6;
shuffle($tag_cache); 
foreach($tag_cache as $key => $value):if($key < $num):?>
<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?>篇"><?php echo $value['tagname']; ?></a>
<?php endif;endforeach;}?>
<?php //点赞
 function syzan(){
$DB =MySql::getInstance();
if($DB->num_rows($DB->query("show columns from ".DB_PREFIX."blog like 'slzan'"))==0){
$sql ="ALTER TABLE ".DB_PREFIX."blog ADD slzan int unsigned NOT NULL DEFAULT '0'";
$DB->query($sql);}}syzan();

function update($logid){
$logid = intval($_POST['id']);
$DB =Database::getInstance();
$DB->query("UPDATE ". DB_PREFIX ."blog SET slzan=slzan+1 WHERE gid=$logid");
setcookie('slzanpd_'. $logid,'true', time()+31536000);}

function lemoninit(){if(@$_POST['plugin']=='slzanpd'&&@$_POST['action']=='slzan'&&isset($_POST['id'])){
$id = intval($_POST['id']);
header("Access-Control-Allow-Origin: *");
update($id);echo getnum($id);die;}}lemoninit();

function getnum($id){
static $arr = array();
$DB =Database::getInstance();
if(isset($arr[$logid]))return $arr[$logid];
$sql ="SELECT slzan FROM ". DB_PREFIX ."blog WHERE gid=$id";
$res = $DB->query($sql);
$row = $DB->fetch_array($res);
$arr[$id]= intval($row['slzan']);
return $arr[$id];}
?>
<?php
//相关日志
function related_logs($logData = array()){   
    $related_log_type = 'sort';//相关日志类型，sort为分类，tag为日志；
    $related_log_sort = 'rand';
    $related_log_num = '8';//显示文章数
    $related_inrss = 'y';//是否显示在rss订阅中，y为是，其它值为否    
    global $value;
    $DB = MySql::getInstance();
    $CACHE = Cache::getInstance();
    extract($logData);
    if ($value) {
        $logid = $value['id'];
        $sortid = $value['sortid'];
        global $abstract;
    }
    $sql = "SELECT gid,title FROM " . DB_PREFIX . "blog WHERE hide='n' AND type='blog'";
    if ($related_log_type == 'tag') {
        $log_cache_tags = $CACHE->readCache('logtags');
        $Tag_Model = new Tag_Model();
        $related_log_id_str = '0';
        foreach ($log_cache_tags[$logid] as $key => $val) {
            $related_log_id_str .= ',' . $Tag_Model->getTagByName($val['tagname']);
        }
        $sql .= " AND gid!={$logid} AND gid IN ({$related_log_id_str})";
    } else {
        $sql .= " AND gid!={$logid} AND sortid={$sortid}";
    }
    switch ($related_log_sort) { case 'rand':  $sql .= " ORDER BY rand()";  break; }
    $sql .= " LIMIT 0,{$related_log_num}";
    $related_logs = array();
    $query = $DB->query($sql);
    while ($row = $DB->fetch_array($query)) {
        $row['gid'] = intval($row['gid']);
        $row['title'] = htmlspecialchars($row['title']);
        $related_logs[] = $row;
    }
    $out = '';
    if (!empty($related_logs)) {
        foreach ($related_logs as $val) {
            $out .= "<div class=\"title\"><i class=\"fa fa-fire\"></i> <a href=\"" . Url::log($val['gid']) . "\" title=\"" . ($val['title']) . " \">{$val['title']}</a></div>";
        }
    }
    if (!empty($value['content'])) {
        if ($related_inrss == 'y') {
            $abstract .= $out;
        }
    } else {
        echo $out;
    }
}
?>
<?php
function islogin(){
if(ROLE == 'admin' || ROLE == 'writer'){
	return true;
	}
	return false;
}
?>
<?php 
/*
 * @Dream 2.9
 * @authors 1梦
 * @date    2016-7-21
 * @version 3.1
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<?php 
//取文本中间
function getSubstr($str, $leftStr, $rightStr, $yueguo = 1)
{
	$left = mb_strpos($str,$leftStr)+$yueguo;
	$right = mb_strpos($str,$rightStr);
    if($left < 0 or $right < $left) return '';
    return mb_substr($str,$left,$right-$left);
}
//取文章类型
function getPosttype($content){
	if(empty($content)){
		$ret='0';
	}else{
		$ret=getSubstr($content,"{type","}",5);
		if(empty($ret)){
			$ret='0';
		}
	}
	return $ret;
}

//格式化文章内容
function subPost($content){
	$ret=getSubstr($content,"{type","}");
	return str_replace('{'.$ret.'}', '', $content);
}
function random_str() {
    $poems = "#f4a7b9
rgb(114, 175, 235)
rgb(254, 212, 102)
rgb(100, 185, 255)
rgb(255, 170, 115)
rgb(250, 108, 111)";
    $poems = explode("\n", $poems);
    return $poems[rand(0, count($poems) - 1)];
}
function says() {
    $says = random_str();
    echo $says;
}
?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<section class="catui-item" id="sider-tagscloud">
	<div class="sider-header">
<div class="sider-title"><?php echo $title; ?></div>
<div onclick="get_sider_catui_item_disappear('tagscloud');" class="sider-close mdui-ripple"></div>
</div>
	<div class="sider-content">
	<?php foreach($tag_cache as $value): ?>
	<a href="<?php echo Url::tag($value['tagurl']); ?>"><?php echo $value['tagname']; ?> (<?php echo $value['usenum']; ?>)</a>
	<?php endforeach; ?>
	</div>
</section>
<?php }?>

<?php
//page-tags：标签云
function page_tags(){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<?php foreach($tag_cache as $value): ?>
	<a href="<?php echo Url::tag($value['tagurl']); ?>" target="_blank"><?php echo $value['tagname']; ?><em>(<?php echo $value['usenum']; ?>)</em></a>
	<?php endforeach; ?>
<?php }?>

<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
<section class="catui-item" id="sider-comments">
    <div class="sider-header">
        <div class="sider-title">近期评论</div>
        	        <div onclick="get_sider_catui_item_disappear('comments');" class="sider-close mdui-ripple"></div>
    </div>
<div class="sider-content">
<?php foreach($com_cache as $value): $url = Url::comment($value['gid'], $value['page'], $value['cid']); ?>
    <a class="mdui-ripple"  href="<?php echo $url; ?>" class="name" rel="nofollow">
        <span><?php echo $value['name']; ?></span>：<?php echo preg_replace("#\[smilies(\d+)\]#i",'<img src="'.TEMPLATE_URL.'images/face/$1.png" id="smilies$1" alt="表情$1"/>',($value['content'])); ?>
    </a>

友情链接

<?php endforeach; ?>
</div>
</section>	
<?php }?>

<?php
//widget：搜索
function widget_search($title){ ?>
<section class="catui-item" id="sider-search">
<div class="sider-content">
<form class="search" method="get" action="<?php echo BLOG_URL; ?>index.php">
<input type="text" placeholder="搜索文章或内容" name="keyword" class="search-input" >
<button type="submit" class="mdui-ripple mdui-btn"><i class="mdui-icon material-icons">search</i></button>
</form>
<div class="cat">
<div class="cat-header">
<div class="cat-ear-left mdui-ripple"></div>
<div class="cat-ear-right mdui-ripple"></div>
</div>
<div class="cat-body">
<a class="icon icon-speedometer mdui-ripple" href="<?php echo BLOG_URL; ?>admin" target="_blank" title="管理站点"></a>
<a class="icon icon-tag mdui-ripple" onclick="get_sider_catui_item_fixed('tagscloud');" title="标签云"></a>
<a class="icon icon-screen-smartphone mdui-ripple" onclick="get_sider_catui_item_fixed('qrcode');" title="二维码"></a>
<a class="icon icon-wallet mdui-ripple" onclick="get_sider_catui_item_fixed('support');" title="赞助"></a>
<a class="icon icon-grid mdui-ripple" onclick="get_sider_catui_item_fixed('category');" title="分类目录"></a>
<a class="icon icon-bubbles mdui-ripple" onclick="get_sider_catui_item_fixed('comments');" title="近期评论" href="#comments"></a>
<a class="icon icon-feed mdui-ripple" title="RSS" href="/" target="_blank"></a>
</div>
</div>
</div>
</section>
<?php } ?>

<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
<div class="widget widget_ui_textads"><a class="style01" href="#"><strong><?php echo $title; ?></strong><h2></h2><p><?php echo $content; ?></p></a></div>
<?php } ?>

<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	global $arr_navico1;
	$navi_cache = $CACHE->readCache('navi');
	foreach($navi_cache as $num=>$value):
		$id=$value["id"];
        if ($value['pid'] != 0) {
            continue;
        }
		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<?php if(ROLE == ROLE_ADMIN):?>
		
        <a href="<?php echo BLOG_URL; ?>admin/" >管理站点</a>
		<a href="<?php echo BLOG_URL; ?>?setting">站点配置</a>
			<?php endif;?>
		<a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>

					<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>>
					<?php
					//print_r($arr_navico);
					//die();
					if(empty($arr_navico1[$id])) {echo $value['naviname'];}else {echo "<i class='".$arr_navico1[$id]."'></i> ".$value['naviname']."";} ?></a>

			<?php if (!empty($value['children'])) :?>
            <ul id="menu-nav-main-menu" class="nav-menu main-menu">
                <?php foreach ($value['children'] as $row){
                        echo '<a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a>';
                }?>
			</ul>
            <?php endif;?>
            <?php if (!empty($value['childnavi'])) :?>
            <ul id="menu-nav-main-menu" class="nav-menu main-menu">
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a>';
                }?>
			</ul>
            <?php endif;?>
	<?php endforeach; ?>
<?php }?>

<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
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
    <a class="cat" href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"># <?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>

<?php function blog_tag($blogid)
{
    global $CACHE;
    $log_cache_tags = $CACHE->readCache('logtags');
    if (!empty($log_cache_tags[$blogid])) {
        foreach ($log_cache_tags[$blogid] as $value) {
            $tag .= "<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a> ';
        }
        echo $tag;
    }
}?>
<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>

<?php 
// 判断是否为私密评论
function isPrivateComment($comments){
	return(strstr($comments,"[私密评论]"));
}
// 显示私密评论
function showPrivateComment($comments,$post_email,$current_email){
	// 如果是私密评论 是管理员身份或者发布私密者本身才会显示
	if(isPrivateComment($comments)){
		if($post_email==$current_email or ROLE == ROLE_ADMIN){
			return $comments;
		}else{
			return "<font color='red'>##机密评论##</font>";
		}
	}else{
		return $comments;
	}
}
?>

<?php
//blog-tool:获取qq头像
function eflyGravatar($email) {
	$hash = md5(strtolower($email));
	$avatar = 'https://secure.gravatar.com/avatar/' . $hash . '?s=100&d=monsterid';
	if(empty($email)){
		$eflyGravatar = TEMPLATE_URL.'images/avatar.jpg';
	}
	else if(strpos($email,'@qq.com')){
		$qq = str_replace("@qq.com","",$email);
		if(is_numeric($qq) && strlen($qq) > 4 && strlen($qq) < 13){
			$eflyGravatar = 'https://q2.qlogo.cn/headimg_dl?dst_uin='.$qq.'&spec=100';
		}
		else{
			$eflyGravatar = $avatar;
		}
	}
	else{
		$eflyGravatar = $avatar;
	}
	return $eflyGravatar;
}
?>
<?php
//comment：输出评论人等级
function echo_levels($comment_author_email,$comment_author_url){
	$DB = MySql::getInstance();
	global $CACHE;
	$user_cache = $CACHE->readCache('user'); 
	$adminEmail = '"'.$user_cache[1]['mail'].'"';
	if($comment_author_email==$adminEmail){
		echo '<o class="svip" style="background-color:#F7A8A8;">博主</o>';
	}
	$sql = "SELECT cid as author_count,mail FROM ".DB_PREFIX."comment WHERE mail != '' and mail = $comment_author_email and hide ='n'";
	$res = $DB->query($sql);
	$author_count = mysql_num_rows($res);
	if($author_count>=0 && $author_count<5 && $comment_author_email!=$adminEmail)
		echo '<o class="vip" style="background-color:#FFEB3B;">Lv.1</o>';
	else if($author_count>=5 && $author_count<10 && $comment_author_email!=$adminEmail)
		echo '<o class="vip" style="background-color:#33CCFF;">Lv.2</o>';
	else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
		echo '<o class="vip" style="background-color:#6600FF;">Lv.3</o>';
	else if($author_count>=20 && $author_count<30 && $comment_author_email!=$adminEmail)
		echo '<o class="vip" style="background-color:#9966CC;">Lv.4</o>';
	else if($author_count>=30 &&$author_count<40 && $comment_author_email!=$adminEmail)
		echo '<o class="vip" style="background-color:#66FF99;">Lv.5</o>';
	else if($author_count>=40 && $author_coun<50 && $comment_author_email!=$adminEmail)
		echo '<o class="vip" style="background-color:#66FF66;">Lv.6</o>';
	else if($author_count>=50 && $author_coun<60 && $comment_author_email!=$adminEmail)
		echo '<o class="vip" style="background-color:#00CCCC;">Lv.7</o>';
	else if($author_count>=60 && $author_coun<70 && $comment_author_email!=$adminEmail)
		echo '<o class="vip" style="background-color:#FF33CC;">Lv.8</o>';
}
?>
<?php
//blog：评论列表
function blog_comments($comments,$params){
    extract($comments);
    if($commentStacks): ?>

	<?php endif; ?>
<div class="commentlist" id="comment_list">
	<?php
	$isGravatar = Option::get('isgravatar');
	$comnum = count($comments);  
   foreach($comments as $value){  
   if($value['pid'] != 0){$comnum--;}}  
   $page = isset($params[5])?intval($params[5]):1;  
   $i= $comnum - ($page - 1)*Option::get('comment_pnum'); 
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment even thread-even depth-<?php echo $comment['cid']; ?> parent plt" id="comment-<?php echo $comment['cid']; ?>">
	<div id="div-comment-<?php echo $comment['cid']; ?>" class="comment-body">
		<div class="comment-author vcard">
			<img src="<?php echo eflyGravatar($comment['mail']); ?>" class="avatar">
			<p class="fn"><?php echo $comment['poster']; ?></p>
			<span class="commentmetadata"><?php echo $comment['date']; ?></span>
			<?php echo echo_levels("\"".strip_tags($comment['mail'])."\"","\"".$comment['url']."\"");?>
			<a rel="nofollow" id="reply" class="comment-reply-link no-ajax" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">@回复</a>
		    
			<span class="floor"><?php if ($i == 1){ echo "沙发";}elseif ($i == 2){echo "板凳";}elseif ($i == 3){ echo "地板";}else{ echo "#".$i; }?></span>
		</div>
		<p class="txt-qq"><?php echo preg_replace("#\[smilies(\d+)\]#i",'<img src="'.TEMPLATE_URL.'images/face/$1.png" id="smilies$1" alt="表情$1"/>',$comment['content']); ?></p>

	</div>
	<?php blog_comments_children($comments, $comment['children'],$i,0); ?>
	</div>
	<?php $i--;endforeach;?>
    <div id="pagenavi">
	    <?php echo $commentPageUrl;?>
    </div>
</div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children,$i,$x){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$x=$x+1; 
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	$bicomment = preg_replace("#\@瑾忆:#",'<span class="vip" style="background-color: #FFC107;">@博主:</span>',$comment['content']);
	?>
	<ul class="children" style="
    -webkit-padding-start: 0; 
">
		<div class="comment byuser bypostauthor even depth-<?php echo $comment['cid']; ?> parent" id="comment-<?php echo $comment['cid']; ?>">
		<div id="div-comment-<?php echo $comment['cid']; ?>" class="comment-body">
			<div class="comment-author vcard">
				<img src="<?php echo eflyGravatar($comment['mail']); ?>" class="avatar">
				<p class="fn"><?php echo $comment['poster']; ?></p>
				<span class="commentmetadata"><?php echo $comment['date']; ?></span>
				<?php echo echo_levels("\"".strip_tags($comment['mail'])."\"","\"".$comment['url']."\"");?>
				<a rel="nofollow" id="reply" class="comment-reply-link no-ajax" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">@回复</a>
			    
				<span class="floor"><?php echo '#'.$i.'-'.$x; ?></span>
			</div>

			<p class="txt-qq"><?php echo preg_replace("#\[smilies(\d+)\]#i",'<img src="'.TEMPLATE_URL.'images/face/$1.png" id="smilies$1" alt="表情$1"/>',$bicomment); ?></p>
			
		</div>
		<?php blog_comments_children($comments, $comment['children'],$i,$x); ?>
		</div>
	</ul>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
<div id="comment-place">
 <div id="comment-post" class="comment-respond">
	<h3 id="reply-title" class="comment-reply-title">发表评论 <small><a rel="nofollow" id="cancel-reply" href="javascript:void(0);" onclick="cancelReply()" style="display:none;">取消回复</a></small></h3>
	<form action="<?php echo BLOG_URL; ?>index.php?action=addcom" method="post" id="commentform" class="comment-form">
<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
<div class="fbpl" style="border:1px solid #eee;">
<?php if(ROLE == ROLE_VISITOR): ?>
 <div class="comment-form-info" style="width: 100%;overflow: hidden;">
		<i class="comment-form-author">
  <input id="author" name="comname" type="text" value="<?php echo $ckname; ?>" size="30" maxlength="245" aria-required="true" required="required" placeholder="昵称">
		</i>
		<i class="comment-form-email">
  <input id="email" name="commail" type="text" value="<?php echo $ckmail; ?>" size="30" maxlength="100" aria-describedby="email-notes" aria-required="true" required="required" placeholder="邮件地址 (必填)">
		</i>
		<i class="comment-form-url">
  <input id="url" name="comurl" type="text" value="<?php echo $ckurl; ?>" size="30" maxlength="200" placeholder="个人主页 (选填)">
		</i>
 </div>
<?php endif; ?>
		<div class="comment-form-comment" style="
    width: 100%;
    overflow: hidden;
">
			<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required" placeholder="既然来了就说点什么吧..."></textarea>
		</div>
    <span class="OwO">
            <div class="OwO-logo"><span>OwO</span></div>
            <div class="OwO-body" style="max-width: 100%;">
                <ul class="OwO-items OwO-items-biaoqing OwO-items-show" style="max-height: 100px;">
<?php for($i = 1; $i <= 39; $i++): ?>
 <a class="OwO-item" data-action="addSmily" data-smilies="smilies<?php echo $i; ?>"><img src="<?php echo TEMPLATE_URL; ?>images/face/<?php echo $i; ?>.png"></a>
<?php endfor; ?>
                </ul>
            </div>
    </span>
</div>
		<div class="form-submit">
			<input name="submit" type="submit" id="submit" class="submit" value="发表评论"><input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID">
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
			<input type="hidden" name="comment_parent" id="comment_parent" value="0">
		</div>

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
?>
<?php //分页函数
function sheli_fy($count,$perlogs,$page,$url,$anchor=''){
$pnums = @ceil($count / $perlogs);
$page = @min($pnums,$page);
$prepg=$page-1;                 //shuyong.net上一页
$nextpg=($page==$pnums ? 0 : $page+1); //shuyong.net下一页
$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
//开始分页导航内容
$re = "";
if($pnums<=1) return false;	//如果只有一页则跳出	

for ($i = $page-2;$i <= $page+2 && $i <= $pnums; $i++){
if ($i > 0){if ($i == $page){$re .= " <li class='current'>$i</span> ";
}elseif($i == 1){$re .= " <li><a href=\"$urlHome$anchor\">$i</a></li> ";
}else{$re .= " <li><a href=\"$url$i$anchor\">$i</a></li> ";}
}}

return $re;}
?>
<?php
function getrandomim(){
	$imgsrc = TEMPLATE_URL."images/random/".rand(1,1).".jpg";
	return $imgsrc;
}
?>
<?php
//获取图片
function get_thum($logid){
 $db = MySql::getInstance();

	$sqlimg = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$logid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
//    die($sql);
	$img = $db->query($sqlimg);
    while($roww = $db->fetch_array($img)){
	 $thum_url=BLOG_URL.substr($roww['filepath'],3,strlen($roww['filepath']));
    }
    if (empty($thum_url)) {
            $thum_url = getrandomim();
        }
  
return $thum_url;
}
?>
<?php
function GetThumFromContent($content){
	/*图片和摘要*/
	preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
	if($imgsrc = !empty($img[1])){
		 $imgsrc = $img[1][0];}else{ 
			preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content ,$img);
			if($imgsrc = !empty($img[1])){ $imgsrc = $img[1][0];  }else{
				$imgsrc =getrandomim();	
			}
	}
	return $imgsrc;
}
?>
<?php
//格式化内容工具
function tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', $content);
		$content = preg_replace("/\[hide\](.*)\[\/hide\]/Uims", '|*********此处内容回复可见*********|', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
?>
<?php
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
?>

<?php
function GetFaceImg(){
	foreach ($Face as $key => $value) {
			$faceimg=TEMPLATE_URL.$value["url"];
			$tooltip='['.$value["title"].']';
			echo "<a href='javascript:;' title='$tooltip' data-title='$tooltip'><img src='{$faceimg}'></a>";
	}
}
?>

<?php 
function sort_name($arrsort){ 
global $arr_sortico1; 
foreach($arrsort as $key => $value){
	$sortid = $value;
	?>
	<div class="col-sm-4 0">
	 <div class="cmslist">
    	<div class="xyti">
            <h3><i class="<?php if(empty($arr_sortico1[$sortid])){echo "fa fa-list-ul";}else{echo $arr_sortico1[$sortid];}?>"></i><a href="<?php echo Url::sort($sortid);?>" class="mcolor"><?php echo getsotrnamefromsid($sortid);?></a></h3>
        </div>
        <ul><?php Get_newlogs($sortid,6);?></ul>
     </div>
	</div>
<?php }}?>

<?php function footer_link()
{
    global $CACHE;
    $link_cache = $CACHE->readCache('link'); ?>
    <?php foreach ($link_cache as $value):?>
        <a href="<?php echo $value['url']; ?>" class="mdui-btn" target="_blank" rel="nofollow"><?php echo $value['link']; ?></a>
    <?php endforeach; ?>
    <?php }?>




<?php
//首先你要有读写文件的权限
//本程序可以直接运行,第一次报错,以缶涂梢?
$online_log = "count.dat"; //保存人数的文件,
$timeout = 30;//30秒内没动作者,认为掉线
$entries = file($online_log);
$temp = array();
for ($i=0;$i<count($entries);$i++) {
 $entry = explode(",",trim($entries[$i]));
 if (($entry[0] != getenv('REMOTE_ADDR')) && ($entry[1] > time())) {
  array_push($temp,$entry[0].",".$entry[1]."\n"); //取出其他浏览者的信息,并去掉超时者,保存进$temp
 }
}
array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout))."\n"); //更新浏览者的时间
$users_online = count($temp); //计算在线人数
$entries = implode("",$temp);
//写入文件
$fp = fopen($online_log,"w");
flock($fp,LOCK_EX); //flock() 不能在NFS以及其他的一些网络文件系统中正常工作
fputs($fp,$entries);
flock($fp,LOCK_UN);
fclose($fp);
?>

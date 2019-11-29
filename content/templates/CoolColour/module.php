<?php
//blog：导航
function blog_navi(){global $CACHE;$navi_cache = $CACHE->readCache('navi');?>
<?php foreach($navi_cache as $value):if ($value['pid'] != 0) {continue;}
if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):?>
<li><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
<?php continue;endif;
$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
$current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'cli' : '';  //判断当前页改变类?>
<li><a class="<?php echo $current_tab;?>" href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
<?php if (!empty($value['children'])) : //非新窗户打开?>
<ul>
<?php foreach ($value['children'] as $row){
	echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';}?>
</ul>
<?php endif;?>
<?php if (!empty($value['childnavi'])) : //新窗口打开?> 
<ul>
<?php foreach ($value['childnavi'] as $row){
	$newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
	echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';}?>
</ul>
<?php endif;?>
</li>
<?php endforeach; ?>
<?php }?>
<?php
//widget：最新文章
function newlog(){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<?php $i=0;foreach($newLogs_cache as $value): if($i==0):?>
	<li  style="display: block;"><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php else: ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endif;$i++;endforeach; ?>
<?php }?>
<?php //文章缩略图获取
function get_imgsrc($str){
  preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $str, $match);
  if(!empty($match[1])){
    echo $match[1][0];
  }else{
    echo TEMPLATE_URL . 'images/ArticleImg/'.rand(1,20).'.jpg';
  }
}
?>
<?php //文章缩略图获取 返回地址
function is_img($str){
  preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $str, $match);
  if(!empty($match[1])){
    return $match[1][0];
  }else{
    return TEMPLATE_URL . 'images/ArticleImg/'.rand(1,20).'.jpg';
  }
}
?>
<?php
//通过id在文章中获取图片
function idby_img($logid){
$db = MySql::getInstance();
$sql = 	"SELECT content,date,views,comnum FROM ".DB_PREFIX."blog WHERE gid=".$logid."";
$list = $db->query($sql);
while($row = $db->fetch_array($list)){ 
	$li=array(is_img($row['content']),date('20y年m月d日',$row['date']),$row['views'],$row['comnum']);
	return $li;
 }} ?>
<?php
function DeleteHtml($str) 
{ 
$str = trim($str); //清除字符串两边的空格
$str = preg_replace("/\t/","",$str); //使用正则表达式替换内容，如：空格，换行，并将替换为空。
$str = preg_replace("/\r\n/","",$str); 
$str = preg_replace("/\r/","",$str); 
$str = preg_replace("/\n/","",$str); 
$str = preg_replace("/ /","",$str);
$str = preg_replace("/  /","",$str);  //匹配html中的空格
return trim($str); //返回字符串
}
 ?>
<?php
//widget：随机文章
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	
	<div class="article-push arclist bg-color mob-hidden animation-div">
	<h4 class="index-title"><i class="el-asl"></i><?php echo $title;?><small>Push Article</small></h4>
	<ul>
	<?php foreach($randLogs as $value):$li = idby_img($value['gid']); ?>
	<li>
		<div class="arcimg"> 
			<a href="<?php echo Url::log($value['gid']); ?>">
				<img alt="<?php echo $value['title']; ?>" src="<?php echo $li[0]; ?>" title="<?php echo $value['title']; ?>"> 
			</a>
		</div>
		<div class="arc-right">
			<h4 class="blue-text"><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></h4>
			<ul>
				<li><a title="发表时间"><i class="el-time"></i><?php echo $li[1]; ?></a></li>
				<li><a title="<?php echo $li[2]; ?>次浏览"><i class="el-fire"></i><?php echo $li[2]; ?></a></li>
			</ul>
		</div>
	</li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>

<?php
//widget：链接
function bottom_link(){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	<div class="footer-mid">
		<h2>友情链接</h2>
	<ul>
	<li>
	<?php foreach($link_cache as $value): ?>
	<a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
	<?php endforeach; ?>
	</li>
	</ul>
	</div>
<?php }?> 
<?php
//widget：分类
function widget_sort($title){global $CACHE;$sort_cache = $CACHE->readCache('sort'); ?>

<div class="bg-color article-push">
	<h4 class="index-title"><i class="el-heart"></i><?php echo $title; ?><small>Focus Me</small></h4>
		<div>
		<ul>
	<?php foreach($sort_cache as $value): ?>
	<li><a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?><?php if(empty($value['lognum'])){ echo "(0)";}else{echo "(".$value['lognum'].")";}?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
	</div>
<?php }?>
<?php
//blog：文章页分类
function blog_sorts($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
    <?php else: ?>
    <a rel="category tag">暂无分类</a>
	<?php endif;?>
<?php }?>
<?php
function echo_levels($comment_author_email,$comment_author_url){
$DB = MySql::getInstance();
global $CACHE;
	$user_cache = $CACHE->readCache('user'); 
	$adminEmail = '"'.$user_cache[1]['mail'].'"';
  if($comment_author_email==$adminEmail)
  {
    echo '<a class="vip" title="管理员认证"></a><a class="vip7" title="特别认证"></a>';
  }
  $sql = "SELECT cid as author_count,mail FROM ".DB_PREFIX."comment WHERE mail != '' and mail in ($comment_author_email) and hide ='n'";
  $res = $DB->query($sql);
  $author_count = mysql_num_rows($res);
   if($author_count>=2 && $author_count<10 && $comment_author_email!=$adminEmail)
    echo '<a class="vip1" title="路过酱油 LV.1"></a>';
  else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
    echo '<a class="vip2" title="偶尔光临 LV.2"></a>';
  else if($author_count>=20 && $author_count<40 && $comment_author_email!=$adminEmail)
    echo '<a class="vip3" title="常驻人口 LV.3"></a>';
  else if($author_count>=40 && $author_count<80 && $comment_author_email!=$adminEmail)
    echo '<a class="vip4" title="以博为家 LV.4"></a>';
  else if($author_count>=80 &&$author_count<160 && $comment_author_email!=$adminEmail)
    echo '<a class="vip5" title="情牵小博 LV.5"></a>';
  else if($author_count>=160 && $author_coun<320 && $comment_author_email!=$adminEmail)
    echo '<a class="vip6" title="为博终老 LV.6"></a>';
  else if($author_count>=50 && $author_coun<60 && $comment_author_email!=$adminEmail)
    echo '<a class="vip7" title="三世情牵 LV.7"></a>';
}
?>
<?php
//获取IP地理地址
$data = '254.254.254.254';
class IpLocation {
     var $fp;
     var $firstip;
     var $lastip;
     var $totalip;
         
     function getlong() {
        $result = unpack('Vlong', fread($this->fp, 4));
        return $result['long'];
     }

    function getlong3() {
        $result = unpack('Vlong', fread($this->fp, 3).chr(0));
        return $result['long'];
     }

     function packip($ip) {
        return pack('N', intval(ip2long($ip)));
     }
         
     function getstring($data = "") {
        $char = fread($this->fp, 1);
        while (ord($char) > 0) {
            $data .= $char;
            $char = fread($this->fp, 1);
        }
        return $data;
     }
         
     function getarea() {
        $byte = fread($this->fp, 1);
        switch (ord($byte)) {
            case 0:
               $area = "";
               break;
            case 1:
            case 2:
               fseek($this->fp, $this->getlong3());
               $area = $this->getstring();
               break;
            default: 
               $area = $this->getstring($byte);
               break;
        }
        return $area;
        }
         
     function getlocation($ip) {
        
        if (!$this->fp) return null;
        $location['ip'] = gethostbyname($ip); 
        $ip = $this->packip($location['ip']);
        $l = 0; 
        $u = $this->totalip;
        $findip = $this->lastip;
        while ($l <= $u) { 
            $i = floor(($l + $u) / 2); 
            fseek($this->fp, $this->firstip + $i * 7);
            $beginip = strrev(fread($this->fp, 4));
            if ($ip < $beginip) {
               $u = $i - 1;
            }
            else {
               fseek($this->fp, $this->getlong3());
               $endip = strrev(fread($this->fp, 4));
               if ($ip > $endip) {
                   $l = $i + 1; 
               }
               else {
                   $findip = $this->firstip + $i * 7;
                   break;
               }
            }
        }
        fseek($this->fp, $findip);
        $location['beginip'] = long2ip($this->getlong()); 
        $offset = $this->getlong3();
        fseek($this->fp, $offset);
        $location['endip'] = long2ip($this->getlong());
        $byte = fread($this->fp, 1); 
        switch (ord($byte)) {
            case 1: 
               $countryOffset = $this->getlong3();
               fseek($this->fp, $countryOffset);
               $byte = fread($this->fp, 1);
               switch (ord($byte)) {
                   case 2: 
                      fseek($this->fp, $this->getlong3());
                      $location['country'] = $this->getstring();
                      fseek($this->fp, $countryOffset + 4);
                      $location['area'] = $this->getarea();
                      break;
                   default: 
                      $location['country'] = $this->getstring($byte);
                      $location['area'] = $this->getarea();
                      break;
               }
               break;
            case 2:
               fseek($this->fp, $this->getlong3());
               $location['country'] = $this->getstring();
               fseek($this->fp, $offset + 8);
               $location['area'] = $this->getarea();
               break;
            default: 
               $location['country'] = $this->getstring($byte);
               $location['area'] = $this->getarea();
               break;
        }
        if ($location['country'] == " CZNET") { 
            $location['country'] = "未知";
        }
        if ($location['area'] == " CZNET") {
            $location['area'] = "";
        }
        return $location;
     }
         
     function IpLocation($filename = "./content/templates/CoolColour/lib/qqwry.dat") {
        $this->fp = 0;
        if (($this->fp = @fopen($filename, 'rb')) !== false) {
            $this->firstip = $this->getlong();
            $this->lastip = $this->getlong();
            $this->totalip = ($this->lastip - $this->firstip) / 7;
            register_shutdown_function(array(&$this, '_IpLocation'));
        }
     }
         
     function _IpLocation() {
        if ($this->fp) {
            fclose($this->fp);
        }
        $this->fp = 0;
     }
}
function getaddress($myip){
$ipOrDomain=$myip;
$iplocation = new IpLocation();
$location = $iplocation->getlocation($ipOrDomain);
$address=mb_convert_encoding($location['country'].$location['area'], "utf-8", "gbk");
return $address;
}?>
<?php
//获取评论用户操作系统、浏览器等信息
function useragent($info){
	require_once 'useragent.class.php';
	$useragent = UserAgentFactory::analyze($info);
	if(($useragent->platform['title'])=="未知操作系统" && ($useragent->browser['title'])=="未知浏览器"):?>
<img src="http://ilt.me/content/templates/lanye/img/16/os/iphone.png">&nbsp;手机发表此评论
<?php else: ?>
<img src='<?php echo TEMPLATE_URL.$useragent->platform['image']?>'>&nbsp;<?php echo $useragent->platform['title']; ?>&nbsp; <img src='<?php echo TEMPLATE_URL.$useragent->browser['image']?>'>&nbsp;<?php echo $useragent->browser['title']; ?>
<?php endif; ?>
<?php
}
?>
<?php
//blog：评论列表
function blog_comments($comments){extract($comments);if($commentStacks):?>
	<div class="comment-header"></div>
	<?php endif;?>
  <div class="comm_charu"></div>
  <div class="comment-list">
	<?php	
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
	$comment = $comments[$cid];
	$comm_name = $comment['url'] ? '<a title="点击访问：'.$comment['url'].'" href="'.$comment['url'].'" target="_blank" rel="external nofollow">'.$comment['poster'].'</a>' : $comment['poster'];
	$comment['content'] = preg_replace("/\[S(([1-4]?[0-9])|50)\]/",'<img src="'.TEMPLATE_URL.'images/face/$1.gif" alt="IT技术宅" />',$comment['content']);
	$comment['content'] = preg_replace("/\{smile:(([1-4]?[0-9])|50)\}/",'<img src="'.TEMPLATE_URL.'images/face/$1.gif" alt="IT技术宅" />',$comment['content']);
	$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"nofollow\" title=\"新窗口查看图片\"><img style=\"width:100px;margin:0 5px\" src=\"$1\" alt=\"" . basename("$1") . "\" /></a>"', $comment['content']);
	$comment['content'] = preg_replace("/\[code=?\]*(.*?)(\[\/code)?\]/e", '"<pre>$1</pre>"', $comment['content']);
	$comment['content'] = preg_replace("/\[link=?\]*(.*?)(\[\/link)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"external nofollow\">$1</a>"', $comment['content']);?>
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo mygetGravatar($comment['mail']); ?>" width="48" height="48" alt="<?php echo $comment['poster'];?>" title="<?php echo $comment['poster'];?>" /></div><?php endif; ?>
		<div class="comment-info">
			<span class="poster">
			<i class="fa fa-user mar-r-4 green"></i>
			<?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\"");?> 
			<?php echo $comm_name;?></span><span class="comment-time"><i class="fa fa-clock-o mar-r-4"></i>
			<?php echo $comment['date']; ?></span><span class="sign1"><i class='fa fa-map-marker'></i> <?php echo getaddress($comment['ip']);?></span><span class="comment-reply">
			<a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">
			<i class="fa fa-share mar-r-4"></i>回复</a></span>
			<div class="comment-content"><?php echo $comment['content']; ?></div>	
			<div class="sign2"><?php echo useragent($comment['useragent']);//操作系统/浏览器 ?></div>
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
	</div>
	<?php endforeach;?></div><div class="clear"></div>
    <div id="pagenavi" style="border-top:1px solid rgba(0,0,0,0.13);border-bottom:1px solid rgba(0,0,0,0.13);"><?php echo $commentPageUrl;?></div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){$isGravatar = Option::get('isgravatar');foreach($children as $child):$comment = $comments[$child];$comm_name = $comment['url'] ? '<a title="点击访问：'.$comment['url'].'" href="'.$comment['url'].'" target="_blank" rel="external nofollow">'.$comment['poster'].'</a>' : $comment['poster'];$comment['content'] = preg_replace("/\{smile:(([1-4]?[0-9])|50)\}/",'<img src="'.TEMPLATE_URL.'images/face/$1.gif" alt="IT技术宅" />',$comment['content']);$comment['content'] = preg_replace("/\[S(([1-4]?[0-9])|50)\]/",'<img src="'.TEMPLATE_URL.'images/face/$1.gif" alt="IT技术宅" />',$comment['content']);$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"nofollow\" title=\"新窗口查看图片\"><img style=\"width:20px;height:20px;margin:0 5px\" src=\"$1\" alt=\"" . basename("$1") . "\" /></a>"', $comment['content']);$comment['content'] = preg_replace("/\[code=?\]*(.*?)(\[\/code)?\]/e", '"<pre>$1</pre>"', $comment['content']);$comment['content'] = preg_replace("/\[link=?\]*(.*?)(\[\/link)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"external nofollow\">$1</a>"', $comment['content']);?>
	<div class="comment-children" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php if(_g('gravatar_cache')=='1'){echo get_avatar($comment['mail'],36);}else{echo getGravatar($comment['mail']);};?>" width="36" height="36" alt="<?php echo $comment['poster'];?>" title="<?php echo $comment['poster'];?>" /></div><?php endif;?>
		<div class="comment-info"><span class="poster"><i class="fa fa-user mar-r-4 green"></i><?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\"");?> <?php echo $comm_name;?></span><span class="comment-time"><i class="fa fa-clock-o mar-r-4"></i><?php echo $comment['date']; ?></span><span class="sign1"><i class='fa fa-map-marker'></i> <?php echo getaddress($comment['ip']);?></span><?php if($comment['level'] < 4):?><span class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"><i class="fa fa-share mar-r-4"></i>回复</a></span><?php endif;?>
		<div class="comment-content"><?php echo $comment['content']; ?></div>
		<div class="sign2"><?php echo useragent($comment['useragent']);//操作系统/浏览器 ?></div>			
		</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	</div>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'):?>
	<div id="comment-place">
 <script src="<?php echo TEMPLATE_URL; ?>js/ajax_comment.js" type="text/javascript"></script>
	<div class="comment-post" id="comment-post">
		<div class="place-header"><a name="respond"></a></div>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<div class="textarea"><textarea name="comment" id="comment" rows="10" tabindex="4" placeholder="既然来了说点什么吧…"></textarea></div>
<div class="comm_toolbar">
  <div class="comm_tool">
  <div class="smilebg"><div class="smile"><div class="arrow"></div><?php include View::getView('smiley');?></div></div>
  <div title="插入表情" onclick="tool_bq()" class="tool_bq"><i class="fa fa-smile-o"></i></div>
  <div title="插入图片" onclick="tool_img()" class="tool_img"><i class="fa fa-image"></i></div>
  <div title="插入链接" onclick="tool_link()" class="tool_link"><i class="fa fa-link"></i></div>
  <div title="插入代码" onclick="tool_code()" class="tool_code"><i class="fa fa-code"></i></div>
  <div title="签到" onclick="tool_qiand()" class="tool_qiand"><i class="fa fa-pencil"></i></div>
  <div title="赞一个" onclick="tool_zan()" class="tool_zan"><i class="fa fa-thumbs-o-up"></i></div>
  <div title="踩一个" onclick="tool_cai()" class="tool_cai"><i class="fa fa-thumbs-o-down"></i></div>
  <div id="cmt-loading" style="float:left;padding-left:15px;height:32px;font-size:14px;color:red;line-height:30px;"></div>
  <?php if(ROLE == 'visitor'): ?>
<div class="comm_tijiao">提交评论</div>
<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
</div>
</div>
<div class="comm_infobox">
<p><label for="author"><small>名&nbsp;&nbsp;字：</small></label><input type="text" name="comname" id="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1"></p>
<p><label for="email"><small>邮&nbsp;&nbsp;箱：</small></label><input type="text" name="commail" id="commail" maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2"></p>
<p><label for="url"><small>网&nbsp;&nbsp;址：</small></label><input type="text" name="comurl" id="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="22" tabindex="3"></p>
<input style="margin-left:17px;" type="submit" id="comment_submit" value="发表评论" tabindex="6" /><div class="comm_rest">清空信息</div><div class="comm_close">关闭评论</div>
</div>
<?php else:?>
<div class="comm_tijiao"><input type="submit" id="comment_submit" value="发表评论" tabindex="6" /></div>
<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
</div>
</div>
<?php endif; ?>
<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
</form>
	</div>
	</div>
 	<?php endif; ?>
<?php }?>
<?php
function get_avatar($mail,$size,$default='monsterid')
{
	$email_md5=md5(strtolower($mail));//通过MD5加密邮箱
	$cache_path=TEMPLATE_PATH."cache"; //缓存文件夹路径,ljie需要换上你的主题目录名称
	if(!file_exists($cache_path))
	{
		mkdir($cache_path,0700);
	}
 $avatar_url=TEMPLATE_URL."cache/".$email_md5.'.jpg'; //头像相对路径
	$avatar_abs_url=$cache_path."/".$email_md5.'.jpg'; //头像绝对路径
	$cache_time=24*3600*7; //缓存时间为7天
	 if (empty($default)) $default = $cache_path. '/default.jpg';
	if(!file_exists($avatar_abs_url) || (time()-filemtime($avatar_abs_url)) > $cache_time)//过期或图片不存在
	{
		$new_avatar = getGravatar($mail,$size,$default);
		copy($new_avatar,$avatar_abs_url);
	}
	return $avatar_url;
}
//调用方法
//get_avatar($comment['mail'],"{$comment['poster']}{$comment['comment_nums']}")
?>
<?php 
//blog:多说获取Gravatar头像
function mygetGravatar($email, $s = 80, $d = 'mm', $g = 'g') {
	$hash = md5($email);
	$avatar = "http://cn.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
	return $avatar;
}
?>
<?php
//blog：相邻日志
function neighbor_log($neighborLog){extract($neighborLog);?>
<div class="shangyip bg-color">
<?php if($prevLog):?>
<span><i class="el-arrow-up"></i>上一篇：<a class='blue-text' href='<?php echo Url::log($prevLog['gid']) ?>' title='上一篇：<?php echo $prevLog['title'];?>'><?php echo $prevLog['title'];?></a></span>
<?php else:?>
<?php endif;?>
<?php if($nextLog && $prevLog):?>
<?php endif;?>
<?php if($nextLog):?>
<span><i class="el-arrow-down"></i>下一篇：<a class='blue-text' href='<?php echo Url::log($nextLog['gid']) ?>' title='下一篇：<?php echo $nextLog['title'];?>'><?php echo $nextLog['title'];?></a></span>
<?php else:?>
<?php endif;?>
</div>
<?php }?>

<?php
//blog：相邻日志
function neighbor_log2($neighborLog){extract($neighborLog);?>
<?php if($prevLog):?>
<a rel="prev" href="<?php echo Url::log($prevLog['gid']) ?>" class="prev"><span class="icon-wrap"></span><h3><?php echo $prevLog['title'];?></h3></a>
<?php else:?>
<?php endif;?>
<?php if($nextLog && $prevLog):?>
<?php endif;?>
<?php if($nextLog):?>
<a rel="next" href="<?php echo Url::log($nextLog['gid']) ?>"class="next"><span class="icon-wrap"></span><h3><?php echo $nextLog['title'];?></h3></a>
<?php else:?>
<?php endif;?>
<?php }?>


<?php
//blog：导航
function m_sort($dhtype){global $CACHE;$navi_cache = $CACHE->readCache('navi');?>
<?php foreach($navi_cache as $value):if ($value['pid'] != 0) {continue;} ?>
<?php 
$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
$current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'cli' : '';  //判断当前页改变类?>
<li><a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a><li>
<?php if (!empty($value['children'])) : //非新窗户打开?>
<?php foreach ($value['children'] as $row){
	echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';}?>
<?php endif;?>
<?php if (!empty($value['childnavi'])) : //新窗口打开?> 
<?php foreach ($value['childnavi'] as $row){
	$newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
	echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';}?>
<?php endif;?>
<?php endforeach; ?>
<?php if(_g('sort_show')==1){m_sorts($dhtype);} }?>
<?php
function m_sorts($dhtype){global $CACHE;$sort_cache = $CACHE->readCache('sort'); ?>
	<?php if($dhtype == 1){ ?>
		<li class='drop'  >
		<a href="JavaScript:;" >分类<i class='el-chevron-down'></i></a>
		<div class="drop-nav orange-text ">
		<ul>
	<?php }else if($dhtype == 2){ ?>
		<li class='mob-drop' >
		<a href="JavaScript:;" >分类<i class='el-chevron-down'></i></a>
		<ul class="mob-dropmenu">
	<?php } ?>
		  <?php foreach($sort_cache as $value):if ($value['pid'] != 0) continue;?>
		  <li><a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?></a></li>
		  <?php endforeach; ?>
		</ul>
	</div>
</li>
<?php }?>	  
<?php
//widget：搜索
function widget_search($title){ ?>
<!--搜索-->
<div class="search animation-div">
	<form class="from_pjax" action="<?php echo BLOG_URL; ?>index.php" method="get">
		<div class="search-index">
			<input name="keyword" type="text"  placeholder="请输入关键字" onfocus="this.placeholder=''" onblur="this.placeholder='请输入关键字'"/>
			<i class="el-search"><input value=" "type="submit"/></i>
		</div>
	</form>
</div>
<?php } ?>
<?php /*
//标签云
function widget_tag($title){
	//if (blog_tool_ishome()) return;#只在非首页显示友链去掉双斜杠注释即可
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
<div class="cloud bg-color animation-div">
    <h4 class="index-title"><i class="el-tags"></i>标签云<small>Tags Clouds</small></h4>
	<ul id="3dcloud">
<?php foreach($tag_cache as $value): ?>
	<li><a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a></li>
<?php endforeach; ?>
	</ul>
</div>
<?php }*/?>
<?php
//3D标签云
function widget_tag($title){
	//if (blog_tool_ishome()) return;#只在非首页显示友链去掉双斜杠注释即可
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<div id="tag_cloud_widget">
	<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/tag.js"></script>
<?php foreach($tag_cache as $value): ?>
	<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a>
<?php endforeach; ?>
</div>
<?php }?>

<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['name'];
	$com_cache = $CACHE->readCache('comment');
	//获取热门文章
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);
	?>
<div class="mytab bg-color animation-div">
	<div class="tab-btn"><a class="hd-btn tab-active"href="javascript:;"><i class="el-comment-alt"></i>互动信息</a><a class="ph-btn"href="javascript:;"><i class="el-signal"></i>文章排行</a></div>
	<ul class="hudong-ul">
		<?php
		$i = 0;
		foreach($com_cache as $value):
		//if($value['name']!=$name):
		$i++;
		$articleUrl = Url::log($value['gid']);
		$url = Url::comment($value['gid'], $value['page'], $value['cid']);
		$db = MySql::getInstance();
		$sql = "SELECT title FROM ".DB_PREFIX."blog WHERE gid=".$value['gid'];
		$ret = $db->query($sql);
		$row = $db->fetch_array($ret);
		$articleTitle = $row['title'];
		$db = MySql::getInstance();
		$sql = "SELECT url FROM ".DB_PREFIX."comment WHERE cid=".$value['cid'];
		$ret = $db->query($sql);
		$row = $db->fetch_array($ret);
		$value['content'] = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<a rel=\"example_group\" class=\"cboxElement\" href=\"$1\" title=\"这是一张图片，点击进行查看\">图片</a>"', $value['content']);
		$value['content']=preg_replace("/{smile:(([1-4]?[0-9])|50)}/",'<img class="lazy" src="' . TEMPLATE_URL. 'img/smilies/$1.gif" />',$value['content']) ?>
		<li>
			<div class="sd-tx">
				<a href="${comment.url}" target="_blank" rel="nofollow" title="去 <?php echo $value['name']; ?> 的网站看看 ?">
					<img src="<?php echo mygetGravatar($value['mail']); ?>" alt="<?php echo $value['name']; ?>" class="img-circle"/>
				</a>
			</div>
			<div class="sd-name">
				<span><i class="el-user"></i><?php echo $value['name']; ?></span>
				<a class="blue-text" href="<?php echo $url; ?>" ><?php echo preg_replace("/\[S(([1-4]?[0-9])|50)\]/",'<img alt="face" src="'.TEMPLATE_URL.'images/face/$1.gif";  />',preg_replace("|\[code\]|",'',$value['content'])); ?></a>
			</div>
		</li>
		<?php if($i==6){break;}  /*endif*/;endforeach; ?>
	</ul>
	
	<!--文章排行-->
	<ul class="paihang-ul">
	<?php foreach($randLogs as $value): $li = idby_img($value['gid']); ?>
			<li><span></span><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?><b><i class="el-eye-open"></i>(<?php echo $li[2]; ?>)</b></a></li>
	<?php endforeach; ?>	
	</ul>
</div>
<?php }?>

<?php
//widget：最新微语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<div class="bg-color animation-div">
	<h4 class="index-title"><i class="el-headphones"></i><?php echo $title; ?><small>Wei Yu</small></h4>

	<div class="shuo-side">
		<ul>
	<?php $i = 0; foreach($newtws_cache as $value):$i++; ?>
	<li >
		<span class="shuobg<?php echo $i; ?>"><strong><?php echo smartDate($value['date']); ?></strong></span>
		<div><a href="javascript:"><?php echo $value['t']; ?> </a></div>
	</li>
	<?php endforeach; ?>
	</ul>
	</div>
</div>
<?php }?>
<?php
	function dhmessage(){
		$dhmessageType = _g('dhmessage_type');
		if($dhmessageType == 'tmessage'){
			global $CACHE; 
			$newtws_cache = $CACHE->readCache('newtw');
			$istwitter = Option::get('istwitter');
			foreach($newtws_cache as $value){
				echo '<li>'.$value['t'].'</li>';
			}
		}else if($dhmessageType == 'custommessage'){
			$arr = explode("|",_g('custommessage1'));
			foreach($arr as $value){
				echo '<li>'.$value.'</li>';
			}
		}
	}
 ?>
<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<div class="article-push arclist bg-color mob-hidden animation-div">
	<h4 class="index-title"><i class="el-asl"></i><?php echo $title;?><small>Push Article</small></h4>
	<ul>
	<?php foreach($newLogs_cache as $value):$li = idby_img($value['gid']); ?>
	<li>
		<div class="arcimg"> 
			<a href="<?php echo Url::log($value['gid']); ?>">
				<img alt="<?php echo $value['title']; ?>" src="<?php echo $li[0]; ?>" title="<?php echo $value['title']; ?>"> 
			</a>
		</div>
		<div class="arc-right">
			<h4 class="blue-text"><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></h4>
			<ul>
				<li><a title="发表时间"><i class="el-time"></i><?php echo $li[1]; ?></a></li>
				<li><a title="<?php echo $li[2]; ?>次浏览"><i class="el-fire"></i><?php echo $li[2]; ?></a></li>
			</ul>
		</div>
	</li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
 <?php
//widget：热门文章
function widget_hotlog($title){
	return; //合并最新评论中
	//if (blog_tool_ishome()) return;#只在非首页显示友链去掉双斜杠注释即可
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
<div class="tuijian">
<h2><?php echo $title; ?></h2>
    	<ol>
			<?php $i=0; foreach($randLogs as $value):?>
				<li><span><strong><?php $i++; echo $i; ?></strong></span> <a href="<?php echo Url::log($value['gid']); ?>" title="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></a></li>
			<?php endforeach; ?>					
		</ol>
</div>
<?php }?>

<?php
//widget：链接
function widget_link($title, $isLog = false, $isPage = false){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
?>
<div class="side-link animation-div">
	<h4 class="index-title"><i class="el-paper-clip"></i>友情链接<small>Friend Links</small><a  href="tencent://message/?uin=571614181"><i class="el el-plus"></i>申请</a></h4>
	<ul>
<?php 
	foreach($link_cache as $value):
		$urlinfo = parse_url($value['url']);
		$urlHost = explode(".",$urlinfo['host']);
		$urlHost = array_reverse($urlHost);
?>
	<li><a rel="friend" href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
<?php endforeach; ?>
	</ul>
</div>
<?php }?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<div class="bg-color article-push">
	<h4 class="index-title"><i class="el-heart"></i><?php echo $title; ?><small>Focus Me</small></h4>
		<div>
		<ul>
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</div>
	</div>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<div class="zdy">
	<h2><?php echo $title; ?></h2>
	<ul>
	<?php echo $content; ?>
	</ul>
	</div>
<?php } ?>
<?php
//blog：日志作者
function blog_author($uid){
	global $CACHE;
	$user_cache = Cache::getInstance()->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	if($mail!==($user_cache[1]['mail'])){ $title = !empty($mail) || !empty($des) ? "title=\"特邀作者\"" : '';}else{$title = !empty($mail) || !empty($des) ? "title=\"博客管理员\"" : '';}
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>

<?php
//幻灯解析

function huandeng(){
	$str = _g('huandeng');
	$arr = explode(",",$str);
	//$arr = explode(",",$str);
	?>
	<div class="swiper-container">
		<ul class="slides swiper-wrapper">
	<?php
	foreach($arr as $u){
    $strarr = explode("|",$u);
		?>
		<li class="swiper-slide">
			<a href="<?php echo $strarr[1] ?>" title="<?php echo $strarr[0] ?>">
				<img src="<?php echo $strarr[2] ?>" alt="<?php echo $strarr[0] ?>" />
			</a>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
			<span class="silde-title"><?php echo $strarr[0] ?></span>
		</li>
		<?php
	}?>
	</ul>
		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		<script type="text/javascript">
			$(function(){
				var swiper = new Swiper('.swiper-container', {
					nextButton: '.swiper-button-next',
					prevButton: '.swiper-button-prev',
					pagination: '.swiper-pagination',
					paginationType: 'fraction',
					centeredSlides: true,
					autoplay: 5500,//自动播放时间
					autoHeight: true //自动高度
				});
			});
		</script>
	</div>
<?php } ?>
<?php
//相关文章调用代码。
function related_logs($logData = array())
{
	$related_log_type = _g('related_type');
	$related_log_sort = _g('related_desc');
	$related_log_num = _g('related_num');
	$related_inrss = _g('related_inrss');
	global $value;
	$DB = MySql::getInstance();
	$CACHE = Cache::getInstance(); 
	extract($logData);
	if($value)
	{
		$logid = $value['id'];
		$sortid = $value['sortid'];
		global $abstract;
	}
	$sql = "SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' AND type='blog'";
	if($related_log_type == 'tag')
	{
		$log_cache_tags = $CACHE->readCache('logtags');
		$Tag_Model = new Tag_Model();
		$related_log_id_str = '0';
		foreach($log_cache_tags[$logid] as $key => $val)
		{
			$related_log_id_str .= ','.$Tag_Model->getTagByName($val['tagname']);
		}
		$sql .= " AND gid!=$logid AND gid IN ($related_log_id_str)";
	}else{
		$sql .= " AND gid!=$logid AND sortid=$sortid";
	}
	switch ($related_log_sort)
	{
		case 'views_desc':
		{
			$sql .= " ORDER BY views DESC";
			break;
		}
		case 'views_asc':
		{
			$sql .= " ORDER BY views ASC";
			break;
		}
		case 'comnum_desc':
		{
			$sql .= " ORDER BY comnum DESC";
			break;
		}
		case 'comnum_asc':
		{
			$sql .= " ORDER BY comnum ASC";
			break;
		}
		case 'rand':
		{
			$sql .= " ORDER BY rand()";
			break;
		}
	}
	$sql .= " LIMIT 0,$related_log_num";
	$related_logs = array();
	$query = $DB->query($sql);
	while($row = $DB->fetch_array($query))
	{
		$row['gid'] = intval($row['gid']);
		$row['title'] = htmlspecialchars($row['title']);
		$related_logs[] = $row;
	}
	$out = '';
	if(!empty($related_logs))
	{
	$out .="<div class=\"maybe-love\">";
    $out .= "<h4 class=\"index-title\"><i class=\"el-heart\"></i>您还可能喜欢</h4>";
		$out .= "<ul>";
		foreach($related_logs as $val)
		{
			$out .= "<li><a href=\"".Url::log($val['gid'])."\" title=\"{$val['title']}\">
			<p>
			<img  src=\" ".getxgs_thum($val['content'])." \" alt=\"{$val['title']}\">
			</p>
			<span>
			{$val['title']}
			</span>
			</a></li>";
		}
		$out .= "</ul></div>";
	}
	if(!empty($value['content']))
	{
		if($related_inrss == 'y')
		{
			$abstract .= $out;
		}
	}else{
		echo $out;
	}
}
?>
<?php //获取相关文章缩略图  按地址获取
function getxgs_thum($str){
  preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $str, $match);
  if(!empty($match[1])){
    $thum_url = $match[1][0];
  }else{
    $thum_url = TEMPLATE_URL . 'images/ArticleImg/'.rand(1,20).'.jpg';
  }
	return $thum_url;
}
?>

<?php
function bgimg(){
	$str = _g('bgimgstr');
	$arr = explode("|",$str);
	?>
	jQuery(function($){$.supersized({slide_interval:<?php echo _g('qhtime')*1000; ?>,transition:1,transition_speed:3000,performance:1,min_width:0,min_height:0,vertical_center:1,horizontal_center:1,fit_always:0,fit_portrait:1,fit_landscape:0,slide_links:'blank',slides:[<?php foreach($arr as $val){ ?>{image : '<?php echo $val;?>'},<?php }?>]});});
<?php }?>
<?php
function tongji(){
	$db = MySql::getInstance();
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE type = 'blog'");
	$log_total = $data['total']; //文章总数
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "comment");
	$log_com = $data['total']; //评论总数
	$sql = "SELECT date FROM " . DB_PREFIX . "blog WHERE type='blog' ORDER BY date ASC LIMIT 0,1";
    $res = $db->query($sql);
	$row = $db->fetch_array($res);
	$build_date_time = $row['date'];
	$build_date = date('Y-n-j H:i',$build_date_time);
	$blog_run_time = floor((time() - $build_date_time)/86400); //获取运行天数
	?>
	
	<ul>
			<li><strong class="t-black yunxing_cont"><?php echo $blog_run_time; ?></strong><span>运行天数</span></li>
			<li><strong class="t-black output_newcnzz"><?php echo $log_com; ?></strong><span>评论数量</span></li>
			<li><strong class="t-black arc_cont"><?php echo $log_total; ?></strong><span>文章数量</span></li>
		</ul>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<li><a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a></li>';
		}
		
	}else{
		$tag .= '<li><a>暂无标签</a></li>';
	}
	echo $tag;
}
?>         
 <?php
//判断内容页是否百度收录
function baidu($url){
$url='http://www.baidu.com/s?wd='.$url;
$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$rs=curl_exec($curl);curl_close($curl);if(!strpos($rs,'没有找到')){return 1;}else{return 0;}}

function logurl($id){$url=Url::log($id);
if(baidu($url)==1){echo "<a style=\"color:#1EA83A;\" rel=\"external nofollow\" title=\"点击查看！\" target=\"_blank\" href=\"http://www.baidu.com/s?wd=$url\">[百度已收录]</a>";
}else{echo "<a style=\"color:red;\" rel=\"external nofollow\" title=\"点击提交收录！\" target=\"_blank\" href=\"http://zhanzhang.baidu.com/sitesubmit/index?sitename=$url\">[百度未收录]</a>";}}
?>
<?php //判断内容页是否360收录
function haoso($url){
$url='https://www.so.com/s?a=index&q='.$url;
$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$rs=curl_exec($curl);curl_close($curl);
if(!strpos($rs,'找不到')){
return 1;}
else{return 0;}}
 
function logurlhaoso($id){$url=Url::log($id);
if(haoso($url)==1){echo "<a style=\"color:#1EA83A;\" rel=\"external nofollow\" title=\"点击查看！\" target=\"_blank\" href=\"https://www.so.com/s?a=index&q=$url\">[360已收录]</a>";
}else{echo "<a style=\"color:red;\" rel=\"external nofollow\" title=\"点击提交收录！\" target=\"_blank\" href=\"http://info.so.com/site_submit.html\">[360未收录]</a>";}}
?>
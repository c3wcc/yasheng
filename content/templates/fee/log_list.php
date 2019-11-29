<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(isset($_GET["setting"])){include View::getView('setting');exit();}
if(isset($_GET["user"])){include View::getView('user/index');exit;}
if(isset($_GET["reset"])){include View::getView('user/reset');exit;}
if(isset($author)){include View::getView('user/author');exit;}
?>
<div id="<?php echo get_template_name();?>">
<section class="container">
<?php
if(!empty($record)) {
			//日期记录
			$year    = substr($record,0,4);
			$month   = ltrim(substr($record,4,2),'0');
			$day     = substr($record,6,2);
			$archive = $day?$year.'年'.$month.'月'.ltrim($day,'0').'日':$year.'年'.$month.'月';
			echo '<section class="container"><div class="mbx"> <a href="/">首页</a> »  '.$archive.'发布的文章</div> </section>';
		}
		if(!empty($sort)) {
			//栏目页显示
			$des = $sort['description']?$sort['description']:'这家伙很懒，还没填写该栏目的介绍呢~';
			echo '<div class="catleader"><h1>'.$sortName.'</h1><div class="catleader-desc"></div></div>';
		}
		if(!empty($author_name)) {
			//作者日志显示
			echo '<div class="pagetitle"><h1>'.$author_name.' 共计发布文章'.$lognum.'篇</h1></div>';
		}
		if(!empty($keyword)) {
			//搜索
			echo '<div class="pagetitle"><h1>本次搜索帮您找到有关 <strong>'.$keyword.'</strong> 的结果'.$lognum.'条</h1></div>';
		}
		if(!empty($tag)) {
			//关键词
			echo '<div class="pagetitle"><h1>关于 <strong>'.$tag.'</strong> 的文章共有'.$lognum.'条</h1></div>';
		}?>
<div class="content-wrap">
<?php if (blog_tool_ishome()) {?>
<?php
if($Tconfig["focusslide_s"]== 1 ){
?>
<div class="oldtbcontent">
	<div id="focusslide" class="oldbanner carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#focusslide" data-slide-to="0" class="active"></li>
			<li data-target="#focusslide" data-slide-to="1"></li>
			<li data-target="#focusslide" data-slide-to="2"></li>
			<li data-target="#focusslide" data-slide-to="3"></li>
		</ol>		
		<div class="carousel-inner" role="listbox">
			<div class="item active" style="background-image: url(<?php echo $Tconfig["focusslide_src_1"];?>);">
				<div class="cd-main-content">
					<div class="cd-product-intro intleft wow fadeInLeft animated">
						<h2><?php echo $Tconfig["focusslide_title_1"];?></h2>
						<h3><?php echo $Tconfig["focusslide_text_1"];?></h3>
						<div class="button">
							<a href="<?php echo $Tconfig["focusslide_href_1"];?>" class="btn btn-primary"><?php echo $Tconfig["focusslide_button_1"];?></a>
						</div>
					</div>
					<div class="cd-image-container imgleft wow fadeInRight animated">
						<div class="img" style="background-image: url(<?php echo $Tconfig["focusslide_src_zhanshi_1"];?>);">
						</div>
					</div>
				</div>
			</div>
			<div class="item" style="background-image: url(<?php echo $Tconfig["focusslide_src_2"];?>);">
				<div class="cd-main-content">
					<div class="cd-product-intro intleft wow fadeInLeft animated">
						<h2><?php echo $Tconfig["focusslide_title_2"];?></h2>
						<h3><?php echo $Tconfig["focusslide_text_2"];?></h3>
						<div class="button">
							<a href="<?php echo $Tconfig["focusslide_href_2"];?>" class="btn btn-default"><?php echo $Tconfig["focusslide_button_2"];?></a>
						</div>
					</div>
					<div class="cd-image-container imgleft wow fadeInRight animated">
						<div class="img" style="background-image: url(<?php echo $Tconfig["focusslide_src_zhanshi_2"];?>);">
						</div>
					</div>
				</div>
			</div>
			<div class="item" style="background-image: url(<?php echo $Tconfig["focusslide_src_3"];?>);">
				<div class="cd-main-content">
					<div class="cd-product-intro intleft wow fadeInLeft animated">
						<h2><?php echo $Tconfig["focusslide_title_3"];?></h2>
						<h3><?php echo $Tconfig["focusslide_text_3"];?></h3>
						<div class="button">
							<a href="<?php echo $Tconfig["focusslide_href_3"];?>" class="btn btn-danger"><?php echo $Tconfig["focusslide_button_3"];?></a>
						</div>
					</div>
					<div class="cd-image-container imgleft wow fadeInRight animated">
						<div class="img" style="background-image: url(<?php echo $Tconfig["focusslide_src_zhanshi_3"];?>);">
						</div>
					</div>
				</div>
			</div>
			<div class="item" style="background-image: url(<?php echo $Tconfig["focusslide_src_4"];?>);">
				<div class="cd-main-content">
					<div class="cd-product-intro intleft wow fadeInRight animated">
						<h2><?php echo $Tconfig["focusslide_title_4"];?></h2>
						<h3><?php echo $Tconfig["focusslide_text_4"];?></h3>
						<div class="button">
							<a href="<?php echo $Tconfig["focusslide_href_4"];?>" class="btn btn-primary"><?php echo $Tconfig["focusslide_button_4"];?></a>
						</div>
					</div>
					<div class="cd-image-container imgleft wow fadeInLeft animated">
						<div class="img" style="background-image: url(<?php echo $Tconfig["focusslide_src_zhanshi_4"];?>);">
						</div>
					</div>
				</div>
			</div>
		</div>
						<a class="left carousel-control" href="#focusslide" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a><a class="right carousel-control" href="#focusslide" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
					</div>
					</a>
				</div>
<?php }?>
<?php }?>
	<div class="content"> 
	<?php if (blog_tool_ishome()) {?>
    <div class="speedbar <?php echo $Tconfig["wow"];?>">
	<a class="tpclose" onclick="hidetp()"><i class="fa fa-times"></i></a>
	<div class="toptip" id="callboard">
	    <ul style="font-size: 14px; margin-top: 2px;">
		<?php global $CACHE;$newtws_cache = $CACHE->readCache('newtw');
            		  foreach($newtws_cache as $value):?>
            <li class="bulletin">
                <a href="<?php echo BLOG_URL.'t';?>">
                    <?php echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img alt="face" src="'.TEMPLATE_URL.'img/face/$1.gif"  />',$value['t']);echo date('（Y年n月j日）',$value['date']);?>                </a>
            </li>
		<?php endforeach; ?>	
			</ul>
		
	</div>
	</div>  
	<?php if($Tconfig['gonggao']== 1 ){?>
	<?php 
	$db = MySql::getInstance();
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort');
	foreach(array($Tconfig['gonggao_q']) as $key => $i){
	$sort = $sort_cache[$i];
	if($sort['pid'] != 0 || empty($sort['children'])){
	$slsortid = $i;
	}else{
	$slsortids = array_merge(array($i),$sort['children']);
	$slsortid = implode(',',$slsortids);
	}
	?>
	<?php foreach($Log_Model->getLogsForHome("and sortid IN ($slsortid) order by date desc",0,1) as $key=>$value){?>
		<article class="excerpt-minic excerpt-minic-index <?php echo $Tconfig["wow"];?>" style="display: block;">
        <div class="post-entry-categories"><?php if (Option::EMLOG_VERSION == '5.3.1'){blog_tag($value['logid']);}else{blog_tags($value['logid']);}; ?></div> 
		<h2><a class="red" href="<?php echo Url::sort($i);?>"><?php echo $sort_cache[$i]['sortname'];?></a><a href="<?php echo Url::log($value['gid']);?>" title="<?php echo $value['title'];?>"><?php echo $value['title'];?></a></h2>
		<p class="note">
			<?php echo blog_tool_purecontent(ishascomment($value['content'],$value['logid']), 158);?>
		</p>
		</article>
	<?php }?>
	<?php }?>
	<?php }?>
  <?php if($Tconfig['index_page_s']== 1 ){?>
		<section class="hot_posts <?php echo $Tconfig["wow"];?>">
		<div class="suiji">
                      <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=28422961&amp;site=qq&amp;menu=yes" target="_blank"><img src="/byg.gif" style="width: 100%;"></a>	
			<h3>随机文章</h3>
			<ul class="layout_ul">
			<?php getRandLog(6);?>
			</ul>
		</div>
		<div class="hots">
                      <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=28422961&amp;site=qq&amp;menu=yes" target="_blank"><img src="/byg.gif" style="width: 100%;"></a>	
			<h3>本月热门</h3>
			<ul class="layout_ul">
			<?php getdatelogs(6);?>
			</ul>
		</div>
		</section>
		<?php }?>
		<?php if($Tconfig['tool_s']== 1 ){?>
		<div class="<?php echo $Tconfig["wow"];?>">
		<?php echo $Tconfig['tool_s_html'];?>	
		</div>
		<?php }?>
            <table cellpadding="0" cellspacing="0" border="1" style="width:100%;font-weight:700;text-align:center;" bordercolor="#333333"> <tbody> <tr> <td style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#E53343;">文字广告位20/月</span></a> </td> <td height="24" style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#E53333;">文字广告位20/月</span></a> </td> <td height="24" style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes"><span style="font-size:13px;color:#337FE5;">文字广告位20/月</span></a> </td> <td height="24" style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#E53333;">文字广告位20/月</span></a> </td> <td height="24" style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#E53333;">文字广告位20/月</span></a> </td> </tr> <tr> <td style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#640EF6;">文字广告位20/月</span></a> </td> <td height="24" style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#E53333;">文字广告位20/月</span></a> </td> <td height="24" style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#E53333;">文字广告位20/月</span></a> </td> <td style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#640EF6;">文字广告位20/月</span></a> </td> <td style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#640EF6;">文字广告位20/月</span></a> </td> </tr> <tr> <td style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#640EF6;">文字广告位20/月</span></a> </td> <td height="24" style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#640EF6;">文字广告位20/月</span></a> </td> <td height="24" style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#640EF6;">文字广告位20/月</span></a> </td> <td style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=1725202104&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#640EF6;">文字广告位20/月</span></a> </td> <td style="width:20%;vertical-align:middle;"> <a href="http://wpa.qq.com/msgrd?v=3&uin=28422961&site=qq&menu=yes" target="_blank"><span style="font-size:13px;color:#640EF6;">文字广告位20/月</span></a> </td> </tr> <tr> </td> </tr> </tbody></table>
		<div class="lead-title <?php echo $Tconfig["wow"];?>">
			<h3>最新发布</h3>
			<?php if($Tconfig['index_ad_ad']== 1 ){?>
			<div class="more">
				<a href="<?php echo $Tconfig['index_ad_url'];?>"><?php echo $Tconfig['index_ad_title'];?></a>
			</div>
			<?php }?>
		</div>
		<?php }?>
<?php
    if (!empty($logs)):
        foreach ($logs as $value):
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
            <div class="post-entry-categories"><?php if (Option::EMLOG_VERSION == '5.3.1'){blog_tag($value['logid']);}else{blog_tags($value['logid']);}; ?></div>  
			<h2><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a></h2>
			</header>
			<p class="note">			
				<?php echo blog_tool_purecontent(ishascomment($value['content'],$value['logid']), 110);?>
			</p>
			<p class="meta">
				<span class="author"><img data-src="<?php global $CACHE;$user_cache = $CACHE->readCache('user');$uid = $value['author'];if($user_cache[$uid]['photo']['src']){echo BLOG_URL.$user_cache[$uid]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" class="avatar avatar-50 photo" height="50" width="50" src="<?php global $CACHE;$user_cache = $CACHE->readCache('user');$uid = $value['author'];if($user_cache[$uid]['photo']['src']){echo BLOG_URL.$user_cache[$uid]['photo']['src'];}else{echo TEMPLATE_URL.'static/img/avatar.png';}?>" style="display: inline;"><?php echo index_author($value['author']); ?></span><span class="pv"><i class="fa fa-eye"></i>阅读(<?php echo $value['views'];?>)</span><a class="pc" href="<?php echo $value['log_url']; ?>#comments"><i class="fa fa-comments-o"></i>评论(<?php echo $value['comnum'];?>)</a><span class="time"><i class="fa fa-clock-o"></i><?php echo gmdate('Y-n-j', $value['date']); ?></span>
			</p>
			<?php topflg($value['top'], $value['sortop'], isset($sortid)?$sortid:''); ?>
			<?php
				$DB = MySql::getInstance();
				$str = $DB->query("SELECT * FROM `".DB_PREFIX."options` WHERE `option_value` like '%ja_praise%'");
			if($DB->num_rows($str) > 0){?>
			<p class="like">
				<a class="ja_praise btn btn-primary" data-ja_praise="<?php echo $value['logid'];?>"><i class="fa fa-thumbs-o-up"></i> 赞(<span><?php echo $value['praise'];?></span>)</a>
			</p>
			<?php }else{?>
			<?php }?>
		</div>
		</article>
		
<?php
 endforeach;
    else:
 ?>
 <div class="search-panel in" id="search-panel">
 <ul class="search-result" id="search-result">
 <li class="tips"><i class="icon icon-coffee icon-3x"></i>
 <p> 抱歉，没有符合您查询条件的结果 </p></li>
 </ul>
 </div>
<?php endif; ?>
<?php echo fly_page($lognum,$index_lognum,$page,$pageurl);?>
<?php if($Tconfig["img6g"]== 1 ){?>
           <?php if (blog_tool_ishome()) {?>		   
			<!-- 6格开始 -->
			<?php
				if ($pageurl == Url::logPage()) {
				$db = Database::getInstance();
				global $CACHE;
				$sort_cache = $CACHE->readCache('sort');
				$sort_id = array_unique(explode(',', trim($Tconfig['img6_id'])));
				$out = "";
				foreach ($sort_id as $key => $i) {
					$out .= "<div class='catlist cat-container clearfix'><h2 class='home-heading clearfix'><span class='heading-text {$Tconfig["wow"]}'>".$sort_cache[$i]['sortname']."</span><a target='_blank' href='".Url::sort($i)."'>更多 <i class='fa fa-plus-circle'></i></a></h2><div class='cms-cat cms-cat-s5'>";
					$logss = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$i}' AND type='blog' AND hide='n' order by date DESC limit 0,6");
					while($trow = $db->fetch_array($logss)) {;
						$date = gmdate('[Y-m-d]', $trow['date']);
						$trow['title'] = mb_substr($trow['title'], 0, 16, 'utf-8');
						$url = Url::log($trow['gid']);
						$content= blog_tool_purecontent(ishascomment($trow['content'],$trow['logid']), 40);
						$img_url='';if(img_zw($trow['content'])){$img_url = img_zw($trow['content']);}elseif(img_fj($trow['gid'])){$img_url = img_fj($trow['gid']);}else{$img_url;}
						
						$out .= "<div class='col col-left'><article class='post type-post status-publish format-standard {$Tconfig["wow"]}'><div class='entry-thumb hover-scale'><a href='{$url}'><img data-src='{$img_url}' alt='{$trow['title']}' src='{$img_url}' class='thumb' style='display: inline;'></a></div><div class='entry-detail'><h3 class='entry-title'><a target='_blank' href='{$url}' title='{$trow['title']}'>{$trow['title']}</a></h3><p class='entry-excerpt'>{$content}</p></div></article></div>";
					}
					$out .= "</div></div>";
				}
				$out .= "";
				echo $out;
				};
			?>
			<!-- 6格结束 -->
			<?php }?>
            <?php }?>
 <?php if($Tconfig["moshi"]== 2 ){?>
           <?php if (blog_tool_ishome()) {?>
			<!-- cms开始 -->
			<?php
				if ($pageurl == Url::logPage()) {
				$db = Database::getInstance();
				global $CACHE;
				$sort_cache = $CACHE->readCache('sort');
				$sort_id = array_unique(explode(',', trim($Tconfig['cms_id'])));
				$out = "<div class='catlist clr cat-container clearfix'>";
				foreach ($sort_id as $key => $i) {
					$out .= "<div class='catlist-{$key} cat-col-1_2'><div class='cat-container clearfix'><h2 class='home-heading clearfix'><span class='heading-text {$Tconfig["wow"]}'>".$sort_cache[$i]['sortname']."</span><a href='".Url::sort($i)."'>更多 <i class='fa fa-plus-circle'></i></a></h2><div class='cms-cat cms-cat-s0'><div class='cms-cat cms-cat-s0'>";
					$logss = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE sortid='{$i}' AND type='blog' AND hide='n' order by date DESC limit 0,5");
					while($trow = $db->fetch_array($logss)) {;
						$date = gmdate('[Y-m-d]', $trow['date']);
						$trow['title'] = mb_substr($trow['title'], 0, 16, 'utf-8');
						$url = Url::log($trow['gid']);
						$out .= "<div class=\"row-small\"><article id=\"post-3830\" class=\"post type-post status-publish format-standard {$Tconfig["wow"]}\"><div class=\"entry-detail\"><h3 class=\"entry-title\"><strong>{$date}</strong><i class=\"\"></i><a href=\"{$url}\" title=\"{$trow['title']}\">{$trow['title']}</a></h3></div></article></div>";
					}
					$out .= "</div></div></div></div>";
				}
				$out .= "</div>";
				echo $out;
				};
			?>
			<!-- cms结束 -->
			<?php }?>
            <?php }?>
	</div>
</div>
<?php if (blog_tool_ishome()){include View::getView('side');}else{include View::getView('side1');}?>
</section>
</div>
<?php
include View::getView('footer');
?>
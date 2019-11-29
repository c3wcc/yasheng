<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(isset($_GET["setting"])){include View::getView('setting');exit();}
if(isset($_GET["user"])){include View::getView('user/index');exit;}
if(isset($_GET["reset"])){include View::getView('user/reset');exit;}
if(isset($author)){include View::getView('user/author');exit;}
$sort_img = explode(",",$Tconfig['img_id']);
if(in_array($sortid,$sort_img)){include View::getView('log_img');exit;}
$sort_theme = explode(",",$Tconfig['theme_id']);
if(in_array($sortid,$sort_theme)){include View::getView('log_theme');exit;}
?>
<section class="container">
	<div class="content-wrap">
		<div class="content">
<?php if (blog_tool_ishome()) {?>
<!--轮播图开始-->
<!--  data-ride="carousel" 自动轮播 -->
<?php
if($Tconfig["Slide"]== 1 ){
?>
<div id="wowslider-container1">
	<div class="ws_images">
		<ul>
			<li><a  href="<?php echo $Tconfig["Surl1"];?>" title="<?php echo $Tconfig["title1"];?>"><img src="<?php echo $Tconfig["Slide1"];?>" title="<?php echo $Tconfig["title1"];?>" alt="<?php echo $Tconfig["title1"];?>" /></a></li>
			<li><a  href="<?php echo $Tconfig["Surl2"];?>" title="<?php echo $Tconfig["title2"];?>"><img src="<?php echo $Tconfig["Slide2"];?>" title="<?php echo $Tconfig["title2"];?>" alt="<?php echo $Tconfig["title2"];?>" /></a></li>
			<li><a  href="<?php echo $Tconfig["Surl3"];?>" title="<?php echo $Tconfig["title3"];?>"><img src="<?php echo $Tconfig["Slide3"];?>" title="<?php echo $Tconfig["title3"];?>" alt="<?php echo $Tconfig["title3"];?>" /></a></li>
			</ul>
	</div>
<div class="ws_shadow"></div>
</div>
<div class="clearfloat"></div>
<?php }?>
<!--轮播图结束-->
<!-- 公告 -->
	<article class="excerpt-minic excerpt-minic-index" data-aos="<?php echo $Tconfig["aosxg"];?>">
	    <div class="textgg"> <ul class="gglb"><i class="fa fa-bullhorn"></i>
            <div class="bulletin"> 
            	<ul>
            	<?php global $CACHE;$newtws_cache = $CACHE->readCache('newtw');
            		  foreach($newtws_cache as $value):?>
            	<li><a href="<?php echo BLOG_URL.'t';?>"><?php echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img alt="face" src="'.TEMPLATE_URL.'img/face/$1.gif"  />',$value['t']);echo date('（Y年n月j日）',$value['date']);?></a></li>
            	<?php endforeach; ?>
				</ul>
            </div>
	    </div> 
	</article>
<!-- 首页6格 -->
<?php
if($Tconfig["Sorts"]== 1 ){
?>
	<article class="row excerpt-list" data-aos="<?php echo $Tconfig["aosxg"];?>">
		<div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-l">
			<i class="fa fa-picture-o"></i>
			<h4><?php echo $Tconfig["Sorth1"];?></h4>
			<p><?php echo $Tconfig["Sortp1"];?></p>
			<a class="btn btn-info btn-sm" href="<?php echo $Tconfig["Sorta1"];?>">点击进入</a>
			</div></div>
		<div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-2">
			<i class="fa fa-music"></i>
			<h4><?php echo $Tconfig["Sorth2"];?></h4>
			<p><?php echo $Tconfig["Sortp2"];?></p>
			<a class="btn btn-info btn-sm" href="<?php echo $Tconfig["Sorta2"];?>">点击进入</a>
			</div></div>
		<div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-3">
			<i class="fa fa-list"></i>
			<h4><?php echo $Tconfig["Sorth3"];?></h4>
			<p><?php echo $Tconfig["Sortp3"];?></p>
			<a class="btn btn-info btn-sm" href="<?php echo $Tconfig["Sorta3"];?>">点击进入</a>
			</div></div>
		<div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-4">
			<i class="fa fa-twitch"></i>
			<h4><?php echo $Tconfig["Sorth4"];?></h4>
			<p><?php echo $Tconfig["Sortp4"];?></p>
			<a class="btn btn-info btn-sm" href="<?php echo $Tconfig["Sorta4"];?>">点击进入</a>
			</div></div>
		<div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-5">
			<i class="fa fa-file-text-o"></i>
			<h4><?php echo $Tconfig["Sorth5"];?></h4>
			<p><?php echo $Tconfig["Sortp5"];?></p>
			<a class="btn btn-info btn-sm" href="<?php echo $Tconfig["Sorta5"];?>">点击进入</a>
			</div></div>
		<div class="col-sm-2 col-xs-4 col-list"><div class="indexebox indexebox-6">
			<i class="fa fa-link"></i>
			<h4><?php echo $Tconfig["Sorth6"];?></h4>
			<p><?php echo $Tconfig["Sortp6"];?></p>
			<a class="btn btn-info btn-sm" href="<?php echo $Tconfig["Sorta6"];?>">点击进入</a>
			</div></div>
	</article>
		<?php
		    $db = Database::getInstance();
		    $query = $db->query('SELECT uid,role,nickname,username,photo,vip,level FROM '.DB_PREFIX.'user ORDER BY level DESC limit 0,12');
        	$ads = array();
        	while ($ad = $db->fetch_array($query)) {
				$level = _vip($ad['uid']);
				$level = $level['level'];
        		if($level == 3){
					$ad['vipstr'] = '<i title="钻石会员" class="user-vip-level3"></i>';
					$ad['viptime'] = '<div class="viptime">钻石会员</div>';
        		}elseif($level == 2){
					$ad['vipstr'] = '<i title="黄金会员" class="user-vip-level2"></i>';
					$ad['viptime'] = '<div class="viptime">黄金会员:'.date("Y-m-d",$ad['vip']).'</div>';
        		}elseif($level == 1){
					$ad['vipstr'] = '<i title="白银会员" class="user-vip-level1"></i>';
					$ad['viptime'] = '<div class="viptime">白银会员:'.date("Y-m-d",$ad['vip']).'</div>';
        		}else{
					$ad['vipstr'] = '<i title="普通会员" class="user-ident"></i>';
					$ad['viptime'] = '-------';					
				}
        		$ads[] = $ad;
        	}
			$value['nickname'] = htmlspecialchars($value['nickname']);
		?>
	<article class="excerpt-list excerp-user" data-aos="<?php echo $Tconfig["aosxg"];?>">
		<div class="fly-user-title cl">
		<h2>会员排行榜</h2> <a href="javascript:;" title="此处按VIP等级排行">排行</a>
		</div>
		<div class="area">
			<div class="frame cl">
				<div class="block">	
					<div class="fly_user">
						<ul class="fly_user-list row">
							<?php foreach ($ads as $value) { ?>
							<li class="fly_user-li col-sm-2 col-xs-4" user-id="<?php echo $value['uid'];?>">
								<a href="javascript:;" class="avatar" alt="<?php if($value['nickname']){echo $value['nickname'];}else{echo '雅尚中国';}?>">
									<?php if($value['role'] == 'admin'){echo '<i title="本站管理员" class="user-identw"></i>';}else{echo $value['vipstr'];};?>
									<img class="lazy" src="<?php echo TEMPLATE_URL; ?>img/avatar.png" data-original="<?php if($value['photo']){echo $value['photo'];}else{echo TEMPLATE_URL.'img/avatar.png';}?>" alt="<?php echo $value['nickname'];?>">
								</a>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</article>
<script>
//评论列表头像hover详细信息;;;和guestdetail大部分代码重复，暂且这样
function comm_author_detail(){
	if (!navigator.userAgent.match(/(iPhone|iPod|Android|ios)/i)){//移动端屏蔽
		var list_detail = $('<div id="list-detail" class="detail" />'),
			detail_left,//左边距
			detail_top,//顶距
			
			li_hover = 0,
			detail_hover = 0;
		
		if ( !$( '#list-detail ')[0] ){
			$( '#FLY' ).after(list_detail);
		}
		list_detail = $( '#list-detail');
		//评论列表
			$(".fly_user-li").hover(function(){
				var id = $(this).attr('user-id');
				var _this = $(this),
				_window_width = $(window).width();
				li_hover = 1;
				clearTimeout(detail_time);
				detail_time = setTimeout(function(){
					$.ajax({
						url:pjaxtheme+'inc/ajax.php',
						type:'GET',
						data:{ a: 'ajax_author', id: id },
						beforeSend:function(){
							//左距离
							detail_left = _this.offset().left - 50;
							if ( detail_left < 0 ) detail_left = 0;
							if ( detail_left + 260 > _window_width ) detail_left = _window_width - 260;
							//顶距
							detail_top = _this.offset().top - 10;
							//向上显示detail框
							list_detail.show().css({'left':detail_left,'top':detail_top + 24,'opacity':0}).stop().animate({top:detail_top,opacity:1},300);
							//预插入显示三角箭头
							list_detail.html('<div class="list-detail"></div>');
							//显示loading
							if ( !$( '#list-detail .loading-bar' )[0] ){
								list_detail.append('<div class="loading-bar"><div class="user-loding"><img src="' + pjaxtheme + 'img/user-loading.gif" style="width:100%"></div></div>');//loading
							}
							$( '#list-detail .loading-bar' ).show();
						},
						error:function(){
							list_detail.html('ajax error!');
						},
						success:function(data){
							$( '.loading-bar' ).fadeOut(function(){
								list_detail.html(data);
							});
						}
					});
				},80);
			},function(){
				li_hover = 0;
				clearTimeout(detail_time);
				detail_time = setTimeout(function(){
					if ( detail_hover == 0 ){
						list_detail.stop().animate({top:detail_top + 24,opacity:0},300,function(){list_detail.hide()});
					}
				},100);
			});
			
			list_detail.hover(function(){
				detail_hover = 1;
			},function(){
				detail_hover = 0;
				clearTimeout(detail_time);
				detail_time = setTimeout(function(){
					if ( li_hover == 0 ){
						list_detail.stop().animate({top:detail_top + 24,opacity:0},300,function(){list_detail.hide()});
					}
				},100);
			});
	}
}
comm_author_detail();
</script>
<?php }?>
<?php if ($Tconfig["fous_open"]==1):echo index_fous($Tconfig["fous_id"]);endif;?>
<?php }?>
<?php
if($Tconfig["ads"]== 1 ){
?>
<!-- 广告位置：首页_列表_横幅_h760w80 | ID:1 -->
<article class="excerpt-list" data-aos="<?php echo $Tconfig["aosxg"];?>"><a href="<?php echo $Tconfig["adurl1"];?>" target="_blank"><img src="<?php echo $Tconfig["adimg1"];?>" style="width: 100%;"></a></article>
<!-- 广告结束 投放请联系站长 -->
<?php }?>
<!-- 列表 -->
<?php 
if (!empty($logs)):
foreach ($logs as $key => $value):$ii++;
$top = topflg($value['top'], $value['sortop'], isset($sortid)?$sortid:'');
$t=time() - 3*24*60*60;
$log_t=gmdate('Y-m-d',$value['date']);
$diy_t=date("Y-m-d",$t);
if($top){
	$show = '<i class="top-mark  article-mark"></i>';
	$shows = '<i class="top-mark  article-marks"></i>';
}elseif($value['views'] >= 5000){
	$show = '<i class="hot-mark  article-mark"></i>';
	$shows = '<i class="hot-mark  article-marks"></i>';
}elseif($log_t > $diy_t){
	$show = '<i class="new-mark  article-mark"></i>';
	$shows = '<i class="new-mark  article-marks"></i>';
}else{
	$show = '';
	$shows = '';
}
if(pic_thumb($value['content'])){
        $imgsrc = pic_thumb($value['content']);
	}elseif(getThumbnail($value['logid'])){
	    $imgsrc = getThumbnail($value['logid']);
	}else{
	    $imgsrc = TEMPLATE_URL.'img/random/'.substr($value['logid'],-1).'.jpg';
	}
?>
		<article class="content-list" data-aos="<?php echo $Tconfig["aosxg"];?>">
<?php
  preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $value['content'], $imgs);
  $imgNum = count($imgs[1]);
  if($imgNum >= 3) {
?>
<div class="content-box posts-image-box">
		<div class="posts-default-title">
			<div class="post-entry-categories"><?php blog_tag($value['logid']); ?></div>
			<h2><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a> <small class="text-muted" title="本文<?php echo $imgNum;?>张图片"><?php if($imgNum > 0){echo '<span class="fa fa-picture-o"></span>';}?></small></h2>
		</div>
		<?php echo $shows;?>
		<div class="post-images-item">
			<ul>
			<?php for($i=0;$i<=2;$i++){ ?>
				<li>
                    <div class="image-item">
                        <a class="simg" href="<?php echo $value['log_url']; ?>">
                            <img class="thumbnails lazy" src="<?php echo TEMPLATE_URL; ?>img/lazyload.gif" data-original="<?php echo $imgs[1][$i];?>?param=250y135" alt="<?php echo $value['log_title']; ?>">
                        </a>
                    </div>
                </li>
			<?php } ?>
            </ul>

		</div>
		<div class="posts-default-content">
			
			<div class="posts-text"><?php echo blog_tool_purecontent(ishascomment($value['content'],$value['logid']), 58);?></div>
			<div class="posts-default-info">
				<ul>
					<li class="post-author"><div class="avatar"><img alt="" src="<?php global $CACHE;$user_cache = $CACHE->readCache('user');$uid = $value['author'];if($user_cache[$uid]['photo']['src']){echo BLOG_URL.$user_cache[$uid]['photo']['src'];}else{echo TEMPLATE_URL.'img/avatar.png';}?>" class="avatar avatar-96 photo" height="96" width="96"></div><?php echo index_author($value['author']); ?></li>
					<li class="ico-cat"><i class="fa fa-list"></i>  <?php blog_sort($value['logid']); ?></li>
					<li class="ico-time"><i class="fa fa-clock-o"></i> <?php echo gmdate('Y-n-j', $value['date']); ?></li>
					<li class="ico-eye"><i class="fa fa-eye"></i> <?php echo $value['views'];?></li>
					<li class="ico-like"><i class="fa fa-comments-o"></i> <?php echo $value['comnum'];?></li>
				</ul>
			</div>
		</div>
	</div>

<?php
  }else{
?>
<div class="content-box posts-gallery-box">
		<?php echo $show;?>
		<div class="posts-gallery-img">
			<a class="simg" href="<?php echo $value['log_url']; ?>">
				<img class="thumbnails lazy" src="<?php echo TEMPLATE_URL; ?>img/lazyload.gif" data-original="<?php echo $imgsrc;?>?param=232y135" alt="<?php echo $value['log_title']; ?>">
			</a> 
		</div>
		<div class="posts-gallery-content">
			<h2><a href="<?php echo $value['log_url']; ?>" title="<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a> <small class="text-muted" title="本文<?php echo $imgNum;?>张图片"><?php if($imgNum > 0){echo '<span class="fa fa-picture-o"></span>';}?></small></h2>
			<div class="posts-gallery-text"><?php echo blog_tool_purecontent(ishascomment($value['content'],$value['logid']), 116);?></div>
			<div class="posts-default-info posts-gallery-info">
				<ul>
					<li class="post-author"><div class="avatar"><img alt="" src="<?php global $CACHE;$user_cache = $CACHE->readCache('user');$uid = $value['author'];if($user_cache[$uid]['photo']['src']){echo BLOG_URL.$user_cache[$uid]['photo']['src'];}else{echo TEMPLATE_URL.'img/avatar.png';}?>" class="avatar avatar-96 photo" height="96" width="96"></div><?php echo index_author($value['author']); ?></li>
					<li class="ico-cat"><i class="fa fa-list"></i>  <?php blog_sort($value['logid']); ?></li>
					<li class="ico-time"><i class="fa fa-clock-o"></i> <?php echo gmdate('Y-n-j', $value['date']); ?></li>
					<li class="ico-eye"><i class="fa fa-eye"></i> <?php echo $value['views'];?></li>
					<li class="ico-like"><i class="fa fa-comments-o"></i> <?php echo $value['comnum'];?></li>
				</ul>
			</div>
		</div>
	</div>
<?php	  
  }
?>
		</article>
			<?php 
			if($Tconfig["moshi"]== 2 ){
			$index_log1 = $Tconfig["index_num"] - 1;
			if($pageurl == Url::logPage() && $key == $index_log1){break;}};
			endforeach;
			if (blog_tool_ishome()){echo fly_page($lognum,$index_lognum,$page,$pageurl);};
			else:
			?>
			<article id="post-box" data-aos="<?php echo $Tconfig["aosxg"];?>">
				<div class="panel">
					<header class="panel-header">
								<h2 class="post-title"><i class="fa fa-info-circle"></i> 友情提示</h2>
						</header>
					<section class="context">
						<p class="tips">你找到的东西压根不存在呀,你可以尝试搜索一下其他关键词！</p>
        			<form action="<?php echo BLOG_URL; ?>" method="get" class="navbar-form navbar-left search-form">
        				<div class="input-group">
        					<input type="text" class="form-control search-texts" name="keyword" placeholder="输入关键词搜索..." >
        					<div class="input-group-btn">
        						<button class="btn btn-default">搜索</button>
        					</div>
        				</div>
        			</form>
					</section>
				</div>
			</article>
			<?php endif;?>
			<?php if($Tconfig["ads"]== 1 ){?>
			<article class="excerpt-list" data-aos="<?php echo $Tconfig["aosxg"];?>"><a href="<?php echo $Tconfig["adurl2"];?>" target="_blank"><img src="<?php echo $Tconfig["adimg2"];?>" style="width: 100%;"></a></article>
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
				$out = "<div class='row index_cms'>";
				foreach ($sort_id as $key => $i) {
					$out .= "<div class='col-sm-6 index_cms_6 {$key}'><div class='panel panel-default index_cms_panel' data-aos='{$Tconfig["aosxg"]}'><span class='icon'><i class='".$Tconfig['arr_sortico'][$i]."'></i></span> <div class='panel-heading'><h3 class='panel-title'>".$sort_cache[$i]['sortname']."<span class='more pull-right'><a title='更多' href='".Url::sort($i)."'><i class='fa fa-ellipsis-h'></i></a></span></h3></div><div class='panel-body  panel_cms'><ul>";
					if(count($sort_cache[$i]['children']) > 0){
						//unset($chaxun);
                        $chaxun[] = "sortid=$i";
                    	foreach($sort_cache[$i]['children'] as $keyi => $sidi){
							//unset($chaxun);
                        	$chaxun[] ="sortid=$sidi";
                        }
                        $chaxun = implode(" or ",$chaxun);
                    }else{
                     $chaxun = "sortid=$i";
                    }
                    $logss = $db->query('SELECT * FROM ' . DB_PREFIX . "blog WHERE $chaxun AND type='blog' AND hide='n' order by date DESC limit 0,5");
					while($trow = $db->fetch_array($logss)) {;
						$date = gmdate('Y年m月d日', $trow['date']);
						$trow['title'] = mb_substr($trow['title'], 0, 16, 'utf-8');
						$url = Url::log($trow['gid']);
						$out .= "<li><a href=\"{$url}\"><time>{$date}</time><i class=\"fa fa-chevron-right\"></i> {$trow['title']}</a></li>";
					}
					$out .= "</ul></div></div></div>";
				}
				$out .= "</div>";
				echo $out;
				};
			?>
			<!-- cms结束 -->
			<?php }?>
            <?php }?>
			<!--分页开始-->
			<?php if (!blog_tool_ishome()) {?>
			<?php echo fly_page($lognum,$index_lognum,$page,$pageurl);?>
			<!--分页结束-->
			<?php }?>
		</div>
	</div>
<?php if (blog_tool_ishome()){include View::getView('side');}else{include View::getView('side1');}?>
</section>
<?php include View::getView('footer');?>
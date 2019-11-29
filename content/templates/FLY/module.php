<?php 
/**
 * FLY.Theme by Finally
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
date_default_timezone_set('Asia/Shanghai');
//本模板专用VIP控制器
//不是VIP返回false ，是VIP返回到期时间
function _vip($uid = '0') {
	if($uid==''){$uid = UID;}
	$DB = Database::getInstance();
	$row = $DB->once_fetch_array("select * from ".DB_PREFIX."user where uid='$uid'");
	if($row){
		if($row['vip'] <= time()){
			$data['level'] = '0';
			$data['name'] = '普通';
			$data['time'] = '0';
		}else{
			if($row['level'] == 1){
				$data['level'] = $row['level'];
				$data['name'] = '白银';
				$data['time'] = $row['vip'];
			}
			if($row['level'] == 2){
				$data['level'] = $row['level'];
				$data['name'] = '黄金';
				$data['time'] = $row['vip'];
			}
			if($row['level'] == 3){
				$data['level'] = $row['level'];
				$data['name'] = '钻石';
				$data['time'] = $row['vip'];
			}
		}
		return $data;
	}
	return '-1';
}
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	global $Tconfig;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];
	$db = Database::getInstance();
    $sta_cache = array();
	$data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'blog WHERE type = \'blog\'');
    $log_total = $data['total'];
    $data = $db->once_fetch_array('SELECT COUNT(*) AS total FROM ' . DB_PREFIX . 'comment');
    $log_com = $data['total'];
    $data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "twitter");
    $wei_yu = $data['total'];
	?>
	<li class="widget widget_ui_blogger" data-aos="<?php echo $Tconfig["aosxg"];?>">
	    <article class="panel-side">
	        <div class="fly_weibo">
        	<ul class="blogger_side">
        	    <div id="weiboShow">
        	        <div class="grid-weibo-show shadow-hover">
        		        <header id="shead">&nbsp;</header>
        		        <div id="user-login" class="contentt">
        			        <div class="avatar">
        	                	  <img src="<?php if($user_cache[1]['photo']['src']){echo BLOG_URL.$user_cache[1]['photo']['src'];}else{echo TEMPLATE_URL.'img/avatar.png';}?>?param=80y80">
								  <i title="<?php echo $user_cache[1]['name']; ?>" class="author-ident"></i>
        	                	<div class="overlay">
                                    <a href="#" class="expand" data-target="#myLogin" data-toggle="modal" data-backdrop="static" target="_blank">Login</a>
                                </div>
        				        <span class="rank"></span>
        			        </div>
							<h4><?php echo $user_cache[1]['name']; ?></h4>
        			        <p class="seta"><?php echo $user_cache[1]['des']; ?></p>
							<div class="author-social"> <span class="author-blog"> <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $Tconfig["side_qq"];?>&amp;site=qq&amp;menu=yes" rel="nofollow" target="_blank"><i class="fa fa-qq"></i>客服</a> </span> <span class="author-weibo"> <a href="<?php echo $Tconfig["side_dp"];?>" rel="nofollow" target="_blank"><i class="fa fa-thumbs-up"></i>店铺</a> </span> </div>
        		        </div>
        		        <div id="user-div" class="contentt" style="display:none;">
        			        <div class="avatar">
        	                	  <span class="dlimg"></span>
								  <i class="dlname"></i>
        				        <span class="rank"></span>
        			        </div>
                            <div class="sidebar-user row">
								<div class="dlcd"></div>
            					<div class="col-sm-6 sideli"><a href="<?php echo BLOG_URL; ?>?user&home"><i class="fa fa-user-circle-o"></i> 用户中心</a></div>
            					<div class="col-sm-6 sideli"><a href="<?php echo BLOG_URL; ?>?user&comments"><i class="fa fa-comments-o"></i> 评论管理</a></div>
            					<div class="col-sm-6 sideli dlset"></div>
            					<div class="col-sm-6 sideli login_logout"><a href="javascript:void(0);"  target="_blank"><i class="fa fa-sign-out"></i> 退出登陆</a></div>
                            </div>
        		        </div>
        		        <footer>
        					<ul class="blogger_footer">
        						<li><strong><?php echo $log_total;?></strong><span>文章</span></li>
        						<li><strong><?php echo $log_com;?></strong><span>评论</span></li>
        						<li><strong><?php echo $wei_yu;?></strong><span>微语</span></li>
        					</ul>
        		        </footer>
        	        </div>
                </div>
            </ul>
            </div>
	    </article>
	</li>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){
	global $Tconfig;?>
<li class="widget widget_calendar" data-aos="<?php echo $Tconfig["aosxg"];?>">
  <div id="calendar_wrap"><?php echo @calendar();?></div>
</li>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
    global $CACHE;
	global $Tconfig;
    $tag_cache = $CACHE->readCache('tags');?>
    <li class="widget widget_ui_tags" data-aos="<?php echo $Tconfig["aosxg"];?>">
  <div class="widget-title"><span class="icon"><i class="fa fa-tags"></i></span>
    <h3><?php echo $title; ?></h3>
  </div>
    <div class="items">
        <?php shuffle ($tag_cache);
		$tag_cache = array_slice($tag_cache,0,30);foreach($tag_cache as $value): ?>
            <a href="<?php echo Url::tag($value['tagurl']); ?>"><?php echo $value['tagname']; ?></a>
        <?php endforeach; ?>
        </div>
    </li>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
	global $CACHE;
	global $Tconfig;
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
    <li class="widget widget_posts_list" data-aos="<?php echo $Tconfig["aosxg"];?>">
	<article class="panel-side">
	<header class="panel-header"><span class="icon"><i class="fa fa-line-chart"></i></span>
	<h3 class="widget-title"><?php echo $title; ?></h3></header>
	<ul class="sidebar-posts-list">
        <?php foreach($newLogs_cache as $value): 
            $thum_src = getThumbnail($value['gid']);
            $imgsrc = getimgforgid($value['gid']);
            if($thum_src) {
                $img = $thum_src;
            }elseif($imgsrc){
                $img = $imgsrc;
            }else{
                $img = TEMPLATE_URL.'img/random/'.substr($value['gid'],-1).'.jpg';
            }?>
	<li>
	<a href="<?php echo Url::log($value['gid']); ?>" class="thumbnail-link" rel="bookmark" ><img src="<?php echo $img;?>" class="thumbnailside" width="50" height="50" title="<?php echo $value['title']; ?>" alt="<?php echo $value['title']; ?>"></a>
	<div class="right-box"><h4 class="side-title"><a href="<?php echo Url::log($value['gid']); ?>" data-toggle="tooltip" data-placement="bottom"  title="<?php echo $value['title']; ?>" rel="bookmark"><?php echo $value['title']; ?></a></h4>
	<ul class="side-meta">
	<li class="date date-abb">
	<span class="fa fa-clock-o"></span>
	<a href="<?php echo Url::log($value['gid']); ?>" title="发布于<?php echo gettime($value['gid']);?>">
	<time pubdate="pubdate"><?php echo gettime($value['gid']);?></time>
	</a>
	</li>
	<li class="views">
	<span class="fa fa-eye"></span>
	<a href="javascript:;" title="浏览了<?php echo blog_content($value['gid'],'views');?>次"><?php echo blog_content($value['gid'],'views');?></a>
	</li>
	</ul>
	</div>
	</li>
	<?php endforeach; ?>
    </ul>
	</article>
    </li>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
	global $Tconfig;
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$hotLogs = $Log_Model->getHotLog($index_hotlognum);?>
    <li class="widget widget_posts_list" data-aos="<?php echo $Tconfig["aosxg"];?>">
	<article class="panel-side">
	<header class="panel-header"><span class="icon"><i class="fa fa-thumbs-o-up"></i></span>
	<h3 class="widget-title"><?php echo $title; ?></h3></header>
	<ul class="sidebar-posts-list">
	<?php foreach($hotLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
    </ul>
	</article>
    </li>
<?php }?>
<?php
//widget：随机文章
function widget_random_log($title){
	global $Tconfig;
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
    <li class="widget widget_posts_list" data-aos="<?php echo $Tconfig["aosxg"];?>">
	<article class="panel-side">
	<header class="panel-header"><span class="icon"><i class="fa fa-random"></i></span>
	<h3 class="widget-title"><?php echo $title; ?></h3></header>
	<ul class="sidebar-randlog-list">
        <?php foreach($randLogs as $value): 
            $thum_src = getThumbnail($value['gid']);
            $imgsrc = getimgforgid($value['gid']);
            if($thum_src) {
                $img = $thum_src;
            }elseif($imgsrc){
                $img = $imgsrc;
            }else{
                $img = TEMPLATE_URL.'img/random/'.substr($value['gid'],-1).'.jpg';
            }?>
	<li><a href="<?php echo Url::log($value['gid']); ?>" title="发布于<?php echo gettime($value['gid']);?>">
	<span class="thumbnails"><span><img src="<?php echo $img;?>" class="thumbs" alt="<?php echo $value['title']; ?>"></span></span>
	<span class="text"><?php echo $value['title']; ?></span></a>
	</li>
	<?php endforeach; ?>
    </ul>
	</article>
    </li>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
    global $CACHE; 
	global $Tconfig;
    $com_cache = $CACHE->readCache('comment');
    ?>
    <li class="widget span12 widget_recent_comments" data-aos="<?php echo $Tconfig["aosxg"];?>">
	<article class="panel-side">
	<header class="panel-header"><span class="icon"><i class="fa fa-comments-o"></i></span>
	<h3 class="widget-title"><?php echo $title; ?></h3></header>
	<ul class="sidebar-comments-list show-avatars side-ul">
        <?php
        foreach($com_cache as $value):
        $url = Url::comment($value['gid'], $value['page'], $value['cid']);
        ?>
        <li>
            <a href="<?php echo $url; ?>" title="来自《<?php echo $value['name'];?>dalao》的评论">
                <img alt="<?php echo $value['name'];?>" src="<?php echo getqqpic($value['mail']);?>" class="avatar avatar-36 photo" height="36" width="36" >
				<div class="right-box"><p class="comment-text"><?php echo sidecomcontent($value['content']); ?></p></div>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
	</article>
    </li>
<?php }?>
<?php
//widget：搜索
function widget_search($title){
	global $Tconfig;?>
	<li class="widget" data-aos="<?php echo $Tconfig["aosxg"];?>">
  <div class="widget-title"><span class="icon"><i class="fa fa-search"></i></span>
    <h3><?php echo $title; ?></h3>
  </div>
    <ul class="list-unstyled souul">
        <form name="keyform" method="get" action="<?php echo BLOG_URL; ?>">
            <div class="input-group">
                <input name="keyword" value="请善用搜索功能" class="form-control search soutext" type="text" onfocus="if (value =='请善用搜索功能'){value =''}" onblur="if (value ==''){value='请善用搜索功能'}"/>
                <div class="input-group-btn"> <button class="btn btn-default soubtn">搜索</button> </div>
            </div>
        </form>
    </ul>
    </li>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
    global $CACHE;
	global $Tconfig;
    $record_cache = $CACHE->readCache('record');
    ?>
    <li class="widget widget_archive" data-aos="<?php echo $Tconfig["aosxg"];?>">
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
	<li class="widget widget_ui_sort" data-aos="<?php echo $Tconfig["aosxg"];?>">
	<div class="widget-title"><span class="icon"><i class="fa fa-file-text-o"></i></span>
		<h3><?php echo $title; ?></h3>
	</div>
		<ul class="row sort-ul">
	<?php
	foreach($sort_cache as $value):
		$sid=$value["sid"];
		if ($value['pid'] != 0) continue;
	?>
		<li class="col-sm-6 sort-li"> <a title="<?php echo $value['lognum'] ?> 篇文章" href="<?php echo Url::sort($value['sid']); ?>"><i class="<?php if(empty($Tconfig["arr_sortico"][$sid])){echo "fa fa-code";}else{echo $Tconfig["arr_sortico"][$sid];}?>"></i> <?php echo $value['sortname']; ?></a> </li> 
	<?php endforeach; ?>
	</ul> </li>
<?php }?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){
	global $Tconfig;?>
	<li class="widget widget_text" data-aos="<?php echo $Tconfig["aosxg"];?>">
	<div class="widget-title"><span class="icon"><i class="fa fa-th-large"></i></span>
        <h3><?php echo $title; ?></h3>
    </div>
		<div class="widget-zdy"><?php echo $content; ?></div>
	</li>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
    global $CACHE;
	global $Tconfig;
    $link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
    ?>
    <li class="widget widget_links" data-aos="<?php echo $Tconfig["aosxg"];?>">
  <div class="widget-title"><span class="icon"><i class="fa fa-link"></i></span>
    <h3><?php echo $title; ?></h3>
  </div>
    <ul class="row">
        <?php foreach($link_cache as $value): ?>
        <li class="col-sm-4 link-li"><a href="<?php echo $value['url']; ?>" data-toggle="tooltip" title="<?php echo $value['des']; ?>" target="_blank"><i class="fa fa-angle-double-right"></i> <?php echo $value['link']; ?></a></li>
        <?php endforeach; ?>
    </ul>
    </li>
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
            <li class="<?php if (!empty($value['children']) || !empty($value['childnavi'])) :?>dropdown<?php endif;?><?php echo $current_tab;?>" >
                <a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>  <?php if (!empty($value['children']) || !empty($value['childnavi'])) :?>class="dropdown-toggle" data-toggle="dropdown"<?php endif;?> >
				<?php if(empty($Tconfig['arr_navico'][$id])) {echo $value['naviname'];}else {echo "<i class='".$Tconfig['arr_navico'][$id]."'></i> ".$value['naviname']."";} ?>
				<?php if (!empty($value['children']) || !empty($value['childnavi'])) :?>
				<span class="fa fa-angle-down"></span>
				<?php endif;?>                
				</a>
				<?php if (!empty($value['children'])) :?>
                <ul class="dropdown-menu">
                    <?php foreach ($value['children'] as $row){
                            echo '<li><a href="'.Url::sort($row['sid']).'"><i class="'.$Tconfig['arr_sortico'][$row['sid']].'"></i> '.$row['sortname'].'</a></li>';
                    }?>
                </ul>
                <?php endif;?>
                <?php if (!empty($value['childnavi'])) :?>
                <ul class="dropdown-menu">
                    <?php foreach ($value['childnavi'] as $row){
                            $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                            echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                    }?>
                </ul>
                <?php endif;?>
            </li>
            <?php endforeach; ?>
            <?php if($Tconfig['more']== 1 ){?>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flask"></i> 更多功能 <span class="fa fa-angle-down"></span> </a>
                <ul class="dropdown-menu">
                    <?php echo $Tconfig['more_html'];?>
                </ul>
            </li>
            <?php }?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL.'?_pjax=%23'.get_template_name() || BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
//外链IP库 支持https
function get_ips($commentip){
	$ip = @file_get_contents("https://ipip.yy.com/get_ip_info.php?ip=".$commentip."");
	$gs=json_decode(ltrim(rtrim($ip, ";"), "var returnInfo = "),true);
	echo $gs['country'].' '.$gs['province'].' '.$gs['city'];
}
//本地IP库
function get_ip($ip) { $dat_path = EMLOG_ROOT.'/ip.dat'; //*数据库路径*//
if(!$fd = @fopen($dat_path, 'rb')){ return 'IP数据库文件不存在或者禁止访问或者已经被删除！';   
    } $ip = explode('.', $ip); $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3]; $DataBegin = fread($fd, 4); $DataEnd = fread($fd, 4); $ipbegin = implode('', unpack('L', $DataBegin)); if($ipbegin < 0) $ipbegin += pow(2, 32); $ipend = implode('', unpack('L', $DataEnd)); if($ipend < 0) $ipend += pow(2, 32); $ipAllNum = ($ipend - $ipbegin) / 7 + 1; $BeginNum = 0; $EndNum = $ipAllNum; while($ip1num>$ipNum || $ip2num<$ipNum) { $Middle= intval(($EndNum + $BeginNum) / 2); fseek($fd, $ipbegin + 7 * $Middle); $ipData1 = fread($fd, 4); if(strlen($ipData1) < 4) { fclose($fd); return '系统出错！';   
        } $ip1num = implode('', unpack('L', $ipData1)); if($ip1num < 0) $ip1num += pow(2, 32); if($ip1num > $ipNum) { $EndNum = $Middle; continue;   
        } $DataSeek = fread($fd, 3); if(strlen($DataSeek) < 3) { fclose($fd); return '系统出错！';   
        } $DataSeek = implode('', unpack('L', $DataSeek.chr(0))); fseek($fd, $DataSeek); $ipData2 = fread($fd, 4); if(strlen($ipData2) < 4) { fclose($fd); return '系统出错！';   
        } $ip2num = implode('', unpack('L', $ipData2)); if($ip2num < 0) $ip2num += pow(2, 32); if($ip2num < $ipNum) { if($Middle == $BeginNum) { fclose($fd); return '未知';   
            } $BeginNum = $Middle;   
        }   
    } $ipFlag = fread($fd, 1); if($ipFlag == chr(1)) { $ipSeek = fread($fd, 3); if(strlen($ipSeek) < 3) { fclose($fd); return '系统出错！';   
        } $ipSeek = implode('', unpack('L', $ipSeek.chr(0))); fseek($fd, $ipSeek); $ipFlag = fread($fd, 1);   
    } if($ipFlag == chr(2)) { $AddrSeek = fread($fd, 3); if(strlen($AddrSeek) < 3) { fclose($fd); return '系统出错！';   
        } $ipFlag = fread($fd, 1); if($ipFlag == chr(2)) { $AddrSeek2 = fread($fd, 3); if(strlen($AddrSeek2) < 3) { fclose($fd); return '系统出错！';   
            } $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0))); fseek($fd, $AddrSeek2);   
        } else { fseek($fd, -1, SEEK_CUR);   
        } while(($char = fread($fd, 1)) != chr(0)) $ipAddr2 .= $char; $AddrSeek = implode('', unpack('L', $AddrSeek.chr(0))); fseek($fd, $AddrSeek); while(($char = fread($fd, 1)) != chr(0)) $ipAddr1 .= $char;   
    } else { fseek($fd, -1, SEEK_CUR); while(($char = fread($fd, 1)) != chr(0)) $ipAddr1 .= $char; $ipFlag = fread($fd, 1); if($ipFlag == chr(2)) { $AddrSeek2 = fread($fd, 3); if(strlen($AddrSeek2) < 3) { fclose($fd); return '系统出错！';   
            } $AddrSeek2 = implode('', unpack('L', $AddrSeek2.chr(0))); fseek($fd, $AddrSeek2);   
        } else { fseek($fd, -1, SEEK_CUR);   
        } while(($char = fread($fd, 1)) != chr(0)){ $ipAddr2 .= $char;   
        }   
    } fclose($fd); if(preg_match('/http/i', $ipAddr2)) { $ipAddr2 = '';   
    } $ipaddr = "$ipAddr1 $ipAddr2"; $ipaddr = preg_replace('/CZ88.Net/is', '', $ipaddr); $ipaddr = preg_replace('/^s*/is', '', $ipaddr); $ipaddr = preg_replace('/s*$/is', '', $ipaddr); if(preg_match('/http/i', $ipaddr) || $ipaddr == '') { $ipaddr = '未知';   
    } $ipaddr = iconv('gbk', 'utf-8//IGNORE', $ipaddr); if( $ipaddr != '  ' ) return $ipaddr; else $ipaddr = '评论者来自火星，无法或者其所在地!'; return $ipaddr;   
}
//查看该用户是否评论
function ishascomment($content,$post_id){
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
			$hide_notice = '<div style="text-align:center;border:1px dashed #5db8f8;padding:8px;margin:10px auto;color:#5db8f8;"><i class="fa fa-lock"></i> 管理员设置 <a id="opencomment" href="#comment">回复</a> 可见隐藏内容</div>';
			$content = str_replace($hide_words[0], $hide_notice, $content); 
		}
	}
	if(preg_match_all('|\[vip\]([\s\S]*?)\[\/vip\]|i', $content, $hide_words)){
		$data = _vip(UID);
		if((UID && $data && $data != -1 && $data['level'] != 0) || ROLE == 'admin'){//管理和VIP可见
			$content = str_replace($hide_words[0],$hide_words[1], $content);
		}else{
			if(UID){
				$hide_notice = '<div style="text-align:center;border:1px dashed #5db8f8;padding:8px;margin:10px auto;color:#5db8f8;"><i class="fa fa-lock"></i> 管理员设置VIP可见隐藏内容,前往 <a href="'.BLOG_URL.'?user&pay">充值</a> 页面升级</div>';
			}else{
				$hide_notice = '<div style="text-align:center;border:1px dashed #5db8f8;padding:8px;margin:10px auto;color:#5db8f8;"><i class="fa fa-lock"></i> 管理员设置VIP可见隐藏内容,立即 <a href="#" class="expand" data-target="#myLogin" data-toggle="modal" data-backdrop="static" target="_blank">登录</a> 开通VIP</div>';
			}
			$content = str_replace($hide_words[0], $hide_notice, $content); 
		}
	}
	if(preg_match_all('|\[pay money=(.*?)\]([\s\S]*?)\[\/pay\]|', $content, $hide_words)){
        $r = Database::getInstance();
        $row=$r->once_fetch_array("SELECT * FROM  `".DB_NAME."`.`".DB_PREFIX."user_log` WHERE `uid` =  '".UID."' and `gid` = '".$post_id."' AND status = 1");
		if(UID){

            if($row && $row['status'] == '1'){
                $hide_notice = $hide_words[2];
            }else{
                $hide_notice = '<div style="text-align:center;border:1px dashed #5db8f8;padding:8px;margin:10px auto;color:#5db8f8;"><i class="fa fa-lock"></i> 该内容被设置为付费可见。您需要支付 '.$hide_words[1][0].' 元,前往 <a id="paygid" gid="'.$post_id.'" herf="javascript:;" data-toggle="modal">立即支付</a></div>';
            }
		}else{
			$hide_notice = '<div style="text-align:center;border:1px dashed #5db8f8;padding:8px;margin:10px auto;color:#5db8f8;"><i class="fa fa-lock"></i> 该内容被设置为付费可见。您需要 <a href="#" class="expand" data-target="#myLogin" data-toggle="modal" data-backdrop="static" target="_blank">点此登录</a> 继续操作</div>';
		}
		$content = str_replace($hide_words[0], $hide_notice, $content); 
	}
	return $content;
}
//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
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
//格式化内容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString(preg_replace("/\[gsvideo url=(.*) w=(.*) h=(.*)\]/", '', $content), 0, $strlen);
        }
        return $content;
}
//分页函数
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
//blog：文章作者
function index_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	echo "<a href=\"".Url::author($uid)."\" title=\"查看关于 {$author} 的文章\">$author</a>";
}
//获取文章图片数量
function pic($content){
	if(preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $content, $img) && !empty($img[1])){
		echo $imgNum = count($img[1]);
	}else{
		echo "0";
	}
}
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	if($uid==1){
		$ri='管理员';
	}else{
		$ri='站内会员';
	}
	echo "<a href=\"".Url::author($uid)."\" title=\"$ri\">$author</a>";
}
//blog：文章标签
function blog_tag($blogid){
    global $CACHE;
    $tag_model = new Tag_Model();
    $log_cache_tags = $CACHE->readCache('logtags');
    if (!empty($log_cache_tags[$blogid])){
        $tag = '';
        foreach ($log_cache_tags[$blogid] as $value){
            $tag .= "
<a rel=\"tag\"  href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
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
                $tag .= "
<a rel=\"tag\" href=\"".Url::tag(rawurlencode($value))."\">".htmlspecialchars($value).'</a>';
            }
            echo $tag;
        }
    }
}
//字符转换
function number($ssbb) {
	$patterns = array ("0","1","2","3","4","5","6","7","8","9"); 
	$replace = array ("零","一","二","三","四","五","六","七","八","九");
	$ssbb=str_replace($patterns, $replace, $ssbb);
	return $ssbb;
}

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
//Custom：获取模板目录名称
function get_template_name(){
    $template_name = str_replace(BLOG_URL,"",TEMPLATE_URL);
    $template_name = str_replace("content/templates/","",$template_name);
    $template_name = str_replace("/","",$template_name);
    return $template_name;
}
//blog-tool:获取Gravatar头像并缓存到本地
function SB_getGravatar($email, $s=40, $d='monsterid', $r='g') {
    $f = md5($email);
	if(empty($email)){
	$a = TEMPLATE_URL.'img/avatar.png';
	}else{
	$a = TEMPLATE_URL.'img/avatar/'.$f.'.jpg';
	}
    $e = EMLOG_ROOT.'/content/templates/'.get_template_name().'/img/avatar/'.$f.'.jpg';
    $t = 1296000; //15天，单位：秒
    if (empty($d)) $d = TEMPLATE_URL.'img/avatar.png';
    if (!is_file($e) || (time() - filemtime($e)) > $t ) {
        //当头像不存在或者超过15天才更新
        $g = sprintf("https://secure.gravatar.com",(hexdec($f{0})%2)).'/avatar/'.$f.'?s=48&d='.$d.'&r='.$r;
        copy($g,$e); $a=$g; //新头像copy时, 取gravatar显示
    }
    if (filesize($e) < 500) copy($d,$e);
    return $a;
}
//吐槽水军
function guest($num){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['name'];
	$DB = Database::getInstance();
	$sql = "SELECT count(*) AS comment_nums,poster,mail,url FROM ".DB_PREFIX."comment where date >0 and poster !='". $name ."' and  poster !='' and hide ='n' group by poster order by comment_nums DESC limit 0,$num";
	$log_content = $content[1];
	if(strpos($log_content, '[READERWALL-WEEK]') > -1) {
		$cur_time_span = strtotime('last Year',strtotime('Sunday'));
	}
	$result = $DB -> query( $sql );
	while($row = $DB -> fetch_array($result)){
		$img = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(赐教" . $row[ 'comment_nums' ] . "次)\"><img  alt=\"avatar\"  src=\"" . getqqpic($row['mail']) . "\" class=\"avatar\"><em>" . $row[ 'poster' ] ."</em><strong>+" . $row[ 'comment_nums' ] . "</strong></a></li>";
		if( $row[ 'url' ] ){
			$tmp = "<li><a rel=\"external nofollow\" target=\"_blank\" href=\"" . $row[ 'url' ] . "\" title=\"" . $row[ 'poster' ] ."(吐槽" . $row[ 'comment_nums' ] . "次)<br>" . $row[ 'url' ] . "\" ><img  alt=\"avatar\"  src=\"" . getqqpic($row['mail']) . "\"><em>" . $row[ 'poster' ] ."</em><strong>+" . $row[ 'comment_nums' ] . "</strong></a></li>";
		}else{
			$tmp = $img;
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
//评论内容
function comcontent($pl) {
	$patterns = array ("/@/","/\[blockquote\](.*?)\[\/blockquote\]/","/\[F(([1-4]?[0-9])|50)\]/"); 
	$replace = array ('回复了','<blockquote>$1</blockquote>','<img alt="表情" src="'.TEMPLATE_URL.'img/face/$1.gif" />'); 
	$pl=preg_replace($patterns, $replace, $pl);
	return $pl;
}
//侧边栏评论
function sidecomcontent($pl) {
	$patterns = array ("/@/","/\[blockquote\](.*?)\[\/blockquote\]/","/\[F(([1-4]?[0-9])|50)\]/"); 
	$replace = array ('回复了','<small>$1</small>','<img alt="表情" src="'.TEMPLATE_URL.'img/face/$1.gif" />'); 
	$pl=preg_replace($patterns, $replace, $pl);
	return $pl;
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
//正则去除HTML
function ClearHtml($content) {  
   $preg = "/<\/?[^>]+>/i";
   return preg_replace($preg,'',$content);
}
//检测是否为手机
function em_is_mobile() {
    static $is_mobile;

    if ( isset($is_mobile) )
        return $is_mobile;

    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;
    } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
            $is_mobile = true;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
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
function blog_info(){
	$sbtr = 'aHR0c' .                                                                                                                                                                                                         'HM6Ly'.'9wamF4LmNuL2JsYW5rLnR4dA==';
	return base64_decode($sbtr);
}
?>
<?php
//widget：分类
function user_sort(){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); 
	?>
	<?php
	foreach($sort_cache as $value):
		$sid=$value["sid"];
		//if ($value['pid'] != 0) continue;
	?>
    <li><a target="_blank" href="<?php echo Url::sort($value['sid']); ?>" title="<?php echo $value['lognum'] ?> 篇文章"><?php echo $value['sortname']; ?></a></li>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" title="查看<?php echo $log_cache_sort[$blogid]['name']; ?>下的全部文章"><?php echo $log_cache_sort[$blogid]['name']; ?> </a>
	<?php else:?>
	未分类
	<?php endif;?>
<?php }?>
<?php
//blog：面包屑导航
function mianbao_navi($blogid,$log_title){
	global $CACHE; 
	$log_cache_navi = $CACHE->readCache('logsort');
	?>
	<ol class="breadcrumb">
	<li><a href="<?php echo BLOG_URL; ?>">首页</a></li> 
	<li>
	<?php if(!empty($log_cache_navi[$blogid])): ?>
    <a class="cat" href="<?php echo Url::sort($log_cache_navi[$blogid]['id']); ?>"><?php echo $log_cache_navi[$blogid]['name']; ?></a>
	</li>
	<?php else:?>
	未分类
	<?php endif;?>
	<li class="active"><?php echo $log_title; ?></li></ol>
<?php }?>
<?php
//首页热门幻灯片获取指定分类
function index_fous($sort){
	global $CACHE;
	global $Tconfig;
	$sort_cache = $CACHE->readCache('sort');
	$db = Database::getInstance();
	$show = '';
	$show .='<article class="focusmo"  data-aos="'.$Tconfig["aosxg"].'"><ul>';
	$list_1 = $db->query("SELECT * FROM " . DB_PREFIX . "blog WHERE sortid='".$sort."' AND type='blog' AND hide='n' order by date DESC limit 0,1");
		while($first = $db->fetch_array($list_1)){
			if(pic_thumb($first['content'])){
				$imgsrc = pic_thumb($first['content']);
			}else{
				$imgsrc = TEMPLATE_URL.'img/random/'.substr($first['gid'],-1).'.jpg';
			}
	$show .= '<li class="large"><a href="'.Url::log($first['gid']).'"><img src="'.TEMPLATE_URL.'img/lazyload.gif" data-original="'.$imgsrc.'?param=395y256" class="thumb lazy"><h4>'.$first['title'].'</h4></a></li>';
		}
	$list_2 = $db->query("SELECT * FROM " . DB_PREFIX . "blog WHERE sortid='".$sort."' AND type='blog' AND hide='n' order by date DESC limit 1,4");
		while($second = $db->fetch_array($list_2)){
			if(pic_thumb($second['content'])){
				$imgsrc = pic_thumb($second['content']);
			}else{
				$imgsrc = TEMPLATE_URL.'img/random/'.substr($second['gid'],-1).'.jpg';
			}
	$show .= '<li><a href="'.Url::log($second['gid']).'"><img src="'.TEMPLATE_URL.'img/lazyload.gif" data-original="'.$imgsrc.'?param=188y128" class="thumb lazy"><h4>'.$second['title'].'</h4></a></li>';
		}
	$show .='</ul></article>';
	return $show;
}
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       return $top == 'y' ? true : false;
    } elseif($sortid){
       return $sortop == 'y' ? true : false;
    }
}

//comment：输出评论人等级
function echo_levels($comment_author_email,$comment_author_url){
	$DB = Database::getInstance();
	global $CACHE;
	$user_cache = $CACHE->readCache('user'); 
	$adminEmail = '"'.$user_cache[1]['mail'].'"';
	if($comment_author_email==$adminEmail){
		echo '<a class="admin" title="这货就是管理员"><img src="'.TEMPLATE_URL.'img/admin.png"></a>';
	}
	$sql = "SELECT cid as author_count,mail FROM ".DB_PREFIX."comment WHERE mail != '' and mail = $comment_author_email and hide ='n'";
	$res = $DB->query($sql);
	$author_count = $DB->num_rows($res);
	if($author_count>=0 && $author_count<5 && $comment_author_email!=$adminEmail)
		echo '<a class="vip1" title="VIP等级：初入联盟 LV.1"><i class="pro"></i><i class="level">Lv.1</i></a>';
	else if($author_count>=5 && $author_count<10 && $comment_author_email!=$adminEmail)
		echo '<a class="vip2" title="VIP等级：英勇黄铜 LV.2"><i class="pro"></i><i class="level">Lv.2</i></a>';
	else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
		echo '<a class="vip3" title="VIP等级：不屈白银 LV.3"><i class="pro"></i><i class="level">Lv.3</i></a>';
	else if($author_count>=20 && $author_count<30 && $comment_author_email!=$adminEmail)
		echo '<a class="vip4" title="VIP等级：华贵铂金 LV.4"><i class="pro"></i><i class="level">Lv.4</i></a>';
	else if($author_count>=30 &&$author_count<40 && $comment_author_email!=$adminEmail)
		echo '<a class="vip5" title="VIP等级：璀璨钻石 LV.5"><i class="pro"></i><i class="level">Lv.5</i></a>';
	else if($author_count>=40 && $author_coun<50 && $comment_author_email!=$adminEmail)
		echo '<a class="vip6" title="VIP等级：超凡大师 LV.6"><i class="pro"></i><i class="level">Lv.6</i></a>';
	else if($author_count>=50 && $author_coun<60 && $comment_author_email!=$adminEmail)
		echo '<a class="vip7" title="VIP等级：最强王者 LV.7"><i class="pro"></i><i class="level">Lv.7</i></a>';
	else if($author_count>=60 && $author_coun<70 && $comment_author_email!=$adminEmail)
		echo '<a class="vip8" title="VIP等级：职业选手 LV.8"><i class="pro"></i><i class="level">Lv.8</i></a>';
}
?>
<?php
//search：标签
function search_tag($title){
    global $CACHE;
    $tag_cache = $CACHE->readCache('tags');?>
        <?php shuffle ($tag_cache);
		$tag_cache = array_slice($tag_cache,0,30);foreach($tag_cache as $value): ?>
			<li class="search-go"><a href="<?php echo BLOG_URL; ?>tag/<?php echo $value['tagname']; ?>"><?php echo $value['tagname']; ?></a></li>
        <?php endforeach; ?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);$comnum = count($comments);
	if($commentStacks):?>
	<a name="comments"></a>
	<header class="panel-header">
		<h3 class="log_h3">
			<span class="fa fa-angellist"></span> 评论</h3>
			<span class="right"><span class="comments-number"><?php echo $comnum; ?></span>条评论</span>
	</header>
	<ol class="comments-list show-avatars">
	<?php endif; ?>
	<?php
	$isGravatar = Option::get('isgravatar');
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
				$ls_role='class="comment_admin author" title="管理员"';
				$is_userqq = empty($qq) ? '' : '<a href="tencent://message/?uin='.$qq.'" title="联系'.$name.'" rel="nofollow"><img src="'.TEMPLATE_URL.'img/qq.gif"></a>';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			if($role=="writer"){
				$ls_role='class="comment_writer author" title="本站会员"';
				$is_userqq = empty($qq) ? '' : '<a href="tencent://message/?uin='.$qq.'" title="联系'.$name.'" rel="nofollow"><img src="'.TEMPLATE_URL.'img/qq.gif"></a>';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			break;
		}
	}
	if(empty($ls_role)){
		$ls_role='class="comment_visitor author" title="游客"';
		$is_userqq = '';
		$isuserlink = $comment['url'];
		$isuserphoto = getqqpic($comment['mail']);
	}
	$comment['poster'] = $isuserlink ? '<a href="https://pjax.cn/go.php?url='.$isuserlink.'" target="_blank" class="url" '.$isNofollow.'>'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li class="comment even thread-odd thread-alt depth-1 show-avatars" id="comment-<?php echo $comment['cid']; ?>">
	    <article id="comment-box-<?php echo $comment['cid']; ?>" class="comment-box">
			<?php if($isGravatar == 'y'): ?>
			<img srcset="<?php echo $isuserphoto;?>" alt="avatar" class="avatar avatar-42 photo" height="42" width="42"/><?php endif; ?>
			<div class="right-box">
			    <p class="comment-meta"> <span <?php echo $ls_role;?>><?php echo $comment['poster']; ?> <?php //echo $is_userqq;?> <?php echo echo_levels("\"".strip_tags($comment['mail'])."\"","\"".$isuserlink."\"");?></span> <span class="useragent"><?php if(function_exists('display_useragent')){display_useragent($comment['cid']);} ?></span> <span class="reply"><i rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)" aria-label="回复"><span class="fa fa-reply-all"></span> 回复</i></span></p>
			    <p><?php echo comcontent($comment['content']); ?></p>
			    <p class="time"><span class="sign"><span class='fa fa-desktop'></span> <?php echo get_ip($comment['ip']);?></span> <time pubdate="pubdate"><span class="fa fa-clock-o"></span> <?php echo $comment['date']; ?></time></p>
			</div>
		</article>
		<ol class="children"><?php blog_comments_children($comments, $comment['children']); $ii=0;?></ol>
	</li>
	<?php $i--;endforeach; ?>
	</ol>
    <nav class="comments-list-nav page-navi">
		<?php echo $commentPageUrl;?>
		<?php if($commentPageUrl): ?>
		<?php endif; ?>
    </nav>
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
				$ls_role='class="comment_admin author" title="管理员"';
				$is_userqq = empty($qq) ? '' : '<a href="tencent://message/?uin='.$qq.'" title="联系'.$name.'" rel="nofollow"><img src="'.TEMPLATE_URL.'img/qq.gif"></a>';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			if($role=="writer"){
				$ls_role='class="comment_writer author" title="本站会员"';
				$is_userqq = empty($qq) ? '' : '<a href="tencent://message/?uin='.$qq.'" title="联系'.$name.'" rel="nofollow"><img src="'.TEMPLATE_URL.'img/qq.gif"></a>';
				$isuserlink = empty($zhuye) ? BLOG_URL : $zhuye;
				$isuserphoto = empty($photo) ? getqqpic($comment['mail']) : BLOG_URL.$photo['src'];
			}
			break;
		}
	}
	if(empty($ls_role)){
		$ls_role='class="comment_visitor author" title="游客"';
		$isuserlink = $comment['url'];
		$isuserphoto = getqqpic($comment['mail']);
	}
	$comment['poster'] = $isuserlink ? '<a href="https://pjax.cn/go.php?url='.$isuserlink.'" target="_blank" class="url" '.$isNofollow.'>'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li class="comment byuser comment-author-bing bypostauthor odd alt depth-2 show-avatars" id="comment-<?php echo $comment['cid']; ?>">
			<?php if($isGravatar == 'y'): ?>
			<article id="comment-box-492" class="comment-box">
			    <img srcset="<?php echo $isuserphoto;?>" class="avatar avatar-42 photo" height="42" width="42">
			    <div class="right-box">
			        <p class="comment-meta"> <span <?php echo $ls_role;?>><?php echo $comment['poster']; ?> <?php //echo $is_userqq;?>  <?php echo echo_levels("\"".strip_tags($comment['mail'])."\"","\"".$isuserlink."\"");?></span> <span class="useragent"><?php if(function_exists('display_useragent')){display_useragent($comment['cid']);} ?></span> <span class="reply"><i rel="nofollow" class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)" aria-label="回复"><span class="fa fa-reply-all"></span> 回复</i></span></p>
			        <p><?php echo comcontent($comment['content']); ?></p></div>
			        <p class="time"><span class="sign1"><span class='fa fa-desktop'></span> <?php echo get_ip($comment['ip']);?></span> <time pubdate="pubdate"><span class="fa fa-clock-o"></span> <?php echo $comment['date']; ?></time></p>
            </article>
			<?php endif; ?>
		<?php blog_comments_children($comments, $comment['children']); $ii++;?>
	</li>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<h3 id="reply-title" class="comment-reply-title"><span class="fa fa-comments-o"></span> 发表评论 <div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()"><span class="fa fa-share"></span> 取消回复</a></div></h3>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" id="comment-gid" value="<?php echo $logid; ?>" />
			<input type="hidden" name="pid" id="comment-pid" value="0"/>
			<p class="comment-notes"><span id="email-notes">电子邮件地址不会被公开。</span> 必填项已用<span class="required">*</span>标注</p>
			<textarea id="comment" class="form-control comment-form-comment textarea" placeholder="来都来了,不随便说两句吗?" name="comment" tabindex="4" cols="45" rows="10"></textarea>
			<?php if(ROLE == ROLE_VISITOR): ?>
        <input class="form-control comment-form-qq" placeholder="QQ" id="qqhao" name="qq" maxlength="10" type="text" value="" tabindex="0" size="10">
		<input class="form-control comment-form-author" placeholder="昵称" id="author" name="comname" maxlength="20" type="text" value="<?php echo $ckname; ?>" tabindex="1" size="22">
        <input class="form-control comment-form-email" placeholder="邮箱" id="email" name="commail" maxlength="30" type="email" value="<?php echo $ckmail; ?>" tabindex="2" size="22">
		<input class="form-control comment-form-url" placeholder="网站" id="url" name="comurl" maxlength="30" type="url" value="<?php echo $ckurl; ?>" tabindex="3" size="22">
			<?php endif; ?>
			<p class="form-submit"><?php if(ROLE == ROLE_VISITOR){if(Option::get('comment_code') == 'y'){?><span class="ajaximgcode"><?php echo $verifyCode; ?></span><?php }};?><button type="submit" id="submit" class="btn btn-default" tabindex="6">发表评论</button>
			</p>
			<div class="comment-form-smiley no-js-hide" onclick="embedSmiley()"><div class="opensmile" title="插入表情" class="button">
			<span class="fa fa-smile-o" style="top:2px"></span></div><div class="smiley-box" style="display:none"><?php include View::getView('inc/smile');?></div></div>
			<div title="打卡" onclick="javascript:SIMPALED.Editor.daka();this.style.display='none'" class="daka"><i class="fa fa-pencil"></i></div>
			<div title="赞" onclick="javascript:SIMPALED.Editor.zan();this.style.display='none'" class="zan"><i class="fa fa-thumbs-o-up"></i></div>
			<div title="踩" onclick="javascript:SIMPALED.Editor.cai();this.style.display='none'" class="cai"><i class="fa fa-thumbs-o-down"></i></div>
			<div id="error"></div><div id="ajaxloading"></div>
			<div id="error1"></div><div id="ajaxloading1"></div>
			<?php if(SEND_MAIL == 'Y' || REPLY_MAIL == 'Y'){ ?>
			<div class="input-send"><input value="y" checked="checked" type="checkbox" name="send"> 允许邮件通知</div>
			<?php } ?>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>
<?php //内容页
function dyyinfo($logid){
	$db = Database::getInstance();
	$row= $db->once_fetch_array("SELECT * FROM ".DB_PREFIX."blog WHERE gid =$logid");
	if(img_zw($row['content'])){$imgurl = img_zw($row['content']);}elseif(img_fj($row['gid'])){$imgurl = img_fj($row['gid']);}else{$imgurl = TEMPLATE_URL.'img/random/'.substr($row['gid'],-1).'.jpg';}?>
<div class="logtop">
					<dt>
						<img src="<?php echo $imgurl;?>">
					</dt>
					<dd>
						<h3><?php echo $row['title'];?></h3>
						<p>标签：<?php echo neirong_tag($logid);?></p>
						<p>分类：<?php echo dy_sort($logid);?></p>
						<p>评论：<?php echo $row['comnum'];?>条</p>
						<p>更新日期：<?php echo gmdate('Y-n-j',$row['date']);?></p>
						<p>观看次数：<?php echo $row['views'];?>次</p>
					</dd>
					<dl>
						<h4>剧情介绍</h4>
						<p><?php echo ClearHtml($row['content']);?></p>
					</dl>
					<dl>
						<h4 class="dz">播放地址</h4>
						<p>
						<?php 
						$strarr = explode("\n",$row['spdz']);
						$i=1;
						foreach ($strarr as $u){
							$jishu=explode("*",$u);?>
							<a class="spbut" href="<?php echo '?ply='.$i++;?>"><?php echo $jishu[0];?></a>
						<?php }?>
						</p>
					</dl>
				</div>
<?php } ?>
<?php //分类
function dy_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
<?php if(!empty($log_cache_sort[$blogid])): ?>
<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" title="<?php echo $log_cache_sort[$blogid]['name']; ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
<?php endif;?>
<?php }?>
<?php
function img_zw($content){preg_match_all("/<img.*src\s*=\s*[\"|\']?\s*([^>\"\'\s]*)/i",str_ireplace("\\","",$content),$imgsrc);return $imgsrc[1][0];}
function img_fj($logid){$db = Database::getInstance();$sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$logid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";$imgs = $db->query($sql);$img_path = "";while($row = $db->fetch_array($imgs)){$img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));}
return $img_path;}?>
<?php
//获取所有链接分类
function getLinkSort(){
global $CACHE;
$sortlink_cache = $CACHE->readCache('sortlink'); ?>
<?php foreach($sortlink_cache as $value):?>
<li sid="<?php echo $value['linksort_id']; ?>"><?php echo $value['linksort_name']; ?></li>
<?php endforeach; ?>
<?php }?>
<?php
//按分类显示链接
function sortLinks(){
$db = Database::getInstance();
global $CACHE;
$sortlink_cache = $CACHE->readCache('sortlink');
foreach($sortlink_cache as $value){
$out .= '<div id="links'.$value['linksort_id'].'" class="links-panel"><blockquote>'.$sortlink_cache[$value['linksort_id']]['linksort_name'].'</blockquote>';
$links = $db->query ("SELECT * FROM ".DB_PREFIX."link WHERE linksortid='$value[linksort_id]' AND hide='n' order by `taxis` ASC");
while ($row = $db->fetch_array($links)){
$out .='<div class="col-md-3 col-sm-4 col-xs-6 linkli"><a href="'.$row['siteurl'].'" title="'.$row['description'].'" target="_blank"><img alt="link" src="'.TEMPLATE_URL.'inc/ico.php?url='.preg_replace('/(http:\/\/)|(https:\/\/)/i', '', $row['siteurl']).'">'.$row['sitename'].'</a></div>';
}
$out .='</div><div class="clearfix"></div>';
}
echo $out;
}?>
<?php exit;//a:72:{s:8:"blogname";s:15:"雅尚资源网";s:8:"bloginfo";s:61:"苏皓'blog - 关注最新QQ活动动态,掌握QQ第一资讯";s:10:"site_title";s:79:"雅尚资源网 - 苏皓'blog - 关注最新QQ活动动态,掌握QQ第一资讯";s:16:"site_description";s:190:"雅尚资源网提供最新QQ活动、QQ技巧、QQ软件，努力打造为一个最全QQ活动网,还有电脑技巧以及其他日常信息 游戏资讯等 让我们的Q生活更加精彩	";s:8:"site_key";s:115:"雅尚资源网,QQ活动,QQ活动网,爱Q网,QQ新闻,QQ技巧,苏皓,苏皓blog,苏皓博客,SuHao,免费QQ活动	";s:15:"log_title_style";s:1:"1";s:7:"blogurl";s:24:"https://www.yashang.ink/";s:3:"icp";s:20:"豫ICP备19023431号";s:11:"footer_info";s:81:"<script type="text/javascript" src="https://js.users.51.la/20160935.js"></script>";s:17:"admin_perpage_num";s:2:"15";s:14:"rss_output_num";s:2:"10";s:19:"rss_output_fulltext";s:1:"y";s:12:"index_lognum";s:2:"10";s:12:"index_comnum";s:2:"10";s:11:"index_twnum";s:2:"10";s:14:"index_newtwnum";s:1:"5";s:15:"index_newlognum";s:1:"5";s:16:"index_randlognum";s:1:"5";s:15:"index_hotlognum";s:1:"5";s:14:"comment_subnum";s:2:"20";s:13:"nonce_templet";s:3:"FLY";s:11:"admin_style";s:10:"admin-blue";s:11:"tpl_sidenum";s:1:"4";s:12:"comment_code";s:1:"n";s:19:"comment_needchinese";s:1:"y";s:16:"comment_interval";s:2:"60";s:10:"isgravatar";s:1:"y";s:11:"isthumbnail";s:1:"y";s:11:"att_maxsize";s:5:"20480";s:8:"att_type";s:50:"rar,zip,gif,jpg,jpeg,png,txt,pdf,docx,doc,xls,xlsx";s:11:"att_imgmaxw";s:3:"420";s:11:"att_imgmaxh";s:3:"460";s:14:"comment_paging";s:1:"y";s:12:"comment_pnum";s:2:"10";s:13:"comment_order";s:5:"newer";s:10:"login_code";s:1:"n";s:9:"iscomment";s:1:"y";s:12:"ischkcomment";s:1:"n";s:12:"isurlrewrite";s:1:"1";s:7:"isalias";s:1:"y";s:12:"isalias_html";s:1:"y";s:12:"isgzipenable";s:1:"y";s:9:"isexcerpt";s:1:"y";s:14:"excerpt_subnum";s:3:"300";s:9:"istwitter";s:1:"y";s:8:"timezone";s:1:"0";s:14:"active_plugins";s:361:"a:10:{i:0;s:19:"sitemap/sitemap.php";i:1;s:27:"kl_sendmail/kl_sendmail.php";i:2;s:17:"cpdown/cpdown.php";i:3;s:31:"content_lv_cv/content_lv_cv.php";i:4;s:23:"bd_submit/bd_submit.php";i:5;s:23:"baidu_xzh/baidu_xzh.php";i:6;s:27:"tpl_options/tpl_options.php";i:7;s:21:"ja_share/ja_share.php";i:8;s:25:"MyhkPlayer/MyhkPlayer.php";i:9;s:21:"link_web/link_web.php";}";s:12:"widget_title";s:410:"a:13:{s:7:"blogger";s:12:"个人资料";s:8:"calendar";s:6:"日历";s:7:"twitter";s:12:"最新微语";s:3:"tag";s:6:"标签";s:4:"sort";s:6:"分类";s:7:"archive";s:6:"存档";s:7:"newcomm";s:12:"最新评论";s:6:"newlog";s:12:"最新文章";s:10:"random_log";s:12:"随机文章";s:6:"hotlog";s:12:"热门文章";s:4:"link";s:6:"链接";s:6:"search";s:6:"搜索";s:11:"custom_text";s:18:"自定义组件 ()";}";s:13:"custom_widget";s:2844:"a:2:{s:11:"custom_wg_1";a:2:{s:5:"title";s:6:"本站";s:7:"content";s:1917:"      

<div class="lead-title">
<table cellpadding="0" cellspacing="0" border="1" style="width:100%;font-weight:700;text-align:center;" bordercolor="#ff5500">
 
<tbody>

   
<td height="28" colspan="5" style="font-size:15px;">
<b>

<script type="text/javascript">(function(){document.write(unescape('%3Cdiv id="bdcs"%3E%3C/div%3E'));var bdcs = document.createElement('script');bdcs.type = 'text/javascript';bdcs.async = true;bdcs.src = 'http://znsv.baidu.com/customer_search/api/js?sid=1152302146349204199' + '&plate_url=' + encodeURIComponent(window.location.href) + '&t=' + Math.ceil(new Date()/3600000);var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(bdcs, s);})();</script>
<div id="bdcs"></div>
<marquee scrollamount="3" behavior="alternate">
<span style="font-size:13px;color:#000000;">  <p><?php
$Log_Model = new Log_Model();
$today = strtotime(date('Y-m-d'));//今天凌晨时间戳
$threeday = strtotime(date('Y-m-d',strtotime('-3 day')));//3天前凌晨时间戳
$tenday = strtotime(date('Y-m-d',strtotime('-10 day')));//10天前凌晨时间戳
$today_sql = "and date>$today";
$today_num = $Log_Model->getLogNum('n', $today_sql);
$threeday_sql = "and date>$threeday";
$threeday_num = $Log_Model->getLogNum('n', $threeday_sql);
$tenday_sql = "and date>$tenday";
$tenday_num = $Log_Model->getLogNum('n', $tenday_sql);
if($tenday_num=='0'){echo '这博客已经废了 都10几天了 没有更新内容 | ';}
elseif($threeday_num=='0'){echo '这博客快要荒废了 连续3天都没有更新文章了 | ';}
elseif($today_num=='0'){echo '今日站长很懒 一篇文章都没更新 | ';}
else{echo ' <b>今日已更新<b style="color:red">'.$today_num.'</b>个资源 | </b> ';}
?><b>本站共分享了<b style="color:re
d"><?php echo $sta_cache['lognum'];?></b>个资源</b></p></span></marquee></b>
   </td>	</tr>
 </tbody>
</table>
  
   </div>";}s:11:"custom_wg_2";a:2:{s:5:"title";s:0:"";s:7:"content";s:780:"<div class="new-tag">
                                    <div class="new-title">随机云标签</div> 
                                    <div class="new-tags">
                                    <a href="/search.asp?key=教程&amp;submit=搜索" style="transform:scale(1.0);">其他教程</a> <a href="/search.asp?key=源码&amp;submit=搜索" style="transform:scale(1.1);">网站源码</a> <a href="/search.asp?key=免费&amp;submit=搜索" style="transform:scale(1.1);">免费资源</a> <a href="/search.asp?key=活动&amp;submit=搜索" style="transform:scale(1.1);">活动资讯</a><a href="/search.asp?key=空间&amp;submit=搜索" style="transform:scale(1.1);">免费主机</a> 
                                    </div>
                                     </div>";}}";s:8:"widgets1";s:123:"a:7:{i:0;s:7:"blogger";i:1;s:6:"search";i:2;s:6:"newlog";i:3;s:4:"link";i:4;s:6:"hotlog";i:5;s:8:"calendar";i:6;s:3:"tag";}";s:8:"widgets2";s:37:"a:2:{i:0;s:6:"hotlog";i:1;s:3:"tag";}";s:8:"widgets3";s:37:"a:2:{i:0;s:6:"newlog";i:1;s:3:"tag";}";s:8:"widgets4";s:42:"a:2:{i:0;s:10:"random_log";i:1;s:3:"tag";}";s:10:"detect_url";s:1:"n";s:11:"webscan_log";s:1:"2";s:14:"webscan_switch";s:1:"1";s:12:"webscan_post";s:1:"1";s:11:"webscan_get";s:1:"1";s:14:"webscan_cookie";s:1:"1";s:15:"webscan_referre";s:1:"1";s:23:"webscan_white_directory";s:17:"admin|\/content\/";s:16:"webscan_block_ip";s:7:"0.0.0.0";s:7:"attacks";s:2:"10";s:9:"MAIL_SMTP";s:11:"stmp.qq.com";s:9:"MAIL_PORT";s:3:"465";s:14:"MAIL_SENDEMAIL";s:17:"1725202104@qq.com";s:13:"MAIL_PASSWORD";s:16:"pnfyvurmrwmscibb";s:12:"MAIL_TOEMAIL";s:17:"1725202104@qq.com";s:13:"MAIL_SENDTYPE";s:1:"1";s:9:"SEND_MAIL";s:1:"Y";s:10:"REPLY_MAIL";s:1:"Y";s:14:"yls_reg_enable";s:1:"n";}
<?php
/*
 * @Emlog大前端4.3
 * @authors 小草 (blog.yesfree.pw)
 * @date    2016-7-10
 * @version 4.3
 */
if(!defined('EMLOG_ROOT')) {exit('Dream Functions Requrire Emlog!');}
function d($str){
	$str = str_replace("'","\'",$str );
	return $str;
}
function plugin_setting(){
	$do = isset($_GET['do']) ? $_GET['do'] : '';
if ($do == 'update') {
	} elseif($do == 'save') {
		if(empty($_POST)){
			emMsg("修改失败，请重试！");
			return ;
		}
		 $timedate = isset($_POST['timedate']) ? d(trim($_POST['timedate'])) : '';//建站时间
		 $timehide = isset($_POST['timehide']) ? d(trim($_POST['timehide'])) : '';
		 $logo_url = isset($_POST['logo_url']) ? d(trim($_POST['logo_url'])) : '';
		 $new_log_num = isset($_POST['new_log_num']) ? d(trim($_POST['new_log_num'])) : '';
		 $web_method = isset($_POST['web_method']) ? d(trim($_POST['web_method'])) : '';
		 $navhide = isset($_POST['navhide']) ? d(trim($_POST['navhide'])) : '';
		 $home_text = isset($_POST['home_text']) ? d(trim($_POST['home_text'])) : '';
		 $radio_zhiding = isset($_POST['radio_zhiding']) ? d(trim($_POST['radio_zhiding'])) : '';
		 $heightkey = isset($_POST['heightkey']) ? d(trim($_POST['heightkey'])) : '';
		 $top_title = isset($_POST['top_title']) ? d(trim($_POST['top_title'])) : '';
		 $top_titleurl = isset($_POST['top_titleurl']) ? d(trim($_POST['top_titleurl'])) : '';
		 $top_content = isset($_POST['top_content']) ? d(trim($_POST['top_content'])) : '';
		 $home_toptext = isset($_POST['home_toptext']) ? d(trim($_POST['home_toptext'])) : '';
		 $ppt_zhiding = isset($_POST['ppt_zhiding']) ? d(trim($_POST['ppt_zhiding'])) : '';
		 $ppt_picurl = isset($_POST['ppt_picurl']) ? d(trim($_POST['ppt_picurl'])) : '';
		 $ppt_titleurl = isset($_POST['ppt_titleurl']) ? d(trim($_POST['ppt_titleurl'])) : '';
		 $ppt_picur2 = isset($_POST['ppt_picur2']) ? d(trim($_POST['ppt_picur2'])) : '';
		 $ppt_titleur2 = isset($_POST['ppt_titleur2']) ? d(trim($_POST['ppt_titleur2'])) : '';
		 $ppt_picur3 = isset($_POST['ppt_picur3']) ? d(trim($_POST['ppt_picur3'])) : '';
		 $ppt_titleur3 = isset($_POST['ppt_titleur3']) ? d(trim($_POST['ppt_titleur3'])) : '';
		 $arr_navico = $_POST['arr_navico'];
		 $arr_sortico = $_POST['arr_sortico'];
		 $side_title = $_POST['side_title'];
		 $side_url = $_POST['side_url'];
		 $css = isset($_POST['css']) ? d(trim($_POST['css'])) : '';
		 $pjax = isset($_POST['pjax']) ? d(trim($_POST['pjax'])) : '';
		 $m_cms_pci = isset($_POST['m_cms_pci']) ? d(trim($_POST['m_cms_pci'])) : '';
		 $m_cms_page = isset($_POST['m_cms_page']) ? d(trim($_POST['m_cms_page'])) : '';
		 $imgnum_all = isset($_POST['imgnum_all']) ? d(trim($_POST['imgnum_all'])) : '';
		 $tip = isset($_POST['tip']) ? d(trim($_POST['tip'])) : '';
		 $type_wall = isset($_POST['type_wall']) ? d(trim($_POST['type_wall'])) : '';
		 $ad_side = isset($_POST['ad_side']) ? d(trim($_POST['ad_side'])) : '';
		 $ad_page = isset($_POST['ad_page']) ? d(trim($_POST['ad_page'])) : '';
		 $ad_page_down = isset($_POST['ad_page_down']) ? d(trim($_POST['ad_page_down'])) : '';
		 $theme_skin = isset($_POST['theme_skin']) ? d(trim($_POST['theme_skin'])) : '';
		 $userhide = isset($_POST['userhide']) ? d($_POST['userhide']):'0';
		 $webcompress = isset($_POST['webcompress']) ? d($_POST['webcompress']):'0';		 
		 $firstblood = 1;		 
		 $module_thum = isset($_POST['module_thum']) ? d($_POST['module_thum']):'0';
		 $down_next = isset($_POST['down_next']) ? d($_POST['down_next']):'0';
		 $m_zazhi_config = isset($_POST['m_zazhi_config']) ? d($_POST['m_zazhi_config']):'0';
		 $m_zazhi_config1 = isset($_POST['m_zazhi_config1']) ? d($_POST['m_zazhi_config1']):'0';
		 $m_zazhi_config2 = isset($_POST['m_zazhi_config2']) ? d($_POST['m_zazhi_config2']):'0';
		 $cdn_css = isset($_POST["cdn_css"])?d($_POST["cdn_css"]):'0';
         $m_gfs_tuijian = isset($_POST["m_gfs_tuijian"])?d($_POST["m_gfs_tuijian"]):'0';
         $m_gfs_div = isset($_POST["m_gfs_div"])?d($_POST["m_gfs_div"]):'0';
         
		 $data = "<?php
				 \$timedate = '".$timedate."';
				 \$timehide = '".$timehide."';
				 \$logo_url = '".$logo_url."';
	 			 \$new_log_num = '".$new_log_num."';
				 \$web_method = '".$web_method."';
				 \$navhide = '".$navhide."';
				 \$home_text = '".$home_text."';
		         \$radio_zhiding = '".$radio_zhiding."';
		         \$heightkeycolor = '".$heightkeycolor."';
		         \$top_title = '".$top_title."';
		         \$top_titleurl = '".$top_titleurl."';				 
		         \$top_content = '".$top_content."';
				 \$heightkey = '".$heightkey."';
				 \$home_toptext = '".$home_toptext."';				 
				 \$ppt_zhiding= '".$ppt_zhiding."';			 
			     \$ppt_picurl = '".$ppt_picurl."';
			     \$ppt_titleurl = '".$ppt_titleurl."';
			 	 \$ppt_picur2 = '".$ppt_picur2."';
			 	 \$ppt_titleur2 = '".$ppt_titleur2."';
			     \$ppt_titleur3 = '".$ppt_titleur3."';
			 	 \$ppt_picur3 = '".$ppt_picur3."';
				 \$arr_navico = '".serialize($arr_navico)."';
				 \$arr_sortico = '".serialize($arr_sortico)."';
				 \$side_title = '".serialize($side_title)."';
				 \$side_url = '".serialize($side_url)."';				 
				 \$css = '".$css."';
				 \$theme_skin = '".$theme_skin."';
				 \$m_cms_pci = '".$m_cms_pci."';
				 \$m_cms_page = '".$m_cms_page."';
				 \$imgnum_all = '".$imgnum_all."';
				 \$pjax = '".$pjax."';
				 \$tip = '".$tip."';
				 \$type_wall = '".$type_wall."';
				 \$ad_side = '".$ad_side."';
				 \$ad_page = '".$ad_page."';
				 \$ad_page_down = '".$ad_page_down."';
				 \$userhide = '".$userhide."';
				 \$firstblood = '".$firstblood."';
				 \$webcompress = '".$webcompress."';				 
				 \$module_thum = '".$module_thum."';				 
				 \$down_next = '".$down_next."';
				 \$m_zazhi_config = '".$m_zazhi_config."';
				 \$m_zazhi_config1 = '".$m_zazhi_config1."';
				 \$m_zazhi_config2 = '".$m_zazhi_config2."';
				 \$cdn_css = '".$cdn_css."';
                 \$m_gfs_tuijian = '".$m_gfs_tuijian."';
                 \$m_gfs_div = '".$m_gfs_div."';
	    ?>";
		$file = EMLOG_ROOT.'/content/templates/Dream/config.php';
		@ $fp = fopen($file, 'wb') OR emMsg('读取文件失败，如果您使用的是Unix/Linux主机，请修改文件/content/templates/Dream/config.phpnfig.php的权限为777。如果您使用的是Windows主机，请联系管理员，将该文件设为everyone可写');
		@ $fw =	fwrite($fp,$data) OR emMsg('写入文件失败，如果您使用的是Unix/Linux主机，请修改文件/content/templates/Dream/config.php的权限为777。如果您使用的是Windows主机，请联系管理员，将该文件设为everyone可写');
		fclose($fp);
		emMsg("修改配置成功！",BLOG_URL.'?setting');
		//header("Location:?setting");
		}
}
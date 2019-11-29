<?php
/*
 * @des 主题控制中心
 * meta.theme by 蓝优
 */
if(!defined('EMLOG_ROOT')) {exit('meta Functions Requrire Emlog!');}
function d($str){
	$str = str_replace("'","\'",$str );
	return $str;
}
//检查文件类型和上传错误
function sc_files($type,$error){
	if ($error > 0) {
		switch ($error) {
			case '1':
				emMsg("上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。");
				break;
			case '2':
				emMsg("上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 ");
				break;
			case '3':
				emMsg("文件只有部分被上传。 ");
				break;
			case '4':
				emMsg("没有文件被上传。 ");
				break;
			case '6':
				emMsg("找不到临时文件夹。");
				break;
			case '7':
				emMsg("文件写入失败!");
				break;
		}
		exit();
	}elseif (($type != 'image/png') && ($type != 'image/jpeg') && ($type != 'image/pjpeg') && ($type != 'images/x-png') && ($type != 'image/x-icon')) {
		emMsg("文件格式错误，请重新上传！");
		exit();
	}
}
function plugin_setting(){
	$do = isset($_GET['do']) ? $_GET['do'] : '';
    if($do == 'save') {
		if(empty($_POST)){
                emMsg("修改失败，请重试！");
			return ;
		}
		//处理上传的图片
		if ($_FILES['logo']['error'] != 4) {
			sc_files($_FILES['logo']['type'],$_FILES['logo']['error']);
			$logo = $_FILES['logo']['tmp_name'];
			$logopath = 'content/templates/meta/images/logo.png';
			$a = move_uploaded_file($logo, EMLOG_ROOT .'/'.$logopath);
			$logo = BLOG_URL.$logopath;
		}else{
			$logo = isset($_POST['logo']) ? d(trim($_POST['logo'])) : '';
		}
		$compress_html = isset($_POST['compress_html']) ? d(trim($_POST['compress_html'])) : '';
		$qqhm = isset($_POST['qqhm']) ? d(trim($_POST['qqhm'])) : '';
		$links = isset($_POST['links']) ? d(trim($_POST['links'])) : '';
		$cms_id = isset($_POST['cms_id']) ? d(trim($_POST['cms_id'])) : '';				
		$menu_more = isset($_POST['menu_more']) ? d(trim($_POST['menu_more'])) : '';
		$menu_html = isset($_POST['menu_html']) ? d(trim($_POST['menu_html'])) : '';
		$tougao = isset($_POST['tougao']) ? d(trim($_POST['tougao'])) : '';
		$hezuo = isset($_POST['hezuo']) ? d(trim($_POST['hezuo'])) : '';
		$add_gg = isset($_POST['add_gg']) ? d(trim($_POST['add_gg'])) : '';
		$add_url1 = isset($_POST['add_url1']) ? d(trim($_POST['add_url1'])) : '';
		$add_tu1 = isset($_POST['add_tu1']) ? d(trim($_POST['add_tu1'])) : '';
		$side_title = $_POST['side_title'];
		$side_url = $_POST['side_url'];
		
		 $cachedata = "<?php
	\$logo = '".$logo."';
	\$links = '".$links."';
	\$compress_html = '".$compress_html."';
	\$qqhm = '".$qqhm."';
	\$cms_id = '".$cms_id."';		
	\$menu_more = '".$menu_more."';
	\$menu_html = '".$menu_html."';
	\$tougao = '".$tougao."';
	\$hezuo = '".$hezuo."';
	\$add_gg = '".$add_gg."';
	\$add_url1 = '".$add_url1."';
	\$add_tu1 = '".$add_tu1."';
	\$side_title = '".serialize($side_title)."';
	\$side_url = '".serialize($side_url)."';
	
?>";
		$cachefile = EMLOG_ROOT.'/content/templates/meta/inc/config.php';
		@ $fp = fopen($cachefile, 'wb') OR emMsg('读取缓存失败。如果您使用的是Unix/Linux主机，请修改缓存目录 (content/cache) 下所有文件的权限为777。如果您使用的是Windows主机，请联系管理员，将该目录下所有文件设为可写');
		@ $fw =	fwrite($fp,$cachedata) OR emMsg('写入缓存失败，缓存目录 (content/cache) 不可写');
		fclose($fp);
		emMsg("修改配置成功！",BLOG_URL.'?setting');
		}
}
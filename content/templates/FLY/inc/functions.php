<?php
/*
 * @des 主题控制中心
 * FLY.theme by Finally
 */
if(!defined('EMLOG_ROOT')) {exit('FLY Functions Requrire Emlog!');}
function d($str){
	$str = str_replace("'","\'",$str );
	return $str;
}
function plugin_setting(){
	$do = isset($_GET['do']) ? $_GET['do'] : '';
	if($do == 'save'&& ROLE == ROLE_ADMIN) {
		if(empty($_GET)){
			$json = array(
				'code' => '201',
				'info' => '修改失败'
			);
			print json_encode($json);
			exit();
		}
		$config_data = $_POST["config"];
		$config_data['img_id'] = implode(",",$_POST["img_id"]);
		$config_data['theme_id'] = implode(",",$_POST["theme_id"]);
		//处理上传的图片
		if ($_POST["logo"]) {
			$data = explode(",",$_POST["logo"]);
			$dataurl = EMLOG_ROOT.'/content/templates/FLY/img/logo.png';
			$info = file_put_contents($dataurl, base64_decode($data[1]));
		}
		if ($_POST["bgimg"]) {
			$data = explode(",",$_POST["bgimg"]);
			$dataurl = EMLOG_ROOT.'/content/templates/FLY/img/bg.png';
			$info = file_put_contents($dataurl, base64_decode($data[1]));
		}
		if ($_POST["alzf"]) {
			$data = explode(",",$_POST["alzf"]);
			$dataurl = EMLOG_ROOT.'/content/templates/FLY/img/alzf.png';
			$info = file_put_contents($dataurl, base64_decode($data[1]));
		}
		if ($_POST["wxzf"]) {
			$data = explode(",",$_POST["wxzf"]);
			$dataurl = EMLOG_ROOT.'/content/templates/FLY/img/wxzf.png';
			$info = file_put_contents($dataurl, base64_decode($data[1]));
		}
		if ($_POST["txzf"]) {
			$data = explode(",",$_POST["txzf"]);
			$dataurl = EMLOG_ROOT.'/content/templates/FLY/img/txzf.png';
			$info = file_put_contents($dataurl, base64_decode($data[1]));
		}
		$config_data = serialize($config_data);
		$cachedata = '<?php
			$Tconfig = \''.$config_data.'\';
		?>';
		$cachefile = EMLOG_ROOT.'/content/templates/FLY/inc/config.php';
		@ $fp = fopen($cachefile, 'wb') OR emMsg('读取缓存失败。如果您使用的是Unix/Linux主机，请修改缓存目录 (content/templates/FLY) 下所有文件的权限为777。如果您使用的是Windows主机，请联系管理员，将该目录下所有文件设为可写');
		@ $fw =	fwrite($fp,$cachedata) OR emMsg('写入缓存失败，缓存目录 (content/templates/FLY) 不可写');
		fclose($fp);
		$json = array(
			'code' => '200',
			'info' => '修改成功'
		);
		print json_encode($json);
		exit();
	}
}
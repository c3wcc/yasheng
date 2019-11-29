<?php
/*
 * @des 主题控制中心
 * meta.theme by meta
 */
if(!defined('EMLOG_ROOT')) {exit('meta Functions Requrire Emlog!');}
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
		$config_data = serialize($config_data);
		$cachedata = '<?php
			$Tconfig = \''.$config_data.'\';
		?>';
		$cachefile = EMLOG_ROOT.'/content/templates/meta/inc/config.php';
		@ $fp = fopen($cachefile, 'wb') OR emMsg('读取缓存失败。如果您使用的是Unix/Linux主机，请修改缓存目录 (content/templates/meta) 下所有文件的权限为777。如果您使用的是Windows主机，请联系管理员，将该目录下所有文件设为可写');
		@ $fw =	fwrite($fp,$cachedata) OR emMsg('写入缓存失败，缓存目录 (content/templates/meta) 不可写');
		fclose($fp);
		$json = array(
			'code' => '200',
			'info' => '修改成功'
		);
		print json_encode($json);
		exit();
	}
}

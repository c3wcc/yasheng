<?php
header("Content-Type: text/html; charset=utf8");
!defined('EMLOG_ROOT') && exit('access deined!');
function plugin_setting_view(){
require_once 'MyhkPlayer_config.php';
?>
	<link href="/content/plugins/MyhkPlayer/style/style.css" type="text/css" rel="stylesheet" />
	<div class="com-hd">
		<b><img src="/content/plugins/MyhkPlayer/style/logo.png" align="middle" style="margin-top:-10px"/> <a href="https://player.limh.me" target="_blank">明月浩空音乐播放器</a>V.20190708</b>
		<?php
		if(isset($_GET['setting'])){
			echo "<span class='actived'>设置保存成功!</span>";
		}
		?>
	</div>
	<form action="plugin.php?plugin=MyhkPlayer&action=setting" method="post">
		<table class="tb-set">
			<tr>
				<td align="right"><b>线路切换：</b><br />(当播放器CDN访问异常时请切换，一般主站即可)</td>
				<td><span class="sel"><select name="xl"><option value="player" <?php if($config["xl"]=="player") echo "selected"; ?>>主站</option><option value="music" <?php if($config["xl"]=="music") echo "selected"; ?>>一线</option><option value="home" <?php if($config["xl"]=="home") echo "selected"; ?>>二线</option></select></span></td>
			</tr>
			<tr>
				<td align="right"><b>加载jquery：</b><br />(没有jquery库时请打开，JS冲突请关闭)</td>
				<td><span class="sel"><select name="jq"><option value="open" <?php if($config["jq"]=="open") echo "selected"; ?>>开启</option><option value="close" <?php if($config["jq"]=="close") echo "selected"; ?>>关闭</option></select></span></td>
			</tr>
			<tr>
				<td align="right"><b>移动端加载：</b><br />(开启后将在手机，iPad等移动设备加载播放器)</td>
				<td><span class="sel"><select name="mb"><option value="open" <?php if($config["mb"]=="open") echo "selected"; ?>>开启</option><option value="close" <?php if($config["mb"]=="close") echo "selected"; ?>>关闭</option></select></span></td>
			</tr>
			<tr>
				<td align="right"><b>播放器ID：</b><br />(填写<b>播放器控制面板</b>创建的播放器ID)</td>
				<td><input type="text" class="txt" name="id" value="<?php echo $config["id"]; ?>" /></td>
			</tr>
			<tr>
				<td align="right"><b>后台地址：</b><br />(免费注册创建播放器后台管理地址)</td>
				<td><b><a href="https://player.limh.me" target="_blank">https://player.limh.me</b></a></td>
			</tr>
			<tr>
				<td align="right"></td>
				<td><input type="submit" name="submit" value="保存设置" /></td>
			</tr>
		</table>
	</form>
	<?php
}
function plugin_setting(){
	require_once 'MyhkPlayer_config.php';
	$xl = $_POST["xl"]==""?"player":$_POST["xl"];
	$jq = $_POST["jq"]==""?"close":$_POST["jq"];
	$mb = $_POST["mb"]==""?"open":$_POST["mb"];
	$id = $_POST["id"]==""?"免费注册创建播放器后获取ID":$_POST["id"];
	$newConfig = '<?php
$config = array(
	"xl" => "'.$xl.'",
	"jq" => "'.$jq.'",
	"mb" => "'.$mb.'",
	"id" => "'.str_replace(array("\r\n", "\r", " ", "\n"), "", $id).'"
);';
	$file = EMLOG_ROOT.'/content/plugins/MyhkPlayer/MyhkPlayer_config.php';
	@ $fp = fopen($file, 'wb') OR emMsg('读取文件失败，如果您使用的是Unix/Linux主机，请修改文件/content/plugins/MyhkPlayer/MyhkPlayer_config.php的权限为777。如果您使用的是Windows主机，请联系管理员，将该文件设为everyone可写');
	@ $fw =	fwrite($fp,$newConfig) OR emMsg('写入文件失败，如果您使用的是Unix/Linux主机，请修改文件/content/plugins/MyhkPlayer/MyhkPlayer_config.php的权限为777。如果您使用的是Windows主机，请联系管理员，将该文件设为everyone可写');
	fclose($fp);
	return TRUE;
}
?>
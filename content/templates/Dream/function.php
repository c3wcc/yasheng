<?php
/**
 * @version  4.4
 * @author   1梦
 * @description     自用函数
 * @date     2016.9.1
 */
require_once View::getView('config');
?>
<?php
/*
 * 文章回复可见
 *
 */
 function reply_view($content,$logid){
	 if(!strstr($content,"hide")){
		 return $content;
	 }
	 if(ROLE == ROLE_ADMIN){
		 $content = preg_replace("/\[hide\](.*)\[\/hide\]/Uims", '<div class="hideConBox">\1</div>', $content);
		 return $content;
	 }
   if(ROLE != ROLE_VISITOR){
	   //是会员的时候回复可见
	   global $userData;
	   $user_mail = $userData['email'];
	   //$logid = $logData['logid'];
	   $DB = MySql::getInstance();
	   $sql = 	"SELECT * FROM ".DB_PREFIX."comment WHERE gid='$logid' and mail='$user_mail'";
	   $res = $DB->query($sql);
	   $num = $DB->num_rows($res);
	   if($num>0){
		   //已经回复过了
		   $share_view = preg_replace("/\[hide\](.*)\[\/hide\]/Uims", '<div class="hideConBox">\1</div>', $content);
	   }else{
		   //未回复
		   $share_view = preg_replace("/\[hide\](.*)\[\/hide\]/Uims", '', $content);
	   }
	   
	   return $share_view;
   }else{
	   //是游客的时候回复可见
	   $share_view = preg_replace("/\[hide\](.*)\[\/hide\]/Uims", '', $content);
	   return $share_view;
   }
 }
?>

<?php 
//获取文章图片数量
function pic($content){
    if(preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $content, $img) && !empty($img[1])){
        $imgNum = count($img[1]);
    }else{
        $imgNum = "0";
    }
    return $imgNum;
}
?>

<?php // sotr 分类文章ID
   		 // num 文章数量
   		 //返回一个数组接收
function sheli_tw($sort, $num){
	$db = MySql::getInstance();
	$sql = "SELECT gid,title,date,content,sortid,views,comnum FROM ".DB_PREFIX."blog WHERE sortid=".$sort." AND hide='n' ORDER BY `date` DESC LIMIT 0,$num";
	$go = $db->query($sql);
	$array_return = array();
	while($row = $db->fetch_array($go)){
		$row["url"] = Url::log($row['gid']);
		$row["date"] = sydate($row["date"],true);
		$array_return[] = $row;
	}
	return $array_return;
}
?>
<?php
/**
 * @version  1.0
 * @author   1梦
 * @description     获取分类标题from sotrid(sid)
 */
 function getsotrnamefromsid($sid){
 	global $CACHE;
	$sort_cache = $CACHE->readCache('sort');
	foreach ($sort_cache as $key => $value) {
		# code...
		if($value["sid"]==$sid){
			return $value["sortname"];
			break;
		}
	}
	return "未分类";
 }
 ?>


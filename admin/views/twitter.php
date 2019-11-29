<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<link href="./views/app/css/twitter.css" rel="stylesheet"/>
<div class="content_tab">
<div class="tab_left">
<a class="waves-effect waves-light" href="javascript:;"><i class="zmdi zmdi-chevron-left"></i></a>
</div>
<div class="tab_right">
<a class="waves-effect waves-light" href="javascript:;"><i class="zmdi zmdi-chevron-right"></i></a>
</div>
<ul id="tabs" class="tabs">
<li id="tab_home">
<a href="./" class="waves-effect waves-light">首页</a>
</li>
<li id="tab_tw" class="cur">
<a href="twitter.php" class="waves-effect waves-light"> 每日一语 </a>
</li>
</ul>
</div>
<div class="content_main">
<div id="iframe_home" class="iframe cur">		
<?php if(isset($_GET['active_t'])):?> 
<div class="actived alert alert-success alert-dismissable">发布成功</div><?php endif;?>
<?php if(isset($_GET['active_del'])):?> <div class="actived alert alert-success alert-dismissable">微语删除成功</div> <?php endif;?>
<?php if(isset($_GET['error_a'])):?> <div class="actived alert alert-danger alert-dismissable">微语内容不能为空</div><?php endif;?>
<div class="heading-bg ">
 <form method="post" action="twitter.php?action=post">
 <section class="panel profile-info">
 <textarea class="form-control input-lg p-text-area" rows="2" id ="comment" name="t" placeholder="用微语记录生活 ……"></textarea>
  <div class="msgc">你还可以输入140字</div>
 <footer class="panel-footer">
 <button class=" btn btn-primary pull-right"   type="submit"  onclick="return checkt();">发布</button>
  <input type="hidden" name="img" id="imgPath" />
  <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
<ul class="navs">
<li>
 <a id="face"> <i class="zmdi zmdi-mood"></i> </a>
 <div id="faceWraps"></div>
</li>
<li>
 <a id="uploadfile"></a>
</li>
 <div id="img_name" class="twImg" style="display:none;">
<a id="img_name_a" class="imgicon">{图片名称}</a>
        <a id="img-cancel"> [取消]</a>
    </div>
</ul>
</footer>
</section>           
<?php doAction('twitter_form'); ?>       
</form>
</div>
<div class="timeline-messages">
<?php
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? './views/app/img/avatar.jpg' : '../' . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="'.$checkpic.'" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;width:50%;height:50%" src="'.BLOG_URL.$val['img'].'"/></a>';
  ?>
 <div class="msg-time-chat">
  <a href="javascript: em_confirm(<?php echo $tid;?>, 'tw', '<?php echo LoginAuth::genToken(); ?>');"  class="message-img"><img class="avatar" src="<?php echo $avatar; ?>" alt=""></a>
               <div class="message-body msg-in">
                          <span class="arrow"></span>
                                          <div class="text">
                                              <p class="attribution"><a href="#"><?php echo $author; ?></a><?php echo $attime ?> <?php echo $val['date'];?></p>
                                              <p><em></em><?php echo $val['t'];?> <br/><?php echo $img;?></p>
                                          </div>
                                      </div>
                                  </div>
    <?php endforeach;?>
       </div>
<div class="row">
<div class="col-sm-12">
<div class="form-group text-center">
<?php if(!empty($pageurl)){ ?>
 <div id="pagenav">
 <?php echo $pageurl; ?>
</div>
<?php }?>
<div style="text-align:center;padding-top:10px">
(有<?php echo $twnum; ?>条微语)
 </div>
</div>                 
</div>
</div>
</div>
<script type="text/javascript">
$(function(){
	var up = $('#uploadfile').Huploadify({
		auto:true, 
              fileTypeExts: '*.jpg;*.png;*.gif;*.jpeg',
              multi:false, 
              formData:{key: '<?php echo AUTH_COOKIE_NAME;?>',key2:'<?php echo $_COOKIE[AUTH_COOKIE_NAME];?>'}, 
              fileSizeLimit: 20971520, 
		showUploadedPercent:false,
		showUploadedSize:false,
		removeTimeout:9999999,
		buttonText:' <i class="zmdi zmdi-camera-add"></i>',
		uploader:'attachment.php?action=upload_tw_img&token=<?php echo LoginAuth::genToken(); ?>',		
		onUploadComplete:function(file){
		$("#imgPath").val('<?php echo $uppath ?>'+file.name);
		$("#uploadfile").hide();
		$("#img_name").show();
		$("#img_name_a").text(file.name);
		},
       });
	$('#img-cancel').click(function(){
	up.cancel('*');
	$("#imgPath").val("");
	$("#uploadfile").show();
	$("#img_name").hide();
	$("#img_name_a").text("{图片名称}");
	$("#img_pop").empty();
	});
});
</script>
<script type="text/javascript" src="./views/app/js/face.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script type="text/javascript" src="./views/app/js/upload.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script>
setTimeout(hideActived,2600);
$(document).ready(function(){
$("#comment").keyup(function(){
       var t=$(this).val();
       var n = 140 - t.length;
       if (n>=0){
         $(".msgc").html("你还可以输入"+n+"字");
       }else{
         $(".msgc").html("<span style=\"color:#FF0000\">已超出"+Math.abs(n)+"字</span>");
         }
});
$("#comment").focus();
function checkt(){
    var t=$("#comment").val();
    if (t.length > 140){return false;}
}
function delreply(rid,tid){
    if(confirm('你确定要删除该条回复吗？')){
        $.get("twitter.php?action=delreply&rid="+rid+"&tid="+tid+"&stamp="+timestamp(), function(data){
            var tid = Number(data);
            var rnum = Number($("#"+tid+" span").text());
            $("#"+tid+" span").text(rnum-1);
            if ($("#reply_"+rid+" span a").text() == '审核'){
                var rnum = Number($("#"+tid+" small").text());
                if(rnum == 1){$("#"+tid+" small").text('');}else{$("#"+tid+" small").text(rnum-1);}
            }
            $("#reply_"+rid).hide("slow");
        })}else {return;}
}
});
$("#menu_tw").addClass('active');
</script>


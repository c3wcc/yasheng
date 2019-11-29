<?php if (!defined('EMLOG_ROOT')) {exit('error!');}?>
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
<li id="tab_page" class="cur">
<a href="page.php" class="waves-effect waves-light"> <?php echo $containertitle; ?> </a>
</li>
</ul>
</div>
<div class="content_main">
<div id="iframe_home" class="iframe cur">
<div class="row">
<form action="page.php?action=save" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
<!--文章内容-->
<div class="col-lg-12">
<span id="msg_2"></span>
<div id="msg"></div>
</div>
<div class="col-lg-8">
<div id="post" class="form-group">
 <div>
  <input type="text" name="title" id="title" value="<?php echo $title; ?>" class="form-control" placeholder="页面标题" />
  </div>
 <div id="post_bar">
 <div id="FrameUpload" style="display: none;">
 <iframe width="100%" height="100%" frameborder="0" src="<?php echo $att_frame_url;?>"></iframe>
 </div>
 <div class="show_advset" id="created">
 <span class="uploads btn btn-default" onclick="displayToggle('FrameUpload', 0);autosave(4);" class="show_advset">上传插入</span>
 <?php doAction('adm_writelog_head'); ?>
 <span id="asmsg"></span>
 <input type="hidden" name="as_logid" id="as_logid" value="<?php echo $pageId; ?>">
                </div>
            </div>
            <div>
 <textarea id="editor_content" name="content" style="width:100%; height:560px;" class="form-control" ><?php echo $content; ?></textarea>
            </div>
        </div>
    <div class=line></div>
</div>
<!--文章侧边栏-->
<div class="col-lg-4 container-side">
    <div class="panel panel-default">
        <div class="panel-heading">设置项</div>
        <div class="panel-body">
            <div class="form-group">
                <label>链接别名：</label>
                <input name="alias" id="alias" class="form-control" value="<?php echo $alias;?>" />
            </div>
            <div class="form-group">
                <label>页面模板：</label>
      <select name="template" id="template" class="form-control" >
      <option value="">不选择</option>
 <?php
     $nonce_templet = Option::get('nonce_templet');
     $dir= TPLS_PATH.$nonce_templet.'/page/';
    foreach ($tpls as $key => $value) :
    if(is_dir($dir)&&file_exists($dir.$value['template'].'.php')){
     $zfile="page/";
     }else{
     $zfile='';
     };
    ?>
<option value="<?php echo $zfile.$value['template']; ?>"<?php if($template == $zfile.$value['template']): ?> selected="true"<?php endif; ?>>
      <?php echo $value['Des']; ?>
     </option>
    <?php endforeach;?>
     </select>
            </div>
            <div class="form-group">
            <input type="checkbox" value="y" name="allow_remark" id="allow_remark" <?php echo $is_allow_remark; ?> />
            <label for="allow_remark">允许评论</label>
            </div>
        </div>
    </div>
    <div id="post_button">
        <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
        <input type="hidden" name="ishide" id="ishide" value="<?php echo $hide; ?>" />
        <input type="hidden" name="gid" value=<?php echo $pageId; ?> />
        <?php if ($pageId < 0):?>
        <input type="submit" value="发布页面" onclick="return checkform();" class="btn btn-primary" />
        <input type="button" name="savedf" id="savedf" value="保存" onclick="autosave(3);" class="btn btn-success" />
        <?php else:?>
        <input type="submit" value="保存并返回" onclick="return checkform();" class="btn btn-primary" />
        <input type="button" name="savedf" id="savedf" value="保存" onclick="autosave(3);" class="btn btn-success" />
        <?php endif;?>
    </div>
</div>
</form>
</div>
</div>
</div>
 <script src="./tinymce/tinymce/tinymce.min.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
<script src="./tinymce/tinymce.config.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
<link href="./tinymce/tinymce/skins/wordpress/dashicons.min.css?v=<?php echo Option::EMLOG_VERSION; ?>" rel="stylesheet" type="text/css" />
<link href="./tinymce/tinymce/skins/wordpress/editor.min.css?v=<?php echo Option::EMLOG_VERSION; ?>" rel="stylesheet" type="text/css" />
<script>
checkalias();
$("#alias").keyup(function(){checkalias();});
$("#title").focus(function(){$("#title_label").hide();});
$("#title").blur(function(){if($("#title").val() == '') {$("#title_label").show();}});
if ($("#title").val() != '')$("#title_label").hide();
$("#menu_page").addClass('active');
</script>

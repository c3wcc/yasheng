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
<li id="tab_log" class="cur">
<a href="write_log.php" class="waves-effect waves-light"> <?php echo $containertitle; ?> </a>
</li>
</ul>
</div>
<div class="content_main">
<div id="iframe_home" class="iframe cur">
<div class="row">
<form action="save_log.php?action=add" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
<!--文章内容-->
<div class="col-lg-12">
<span id="msg_2"></span>
<div id="msg"></div>
</div>
<div class="col-lg-8">
<div id="post" class="form-group">
<input type="text" name="title" id="title" value="<?php echo $title; ?>" class="form-control" placeholder="文章标题" />
<div id="post_bar">
  <div id="FrameUpload" style="display: none;">
  <iframe width="100%" height="auto" frameborder="0" src="<?php echo $att_frame_url;?>"></iframe>
  </div>
<div class="show_advset" id="created">
<span class="uploads btn btn-default" onclick="displayToggle('FrameUpload', 0);autosave(1);">上传插入</span>
<?php doAction('adm_writelog_head'); ?>
 <span id="asmsg"></span>
 <input type="hidden" name="as_logid" id="as_logid" value="<?php echo $logid; ?>">
 </div>
</div>
 <div>
  <div id="divContent">
 <textarea id="editor_content" name="content" style="width:100%; height:560px;" class="form-control" ><?php echo $content; ?></textarea>
  <input name="image" type="file" id="upload" class="hidden" onchange="">
  </div>  
  </div>
  <div class="show_advset list_footer btn btn-default" onclick="displayToggle('advset', 1);">高级选项</div>
  <?php doAction('adm_writelog_bottom'); ?>
  <div id="advset">
  <br>
<div class="form-group">文章摘要：</div>
 <div><textarea id="editor_excerpt" name="excerpt" style="width:100%; height:200px;"><?php echo $excerpt; ?></textarea></div>
            </div>
</div>
</div>
<!--文章侧边栏-->
<div class="col-lg-4 container-side">
    <div class="panel panel-default">
        <div class="panel-heading">设置项</div>
        <div class="panel-body">        
         <div class="form-group">
  <label>文章封面</label>
  <input name="thumbs" id="thumbs" class="form-control" placeholder="从附件库中设置或者自定义" value="<?php echo $thumbs;?>" />
  </div>
<div class="form-group">
 <label>分类选择</label>
<select name="sort" id="sort" class="form-control">
                    <option value="-1">还未设置...</option>
                    <?php
                    foreach ($sorts as $key => $value):
                        if ($value['pid'] != 0) {
                            continue;
                        }
                        $flg = $value['sid'] == $sortid ? 'selected' : '';
                        ?>
                        <option value="<?php echo $value['sid']; ?>" <?php echo $flg; ?>><?php echo $value['sortname']; ?></option>
                        <?php
                        $children = $value['children'];
                        foreach ($children as $key):
                            $value = $sorts[$key];
                            $flg = $value['sid'] == $sortid ? 'selected' : '';
                            ?>
                            <option value="<?php echo $value['sid']; ?>" <?php echo $flg; ?>>&nbsp; &nbsp; &nbsp; <?php echo $value['sortname']; ?></option>
                            <?php
                        endforeach;
                    endforeach;
                    ?>
            </select>
            </div>
 <div class="form-group">
            <label>标签：( <a href="javascript:displayToggle('tagbox', 0);">已有标签+</a> )</label>
            <input name="tag" id="tag" class="form-control" value="<?php echo $tagStr; ?>" placeholder="文章标签，使用逗号分隔" />
<div id="tagbox" style="padding-top:5px;display: none;">
<div class="alert alert-warning">
                <?php
                if ($tags) {
                    foreach ($tags as $val) {
                        echo "<span style=\"margin:0px 5px 0px 5px\"> <a href=\"javascript: insertTag('{$val['tagname']}','tag');\">{$val['tagname']}</a></span> ";
                    }
                } else {
                    echo '还没有设置过标签！';
                }
                ?>
              </div>
            </div>
 </div>
<div class="form-group">
<label>版权设置</label>
 <select name="copy" id="copy" class="form-control">
<option value="-1" <?php echo  $copy =='-1' ? 'selected' : '';?>>请选择...</option><option value="1" <?php echo  $copy =='1' ?  'selected' : '';?>>原创</option>
<option value="2" <?php echo  $copy =='2' ? 'selected' : '';?>>转载</option>
</select>
 </div>
<div class="form-group">
  <label>转载地址</label>
  <input name="copyurl" id="copyurl" class="form-control" placeholder="填入原文地址,原创忽虑" value="<?php echo $copyurl;?>" />
  </div>
            <div class="form-group">
            <label>发布时间</label>
            <input maxlength="200" name="postdate" id="postdate" value="<?php echo $postDate; ?>" class="form-control" />
            </div>
       <div class="form-group">
                <label>链接别名</label>
                <input name="alias" id="alias" class="form-control" value="<?php echo $alias;?>" />
            </div>
            
            <div class="form-group">
                <label>访问密码</label>
                <input type="text" name="password" id="password" class="form-control" value="<?php echo $password; ?>" />
            </div>
            
            <div class="form-group">
            <input type="checkbox" value="y" name="top" id="top" <?php echo $is_top; ?> />
            <label for="top">首页置顶</label>
            <input type="checkbox" value="y" name="sortop" id="sortop" <?php echo $is_sortop; ?> />
            <label for="sortop">分类置顶</label>
            <input type="checkbox" value="y" name="allow_remark" id="allow_remark" checked="checked" <?php echo $is_allow_remark; ?> />
            <label for="allow_remark">允许评论</label>
            </div>
        </div>
    </div>
<div id="post_button">
        <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
        <input type="hidden" name="ishide" id="ishide" value="<?php echo $hide; ?>" />
        <input type="hidden" name="gid" value=<?php echo $logid; ?> />
        <input type="hidden" name="author" id="author" value=<?php echo $author; ?> />

        <?php if ($logid < 0):?>
        <input type="submit" value="发布文章" onclick="return checkform();" class="btn btn-primary" />
        <input type="button" name="savedf" id="savedf" value="保存草稿" onclick="autosave(2);" class="btn btn-success" />
        <?php else:?>
        <input type="submit" value="保存并返回" onclick="return checkform();" class="btn btn-primary" />
        <input type="button" name="savedf" id="savedf" value="保存" onclick="autosave(2);" class="btn btn-success" />
        <?php if ($isdraft) :?>
        <input type="submit" name="pubdf" id="pubdf" value="发布" onclick="return checkform();" class="btn btn-success" />
        <?php endif;?>
        <?php endif;?>
    </div>
</div>
</div>
</form>
</div>
</div>
 <script src="./tinymce/tinymce/tinymce.min.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
<script src="./tinymce/tinymce.config.js?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/javascript"></script>
<link href="./tinymce/tinymce/skins/wordpress/dashicons.min.css?v=<?php echo Option::EMLOG_VERSION; ?>" rel="stylesheet" type="text/css" />
<link href="./tinymce/tinymce/skins/wordpress/editor.min.css?v=<?php echo Option::EMLOG_VERSION; ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript"> 
function GetData(data) { 
       document.getElementById("thumbs").value=data; 
} 
$("#advset").css('display', $.cookie('em_advset') ? $.cookie('em_advset') : '');
$("#alias").keyup(function () {
        checkalias();
    });
   setTimeout("autosave(0)", 160000);
    $("#menu_wt").addClass('active');
</script>
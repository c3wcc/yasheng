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
<li id="tab_con" class="cur">
<a href="configure.php" class="waves-effect waves-light"> 系统设置</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
  <div class="col-lg-12">
        <?php if (isset($_GET['activated'])): ?><div class="alert alert-success">设置保存成功</div><?php endif; ?>
         <?php if (isset($_GET['rested'])): ?><div class="alert alert-success">重置成功</div><?php endif; ?>
         </div>
         </div>
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-palette"></i> 基本资料
        </div>
<div class="panel-body">
    <form action="configure.php?action=mod_config" method="post" name="input" id="input">
        <div class="form-group">
            <label>站点标题：</label><input class="form-control" value="<?php echo $blogname; ?>" name="blogname" />
        </div>
        <div class="form-group">
            <label>站点描述：</label><textarea name="bloginfo" cols="" rows="3" class="form-control"><?php echo $bloginfo; ?></textarea>
        </div>
        <div class="form-group">
            <label>站点地址：</label><input class="form-control" value="<?php echo $blogurl; ?>" name="blogurl" />
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="y" name="detect_url" id="detect_url" <?php echo $conf_detect_url; ?> />自动检测站点地址 (可能和部分CDN解决方案不兼容)
                </label>
            </div>
        </div>
        </div>
        </div>
      <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-receipt"></i> 基本设置
        </div>
<div class="panel-body">        
<div class="form-group">
            <div class="checkbox">
                <label>
<input type="checkbox" value="y" name="isgzipenable" id="isgzipenable" <?php echo $conf_isgzipenable; ?> />启用网站Gzip压缩
                </label>
           </div>
<div class="form-group form-inline">
            每页显示<input style="width:50px;" class="form-control" value="<?php echo $index_lognum; ?>" name="index_lognum" />篇文章
        </div>
        <div class="form-group form-inline">
            <label>你所在时区：</label>
            <select name="timezone" style="width:320px;" class="form-control">
                <?php
                foreach ($tzlist as $key => $value):
                    $ex = $key == $timezone ? "selected=\"selected\"" : '';
                    ?>
                    <option value="<?php echo $key; ?>" <?php echo $ex; ?>><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="y" name="login_code" id="login_code" <?php echo $conf_login_code; ?> />登录验证码
                </label>
            </div>
            <div class="checkbox form-inline">
                <label><input type="checkbox" value="y" name="isexcerpt" id="isexcerpt" <?php echo $conf_isexcerpt; ?> />自动摘要</label>，
                截取文章的前<input type="text" name="excerpt_subnum" value="<?php echo Option::get('excerpt_subnum'); ?>" class="form-control" style="width:60px;" />个字作为摘要
            </div>          
        </div>
        <div class="form-group form-inline">
            RSS输出 <input maxlength="5" style="width:50px;" value="<?php echo $rss_output_num; ?>" class="form-control" name="rss_output_num" /> 篇文章（0为关闭），且输出
            <select name="rss_output_fulltext" class="form-control">
                <option value="y" <?php echo $ex1; ?>>全文</option>
                <option value="n" <?php echo $ex2; ?>>摘要</option>
            </select>
        </div>
        <div class="form-group">
            <div class="checkbox form-inline">
                <label> <input type="checkbox" style="vertical-align:middle;" value="y" name="istwitter" id="istwitter" <?php echo $conf_istwitter; ?> />开启微语，</label>
								每页显示<input type="text" name="index_twnum" maxlength="3" value="<?php echo Option::get('index_twnum'); ?>" class="form-control" style="width:50px" />条微语
							</div>
        </div>
        <div class="form-group">
            <div class="checkbox form-inline">
                <label><input type="checkbox" value="y" name="iscomment" id="iscomment" <?php echo $conf_iscomment; ?> />开启评论</label>，发表评论间隔<input maxlength="5" style="width:50px;" class="form-control" value="<?php echo $comment_interval; ?>" name=comment_interval />秒
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="y" name="ischkcomment" id="ischkcomment" <?php echo $conf_ischkcomment; ?> />评论审核
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="y" name="comment_code" id="comment_code" <?php echo $conf_comment_code; ?> />评论验证码
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="y" name="isgravatar" id="isgravatar" <?php echo $conf_isgravatar; ?> />评论人头像
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="y" name="comment_needchinese" id="comment_needchinese" <?php echo $conf_comment_needchinese; ?> />评论内容必须包含中文
                </label>
            </div>
            <div class="checkbox form-inline">
                <label><input type="checkbox" value="y" name="comment_paging" id="comment_paging" <?php echo $conf_comment_paging; ?> />评论分页，</label>
                每页显示<input maxlength="5" style="width:50px;" class="form-control" value="<?php echo $comment_pnum; ?>" name="comment_pnum" />条评论，
                <select name="comment_order" class="form-control"><option value="newer" <?php echo $ex3; ?>>较新的</option><option value="older" <?php echo $ex4; ?>>较旧的</option></select>排在前面
            </div>
        </div>
        </div>
       </div> 
        </div>
       <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-upload"></i> 附件设置
        </div>
<div class="panel-body">              
        <div class="form-group form-inline">
            <input maxlength="10" style="width:80px;" class="form-control" value="<?php echo $att_maxsize; ?>" name="att_maxsize" /> KB，附件上传最大限制。
        </div>
        <div class="form-group form-inline">
            <input maxlength="200" class="form-control" value="<?php echo $att_type; ?>" name="att_type" /> 允许上传的附件类型（多个用半角逗号分隔）
        </div>
        <div class="form-group form-inline">
            <input type="checkbox" value="y" name="isthumbnail" id="isthumbnail" <?php echo $conf_isthumbnail; ?> />上传图片生成缩略图，最大尺寸：<input maxlength="5" style="width:60px;" class="form-control" value="<?php echo $att_imgmaxw; ?>" name="att_imgmaxw" /> x <input maxlength="5" style="width:60px;" class="form-control" value="<?php echo $att_imgmaxh; ?>" name="att_imgmaxh" />（单位：像素）
        </div>
        </div>
</div>
       <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-alert-circle"></i> 底部设置
        </div>
<div class="panel-body">                 
        <div class="form-group">
            <label> ICP备案号：</label>
            <input maxlength="200" class="form-control" value="<?php echo $icp; ?>" name="icp" />
        </div>
        <div class="form-group">
            <label>首页底部信息(支持html，可用于添加流量统计代码)：</label>
            <textarea name="footer_info" cols="" rows="6" class="form-control"><?php echo $footer_info; ?></textarea>
        </div>
        <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
        <input type="submit" value="保存设置" class="btn btn-primary" />      
    </form>
</div>
</div>
</div>
<script>
    setTimeout(hideActived, 2600);
    $("#menu_setting").addClass('active');
</script>

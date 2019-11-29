<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
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
<li id="tab_com" class="cur">
<a href="comment.php" class="waves-effect waves-light">编辑评论</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-edit"></i> 编辑评论
        </div>
<div class="panel-body">
<form action="comment.php?action=doedit" method="post">
<div class="form-group">
<label> 评论人 </label>
<input type="text" value="<?php echo $poster; ?>" name="name" class="form-control" />
</div>
<div class="form-group">
<label> 电子邮件 </label>
<input type="text"  value="<?php echo $mail; ?>" name="mail" class="form-control" /> 
</div>
<div class="form-group">
<label> 主页 </label>
<input type="text"  value="<?php echo $url; ?>" name="url" class="form-control" /> 
</div>
<div class="form-group">
<label> 评论内容 </label>
<textarea name="comment" rows="8" cols="60" class="form-control"><?php echo $comment; ?></textarea>
</div>
<div class="form-group">
    <input type="hidden" value="<?php echo $cid; ?>" name="cid" />
    <input type="submit" value="保 存" class="btn btn-primary" />
    <input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();" /></div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
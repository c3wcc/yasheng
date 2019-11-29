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
<a href="comment.php" class="waves-effect waves-light">回复评论</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-edit"></i> 回复评论
        </div>
<div class="panel-body">
<form action="comment.php?action=doreply" method="post">
<div class="form-group form-inline">
<label> 评论人: </label>
<?php echo $poster; ?>
</div>
<div class="form-group form-inline">
<label> 时间: </label>
<?php echo $date; ?>
</div>
<div class="form-group">
<div class="alert alert-warning">
内容：
<?php echo $comment; ?>
</div>
</div>
<div class="form-group">
<textarea name="reply" rows="5" cols="60" class="form-control"></textarea>
</div>
<div class="form-group">
	<input type="hidden" value="<?php echo $commentId; ?>" name="cid" />
	<input type="hidden" value="<?php echo $gid; ?>" name="gid" />
	<input type="hidden" value="<?php echo $hide; ?>" name="hide" />
	<input type="submit" value="回复" class="btn btn-primary" />
	<?php if ($hide == 'y'): ?>
	    <input type="submit" value="回复并审核" name="pub_it" class="btn btn-primary" />
	<?php endif; ?>
	<input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();"/>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
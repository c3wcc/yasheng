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
<li id="tab_sort" class="cur">
<a href="sort.php" class="waves-effect waves-light"> 编辑分类 </a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
 <span id="alias_msg_hook"></span>
 <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-edit"></i> 编辑分类
        </div>
<div class="panel-body">
<form action="sort.php?action=update" method="post">
<div class="form-group">
 <label>名称</label>
 <input type="text" value="<?php echo $sortname; ?>" name="sortname" id="sortname"  class="form-control" />
</div>
<div class="form-group">
<label>别名</label>
<input type="text" value="<?php echo $alias; ?>" name="alias" id="alias" class="form-control" />
</div>
<div class="form-group">
<label>父分类</label>
<?php if (empty($sorts[$sid]['children'])): ?>
<select name="pid" id="pid" class="form-control">
<option value="0"<?php if($pid == 0):?> selected="selected"<?php endif; ?>>无
</option>
<?php
foreach($sorts as $key=>$value):
if ($key == $sid || $value['pid'] != 0) continue;
?>
<option value="<?php echo $key; ?>"<?php if($pid == $key):?> selected="selected"<?php endif; ?>><?php echo $value['sortname']; ?></option>
			<?php endforeach; ?>
		</select>
	<?php endif; ?>
	</div>
<div class="form-group">
<label>模板</label>
<input type="text" name="template" id="template" value="<?php echo $template; ?>"  class="form-control" />
            </div>	
<div class="form-group">
<label>描述</label>
<textarea name="description" type="text" class="textarea form-control"><?php echo $description; ?></textarea>
</div>

    <input type="hidden" value="<?php echo $sid; ?>" name="sid" />
    <input type="submit" value="保 存" class="btn btn-primary" id="save"  />
    <input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();" />
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<script>
$("#menu_sort").addClass('active');
$("#alias").keyup(function(){checksortalias();});
function issortalias(a){
    var reg1=/^[\w-]*$/;
    var reg2=/^[\d]+$/;
    if(!reg1.test(a)) {
        return 1;
    }else if(reg2.test(a)){
        return 2;
    }else if(a=='post' || a=='record' || a=='sort' || a=='tag' || a=='author' || a=='page'){
        return 3;
    } else {
        return 0;
    }
}
function checksortalias(){
    var a = $.trim($("#alias").val());
    if (1 == issortalias(a)){
        $("#save").attr("disabled", "disabled");
        $("#alias_msg_hook").html('<span id="input_error">别名错误，应由字母、数字、下划线、短横线组成</span>');
    }else if (2 == issortalias(a)){
        $("#save").attr("disabled", "disabled");
        $("#alias_msg_hook").html('<span id="input_error">别名错误，不能为纯数字</span>');
    }else if (3 == issortalias(a)){
        $("#save").attr("disabled", "disabled");
        $("#alias_msg_hook").html('<span id="input_error">别名错误，与系统链接冲突</span>');
    }else {
        $("#alias_msg_hook").html('');
        $("#msg").html('');
        $("#save").attr("disabled", false);
    }
}
</script>
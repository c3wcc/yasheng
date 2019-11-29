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
<li id="tab_link" class="cur">
<a href="link.php" class="waves-effect waves-light">编辑链接</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-edit"></i> 编辑链接
        </div>
<div class="panel-body">
<form action="link.php?action=update_link" method="post">
<div class="form-group">
<label>名称</label>
 <input type="text"  value="<?php echo $sitename; ?>"   name="sitename"   class="form-control">
</div>
<div class="form-group">
<label>地址</label>
<input type="text"  id="url" value="<?php echo $siteurl; ?>"   name="siteurl"   class="form-control">
</div>
<div class="form-group">
<label>图标</label>
 <input type="text"  id="pic" value="<?php echo $sitepic; ?>"   name="sitepic"   class="form-control">
 </div>
<div class="form-group"><label>分类</label>          
<select name="linksortid" id="linksortid" class="form-control">
<option value="-1">无分类</option>
 <?php foreach($sortlink as $key=>$value):?>
<option value="<?php echo $key; ?>"<?php if($linksortid == $key):?> selected="selected"<?php endif; ?>><?php echo $value['linksort_name']; ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="form-group">
<label>描述</label>
<textarea name="description" rows="3" class="form-control textarea" cols="42"><?php echo $description; ?></textarea>
</div>	
<div class="form-group">
<input type="hidden" value="<?php echo $linkId; ?>" name="linkid" />
<input type="submit" value="保存" class="btn btn-primary" onclick="check_url()" />
<input type="button" value="取消" class="btn btn-default" onclick="javascript: window.history.back();" />
</div>
</form>
</div>
</div>
</div>
</div>
<script>
function check_url(){  
    var elem = document.getElementById("#pic");  
    var input_value = elem.value;  
    input_value = input_value.toLowerCase();  
    var regExr = /^(http:|https:)\/\/.*$/m;  
    var result = regExr.test(input_value);  
    if (!result){  
        var new_value = "http://"+input_value;  
        elem.value=new_value;  
    }  
}  
$("#menu_link").addClass('active');
</script>
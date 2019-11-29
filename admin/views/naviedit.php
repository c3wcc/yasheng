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
<li id="tab_nav" class="cur">
<a href="navbar.php" class="waves-effect waves-light">编辑导航</a>
</li>
</ul>
</div>
<div class="content_main">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-edit"></i> 导航编辑
        </div>
<div class="panel-body">
<form action="navbar.php?action=update" method="post">
<div class="form-group">
<label> 导航名称 </label>
<input size="20" class="form-control" value="<?php echo $naviname; ?>" name="naviname" /> 
</div>
<div class="form-group">
<label> 导航地址 </label>
        <input size="50" class="form-control" value="<?php echo $url; ?>" name="url" <?php echo $conf_isdefault; ?> /> 
    </div>
    <div class="form-group">
    <div class="checkbox">
        <label><input type="checkbox" value="y" name="newtab" <?php echo $conf_newtab; ?> /> 在新窗口打开</label>
    </div>
    </div>
    <?php if ($type == Navi_Model::navitype_custom && $pid != 0): ?>
<div class="form-group">
<label> 父导航</label>
            <select name="pid" id="pid" class="form-control">
                <option value="0">无</option>
                <?php
                    foreach($navis as $key=>$value):
                        if($value['type'] != Navi_Model::navitype_custom || $value['pid'] != 0) {
                            continue;
                        }
                        $flg = $value['id'] == $pid ? 'selected' : '';
                ?>
                <option value="<?php echo $value['id']; ?>" <?php echo $flg;?>><?php echo $value['naviname']; ?></option>
                <?php endforeach; ?>
            </select>
    </div>
    <?php endif; ?>
    <div class="form-group">
    <input type="hidden" value="<?php echo $naviId; ?>" name="navid" />
    <input type="hidden" value="<?php echo $isdefault; ?>" name="isdefault" />
    <input type="submit" value="保 存" class="btn btn-primary" />
    <input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();" />
    </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
$("#menu_navi").addClass('active');
</script>


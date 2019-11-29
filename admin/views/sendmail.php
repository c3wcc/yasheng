<?php if (!defined('EMLOG_ROOT')) {exit('error!');}
?>
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
<a href="sendmail.php" class="waves-effect waves-light"> 邮件通知</a>
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
                  <?php if (isset($_GET['dell'])): ?><div class="alert alert-success">清空成功</div><?php endif; ?>
         </div>
         </div>
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-email"></i> 邮件通知
        </div>
<div class="panel-body">
    <form action="sendmail.php?action=set" method="post" name="input" id="input">
        <div class="form-group">
            <label> smtp服务器<sup> 如:smtp.163.com </sup></label> <input name="smtp" type="text" id="smtp" class="form-control" value="<?php echo MAIL_SMTP;?>"/>
        </div>
        <div class="form-group">
            <label> smtp端口 <sup> 一般默认为:25 </sup></label>
              <input name="port" type="text" id="port" class="form-control" value="<?php echo MAIL_PORT;?>"/>
              </div>

        <div class="form-group">
            <label> 发信邮箱 </label><input name="sendemail" type="email" id="sendemail" class="form-control" value="<?php echo MAIL_SENDEMAIL;?>"/></td>
</div>
        <div class="form-group">
            <label> 发信密码: </label>
              <input type="password" name="password" value="<?php echo MAIL_PASSWORD;?>" class="form-control" /></div>

        <div class="form-group">
            <label> 收信邮箱:</label>
              <input name="toemail" type="email" id="toemail" class="form-control" value="<?php echo MAIL_TOEMAIL;?>"/>
              </div>
        <div class="form-group">
        <label>发送方式:</label>
        <input type="radio" name="sendtype" value="0" <?php echo $ex0; ?> id="radio1" >
<label for="radio1"> Mail方式
<input type="radio" name="sendtype" value="1" <?php echo $ex1; ?> id="radio1" >
<label for="radio2"> SMTP方式
</label>
         </div>

        <div class="form-group">
              <label>发送选项:</label><br/>
              <input type="checkbox" name="issendmail" value="Y" <?php echo $SEND_MAIL ?>/> 收到评论时通知自己<br /><input type="checkbox" name="isreplymail" value="Y"  <?php echo $REPLY_MAIL ?>/> 回复评论时通知评论者
              </div>

        <div class="form-group">
        <input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
             <input name="Input" type="submit" class="btn btn-primary" value="保　存" />
         
          </div>
	</form>
</div>
</div>
    <div class="panel panel-default">
        <div class="panel-heading"> <i class="zmdi zmdi-email"></i> 邮件测试
        </div>
<div class="panel-body">
    <div class="form-group">
<input id="testsend" class="btn btn-success" type="button" value="发送一封测试邮件" />
</div>
</div>
<div id="testresult" style="height:64px; padding:10px; border-top:1px dashed #ccc; overflow:auto;/*background-color:#bbd9e2;*/">
</div>
</div>
<script>
jQuery.fn.onlyPressNum = function(){$(this).css('ime-mode','disabled');$(this).css('-moz-user-select','none');$(this).bind('keydown',function(event){var k=event.keyCode;if(!((k==13)||(k==9)||(k==35)||(k == 36)||(k==8)||(k==46)||(k>=48&&k<=57)||(k>=96&&k<=105)||(k>=37&&k<=40))){event.preventDefault();}})}
jQuery(function($){
	$('#port').onlyPressNum();
	$('#testsend').click(function(){$('#testresult').html('邮件发送中..');$.get('./sendmail.php?action=test&token=<?php echo LoginAuth::genToken(); ?>',{sid:Math.random()},function(result){if($.trim(result)!=''){$('#testresult').html(result);}else{$('#testresult').html('发送失败！');}});});
});
    setTimeout(hideActived, 2600);
    $("#menu_email").addClass('active');
</script>


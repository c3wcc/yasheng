<?php
/**
 * 自定义404页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
include View::getView('header');
?>
<script>
document.title = "404 抱歉页面不存在或被删除"
</script>
   <div id="catui-content">
      <div class="catui-container">
         <div class="catui-primary">
            <div class="catui-item catui-item-notfound">
               <img src="<?php echo TEMPLATE_URL; ?>404.png" alt="404">
               <h1>页面不见啦！<a href="<?php echo BLOG_URL; ?>">回到首页</a></h1>
               <div class="dots">
                  <div class="dot"></div>
                  <div class="dot"></div>
                  <div class="dot"></div>
               </div>
            </div><!-- .catui-item-list -->
         </div><!-- .catui-primary -->

<?php
 include View::getView('side');
?>
      </div>
   </div>
<?php
include View::getView('footer');
?>

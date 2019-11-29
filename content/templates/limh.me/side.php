<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>

<aside id="sidebar" role="complementary">
  <?php
    $widgets = !empty($options_cache['widgets1']) ? unserialize($options_cache['widgets1']) : array();
    doAction('diff_side');
    foreach ($widgets as $val) {
        $widget_title = @unserialize($options_cache['widget_title']);
        $custom_widget = @unserialize($options_cache['custom_widget']);
        if (strpos($val, 'custom_wg_') === 0) {
            $callback = 'widget_custom_text';
            if (function_exists($callback)) {
                call_user_func($callback, htmlspecialchars($custom_widget[$val]['title']), $custom_widget[$val]['content']);
            }
        } else {
            $callback = 'widget_' . $val;
            if (function_exists($callback)) {
                preg_match("/^.*\s\((.*)\)/", $widget_title[$val], $matchs);
                $wgTitle = isset($matchs[1]) ? $matchs[1] : $widget_title[$val];
                call_user_func($callback, htmlspecialchars($wgTitle));
            }
        }
    }
    ?>
  <!--广告图片开始--
	<div id="bannerbox">
    <div class="adtitle">请注意这绝不是广告</div>
		<a href="#"title="卖萌无极限..."><img alt="卖萌无极限..." src="<?php echo TEMPLATE_URL; ?>images/side1.jpg"/></a>
	</div>
	<!--广告图片结束--> 
</aside>

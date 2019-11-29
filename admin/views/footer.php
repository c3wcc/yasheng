<?php if (!defined('EMLOG_ROOT')) {exit('error!');}?>
<?php if(isset($_GET["plugin"])){?>
</div>
</div>
</div>
<?php };?>
<footer class="footer container-fluid pl-20 pr-20">
<div class="row">
<div class="col-sm-12">
<p><?php doAction('adm_footer');?></p>
</div>
</div>
</footer>
<script src="./views/plugins/waves-0.7.5/waves.min.js"></script>
<script src="./views/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./views/plugins/device.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./views/plugins/fullPage/jquery.fullPage.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./views/plugins/fullPage/jquery.jdirk.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./views/plugins/fastclick.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script type="text/javascript" src="./views/app/js/admin.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
</body>
</html>
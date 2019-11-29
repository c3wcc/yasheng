<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>

<?php if($editType==1):?>
	<script src="./y/assets/libs/ckeditor/ckeditor.js"></script>
	<script src="./y/assets/libs/ckeditor/lang/zh.js"></script>
	<link href="./y/assets/libs/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">
	<script src="./y/assets/libs/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js"></script>
	<?php else:?>
		<script charset="utf-8" src="./editor/kindeditor.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
		<script charset="utf-8" src="./editor/lang/zh_CN.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
	<?php endif;?>
	<div class="row">
		<div class="col-lg-12">
			<div class="widget float-e-margins">
				<div class="widget-header">
					<h2><i class="fa fa-file-o fa-fw"></i> <?php echo $containertitle; ?><span id="msg_2"></span></h2>

				</div>
				<div class="widget-content padding">
					<form action="page.php?action=save" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
						<div id="post">
							<div class="row">
								<div class="col-md-7">
									<div><input type="text" maxlength="200" name="title" id="title" class="form-control" placeholder="输入页面标题" value="<?php echo $title; ?>"/><input name="date" id="date" type="hidden"  ></div>
									<div id="post_bar">
										<div>
											<span onclick="displayToggle('FrameUpload', 0);autosave(4);" class="show_advset btn btn-default">上传插入</span>
											<?php doAction('adm_writelog_head'); ?>
											<span id="asmsg"></span>
											<input type="hidden" name="as_logid" id="as_logid" value="<?php echo $pageId; ?>">
										</div>
										<div id="FrameUpload" style="display: none;"><iframe style="width:100%;height:330px;" frameborder="0" src="<?php echo $att_frame_url;?>"></iframe></div>
									</div>
									<div>
										<?php if($editType==1):?>
											<textarea id="content" name="content"><?php echo $content; ?></textarea>
											<?php else:?>
												<textarea id="content" name="content" style="width:100%; height:460px;"><?php echo $content; ?></textarea>
											<?php endif;?>
										</div>
									</div>
									<div class="col-md-5">
										<div class="panel panel-default">
											<div class="panel-heading">设置项</div>
											<div class="panel-body">
												<span id="alias_msg_hook"></span>
												<input name="alias" id="alias" class="form-control" placeholder="输入链接别名" value="<?php echo $alias;?>"/>
												<p style="padding-top:10px;"><strong>页面模板：</strong></p>
												<input maxlength="200" class="form-control" name="template" id="template" value="<?php echo $template;?>" />
												（用于自定义页面模板，对应模板目录下.php文件）
												<div style="margin-top:3px;">
													<span id="page_options">
														<input type="checkbox" value="y" name="allow_remark" id="allow_remark" <?php echo $is_allow_remark; ?>/>
														<label for="allow_remark">页面接受评论</label>
													</span>
												</div>
												<div id="post_button">
													<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
													<input type="hidden" name="ishide" id="ishide" value="<?php echo $hide; ?>" />
													<input type="hidden" name="gid" value=<?php echo $pageId; ?> />
													<?php if ($pageId < 0):?>
														<input type="submit" value="发布页面" onclick="return checkform();" class="btn btn-primary" />
														<input type="button" name="savedf" id="savedf" value="保存" onclick="autosave(3);" class="btn btn-success" />
														<?php else:?>
															<input type="submit" value="保存并返回" onclick="return checkform();" class="btn btn-primary" />
															<input type="button" name="savedf" id="savedf" value="保存" onclick="autosave(3);" class="btn btn-success" />
														<?php endif;?>

													</div>
												</div>
											</div><!--设置结束-->
										</div><!--row end-->
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php if($editType==1):?>
					<script type="text/javascript" src="./y/assets/js/ckeditor.function.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
					<?php else:?>
						<script type="text/javascript" src="./y/assets/js/editor.function.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
					<?php endif;?>
					<script>
						$("#alias").keyup(function(){checkalias();});
						$("#menu_page").addClass('active');
						$("#title").focus(function(){$("#title_label").hide();});
						$("#title").blur(function(){if($("#title").val() == '') {$("#title_label").show();}});
						if ($("#title").val() != '')$("#title_label").hide();
						$("#menu_list").addClass('active');
					</script>
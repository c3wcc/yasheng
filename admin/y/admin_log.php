<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
$isdraft = $pid == 'draft' ? '&pid=draft' : '';
$isDisplaySort = !$sid ? "style=\"display:none;\"" : '';
$isDisplayTag = !$tagId ? "style=\"display:none;\"" : '';
$isDisplayUser = !$uid ? "style=\"display:none;\"" : '';
?>
<div class="row content_l">
	
	<div class="col-md-12">
		<div class="widget">
			<div class="widget-header transparent">
				<h2><i class="icon-feather"></i><strong><?php echo $pwd; ?></strong></h2>
			</div>
			<div class="widget-content">
				<div class="data-table-toolbar">
					<div class="filterss">
						<div id="f_title" class="form-inline ">
							<div class="col-sm-8 ">
								<span <?php echo !$sid && !$tagId && !$uid && !$keyword ? "class=\"filter\"" : ''; ?>><a class="btn btn-success" href="./admin_log.php?<?php echo $isdraft; ?>">全部</a></span>
								<span id="f_t_tag"><a class="btn btn-info" href="javascript:void(0);">按标签查看</a></span>
								<span id="f_t_sort">
									<select name="bysort" id="bysort" onChange="selectSort(this);" style="width:150px;" class="form-control">
										<option value="" selected="selected">按分类查看...</option>
										<?php 
										foreach($sorts as $key=>$value):
											if ($value['pid'] != 0) {
												continue;
											}
											$flg = $value['sid'] == $sid ? 'selected' : '';
											?>
											<option value="<?php echo $value['sid']; ?>" <?php echo $flg; ?>><?php echo $value['sortname']; ?></option>
											<?php
											$children = $value['children'];
											foreach ($children as $key):
												$value = $sorts[$key];
												$flg = $value['sid'] == $sid ? 'selected' : '';
												?>
												<option value="<?php echo $value['sid']; ?>" <?php echo $flg; ?>>&nbsp; &nbsp; &nbsp; <?php echo $value['sortname']; ?></option>
												<?php
											endforeach;
										endforeach;
										?>
										<option value="-1" <?php if($sid == -1) echo 'selected'; ?>>未分类</option>
									</select>
								</span>
								<?php if (ROLE == ROLE_ADMIN && count($user_cache) > 1):?>
									<span id="f_t_user">
										<select name="byuser" id="byuser" onChange="selectUser(this);" style="width:150px;" class="form-control">
											<option value="" selected="selected">按作者查看...</option>
											<?php 
											foreach($user_cache as $key=>$value):
												$flg = $key == $uid ? 'selected' : '';
												?>
												<option value="<?php echo $key; ?>" <?php echo $flg; ?>><?php echo $value['name']; ?></option>
												<?php
											endforeach;
											?>
										</select>
									</span>
								<?php endif;?>

							</div>
							<div class="col-sm-2">
								<form action="admin_log.php" method="get">
									<input type="text" id="input_s" name="keyword" class="form-control" placeholder="搜索文章">
									<?php if($pid):?>
										<input type="hidden" id="pid" name="pid" value="draft">
									<?php endif;?>
								</form>
							</div>
							<div style="clear:both"></div>
						</div>
						<div id="f_tag" <?php echo $isDisplayTag ?> class="alert alert-info">
							标签：
							<?php 
							if(empty($tags)) echo '还没有标签';
							foreach($tags as $val):
								$a = 'tag_'.$val['tid'];
								$$a = '';
								$b = 'tag_'.$tagId;
								$$b = "class=\"filter\"";
								?>
								<code <?php echo $$a; ?>><a href="./admin_log.php?tagid=<?php echo $val['tid'].$isdraft; ?>"><?php echo $val['tagname']; ?></a></code>
							<?php endforeach;?>
						</div>
					</div>
				</div>

				
				<form action="admin_log.php?action=operate_log" method="post" name="form_log" id="form_log">
					<div class="table-responsive">
						<table data-sortable class="table table-hover" id="adm_log_list">
							<thead>
								<tr>
									<th  data-sortable="false"><input type="checkbox" class="rows-check not-switch" id="select_all" title="全选"></th>
									<th>标题</th>
									<?php if ($pid != 'draft'): ?>
										<th>查看</th>
									<?php endif;?>
									<th>作者</th>
									<th>分类</th>
									<th>时间</th>
									<th>评论</th>
									<th>阅读</th>
								</tr>
							</thead>

							<tbody>
								<?php
								if($logs):
									foreach($logs as $key=>$value):
										$sortName = $value['sortid'] == -1 && !array_key_exists($value['sortid'], $sorts) ? '未分类' : $sorts[$value['sortid']]['sortname'];
										$author = $user_cache[$value['author']]['name'];
										$author_role = $user_cache[$value['author']]['role'];
										?>
										<tr>
											<td width="21"><input type="checkbox" name="blog[]" value="<?php echo $value['gid']; ?>" class="ids not-switch" /></td>
											<td class="content-index"><a href="write_log.php?action=edit&gid=<?php echo $value['gid']; ?>"><?php echo $value['title']; ?></a>
												<?php if($value['top'] == 'y'): ?><i class="fa fa-hand-o-up fa-fw" title="首页置顶" align="top"></i><?php endif; ?>
												<?php if($value['sortop'] == 'y'): ?><i class="icon-flag-1 text-green-1" title="分类置顶" align="top"></i><?php endif; ?>
												<?php if($value['attnum'] > 0): ?><i class="icon-attach-1" align="top" title="附件：<?php echo $value['attnum']; ?>"></i><?php endif; ?>
												<?php if($pid != 'draft' && $value['checked'] == 'n'): ?><sapn style="color:red;"> - 待审</sapn><?php endif; ?>
												<span style="display:none; margin-left:8px;">
													<?php if($pid != 'draft' && ROLE == ROLE_ADMIN && $value['checked'] == 'n'): ?>
														<a href="./admin_log.php?action=operate_log&operate=check&gid=<?php echo $value['gid']?>&token=<?php echo LoginAuth::genToken(); ?>">审核</a> 
														<?php elseif($pid != 'draft' && ROLE == ROLE_ADMIN && $author_role == ROLE_WRITER):?>
															<a href="./admin_log.php?action=operate_log&operate=uncheck&gid=<?php echo $value['gid']?>&token=<?php echo LoginAuth::genToken(); ?>">驳回</a> 
														<?php endif;?>
													</span>
												</td>
												<?php if ($pid != 'draft'): ?>
													<td class="tdcenter">
														<a href="<?php echo Url::log($value['gid']); ?>" target="_blank" title="在新窗口查看">
															<img src="./views/images/vlog.gif" align="absbottom" border="0" /></a>
														</td>
													<?php endif; ?>
													<td><a href="./admin_log.php?uid=<?php echo $value['author'].$isdraft;?>"><?php echo $author; ?></a></td>
													<td><a href="./admin_log.php?sid=<?php echo $value['sortid'].$isdraft;?>"><?php echo $sortName; ?></a></td>
													<td><?php echo $value['date']; ?></td>
													<td class="tdcenter"><a href="comment.php?gid=<?php echo $value['gid']; ?>"><?php echo $value['comnum']; ?></a></td>
													<td class="tdcenter"><?php echo $value['views']; ?></a></td>
												</tr>
											<?php endforeach;else:?>
											<tr><td class="tdcenter" colspan="8" ><h1>还没有文章</h1></td></tr>
										<?php endif;?>
									</tbody>
								</table>
							</div>
						</div>
						<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
						<input name="operate" id="operate" value="" type="hidden" />
						<div class="list_footer form-inline">
							选中项：
							<a href="javascript:logact('del');" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="删除"><i class="icon-trash-3"></i></a>

							<?php if($pid == 'draft'): ?>
								<a href="javascript:logact('pub');" class="btn btn-success">发布</a>
								<?php else: ?>
									<a href="javascript:logact('hide');" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="放入草稿箱"><i class="icon-archive"></i></a>


									<?php if (ROLE == ROLE_ADMIN):?>
										<select name="top" id="top" onChange="changeTop(this);" class="form-control">
											<option value="" selected="selected">置顶操作...</option>
											<option value="top">首页置顶</option>
											<option value="sortop">分类置顶</option>
											<option value="notop">取消置顶</option>
										</select>
									<?php endif;?>

									<select name="sort" id="sort" onChange="changeSort(this);" class="form-control">
										<option value="" selected="selected">移动到分类...</option>

										<?php 
										foreach($sorts as $key=>$value):
											if ($value['pid'] != 0) {
												continue;
											}
											?>
											<option value="<?php echo $value['sid']; ?>"><?php echo $value['sortname']; ?></option>
											<?php
											$children = $value['children'];
											foreach ($children as $key):
												$value = $sorts[$key];
												?>
												<option value="<?php echo $value['sid']; ?>">&nbsp; &nbsp; &nbsp; <?php echo $value['sortname']; ?></option>
												<?php
											endforeach;
										endforeach;
										?>
										<option value="-1">未分类</option>
									</select>

									<?php if (ROLE == ROLE_ADMIN && count($user_cache) > 1):?>
										<select name="author" id="author" onChange="changeAuthor(this);" class="form-control">
											<option value="" selected="selected">更改作者为...</option>
											<?php foreach($user_cache as $key => $val):
												$val['name'] = $val['name'];
												?>
												<option value="<?php echo $key; ?>"><?php echo $val['name']; ?></option>
											<?php endforeach;?>
										</select>
									<?php endif;?>

								<?php endif;?>


							</div>
						</form>
						<div class="page_num">
							<?php echo $pageurl; ?> (共<?php echo $logNum; ?>篇<?php echo $pid == 'draft' ? '草稿' : '文章'; ?>)
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
					
					$(document).ready(function(){
						$("#adm_log_list tbody tr:odd").addClass("tralt_b");
						$("#adm_log_list tbody tr")
						.mouseover(function(){$(this).addClass("trover");$(this).find("span").show();})
						.mouseout(function(){$(this).removeClass("trover");$(this).find("span").hide();});
						$("#f_t_tag").click(function(){$("#f_tag").toggle();$("#f_sort").hide();$("#f_user").hide();});
						selectAllToggle();
					});
					try{setTimeout(hideActived,2600);}catch(err){}
					function logact(act){
						if (getChecked('ids') == false) {
							EmlogMsgNotify('warning','','请选择要操作的文章','top right');
							return;}
							if(act == 'del' && !confirm('你确定要删除所选文章吗？')){return;}
							$("#operate").val(act);
							$("#form_log").submit();
						}
						function changeSort(obj) {
							if (getChecked('ids') == false) {
								EmlogMsgNotify('warning','','请选择要操作的文章','top right');
								return;}
								if($('#sort').val() == '')return;
								$("#operate").val('move');
								$("#form_log").submit();
							}
							function changeAuthor(obj) {
								if (getChecked('ids') == false) {
									EmlogMsgNotify('warning','','请选择要操作的文章','top right');
									return;}
									if($('#author').val() == '')return;
									$("#operate").val('change_author');
									$("#form_log").submit();
								}
								function changeTop(obj) {
									if (getChecked('ids') == false) {
										EmlogMsgNotify('warning','','请选择要操作的文章','top right');
										return;}
										if($('#top').val() == '')return;
										$("#operate").val(obj.value);
										$("#form_log").submit();
									}
									function selectSort(obj) {
										window.open("./admin_log.php?sid=" + obj.value + "<?php echo $isdraft?>", "_self");
									}
									function selectUser(obj) {
										window.open("./admin_log.php?uid=" + obj.value + "<?php echo $isdraft?>", "_self");
									}
									<?php if ($isdraft) :?>
										$("#menu_list").addClass('active');
										$("#menu_draft").addClass('active');
										<?php else:?>
											$("#menu_list").addClass('active');
											$("#menu_log").addClass('active');
										<?php endif;?>
									</script>
									<script>
										$(function () {
											setTimeout('Emlogalert()',100);
										});
										function Emlogalert(){
											<?php if(isset($_GET['active_del'])):?>EmlogMsgNotify('info','','删除成功','top right');<?php endif;?>
											<?php if(isset($_GET['active_up'])):?>EmlogMsgNotify('info','','删除成功','top right');<?php endif;?>
											<?php if(isset($_GET['active_down'])):?>EmlogMsgNotify('info','','取消置顶成功','top right');<?php endif;?>
											<?php if(isset($_GET['error_a'])):?>EmlogMsgNotify('error','','请选择要处理的文章','top right');<?php endif;?>
											<?php if(isset($_GET['error_b'])):?>EmlogMsgNotify('error','','请选择要执行的操作','top right');<?php endif;?>
											<?php if(isset($_GET['active_post'])):?>EmlogMsgNotify('info','','发布成功','top right');<?php endif;?>
											<?php if(isset($_GET['active_move'])):?>EmlogMsgNotify('info','','移动成功','top right');<?php endif;?>
											<?php if(isset($_GET['active_change_author'])):?>EmlogMsgNotify('info','','更改作者成功','top right');<?php endif;?>
											<?php if(isset($_GET['active_hide'])):?>EmlogMsgNotify('info','','转入草稿箱成功','top right');<?php endif;?>
											<?php if(isset($_GET['active_savedraft'])):?>EmlogMsgNotify('info','','草稿保存成功','top right');<?php endif;?>
											<?php if(isset($_GET['active_savelog'])):?>EmlogMsgNotify('info','','保存成功','top right');<?php endif;?>
											<?php if(isset($_GET['active_ck'])):?>EmlogMsgNotify('info','','文章审核成功','top right');<?php endif;?>
											<?php if(isset($_GET['active_unck'])):?>EmlogMsgNotify('info','','文章驳回成功','top right');<?php endif;?>
										}
									</script>
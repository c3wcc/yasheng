<?php
/**
 * 自建页面模板--会员中心
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
if(ROLE == 'admin' || ROLE == 'writer'):
$user_cache = $CACHE->readCache('user');
$action = isset($_GET['action']) ? addslashes($_GET['action']) : '';
/*会员中心-个人资料获取*/
$DB = Database::getInstance();
$userData = $DB->once_fetch_array("SELECT * FROM ".DB_PREFIX."user WHERE uid = '".UID."'");
$userData['username'] = htmlspecialchars($userData['username']);
$userinfo = LoginAuth::getUserDataByLogin($userData['username']);
/**
 * 分页函数
 *
 * @param int $count 条目总数
 * @param int $perlogs 每页显示条数目
 * @param int $page 当前页码
 * @param string $url 页码的地址
 */
function paginations($count, $perlogs, $page, $url, $anchor = ''){
	$pnums = @ceil($count / $perlogs);
	$re = '';
	$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|", "", $url);
	for ($i = $page - 5; $i <= $page + 5 && $i < $pnums; $i++) {
		if ($i >= 0) {
			if ($i == $page) {
				$re .= "<li class=\"active\"><span>".($i+1)."</span></li>";
			} elseif ($i == 0) {
				$re .= "<li><a href=\"$urlHome$anchor\">".($i+1)."</a></li>";
			} else {
				$re .= "<li><a href=\"$url$i$anchor\">".($i+1)."</a></li>";
			}
		}
	}
	if ($page > 6)
		$re = "<li><a href=\"{$urlHome}$anchor\" title=\"首页\">首页</a></li>$re";
	if ($page + 5 <= $pnums)
		$re .= "<li><a href=\"$url".($pnums-1)."$anchor\" title=\"尾页\">尾页</a></li>";
	if ($pnums <= 0)
		$re = '';
	return $re;
}
//获取用户发表文章
function myblog(){
		$DB = Database::getInstance();
		global $userData;
		$userid = $userData['uid'];
		$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
		$sizepage = 5;
		$limit = $page*$sizepage;
		$numsql = "select count(*) from ".DB_PREFIX."blog where author=$userid";
		$res = $DB->query($numsql);
		$myblognum = $DB->fetch_array($res);
		$numsql = "select gid,title,hide,author,date,checked from ".DB_PREFIX."blog where author=$userid order by gid desc limit $limit,$sizepage";
		$res = $DB->query($numsql);
		$f.='<table class="widefat">
<thead>
  <tr>
    <th class="lenght" scope="col">标题</th>
    <th scope="col">日期</th>
    <th scope="col">操作</th>
    <th scope="col">状态</th>
  </tr>
</thead>';
		while ($myblog = $DB->fetch_array($res)) {
			$hide = $myblog['checked']=='n'?' (<span style="color:red;">待审核</span>)':'(已审核)';
			$hidetitle = $myblog['hide']=='y'?' '.$myblog['title']:''.$myblog['title'].'';
			$hidetitlewz = $myblog['hide']=='y'?' '.$myblog['title']:''.Url::log($myblog['gid']).'';
			$date=date("Y-m-d H:i:s",$myblog["date"]); 
			$f.="
			<tbody>
            <tr class='alternate'> 
			<td class='lenght'>$hidetitle</td>
            <td class='time'>$date</td>
			<td class='actions'> <a target='_blank' class='preview' href='$hidetitlewz'>预览</a></td>
            <td>$hide</td> 
            ";
		}
		$f.='</tr></tbody></table> ';
		$f.= '<div class="pagination"><ul>'.paginations($myblognum['count(*)'],$sizepage, $page, BLOG_URL."?user&home&page=").'</ul></div>';
		if($myblognum==0){
			return '您还没有发表过文章哦!';
		}else{
			return $f;
		}
	}

//获取用户发表评论
function mycomment(){
		$DB = Database::getInstance();
		global $userData;
		$userEmail = $userData['email'];
		$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
		$sizepage = 5;
		$limit = $page*$sizepage;
		$numsql = "select count(*) from ".DB_PREFIX."comment where mail='$userEmail'";
		$res = $DB->query($numsql);
		$myblognum = $DB->fetch_array($res);
		$numsql = "select * from ".DB_PREFIX."comment where mail='$userEmail' order by date desc limit $limit,$sizepage";
		$res = $DB->query($numsql);
		$f.='';
		while ($myblog = $DB->fetch_array($res)) {
			//$hide = $myblog['hide']=='y'?'(<span style="color:red;">待审核</span>)':'(已审核)';
			//根据ID获取标题
				$sql = "select gid,title from ".DB_PREFIX."blog where gid={$myblog['gid']} ";
				$re = $DB->query($sql);
				$title = $DB->fetch_array($re);
			$hidetitle = '<a href="'.Url::log($myblog['gid']).'" target="_blank">'.$title["title"].'</a>';
			
			$content=$myblog["comment"];
			$date=date("Y-m-d H:i:s",$myblog["date"]); 
			$f.="
<div class='panel panel-default'>
  <div class='panel-heading'>评论于$hidetitle</div>
  <div class='panel-body'>$content</div>
  <div class='panel-footer'>$date</div>
</div>
		 ";
		}
		$f.= '<div class="pagination"><ul>'.paginations($myblognum['count(*)'],$sizepage, $page, BLOG_URL."?user&comments&page=").'</ul></div>';
    	if($userEmail==""){
        	return '您需要设置邮箱之后才能查看评论!';
        }
		if($myblognum==0){
			return '您还没有发表过评论哦!';
		}else{
			return $f;
		}
	}
global $userData;
?>
<section class="container">
	<div class="row">
		<div class="col-lg-3 sidebar-wrapper">
			<section class="panel sidebar-menu">
				<ul class="menus">
					<li><a href="?user&home" class="hover"><i class="fa fa-tachometer"></i><span class="menu-text">个人首页</span></a></li>
					<li class="sidebar-dropdown"><a href="javascript:;" ><i class="fa fa-user-o"></i><span>用户中心</span></a>
						<div class="sidebar-submenu" style="display: block;">
							<ul class="hide-memu">
								<li><a href="?user&log"><i class="fa fa-cube"></i>发布文章</a></li>
								<li><a href="?user&comments"><i class="fa fa-comments"></i>我的评论</a></li>
								<li><a href="?user&datas"><i class="fa fa-id-card-o"></i>资料修改</a></li>
							</ul>
						</div>
					</li>
					<li class="sidebar-dropdown"><a href="javascript:;" ><i class="fa fa-tv"></i><span>控制面板</span></a>
						<div class="sidebar-submenu" style="display: block;">
							<ul class="hide-memu">
								<li><a href="?user&pay"><i class="fa fa-credit-card-alt"></i>钱包管理</a></li>
								<li><a href="?user&myvip"><i class="fa fa-diamond"></i>我的会员</a></li>
								<li><a href="?user&record"><i class="fa fa-mixcloud"></i>订单管理</a></li>	
							</ul>
						</div>
					</li>
					<?php if(ROLE == ROLE_ADMIN){?>
					<li><a href="?user&vip"><i class="fa fa-user"></i><span>会员管理</span></a></li>
					<li><a href="?setting"><i class="fa fa-desktop"></i><span>模板设置</span></a></li>
					<?php }?>
					<li class="login_logout"><a href="?user&logout"><i class="fa fa-sign-in"></i><span>安全退出</span></a></li>
				</ul>
			</section>
		</div>
		<?php if(isset($_GET['home'])):?>
		<div class="col-lg-9">
			<section class="panel panel-default">
			<div class="panel-heading">个人首页</div>
			<div class="panel-body">
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3><?php if(empty($userData["nickname"])){echo $userData["username"];}else{echo $userData["nickname"];}?></h3><span><?php echo times(date('G'));?></span>
				</div>
			<div class="dashboard-wrapper select-index">
                <div class="briefly">
					<ul>
						<li class="post">
						  <div class="visual"><i class="fa fa-tachometer"></i></div>
						  <div class="number">首页</div>
						  <div class="more"><a href="<?php echo BLOG_URL; ?>">网站首页<i class="fa fa-arrow-circle-right"></i></a></div>
						</li>
						<li class="photo">
						  <div class="visual"><i class="fa fa-comments"></i></div>
						  <div class="number">评论</div>
						  <div class="more"><a href="?user&comments">查看更多<i class="fa fa-arrow-circle-right"></i></a></div>
						</li>
						<li class="credit">
						  <div class="visual"><i class="fa fa-cog"></i></div>
						  <div class="number">资料</div>
						  <div class="more"><a href="?user&datas">个人资料<i class="fa fa-arrow-circle-right"></i></a></div>
						</li>
						<li class="comments">
						  <div class="visual"><i class="fa fa-sign-in"></i></div>
						  <div class="number">退出</div>
						  <div class="more login_logout"><a href="?user&logout">退出帐号<i class="fa fa-arrow-circle-right"></i></a></div>
						</li>
					</ul>
				</div>

            </div>
            <div class="dashboard-header"><p class="tip">我的作品：(提示：文章发布后不可修改，请谨慎操作。)</p></div>
            <div class="dashboard-wrapper select-works">
                <?php echo myblog();?>
            </div>
			</div>
			</section>
			</div>
		<?php endif;if(isset($_GET['log'])):?>
		<div class="col-lg-9">
			<section class="panel panel-default">
			<div class="panel-heading">发布文章</div>
			<div class="panel-body">
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span>提示：文章作品需提交审核通过才能正式发布，请耐心等待。</span>
				</div>
				<form action="" method="post" name="addlog" id="addlog" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-sm-12 form-post"><input type="text" class="form-control regular-text large" name="post_title" placeholder="文章标题"></div>
						<div class="col-sm-12 form-post"><textarea id="editor_content" name="content" style="width:100%; height:560px;" class="form-control"><?php echo $content; ?></textarea>
							<script>tinymce.init({selector:'#editor_content',language:'zh_CN',elementpath: false,height:300,menubar: false,  plugins: "image"})</script>
						</div>
						<div class="col-sm-3"><select name="post_category" id="post-cat" class="col-lg-3 form-control">
							<?php
								global $CACHE;
								$sort = $CACHE->readCache('sort');
								$blogsort = '';
								$blogsort .= '<option value="-1">选择分类</option>';
								foreach ($sort as $value) {
									$blogsort .= '<option class="level-1" value="'.$value['sid'].'">'.$value['sortname'].'</option>';
								}
								$blogsort .= '';
								echo $blogsort;
							?>
						</select></div>
						<div class="col-sm-5"><span class="spinner"></span></div>
						<div class="col-sm-4"><input type="button" id="postnew" class="btn btn-blue pull-right" name="submit" value="投稿"></div>
					</div>
				</form>
			</div>
			</section>
		</div>
		<?php endif;if(isset($_GET['comments'])):?>
		<div class="col-lg-9">
			<section class="panel panel-default">
			<div class="panel-heading">评论管理</div>
			<div class="panel-body">
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span>提示：认真填写的点评都有可能被推荐为精彩评论哦。</span>
				</div>
				<?php echo mycomment();?>
			</div>
			</section>
		</div>
		<?php endif;if(isset($_GET['myvip'])):?>
		<div class="col-lg-9">
			<section class="panel panel-default">
			<div class="panel-heading">我的会员</div>
			<div class="panel-body">
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span>Hi，<?php if(empty($userData["nickname"])){echo $userData["username"];}else{echo $userData["nickname"];}?>，您的VIP状态:<?php $data = _vip(UID); echo $data['level'] ? $data['name'].'VIP 到期：'.date("Y-m-d",$data['time']) : '未开通';?></span>
				</div>
				<div class="col-lg-12">
					<div class="input-group pay-btn">
					  <input type="text" id="paykey" value="" class="form-control" placeholder="请先点击右侧购买卡密，然后输入已购买到的会员充值卡或升级卡!">
					  <span class="input-group-btn pay-input">
						<button type="button" class="btn btn-default" title="前往购卡" onclick="javascript:window.open('tencent://message/?uin=<?php echo htmlspecialchars($userinfo['side_qq']); ?>');" aria-label="Pay"><i class="fa fa-credit-card"></i> 购卡</button>
						<button class="btn btn-default payvip" type="button">立即充值</button>
					  </span>
					</div>
					<div id="pay-success" class="alert alert-success alert-dismissible" style="display:none" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong><i class="fa fa-check"></i></strong> <span class="pay_info"></span>
					</div>
					<div id="pay-danger" class="alert alert-danger alert-dismissible" style="display:none" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong><i class="fa fa-times"></i></strong> <span class="pay_info"></span>
					</div>
				</div>
				<div class="col-lg-4">
				  <div class="panel panel-default">
					<div class="panel-heading">白银VIP</div>
					  <ul class="list-group list-group-flush m-t-n">
						<li class="list-group-item"><div class="media"><span class="pull-left thumb-small">月付</span><div class="pull-right text-success m-t-small">续费</div><div class="media-body">需要<code><?php echo $Tconfig["vip1_y"];?></code>软妹币</div></div>
						</li>
						<li class="list-group-item"><div class="media"><span class="pull-left thumb-small">季付</span><div class="pull-right text-success m-t-small">续费</div><div class="media-body">需要<code><?php echo $Tconfig["vip1_j"];?></code>软妹币</div></div>
						</li>
						<li class="list-group-item"><div class="media"><span class="pull-left thumb-small">年付</span><div class="pull-right text-success m-t-small">续费</div><div class="media-body">需要<code><?php echo $Tconfig["vip1_n"];?></code>软妹币</div></div>
						</li>
					  </ul>
				  </div>
				</div>
				<div class="col-lg-4">
				  <div class="panel panel-default">
					<div class="panel-heading">黄金VIP</div>
					  <ul class="list-group list-group-flush m-t-n">
						<li class="list-group-item"><div class="media"><span class="pull-left thumb-small">月付</span><div class="pull-right text-success m-t-small">续费</div><div class="media-body">需要<code><?php echo $Tconfig["vip2_y"];?></code>软妹币</div></div>
						</li>
						<li class="list-group-item"><div class="media"><span class="pull-left thumb-small">季付</span><div class="pull-right text-success m-t-small">续费</div><div class="media-body">需要<code><?php echo $Tconfig["vip2_j"];?></code>软妹币</div></div>
						</li>
						<li class="list-group-item"><div class="media"><span class="pull-left thumb-small">年付</span><div class="pull-right text-success m-t-small">续费</div><div class="media-body">需要<code><?php echo $Tconfig["vip2_n"];?></code>软妹币</div></div>
						</li>
					  </ul>
				  </div>
				</div>
				<div class="col-lg-4">
				  <div class="panel panel-default">
					<div class="panel-heading">钻石VIP</div>
					  <ul class="list-group list-group-flush m-t-n">
						<li class="list-group-item"><div class="media"><span class="pull-left thumb-small">月付</span><div class="pull-right text-success m-t-small">续费</div><div class="media-body">需要<code><?php echo $Tconfig["vip3_y"];?></code>软妹币</div></div>
						</li>
						<li class="list-group-item"><div class="media"><span class="pull-left thumb-small">季付</span><div class="pull-right text-success m-t-small">续费</div><div class="media-body">需要<code><?php echo $Tconfig["vip3_j"];?></code>软妹币</div></div>
						</li>
						<li class="list-group-item"><div class="media"><span class="pull-left thumb-small">年付</span><div class="pull-right text-success m-t-small">续费</div><div class="media-body">需要<code><?php echo $Tconfig["vip3_n"];?></code>软妹币</div></div>
						</li>
					  </ul>
				  </div>
				</div>
			</div>
			</section>
		</div>
		<?php endif;if(isset($_GET['record'])):
			$db = Database::getInstance();
			global $userData;
			$userid = $userData['uid'];
			$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
			$sizepage = 5;
			$limit = $page*$sizepage;
			$numsql = "select count(*) from ".DB_PREFIX."user_log where `uid` = ".$userid;
			$res = $db->query($numsql);
			$vipnum = $db->fetch_array($res);
			$numsql = "select * from ".DB_PREFIX."user_log where `uid` = ".$userid." order by id desc limit $limit,$sizepage";
			$query = $db->query($numsql);
        	while ($ad = $db->fetch_array($query)) {
        		$tempstr = array('未完成', '已完成');
        		$tempstr1 = array('','充值','消费','系统扣除','提现');
        		if($ad['status'] == '1' && $ad['gid'] != ''){
        			$ad['log'] = $ad['log'].' <a href="'.URL::log($ad['gid']).'">前往查看已购内容</a>';
        		}
        		$ad['status'] = $tempstr[$ad['status']];
        		$ad['type'] = $tempstr1[$ad['type']];
        		$ads[] = $ad;
        	}			
		?>
		<div class="col-lg-9">
		    <div class="panel panel-default panel-vip">
			<div class="panel-heading">订单管理</div>
			<div class="panel-body">
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span>提示：认真填写的点评都有可能被推荐为精彩评论哦。</span>
				</div>
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr class="bg-warning">
							<th>详细</th>
							<th>订单号</th>
							<th>金额</th>
							<th>类型</th>
							<th>状态</th>
							<th>时间</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($ads as $value){ ?>
						<tr>
							<td><?php echo $value['log'];?></td>
							<td><?php echo $value['payid'];?></td>
							<td><?php echo $value['money'];?></td>
							<td><?php echo $value['type'];?></td>
							<td><?php echo $value['status'];?></td>
							<td><?php echo date("Y-m-d H:i:s",$value['time']);?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
				</div>
			</div>
			<?php echo '<div class="pagination"><ul>'.paginations($vipnum['count(*)'],$sizepage, $page, BLOG_URL."?user&record&page=").'</ul></div>';?>
		</div>
		<?php endif;if(isset($_GET['pay'])):?>
		<div class="col-lg-9">
			<section class="panel panel-default">
				<div class="panel-heading">我的钱包</div>
				<div class="panel-body">
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span>温馨提示：为了避免掉单情况的发生，请您在支付完成后，需等"支付成功"页面跳转出来, 再关闭页面，以免掉单！感谢配合！！！</span>
				</div>
				<div class="pay-callout">
					<form target="_blank" class="form-horizontal " id="pay_f" method="post" action="<?php echo TEMPLATE_URL; ?>inc/ajax.php?a=yiwan_pay">
						<h4 class="yuerecharge">在线充值</h4>
					  <div class="form-group">
						<label class="col-lg-3 control-label">充值账户</label>
						<div class="col-lg-8">
						  <input type="text" value="<?php echo htmlspecialchars($userinfo['username']); ?>" class="form-control" disabled="disabled">
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-lg-3 control-label">钱包余额</label>
						<div class="col-lg-8">
						  <input type="text" value="<?php echo htmlspecialchars($userinfo['Integral']); ?>" class="form-control" disabled="disabled">
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-lg-3 control-label">充值方式</label>
						<div class="col-lg-4">
							<div class="radio i-checks">
							<label><input type="radio" value="1" name="zhifu" id="ali_pay" class="mgr mgr-info" checked=""><i></i> <img class="paytb" src="<?php echo TEMPLATE_URL; ?>img/alipay.jpg" alt="支付宝" title="支付宝"></label> 
							<label><input type="radio" value="2" name="zhifu" id="wx_pay" class="mgr mgr-info" ><i></i> <img class="paytb" src="<?php echo TEMPLATE_URL; ?>img/wxpay.jpg" alt="微信" title="微信"></label> 
							</div>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-lg-3 control-label">充值金额</label>
						<div class="col-lg-8">
						  <input type="text" class="form-control" id="focusedInput" name="money" value="10" placeholder="请输入充值金额！">
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-lg-9 col-offset-3"> 
						  <button class="btn btn-blue alipay" type="submit" name="alipay">立即充值</button>	
						  <button class="btn btn-blue wxpay" style="display:none" type="submit" name="wxpay">立即充值</button>					  
						</div>
					  </div>
					</form>
				</div>
				</div>
			</section>
		</div>
		<?php endif;if(isset($_GET['vip'])):?>
		<?php if(ROLE == ROLE_ADMIN){
			$db = Database::getInstance();
			global $userData;
			$userid = $userData['uid'];
			$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
			$sizepage = 12;
			$limit = $page*$sizepage;
			$numsql = "select count(*) from ".DB_PREFIX."user";
			$res = $db->query($numsql);
			$vipnum = $db->fetch_array($res);
			$numsql = "select * from ".DB_PREFIX."user order by uid limit $limit,$sizepage";
			$query = $db->query($numsql);
        	while ($ad = $db->fetch_array($query)) {
        		if($ad['vip'] == '-1'){
					$ad['vipstr'] = '<div class="govip" title="开通会员"><img class="vipbtn" data="0" userid="'.$ad["uid"].'" height="18px" src="'.TEMPLATE_URL.'img/vipoff.png"></div>';
					$ad['viptime'] = '<div class="viptime">未开通</div>';
        		}elseif($ad['vip'] <= time()){
					$ad['vipstr'] = '<div class="govip" title="开通会员"><img class="vipbtn" data="0" userid="'.$ad["uid"].'" height="18px" src="'.TEMPLATE_URL.'img/vipoff.png"></div>';
					$ad['viptime'] = '<div class="viptime">已到期,到期时间:'.date("Y-m-d",$ad['vip']).'</div>';
        		}else{
					$ad['vipstr'] = '<div class="govip" title="关闭会员"><img class="vipbtn" data="1" userid="'.$ad["uid"].'" height="18px" src="'.TEMPLATE_URL.'img/vipopen.png"></div>';
					$ad['viptime'] = '<div class="viptime">已开通,到期时间:'.date("Y-m-d",$ad['vip']).'</div>';					
				}
        		$ads[] = $ad;
        	}
			?>
		<div class="col-lg-9">
			<section class="panel panel-default">
				<div class="panel-heading">会员管理</div>
				<div class="panel-body">
					<div class="alert alert-info alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <span>欢迎使用<strong>FLY</strong>主题，该页面为VIP权限设置区域.</span>
					</div>
		                    <div class="fly_tab" role="tabpanel">
		                        <!-- Nav tabs -->
		                        <ul class="nav nav-tabs" role="tablist">
		                            <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">会员管理</a></li>
		                            <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">卡密状态</a></li>
		                            <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">充值记录</a></li>
		                        </ul>
		                        <!-- Tab panes -->
		                        <div class="tab-content tabs">
		                            <div role="tabpanel" class="tab-pane fade in active" id="Section1">
		                                <div class="panel panel-default panel-vip">
											<div class="panel-heading" style="line-height:18px">会员管理</div>
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr class="bg-success">
														<th>ID</th>
														<th>账号</th>
														<th>昵称</th>
														<th>状态</th>
														<th>VIP</th>
														<th>续费</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($ads as $value) { ?>
													<tr>
														<th scope="row"><?php echo $value['uid'];?></th>
														<td><span class="vip-level<?php echo $value['level'];?>"></span><?php echo $value['username'];?></td>
														<td><?php echo $value['nickname'];?></td>
														<td><?php echo $value['viptime'];?></td>
														<td><?php echo $value['vipstr'];?></td>
														<td><a class="addvip" data-uid="<?php echo $value['uid'];?>" data-time="1">续费30天</a> | <a class="addvip" data-uid="<?php echo $value['uid'];?>" data-time="2">续费90天</a> | <a class="addvip" data-uid="<?php echo $value['uid'];?>" data-time="3">续费365天</a></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
										<?php echo '<div class="pagination"><ul>'.paginations($vipnum['count(*)'],$sizepage, $page, BLOG_URL."?user&vip&page=").'</ul></div>';?>
		                            </div>
									<?php 
										$db = Database::getInstance();
										$query = $db->query('SELECT * FROM '.DB_PREFIX.'user_key ORDER BY id DESC');
										$ads = array();
										while ($ad = $db->fetch_array($query)) {
											$ad['stutas'] == 'n' ? $ad['info'] = '未使用' : $ad['info'] = '已使用';
											if($ad['type'] == '1'){$ad['types'] = '月卡';}
											if($ad['type'] == '2'){$ad['types'] = '季卡';}
											if($ad['type'] == '3'){$ad['types'] = '年卡';}
											$ads[] = $ad;
										}
									?>
		                            <div role="tabpanel" class="tab-pane fade" id="Section2">
										<form class="kami-form">
											<div class="input-group">
												<select id="kamitime" name="time" class="form-control select-kami selectpicker bs-select-hidden">
													<option value="1">月卡</option>
													<option value="2">季卡</option>
													<option value="3">年卡</option>
												</select>
												<select id="kaminum" name="num" class="form-control select-kami selectpicker bs-select-hidden">
													<option value="1">1张</option>
													<option value="10">10张</option>
													<option value="100">100张</option>
												</select>
												<span type="submit" class="input-group-addon input-kami">生成</span>
											</div>
										</form>
		                                <div class="panel panel-default panel-vip">
											<div class="panel-heading" style="line-height:18px">卡密状态</div>
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr class="bg-info">
														<th>类型</th>
														<th>卡密</th>
														<th>状态</th>
														<th>操作[<a class="key_del" data="all">删除所有</a>]</th>
													</tr>
												</thead>
												<tbody>
												<?php foreach($ads as $value){ ?>
													<tr>
														<td><?php echo $value['types'];?></td>
														<td><?php echo $value['key'];?></td>
														<td><?php echo $value['info'];?></td>
														<td class="key_del" data="<?php echo $value['id'];?>">删除</td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
		                            </div>
									<?php 
										$db = Database::getInstance();
										$query = $db->query('SELECT * FROM '.DB_PREFIX.'user_log ORDER BY time DESC');
										$ads = array();
										while ($ad = $db->fetch_array($query)) {
											$ads[] = $ad;
										}
									?>
		                            <div role="tabpanel" class="tab-pane fade" id="Section3">
		                                <div class="panel panel-default panel-vip">
											<div class="panel-heading" style="line-height:18px">充值记录 <a class="log_del" style="float:right">[清空]</a></div>
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr class="bg-warning">
														<th>ID</th>
														<th>详细信息</th>
														<th>时间</th>
													</tr>
												</thead>
												<tbody>
												<?php foreach($ads as $value){ ?>
													<tr>
														<td><?php echo $value['id'];?></td>
														<td><?php echo $value['log'];?></td>
														<td><?php echo date("Y-m-d h:i:s",$value['time']);?></td>
													</tr>
												<?php } ?>
												</tbody>
											</table>
										</div>
		                            </div>
		                        </div>
		                    </div>
					</div>
			</section>
		</div>
		<?php }?>
		<?php endif;if(isset($_GET['datas'])):?>
		<div class="col-lg-9">
			<section class="panel panel-default">
				<div class="panel-heading">个人资料</div>
				<div class="panel-body">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span>请如实填写资料信息，我们承诺不会泄露任何关于您的资料，以下信息只为小编发货商品或找回密码等所用</span>
				</div>
			  <form action="" method="post" name="blooger" class="form-horizontal" id="updatefrom" enctype="multipart/form-data">			  
              <div class="form-group">
                <label class="col-lg-7 control-label">
					<div id="up-img-touch" class="touxiang">
					<img src="<?php if($user_cache[UID]['photo']['src']){echo BLOG_URL.$user_cache[UID]['photo']['src'];}else{echo TEMPLATE_URL.'img/avatar.png';}?>" class="touxiangimg" alt="<?php if(empty($userData["nickname"])){echo $userData["username"];}else{echo $userData["nickname"];}?>">
					<div class="uoverlay">
						<div class="uexpand" data-target="#up-img" data-toggle="modal" data-backdrop="static" type="text">更换头像</div>
					</div>
					</div>
				</label>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">登录账号</label>
                <div class="col-lg-8">
                  <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($userinfo['username']); ?>" class="form-control" disabled="disabled">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">个人主页</label>
                <div class="col-lg-8">
				  <input type="text" name="zhuye" id="zhuye" value="<?php echo BLOG_URL.'author/'.UID ?>" class="form-control" disabled="disabled">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">我的昵称</label>
                <div class="col-lg-8">
                  <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($userinfo['nickname']); ?>" class="form-control form-xg" disabled="disabled">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">邮箱号码</label>
                <div class="col-lg-8">
                  <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($userinfo['email']); ?>" class="form-control form-xg" disabled="disabled">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">QQ  号码</label>
                <div class="col-lg-8">
                  <input type="text" name="qq" id="qq" value="<?php echo htmlspecialchars($userinfo['qq']); ?>" class="form-control form-xg" disabled="disabled">
                </div>
              </div>
			  <?php if($Tconfig["qq_login"]== 1){?>
              <div class="form-group">
                <label class="col-lg-3 control-label">QQ  登录</label>
                <div class="col-lg-8">
					<?php if ($userinfo['qq_login_openid'] == ''){ ?>
					<button id="qq_login" class="btn btn-blue" type="button"><i class="fa fa-qq"></i> 立即绑定</button>
					<button style="display:none"  id="qq_login_jiebang" class="btn btn-red" type="button"><i class="fa fa-qq"></i> 解除绑定</button>
					<?php }else{ ?>
					<button style="display:none" id="qq_login" class="btn btn-blue" type="button"><i class="fa fa-qq"></i> 立即绑定</button>
					<button  id="qq_login_jiebang" class="btn btn-red" type="button"><i class="fa fa-qq"></i> 解除绑定</button>
					<?php }?>	
                </div>
              </div>
			  <?php }?>
			  <div class="hide-ps">
              <div class="form-group">
                <label class="col-lg-3 control-label">新的密码</label>
                <div class="col-lg-8">
                  <input type="password" name="newpass" id="newpass" value="" class="bg-focus form-control">
                  <div class="line line-dashed m-t-large"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">确认密码</label>
                <div class="col-lg-8">
                  <input type="text" name="repeatpass" id="repeatpass" value="" class="form-control"><ul id="parsley-8968232219925039" class="parsley-error-list" style="display: block;"><li class="required" style="display: list-item;">请检查两次输入的密码是否一样.</li></ul>
                </div>
              </div>
			  </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">我的性别</label>
                <div class="col-lg-4">
					<label class="fasex"><?php if($userinfo["sex"]=='1'){echo '<i class="fa fa-mars"></i>';}else{echo '<i class="fa fa-venus"></i>';}; ?></label>
					<div class="radio i-checks sex hide-ps">
					<label><input type="radio" value="1" name="sex" class="mgr mgr-info" <?php if($userinfo["sex"]=='1'){?>checked="checked"<?php }?>><i></i> 小哥哥</label> 
					<label><input type="radio" value="2" name="sex" class="mgr mgr-info" <?php if($userinfo["sex"]=='2'){?>checked="checked"<?php }?>><i></i> 小姐姐</label> 
					</div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 control-label">我的简介</label>
                <div class="col-lg-8">
                  <textarea placeholder="" rows="2" cols="30" class="form-control form-xg" name="description" id="description" disabled="disabled"><?php echo htmlspecialchars($userinfo['description']); ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-9 col-offset-3"> 
					<label></label>
					<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
				  <span class="btn btn-blue xgzl">修改个人资料</span>				  
                  <input type="submit" id="update-submit" class="btn btn-green hide-xg" value="立即提交">
				  <span class="btn btn-white hide-xg qxxg">取消修改</span>
                </div>
              </div>
            </form>
			</div>
          </section>
		</div>
		<?php 
		elseif(isset($_GET['logout'])):
		setcookie(AUTH_COOKIE_NAME, ' ', time() - 31536000, '/');
		emDirect(BLOG_URL);
		endif;
		?>
	</div>

</section>
<div class="modal fade" tabindex="-1" id="up-img">
	<div class="modal-dialog am-modal-dialog up-frame-parent up-frame-radius">
		<div class="am-modal-hd up-frame-header">
		    <label>修改头像</label><span class="up-tips"></span><span class="up_img_tips" style="display:none">仅VIP支持自定义头像</span>
		    <a href="javascript: void(0)" class="am-close am-close-spin close" data-dismiss="modal">&times;</a>
		</div>
		<?php if($data['level'] != 0){ ?>
		<div class="am-modal-bd  up-frame-body" style="display:none">
		    <div class="am-g am-fl">
		      	<div class="am-form-group am-form-file">
			      <div class="am-fl">
			        <button type="button" class="am-btn am-btn-default am-btn-sm">
			          <i class="am-icon-cloud-upload"></i> 选择要上传的头像</button>
			      </div>
			      <input type="file" id="inputImage">
			   	</div>
		    </div>
		    <div class="am-g am-fl">
		      	<div class="up-pre-before up-frame-radius">
		      		<img alt="" src="" id="image">
		      	</div>
		      	<div class="up-pre-after up-frame-radius">
		      	</div>
		      </div>
		    <div class="am-g am-fl">
   				<div class="up-control-btns">
					<span class="fa fa-reply-all" onclick="imgdefault()"></span>
    				<span class="fa fa-arrow-circle-left" onclick="rotateimgleft()"></span>
    				<span class="fa fa-arrow-circle-right" onclick="rotateimgright()"></span>
    				<span class="fa fa-check-circle" id="up-btn-ok"></span>
   				</div>
	    	</div> 
			<div class="clearfloat"></div>
		</div>
		<div class="clearfloat"></div>
		<div class="up_img_body">
			<div class="up_img_list row">
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="1"><img src="<?php echo TEMPLATE_URL.'img/tx/1.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="2"><img src="<?php echo TEMPLATE_URL.'img/tx/2.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="3"><img src="<?php echo TEMPLATE_URL.'img/tx/3.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="4"><img src="<?php echo TEMPLATE_URL.'img/tx/4.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="5"><img src="<?php echo TEMPLATE_URL.'img/tx/5.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="6"><img src="<?php echo TEMPLATE_URL.'img/tx/6.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="7"><img src="<?php echo TEMPLATE_URL.'img/tx/7.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="8"><img src="<?php echo TEMPLATE_URL.'img/tx/8.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="9"><img src="<?php echo TEMPLATE_URL.'img/tx/9.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="10"><img src="<?php echo TEMPLATE_URL.'img/tx/10.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="11"><img src="<?php echo TEMPLATE_URL.'img/tx/11.jpg'?>" class="img-thumbnail"></div>
				<div class="col-sm-3 col-xs-3 up_img_div" data-id="12"><img src="<?php echo TEMPLATE_URL.'img/tx/12.jpg'?>" class="img-thumbnail"></div>
			</div>
			<div class="form-group up_img_fooer">
				<input class="btn btn-default vip_zdy" type="button" value="自定义头像">
			</div>
		</div>
		<?php }else{ ?>
		<div class="clearfloat"></div>
		<div class="up_img_list row">
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="1"><img src="<?php echo TEMPLATE_URL.'img/tx/1.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="2"><img src="<?php echo TEMPLATE_URL.'img/tx/2.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="3"><img src="<?php echo TEMPLATE_URL.'img/tx/3.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="4"><img src="<?php echo TEMPLATE_URL.'img/tx/4.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="5"><img src="<?php echo TEMPLATE_URL.'img/tx/5.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="6"><img src="<?php echo TEMPLATE_URL.'img/tx/6.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="7"><img src="<?php echo TEMPLATE_URL.'img/tx/7.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="8"><img src="<?php echo TEMPLATE_URL.'img/tx/8.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="9"><img src="<?php echo TEMPLATE_URL.'img/tx/9.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="10"><img src="<?php echo TEMPLATE_URL.'img/tx/10.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="11"><img src="<?php echo TEMPLATE_URL.'img/tx/11.jpg'?>" class="img-thumbnail"></div>
			<div class="col-sm-3 col-xs-3 up_img_div" data-id="12"><img src="<?php echo TEMPLATE_URL.'img/tx/12.jpg'?>" class="img-thumbnail"></div>
		</div>
		<div class="form-group up_img_fooer">
			<div class="btn btn-default zdy_img">自定义头像</div>
		</div>
		<?php }?>
	</div>
</div>
<?php
/**
 * 自建页面模板--会员中心
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<script>
$("#wx_pay").on('click',function(){
	$(".wxpay").show();
	$(".alipay").hide();
});	
$("#ali_pay").on('click',function(){
	$(".alipay").show();
	$(".wxpay").hide();
});	
$(".xgzl").on('click',function(){
	$(".form-xg").attr("disabled",false);  
	$(".hide-xg,.hide-ps").show();
	$(".fasex").hide();
	$(this).hide();
});
$(".qxxg").on('click',function(){
	$(".form-xg").attr("disabled","disabled");  
	$(".hide-xg,.hide-ps").hide();
	$(".xgzl,.fasex").show();
});
$('.zdy_img').on('click',function(){
	$('.up_img_tips').fadeIn();
	$('.up_img_tips').fadeOut(2000);
});
$('.up_img_div').on('click',function(){
	var id = $(this).attr("data-id");
	var url= pjaxtheme + 'inc/ajax.php?a=selectimage';
	$.ajax( {  
			url:url,  
			dataType:'json',  
			type: "POST",  
			data: {"image":id},  
			success: function(data){
				if(data.result=="ok"){
					$("#up-img-touch img").attr("src",data.file);
					var img_name=data.file.split('/')[2];
					console.log(img_name);
					$("#pic").text(img_name);
				}
				swal("温馨提示!", "修改成功", "success");
				$(".modal-backdrop").remove();
				$("body").removeClass('modal-open');
				$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });
			},
			error: function(){
				//set_alert_info("修改失败");
				swal("温馨提示!", "修改失败", "error");
			}  
	 }); 
});	
function bangdingok(){
	$('#qq_login').hide();$('#qq_login_jiebang').show();
}
$('#qq_login').on('click',function(){
		window.open(pjaxtheme + "inc/ajax.php?a=qq_bangding", "qq_bangding", "top=200,left=200,height=600, width=800, toolbar =no, menubar=no, scrollbars=no, resizable=no, location=no, status=no");
});
$('#qq_login_jiebang').on('click',function(){
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=jie_bang',
		type:'post',
		dataType:'json',
		data:{},
		success:function (data){
			if(data.code=='200'){
				$('#qq_login').show();$('#qq_login_jiebang').hide();
			}
		}
	});
});	
$('.payvip').on("click",function(){
	var key = $("#paykey").val();
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:"payvip",key:key},
		success:function (data){
			if(data.code=='200'){
				$('#pay-success').css('display','block');
				$('.pay_info').html(data.data);
				setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 1000);
			}else{
				$('#pay-danger').css('display','block');
				$('.pay_info').html(data.data)
				setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 1000);
			}
		}
	});
});
$('.log_del').on("click",function(){
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:"dellog"},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			//$('.pay-tips-info').html(data.data);
			//$('.pay-tips-modal').show();
			//setTimeout(function () {$('.pay-tips-modal').fadeOut();}, 500);
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 800);
			setTimeout(function () {$("li[role='presentation']:eq(2)").addClass('active').siblings().removeClass('active');}, 900);
			setTimeout(function () {$("div[role='tabpanel']:eq(3)").addClass('active in').siblings().removeClass('active in');}, 900);
		}
	});
});
$('.key_del').on("click",function(){
	var id = $(this).attr("data");
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:"delkey",id:id},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			//$('.pay-tips-info').html(data.data);
			//$('.pay-tips-modal').show();
			//setTimeout(function () {$('.pay-tips-modal').fadeOut();}, 500);
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 800);
			setTimeout(function () {$("li[role='presentation']:eq(1)").addClass('active').siblings().removeClass('active');}, 900);
			setTimeout(function () {$("div[role='tabpanel']:eq(2)").addClass('active in').siblings().removeClass('active in');}, 900);
		}
	});
});
$('.addvip').on("click",function(){
	var uid = $(this).attr("data-uid");
	var time = $(this).attr("data-time");
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{type:"addvip",uid:uid,time:time},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			//$('.pay-tips-info').html(data.data);
			//$('.pay-tips-modal').show();
			//setTimeout(function () {$('.pay-tips-modal').fadeOut();}, 500);
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 800);
		}
	});
});
$('.vipbtn').on("click",function(){
	var vip = $(this).attr("data");
		if(vip == 1){
			$(this).attr("data","0");
			$(this).attr("src",pjaxtheme + "img/vipoff.png");
			xiugaivip($(this).attr("userid"),"offvip");
		}else{
			$(this).attr("data","1");
			$(this).attr("src",pjaxtheme + "img/vipopen.png");
			xiugaivip($(this).attr("userid"),"openvip");
		}
});
function xiugaivip (userid,isopen){
	$.ajax({
		url:pjaxtheme + 'inc/ajax.php?a=vip',
		type:'post',
		dataType:'json',
		data:{uid:userid,type:isopen},
		success:function (data){
			swal("温馨提示!", ""+data.data+"", "success");
			//$('.pay-tips-info').html(data.data);
			//$('.pay-tips-modal').show();
			//setTimeout(function () {$('.pay-tips-modal').fadeOut();}, 500);
			setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 800);
		}
	});
}
$(document).ready(function(){
    $('#update-submit').click(function (){
		var usr = $("input[name=username]").val().replace(/(^\s*)|(\s*$)/g, "");
		var names = $("input[name=name]").val().replace(/(^\s*)|(\s*$)/g, "");
		var eml = $("input[name=email]").val().replace(/(^\s*)|(\s*$)/g, "");
		var sex = $("input[name=sex]").val().replace(/(^\s*)|(\s*$)/g, "");
		var dst = $("textarea[name=description]").val().replace(/(^\s*)|(\s*$)/g, "");
		var nwp = $("input[name=newpass]").val().replace(/(^\s*)|(\s*$)/g, "");
		var rewp = $("input[name=repeatpass]").val().replace(/(^\s*)|(\s*$)/g, "");
		var params = $('#updatefrom').serialize();
		$.ajax({
			url:pjaxtheme + 'inc/ajax.php?a=update',
			type:'post',
			dataType:'json',
			data:params,
			success:ajax_update
		});
		return false;
	});
});
$(document).ready(function(){
    $('#postnew').click(function (){
		var title = $("input[name=post_title]").val().replace(/(^\s*)|(\s*$)/g, "");
		var content = tinyMCE.get('editor_content').getContent();
		var category = $("select[name=post_category]").val().replace(/(^\s*)|(\s*$)/g, "");
			$.ajax({
				type: 'POST',
				url: pjaxtheme + 'inc/ajax.php?a=addlog',
				data: "post_title="+ title + "&post_content=" + content + "&post_category=" + category,
				dataType: 'json',
				success: ajax_addlog
			});
		return false;
	});
});
function ajax_addlog(json) {
	$('.spinner').html('<font color="red">' + json.info + '</font>');
	if(json.code=='200'){
		setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 500);
	}
}
function ajax_update(json) {
	$('.message').html('<font color="red">' + json.info + '</font>');
	if(json.code=='200'){
		setTimeout(function () {$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });}, 500);
	}
}
$(function() {
    'use strict';
    var $image = $('#image');
    $image.cropper({
        aspectRatio: '1',
        autoCropArea:0.8,
        preview: '.up-pre-after',
        
    });
    
    var $inputImage = $('#inputImage');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
        $inputImage.change(function () {
            var files = this.files;
            var file;

            if (files && files.length) {
               file = files[0];

               if (/^image\/\w+$/.test(file.type)) {
                    blobURL = URL.createObjectURL(file);
                    $image.one('built.cropper', function () {
                       URL.revokeObjectURL(blobURL);
                    }).cropper('reset').cropper('replace', blobURL);
                    $inputImage.val('');
                } else {
                    window.alert('Please choose an image file.');
                }
            }

            var fileNames = '';
            $.each(this.files, function() {
                fileNames += '<span class="am-badge">' + this.name + '</span> ';
            });
            $('#file-list').html(fileNames);
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }
    $('#up-btn-ok').on('click',function(){
    	var img_src=$image.attr("src");
    	if(img_src==""){
			swal("温馨提示!", "没有选择上传的图片", "error");
    		//set_alert_info("没有选择上传的图片");
    		return false;
    	}
    	
    	var url= pjaxtheme + 'inc/ajax.php?a=upimage';
    	var canvas=$("#image").cropper('getCroppedCanvas');
    	var data=canvas.toDataURL();
        $.ajax( {  
                url:url,  
                dataType:'json',  
                type: "POST",  
                data: {"image":data.toString()},  
                success: function(data, textStatus){
                	if(data.result=="ok"){
                		$("#up-img-touch img").attr("src",data.file);
                		var img_name=data.file.split('/')[2];
                		console.log(img_name);
                		$("#pic").text(img_name);
                	}
					swal("温馨提示!", "头像上传成功！", "success");
					$(".modal-backdrop").remove();
					$("body").removeClass('modal-open');
					$.pjax.reload(pjax_id, {fragment: pjax_id,timeout: 8000 });
                },
                error: function(){
					swal("温馨提示!", "上传文件失败了！", "error");
                	//set_alert_info("上传文件失败了！");
                }  
         });  
    	
    });
    
});
$('.vip_zdy').on('click',function(){
	$(".up-frame-body").show();$('.up_img_body').hide();
});

function imgdefault() {
$(".up_img_body").show();$('.up-frame-body').hide();
}

function rotateimgright() {
$("#image").cropper('rotate', 90);
}

function rotateimgleft() {
$("#image").cropper('rotate', -90);
}

function set_alert_info(content){
	$(".up-tips").html(content);
}
</script>
<?php
include View::getView('footer');
else:
emDirect(BLOG_URL);
endif;
?>
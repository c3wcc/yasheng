<?php 
/**
 * 站点首页list
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<!--主题框架开始-->
<div class="container">
<!--左侧开始-->
	<section class="mysection">
	<?php if($page==1){huandeng();} ?>
		<div class="arclist">
		<h4 class="index-title"> 
		<a href="/"><i class="el-th-list"></i>首页  &nbsp;&nbsp;> &nbsp;&nbsp;</a> 
		<?php if ($params[1]=='sort'){ ?>
		<?php echo '<a href="'.Url::sort($sortid).'">'.$sortName.'</a>';?>
		<?php }elseif ($params[1]=='page'){ ?>
					<span class="orange-text">所有文章</span>
		<?php }elseif ($params[1]=='tag'){ ?>
					<span class="orange-text">包含标签 <b><?php echo urldecode($params[2]);?></b> 的所有文章</span>
		<?php }elseif($params[1]=='author'){ ?>
		<span class="orange-text">作者 <b><?php echo blog_author($author);?></b> 的所有文章</span>		
		<?php }elseif($params[1]=='keyword'){ ?>
		<span class="orange-text">搜索 <b><?php echo urldecode($params[2]);?></b> 的结果</span>
		<?php }else{?><?php }?>
		
	</h4>
		<?php doAction('index_loglist_top'); ?>
		<?php if (!empty($logs)): ?>
			<!--列表开始-->
			<ul>
				<?php foreach($logs as $value): ?>
				<?php if(((date('Ymd',time())-date('Ymd',$value['date']))<=15)&&($value['top']=='n')){echo "<li id=\"New\">";}else{echo "<li>";}?>
					<div class="arcimg">
					<a href="<?php echo $value['log_url'];?>" title="<?php echo $value['log_title'];?>">
						<img alt="<?php echo $value['log_title'];?>" src="<?php get_imgsrc($value['content']);?>" title="<?php echo $value['log_title'];?>">
					</a>
					</div>
					<div class="arc-right">
						<h4 class="blue-text">
						<?php if($value['top']=='y'): ?>
						<span class="good-label">置顶</span><i class="good-arrow"></i>
						<?php endif;?>
						<a href="<?php echo $value['log_url'];?>" title="<?php echo $value['log_title'];?>"><?php echo $value['log_title'];?></a>
						</h4>
						<p><?php echo subString(DeleteHtml(strip_tags($value['content'])),0,174); //文章简述 ?></p>
						<ul>
							<li><a title="发表时间 "><i class="el-time"></i><?php echo gmdate('n-j', $value['date']);?></a></li>
							<li><a href="#" ><i class="el-user"></i><?php blog_author($value['author']); ?></a></li>
							<li><a href="#"title="已有 <?php echo $value['comnum'];?> 条评论"><i class="el-comment"></i><?php echo $value['comnum'];?></a></li>
							<li><a title="已有 <?php echo $value['views'];?> 次浏览"><i class="el-eye-open"></i><?php echo $value['views'];?></a></li>
							<li><a href="#" title="查看分类"><i class="el-th-list"></i><?php blog_sorts($value['logid']);?></a></li>
						</ul>
					</div>
				</li>
				<?php endforeach;?>
				<div id="pagenavi">
				<?php echo $page_url;?>
				</div>
			</ul>
			<!--列表结束-->
			<?php else:?>
			<div>未找到文章！</div>
			<?php endif;?>
		</div>
<!--分页-->
	</section>
<!--左侧结束-->
<!-- 引入侧边 -->
<?php include View::getView('side');?>
</div>
<!--主题框架结束-->
<!-- 引入底部 -->
<?php include View::getView('footer');?>

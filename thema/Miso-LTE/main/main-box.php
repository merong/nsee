<?php
if (!defined('_GNUBOARD_')) exit; // can not connect self

// set wiget setting id head
$wshid = 'lte-box';

?>

<style>
	.at-content .main-box { border:1px solid #ddd; margin-bottom:16px; background:#fff; padding:12px; }
	.at-content .main-title { border:1px solid #ddd; margin-bottom:16px; background:#fff; padding:4px; display: block; }
	.at-content .main-head { border-bottom:1px solid #ddd; margin:0px 0px 12px; font-weight:bold; padding-bottom:3px; }
	.at-content .main-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
	.at-content .main-p10 { padding:10px; }
	.at-content .main-tab { border-right:1px solid #ddd; border-top:1px solid #ddd; }
	.at-content .main-tab .nav { margin-top:-1px !important; }
	.at-content .trans-top.tabs.div-tab .main-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.at-content .main-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.at-content .tabs { margin-bottom:16px !important; }
	.at-content .tab-content { padding:10px !important; }
</style>
<div class="content">
	<div class="at-content">
		<div class="at-wrap">
			<!-- Main part -->
			<div class="at-main">

				<!-- Start //-->
				<div class="title">
					<?php //title
					$classname = uuidgen();
						if(G5_IS_MOBILE) { //mobile title
							echo '<div class="'.$classname.'">
								<div style="width:100%; height:70px; line-height:50px; text-align:center; background:#FFFFFF; style="margin:0 auto;">
								<a href="/bbs/board.php?bo_table=noti&wr_id=39661" target="_blank"><img align="left" src="/imgs/empty.png" width="49.7%" height="100%"></a>
								<a href="https://hanstar1004.com" target="_blank"><img align="right" src="/imgs/hanstar_main.gif" width="49.7%" height="100%"></a>
								</div>
							</div>';
						} else { //PC title
							echo '<div class="'.$classname.'">
								<div style="width:100%; height:100px; line-height:20px; text-align:center; background:#FFFFFF; style="margin:0 auto;">
								<a href="/bbs/board.php?bo_table=noti&wr_id=39661" target="_blank"><img align="left" src="/imgs/empty.png" width="49.7%" height="100%"></a>
								<a href="https://hanstar1004.com" target="_blank"><img align="right" src="/imgs/hanstar_main.gif" width="49.7%" height="100%"></a>
								</div>
							</div>';
						}
					?>
				</div>
				<!--// End -->
			

				<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=noti">
									<span class="pull-right main-more">+More</span>
									Notice
								</a>
							</div>
							<?php echo apms_widget('miso-post-mix', $wshid.'-mix-m2', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
						</div>
				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=korea">
							<span class="pull-right main-more">+More</span>
							KBJ
						</a>
					</div>
					<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m1', 'center=1'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=javc">
							<span class="pull-right main-more">+More</span>
							Jav censored
						</a>
					</div>
					<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m2', 'center=2'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=caption">
							<span class="pull-right main-more">+More</span>
							Jav Caption
						</a>
					</div>
					<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m6', 'center=2'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=javu">
							<span class="pull-right main-more">+More</span>
							JAV Uncensored
						</a>
					</div>
					<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m3', 'center=3'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=western">
							<span class="pull-right main-more">+More</span>
							Western
						</a>
					</div>
					<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m4', 'center=4'); ?>
				</div>
				<!--// End -->


				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=community">
							<span class="pull-right main-more">+More</span>
							Forum
						</a>
					</div>
					<?php echo apms_widget('miso-post-list', $wshid.'-list-m2', 'garo=1 rows=20 icon={아이콘:caret-right} date=1'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=qna">
							<span class="pull-right main-more">+More</span>
							QnA
						</a>
					</div>
					<?php echo apms_widget('miso-post-list', $wshid.'-list-m3', 'garo=1 rows=20 icon={아이콘:caret-right} date=1'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
							New Update
					</div>
					<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m5', 'center=1'); ?>
				</div>
				<!--// End -->
			</div><!-- .at-main -->

			<!-- side part -->
			<div class="at-side">
				
				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<div style="width:100%; height:260px; line-height:260px; text-align:center; background:#FFFFFF;">
						<a href="http://mex-see04.com">
						<img src="/imgs/a_mex.gif" width="100%" height="100%"></a>
						</div>
					</div>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
							Best Recommend
						</a>
					</div>
					<?php echo apms_widget('miso-post-mix', $wshid.'-mix-s1', 'rank=orange date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<a href="<?php echo $at_href['new'];?>?view=c">
							<span class="pull-right main-more">+More</span>
							New Comment
						</a>
					</div>
					<?php echo apms_widget('miso-post-icon', $wshid.'-comment-s1', 'comment=1'); ?>
				</div>
				<!--// End -->
				
			

			</div><!-- .at-side -->
		</div><!-- .at-wrap -->
	</div><!-- .at-content -->
</div><!-- .content -->

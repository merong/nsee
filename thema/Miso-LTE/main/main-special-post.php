<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-spp';

?>

<style>
	.content-wrapper { background:#f5f5f5; }
	.main-wrap { padding:15px; }
	.main-wrap .main-box { border:1px solid #ddd; margin-bottom:15px; margin-right:15px; background:#fff; padding:12px; }
	.main-wrap .main-head { border-bottom:1px solid #ddd; margin:0px 0px 12px; font-weight:bold; padding-bottom:3px; }
	.main-wrap .main-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
	.main-wrap .main-p10 { padding:10px; }
	.main-wrap .main-tab { border-right:1px solid #ddd; border-top:1px solid #ddd; }
	.main-wrap .main-tab .nav { margin-top:-1px !important; }
	.main-wrap .trans-top.tabs.div-tab .main-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.main-wrap .main-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.main-wrap .tabs { margin-bottom:16px !important; }
	.main-wrap .tab-content { padding:10px !important; }

	/* Grid */
	.main-grid { display:table; width:100%; table-layout:fixed; }
	.main-left { display:table-cell; vertical-align:top; padding-right:15px; }
	.main-right { width:272px; display:table-cell; vertical-align:top; }
	.main-right .main-box { margin-right:0px; }
	@media all and (max-width:767px) {
		.responsive .main-grid { display:block; width:100%; table-layout:auto; }
		.responsive .main-left { width:100%; display:block; vertical-align:top; padding-right:0px; }
		.responsive .main-right { width:100%; display:block; vertical-align:top; margin-top:15px; }
	}
</style>
<div class="main-wrap">
	<div class="main-grid">
		<div class="main-left">

			<?php echo apms_widget('miso-post-blog', $wshid.'-blog-m1', 'item=4 lg=2 md=2 sm=2'); ?>

			<div class="clearfix"></div>

		</div><!-- .main-left -->

		<div class="main-right">

			<!-- Start //-->
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right main-more">+더보기</span>
						이벤트
					</a>
				</div>
				<?php echo apms_widget('miso-post-owl', $wshid.'-event-m1', 'rows=5 item=1 lg=1 md=1 sm=2 nav=1 rdm=1 caption=2'); ?>
			</div>
			<!--// End -->

			<!-- Start //-->
			<div id="notice_tab" class="div-tab tabs swipe-tab trans-top">
				<div class="main-tab bg-white">
					<ul class="nav nav-tabs" data-toggle="tab-hover">
						<li class="active"><a href="#main_notice" data-toggle="tab">공지</a></li>
						<li><a href="#main_faq" data-toggle="tab">FAQ</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="main_notice">
						<?php echo apms_widget('miso-post-list', $wshid.'-notice-s1', 'date=1 icon={아이콘:bell}'); ?>
					</div>
					<div class="tab-pane" id="main_faq">
						<?php echo apms_widget('miso-faq-list', $wshid.'-faq-s1', 'icon={아이콘:question-circle}'); ?>
					</div>
				</div>
			</div>
			<!--// End -->

			<!-- Start //-->
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo $at_href['new'];?>?view=c">
						<span class="pull-right main-more">+더보기</span>
						새댓글
					</a>
				</div>
				<?php echo apms_widget('miso-post-icon', $wshid.'-comment-s1', 'comment=1'); ?>
			</div>
			<!--// End -->

			<!-- Start //-->
			<div id="misc_tab" class="div-tab tabs swipe-tab trans-top">
				<div class="main-tab bg-white">
					<ul class="nav nav-tabs" data-toggle="tab-hover">
						<li class="active"><a href="#main_popular" data-toggle="tab">검색</a></li>
						<li><a href="#main_tag" data-toggle="tab">태그</a></li>
						<li><a href="#main_member" data-toggle="tab">멤버</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div class="tab-pane active" id="main_popular">
						<?php echo apms_widget('miso-popular-list', $wshid.'-popular-s1', 'rank=lightgreen rows=10'); ?>
					</div>
					<div class="tab-pane" id="main_tag">
						<?php echo apms_widget('miso-tag-list', $wshid.'-tag-s1', 'rank=deepblue rows=10'); ?>
					</div>
					<div class="tab-pane" id="main_member">
						<?php echo apms_widget('miso-member-list', $wshid.'-member-s1', 'mode=point rank=orangered rows=10'); ?>
					</div>
				</div>
			</div>
			<!--// End -->

			<!-- Start //-->
			<?php
				//설문조사
				$is_poll_list = apms_widget('miso-poll', $wshid.'-poll', 'icon={아이콘:commenting}');
				if($is_poll_list) {
			?>
			<div class="main-box">
				<div class="main-head">
					설문조사
				</div>
				<?php echo $is_poll_list; ?>
			</div>
			<?php } ?>
			<!--// End -->

			<!-- Start //-->
			<div class="main-box main-p10">
				<div style="width:100%; height:260px; line-height:260px; text-align:center; background:#f5f5f5;">
					반응형 구글광고 등
				</div>
			</div>
			<!--// End -->

		</div><!-- .main-right -->

	</div><!-- .main-grid -->
</div><!-- .main-wrap -->

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-spa';

// 메이슨리
apms_script('imagesloaded');
apms_script('masonry');

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

	/* Masonry */
	.main-wrap .main-row { overflow:hidden; margin:0px -15px -15px 0px; }
	.main-wrap .main-col { float:left; width:20%; margin:0px; padding:0px; }
	.main-wrap .main-col2 { width:40%; }
	@media (max-width:1499px) { 
		.responsive .main-wrap .main-col { width:25%; } 
		.responsive .main-wrap .main-col2 { width:50%; }
	}
	@media (max-width:1199px) { 
		.responsive .main-wrap .main-col { width:33.3%; } 
		.responsive .main-wrap .main-col2 { width:66.6%; }
	}
	@media (max-width:991px) { 
		.responsive .main-wrap .main-col { width:50%; } 
		.responsive .main-wrap .main-col2 { width:100%; }
	}
	@media (max-width:767px) { 
		.responsive .main-wrap .main-col { width:50%; }
		.responsive .main-wrap .main-col2 { width:100%; }
	}
	@media (max-width:480px) { 
		.responsive .main-wrap .main-col { width:100%; } 
		.responsive .main-wrap .main-col2 { width:100%; }
	}
</style>
<div class="main-wrap">
	<div id="main-special" class="main-row">

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right main-more">+더보기</span>
						헤드라인
					</a>
				</div>
				<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m1', 'irows=1 date=1 rdm=1 caption=2 icon={아이콘:paper-plane}'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right main-more">+더보기</span>
						갤러리
					</a>
				</div>
				<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m1', 'rows=8 item=2 lg=2 md=2 sm=2 center=1'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right main-more">+더보기</span>
						게시판
					</a>
				</div>
				<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m2', 'irows=2 rank=orangered rows=10 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right main-more">+더보기</span>
						웹진
					</a>
				</div>
				<?php echo apms_widget('miso-post-webzine', $wshid.'-webzine-m1', 'rows=8 line=2 item=1 lg=1 md=1 sm=1 date=1 bold=1'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right main-more">+더보기</span>
						게시판
					</a>
				</div>
				<?php echo apms_widget('miso-post-mix', $wshid.'-mix-m1', 'idate=1 rows=10 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right main-more">+더보기</span>
						게시판
					</a>
				</div>
				<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m3', 'irows=3 rows=10 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right main-more">+더보기</span>
						게시판
					</a>
				</div>
				<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'rows=10 date=1 icon={아이콘:caret-right}'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo $at_href['faq'];?>">
						<span class="pull-right main-more">+더보기</span>
						FAQ
					</a>
				</div>
				<?php echo apms_widget('miso-faq-list', $wshid.'-faq-s1', 'rows=10 icon={아이콘:question-circle}'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo $at_href['new'];?>?view=c">
						<span class="pull-right main-more">+더보기</span>
						새댓글
					</a>
				</div>
				<?php echo apms_widget('miso-post-icon', $wshid.'-comment-s1', 'comment=1 rows=10'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					검색어
				</div>
				<?php echo apms_widget('miso-popular-list', $wshid.'-popular-s1', 'rank=lightgreen rows=10'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo $at_href['tag'];?>">
						<span class="pull-right main-more">+더보기</span>
						태그
					</a>
				</div>
				<?php echo apms_widget('miso-tag-list', $wshid.'-tag-s1', 'rank=deepblue rows=10'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="pull-right main-more">+더보기</span>
						멤버
					</a>
				</div>
				<?php echo apms_widget('miso-member-list', $wshid.'-member-s1', 'mode=point rank=orangered rows=10'); ?>
			</div>
		</div>
		<!--// End -->

		<!-- Start //-->
		<?php
			//설문조사
			$is_poll_list = apms_widget('miso-poll', $wshid.'-poll', 'icon={아이콘:commenting}');
			if($is_poll_list) {
		?>
		<div class="main-col">
			<div class="main-box">
				<div class="main-head">
					설문조사
				</div>
				<?php echo $is_poll_list; ?>
			</div>
		</div>
		<?php } ?>
		<!--// End -->

		<!-- Start //-->
		<div class="main-col">
			<div class="main-box main-p10">
				<div style="width:100%; height:260px; line-height:260px; text-align:center; background:#f5f5f5;">
					반응형 구글광고 등
				</div>
			</div>
		</div>
		<!--// End -->

	</div><!-- .main-row -->
	<div class="clearfix"></div>
</div><!-- .main-wrap -->

<script>
	$(function(){
		var $msy = $('#main-special');
		$msy.imagesLoaded(function(){
			$msy.masonry({
				columnWidth : '.main-col',
				itemSelector : '.main-col',
				percentPosition: true,
				isAnimated: true
			});
		});

		$(".sidebar-toggle").on('click', function(){
			setTimeout(function(){ $msy.masonry('layout'); }, 500);
		});

		$(".main-sidebar").on('hover', function(){
			setTimeout(function(){ 
				$(".sidebar-expanded-on-hover .main-sidebar").mouseover(function() { 
					$msy.masonry('layout');
				}).mouseout(function() { 
					setTimeout(function(){ $msy.masonry('layout'); }, 500);
				});
			}, 500);
		});
	});
</script>

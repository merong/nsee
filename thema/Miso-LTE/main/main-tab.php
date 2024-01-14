<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-tab';

?>

<style>
	.at-content .main-box { border:1px solid #ddd; margin-bottom:16px; background:#fff; }
	.at-content .main-more { margin:8px 0px 0px; }
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
			<!-- 메인 영역 -->
			<div class="at-main">

				<!-- Start //-->
				<div class="main-box main-p10">
					<?php //타이틀
						if(G5_IS_MOBILE) { //모바일 타이틀
							echo apms_widget('miso-title-owl', $wshid.'-title-m', 'caption=4 height=35 xs=50');
						} else { //PC 타이틀
							echo apms_widget('miso-title-nivo', $wshid.'-title-pc', 'caption=4 height=35 xs=50');
						}
					?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="div-tab tabs trans-top">
					<div class="main-tab bg-light">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">헤드라인</a>
							</li>
						</ul>
						<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
							+ 더보기
						</a>
					</div>
					<div class="tab-content">
						<div class="tab-pane active">
							<?php echo apms_widget('miso-post-owl', $wshid.'-headline-m1', 'auto=0 rows=7 item=3 lg=2 md=3 sm=2 nav=1 rdm=1 center=1 date=1 bold=1 cate=1 line=3'); ?>
						</div>
					</div>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div id="gallery_tab" class="div-tab tabs swipe-tab trans-top">
					<div class="main-tab bg-light">
						<ul class="nav nav-tabs" data-toggle="tab-hover">
							<li class="active"><a href="#gallery_m1" data-toggle="tab">갤러리</a></li>
							<li><a href="#gallery_m2" data-toggle="tab">베스트</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="gallery_m1">
							<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m1', 'center=1'); ?>
							<div class="text-right main-more">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="text-muted">+ 갤러리 더보기</span>
								</a>
							</div>
						</div>
						<div class="tab-pane" id="gallery_m2">
							<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m2', 'sort=hit rank=orangered center=1'); ?>
							<div class="text-right main-more">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="text-muted">+ 갤러리 더보기</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div id="webzine_tab" class="div-tab tabs swipe-tab trans-top">
					<div class="main-tab bg-light">
						<ul class="nav nav-tabs" data-toggle="tab-hover">
							<li class="active"><a href="#webzine_m1" data-toggle="tab">웹진</a></li>
							<li><a href="#webzine_m2" data-toggle="tab">베스트</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="webzine_m1">
							<?php echo apms_widget('miso-post-webzine', $wshid.'-webzine-m1', 'date=1 bold=1'); ?>
							<div class="text-right main-more">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="text-muted">+ 웹진 더보기</span>
								</a>
							</div>
						</div>
						<div class="tab-pane" id="webzine_m2">
							<?php echo apms_widget('miso-post-webzine', $wshid.'-webzine-m2', 'sort=hit rank=orange date=1 bold=1'); ?>
							<div class="text-right main-more">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="text-muted">+ 웹진 더보기</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!--// End -->

				<div class="row row-15">
					<div class="col-lg-6 col-15">

						<!-- Start //-->
						<div class="div-tab tabs trans-top">
							<div class="main-tab bg-light">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">게시판</a>
									</li>
								</ul>
								<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									+ 더보기
								</a>
							</div>
							<div class="tab-content">
								<div class="tab-pane active">
									<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m1', 'irows=3 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
								</div>
							</div>
						</div>
						<!--// End -->

					</div>
					<div class="col-lg-6 col-15">

						<!-- Start //-->
						<div class="div-tab tabs trans-top">
							<div class="main-tab bg-light">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">게시판</a>
									</li>
								</ul>
								<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									+ 더보기
								</a>
							</div>
							<div class="tab-content">
								<div class="tab-pane active">
									<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m2', 'irows=3 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
								</div>
							</div>
						</div>
						<!--// End -->

					</div>
				</div>

				<div class="row row-15">
					<div class="col-lg-6 col-15">

						<!-- Start //-->
						<div class="div-tab tabs trans-top">
							<div class="main-tab bg-light">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">게시판</a>
									</li>
								</ul>
								<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									+ 더보기
								</a>
							</div>
							<div class="tab-content">
								<div class="tab-pane active">
									<?php echo apms_widget('miso-post-mix', $wshid.'-mix-m1', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
								</div>
							</div>
						</div>
						<!--// End -->
					
					</div>
					<div class="col-lg-6 col-15">

						<!-- Start //-->
						<div class="div-tab tabs trans-top">
							<div class="main-tab bg-light">
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">게시판</a>
									</li>
								</ul>
								<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									+ 더보기
								</a>
							</div>
							<div class="tab-content">
								<div class="tab-pane active">
									<?php echo apms_widget('miso-post-mix', $wshid.'-mix-m2', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
								</div>
							</div>
						</div>
						<!--// End -->

					</div>
				</div>


				<!-- Start //-->
				<div id="board_tab" class="div-tab tabs swipe-tab trans-top">
					<div class="main-tab bg-light">
						<ul class="nav nav-tabs" data-toggle="tab-hover">
							<li class="active"><a href="#board_m1" data-toggle="tab">게시판</a></li>
							<li><a href="#board_m2" data-toggle="tab">베스트</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="board_m1">
							<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'garo=1 rows=20 icon={아이콘:caret-right} date=1'); ?>
							<div class="text-right main-more">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="text-muted">+ 게시판 더보기</span>
								</a>
							</div>
						</div>
						<div class="tab-pane" id="board_m2">
							<?php echo apms_widget('miso-post-list', $wshid.'-list-m2', 'garo=1 sort=hit rank=deepblue rows=20 icon={아이콘:caret-right} date=1'); ?>
							<div class="text-right main-more">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="text-muted">+ 게시판 더보기</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="div-tab tabs trans-top">
					<div class="main-tab bg-light">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">게시판</a>
							</li>
						</ul>
						<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
							+ 더보기
						</a>
					</div>
					<div class="tab-content">
						<div class="tab-pane active">
							<?php echo apms_widget('miso-post-list', $wshid.'-list-m3', 'garo=1 rows=20 icon={아이콘:caret-right} date=1'); ?>
						</div>
					</div>
				</div>
				<!--// End -->

			</div><!-- .at-main -->

			<!-- 사이드 영역 -->
			<div class="at-side">

				<!-- Start //-->
				<div class="div-tab tabs trans-top">
					<div class="main-tab bg-light">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">베스트</a>
							</li>
						</ul>
						<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
							+ 더보기
						</a>
					</div>
					<div class="tab-content">
						<div class="tab-pane active">
							<?php echo apms_widget('miso-post-multi', $wshid.'-multi-s1', 'rank=orangered date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
						</div>
					</div>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="div-tab tabs trans-top">
					<div class="main-tab bg-light">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">인기글</a>
							</li>
						</ul>
						<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
							+ 더보기
						</a>
					</div>
					<div class="tab-content">
						<div class="tab-pane active">
							<?php echo apms_widget('miso-post-mix', $wshid.'-mix-s1', 'rank=orange date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
						</div>
					</div>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="div-tab tabs trans-top">
					<div class="main-tab bg-light">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">이벤트</a>
							</li>
						</ul>
						<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
							+ 더보기
						</a>
					</div>
					<div class="tab-content">
						<div class="tab-pane active">
							<?php echo apms_widget('miso-post-owl', $wshid.'-event-s1', 'rows=5 item=1 lg=1 md=3 sm=2 nav=1 rdm=1 caption=2'); ?>
						</div>
					</div>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div id="notice_tab" class="div-tab tabs swipe-tab trans-top">
					<div class="main-tab bg-light">
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
				<div class="div-tab tabs trans-top">
					<div class="main-tab bg-light">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="<?php echo $at_href['new'];?>?view=c">새댓글</a>
							</li>
						</ul>
						<a class="pull-right tab-more" href="<?php echo $at_href['new'];?>?view=c">
							+ 더보기
						</a>
					</div>
					<div class="tab-content">
						<div class="tab-pane active">
							<?php echo apms_widget('miso-post-icon', $wshid.'-comment-s1', 'comment=1'); ?>
						</div>
					</div>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div id="misc_tab" class="div-tab tabs swipe-tab trans-top">
					<div class="main-tab bg-light">
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

				<?php
					//설문조사
					$is_poll_list = apms_widget('miso-poll', $wshid.'-poll', 'icon={아이콘:commenting}');
					if($is_poll_list) {
				?>
					<div class="div-tab tabs trans-top">
						<div class="main-tab bg-light">
							<ul class="nav nav-tabs">
								<li class="active">
									<a>설문조사</a>
								</li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active">
								<?php echo $is_poll_list; ?>
							</div>
						</div>
					</div>
				<?php  } ?>

				<!-- Start //-->
				<div class="main-box main-p10">
					<div style="width:100%; height:260px; line-height:260px; text-align:center; background:#f5f5f5;">
						반응형 구글광고 등
					</div>
				</div>
				<!--// End -->

			</div><!-- .at-side -->
		</div><!-- .at-wrap -->
	</div><!-- .at-content -->
</div><!-- .content -->

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-line';

// 헤더라인색 : darkred, crimson, red, orangered, orange, green, lightgreen, deepblue, blue, skyblue, navy, violet, yellow, darkgray, gray, lightgray, black, white
$headline = 'orangered';

?>

<style>
	.at-content .div-title-underbar-bold { padding-bottom:2px; }
	.at-content .main-box { margin:15px 0px 30px; }
	.at-content .main-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
	.at-content .main-p10 { padding:10px; }
	.at-content .tabs.div-tab .main-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.at-content .main-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.at-content .tabs { margin-bottom:30px !important; }
	.at-content .tab-content { border:0px !important; padding:15px 0px 0px !important; }

</style>
<div class="content">
	<div class="at-content">
		<div class="at-wrap">
			<!-- 메인 영역 -->
			<div class="at-main">

				<!-- Start //-->
				<?php //타이틀
					if(G5_IS_MOBILE) { //모바일 타이틀
						echo apms_widget('miso-title-owl', $wshid.'-title-m', 'caption=4 height=35 xs=50');
					} else { //PC 타이틀
						echo apms_widget('miso-title-nivo', $wshid.'-title-pc', 'caption=4 height=35 xs=50');
					}
				?>
				<!--// End -->

				<div class="h15"></div>

				<!-- Start //-->
				<div class="div-title-underbar">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>헤드라인</b>
						</span>
						<span class="pull-right main-more">
							+ 더보기
						</span>
					</a>
				</div>
				<div class="main-box">
					<?php echo apms_widget('miso-post-owl', $wshid.'-headline-m1', 'auto=0 rows=7 item=3 lg=2 md=3 sm=2 nav=1 rdm=1 center=1 date=1 bold=1 cate=1 line=3'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="div-title-underbar">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>갤러리</b>
						</span>
						<span class="pull-right main-more">
							+ 더보기
						</span>
					</a>
				</div>
				<div class="main-box">
					<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m1', 'center=1'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="div-title-underbar">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>웹진</b>
						</span>
						<span class="pull-right main-more">
							+ 더보기
						</span>
					</a>
				</div>
				<div class="main-box">
					<?php echo apms_widget('miso-post-webzine', $wshid.'-webzine-m1', 'date=1 bold=1'); ?>
				</div>
				<!--// End -->

				<div class="row row-15">
					<div class="col-lg-6 col-15">

						<!-- Start //-->
						<div class="div-title-underbar">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
								<span class="div-title-underbar-bold border-<?php echo $headline;?>">
									<b>게시판</b>
								</span>
								<span class="pull-right main-more">
									+ 더보기
								</span>
							</a>
						</div>
						<div class="main-box">
							<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m1', 'irows=3 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
						</div>
						<!--// End -->

					</div>
					<div class="col-lg-6 col-15">

						<!-- Start //-->
						<div class="div-title-underbar">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
								<span class="div-title-underbar-bold border-<?php echo $headline;?>">
									<b>게시판</b>
								</span>
								<span class="pull-right main-more">
									+ 더보기
								</span>
							</a>
						</div>
						<div class="main-box">
							<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m2', 'irows=3 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
						</div>
						<!--// End -->

					</div>
				</div>

				<div class="row row-15">
					<div class="col-lg-6 col-15">

						<!-- Start //-->
						<div class="div-title-underbar">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
								<span class="div-title-underbar-bold border-<?php echo $headline;?>">
									<b>게시판</b>
								</span>
								<span class="pull-right main-more">
									+ 더보기
								</span>
							</a>
						</div>
						<div class="main-box">
							<?php echo apms_widget('miso-post-mix', $wshid.'-mix-m1', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
						</div>
						<!--// End -->
					
					</div>
					<div class="col-lg-6 col-15">

						<!-- Start //-->
						<div class="div-title-underbar">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
								<span class="div-title-underbar-bold border-<?php echo $headline;?>">
									<b>게시판</b>
								</span>
								<span class="pull-right main-more">
									+ 더보기
								</span>
							</a>
						</div>
						<div class="main-box">
							<?php echo apms_widget('miso-post-mix', $wshid.'-mix-m2', 'idate=1 date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
						</div>
						<!--// End -->

					</div>
				</div>

				<!-- Start //-->
				<div class="div-title-underbar">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>게시판</b>
						</span>
						<span class="pull-right main-more">
							+ 더보기
						</span>
					</a>
				</div>
				<div class="main-box">
					<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'garo=1 rows=20 icon={아이콘:caret-right} date=1'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="div-title-underbar">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>게시판</b>
						</span>
						<span class="pull-right main-more">
							+ 더보기
						</span>
					</a>
				</div>
				<div class="main-box">
					<?php echo apms_widget('miso-post-list', $wshid.'-list-m2', 'garo=1 rows=20 icon={아이콘:caret-right} date=1'); ?>
				</div>
				<!--// End -->

			</div><!-- .at-main -->

			<!-- 사이드 영역 -->
			<div class="at-side">

				<!-- Start //-->
				<div class="div-title-underbar">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>베스트</b>
						</span>
						<span class="pull-right main-more">
							+ 더보기
						</span>
					</a>
				</div>
				<div class="main-box">
					<?php echo apms_widget('miso-post-multi', $wshid.'-multi-s1', 'rank=orangered date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="div-title-underbar">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>인기글</b>
						</span>
						<span class="pull-right main-more">
							+ 더보기
						</span>
					</a>
				</div>
				<div class="main-box">
					<?php echo apms_widget('miso-post-mix', $wshid.'-mix-s1', 'rank=orange date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div class="div-title-underbar">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>이벤트</b>
						</span>
						<span class="pull-right main-more">
							+ 더보기
						</span>
					</a>
				</div>
				<div class="main-box">
					<?php echo apms_widget('miso-post-owl', $wshid.'-event-s1', 'rows=5 item=1 lg=1 md=3 sm=2 nav=1 rdm=1 caption=2'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div id="notice_tab" class="div-tab tabs tabs-<?php echo $headline;?>-top swipe-tab">
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
				<div class="div-title-underbar">
					<a href="<?php echo $at_href['new'];?>?view=c">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>새댓글</b>
						</span>
						<span class="pull-right main-more">
							+ 더보기
						</span>
					</a>
				</div>
				<div class="main-box">
					<?php echo apms_widget('miso-post-icon', $wshid.'-comment-s1', 'comment=1'); ?>
				</div>
				<!--// End -->

				<!-- Start //-->
				<div id="misc_tab" class="div-tab tabs tabs-<?php echo $headline;?>-top swipe-tab">
					<div class="main-tab">
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
					<div class="div-title-underbar">
						<span class="div-title-underbar-bold border-<?php echo $headline;?>">
							<b>설문조사</b>
						</span>
					</div>
					<div class="main-box">
						<?php echo $is_poll_list; ?>
					</div>
				<?php  } ?>

				<!-- Start //-->
				<div class="main-box">
					<div style="width:100%; height:260px; line-height:260px; text-align:center; background:#f5f5f5;">
						반응형 구글광고 등
					</div>
				</div>
				<!--// End -->

			</div><!-- .at-side -->
		</div><!-- .at-wrap -->
	</div><!-- .at-content -->
</div><!-- .content -->

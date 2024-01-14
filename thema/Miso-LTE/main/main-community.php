<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-cmu';

?>

<style>
	.at-content .main-box { border:1px solid #ddd; margin-bottom:16px; background:#fff; padding:12px; }
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

		<!-- Start //-->
		<div class="main-box">
			<?php //타이틀
				if(G5_IS_MOBILE) { //모바일 타이틀
					echo apms_widget('miso-title-owl', $wshid.'-title-m', 'caption=4 height=35 xs=50');
				} else { //PC 타이틀
					echo apms_widget('miso-title-nivo', $wshid.'-title-pc', 'caption=4 height=35 xs=50');
				}
			?>
		</div>
		<!--// End -->

		<div class="row row-15">
			<div class="col-lg-6 col-15">

				<div class="row row-15">
					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="pull-right main-more">+더보기</span>
									여행이야기
								</a>
							</div>
							<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m1', 'irows=1 date=1 rdm=1 caption=2 thumb_w=400 thumb_h=225 icon={아이콘:paper-plane}'); ?>
						</div>
						<!--// End -->

					</div>

					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="pull-right main-more">+더보기</span>
									영화이야기
								</a>
							</div>
							<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m2', 'irows=1 date=1 rdm=1 caption=2 thumb_w=400 thumb_h=225 icon={아이콘:film}'); ?>
						</div>
						<!--// End -->

					</div>
				</div>

			</div>
			<div class="col-lg-6 col-15">

				<div class="row row-15">
					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="pull-right main-more">+더보기</span>
									게임이야기
								</a>
							</div>
							<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m3', 'irows=1 date=1 rdm=1 caption=2 thumb_w=400 thumb_h=225 icon={아이콘:gamepad}'); ?>
						</div>
						<!--// End -->

					</div>

					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="pull-right main-more">+더보기</span>
									뮤직이야기
								</a>
							</div>
							<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m4', 'irows=1 date=1 rdm=1 caption=2 thumb_w=400 thumb_h=225 icon={아이콘:music}'); ?>
						</div>
						<!--// End -->

					</div>
				</div>

			</div>
		</div>

		<!-- Start //-->
		<div class="main-box">
			<div class="main-head">
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
					<span class="pull-right main-more">+더보기</span>
					갤러리
				</a>
			</div>
			<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-a', 'caption=3'); ?>
		</div>
		<!--// End -->

		<!-- Start //-->
		<div class="main-box">
			<div class="main-head">
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
					<span class="pull-right main-more">+더보기</span>
					웹진
				</a>
			</div>
			<?php echo apms_widget('miso-post-webzine', $wshid.'-webzine-m1', 'rows=9 item=3 date=1 bold=1'); ?>
		</div>
		<!--// End -->

		<?php echo apms_line('fa', 'fa-commenting');?>

		<div class="row row-15">
			<div class="col-lg-6 col-15">

				<div class="row row-15">
					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="pull-right main-more">+더보기</span>
									게시판
								</a>
							</div>
							<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m11', 'date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
						</div>
						<!--// End -->

					</div>

					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="pull-right main-more">+더보기</span>
									게시판
								</a>
							</div>
							<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m12', 'date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
						</div>
						<!--// End -->

					</div>
				</div>

				<div class="row row-15">
					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="pull-right main-more">+더보기</span>
									게시판
								</a>
							</div>
							<?php echo apms_widget('miso-post-mix', $wshid.'-mix-m1', 'rdm=1 date=1 bold=1 icon={아이콘:caret-right}'); ?>
						</div>
						<!--// End -->

					</div>

					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="pull-right main-more">+더보기</span>
									게시판
								</a>
							</div>
							<?php echo apms_widget('miso-post-mix', $wshid.'-mix-m2', 'rdm=1 date=1 bold=1 icon={아이콘:caret-right}'); ?>
						</div>
						<!--// End -->

					</div>
				</div>

				<!-- Start //-->
				<div class="main-box">
					<div class="main-head">
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
							<span class="pull-right main-more">+더보기</span>
							게시판
						</a>
					</div>
					<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'garo=1 rows=20 icon={아이콘:caret-right} date=1'); ?>
				</div>
				<!--// End -->

			</div>
			<div class="col-lg-6 col-15">

				<div class="row row-15">
					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<span class="pull-right main-more">+더보기</span>
									이벤트
								</a>
							</div>
							<?php echo apms_widget('miso-post-owl', $wshid.'-event-m1', 'rows=5 item=1 lg=1 md=1 sm=1 nav=1 rdm=1 caption=2'); ?>
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
									<?php echo apms_widget('miso-post-list', $wshid.'-notice-s1', 'date=1 icon={아이콘:bell} rows=5'); ?>
								</div>
								<div class="tab-pane" id="main_faq">
									<?php echo apms_widget('miso-faq-list', $wshid.'-faq-s1', 'icon={아이콘:question-circle} rows=5'); ?>
								</div>
							</div>
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
						<div class="main-box main-p10">
							<div style="width:100%; height:260px; line-height:260px; text-align:center; background:#f5f5f5;">
								반응형 구글광고 등
							</div>
						</div>
						<!--// End -->

					</div>

					<div class="col-sm-6 col-15">

						<!-- Start //-->
						<div class="main-box">
							<div class="main-head">
								<a href="<?php echo $at_href['new'];?>?view=c">
									<span class="pull-right main-more">+더보기</span>
									새댓글
								</a>
							</div>
							<?php echo apms_widget('miso-post-icon', $wshid.'-comment-s1', 'comment=1 rows=10'); ?>
						</div>
						<!--// End -->

						<?php
							//설문조사
							$is_poll_list = apms_widget('miso-poll', $wshid.'-poll', 'icon={아이콘:commenting}');
							if($is_poll_list) {
						?>
							<div class="main-box">
								<div class="main-head">
									<a>설문조사	</a>
								</div>
								<?php echo $is_poll_list; ?>
							</div>
						<?php  } ?>

					</div>
				</div>

			</div>
		</div>

	</div><!-- .at-content -->
</div><!-- .content -->

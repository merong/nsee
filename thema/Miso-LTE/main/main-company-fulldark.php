<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-cpfd';

// 헤더라인색 : darkred, crimson, red, orangered, orange, green, lightgreen, deepblue, blue, skyblue, navy, violet, yellow, darkgray, gray, lightgray, black, white
$headline = 'orangered';

// 경로설정
$main_url = THEMA_URL.'/main/fullpage';

?>

<link rel="stylesheet" type="text/css" href="<?php echo $main_url;?>/jquery.fullpage.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $main_url;?>/style.css" />
<script type="text/javascript" src="<?php echo $main_url;?>/jquery.fullpage.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#fullpage').fullpage({
			autoScrolling: false,
			css3: true,
			fitToSection: false
		});
	});
</script>
<style>
	/* 페이지 배경설정 */
	#pagetitle { height:100%; }
	#pagetitle .carousel-inner { height:100%; }
	#pagetitle .carousel-inner .item { height:100%; }
	#pagetitle .item-1 { background: url('<?php echo $main_url;?>/img/bg1.jpg') no-repeat; background-size: cover; }
	#pagetitle .item-2 { background: url('<?php echo $main_url;?>/img/bg3.jpg') no-repeat; background-size: cover; }
	#pagetitle .item-3 { background: url('<?php echo $main_url;?>/img/bg2.jpg') no-repeat; background-size: cover; }
	#pagetitle .page-cell { padding:0px; }
	#fullpage {
		margin-top:0px !important;
	}
	.widget-white .post-more i {
		color:#666 !important;
	}
</style>
<div id="fullpage" class="bg-white">

	<div class="section" id="section0">

		<!-- Carousel Start //-->
		<div id="pagetitle" class="carousel slide" data-ride="carousel" data-pause="false">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#pagetitle" data-slide-to="0" class="active"></li>
				<li data-target="#pagetitle" data-slide-to="1"></li>
				<li data-target="#pagetitle" data-slide-to="2"></li>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item item-1 active">
					<div class="page-box">
						<div class="page-cell cell-middle text-center">
							<img src="<?php echo $main_url;?>/img/logo.png" style="max-width:100%;">
						</div>
					</div>
				</div>
				<div class="item item-2">
					<div class="page-box">
						<div class="page-cell cell-middle text-center">

							<div class="trans-bg-black" style="padding:20px 15px 30px;">	

								<h1 class="en white">
									MISO-LTE THEMA
								</h1>

								<div class="h10"></div>
								
								<h3 class="en white" style="line-height:140%;">
									데모 사이트 <span style="color:yellowgreen;">상단 우측의 <i class="fa fa-desktop"></i> 아이콘</span>을 클릭하면
									
									<div class="h10"></div>
									
									테마설정에 대한 미리보기와 저장 후 적용이 가능합니다.
								</h3>

							</div>

						</div>
					</div>
				</div>
				<div class="item item-3">
					<div class="page-box page-bg">
						<div class="page-cell cell-middle">

							<div class="page-widget widget-white">
								<div class="trans-bg-black" style="padding:30px;">

									<h1 class="en text-center">
										Contact
									</h1>
									
									<div class="h30"></div>

									<div class="row">
										<div class="col-sm-6">
					
											<!-- Start //-->
											<h3 class="div-title-underbar white">
												<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
													Help Desk
												</span>
											</h3>
											<div class="widget-box text-center">

												<h1 class="en lightgreen" style="font-size:3.2em; letter-spacing:-1px;">
													<i class="fa fa-phone-square"></i> 000.0000.0000
												</h1>

												<div class="h10"></div>

												<p>
													월-금 : 9:30 ~ 17:30, 토/일/공휴일 휴무
													<br>
													런치타임 : 12:30 ~ 13:30
												</p>
											
											</div>
											<!--// End -->

										</div>
										<div class="col-sm-6">

											<!-- Start //-->
											<h3 class="div-title-underbar white">
												<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
													E-mail
												</span>
											</h3>
											<div class="widget-box text-center">

												<h3 class="en">
													<i class="fa fa-envelope-square"></i> WebMaster@email.com
												</h3>

												<div class="h20"></div>

												<p class="text-center">
													<a href="<?php echo $at_href['secret'];?>" class="btn btn btn-trans">
														<i class="fa fa-commenting"></i> 1:1 INQUIRY
													</a>
												</p>
												
											</div>
											<!--// End -->

										</div>
									</div>

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#pagetitle" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#pagetitle" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>

		</div>
		<div class="clearfix"></div>
		<!--// End Carousel -->
	</div>
</div>

<div class="page-dark">

	<?php echo apms_shadow('2'); ?>

	<div class="page-widget widget-white">

		<div class="h30"></div>

		<div class="row">
			<div class="col-md-4">

				<!-- Start //-->
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
					<h3 class="div-title-underbar">
						<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
							Event
						</span>
						<span class="pull-right p-more">
							+ more
						</span>
					</h3>
				</a>
				<div class="widget-box">
					<?php echo apms_widget('miso-post-owl', $wshid.'-event-s1', 'rows=5 item=1 lg=1 md=3 sm=2 nav=1 rdm=1 caption=2 thumb_w=400 thumb_h=300'); ?>
				</div>
				<!--// End -->

			</div>
			<div class="col-md-4">

				<!-- Start //-->
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
					<h3 class="div-title-underbar">
						<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
							News
						</span>
						<span class="pull-right p-more">
							+ more
						</span>
					</h3>
				</a>
				<div class="widget-box">
					<?php echo apms_widget('miso-post-mix', $wshid.'-news-m1', 'rows=6 date=1 bold=1 rdm=1 icon={아이콘:bell}'); ?>
				</div>
				<!--// End -->

			</div>
			<div class="col-md-4">

				<!-- Start //-->
				<a href="<?php echo $at_href['new'];?>?view=c">
					<h3 class="div-title-underbar">
						<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
							Notice
						</span>
						<span class="pull-right p-more">
							+ more
						</span>
					</h3>
				</a>
				<style>
					.fix-lineheight ul li { line-height:23px !important; }
				</style>
				<div class="widget-box fix-lineheight">
					<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'rows=10 date=1 icon={아이콘:caret-right}'); ?>
				</div>
				<!--// End -->

			</div>
		</div>

		<div class="h30"></div>

		<h1 class="en text-center">
			Works
		</h1>
		
		<div class="h30"></div>

		<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m1', 'more=1 rows=12 item=4 lg=3 md=3 caption=3'); ?>

		<div class="h30"></div>

		<h1 class="en text-center">
			Specials
		</h1>
		
		<div class="h20"></div>

		<div style="border-top:1px solid #ddd; padding-top:15px;">
			<?php echo apms_widget('miso-post-webzine', $wshid.'-webzine-m1', 'more=1 rows=8 date=1 bold=1'); ?>
		</div>

		<div class="h30"></div>

		<h1 class="en text-center">
			Peoples
		</h1>
		
		<div class="h30"></div>

		<div class="row">
			<div class="col-md-4">

				<!-- Start //-->
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
					<h3 class="div-title-underbar">
						<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
							Articles
						</span>
						<span class="pull-right p-more">
							+ more
						</span>
					</h3>
				</a>
				<div class="widget-box">
					<?php echo apms_widget('miso-post-webzine', $wshid.'-webzine-m1', 'rows=3 item=1 lg=1 md=1 sm=1 date=1 bold=1'); ?>
				</div>
				<!--// End -->

			</div>
			<div class="col-md-4">

				<!-- Start //-->
				<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
					<h3 class="div-title-underbar">
						<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
							Posts
						</span>
						<span class="pull-right p-more">
							+ more
						</span>
					</h3>
				</a>
				<div class="widget-box">
					<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m1', 'irows=2 rows=7 thumb_w=400 thumb_h=225 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
				</div>
				<!--// End -->

			</div>
			<div class="col-md-4">

				<!-- Start //-->
				<a href="<?php echo $at_href['new'];?>?view=c">
					<h3 class="div-title-underbar">
						<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
							Q & A
						</span>
						<span class="pull-right p-more">
							+ more
						</span>
					</h3>
				</a>
				<style>
					.fix-lineheight2 ul li { line-height:24px !important; }
				</style>
				<div class="widget-box fix-lineheight2">
					<?php echo apms_widget('miso-post-list', $wshid.'-list-m2', 'rows=12 date=1 icon={아이콘:caret-right}'); ?>
				</div>
				<!--// End -->

			</div>
		</div>

		<!-- Start //-->
		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
			<h3 class="div-title-underbar">
				<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
					Partner
				</span>
				<span class="pull-right p-more">
					+ more
				</span>
			</h3>
		</a>
		<div class="widget-box">
			<?php echo apms_widget('miso-post-owl', $wshid.'-event-s1', 'auto=0 rows=8 item=4 lg=4 md=3 sm=2 xs=1 nav=1 rdm=1 caption=3 thumb_w=400 thumb_h=200'); ?>
		</div>
		<!--// End -->

	</div>
</div>
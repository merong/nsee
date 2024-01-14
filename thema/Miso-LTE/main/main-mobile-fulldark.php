<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-mpfw';

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
	#section0 {
		background: url('<?php echo $main_url;?>/img/bg2.jpg') no-repeat; background-size: cover;
	}
	#fullpage {
		margin-top:0px !important;
	}
	.widget-white .post-more i {
		color:#666 !important;
	}
	.main-icon { 
		text-align:center; margin:30px 0px; overflow:hidden; margin-right:-6px; 
	}
	.main-icon a { 
		display:inline-block; margin-right:6px; margin-bottom:15px; 
	}
	.main-icon span { 
		display:block; margin-top:6px; 
	}
</style>

<div id="fullpage" class="bg-white">

	<!-- Start //-->
	<div class="section" id="section0">
		<div class="page-box">
			<div class="page-cell cell-middle text-center">
				<img src="<?php echo $main_url;?>/img/logo.png" style="max-width:100%;">
			</div>
		</div>
	</div>
	<!--// End -->

</div>

<div class="page-dark">
	<div class="page-widget page-mobile widget-white">

		<div class="main-icon">

			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
				<i class="fa fa-bell circle bg-red large"></i>
				<span>메뉴명</span>
			</a>

			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
				<i class="fa fa-picture-o circle bg-blue large"></i>
				<span>메뉴명</span>
			</a>

			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
				<i class="fa fa-download circle bg-green large"></i>
				<span>메뉴명</span>
			</a>

			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
				<i class="fa fa-comments circle bg-yellow large"></i>
				<span>메뉴명</span>
			</a>

			<div class="clearfix"></div>

			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
				<i class="fa fa-th-large circle bg-darkgray large"></i>
				<span>메뉴명</span>
			</a>

			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
				<i class="fa fa-pencil circle bg-darkgray large"></i>
				<span>메뉴명</span>
			</a>

			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
				<i class="fa fa-file-text-o circle bg-darkgray large"></i>
				<span>메뉴명</span>
			</a>

			<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
				<i class="fa fa-user-secret circle bg-darkgray large"></i>
				<span>메뉴명</span>
			</a>
		</div>

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
			<?php echo apms_widget('miso-post-owl', $wshid.'-event-s1', 'rows=5 item=1 lg=1 md=1 sm=1 xs=1 nav=1 rdm=1 caption=2 thumb_w=400 thumb_h=225'); ?>
		</div>
		<!--// End -->

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
			<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m1', 'irows=2 thumb_w=400 thumb_h=225 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
		</div>
		<!--// End -->


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
		<div class="widget-box">
			<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'date=1 icon={아이콘:caret-right}'); ?>
		</div>
		<!--// End -->


		<!-- Start //-->
		<a href="<?php echo $at_href['new'];?>?view=c">
			<h3 class="div-title-underbar">
				<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
					Works
				</span>
				<span class="pull-right p-more">
					+ more
				</span>
			</h3>
		</a>
		<div class="widget-box">
			<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m1', 'more=1 rows=6 item=2 lg=2 md=2 sm=2 xs=2 caption=3'); ?>
		</div>
		<!--// End -->

		<!-- Start //-->
		<a href="<?php echo $at_href['new'];?>?view=c">
			<h3 class="div-title-underbar">
				<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
					Specials
				</span>
				<span class="pull-right p-more">
					+ more
				</span>
			</h3>
		</a>
		<div class="widget-box">
			<?php echo apms_widget('miso-post-webzine', $wshid.'-webzine-m1', 'more=1 rows=4 item=1 lg=1 md=1 sm=1 xs=1 date=1 bold=1'); ?>
		</div>
		<!--// End -->

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
			<?php echo apms_widget('miso-post-mix', $wshid.'-news-m1', 'date=1 bold=1 rdm=1 icon={아이콘:bell}'); ?>
		</div>
		<!--// End -->

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
		<div class="widget-box fix-lineheight2">
			<?php echo apms_widget('miso-post-list', $wshid.'-list-m2', 'more=1 rows=10 date=1 icon={아이콘:caret-right}'); ?>
		</div>
		<!--// End -->

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
			<?php echo apms_widget('miso-post-owl', $wshid.'-event-s1', 'auto=0 rows=6 item=2 lg=2 md=2 sm=2 xs=1 nav=1 rdm=1 caption=3 thumb_w=400 thumb_h=200'); ?>
		</div>
		<!--// End -->

	</div>
</div>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>

<style>
	.page-content { line-height:22px; word-break: keep-all; word-wrap: break-word; }
	.page-content p { margin:0 0 15px; padding:0; }
	.page-content .slogan { font-size:25px; letter-spacing:-1px; margin-bottom:15px; line-height:34px; }
	.page-content .slogan i { font-size:17px; vertical-align:top; margin-top:6px; }
	span#left{
	float: left;
	color: red;
	font-size: 18pt;
	}
</style>

<div class="page-content">

	<h3 class="slogan text-center">
		<i class="fa fa-quote-left"></i>
		<span class="red">Rank in AVsee.TV</span>
		<i class="fa fa-quote-right"></i>
	</h3>

	<p class="text-center text-muted">
			<!--start-->
					<span id="left">KBJ view Rank</span><br>
					<div id="misc_tab" class="div-tab tabs swipe-tab trans-top">
					<div class="main-tab bg-white">
						<ul class="nav nav-tabs" data-toggle="tab-hover">
							<li class="active">
							<a href="#KBJ_Weekly" data-toggle="tab">Weekly</a></li>
							<li><a href="#KBJ_Monthly" data-toggle="tab">Monthly</a></li>
							<li><a href="#KBJ_3Monthly" data-toggle="tab">3 Month</a></li>
							<li><a href="#KBJ_6Monthly" data-toggle="tab">6 Month</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="KBJ_Weekly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'KBJ_Weekly', 'center=2'); ?>
						</div>
						<div class="tab-pane" id="KBJ_Monthly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'KBJ_Monthly', 'center=3'); ?>
						</div>
						<div class="tab-pane" id="KBJ_3Monthly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'KBJ_3Monthly', 'center=4'); ?>
						</div>
						<div class="tab-pane" id="KBJ_6Monthly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'KBJ_6Monthly', 'center=5'); ?>
						</div>
					</div>
				</div>
				<!--// End -->
				<br>
				<br>
				<br>
				<!--JAV start-->
					<span id="left">JAV view Rank</span><br>
					<div id="misc_tab" class="div-tab tabs swipe-tab trans-top">
					<div class="main-tab bg-white">
						<ul class="nav nav-tabs" data-toggle="tab-hover">
							<li class="active">
							<a href="#Jav_Weekly" data-toggle="tab">Weekly</a></li>
							<li><a href="#Jav_Monthly" data-toggle="tab">Monthly</a></li>
							<li><a href="#Jav_3Monthly" data-toggle="tab">3 Month</a></li>
							<li><a href="#Jav_6Monthly" data-toggle="tab">6 Month</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="Jav_Weekly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'Jav_Weekly', 'center=2'); ?>
						</div>
						<div class="tab-pane" id="Jav_Monthly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'Jav_Monthly', 'center=3'); ?>
						</div>
						<div class="tab-pane" id="Jav_3Monthly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'Jav_3Monthly', 'center=4'); ?>
						</div>
						<div class="tab-pane" id="Jav_6Monthly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'Jav_6Monthly', 'center=5'); ?>
						</div>
					</div>
				</div>
				<!--// End -->
				<br>
				<br>
				<br>
				<!--JAVU start-->
					<span id="left">JAV Un view Rank</span><br>
					<div id="misc_tab" class="div-tab tabs swipe-tab trans-top">
					<div class="main-tab bg-white">
						<ul class="nav nav-tabs" data-toggle="tab-hover">
							<li class="active">
							<a href="#Jav_Un_Weekly" data-toggle="tab">Weekly</a></li>
							<li><a href="#Jav_Un_Monthly" data-toggle="tab">Monthly</a></li>
							<li><a href="#Jav_Un_3Monthly" data-toggle="tab">3 Month</a></li>
							<li><a href="#Jav_Un_6Monthly" data-toggle="tab">6 Month</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active" id="Jav_Un_Weekly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'Jav_Un_Weekly', 'center=2'); ?>
						</div>
						<div class="tab-pane" id="Jav_Un_Monthly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'Jav_Un_Monthly', 'center=3'); ?>
						</div>
						<div class="tab-pane" id="Jav_Un_3Monthly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'Jav_Un_3Monthly', 'center=4'); ?>
						</div>
						<div class="tab-pane" id="Jav_Un_6Monthly">
							<?php echo apms_widget('miso-post-gallery', $wshid.'Jav_Un_6Monthly', 'center=5'); ?>
						</div>
					</div>
				</div>
				<!--// End -->

</div>

<div class="h30"></div>

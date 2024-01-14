<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-sbasic';

// 헤더라인색 : darkred, crimson, red, orangered, orange, green, lightgreen, deepblue, blue, skyblue, navy, violet, yellow, darkgray, gray, lightgray, black, white
$headline = 'orangered';

?>

<style>
	.widget-side .div-title-underbar-bold { padding-bottom:2px; }
	.widget-side .main-box { margin:15px 0px 30px; }
	.widget-side .main-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
	.widget-side .main-p10 { padding:10px; }
	.widget-side .tabs.div-tab .main-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.widget-side .main-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.widget-side .tabs { margin-bottom:30px !important; }
	.widget-side .tab-content { border:0px !important; padding:15px 0px 0px !important; }
</style>

<div class="widget-side">

	<!-- Start //-->
	<div class="div-title-underbar">
		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
			<span class="div-title-underbar-bold border-<?php echo $headline;?>">
				<b>인기</b>
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
		<a href="<?php echo $at_href['new'];?>">
			<span class="div-title-underbar-bold border-<?php echo $headline;?>">
				<b>새글</b>
			</span>
			<span class="pull-right main-more">
				+ 더보기
			</span>
		</a>
	</div>
	<div class="main-box">
		<?php echo apms_widget('miso-post-mix', $wshid.'-mix-s1', 'date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
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
		<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'rows=10 comment=1 icon={아이콘:commenting} date=1'); ?>
	</div>
	<!--// End -->

	<!-- Start //-->
	<div class="main-box">
		<div style="width:100%; height:260px; line-height:260px; text-align:center; background:#f5f5f5;">
			반응형 구글광고 등
		</div>
	</div>
	<!--// End -->

</div>
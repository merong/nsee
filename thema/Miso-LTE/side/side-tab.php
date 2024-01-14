<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-stab';

?>

<style>
	.widget-side-tab .main-box { border:1px solid #ddd; margin-bottom:16px; background:#fff; }
	.widget-side-tab .main-more { margin:8px 0px 0px; }
	.widget-side-tab .main-p10 { padding:10px; }
	.widget-side-tab .main-tab { border-right:1px solid #ddd; border-top:1px solid #ddd; }
	.widget-side-tab .main-tab .nav { margin-top:-1px !important; }
	.widget-side-tab .trans-top.tabs.div-tab .main-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.widget-side-tab .main-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.widget-side-tab .tabs { margin-bottom:16px !important; }
	.widget-side-tab .tab-content { padding:10px !important; }
</style>

<div class="widget-side-tab">

	<!-- Start //-->
	<div class="div-tab tabs trans-top">
		<div class="main-tab bg-light">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">인기</a>
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
					<a href="<?php echo $at_href['new'];?>">새글</a>
				</li>
			</ul>
			<a class="pull-right tab-more" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
				+ 더보기
			</a>
		</div>
		<div class="tab-content">
			<div class="tab-pane active">
				<?php echo apms_widget('miso-post-mix', $wshid.'-mix-s1', 'date=1 bold=1 rdm=1 icon={아이콘:caret-right}'); ?>
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
				<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'rows=10 comment=1 icon={아이콘:commenting} date=1'); ?>
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
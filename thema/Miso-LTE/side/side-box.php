<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-sbox';

?>

<style>
	.widget-side-box .main-box { border:1px solid #ddd; margin-bottom:16px; background:#fff; padding:12px; }
	.widget-side-box .main-head { border-bottom:1px solid #ddd; margin:0px 0px 12px; font-weight:bold; padding-bottom:3px; }
	.widget-side-box .main-more { font-weight:normal; color:#888; letter-spacing:-1px; font-size:11px; }
	.widget-side-box .main-p10 { padding:10px; }
	.widget-side-box .main-tab { border-right:1px solid #ddd; border-top:1px solid #ddd; }
	.widget-side-box .main-tab .nav { margin-top:-1px !important; }
	.widget-side-box .trans-top.tabs.div-tab .main-tab ul.nav-tabs li.active a { font-weight:bold; color:#333 !important; }
	.widget-side-box .main-tab .tab-more { margin-top:-28px; margin-right:10px; font-size:11px; letter-spacing:-1px; color:#888 !important; }
	.widget-side-box .tabs { margin-bottom:16px !important; }
	.widget-side-box .tab-content { padding:10px !important; }
</style>

<div class="widget-side-box">

	<!-- Start //-->
	<div class="main-box">
		<div class="main-head">
<!--		<div style="width:100%; height:260px; line-height:260px; text-align:center; background:#ffffff;"> -->
		<a href="http://mex-see04.com">
		<img src="/imgs/a_mex.gif" width="100%" height="100%"></a>
		</div>
	</div>
	<!--// End -->

	<!-- Start //-->
		<div class="main-box">
			<div class="main-head">
					Best Recommend
			</div>
			<?php echo apms_widget('miso-post-mix', $wshid.'-mix-s1', 'rank=orange date=1 bold=1 rdm=1 '); ?>
		</div>
	<!--// End -->

	<!-- Start //-->
	<div class="main-box">
		<div class="main-head">
			<a href="<?php echo $at_href['new'];?>">
				<span class="pull-right main-more">+More</span>
				New Post
			</a>
		</div>
		<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'rows=10 comment=1 date=1'); ?>
	</div>
	<!--// End -->

	<!-- Start //-->
	<div class="main-box">
		<div class="main-head">
			<a href="<?php echo $at_href['new'];?>?view=c">
				<span class="pull-right main-more">+More</span>
				New Comment
			</a>
		</div>
		<?php echo apms_widget('miso-post-list', $wshid.'-list-m2', 'rows=10 comment=1 date=1'); ?>
	</div>
	<!--// End -->

</div>
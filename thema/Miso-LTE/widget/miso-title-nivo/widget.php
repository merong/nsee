<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// Nivo-Slider - https://github.com/gilbitron/Nivo-Slider
apms_script('nivoslider');

// 반응형
$height = (isset($wset['height']) && $wset['height'] > 0) ? $wset['height'] : 30;
if(_RESPONSIVE_) {
	$lg = (isset($wset['lg']) && $wset['lg'] > 0) ? $wset['lg'] : 0;
	$md = (isset($wset['md']) && $wset['md'] > 0) ? $wset['md'] : 0;
	$sm = (isset($wset['sm']) && $wset['sm'] > 0) ? $wset['sm'] : 0;
	$xs = (isset($wset['xs']) && $wset['xs'] > 0) ? $wset['xs'] : 0;
}

// 네비
$is_nav = (isset($wset['nav']) && $wset['nav']) ? $wset['nav'] : '';

// 그림자
$shadow_in = '';
$shadow_out = (isset($wset['shadow']) && $wset['shadow']) ? apms_shadow($wset['shadow']) : '';
if($shadow_out && isset($wset['inshadow']) && $wset['inshadow']) {
	$shadow_in = '<div class="in-shadow">'.$shadow_out.'</div>';
	$shadow_out = '';	
}

// 랜덤아이디
$widget_id = apms_id();

?>
<style>
	#<?php echo $widget_id;?> .nivoSlider { 
		height:0 !important; padding-bottom:<?php echo $height;?>% !important; margin-bottom:0px !important; 
	}
	<?php if(_RESPONSIVE_) { //반응형일 때만 작동 ?>
		<?php if($lg) { ?>
		@media (max-width: 1199px) { 
			.responsive #<?php echo $widget_id;?> .nivoSlider { padding-bottom:<?php echo $lg;?>% !important; } 
		}
		<?php } ?>
		<?php if($md) { ?>
		@media (max-width: 991px) { 
			.responsive #<?php echo $widget_id;?> .nivoSlider { padding-bottom:<?php echo $md;?>% !important; } 
		}
		<?php } ?>
		<?php if($sm) { ?>
		@media (max-width: 767px) { 
			.responsive #<?php echo $widget_id;?> .nivoSlider { padding-bottom:<?php echo $sm;?>% !important; } 
		}
		<?php } ?>
		<?php if($xs) { ?>
		@media (max-width: 480px) { 
			.responsive #<?php echo $widget_id;?> .nivoSlider { padding-bottom:<?php echo $xs;?>% !important; } 
		}
		<?php } ?>
	<?php } ?>
</style>
<div id="<?php echo $widget_id;?>" class="nivo-wrapper">
	<?php echo $shadow_in;?>
	<?php 
		if(isset($wset['cache']) && $wset['cache']) { // 캐시적용시
			$wset['cache'] = 2592000; //30일
			echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
		} else {
			include($widget_path.'/widget.rows.php');
		}
	?>
</div>
<?php echo $shadow_out; ?>
<script>
$(window).load(function() {
	$('#<?php echo $widget_id;?> .nivoSlider').nivoSlider({
		effect: '<?php echo (isset($wset['effect']) && $wset['effect']) ? $wset['effect'] : 'random';?>',
		slices: <?php echo (isset($wset['slices']) && $wset['slices'] > 0) ? $wset['slices'] : '15';?>,
		boxCols: <?php echo (isset($wset['boxcols']) && $wset['boxcols'] > 0) ? $wset['boxcols'] : '8';?>,
		boxRows: <?php echo (isset($wset['boxrows']) && $wset['boxrows'] > 0) ? $wset['boxrows'] : '4';?>,
		animSpeed: <?php echo (isset($wset['animspeed']) && $wset['animspeed'] > 0) ? $wset['animspeed'] : '500';?>,
		pauseTime: <?php echo (isset($wset['pausetime']) && $wset['pausetime'] > 0) ? $wset['pausetime'] : '3000';?>,
		pauseOnHover: <?php echo (isset($wset['pausehover']) && $wset['pausehover']) ? 'true' : 'false';?>,
		randomStart: <?php echo (isset($wset['rdmstart']) && $wset['rdmstart']) ? 'true' : 'false';?>,
		controlNav: <?php echo ($is_nav) ? 'true' : 'false';?>,
		controlNavThumbs: <?php echo ($is_nav == "2") ? 'true' : 'false';?>,
		directionNav: <?php echo (isset($wset['arrow']) && $wset['arrow']) ? 'false' : 'true';?>
	});
});
</script>
<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>

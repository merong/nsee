<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// Miso-LTE 2.0

// ---------------------------------------------------------
// 경고! 이하 내용은 수정하지 마세요!
// ---------------------------------------------------------

// YC5
if(IS_YC) {
	thema_member('cart');

	if(!isset($at_set['pcontent'])) {
		$at_set['pcontent'] = 'wide';
	}
}

// Demo
$is_demo_index = false;
if($is_demo) {
	@include($demo_setup_file);
}

// Page
if($is_index || $is_demo_index) {
	$is_at_content = $at_set['content'];
	$is_at_bg = $at_set['content_bg'];
	$is_at_layout = $at_set['layout'];
	$is_at_fixed = $at_set['fixed'];
	$is_at_closed = $at_set['closed'];
	$is_at_hover = $at_set['hover'];
	$is_at_mini = $at_set['mini'];
	$is_at_tm = $at_set['tm'];
	$is_at_ft = $at_set['ft'];
	$is_at_left = ''; 
	$is_at_right = '';
} else {
	$is_at_content = $at_set['pcontent'];
	$is_at_bg = $at_set['pcontent_bg'];
	$is_at_layout = $at_set['playout'];
	$is_at_fixed = $at_set['pfixed'];
	$is_at_closed = $at_set['pclosed'];
	$is_at_hover = $at_set['phover'];
	$is_at_mini = $at_set['pmini'];
	$is_at_tm = $at_set['ptm'];
	$is_at_ft = $at_set['pft'];
	$is_at_left = $at_set['ls']; 
	$is_at_right = $at_set['rs'];
}

// Column
if($is_wide_layout) { //Full Wide
	$col_name = '';
} else if($is_at_left || $is_at_right) { //Two Column
	$col_name = 'two';
} else { // One Column
	$col_name = 'one';
}

// Menu
$menu_cnt = count($menu);

// Stylesheet
$bootstrap_css = (_RESPONSIVE_) ? 'bootstrap.min.css' : 'bootstrap-apms.min.css';
$add_stylesheet = '<link rel="stylesheet" href="'.THEMA_URL.'/assets/bs3/css/'.$bootstrap_css.'" type="text/css" media="screen" class="thema-mode">';
$add_stylesheet .= PHP_EOL.'<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" type="text/css">';
$add_stylesheet .= PHP_EOL.'<link rel="stylesheet" href="'.COLORSET_URL.'/colorset.css" type="text/css" media="screen" class="thema-colorset">';
add_stylesheet($add_stylesheet,0);
$add_stylesheet = ''; //Reset

// Plugin
apms_script('swipe');

// Social Icon
$sns_share_url  = (IS_YC && IS_SHOP) ? G5_SHOP_URL : G5_URL;
$sns_share_title = get_text($config['cf_title']);
$sns_share_img = THEMA_URL.'/assets/img';
$sns_share_icon = '<div class="sns-share-icon">'.PHP_EOL;
$sns_share_icon .= get_sns_share_link('facebook', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_fb.png').PHP_EOL;
$sns_share_icon .= get_sns_share_link('twitter', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_twt.png').PHP_EOL;
$sns_share_icon .= get_sns_share_link('googleplus', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_goo.png').PHP_EOL;
$sns_share_icon .= get_sns_share_link('kakaostory', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_kakaostory.png').PHP_EOL;
$sns_share_icon .= get_sns_share_link('kakaotalk', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_kakao.png').PHP_EOL;
$sns_share_icon .= get_sns_share_link('naverband', $sns_share_url, $sns_share_title, $sns_share_img.'/sns_naverband.png').PHP_EOL;
$sns_share_icon .= '</div>';

// Layout
if(!$at_set['font']) $at_set['font'] = 'ko';
$layout_wrapper = $at_set['font'];
$layout_wrapper .= ($is_at_layout) ? ' '.$is_at_layout : '';
$layout_wrapper .= ($at_set['color']) ? ' '.$at_set['color'] : ' skin-blue';
$layout_wrapper .= ($is_at_mini) ? '' : ' sidebar-mini';
$layout_wrapper .= ($is_at_closed) ? ' sidebar-collapse' : '';
$layout_wrapper .= ($is_at_fixed) ? ' fixed' : '';
$layout_wrapper .= ($is_at_tm) ? ' header-menu' : '';

// Container
$at_set['cw'] = (isset($at_set['cw']) && $at_set['cw'] > 0) ? $at_set['cw'] : 1250;
$at_set['gap'] = (isset($at_set['gap']) && $at_set['gap'] > 0) ? $at_set['gap'] : 0;
$at_set['lrg'] = (isset($at_set['lrg']) && $at_set['lrg'] > 0) ? $at_set['lrg'] : 15;

// Top Sub
$is_subw = (isset($at_set['subw']) && $at_set['subw'] > 0) ? $at_set['subw'] : 180;

// Content
$wrapper = ($is_at_content) ? $is_at_content : 'left';
$wrapper .= ($is_at_bg) ? ' '.$is_at_bg : '';

// New Colors
$narr = array('primary', 'orange', 'green', 'blue', 'orangered', 'yellow', 'violet', 'red', 'deepblue', 'crimson');	

?>
<style> 
	<?php if(!G5_IS_MOBILE && !$is_at_fixed && $is_at_layout && ($at_set['bgcolor'] || $at_set['background'])) { ?>
	body { 
		<?php if($at_set['bgcolor']) { ?>background-color: <?php echo $at_set['bgcolor'];?>;<?php } ?>
		<?php if($at_set['background']) { ?>background-image: url('<?php echo $at_set['background'];?>');<?php } ?>
	}
	<?php } ?>
	.layout-boxed > .wrapper, .content-wrapper > .content { max-width:<?php echo $at_set['cw'];?>px; }
	.no-responsive .wrapper, .no-responsive .main-header { min-width:<?php echo $at_set['cw'];?>px; }
	.layout-boxed.left .wrapper { margin-left:<?php echo $at_set['gap'];?>px; }
	.layout-boxed.right .wrapper { margin-right:<?php echo $at_set['gap'];?>px; }
	.at-navbar .dropdown-menu ul { width: <?php echo $is_subw;?>px; min-width: <?php echo $is_subw;?>px; }
	<?php if($is_at_left) { //좌측사이드
		$is_at_lw = (isset($at_set['lsw']) && $at_set['lsw'] > 0) ? $at_set['lsw'] : 260;	
	?>
	#at-wrap { padding-left:<?php echo $is_at_lw + $at_set['lrg'];?>px; }
	#at-left { width:<?php echo $is_at_lw;?>px; }
	<?php } ?>
	<?php if($is_at_right) { //우측사이드 
		$is_at_rw = (isset($at_set['rsw']) && $at_set['rsw'] > 0) ? $at_set['rsw'] : 260;	
	?>
	#at-wrap { padding-right:<?php echo $is_at_rw + $at_set['lrg'];?>px; }
	#at-right { width:<?php echo $is_at_rw;?>px; }
	<?php } ?>
</style>

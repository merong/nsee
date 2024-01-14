<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

global $bo_table;

//애드온 사용시에만 출력
if($wset['use']) {
	//add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css" media="screen">', 0);
	$wset['bo_list'] = ($wset['bo_list']) ? $wset['bo_list'] : $bo_table;
?>

<!--
	<div class="div-title-wrap">
		<div class="div-title"><b><?php echo ($wset['title']) ? apms_fa($wset['title']) : '타이틀 입력';?></b></div>
		<div class="div-sep-wrap">
			<div class="div-sep sep-bold"></div>
		</div>
	</div>
-->


	<div class="best-post-addon<?php echo (G5_IS_MOBILE) ? ' mobile' : '';?>">
		<?php 
			if($wset['cache'] > 0) { // 캐시적용시
				echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
			} else {
				include($widget_path.'/widget.rows.php');
			}
		?>
	</div>
<?php } ?>
<?php if($setup_href) { ?>
	<p class="btn-wset text-center">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted font-12 en"><i class="fa fa-cube"></i> 베스트글 애드온 설정</span>
		</a>
	</p>
<?php } ?>
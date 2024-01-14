<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가
?>
<ul style="list-style:none; padding:0; margin:0">
<?php 
	if($wset['cache'] > 0) { // 캐시적용시
		echo apms_widget_cache($widget_path.'/widget.rows.php', $wname, $wid, $wset);
	} else {
		include($widget_path.'/widget.rows.php');
	}
?>
</ul>
<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>

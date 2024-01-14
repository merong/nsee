<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true) {
	if(defined('G5_THEME_PATH') && is_file(G5_THEME_PATH.'/tail.sub.php')) {
	    require_once(G5_THEME_PATH.'/tail.sub.php');
		return;
	}
} else if(USE_G5_THEME) {
	if(!defined('G5_IS_ADMIN') && defined('G5_THEME_PATH') && is_file(G5_THEME_PATH.'/tail.sub.php')) {
	    require_once(G5_THEME_PATH.'/tail.sub.php');
		return;
	}
}

if(APMS_PRINT) {
	@include_once($print_skin_path.'/print.tail.php');
}
?>

<!-- <?php echo APMS_VERSION;?> -->
<?php if ($is_admin == 'super') {  ?>
<!-- RUN TIME : <?php echo get_microtime()-$begin_time; ?> -->
<?php }  ?>

<script>
	var is_miso_thema = "Miso-LTE";
</script>
<script src="<?php echo THEMA_URL;?>/assets/js/custom.js"></script>
</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>

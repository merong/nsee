<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가
// 간격
$wset['delay'] = (isset($wset['delay']) && $wset['delay'] >= 60000) ? $wset['delay'] : 60000;
?>
<?php 
//특정 페이지에서 alarm 표시안함 
$except_alarm_page = array('memo.php',
					'point.php',
					'response.php',
					'follow.php',
					'scrap.php',
					'mypost.php',
					'myphoto.php',
					'shopping.php',
					'coupon.php',
					'widget.setup.php');
if (!in_array(basename($_SERVER['PHP_SELF']), $except_alarm_page)) 
{ 
	if ($wset['alarm_use'] == 1)
	{		
?>
<link rel="stylesheet" href="<?php echo G5_CSS_URL ?>/animate.min.css">
<link rel="stylesheet" href="<?php echo $widget_url ?>/widget.css">
<script>
var memo_alarm_url = "<?php echo $widget_url;?>";
</script>
<script src="<?php echo $widget_url ?>/widget.js"></script>
<script type="text/javascript">
    $(function() {
        setInterval(function() {
            check_alarm();
        }, <?php echo $wset['delay'] ?>);
        check_alarm();
    });
</script>
<?php } ?>
<?php } ?>

<?php if($setup_href) { ?>
	<div class="btn-wset text-center p10">
		<a href="<?php echo $setup_href;?>" class="win_memo">
			<span class="text-muted font-12"><i class="fa fa-cog"></i> 위젯설정</span>
		</a>
	</div>
<?php } ?>

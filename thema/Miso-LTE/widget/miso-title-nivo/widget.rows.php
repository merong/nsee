<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 캡션
$caption = (isset($wset['caption']) && $wset['caption']) ? $wset['caption'] : '';

switch($caption) {
	case '2'	: $is_caption = ' nivo-hover-caption'; break;
	case '3'	: $is_caption = ' nivo-bar-caption'; break;
	case '4'	: $is_caption = ' nivo-title-caption en'; break;
	default		: $is_caption = ''; break;
}

?>
<div class="nivoSlider<?php echo $is_caption;?>">
	<?php
	// 슬라이더
	$k=0;
	for ($i=1; $i <= $wset['slider']; $i++) {
		
		if(!$wset['use'.$i] || !$wset['img'.$i]) continue; // 사용하지 않으면 건너뜀

		$data_thumb = ($is_nav == "2") ? ' data-thumb="'.$wset['img'.$i].'"' : ''; // 썸네일
		$data_caption = ($caption && $wset['caption'.$i]) ? ' title="#'.$wid.'_'.$i.'"' : ''; // 캡션

	?>
		<?php if($wset['link'.$i]) { ?>
			<a href="<?php echo $wset['link'.$i];?>"<?php echo ($wset['target'.$i]) ? ' target="'.$wset['target'.$i].'"' : '';?>>
		<?php } else { ?>
			<a>
		<?php } ?>
			<img src="<?php echo $wset['img'.$i];?>" alt=""<?php echo $data_thumb;?><?php echo $data_caption;?>>
		</a>
	<?php $k++; } ?>
	<?php if(!$k) { ?>
		<a><img src="<?php echo $widget_url;?>/img/title1.jpg" title="위젯설정에서 슬라이더를 등록해 주세요." alt=""<?php echo ($is_nav == "2") ? ' data-thumb="'.$widget_url.'/img/title1.jpg"' : '';?>></a>
		<a><img src="<?php echo $widget_url;?>/img/title2.jpg" title="위젯설정에서 슬라이더를 등록해 주세요." alt=""<?php echo ($is_nav == "2") ? ' data-thumb="'.$widget_url.'/img/title2.jpg"' : '';?>></a>
	<?php } ?>
</div>
<?php 
if($caption) { // 캡션 사용시 출력
	$is_ellipsis = ($caption == "1" || $caption == "2") ? ' ellipsis' : '';
	for ($i=1; $i <= $wset['slider']; $i++) {
		
		if(!$wset['use'.$i] || !$wset['caption'.$i]) continue; // 사용하지 않으면 건너뜀
?>
	<div id="<?php echo $wid;?>_<?php echo $i;?>" class="nivo-html-caption<?php echo $is_ellipsis;?>">
		<?php echo apms_fa($wset['caption'.$i]);?>
	</div>
<?php } } ?>

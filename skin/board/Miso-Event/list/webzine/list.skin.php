<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 더보기 & 무한스크롤
$is_infinite = (isset($boset['mode']) && $boset['mode']) ? $boset['mode'] : '';

if($is_infinite) {
	apms_script('infinite');
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css" media="screen">', 0);

// 헤드스킨
if(isset($boset['hskin']) && $boset['hskin']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$boset['hskin'].'.css" media="screen">', 0);
	$head_class = 'div-head list-head';
} else {
	$head_class = (isset($boset['hcolor']) && $boset['hcolor']) ? 'div-head border-'.$boset['hcolor'] : 'div-head border-black';
}

?>
<div class="list-board">
	<ul id="list-container" class="board-list">
	<?php
		$is_ajax = false;
		include_once($list_skin_path.'/list.rows.php');
	?>
	</ul>
	<div class="clearfix"></div>
	<?php if (!$is_list) { ?>
		<div class="wr-none">등록된 이벤트가 없습니다.</div>
	<?php } ?>
</div>
<?php if($is_infinite) { ?>
	<div id="list-nav">
		<a href="<?php echo $list_skin_url;?>/list.rows.php?bo_table=<?php echo $bo_table;?><?php echo preg_replace("/&amp;page\=([0-9]+)/", "", $qstr);?>&amp;npg=<?php echo ($page > 1) ? ($page - 1) : 0;?>&amp;page=2"></a>
	</div>
	<?php if($is_infinite == "1") { ?>
		<div class="list-more">
			<a id="list-more" href="#" title="더보기"><i class="fa fa-arrow-circle-down fa-4x"></i><span class="sound_only">더보기</span></a>
		</div>
		<div class="h15"></div>
	<?php } ?>
	<script type="text/javascript">
		$(function(){
			var $container = $('#list-container');

			$container.infinitescroll({
				navSelector  : '#list-nav',    // selector for the paged navigation
				nextSelector : '#list-nav a',  // selector for the NEXT link (to page 2)
				itemSelector : '.list-item',     // selector for all items you'll retrieve
				loading: {
					msgText: '로딩 중...',
					finishedMsg: '더이상 이벤트가 없습니다.',
					img: '<?php echo APMS_PLUGIN_URL;?>/img/loader.gif',
				}
			}, function( newElements ) { // trigger Masonry as a callback
				var $newElems = $( newElements ).css({ opacity: 0 });
				$container.append($newElems);
				$newElems.animate({ opacity: 1 });
			});
			<?php if($is_infinite == "1") { //더보기 ?>
			$(window).unbind('.infscr');
			$('#list-more').click(function(){
			   $container.infinitescroll('retrieve');
			   $('#list-nav').show();
				return false;
			});
			$(document).ajaxError(function(e,xhr,opt){
				if(xhr.status==404) $('#list-nav').remove();
			});
			<?php } ?>
		});
	</script>
<?php } ?>
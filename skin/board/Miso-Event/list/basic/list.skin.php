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

// 숨김설정
$is_num = (isset($boset['lnum']) && $boset['lnum']) ? false : true;
$is_hit = (isset($boset['lhit']) && $boset['lhit']) ? false : true;

// 보임설정
$is_category = (isset($boset['lcate']) && $boset['lcate']) ? true : false;
$is_thumb = (isset($boset['lthumb']) && $boset['lthumb']) ? true : false;

?>
<?php if($is_thumb) { ?>
	<style>
		.list-board .board-list .thumb-icon a { 
			<?php echo (isset($boset['ibg']) && $boset['ibg']) ? 'background:'.apms_color($boset['icolor']).'; color:#fff' : 'color:'.apms_color($boset['icolor']);?>; 
		}
	</style>
<?php } ?>
<div class="list-board">
	<div class="board-head <?php echo $head_class;?>">
		<?php if($is_num) { ?>
			<span class="wr-num<?php echo $num_hidden;?>">번호</span>
		<?php } ?>
		<span class="wr-status">상태</span>
		<?php if($is_thumb) { ?>
			<span class="wr-thumb">포토</span>
		<?php } ?>
		<span class="wr-subject">이벤트명</span>
		<span class="wr-how hidden-xs">방법</span>
		<span class="wr-winner hidden-xs">당첨자</span>
		<span class="wr-point hidden-xs"><?php echo subject_sort_link('as_down', $qstr2, 1) ?>당첨P</a></span>
		<span class="wr-point hidden-xs"><?php echo subject_sort_link('as_down', $qstr2, 1) ?>참가P</a></span>
		<span class="wr-join hidden-xs">참가자</span>
		<?php if ($is_hit) { ?>
			<span class="wr-hit hidden-xs"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회</a></span>
		<?php } ?>
		<?php if ($is_checkbox) { ?>
			<span class="wr-chk"><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"></span>
		<?php } ?>
	</div>
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
		<div id="list-more" class="cursor">
			<b>+ 더보기</b>
		</div>
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
<div class="h15"></div>
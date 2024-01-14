<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//스크립트 불러오기
if($boset['mode']) {
	apms_script('imagesloaded');
	apms_script('infinite');
}

if($boset['lightbox']) apms_script('lightbox');
apms_script('mosaic');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css" media="screen">', 0);

// 너비
$item_w = apms_img_width($board['bo_gallery_cols']);

// 간격
$gap = ($boset['gap'] == "") ? 5 : $boset['gap'];

// 무한스크롤 상단 컨트롤
if($boset['mode'] == "2")
	include_once($list_skin_path.'/list.top.skin.php');
?>
<style>
	.list-wrap .list-mosaic { overflow:hidden; list-style:none; padding:0; margin:0 <?php echo ($gap > 0) ? '-'.$gap : 0;?>px <?php echo ($gap > 15) ? $gap : 15;?>px }
	.list-wrap .list-row { float:left; }
	<?php if($boset['mode'] == "1") { ?>
	.list-wrap .list-more a:hover { 
		color:<?php echo (isset($boset['moreb']) && $boset['moreb']) ? apms_color($boset['moreb']) : 'orangered';?>; 
	}
	<?php } ?>
</style>
<ul class="list-mosaic">
	<?php
		$is_ajax = false;
		include_once($list_skin_path.'/list.rows.php');
	?>
</ul>
<div class="clearfix"></div>
<?php if (!$is_list) { ?>
	<div class="text-center text-muted list-none">게시물이 없습니다.</div>
<?php } ?>
<?php if($boset['mode']) { // 더보기, 무한스크롤 ?>
	<div id="list-nav">
		<a href="<?php echo $list_skin_url;?>/list.rows.php?bo_table=<?php echo $bo_table;?><?php echo preg_replace("/&amp;page\=([0-9]+)/", "", $qstr);?>&amp;npg=<?php echo ($page > 1) ? ($page - 1) : 0;?>&amp;page=2"></a>
	</div>
	<?php if($boset['mode'] == "1") { ?>
		<div class="list-more">
			<a id="list-more" href="#" title="더보기"><i class="fa fa-arrow-circle-down"></i><span class="sound_only">더보기</span></a>
		</div>
	<?php } ?>
<?php } ?>
<script type="text/javascript">
	$(function(){
		var $container = $('.list-mosaic');

		$container.jMosaic({
			items_type: "li", 
			margin: <?php echo $gap;?>,
			min_row_height: <?php echo ($boset['min_h'] > 0) ? $boset['min_h'] : 180;?>
		});
		<?php if($boset['mode']) { ?>
		$container.infinitescroll({
			navSelector  : '#list-nav',    // selector for the paged navigation
			nextSelector : '#list-nav a',  // selector for the NEXT link (to page 2)
			itemSelector : '.list-row',     // selector for all items you'll retrieve
			loading: {
				finishedMsg: 'No more items to load.',
				img: '<?php echo APMS_PLUGIN_URL;?>/img/loader.gif',
			}
		}, function( newElements ) { // trigger Masonry as a callback
			var $newElems = $( newElements ).css({ opacity: 0 });
			$newElems.imagesLoaded(function(){
				$container.append($newElems);
				$container.jMosaic({
					items_type: "li", 
					margin: <?php echo $gap;?>,
					min_row_height: <?php echo ($boset['min_h'] > 0) ? $boset['min_h'] : 180;?>
				});
			}).animate({ opacity: 1 });
		});
		<?php if($boset['mode'] == "1") { // 더보기 ?>
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
		<?php } ?>
		$(window).resize(function() {
			$container.jMosaic({
				items_type: "li", 
				margin: <?php echo $gap;?>,
				min_row_height: <?php echo ($boset['min_h'] > 0) ? $boset['min_h'] : 180;?>
			});
		});
	});
</script>
<?php if (!$is_list) { ?>
	<div class="text-center text-muted list-none">게시물이 없습니다.</div>
<?php } ?>

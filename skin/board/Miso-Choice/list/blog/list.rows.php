<?php
if (!defined('_GNUBOARD_')) {
	// AJAX일 때
	$is_ajax = true;
	include_once('../../../../../common.php');
	include_once(G5_BBS_PATH.'/list.rows.php');
	$list_cnt = count($list);
	if(!$list_cnt) exit;

	// 창열기
	$is_modal_js = $is_link_target = '';
	if($boset['modal'] == "1") { // 모달
		$is_modal_js = ' onclick="view_modal(this.href); return false;"';
	} else if($boset['modal'] == "2") { //링크#1
		$is_link_target = ' target="_blank"';
	}

	// 라벨
	$labels = array();
	$label_cnt = 0;
	if($boset['label']) {
		$labels = apms_label_list($boset);
		$label_cnt = count($labels);
		if(!$label_cnt) $label_cnt = 1;
	}

	if(!$boset['list_skin']) $boset['list_skin'] = 'list'; // 목록스킨

	$list_skin_url = $board_skin_url.'/list/'.$boset['list_skin'];
	$list_skin_path = $board_skin_path.'/list/'.$boset['list_skin'];
}

$ellipsis = (G5_IS_MOBILE) ? '' : ' class="ellipsis"';
$cont_len = (G5_IS_MOBILE) ? $boset['m_cont'] : $boset['cont'];
if($cont_len == "") $cont_len = 100;
$color = ($boset['color']) ? $boset['color'] : 'green';
$shadow = ($boset['shadow']) ? ' shadow' : '';

// 라벨
$is_itack = $is_stack = false;
if($label_cnt) {
	switch($boset['tack']) {
		case '1'	: $is_stack = true; break;
		case '2'	: $is_itack = true; $is_stack = true; break;
		default		: $is_itack = true; break;
	}
}

// 리스트
for ($i=0; $i < $list_cnt; $i++) { 

	if($list[$i]['is_notice']) continue;		

	// 라벨
	$wr_tack = '';
	if($label_cnt) { 
		list($label_name, $label_color) = apms_label_icon($list[$i]['ca_name'], $labels, $label_cnt, $boset['label_name'], $boset['label_color']);
		$wr_tack = ($label_name) ? '<span class="tack-icon bg-'.$label_color.'">'.$label_name.'</span>' : '';
	}

	// 아이콘 체크
	$is_lock = false;
	$wr_lock = $wr_label = $wr_icon = '';
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$wr_lock = '<span class="wr-icon wr-secret"></span>';
		$list[$i]['wr_content'] = ($list[$i]['is_lock']) ? '잠긴글입니다' : '비밀글입니다.';
		$is_lock = true;
	}

	// 공지, 현재글 스타일 체크
	$fa_icon = 'comment';
	if ($wr_id == $list[$i]['wr_id']) { // 현재글
		$wr_label = '<div class="label-cap bg-blue">Now</div>';
		$wr_icon = '<span class="tack-icon bg-blue">현재</span>';
	} else if($is_lock) {
		$wr_label = '<div class="label-band bg-red">Lock</div>';
		$fa_icon = 'lock';
	} else if ($list[$i]['icon_hot']) {
		$wr_label = '<div class="label-cap bg-orange">Hot</div>';
		$wr_icon = '<span class="tack-icon bg-orange">인기</span>';
		$fa_icon = 'thumbs-up';
	} else if ($list[$i]['icon_new']) {
		$wr_label = '<div class="label-cap bg-green">New</div>';
		$wr_icon = '<span class="tack-icon bg-green">새글</span>';
		$fa_icon = 'heart';
	} else if ($list[$i]['icon_link']) {
		$fa_icon = 'link';
	} else if ($list[$i]['icon_file']) {
		$fa_icon = 'download';
	}

	// 제목 라벨
	if($is_stack) {
		$wr_icon = ($wr_icon) ? $wr_icon : $wr_tack;
	}

	// 링크
	$list[$i]['target'] = '';
	if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
		$list[$i]['target'] = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	$img = ($is_lock) ? array('src'=>'', 'alt'=>'') : apms_wr_thumbnail($bo_table, $list[$i], 0, 0, false, true); // 썸네일

?>
	<div class="media list-media">
		<div class="list-item">
			<?php if($img['src']) { $fa_icon = 'picture-o'; ?>
				<div class="media-box<?php echo $shadow;?>">
					<?php if($is_itack) { ?>
						<div class="label-tack"><?php echo $wr_tack;?></div>
					<?php } ?>
					<?php echo $wr_label;?>
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
						<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>">
					</a>
					<?php if($boset['shadow']) echo apms_shadow($boset['shadow']); //그림자 ?>
				</div>
			<?php } ?>

			<div class="date-box en pull-left">
				<div class="date-item bg-<?php echo $color;?>">
					<span class="date"><?php echo date("d", $list[$i]['date']);?></span>
					<?php echo date("m, Y", $list[$i]['date']);?>
				</div>
				<div class="date-icon <?php echo $color;?>">
					<i class="fa fa-<?php echo $fa_icon;?>"></i>
				</div>
			</div>

			<div class="media-body">
				<h2 class="media-heading">
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $ellipsis;?><?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
						<?php echo $wr_icon;?>
						<?php echo $wr_lock;?>
						<?php if($wr_id && $list[$i]['wr_id'] == $wr_id) {?>
							<span class="crimson"><?php echo $list[$i]['subject'];?></span>
						<?php } else { ?>
							<?php echo $list[$i]['subject'];?>
						<?php } ?>
					</a>
				</h2>
				<div class="list-details text-muted">
					<?php if ($is_checkbox) { ?>
						<span class="pull-right">
							<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
						</span>
					<?php } ?>
					<?php if($boset['name']) { ?>
						<?php echo $list[$i]['name'];?>
						<span class="list-sp">|</span>
					<?php } ?>
					<?php if($is_category && $list[$i]['ca_name']) { ?>
						<span class="hidden-xs">
							<?php echo $list[$i]['ca_name'];?>
							<span class="list-sp">|</span>
						</span>
					<?php } ?>
					댓글
					<?php echo ($list[$i]['wr_comment']) ? '<span class="red">'.number_format($list[$i]['wr_comment']).'</span>' : 0;?>
					<span class="list-sp">|</span>
					조회
					<?php echo number_format($list[$i]['wr_hit']);?>
					<?php if ($boset['udp'] && $list[$i]['as_down']) { ?>
						<span class="list-sp">|</span>
						다운
						<?php echo number_format($list[$i]['as_down']); ?>P
					<?php } ?>
					<?php if ($is_good) { ?>
						<span class="list-sp">|</span>
						추천
						<?php echo number_format($list[$i]['wr_good']);?>
					<?php } ?>
					<span class="hidden-xs">
						<span class="list-sp">|</span>
						<?php echo apms_datetime($list[$i]['date'], 'Y.m.d'); ?>
					</span>
				</div>
				<?php if($cont_len > 0) { ?>
					<div class="list-cont text-muted">
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
							<?php echo apms_cut_text($list[$i]['wr_content'], $cont_len,'… <span class="font-11 text-muted">더보기</span>');?>
						</a>
					</div>
				<?php } ?>
				<?php if($list[$i]['as_tag']) { ?>
					<div class="list-tag text-muted">
						<i class="fa fa-tags"></i> <?php echo apms_get_tag($list[$i]['as_tag']);?>
					</div>
				<?php } ?>
				<div class="read-more text-right">
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
						<span class="font-11 en">
							Read More <i class="fa fa-angle-right fa-lg"></i>
						</span>
					</a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<?php } ?>

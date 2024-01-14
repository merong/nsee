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

	// 나누기
	if(!$boset['masonry']) {
		echo '<div class="list-row clearfix"></div>'.PHP_EOL;
	}
}

// 이미지 비율
$thumb_w = $board['bo_'.MOBILE_.'gallery_width'];
$thumb_h = $board['bo_'.MOBILE_.'gallery_height'];
$img_h = apms_img_height($thumb_w, $thumb_h); // 이미지 높이

// 날짜
$is_date = '';
if($boset['date']) {
	$is_date = ($boset['trans']) ? 'trans-bg-'.$boset['date'] : 'bg-'.$boset['date'];
	$is_date = ($boset['right']) ? $is_date.' right' : $is_date.' left';
}

// 타켓
$target = ($boset['ltarget']) ? ' target="_blank"' : '';

$k = 0;
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
	$wr_icon = $wr_label = '';
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$wr_icon = "<span class='tack-icon bg-red'>비밀</span> ";
		$wr_label = '<div class="label-cap bg-red">Lock</div>';
		$is_lock = true;
	} else if ($list[$i]['icon_hot']) {
		$wr_icon = "<span class='tack-icon bg-orange'>인기</span> ";
		$wr_label = '<div class="label-cap bg-orange">Hot</div>';
	} else if ($list[$i]['icon_new']) {
		$wr_icon = "<span class='tack-icon bg-green'>새글</span> ";
		$wr_label = '<div class="label-cap bg-green">New</div>';
	}

	if($wr_id && $list[$i]['wr_id'] == $wr_id) {
		$wr_label = '<div class="label-cap bg-blue">Now</div>';
	}

	// 링크
	$list[$i]['target'] = '';
	if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
		$list[$i]['target'] = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

	// 썸네일
	$list[$i]['no_img'] = $board_skin_url.'/img/no-img.jpg'; // No-Image
	$img = ($is_lock) ? apms_thumbnail($list[$i]['no_img'], 0, 0, false, true) : apms_wr_thumbnail($bo_table, $list[$i], 0, 0, false, true);
	$thumb = apms_thumbnail($img['src'], $thumb_w, $thumb_h, false, true); // 썸네일

	//Caption
	if($list[$i]['target']) {
		$caption = "<a href='".$list[$i]['href']."' target='_blank'>".$wr_icon.apms_get_html($list[$i]['subject'], 1)."</a>";
	} else {
		$caption = "<a href='".$list[$i]['href']."'>".$wr_icon.apms_get_html($list[$i]['subject'], 1);
		$caption .= " &nbsp;<i class='fa fa-comment'></i> ";
		if($list[$i]['wr_comment']) $caption .= "<span class='en orangered'>".$list[$i]['wr_comment']."</span>&nbsp; ";
		$caption .= "<span class='font-normal font-11'>댓글달기</span></a>";
	}

?>
	<?php if(!$boset['masonry'] && $k > 0 && $k%$board['bo_gallery_cols'] == 0) { ?>
		<div class="list-row clearfix"></div>
	<?php } ?>
	<div class="list-row">
		<div class="list-item">
			<?php if($thumb_h > 0) { ?>
				<div class="imgframe">
					<div class="img-wrap" style="padding-bottom:<?php echo $img_h;?>%;">
						<div class="img-item">
							<?php if ($wr_tack) { ?>
								<div class="label-tack"><?php echo $wr_tack;?></div>
							<?php } ?>
							<?php echo $wr_label;?>
							<?php if ($is_checkbox) { ?>
								<div class="tack-check<?php echo ($boset['right']) ? '-left' : '';?>">
									<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
								</div>	
							<?php } ?>
							<?php if($is_modal_js) { ?>
								<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?>>
							<?php } else { ?>
								<a href="<?php echo $img['src'];?>" data-lightbox="<?php echo $bo_table;?>-lightbox" data-title="<?php echo $caption;?>">
							<?php } ?>
								<img src="<?php echo $thumb['src'];?>" alt="<?php echo $img['alt'];?>">
							</a>
						</div>
					</div>
					<?php if($is_date) { ?>
						<div class="list-date <?php echo $is_date;?> en">
							<?php echo date("Y.m.d", $list[$i]['date']); ?>
						</div>
					<?php } ?>
				</div>
			<?php } else { ?>
				<div class="list-img">
					<?php if ($wr_tack) { ?>
						<div class="label-tack"><?php echo $wr_tack;?></div>
					<?php } ?>
					<?php echo $wr_label;?>
					<?php if ($is_checkbox) { ?>
						<div class="tack-check<?php echo ($boset['right']) ? '-left' : '';?>">
							<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
						</div>	
					<?php } ?>
					<?php if($is_modal_js) { ?>
						<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?>>
					<?php } else { ?>
						<a href="<?php echo $img['src'];?>" data-lightbox="<?php echo $bo_table;?>-lightbox" data-title="<?php echo $caption;?>">
					<?php } ?>
						<img src="<?php echo $thumb['src'];?>" alt="<?php echo $img['alt'];?>">
					</a>
					<?php if($is_date) { ?>
						<div class="list-date <?php echo $is_date;?> en">
							<?php echo date("Y.m.d", $list[$i]['date']); ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
			<?php if($boset['shadow']) echo apms_shadow($boset['shadow']); //그림자 ?>
		</div>
	</div>
<?php $k++; } ?>

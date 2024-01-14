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

$cont_len = (G5_IS_MOBILE) ? $boset['m_cont'] : $boset['cont'];
if(!$cont_len) $cont_len = 100;

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
	$wr_lock = $wr_icon = $wr_label = '';
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$wr_lock = '<span class="wr-icon wr-secret"></span>';
		$list[$i]['wr_content'] = ($list[$i]['is_lock']) ? '잠긴글입니다' : '비밀글입니다.';
		$is_lock = true;
	}

	// 공지, 현재글 스타일 체크
	if ($wr_id == $list[$i]['wr_id']) { // 현재글
		$wr_label = '<div class="label-band bg-blue">Now</div>';
		$wr_icon = '<span class="tack-icon bg-blue">현재</span>';
	} else if($is_lock) {
		$wr_label = '<div class="label-band bg-red">Lock</div>';
	} else if ($list[$i]['icon_hot']) {
		$wr_label = '<div class="label-band bg-orange">Hot</div>';
		$wr_icon = '<span class="tack-icon bg-orange">인기</span>';
	} else if ($list[$i]['icon_new']) {
		$wr_label = '<div class="label-band bg-green">New</div>';
		$wr_icon = '<span class="tack-icon bg-green">새글</span>';
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

	// 아이콘
	$wr_photo = ($list[$i]['as_icon']) ? apms_fa(apms_emo($list[$i]['as_icon'])) : '';
	if(!$wr_photo) {
		$wr_photo = apms_photo_url($list[$i]['mb_id']);
		$wr_photo = ($wr_photo) ? '<img src="'.$wr_photo.'">' : '<i class="fa fa-user"></i>';
	}

	$list[$i]['no_img'] = ''; // No-Image
	if($boset['lightbox']) { //라이트박스
		$img = ($is_lock) ? apms_thumbnail($list[$i]['no_img'], 0, 0, false, true) : apms_wr_thumbnail($bo_table, $list[$i], 0, 0, false, true);
		$thumb = apms_thumbnail($img['src'], $thumb_w, $thumb_h, false, true); // 썸네일
		$caption = "<a href='".$list[$i]['href']."'>".str_replace('"', '\'', $wr_icon).apms_get_html($list[$i]['subject'], 1);
		$caption .= " &nbsp;<i class='fa fa-comment'></i> ";
		if($list[$i]['wr_comment']) $caption .= "<span class='en orangered'>".$list[$i]['wr_comment']."</span>&nbsp; ";
		$caption .= "<span class='font-normal font-11'>댓글달기</span></a>";
	} else {
		$thumb = ($is_lock) ? apms_thumbnail($list[$i]['no_img'], $thumb_w, $thumb_h, false, true) : apms_wr_thumbnail($bo_table, $list[$i], $thumb_w, $thumb_h, false, true);
	}

?>
	<?php if(!$boset['masonry'] && $k > 0 && $k%$board['bo_gallery_cols'] == 0) { ?>
		<div class="list-row clearfix"></div>
	<?php } ?>
	<div class="list-row">
		<div class="list-item">
			<div class="talk-box-wrap">
				<div class="talk-box talk-bottom">
					<div class="talker-two list-details">
						<span class="talker-photo pull-left"><?php echo $wr_photo;?></span>
						<?php echo $list[$i]['name'];?>
						<?php if($is_category && $list[$i]['ca_name']) { ?>
								<span class="list-sp">|</span>
								<?php echo $list[$i]['ca_name'];?>
						<?php } ?>
						<div class="talker-info text-muted">
							<?php if ($is_checkbox) { ?>
								<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>"> &nbsp;
							<?php } ?>
							<i class="fa fa-comment"></i> <?php echo ($list[$i]['wr_comment']) ? '<span class="red">'.number_format($list[$i]['wr_comment']).'</span>' : '<span>0</span>';?>
							<?php if ($is_good) { ?>
								<i class="fa fa-thumbs-up"></i> <?php echo ($list[$i]['wr_good']) ? '<span class="blue">'.number_format($list[$i]['wr_good']).'</span>' : '<span>0</span>';?>
							<?php } ?>
							<?php if ($boset['udp'] && $list[$i]['as_down']) { ?>
								<i class="fa fa-download"></i>
								<?php echo number_format($list[$i]['as_down']); ?>P
							<?php } else { ?>
								<i class="fa fa-clock-o"></i> <span><?php echo date("Y.m.d", $list[$i]['date']); ?></span>
							<?php } ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="talk-bubble">
						<div class="list-content">
							<?php echo $wr_label;?>
							<?php if($thumb['src']) { ?>
								<div class="list-img">
									<?php if($is_itack) { ?>
										<div class="label-tack"><?php echo $wr_tack;?></div>
									<?php } ?>
									<?php if($boset['lightbox']) { //라이트박스 ?>
										<a href="<?php echo $img['src'];?>" data-lightbox="<?php echo $bo_table;?>-lightbox" data-title="<?php echo $caption;?>">
									<?php } else { ?>
										<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
									<?php } ?>
										<img src="<?php echo $thumb['src'];?>" alt="<?php echo $thumb['alt'];?>">
									</a>
									<?php if($boset['shadow']) echo apms_shadow($boset['shadow']); //그림자 ?>
								</div>
							<?php } ?>
							<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
								<?php echo $wr_icon;?>
								<?php echo $wr_lock;?>
								<?php echo apms_cut_text($list[$i]['wr_content'], $cont_len,'… <span class="font-11 text-muted">더보기</span>');?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $k++; } ?>

<?php
if (!defined('_GNUBOARD_')) {
	// AJAX일 때
	$is_ajax = true;
	include_once('../../../../../common.php');
	include_once(G5_LIB_PATH.'/apms.event.lib.php');
	include_once(G5_BBS_PATH.'/list.rows.php');
	$list_cnt = count($list);
	if(!$list_cnt) exit;

	// 값정리
	$boset['modal'] = (isset($boset['modal'])) ? $boset['modal'] : '';
	$boset['list_skin'] = (isset($boset['list_skin']) && $boset['list_skin']) ? $boset['list_skin'] : 'basic';

	//창열기
	$is_modal_js = $is_link_target = '';
	if($boset['modal'] == "1") { //모달
		$is_modal_js = ' onclick="view_modal(this.href); return false;"';
	} else if($boset['modal'] == "2") { //링크#1
		$is_link_target = ' target="_blank"';
	}

	$list_skin_url = $board_skin_url.'/list/'.$boset['list_skin'];
	$list_skin_path = $board_skin_path.'/list/'.$boset['list_skin'];

	// 숨김설정
	$is_num = (isset($boset['lnum']) && $boset['lnum']) ? false : true;
	$is_hit = (isset($boset['lhit']) && $boset['lhit']) ? false : true;

	// 보임설정
	$is_category = (isset($boset['lcate']) && $boset['lcate']) ? true : false;
	$is_thumb = (isset($boset['lthumb']) && $boset['lthumb']) ? true : false;

}

for ($i=0; $i < $list_cnt; $i++) { 

	$ev = apms_event_info($bo_table, $list[$i]['wr_id'], $list[$i]); // 이벤트 정보

	$wr_status = '<span class="text-muted">종료</span>'; 
	if($ev['status'] == '시작전') {
		$wr_status = '<span class="blue">예정</span>'; 
	} else if($ev['status'] == '진행중') {
		$wr_status = '<span class="orangered">진행</span>'; 
	}

	if($ev['win_pay']) { 
		$wr_point = '1/n';
	} else {
		$wr_point = ($list[$i]['as_down'] > 0) ? number_format($list[$i]['as_down']) : '-';
	}

	//아이콘 체크
	$wr_icon = '';
	$is_lock = false;
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$wr_icon = '<span class="wr-icon wr-secret"></span>';
		$is_lock = true;
	} else if ($list[$i]['icon_hot']) {
		//$wr_icon = '<span class="wr-icon wr-hot"></span>';
	} else if ($list[$i]['icon_new']) {
		$wr_icon = '<span class="wr-icon wr-new"></span>';
	} else if ($list[$i]['icon_video']) {
		//$wr_icon = '<span class="wr-icon wr-video"></span>';
	} else if ($list[$i]['icon_image']) {
		//$wr_icon = '<span class="wr-icon wr-image"></span>';
	} else if ($list[$i]['icon_file']) {
		//$wr_icon = '<span class="wr-icon wr-file"></span>';
	}

	// 공지, 현재글 스타일 체크
	$li_css = '';
	if ($list[$i]['is_notice']) { // 공지사항
		$li_css = ' bg-light';
		$list[$i]['num'] = '*';
		$list[$i]['ca_name'] = '';
		$list[$i]['subject'] = '<b>'.$list[$i]['subject'].'</b>';
		$wr_status = '<span class="wr-icon wr-notice"></span>'; 
	} else {
		if($is_category && $list[$i]['ca_name']) {
			$list[$i]['subject'] = '['.$list[$i]['ca_name'].'] '.$list[$i]['subject'];
		}
		if ($wr_id == $list[$i]['wr_id']) {
			$li_css = ' bg-light';
			$list[$i]['num'] = '<span class="wr-text orangered">열람중</span>';
			$list[$i]['subject'] = '<b class="red">'.$list[$i]['subject'].'</b>';
		}
	}

	// 링크이동
	$list[$i]['target'] = '';
	if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
		$list[$i]['target'] = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}


?>
	<li class="list-item<?php echo $li_css;?>">
		<?php if($is_num) { ?>
			<div class="wr-num hidden-xs"><?php echo $list[$i]['num']; ?></div>
		<?php } ?>
		<div class="wr-status"><?php echo $wr_status; ?></div>
		<?php if($list[$i]['is_notice']) { //공지일 때 ?>
			<div class="wr-subject">
				<a href="<?php echo $list[$i]['href']; ?>" class="item-subject"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
					<?php echo $list[$i]['icon_reply']; ?>
					<?php echo $wr_icon; ?>
					<?php echo $list[$i]['subject']; ?>
					<?php if ($list[$i]['wr_comment']) { ?>
						<span class="count orangered hidden-xs"><?php echo $list[$i]['wr_comment']; ?></span>
					<?php } ?>
				</a>
				<div class="item-details text-muted font-12 visible-xs ellipsis">
					<span><i class="fa fa-comment"></i> <?php echo $list[$i]['wr_comment']; ?></span>
					<span><i class="fa fa-eye"></i> <?php echo $list[$i]['wr_hit']; ?></span>
					<span><i class="fa fa-clock-o"></i> <?php echo apms_datetime($list[$i]['date'], "Y.m.d"); ?></span>
				</div>
			</div>
			<div class="wr-date hidden-xs">
				<?php echo date("Y.m.d", $list[$i]['date']); ?>
			</div>
		<?php } else { // 글일 때 ?>
			<?php if($is_thumb) { //썸네일 ?>
				<div class="wr-thumb">
					<?php
					$img = apms_wr_thumbnail($bo_table, $list[$i], 50, 50, false, true); // 썸네일
					if($img['src']) { 
					?>
						<div class="thumb-img">
							<div class="img-wrap" style="padding-bottom:100%;">
								<div class="img-item">
									<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
										<img src="<?php echo $img['src'];?>">
									</a>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div class="thumb-icon">
							<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
								<?php
									// 아이콘
									$thumb_icon = ($list[$i]['as_icon']) ? apms_fa(apms_emo($list[$i]['as_icon'])) : '';
									if(!$thumb_icon) {
										$thumb_icon = apms_photo_url($list[$i]['mb_id']);
										$thumb_icon = ($thumb_icon) ? '<img src="'.$thumb_icon.'">' : '<i class="fa fa-user"></i>';
									}
									echo $thumb_icon;
								?>
							</a>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
			<div class="wr-subject">
				<a href="<?php echo $list[$i]['href']; ?>" class="item-subject"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
					<?php echo $list[$i]['icon_reply']; ?>
					<?php echo $wr_icon; ?>
					<?php echo $list[$i]['subject']; ?>
					<?php if ($list[$i]['wr_comment']) { ?>
						<span class="count orangered hidden-xs"><?php echo $list[$i]['wr_comment']; ?></span>
					<?php } ?>
				</a>
				<div class="item-details text-muted font-12 visible-xs ellipsis">
					<span><i class="fa fa-comment"></i> <?php echo $list[$i]['wr_comment']; ?></span>
					<?php if($ev['status'] != '시작전') { ?>
						<span><i class="fa fa-user"></i> <?php echo $ev['tender_count'];?></span>
					<?php } ?>
					<span><i class="fa fa-trophy"></i> <?php echo $ev['win'];?></span>
					<?php if($wr_point != '-') { ?>
						<span><i class="fa fa-gift"></i> <?php echo $wr_point;?></span>
					<?php } ?>
					<?php if($ev['entry_point'] > 0) { ?>
						<span><i class="fa fa-flag"></i> <?php echo number_format($ev['entry_point']);?></span>
					<?php } ?>
				</div>
			</div>
			<div class="wr-how hidden-xs">
				<?php 
					switch($ev['type']) {
						case '1' : echo '랜덤'; break;
						case '2' : echo '별도'; break;
						default	 : echo '입찰'; break;
					}
				?>
			</div>
			<div class="wr-winner hidden-xs">
				<?php echo $ev['win']; ?>명
			</div>
			<div class="wr-point hidden-xs">
				<?php echo $wr_point;?>
			</div>
			<div class="wr-point hidden-xs">
				<?php echo ($ev['entry_point'] > 0) ? number_format($ev['entry_point']) : '-';?>
			</div>
			<div class="wr-join hidden-xs">
				<?php echo ($ev['status'] == '시작전') ? '-' : number_format($ev['tender_count']).'명';?>
			</div>
		<?php } ?>
		<?php if ($is_hit) { ?>
			<div class="wr-hit hidden-xs">
				<?php echo $list[$i]['wr_hit'];?>
			</div>
		<?php } ?>
		<?php if ($is_checkbox) { ?>
			<div class="wr-chk">
				<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
			</div>
		<?php } ?>
	</li>
<?php } ?>

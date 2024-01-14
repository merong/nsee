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

	if($list[$i]['is_notice']) continue; //공지제외

	$ev = apms_event_info($bo_table, $list[$i]['wr_id'], $list[$i]); // 이벤트 정보

	//아이콘 체크
	$wr_icon = '<i class="fa fa-gift fa-lg"></i>';
	$is_lock = false;
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$wr_icon = '<i class="fa fa-lock fa-lg orange"></i>';
		$is_lock = true;
	} else if ($list[$i]['icon_hot']) {
		$wr_icon = '<i class="fa fa-thumbs-up fa-lg blue"></i>';
	} else if ($list[$i]['icon_new']) {
		$wr_icon = '<i class="fa fa-gift fa-lg orangered"></i>';
	}

	// 링크이동
	$list[$i]['target'] = '';
	if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
		$list[$i]['target'] = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}
?>
	<li class="list-item<?php echo $li_css;?>">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">
					<div class="pull-left wr-subject font-14">
						<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
							<?php echo $wr_icon;?>
							<b><?php echo $list[$i]['subject']; ?></b>
						</a>
					</div>
					<div class="pull-right wr-num font-14 en">
						<i class="fa fa-users"></i>
						<?php echo ($ev['tender_count']) ? '<b class="blue">'.number_format($ev['tender_count']).'</b>' : 0; //참여수 ?>
						&nbsp; &nbsp;
						<i class="fa fa-comment"></i>
						<?php echo ($list[$i]['wr_comment']) ? '<b class="red">'.number_format($list[$i]['wr_comment']).'</b>' : 0; //댓글수 ?>
						&nbsp; &nbsp;
						<i class="fa fa-eye"></i>
						<?php echo number_format($list[$i]['wr_hit']); //조회수 ?>
						<?php if ($is_checkbox) { ?>
							&nbsp;
							<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
						<?php } ?>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="media no-margin">
					<?php 
						$list[$i]['no_img'] = $board_skin_url.'/img/event.jpg';
						$img = apms_wr_thumbnail($bo_table, $list[$i], 400, 400, false, true); // 썸네일
					?>
					<div class="pull-left wr-photo">
						<div class="img-wrap" style="padding-bottom:100%;">
							<div class="img-item">
								<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
									<img src="<?php echo $img['src'];?>">
								</a>
							</div>
						</div>
					</div>
					<div class="media-body">
						<div class="row row-15">
							<div class="col-sm-4 col-15">
								현재상태 : 
								<b>
								<?php 
									// 이벤트 상태
									switch($ev['status']) {
										case '시작전'	: echo '시작전'; break;
										case '종료'		: echo '<span class="text-muted">종료</span>'; break;
										default			: echo '<span class="orangered">진행중</span>'; break;
									}
								?>
								</b>
							</div>
							<div class="col-sm-4 col-15">
								당첨방법 : 
								<?php 
									switch($ev['type']) {
										case '1' : echo '랜덤당첨'; break;
										case '2' : echo '별도선정'; break;
										default	 : echo '최고입찰'; break;
									}
								?>
							</div>
							<div class="col-sm-4 col-15">
								당첨인원 : 총 <b><?php echo number_format($ev['win']); ?></b> 명
							</div>
							<div class="col-sm-4 col-15">
								시작일시 : <?php echo date("Y/m/d H:i", strtotime($ev['start_datetime'])); ?>
							</div>
							<div class="col-sm-4 col-15">
								종료일시 : <?php echo date("Y/m/d H:i", strtotime($ev['end_datetime'])); ?>
							</div>
							<?php if($list[$i]['as_down'] > 0) { ?>
								<div class="col-sm-4 col-15">
									당첨점수 : 
									<b class="orangered"><?php echo number_format($list[$i]['as_down']);?></b> <?php echo AS_MP;?>
									(<?php echo ($ev['win_pay']) ? '변동' : '고정';?>)
								</div>
								<?php if($ev['win_pay']) { ?>
									<div class="col-sm-4 col-15">
										총 참가점수의 1/n <?php echo ($ev['win_fee'] > 0) ? ' ('.$ev['win_fee'].'% 공제)' : ''; ?>
									</div>
								<?php } ?>
							<?php } ?>
							<?php if(!$ev['type']) { ?>
								<div class="col-sm-4 col-15">
									입찰점수 : <b><?php echo number_format($ev['tender_limit']); ?></b> <?php echo AS_MP;?> 이상
								</div>
								<div class="col-sm-4 col-15">
									입찰횟수 : 총 <b><?php echo number_format($ev['tender']); ?></b> 회 가능
								</div>
							<?php } ?>
							<div class="col-sm-4 col-15">
								참가점수 : <b><?php echo number_format($ev['entry_point']); ?></b> <?php echo AS_MP;?>
							</div>
						</div>
						<div class="text-right" style="margin-top:10px;">
							<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
								<i class="fa fa-angle-right"></i> 자세히보기
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</li>
<?php } ?>

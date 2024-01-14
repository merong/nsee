<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 썸네일
$wset['thumb_w'] = $wset['thumb_h'] = 80;
if(!$wset['rows']) $wset['rows'] = 6;

// 추출하기
$list = apms_board_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = ($wset['icon']) ? apms_fa($wset['icon']) : '<i class="fa fa-user"></i>';

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 리스트
for ($i=0; $i < $list_cnt; $i++) {

	// 아이콘
	$wr_icon = '';
	if($list[$i]['img']['src']) {
		$wr_icon = '<img src="'.$list[$i]['img']['src'].'" alt="'.$list[$i]['img']['alt'].'">';
	} else if($list[$i]['as_icon']) {
		$wr_icon = apms_fa(apms_emo($list[$i]['as_icon']));
	} else if($list[$i]['mb_id']) {
		$wr_icon = apms_photo_url($list[$i]['mb_id']);
		$wr_icon = ($wr_icon) ? '<img src="'.$wr_icon.'">' : '';
	}

	$wr_icon = ($wr_icon) ? $wr_icon : $icon;

	// 상태
	$is_choice = false;
	$choice_limit = (int)$list[$i]['wr_1']; // 여분필드 1
	$choice_limit = ($choice_limit > 0) ? $choice_limit : 1; // 여분필드 1
	if($list[$i]['as_choice_cnt'] >= $choice_limit) {
		$is_choice = true;
		$choice_icon = '<span class="tack-icon bg-orangered">완료</span>';
	} else {
		$choice_icon = '<span class="tack-icon bg-blue">진행</span>';
	}

	if (!$is_choice && $list[$i]['new']) {
		$choice_icon = '<span class="tack-icon bg-'.$wset['new'].'">새글</span>';
	}
?>
<li>
	<div class="media">
		<div class="pull-left">
			<a href="<?php echo $list[$i]['href'];?>">
				<span class="fix-icon circle normal">
					<?php echo $wr_icon;?>
				</span>
			</a>
		</div>
		<div class="media-body">
			<strong class="media-heading ellipsis">
				<a href="<?php echo $list[$i]['href'];?>">
					<?php if($wset['rank']) { ?>
						<span class="rank-icon en bg-<?php echo $wset['rank'];?>"><?php echo $rank; $rank++; ?></span>
					<?php } else { ?>
						<?php echo $choice_icon;?>
					<?php } ?>
					<?php echo $list[$i]['subject'];?>
				</a>
			</strong>
			<div class="details ellipsis">
				<?php if($wset['name']) { ?>
					<span class="sp font-12">
						<i class="fa fa-user"></i>
						<?php echo $list[$i]['name'];?>
					</span>
				<?php } ?>
				<?php if($wset['cate'] && $list[$i]['category']) { ?>
					<span class="sp font-12 hidden-xs">
						<i class="fa fa-tag"></i>
						<?php echo $list[$i]['category'];?>
					</span>
				<?php } ?>
				<span class="sp">
					<i class="fa fa-gift"></i>
					<?php echo ($list[$i]['as_choice'] > 0) ? '<span class="red">'.number_format($list[$i]['as_choice']).'</span>' : '-';?>
				</span>
				<span class="sp">
					<i class="fa fa-check"></i>
					<?php echo ($list[$i]['as_choice_cnt'] > 0) ? '<span class="red">'.number_format($list[$i]['as_choice_cnt']).'</span>' : '-';?> / <?php echo $choice_limit;?>
				</span>
				<span class="sp">
					<i class="fa fa-comment"></i>
					<?php echo ($list[$i]['comment']) ? '<span class="red">'.number_format($list[$i]['comment']).'</span>' : 0;?>
				</span>
				<?php if($wset['hit']) { ?>
					<span class="sp hidden-xs">
						<i class="fa fa-eye"></i>
						<?php echo ($list[$i]['hit']) ? '<span class="blue">'.number_format($list[$i]['hit']).'</span>' : 0;?>
					</span>
				<?php } ?>
				<?php if($wset['good']) { ?>
					<span class="sp">
						<i class="fa fa-thumbs-up"></i>
						<?php echo ($list[$i]['good']) ? '<span class="orangered">'.number_format($list[$i]['good']).'</span>' : 0;?>
					</span>
				<?php } ?>
				<?php if($wset['down']) { ?>
					<span class="sp">
						<i class="fa fa-download"></i>
						<?php echo ($list[$i]['as_download']) ? '<span class="green">'.number_format($list[$i]['as_download']).'</span>' : 0;?>
					</span>
				<?php } ?>
				<?php if($wset['date']) { ?>
					<span class="sp hidden-xs">
						<i class="fa fa-clock-o"></i>
						<?php echo date("m.d", $list[$i]['date']);?>
					</span>
				<?php } ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="item-none text-muted text-center">글이 없습니다.</li>
<?php } ?>

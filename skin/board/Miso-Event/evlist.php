<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/apms.event.lib.php');

if (!($bo_table && $wr_id)) {
	alert_close('값이 제대로 넘어오지 않았습니다.');
}

$ss_name = 'ss_view_'.$bo_table.'_'.$wr_id;
if (!get_session($ss_name)) {
	alert_close('해당 이벤트에서만 확인하실 수 있습니다.');
}

$row = sql_fetch(" select count(*) as cnt from {$g5['write_prefix']}{$bo_table} ", FALSE);
if (!$row['cnt']) {
	alert_close('존재하는 이벤트 게시판이 아닙니다.');
}

// 이벤트 정보
$ev = apms_event_info($bo_table, $wr_id, $write);

if (!$ev['start_datetime'] || !$ev['end_datetime']) {
	alert_close("조회 가능한 이벤트가 아닙니다.");
}

if (G5_TIME_YMDHIS < $ev['start_datetime']) {
	alert_close("이벤트 시작 전입니다.");
}

$list = array();

if($opt) { 
	//댓글명단
	$sql = " select mb_id, wr_name, wr_email, wr_homepage, as_level, min(wr_datetime) as datetime
				from $write_table 
				where mb_id <> '' and wr_parent = '$wr_id' and wr_is_comment = '1' and wr_comment_reply = '' and wr_datetime between '{$ev['start_datetime']}' and '{$ev['end_datetime']}'
				group by mb_id
				order by datetime ";
	$result = sql_query($sql);
	for ($i=0; $row=sql_fetch_array($result); $i++) {
	    $list[$i] = $row;
		if($is_admin) {
			$list[$i]['name'] = apms_sideview($row['mb_id'], $row['wr_name'], $row['wr_email'], $row['wr_homepage'], $row['as_level']);
			$list[$i]['id'] = $row['mb_id'];
		} else {
			$list[$i]['name'] = $row['wr_name'];
			$list[$i]['id'] = cut_str($row['mb_id'], 3, '*****');
		}
	}

} else { 
	//참여명단
	$sql = " select mb_id, count(*) as cnt, min(ev_datetime) as datetime, max(ev_point) as point 
				from {$g5['apms_event']} 
				where mb_id <> '' and bo_table = '$bo_table' and wr_id = '$wr_id' 
				group by mb_id
				order by datetime ";
	$result = sql_query($sql);
	for ($i=0; $row=sql_fetch_array($result); $i++) {
	    $list[$i] = $row;
		$mb = get_member($row['mb_id'], "mb_nick, mb_email, mb_homepage, as_level");
		if($is_admin) {
			$list[$i]['name'] = apms_sideview($row['mb_id'], $mb['mb_nick'], $mb['mb_email'], $mb['mb_homepage'], $mb['as_level']);
			$list[$i]['id'] = $row['mb_id'];
		} else {
			$list[$i]['name'] = $mb['mb_nick'];
			$list[$i]['id'] = cut_str($row['mb_id'], 3, '*****');
		}
	}
}

$list_cnt = count($list);

if(!$list_cnt) {
	//alert_close("참여한 회원이 없습니다.");
}

// 테마설정
$at = apms_gr_thema();
if(!defined('THEMA_PATH')) {
	include_once(G5_LIB_PATH.'/apms.thema.lib.php');
}

$g5['title'] = ($opt) ? '댓글명단' : '참여명단';
include_once(G5_PATH.'/head.sub.php');
if(!USE_G5_THEME) @include_once(THEMA_PATH.'/head.sub.php');
?>

<div class="ko" style="padding:15px;">
	<div class="well well-sm">
		<?php if($opt) { ?>
			<b>총 <b class="orangered"><?php echo number_format($list_cnt);?></b> 명이 댓글을 달았습니다.</b> (회원댓글만/대댓글 제외/이벤트 기간내)
		<?php } else { ?>
			<b>총 <b class="orangered"><?php echo number_format($list_cnt);?></b> 명이 참여를 하였습니다.</b>
		<?php } ?>
	</div>
	<div class="table-responsive">
		<table class="table div-table">
			<tr>
			<thead>
			<td class="text-center">번호</td>
			<td class="text-center">아이디</td>
			<td class="text-center">이름</td>
			<td class="text-center">시간</td>
			</tr>
			</thead>
			<tbody>
			<?php for($i=0; $i < $list_cnt; $i++) { ?>
				<tr<?php echo ($member['mb_id'] == $list[$i]['mb_id']) ? ' class="active"' : '';?>>
				<td class="text-center"><?php echo number_format($i+1);?></td>
				<td class="text-center"><?php echo $list[$i]['id'];?></td>
				<td class="text-center"><b><?php echo $list[$i]['name'];?></b></td>
				<td class="text-center"><?php echo $list[$i]['datetime'];?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>

	<p class="text-center">
		<button type="button" onclick="window.close();" class="btn btn-black btn-sm">닫기</button>
	</p>
</div>

<?php
if(!USE_G5_THEME) @include_once(THEMA_PATH.'/tail.sub.php');
include_once(G5_PATH.'/tail.sub.php');
?>
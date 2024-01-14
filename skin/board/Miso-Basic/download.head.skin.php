<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 개별다운 포인트로 재설정
$boset = array();
$boset = apms_unpack($board['as_set']);

// 열람
if($boset['urp']) {
	include_once($board_skin_path.'/reading.lib.php');

	$rpoint = (int)$write['as_view'];
	$is_reading_term = (int)$boset['rterm'];
	$is_reading = apms_check_reading($bo_table, $wr_id, $write['mb_id'], $member['mb_id'], $rpoint, $is_reading_term);

	if (!$is_reading) {
		alert('열람한 회원만 다운로드할 수 있습니다.');
	}
}

$is_downpoint = (isset($boset['udp']) && $boset['udp']) ? true : false;

if($is_downpoint) {
	$dpoint = $write['as_down'];
	$dpoint = ($dpoint > 0) ? $dpoint = $dpoint * (-1) : 0;
	$board['bo_download_point'] = ($dpoint < 0) ? $dpoint : $board['bo_download_point'];
}

?>
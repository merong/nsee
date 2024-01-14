<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_admin) {
	alert('관리자만 가능합니다.');
}

// 랜덤당첨
if($type) {
	$tender = 1;
	$tender_limit = 0;
}

// 값정리
$wr_1 = $sdate.' '.$shour.':00:00';
$wr_2 = $edate.' '.$ehour.':59:59';
$wr_3 = $type.'|'.$win.'|'.$entry_point.'|'.$entry_rate.'|'.$tender.'|'.$tender_limit.'|'.$show_win.'|'.$show_tender.'|'.$show_tender_win.'|'.$win_pay.'|'.$win_fee;

// 참여수
if($w == 'u') {
	$row = sql_fetch(" select count(*) as cnt from {$g5['apms_event']} where bo_table = '$bo_table' and wr_id = '$wr_id' ");
	$wr_4 = (int)$row['cnt'];
}

// 추가태그 정리
if($as_tag && $wr_10) {
	$as_tag = $as_tag.','.$wr_10;
} else if(!$as_tag && $wr_10) {
	$as_tag = $wr_10;
}

$boset['write_skin'] = (isset($boset['write_skin']) && $boset['write_skin']) ? $boset['write_skin'] : 'basic';
$write_skin_url = $board_skin_url.'/write/'.$boset['write_skin'];
$write_skin_path = $board_skin_path.'/write/'.$boset['write_skin'];

// 간단쓰기 제목처리
if($w == '' && isset($is_subject) && $is_subject) {
	$wr_subject = apms_cut_text($wr_content, 30); // 글내용 30자 자르기
}

@include_once($write_skin_path.'/write_update.head.skin.php');
?>
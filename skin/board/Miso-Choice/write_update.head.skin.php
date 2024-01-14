<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

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

$as_choice = (int)$as_choice;

if ($w == 'u') {
	if($as_choice < (int)$wr['as_choice'])
		alert('채택포인트는 기존 등록값보다 큰값으로만 수정할 수 있습니다.');
}

if((int)$boset['limit_point']) {
	if($as_choice > 0 && $as_choice > $member['mb_point']) {
		alert('설정한 채택포인트 보다 보유포인트가 부족합니다.');
	}
}

if((int)$boset['min_cp'] > 0) {
	if($as_choice < $boset['min_cp']) {
		alert('채택포인트는 '.$boset['min_cp'].AS_MP.' 이상 등록할 수 있습니다.');
	}		
}

if((int)$boset['max_cp'] > 0) {
	if($as_choice > $boset['max_cp']) {
		alert('채택포인트는 '.$boset['max_cp'].AS_MP.' 이하로만 등록할 수 있습니다.');
	}		
}

// 등록여부 체크 - 공지글이 아니고 새글일 때만
if(!$is_admin && $w == '') {

	$limit_cmt = ($boset['limit_cmt'] > 0) ? $boset['limit_cmt'] : 1;
	$limit_post = ($boset['limit_post'] > 0) ? $boset['limit_post'] : 1;

	$row = sql_fetch("select count(*) as cnt from $write_table where mb_id = '{$member['mb_id']}' and wr_is_comment = 0 and wr_comment >= '$limit_cmt' and as_choice > 0 and as_choice_cnt = 0 ");
	if($row['cnt'] >= $limit_post)
		alert('채택포인트가 등록된 글 중 댓글이 '.$limit_cmt.'개 이상 달린 미채택글이 '.$row['cnt'].'개 있습니다. 채택하셔야만 글등록이 가능합니다.');
}


@include_once($write_skin_path.'/write_update.head.skin.php');
?>
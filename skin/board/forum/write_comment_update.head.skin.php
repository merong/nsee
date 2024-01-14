<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$boset = array();
$boset = apms_unpack($board['as_set']);

$boset['view_skin'] = (isset($boset['view_skin']) && $boset['view_skin']) ? $boset['view_skin'] : 'basic';
$view_skin_url = $board_skin_url.'/view/'.$boset['view_skin'];
$view_skin_path = $board_skin_path.'/view/'.$boset['view_skin'];

if(!$is_admin) {
	if($w != 'cu') {
		// 회원가입 후 댓글등록 체크
		if($is_member && $boset['jcmt'] > 0) {
			$jwtime = strtotime($member['mb_datetime']) + ($boset['jcmt'] * 3600);
			if(G5_SERVER_TIME - $jwtime >= 0) {
				; //통과
			} else {
				if($is_ajax) {
			        apms_alert("1|댓글 등록은 ".date("Y년 m월 d일 H시 i분", $jwtime)." 이후부터 가능합니다.");
				} else {
					alert("댓글 등록은 ".date("Y년 m월 d일 H시 i분", $jwtime)." 이후부터 가능합니다.");
				}
			}
		}
	}
}

// 댓글등록 시간 변경
if($boset['cwtime'] > 0) {
	$config['cf_delay_sec'] = $boset['cwtime'];
}

// 댓글별점
$is_cmt_star = (isset($boset['vstar']) && $boset['vstar']) ? $boset['vstar'] : '';

?>

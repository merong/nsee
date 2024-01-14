<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// wr_8 : 복사
// wr_9 : 실명글
// wr_10 : 실명아이디

if(!$is_admin) {
	if($w != 'u') { //글수정이 아니면 작동

		// 회원가입 후 글등록 체크
		if($is_member && $boset['jpost'] > 0) {
			$jwtime = strtotime($member['mb_datetime']) + ($boset['jpost'] * 3600);
			if(G5_SERVER_TIME - $jwtime >= 0) {
				; //통과
			} else {
				alert("글 등록은 ".date("Y년 m월 d일 H시 i분", $jwtime)." 이후부터 가능합니다.");
			}
		}

		if($boset['pwterm'] && $boset['pwcnt'] > 0) {
			switch($boset['pwterm']) {
				case 'today'	: $pwcnt = '매일 '.number_format($boset['pwcnt']).'개'; break;
				case 'week'		: $pwcnt = '매주 '.number_format($boset['pwcnt']).'개'; break;
				case 'month'	: $pwcnt = '매월 '.number_format($boset['pwcnt']).'개'; break;
				case 'all'		: $pwcnt = '전체 '.number_format($boset['pwcnt']).'개'; break;
			}

			$sql_today = ($boset['pwterm'] == "all") ? '' : apms_sql_term($boset['pwterm'], 'wr_datetime'); // 기간(일수,today,yesterday,month,prev)

			if($is_member) { // 회원이면 mb_id로 체크
				$row = sql_fetch("select count(*) as cnt from $write_table where wr_is_comment = '0' and (mb_id = '{$member['mb_id']}' or wr_10 = '{$member['mb_id']}') $sql_today "); 
			} else { // 비회원이면 ip로 체크
				$row = sql_fetch("select count(*) as cnt from $write_table where wr_ip = '{$_SERVER['REMOTE_ADDR']}' and wr_is_comment = '0' $sql_today "); 
			}

			if($row['cnt'] >= $boset['pwcnt']) {
				alert("본 게시판은 ".$pwcnt." 까지만 글을 등록할 수 있습니다.");
			}
		}
	}
}

// 글등록 시간 변경
if($boset['pwtime'] > 0) {
	$config['cf_delay_sec'] = $boset['pwtime'];
}

// 간단쓰기 제목처리
if($w == '' && $is_subject) {
	$wr_subject = apms_cut_text($wr_content, 30); // 글내용 30자 자르기
}

// 내글반응 보내지 않음
if(!$notice && !$wr_9) { //공지가 아닐경우 실행
	$is_response = false;
}

$boset['write_skin'] = (isset($boset['write_skin']) && $boset['write_skin']) ? $boset['write_skin'] : 'basic';
$write_skin_url = $board_skin_url.'/write/'.$boset['write_skin'];
$write_skin_path = $board_skin_path.'/write/'.$boset['write_skin'];

@include_once($write_skin_path.'/write_update.head.skin.php');
?>
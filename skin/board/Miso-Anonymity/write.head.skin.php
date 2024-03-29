<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_admin) {
	if($w != 'u') { //글수정이 아니면 작동

		// 회원가입 후 글등록 체크
		if($is_member && $boset['jpost'] > 0) {
			$jwtime = strtotime($member['mb_datetime']) + ($boset['jpost'] * 3600);
			if(G5_SERVER_TIME - $jwtime >= 0) {
				; //통과
			} else {
				alert("글등록은 ".date("Y년 m월 d일 H시 i분", $jwtime)." 이후부터 가능합니다.");
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
				$row = sql_fetch("select count(*) as cnt from $write_table where mb_id = '{$member['mb_id']}' and wr_is_comment = '0' $sql_today "); 
			} else { // 비회원이면 ip로 체크
				$row = sql_fetch("select count(*) as cnt from $write_table where wr_ip = '{$_SERVER['REMOTE_ADDR']}' and wr_is_comment = '0' $sql_today "); 
			}

			if($row['cnt'] >= $boset['pwcnt']) {
				alert("본 게시판은 ".$pwcnt." 까지만 글을 등록할 수 있습니다.");
			}
		}
	}
}

?>

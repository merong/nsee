<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_admin) {
	if($boset['writer']) {
		if(!chk_multiple_admin($member['mb_id'], $boset['wlist'])) {
			alert('지정된 회원만 글을 등록할 수 있습니다.');
		}
	} else if($w != 'u') { //글수정이 아니면 작동

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

// 글등록 시간 변경
if($boset['pwtime'] > 0) {
	$config['cf_delay_sec'] = $boset['pwtime'];
}

// 열람
if(isset($boset['urp']) && $boset['urp']) {
	if($as_view == "" || $as_view >= 0) {
		;
	} else {
		alert("양수만 등록할 수 있습니다.");
	}

	if(!$is_admin) {
		if($boset['nrp'] > 0) {
			if($as_view < $boset['nrp']) {
				alert(number_format($boset['nrp']).AS_MP." 이상 등록하셔야 합니다.");
			}
		}

		if($boset['xrp'] > 0) {
			if($as_view > $boset['xrp']) {
				alert(number_format($boset['xrp']).AS_MP." 이하로만 등록할 수 있습니다.");
			}
		}
	}
}

// 다운로드
if(isset($boset['udp']) && $boset['udp']) {
	if($as_down == "" || $as_down >= 0) {
		;
	} else {
		alert("양수만 등록할 수 있습니다.");
	}

	if(!$is_admin) {
		if($boset['ndp'] > 0) {
			if($as_down < $boset['ndp']) {
				alert(number_format($boset['ndp']).AS_MP." 이상 등록하셔야 합니다.");
			}
		}

		if($boset['xdp'] > 0) {
			if($as_down > $boset['xdp']) {
				alert(number_format($boset['xdp']).AS_MP." 이하로만 등록할 수 있습니다.");
			}
		}
	}
}

// 추가태그 정리
$is_stag = (isset($boset['ctn']) && $boset['ctn'] > 0) ? true : false; 
if($is_stag) {
	if($as_tag && $wr_10) {
		$as_tag = $as_tag.','.$wr_10;
	} else if(!$as_tag && $wr_10) {
		$as_tag = $wr_10;
	}
}

// 설문
$as_extra = (isset($_POST['as_extra'])) ? preg_replace('/[^0-9_]/i', '', $_POST['as_extra']) : 0;
if($as_extra == "2") {

	//제목체크
	$po_subject = '';
	if (isset($_POST['po_subject'])) {
		$po_subject = substr(trim($_POST['po_subject']),0,255);
		$po_subject = preg_replace("#[\\\]+$#", "", $po_subject);
	}

	//제목이 있으면...
	if($po_subject) {
		$po_content = '';
		if (isset($_POST['po_content'])) {
			$po_content = substr(trim($_POST['po_content']),0,65536);
			$po_content = preg_replace("#[\\\]+$#", "", $po_content);
		}

		//설문정리
		for ($i=1; $i<=9; $i++) {
			$var = "po_poll".$i;
			$$var = "";
			if (isset($_POST['po_poll'.$i]) && settype($_POST['po_poll'.$i], 'string')) {
				$$var = trim($_POST['po_poll'.$i]);
			}
		}
	} else {
		$as_extra = 0;
	}
} else {
	$as_extra = 0;
}

$boset['write_skin'] = (isset($boset['write_skin']) && $boset['write_skin']) ? $boset['write_skin'] : 'basic';
$write_skin_url = $board_skin_url.'/write/'.$boset['write_skin'];
$write_skin_path = $board_skin_path.'/write/'.$boset['write_skin'];

// 간단쓰기 제목처리
if($w == '' && isset($is_subject) && $is_subject) {
	$wr_subject = apms_cut_text($wr_content, 30); // 글내용 30자 자르기
}

?>
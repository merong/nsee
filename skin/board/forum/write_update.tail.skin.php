<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 설문
if($w == "u" && !$as_extra && $wr['as_extra']) { //삭제
	sql_query(" delete from {$g5['apms_poll']} where bo_table = '$bo_table' and wr_id = '$wr_id' ", false);
} else if($as_extra == "2") { //등록
	//신규
	$po_new = true;
	if($w == "u") {
		$po = sql_fetch(" select po_id from {$g5['apms_poll']} where bo_table = '$bo_table' and wr_id = '$wr_id' ", false);
		if($po['po_id'])
			$po_new = false; //업데이트
	}

	//종료
	if($po_endtime) {
		$po_end = 1;
		$po_endtime = $po_endtime.' 23:59:59';
	} else {
		$po_end = 0;
		$po_endtime = '';
	}

	//참여권한 및 포인트는 그냥 통합제어
	$po_level = (isset($boset['po_level']) && $boset['po_level'] > 0) ? $boset['po_level'] : 0;
	$po_point = (isset($boset['po_point']) && $boset['po_point'] > 0) ? $boset['po_point'] : 0;

	//공통
	$sql_po = " po_type = '$as_extra'
				, po_use = '1'
				, po_subject = '$po_subject'
				, po_content = '$po_content'
				, po_level = '$po_level'
				, po_point = '$po_point'
				, po_end = '$po_end'
				, po_endtime = '$po_endtime'
				, po_poll1 = '$po_poll1'
				, po_poll2 = '$po_poll2'
				, po_poll3 = '$po_poll3'
				, po_poll4 = '$po_poll4'
				, po_poll5 = '$po_poll5'
				, po_poll6 = '$po_poll6'
				, po_poll7 = '$po_poll7'
				, po_poll8 = '$po_poll8'
				, po_poll9 = '$po_poll9'
			   ";

	if($po_new) { //신규
		$sql = " insert into {$g5['apms_poll']} set $sql_po , bo_table = '$bo_table', wr_id = '$wr_id', po_datetime = '".G5_TIME_YMDHIS."' ";
	} else { //업데이트
		$sql = " update {$g5['apms_poll']} set $sql_po where bo_table = '$bo_table' and wr_id = '$wr_id' ";
	}

	sql_query($sql, false);
}

// 목록으로 이동하기
if($w == '' && isset($is_direct) && $is_direct) {
	if ($file_upload_msg)
		alert($file_upload_msg, G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
	else
		goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
}

?>
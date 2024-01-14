<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(isset($boset['nuse']) && $boset['nuse']) {
	$is_nameless = ($wr_9) ? true : false;
} else {
	$is_nameless = ($wr_9) ? false : true;
}

if(!$notice && $is_nameless) { //공지가 아닐경우 실행
	if($w != 'u') {
		include_once($board_skin_path.'/board.lib.php');

		// 이름
		$name = addslashes(apms_anonymity());

		// 익명처리
		sql_query(" update $write_table set wr_name = '$name', mb_id = '', wr_email = '', wr_homepage = '', wr_10 = '{$member['mb_id']}' where wr_id = '$wr_id' ");
		sql_query(" update {$g5['board_new_table']} set mb_id = '' where bo_table = '$bo_table' and wr_id = '$wr_id' ");

		if ($w == '') {
			;
		} else {
			// 내글반응
			apms_response('wr', 'reply', '', $bo_table, $wr_id, $wr_subject, $wr['wr_10'], '', $name);
		}
	}
}

@include_once($write_skin_path.'/write_update.tail.skin.php');

// 목록으로 이동하기
if($w == '' && isset($is_direct) && $is_direct) {
	if ($file_upload_msg)
		alert($file_upload_msg, G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
	else
		goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
}

?>
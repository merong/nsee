<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($w != 'cu') {
	// 익명처리
	if(isset($boset['nuse']) && $boset['nuse']) {
		$is_nameless = ($wr_9) ? true : false;
	} else {
		$is_nameless = ($wr_9) ? false : true;
	}

	if($is_nameless) {
		include_once($board_skin_path.'/board.lib.php');
		// 이름
		$wr_name = addslashes(apms_anonymity());

		// 익명처리
		sql_query(" update $write_table set wr_name = '$wr_name', mb_id = '', wr_email = '', wr_homepage = '', wr_10 = '{$member['mb_id']}' where wr_id = '$comment_id' ");
		sql_query(" update {$g5['board_new_table']} set mb_id = '' where bo_table = '$bo_table' and wr_id = '$comment_id' ");
	}

	// 내글반응
	$wr_mb = ($wr['mb_id']) ? $wr['mb_id'] : $wr['wr_10'];
	apms_response('wr', 'comment', '', $bo_table, $wr_id, $wr_subject, $wr_mb, '', $wr_name);

	if($response_flag == 'reply') { //대댓글일 때
		$pre_comment = sql_fetch(" select mb_id, wr_10 from {$write_table} where wr_parent = '$wr_id' and wr_is_comment = 1 and wr_comment = '$tmp_comment' and wr_comment_reply = '".substr($tmp_comment_reply,0,-1)."' "); 
		$pre_mb = ($pre_comment['mb_id']) ? $pre_comment['mb_id'] : $pre_comment['wr_10'];
		apms_response('wr', 'comment_reply', '', $bo_table, $wr_id, $wr_subject, $pre_mb, '', $wr_name);
	}
}

?>
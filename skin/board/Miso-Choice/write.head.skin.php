<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 등록여부 체크 - 공지글이 아니고 새글일 때만
if(!$is_admin && $w == '') {
	$limit_cmt = ($boset['limit_cmt'] > 0) ? $boset['limit_cmt'] : 1;
	$limit_post = ($boset['limit_post'] > 0) ? $boset['limit_post'] : 1;

	$row = sql_fetch("select count(*) as cnt from $write_table where mb_id = '{$member['mb_id']}' and wr_is_comment = 0 and wr_comment >= '$limit_cmt' and as_choice > 0 and as_choice_cnt = 0 ");
	if($row['cnt'] >= $limit_post)
		alert('채택포인트가 등록된 글 중 댓글이 '.$limit_cmt.'개 이상 달린 미채택글이 '.$row['cnt'].'개 있습니다. 채택하셔야만 글등록이 가능합니다.');

}

?>

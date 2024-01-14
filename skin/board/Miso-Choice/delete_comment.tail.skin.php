<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 채택댓글 삭제시
if($write['as_choice_cnt']) {
	sql_query(" update {$write_table} set as_choice_cnt = as_choice_cnt - 1 where wr_id = '{$write['wr_parent']}' ");

	//포인트 삭제
	delete_point($write['mb_id'], $bo_table, $comment_id, '채택');
}

?>
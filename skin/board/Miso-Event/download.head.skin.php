<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/apms.event.lib.php');

$own = apms_event_own($bo_table, $wr_id, $member['mb_id']);

if($own[0]['is_win']) {
	;
} else {
	alert('이벤트 당첨자만 다운받을 수 있습니다.');
}

if($own[0]['is_confirm']) {
	alert('이벤트 당첨처리를 하셔야 다운받을 수 있습니다.');
}

?>
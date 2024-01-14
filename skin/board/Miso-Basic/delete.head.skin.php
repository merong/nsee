<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 개별다운 포인트로 재설정
$boset = array();
$boset = apms_unpack($board['as_set']);

if(!$is_admin && $boset['urp'])
	alert('관리자만 글삭제를 할 수 있습니다.');

?>
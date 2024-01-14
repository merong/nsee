<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_view_comment) { // AJAX일 때
	// 분류별 내용스킨
	if($is_cskin && isset($write['ca_name']) && $write['ca_name']) {
		for($i=0; $i < $is_cskin; $i++) {
			if($cskin[$i]['ca_name'] == $write['ca_name']) {
				$boset['view_skin'] = $cskin[$i]['view_skin'];
				@include_once($board_skin_url.'/view/'.$boset['view_skin'].'/setup.default.php');
				break;
			}
		}
	}
}

$boset['view_skin'] = (isset($boset['view_skin']) && $boset['view_skin']) ? $boset['view_skin'] : 'basic';
$view_skin_url = $board_skin_url.'/view/'.$boset['view_skin'];
$view_skin_path = $board_skin_path.'/view/'.$boset['view_skin'];

include_once($view_skin_path.'/view_comment.page.skin.php');

?>
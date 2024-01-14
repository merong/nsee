<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 상단 페이징/버튼
if(isset($boset['ltop']) && $boset['ltop'])
	include_once($list_skin_path.'/list.top.skin.php');

if($is_category) 
	include_once($board_skin_path.'/category.skin.php'); // 카테고리

?>

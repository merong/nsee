<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

$main_file = THEMA_PATH.'/main/'.$at_set['mfile'].'.php';

if(file_exists($main_file)) {
	include_once($main_file);
} else {
	echo '<div class="text-muted text-center" style="padding:300px 0px;">Switcher에서 적용할 메인을 선택해 주세요.</div>';
}

?>

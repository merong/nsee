<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_admin) {
	alert('관리자만 가능합니다.');
}

include_once(G5_LIB_PATH.'/apms.event.lib.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

if ($w == '') {
    $write['wr_1'] = date("Y-m-d 00:00:00", G5_SERVER_TIME + 86400);
    $write['wr_2'] = date("Y-m-d 23:59:59", strtotime($write['wr_1']) + 86400 * 7);
}

$sdate = date("Y-m-d", strtotime($write['wr_1']));
$shour = date("H", strtotime($write['wr_1']));
$edate = date("Y-m-d", strtotime($write['wr_2']));
$ehour = date("H", strtotime($write['wr_2']));

$harr = array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16" , "17", "18", "19", "20", "21", "22", "23");

//이벤트 정보
list($type, $win, $entry_point, $entry_rate, $tender, $tender_limit, $show_win, $show_tender, $show_tender_win, $win_pay, $win_fee) = explode("|", $write['wr_3']);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css" media="screen">', 0);

// 헤더 출력
$header_skin = (isset($boset['header_skin']) && $boset['header_skin']) ? $boset['header_skin'] : ''; 
if($header_skin) {
	$header_color = $boset['header_color'];
	include_once('./header.php');
}

$boset['write_skin'] = (isset($boset['write_skin']) && $boset['write_skin']) ? $boset['write_skin'] : 'basic';
$write_skin_url = $board_skin_url.'/write/'.$boset['write_skin'];
$write_skin_path = $board_skin_path.'/write/'.$boset['write_skin'];

// 버튼컬러
$btn1 = (isset($boset['btn1']) && $boset['btn1']) ? $boset['btn1'] : 'black';
$btn2 = (isset($boset['btn2']) && $boset['btn2']) ? $boset['btn2'] : 'color';

$is_stag = (isset($boset['ctn']) && $boset['ctn'] > 0) ? true : false; 
$is_use_tag = ((!$boset['tag'] && $is_admin) || ($boset['tag'] && $member['mb_level'] >= $boset['tag'])) ? true : false;

if($is_dhtml_editor) { 
?>
<style>
	#wr_content { border:0; display:none; }
</style>
<?php } ?>
<div id="bo_w" class="write-wrap<?php echo (G5_IS_MOBILE) ? ' font-14' : '';?>">
	<?php include_once($write_skin_path.'/write.skin.php'); // 쓰기스킨 ?>
</div>
<div class="h20"></div>
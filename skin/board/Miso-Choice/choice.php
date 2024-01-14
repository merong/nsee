<?php
include_once('./_common.php');

$wc_id = (int)$_REQUEST['wc_id'];

$is_apms = true;

$error = $success = "";

function print_result($error, $success) {
	echo '{ "error": "' . $error . '", "success": "' . $success . '" }';
	exit;
}

if (!$is_member) {
	$error = '회원만 가능합니다.';
	print_result($error, $success);
}

if (!($bo_table && $wr_id && $wc_id)) {
	$error = '값이 제대로 넘어오지 않았습니다.';
	print_result($error, $success);
}

$ss_name = 'ss_view_'.$bo_table.'_'.$wr_id;
if (!get_session($ss_name)) {
	$error = '해당 게시물에서만 채택하실 수 있습니다.';
	print_result($error, $success);
}

$row = sql_fetch(" select count(*) as cnt from {$g5['write_prefix']}{$bo_table} ", FALSE);
if (!$row['cnt']) {
	$error = '존재하는 게시판이 아닙니다.';
	print_result($error, $success);
}

if($write['mb_id'] == $member['mb_id']) {
	;
} else {
	$error = '글쓴이만 채택할 수 없습니다.';
	print_result($error, $success);
}

// 댓글
$cmt = sql_fetch(" select * from $write_table where wr_id = '$wc_id' ");
if (!$cmt['wr_id']) {
	$error = '존재하는 댓글이 아닙니다.';
	print_result($error, $success);
}

if ($cmt['as_choice_cnt']) {
	$error = '이미 채택된 댓글입니다.';
	print_result($error, $success);
}

if($cmt['mb_id'] == $member['mb_id']) {
	$error = '자신의 댓글은 채택할 수 없습니다.';
	print_result($error, $success);
}

// 보드설정
$boset = array();
$boset = apms_boset();

// 채택포인트가 있을 경우
$point = (int)$write['as_choice'];
if($point > 0) {
	// 보유포인트가 부족할 경우
	if($point > $member['mb_point']) {
		$error = '보유 '.AS_MP.' 부족으로 채택을 완료하지 못했습니다.\\n\\n'.AS_MP.'를 확인 후 다시 채택해 주시기 바랍니다.';
		print_result($error, $success);
	}

	// 수수료
	$fee = (int)$boset['cpoint'];
	$fee_per = $fee / 100;
	$fee_point = round($point * $fee_per);

	// 포인트 차감
	$sp_point = (!$boset['fee'] || $boset['fee'] == '1') ? $point + $fee_point : $point; //수수료
	$sp_point = $sp_point * (-1);
	insert_point($member['mb_id'], $sp_point, "{$board['bo_subject']} $wr_id 채택포인트", $bo_table, $wc_id, "채택", 0, 1); //중복등록 가능

	// 포인트 등록
	$po_point = (!$boset['fee'] || $boset['fee'] == '2') ? $point - $fee_point : $point; //수수료
	insert_point($cmt['mb_id'], $po_point, "{$board['bo_subject']} $wr_id 채택포인트", $bo_table, $wc_id, "채택", 0, 1); //중복등록 가능
}

// 글 업데이트
sql_query(" update $write_table set as_choice_cnt = as_choice_cnt + 1 where wr_id = '$wr_id' ");

// 댓글 업데이트
sql_query(" update $write_table set as_choice = '{$write['as_choice']}', as_choice_cnt = as_choice_cnt + 1 where wr_id = '$wc_id' ");

// APMS : 내글반응
apms_response('wr', 'choice', '', $bo_table, $wr_id, $write['wr_subject'], $cmt['mb_id'], $member['mb_id'], '채택됨', $wc_id);

$success = "이 댓글을 채택하셨습니다.";
print_result($error, $success);

?>
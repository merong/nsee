<?php
include_once('./_common.php');

if (!$is_member) {
	alert('회원만 가능합니다.');
}

$boset = array();
if($board['as_set']) {
	$boset = apms_unpack($board['as_set']);
}

if($boset['jpp'] > 0 && $boset['jpc'] > 0) {
	;
} else {
	alert('상위노출 기능을 사용하지 않습니다.');
}

if (!($bo_table && $wr_id)) {
	alert('값이 제대로 넘어오지 않았습니다.');
}

$ss_name = 'ss_view_'.$bo_table.'_'.$wr_id;
if (!get_session($ss_name)) {
	alert('해당 게시물에서만 하실 수 있습니다.');
}

$row = sql_fetch(" select count(*) as cnt from {$write_table} ", FALSE);
if (!$row['cnt']) {
	alert('존재하는 게시판이 아닙니다.');
}

if($write['mb_id'] && $write['mb_id'] == $member['mb_id']) {
	;
} else {
	alert('자신의 게시물에서만 하실 수 있습니다.');
}

// 보유 포인트 체크
if ($member['mb_point'] < $boset['jpp']) {
	alert("보유중인 ".AS_MP."(".number_format($member['mb_point']).")가 상위노출 ".AS_MP."(".number_format($boset['jpp']).") 보다 부족합니다.");
}

$time = G5_SERVER_TIME;
$term = $time + 86400; //1일

// 등록제한
if((int)$write['wr_7'] > $time) {
	$limit = date("Y년 m월 d일 H시 i분", $write['wr_7']);
	alert($limit." 이후 등록이 가능합니다.");
}

// 등록된 상위노출 체크
$row = sql_fetch(" select count(*) as cnt from $write_table where wr_is_comment = '0' and wr_7 <> '' and convert(wr_7, unsigned) >= '$time' ", false);
if($row['cnt'] >= $boset['jpc']) {
	alert('더이상 상위노출 게시물을 등록할 수 없습니다.\\n\\n빈자리가 생긴 후 등록이 가능합니다.');	
}

// 등록하기
sql_query(" update $write_table set wr_7 = '$term' where wr_id = '$wr_id' ");

// 포인트차감
$jpoint = abs($boset['jpp']) * (-1);
insert_point($write['mb_id'], $jpoint, "{$board['bo_subject']} $wr_id 게시물 상위노출", $bo_table, $wr_id, "상위노출(".$term.")");

// 이동하기
goto_url(G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.$qstr);

?>
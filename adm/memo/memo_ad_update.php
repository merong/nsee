<?php
$sub_menu = '990650';
include_once('./_common.php');

$count = count($_POST['m_level']);

if(!$count) {
    alert('쪽지 받는 대상을 하나 이상 선택하세요.');
}

$g5['title'] = '홍보쪽지 발송결과';
include_once('../admin.head.php');

$me_send_id = $_POST['me_send_id'];
$memocon = sql_escape_string($_POST['me_memo']);

$level=array();
$level[1]=$_POST['m_level'][0];
$level[2]=$_POST['m_level'][1];
$level[3]=$_POST['m_level'][2];
$level[4]=$_POST['m_level'][3];
$level[5]=$_POST['m_level'][4];
$level[6]=$_POST['m_level'][5];
$level[7]=$_POST['m_level'][6];
$level[8]=$_POST['m_level'][7];
$level[9]=$_POST['m_level'][8];
$level[10]=$_POST['m_level'][9];

$first=1;
$sql_who=" and mb_level in (";
for ($i=1; $i<11; $i++) {
    if ($level[$i]) {
        if (!$first) $sql_who.=",";
        else $first=0;
        $sql_who.="'".$i."'";
    }
}
$sql_who.=")";


$sql_send      = " select mb_id from {$g5['member_table']} where mb_id = '{$me_send_id}' and mb_leave_date = '' and mb_intercept_date = '' ";
$result_send   = sql_query($sql_send);
$data_send     = sql_fetch_array($result_send);
$me_send_mb_id = $data_send["mb_id"];

if ($me_send_mb_id) {
	
	$sql=" select mb_id from {$g5['member_table']} where (1) {$sql_who} and mb_leave_date = '' and mb_intercept_date = '' ";
	$result = sql_query($sql);
	
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		
		$tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
		$me_id = $tmp_row['max_me_id'] + 1;
		
		// 쪽지 INSERT
		$sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo ) values ( '{$me_id}', '{$row['mb_id']}', '{$me_send_mb_id}', '".G5_TIME_YMDHIS."', '{$memocon}' ) ";
		sql_query($sql);
		
		$send_cnt = $i + 1;
	}
	
}


// 전체회원수
$sql = " select count(*) as cnt from {$g5['member_table']} ";
$row = sql_fetch($sql);
$tot_cnt = $row['cnt'];

// 탈퇴회원수
$sql = " select count(*) as cnt from {$g5['member_table']} where mb_leave_date <> '' ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt from {$g5['member_table']} where mb_intercept_date <> '' ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">전체회원 </span><span class="ov_num"> <?php echo number_format($tot_cnt) ?> 명 </span></span>
    <span class="btn_ov01"><span class="ov_txt">차단 </span><span class="ov_num"> <?php echo number_format($intercept_count) ?> 명 </span></span>
    <span class="btn_ov01"><span class="ov_txt">탈퇴 </span><span class="ov_num"> <?php echo number_format($leave_count) ?> 명 </span></span>
    <span class="btn_ov01">차단, 탈퇴 회원은 발송되지 않습니다.</span>
</div>

<div class="local_desc01 local_desc">
    <?php if ($mb_id_check) { ?>
    <p>총 (<strong><?php echo $send_cnt+0; ?></strong>) 개의 쪽지가 발송되었습니다.</p>
    <?php } else { ?>
    회원정보가 없거나, 활동하지 않는 회원입니다.
    <?php } ?>
</div>

<div class="btn_fixed_top">
    <input type="button" value="쪽지관리" onclick="location.href='./memo_list.php'" class="btn btn_02">
    <input type="button" value="레벨쪽지" onclick="location.href='./memo_level.php'" class="btn btn_02">
    <input type="button" value="홍보쪽지" onclick="location.href='./memo_ad.php'" class="btn btn_01">
    <input type="button" value="개별쪽지" onclick="location.href='./memo_send.php'" class="btn btn_02">
</div>

<?php
include_once ('../admin.tail.php');
?>
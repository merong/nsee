<?php
$sub_menu = '990650';
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'd');

check_admin_token();

$count = count($_POST['chk']);
if(!$count)
    alert($_POST['act_button'].' 하실 항목을 하나 이상 체크하세요.');

for ($i=0; $i<$count; $i++)
{
    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];
	
    // 쪽지 내역삭제
    $sql = " delete from {$g5['memo_table']} where me_id = '{$_POST['me_id'][$k]}' ";
    sql_query($sql);
	
	echo "sql = ".$sql."<br>";
}

goto_url('./memo_list.php?'.$qstr);
?>
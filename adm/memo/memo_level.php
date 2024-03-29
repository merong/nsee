<?php
$sub_menu = '200650';
include_once('./_common.php');

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

$g5['title'] = '회원레벨 쪽지보내기';
include_once('../admin.head.php');
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">전체회원 </span><span class="ov_num"> <?php echo number_format($tot_cnt) ?> 명 </span></span>
    <span class="btn_ov01"><span class="ov_txt">차단 </span><span class="ov_num"> <?php echo number_format($intercept_count) ?> 명 </span></span>
    <span class="btn_ov01"><span class="ov_txt">탈퇴 </span><span class="ov_num"> <?php echo number_format($leave_count) ?> 명 </span></span>
    <span class="btn_ov01">차단, 탈퇴 회원은 발송되지 않습니다.</span>
</div>

<form name="memo_form" action="./memo_level_update.php" onsubmit="return memolist_submit(this);" method="post">
<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <tbody>
    <tr>
        <th scope="row">받는사람 권한</th>
        <td class="td_left">
            <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"> 전체선택
            <?php for ($i=0; $i<10; $i++) { ?>
            <input type="checkbox" name="m_level[<?php echo $i ?>]" value="1" id="m_level[]" style="margin-left:12px"> <?php 
			echo $i+1; 
			if ($i == 2) echo "";
			if ($i == 3) echo "";
			if ($i == 4) echo "";
			if ($i == 5) echo "";
			?>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <th scope="row">쪽지 내용</th>
        <td><textarea name="me_memo" required class="required"></textarea></td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    
    <input type="button" value="쪽지관리" onclick="location.href='./memo_list.php'" class="btn btn_02">
    <input type="submit" value="발송하기" class="btn btn_01">
    <input type="button" value="홍보쪽지" onclick="location.href='./memo_ad.php'" class="btn btn_02">
    <input type="button" value="개별쪽지" onclick="location.href='./memo_send.php'" class="btn btn_02">
</div>

<script>
function all_checked(sw) {
    var f = document.memo_form;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].id == "m_level[]")
            f.elements[i].checked = sw;
    }
}

function memolist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].id == "m_level[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert("쪽지 받는 대상을 하나 이상 선택하세요.");
        return false;
    }

    return true;
}
</script>

<?php
include_once ('../admin.tail.php');
?>
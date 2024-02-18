<?php
$sub_menu = '200650';
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['memo_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

//if ($is_admin != 'super')
//    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "me_send_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '쪽지관리';
include_once('../admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 9;
?>


<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">전체 </span><span class="ov_num"> <?php echo number_format($total_count) ?> 건 </span></span>
    <?php
    if (isset($mb['mb_id']) && $mb['mb_id']) {
        echo '&nbsp;<span class="btn_ov01"><span class="ov_txt">' . $mb['mb_id'] .' 님 쪽지 </span><span class="ov_num"> ' . number_format($mb['mb_point']) . '건</span></span>';
    } else {
        $row2 = sql_fetch(" select count(*) as cnt from {$g5['memo_table']} where me_read_datetime = '0000-00-00 00:00:00' ");
        echo '&nbsp;<span class="btn_ov01"><span class="ov_txt">미열람</span><span class="ov_num">'.number_format($row2['cnt']).'건 </span></span>';
    }
    ?>
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="me_send_mb_id"<?php echo get_selected($_GET['sfl'], "me_send_mb_id"); ?>>보낸회원 아이디</option>
    <option value="me_recv_mb_id"<?php echo get_selected($_GET['sfl'], "me_recv_mb_id"); ?>>받는회원 아이디</option>
    <option value="me_memo"<?php echo get_selected($_GET['sfl'], "me_memo"); ?>>내용</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">
</form>

<form name="fmemolist" id="fmemolist" method="post" action="./memo_list_delete.php" onsubmit="return fmemolist_submit(this);">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_chk" rowspan="2" >
            <label for="chkall" class="sound_only">쪽지 내역 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" id="me_recv_id" colspan="2">보낸회원</th>
        <th scope="col" id="me_send_id" colspan="2">받는회원</th>
        <th scope="col" id="me_memo" rowspan="2">내용</th>
        <th scope="col" id="me_datetime" colspan="2">시간</th>
        <th scope="col" rowspan="2" id="me_list_mng">쪽지</th>
    </tr>
    <tr>
        <th scope="col" id="me_recv_id"><?php echo subject_sort_link('me_recv_mb_id') ?>아이디</a></th>
        <th scope="col" id="me_recv_nick">닉네임</th>
        <th scope="col" id="me_send_id"><?php echo subject_sort_link('me_send_mb_id') ?>아이디</a></th>
        <th scope="col" id="me_send_nick">닉네임</th>
        <th scope="col" id="me_send_datetime"><?php echo subject_sort_link('me_send_datetime') ?>보낸시간</a></th>
        <th scope="col" id="me_recv_datetime"><?php echo subject_sort_link('me_recv_datetime') ?>읽은시간</a></th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		
		$sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['me_recv_mb_id']}' ";
		$row2 = sql_fetch($sql2);
        $me_recv_nick = get_sideview($row2['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);
		$me_recv_id = $row2['mb_id'];
		$me_recv_name = $row2['mb_nick'];
		
		$sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['me_send_mb_id']}' ";
		$row2 = sql_fetch($sql2);
        $me_send_nick = get_sideview($row2['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);
		$me_send_id = $row2['mb_id'];
		$me_send_name = $row2['mb_nick'];

        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk">
            <input type="hidden" name="me_id[<?php echo $i ?>]" value="<?php echo $row['me_id'] ?>" id="me_id_<?php echo $i ?>">
            <label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo $row['po_content'] ?> 내역</label>
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class="td_left"><?php echo $row['me_send_mb_id'] ?></td>
        <td class="td_left"><div><?php echo $me_send_nick ?></div></td>
        <td class="td_left"><?php echo $row['me_recv_mb_id'] ?></td>
        <td class="td_left"><div><?php echo $me_recv_nick ?></div></td>
        <td class="td_left"><?php echo conv_subject($row['me_memo'],30,'...') ?></div></td>
        <td class="td_datetime"><?php echo $row['me_send_datetime'] ?></td>
        <td class="td_datetime"><?php if ($row['me_read_datetime']<>"0000-00-00 00:00:00") { echo $row['me_read_datetime']; } ?></td>
        <td class="td_num">
        	<div 
                class="goImg" 
                data-content='
                    <div class="layer_pop_title">
                        <span style="font-weight:bold; font-size:1.1em;"><?php echo $me_send_id ?></span> 가 
                        <span style="font-weight:bold; font-size:1.1em;"><?php echo $me_recv_id; ?></span> 에게 쪽지
                    </div>
                    <div class="layer_pop_content">
						<?php 
							$me_memo = $row['me_memo'];
							$me_memo = str_replace("\'", "&#039;", addslashes($me_memo));
							$me_memo = str_replace("<", "&lt;", $me_memo);
							$me_memo = str_replace(">", "&gt;", $me_memo);
							echo $me_memo; 
						?>
                    </dv>
                '
            >보기</div>
        </td>
    </tr>

    <?php
    }

    if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
    <input type="button" value="레벨쪽지" onclick="location.href='./memo_level.php'" class="btn btn_01">
    <input type="button" value="홍보쪽지" onclick="location.href='./memo_ad.php'" class="btn btn_01">
    <input type="button" value="개별쪽지" onclick="location.href='./memo_send.php'" class="btn btn_01">
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
function fmemolist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>


<style>
/* 레이어 팝업 */
.layer_pop{position:fixed;left:0;bottom:0;top:0;right:0;z-index: 1000;overflow:auto;display: none;}
.layer_on{overflow:hidden;}
.layer_on .layer_pop{display: block;}
.layer_pop:before{content:'';position:fixed;background:#000;opacity:.5;left:0;right:0;top:0;bottom:0;display: block;}
.layer_cont{position: absolute;left:50%;z-index: 110;top:20%;}
.layer_cont .layer_close{font-size:0;width:36px;height:36px;display: block;position: absolute;right:-46px;top:0;background-image:url('./img/ico_layer_close.png');background-size:cover;}
.layer_cont img{}
.advertise_pop { transform: translateX(-50%); }
.advertise_pop img { border: 2px #fff solid; }

.layer_pop_title { padding:0px 0px 15px 0; }
.layer_pop_content { line-height:22px; }

#ad_image_pop{background:#fff;}
</style>    
        <!-- 이미지 레이어 팝업 -->
        <article class="layer_pop">
            <div class="layer_cont advertise_pop">
                <a href="javascript:void(0);" class="layer_close">팝업닫기</a>
                <!-- 리스트 이미지 그대로 불러오기 -->
                <div id="ad_image_pop" style="padding:15px; min-width:400px;"></div>
			</div>
        </article>
<script>
    $('.goImg').on('click', function(){
        var src = $(this).data("src");
        var text = $(this).data("content");
        var re = /\n/g;
        text = text.replace(re, "<br>");
        $("#ad_image_pop").html('<p></p>');
        $("#ad_image_pop p").append(text);
        $("body").addClass('layer_on');
        $(".layer_cont").addClass('animated zoomIn');
    });
    $('.layer_close').on('click', function(){
        $("body").removeClass('layer_on');
        $(".layer_cont").removeClass('animated zoomIn');
        $("#ad_image_pop").empty();
    })
</script>


<?php
include_once ('../admin.tail.php');
?>
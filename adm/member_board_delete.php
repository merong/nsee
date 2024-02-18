<?php
// 그누보드5 스팸글 일괄삭제 by happyjung 2018.03.20 10:47
// please give feedbacks to https://www.happyjung.com
// Update 2021-03-03 06:28 ver.11

include_once ('../common.php');
//include_once(G5_ADMIN_PATH.'/admin.lib.php');

if( isset($token) ){
	$token = @htmlspecialchars(strip_tags($token), ENT_QUOTES);
}

// 캐시삭제 여부
$setup_cache = "Y";
// 방화벽문제로 캐시삭제 오류가 날때는 윗줄을 주석으로 변경하세요

// 회원삭제 설정
$type = '1'; // 1: 회원차단 , 2: 회원삭제

// 1. 최고관리자 확인
if (!($is_admin=="super" || $is_admin=="group" || $is_admin=="board")) {
	echo ("<script>alert('관리자 메뉴입니다.'); history.back();</script>");
	exit;
}


// 1. 회원차단? 회원삭제?
if (!$type) {
	echo ("<script>alert('회원 차단/삭제 설정 오류입니다.'); history.back();</script>");
	exit;
}


// 2. 회원레벨 4이상이면 작업취소
$qry = sql_query("select * from {$g5['member_table']} where mb_id='{$mb_id}'");
$row = sql_fetch_array($qry);
if($row['mb_level'] >= '4') {
	echo ("<script>alert('Level 1,2 일때만 일괄삭제를 지원합니다.'); history.back();</script>");
	exit;
}


// 3. 스팸글 작성자가 그룹관리자로 지정된 경우 삭제
$qry = sql_query("select * from {$g5['group_table']} order by gr_id asc");
while($row = sql_fetch_array($qry)) {
	if ($row['gr_admin']) { // 해당 아이디로 그룹관리자가 지정된 경우
		sql_query(" update {$g5['group_table']} set gr_admin='' where gr_admin='{$mb_id}' ");
	}
}


// 4. 스팸글 작성자가 게시판 관리자로 지정된 경우 삭제
$qry = sql_query("select * from {$g5['board_table']} ");
while($row = sql_fetch_array($qry)) { 
	sql_query(" update {$g5['board_table']} set bo_admin='' where bo_admin='{$mb_id}' ");
}


// 5. 게시글 삭제
$qry = sql_query("select * from {$g5['board_table']} ");
while($row = sql_fetch_array($qry)) { 
	// 게시글 연결된 댓글 삭제
	$qry2 = sql_query(" select * from {$g5['write_prefix']}{$row['bo_table']} where mb_id='{$mb_id}' ");
	for ($i=0; $row2=sql_fetch_array($qry2); $i++) {
		sql_query(" delete from {$g5['write_prefix']}{$row['bo_table']} where wr_parent='{$row2['wr_id']}' and wr_is_commnet='1' ");
	}
	sql_query(" delete from {$g5['write_prefix']}{$row['bo_table']} where mb_id='{$mb_id}' ");
}


// 6. 게시글수 업데이트
$qry = sql_query("select * from {$g5['board_table']} order by bo_table asc ");
while($row = sql_fetch_array($qry)) { 

	$bo_table = $row["bo_table"];
	//echo $row["bo_table"] ."<br>";

	// 게시판의 글 수
	$row_cnt = sql_fetch(" select count(*) as cnt from {$g5['write_prefix']}{$bo_table} where wr_is_comment = 0 ");
	$bo_count_write = $row_cnt['cnt'];

	// 게시판의 코멘트 수
	$row_co = sql_fetch(" select count(*) as cnt from {$g5['write_prefix']}{$bo_table} where wr_is_comment = 1 ");
	$bo_count_comment = $row_co['cnt'];    

	if (isset($_POST['proc_count'])) {
		// 원글을 얻습니다.
		//$sql = " select wr_id from {$g5['write_prefix']}{$bo_table} where wr_is_comment = 0 ";
		$qry2 = sql_query(" select a.wr_id, (count(b.wr_parent) - 1) as cnt from {$g5['write_prefix']}{$bo_table} a, {$g5['write_prefix']}{$bo_table} b where a.wr_id=b.wr_parent and a.wr_is_comment=0 group by a.wr_id ");
		for ($i=0; $row2=sql_fetch_array($qry2); $i++) {
			/*
			// 코멘트수를 얻습니다.
			$sql2 = " select count(*) as cnt from {$g5['write_prefix']}$bo_table where wr_parent = '{$row['wr_id']}' and wr_is_comment = 1 ";
			$row2 = sql_fetch($sql2);
			*/

			sql_query(" update {$g5['write_prefix']}{$bo_table} set wr_comment = '{$row2['cnt']}' where wr_id = '{$row2['wr_id']}' ");
		}
	}

	// 공지사항에는 등록되어 있지만 실제 존재하지 않는 글 아이디는 삭제합니다.
	$bo_notice = "";
	$lf = "";
	if ($board['bo_notice']) {
		$tmp_array = explode(",", $board['bo_notice']);
		for ($i=0; $i<count($tmp_array); $i++) {
			$tmp_wr_id = trim($tmp_array[$i]);
			$row_noti = sql_fetch(" select count(*) as cnt from {$g5['write_prefix']}{$bo_table} where wr_id = '{$tmp_wr_id}' ");
			if ($row_noti['cnt'])
			{
				$bo_notice .= $lf . $tmp_wr_id;
				$lf = ",";
			}
		}
	}

		//		bo_notice        = '{$bo_notice}',
    sql_query(" update {$g5['board_table']} set 
			bo_count_write   = '{$bo_count_write}',
			bo_count_comment = '{$bo_count_comment}'
		where bo_table = '{$bo_table}' 
	");
}


// 7-1. 회원 접근차단
$intime = date("Ymd");
if ($type=="1")
sql_query(" update {$g5['member_table']} set mb_level='1', mb_intercept_date='{$intime}' where mb_id='{$mb_id}' ");


// 7-2. 회원삭제
if ($type=="2")
sql_query(" delete from {$g5['member_table']} where mb_id='{$mb_id}' ");


// 8. 포인트 삭제
sql_query(" delete from {$g5['point_table']} where mb_id='{$mb_id}' "); // 포인트 기록 삭제
sql_query(" update {$g5['member_table']} set mb_point='0' where mb_id='{$mb_id}' "); // 포인트 초기화


// 9. new 에 등록된 흔적 지우기
sql_query(" delete from {$g5['board_new_table']} where mb_id='{$mb_id}' "); // 포인트 기록 삭제


// 10. 1:1 qa 글 삭제
sql_query(" delete from {$g5['qa_content_table']} where mb_id='{$mb_id}' "); // 1:1 문의글 삭제


// 11. 캐시파일 일괄삭제
if ($setup_cache == "Y") {
	$files = glob(G5_DATA_PATH.'/cache/latest-*');
	if (is_array($files)) {
		foreach ($files as $cache_file) {
			$cnt++;
			unlink($cache_file);
			echo '<li>'.$cache_file.'</li>'.PHP_EOL;

			flush();

			if ($cnt%10==0) 
				echo PHP_EOL;
		}
	}
}


// 12. 게시판으로 이동
if ($_REQUEST['bo_table'])
	goto_url(G5_BBS_URL."/board.php?bo_table={$_REQUEST['bo_table']}&amp;page={$page}&amp;sca={$sca}&amp;sop={$sop}&amp;sfl={$sfl}&amp;stx={$stx}");
else
	goto_url(G5_URL);

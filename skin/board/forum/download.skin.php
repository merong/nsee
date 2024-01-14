<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 다운로드를 스킨에서 제어
$is_apms_download = false;

// 다운로드 유지기간 체크 - 포인트 중복차감
$downterm = (isset($boset['dterm']) && $boset['dterm'] > 0) ? $boset['dterm'] : 0;
$is_downterm = ($downterm > 0) ? 1 : 0;

if (!get_session($ss_name)) {

	// 다운로드 내역확인
	$is_download = true;

	// 자신의 글 또는 관리자라면 통과
    if (($write['mb_id'] && $write['mb_id'] == $member['mb_id']) || $is_admin) {

		$is_download = false;

	} else if ($board['bo_download_level'] >= 1) { // 회원이상 다운로드가 가능하다면

		if($member['mb_id'] && $board['bo_download_point'] < 0) {

			$sql_term = ($is_downterm) ? apms_sql_term($downterm, 'po_datetime') : ''; // 기간(일수,today,yesterday,month,prev)
			$row = sql_fetch(" select count(*) as cnt from {$g5['point_table']} where mb_id = '{$member['mb_id']}' and po_point < 0 and po_rel_table = '$bo_table' and po_rel_id = '$wr_id' and po_rel_action = '다운로드' $sql_term ");

			if($row['cnt']) {
				$is_download = false;
			}
		}

        if ($is_download) {

			// 다운로드 포인트가 음수이고 회원의 포인트가 0 이거나 작다면
			if ($member['mb_point'] + $board['bo_download_point'] < 0) {
		        alert('보유하신 포인트('.number_format($member['mb_point']).')가 없거나 모자라서 다운로드('.number_format($board['bo_download_point']).')가 불가합니다.\\n\\n포인트를 적립하신 후 다시 다운로드 해 주십시오.');
			}

			// 사용자 포인트 차감
		    insert_point($member['mb_id'], $board['bo_download_point'], "{$board['bo_subject']} $wr_id 파일 다운로드", $bo_table, $wr_id, "다운로드", 0, $is_downterm);

			// 등록자 포인트 적립
			if($is_downpoint) {
				$return_per = (isset($boset['rdp'])) ? (int)$boset['rdp'] : 0;
				if($write['mb_id'] && $return_per > 0) {
					$return_point = $board['bo_download_point'] * (-1);
					$return_per = $return_per / 100;
					$return_point = round($return_point * $return_per);

					insert_point($write['mb_id'], $return_point, "{$board['bo_subject']} $wr_id 파일 다운로드 적립", $bo_table, $wr_id, "다운적립(".$member['mb_id'].")", 0, $is_downterm);
				}

			}
		}
    }

	if($is_download) {
		// 다운로드 카운트 증가
	    $sql = " update {$g5['board_file_table']} set bf_download = bf_download + 1 where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$no' ";
	    sql_query($sql);
        sql_query(" update {$write_table} set as_download = as_download + 1 where wr_id = '{$wr_id}' ", false);
		sql_query(" update {$g5['board_new_table']} set as_download = as_download + 1 where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ", false);
	}

    set_session($ss_name, TRUE);
}

?>
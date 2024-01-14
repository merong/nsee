<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 포인트 적립 : 게시판 여분필드 10번에서 as_down 으로 이동
if($boset['udp']) {

	$return_per = (int)$boset['rdp'];

	if($write['mb_id'] && $board['bo_download_point'] < 0 && $return_per > 0) {
		if ($write['mb_id'] == $member['mb_id'] || $is_admin) {
			;
		} else if ($member['mb_id'] && $board['bo_download_level'] >= 1) { // 회원이상 다운로드가 가능하다면
			$return_point = $board['bo_download_point'] * (-1);
			$return_per = $return_per / 100;
			$return_point = round($return_point * $return_per);

			// 회원당 한번만 적립
			insert_point($write['mb_id'], $return_point, "{$board['bo_subject']} $wr_id 파일 다운로드 적립", $bo_table, $wr_id, "다운적립(".$member['mb_id'].")");
		}
	}
}

?>
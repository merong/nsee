<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 당첨자
function apms_event_winner($bo_table, $wr_id, $ev, $ex_mb='') {
	global $g5, $config, $board, $write_table, $view;

	$list = array();

	$rows = (int)$ev['win']; // 당첨자수

	if($ev['status'] == '종료') {
		if($ev['end']) {
			if($ev['type'] != "2") { //별도선정이 아닐 경우 작동
				$result = sql_query(" select * from {$g5['apms_event']} where bo_table = '$bo_table' and wr_id = '$wr_id' and ev_win = '1' order by ev_point desc limit 0, $rows ", false); //당첨현황
				for ($i=0; $row=sql_fetch_array($result); $i++) {
					$list[$i] = $row;
				}
			}
		} else {
			if($ev['type'] == "2") {
				; //별도선정일 때는 그냥 종료처리
			} else {
				$sql_ex = ($ex_mb) ? "and find_in_set(mb_id, '{$ex_mb}')=0" : "";
				if($ev['type']) { //랜덤당첨
					$result = sql_query(" select *, max(ev_point) as ev_point from {$g5['apms_event']} where bo_table = '$bo_table' and wr_id = '$wr_id' $sql_ex group by mb_id order by rand() limit 0, $rows ", false);
				} else { //최고입찰
					$result = sql_query(" select *, max(ev_point) as ev_point from {$g5['apms_event']} where bo_table = '$bo_table' and wr_id = '$wr_id' $sql_ex group by mb_id order by ev_point desc, ev_datetime limit 0, $rows ", false);
				}

				// 당첨 포인트
				$win_point = apms_event_point($ev, $bo_table, $wr_id);

				//이벤트 정보
				$subject = get_text($view['wr_subject']);
				$url = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&wr_id='.$wr_id;

				for ($i=0; $row=sql_fetch_array($result); $i++) {
					$list[$i] = $row;
					$list[$i]['ev_win'] = 1;

					// 낙찰포인트 차감
					$confirm = 1;
					if(!$ev['type'] && $row['ev_point'] > 0) {
						$mb = get_member($row['mb_id'], 'mb_point');
						if($mb['mb_point'] >= $row['ev_point']) {
							$ev_point = $row['ev_point'] * (-1);
							insert_point($row['mb_id'], $ev_point, "{$board['bo_subject']} $wr_id 이벤트 낙찰", $bo_table, $wr_id, "이벤트낙찰");
						} else {
							$confirm = 0;
						}
					}
					
					// 이벤트 당첨포인트
					if($confirm && $win_point) {
						insert_point($row['mb_id'], $win_point, "{$board['bo_subject']} $wr_id 이벤트 당첨", $bo_table, $wr_id, "이벤트당첨");
					}

					// 당첨정보 입력
					sql_query(" update {$g5['apms_event']} set ev_win = '1', ev_confirm = '$confirm' where bo_table = '$bo_table' and wr_id = '$wr_id' and mb_id = '{$row['mb_id']}' and ev_point = '{$row['ev_point']}' ", false);

					// 쪽지발송
					if($confirm) {
						$msg = $subject.' 이벤트에 당첨되셨습니다.\n\n';
						$msg .= '이벤트 바로가기 : '.$url;
					} else {
						$msg = $subject.' 이벤트에 당첨되셨으나 보유 포인트 부족으로 당첨처리가 되지 않았습니다.\n\n';
						$msg .= '포인트 확인 후 해당 이벤트에서 당첨처리 또는 당첨포기를 해 주셔야 다른 이벤트에도 참여가 가능합니다.\n\n';
						$msg .= '(이벤트 당첨을 포기하시더라도 이벤트 참여비는 반환되지 않습니다.)\n\n';
						$msg .= '이벤트 바로가기 : '.$url;
					}

					$tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
					$me_id = $tmp_row['max_me_id'] + 1;

					// 쪽지 INSERT
					sql_query(" insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo ) values ( '$me_id', '{$row['mb_id']}', '{$config['cf_admin']}', '".G5_TIME_YMDHIS."', '{$msg}' ) ", false);

					// 읽지 않은 쪽지체크
					$tmp_row2 = sql_fetch(" select count(*) as cnt from {$g5['memo_table']} where me_recv_mb_id = '{$row['mb_id']}' and me_read_datetime = '0000-00-00 00:00:00' ", false);

					// 실시간 쪽지 알림 기능
					sql_query(" update {$g5['member_table']} set mb_memo_call = '{$config['cf_admin']}', as_memo = '{$tmp_row2['cnt']}' where mb_id = '{$row['mb_id']}' ", false);

					// Push -----------------------------------------------------------------
					$push = array('use'=>'ev', 'flag'=>'win', 'bo_table'=>$bo_table, 'wr_id'=>$wr_id);
					apms_push($row['mb_id'], $subject, $msg, $url, $push);

				}
			}

			// 종료처리
			sql_query(" update $write_table set wr_5 = '1' where wr_id = '$wr_id' ");
		}
	}

	return $list;
}

?>
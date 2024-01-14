<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 자동복사 & 이동
$is_automove = false;
if($bo_table && $wr_id) { // 글내용에서
	$is_use_automove = (isset($boset['auto']) && ($boset['auto'] == 'copy' || $boset['auto'] == 'move')) ? true : false;
	if($is_use_automove && isset($boset['aboard']) && $boset['aboard']) {
		if($boset['auto'] == "copy" && $write['wr_8'] == "1") {
			; // 이미 복사된 글이면 통과	
		} else {
			if(isset($boset['asop']) && $boset['asop']) { // 모든 조건 충족시
				$is_automove = true;
				if($is_automove && isset($boset['ahit']) && $boset['ahit'] > 0) {
					$is_automove = ($write['wr_hit'] >= $boset['ahit']) ? true : false;
				}

				if($is_automove && isset($boset['acmt']) && $boset['acmt'] > 0) {
					$is_automove = ($write['wr_comment'] >= $boset['acmt']) ? true : false;
				}

				if($is_automove && isset($boset['agood']) && $boset['agood'] > 0) {
					$is_automove = ($write['wr_good'] >= $boset['agood']) ? true : false;
				}

				if($is_automove && isset($boset['anogood']) && $boset['anogood'] > 0) {
					$is_automove = ($write['wr_nogood'] >= $boset['anogood']) ? true : false;
				}
			} else { // 아닐 경우
				if(!$is_automove && isset($boset['ahit']) && $boset['ahit'] > 0) {
					$is_automove = ($write['wr_hit'] >= $boset['ahit']) ? true : false;
				}

				if(!$is_automove && isset($boset['acmt']) && $boset['acmt'] > 0) {
					$is_automove = ($write['wr_comment'] >= $boset['acmt']) ? true : false;
				}

				if(!$is_automove && isset($boset['agood']) && $boset['agood'] > 0) {
					$is_automove = ($write['wr_good'] >= $boset['agood']) ? true : false;
				}

				if(!$is_automove && isset($boset['anogood']) && $boset['anogood'] > 0) {
					$is_automove = ($write['wr_nogood'] >= $boset['anogood']) ? true : false;
				}
			}
		}
		
		if($is_automove) {
			$sw = $boset['auto'];
			$bo_list = $boset['aboard'];
			$ca_name = $boset['acate'];
			include_once('./move_auto.php');

			if($sw == 'copy') { //복사글 기록 - 여분필드 8번
				sql_query(" update $write_table set wr_8 = '1' where wr_id = '$wr_id' ");
			}
		}
	}
}

// 태그 검색
$stag = array();
$is_stag = (isset($boset['ctn']) && $boset['ctn'] > 0) ? true : false; 
$sql_stag = '';
if($is_stag && isset($tag) && $tag) {
    $tmp_stag = explode(',', strip_tags($tag));
	$o = (isset($sto) && $sto) ? ' and ' : ' or ';
	$z = 0;
    for ($i=0; $i < count($tmp_stag); $i++) {

        $str_stag = get_search_string(trim($tmp_stag[$i]));

		if(!$str_stag) continue;

		if($z > 0)
			$sql_stag .= $o;

		if (preg_match("/[a-zA-Z]/", $str_stag))
			$sql_stag .= "INSTR(LOWER(as_tag), LOWER('{$str_stag}'))";
		else
			$sql_stag .= "INSTR(as_tag, '{$str_stag}')";

		$stag[$z] = $str_stag;
		$z++;
	}

	if($sql_stag) {
		$sql_apms_where .= "and ( $sql_stag )";

		if ($sca || $stx) { // 분류 또는 검색일 때는 통과
			;
		} else if($is_show_list) { // 목록보일 때만 체크
			$bo_notice_cnt = 0; // 공지갯수 초기화
			$row = sql_fetch(" select count(*) as cnt from $write_table where wr_is_comment = 0 $sql_apms_where");
			$board['bo_count_write'] = $row['cnt'];
		}

		$qstr .= '&amp;tag='.urlencode($tag).'&amp;sto='.$sto;
	}
}

// 버튼컬러
$btn1 = (isset($boset['btn1']) && $boset['btn1']) ? $boset['btn1'] : 'black';
$btn2 = (isset($boset['btn2']) && $boset['btn2']) ? $boset['btn2'] : 'color';

// 보드상단출력
$is_bo_content_head = false;

?>
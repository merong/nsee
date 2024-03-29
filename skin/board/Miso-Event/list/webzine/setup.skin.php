<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록

if(!$boset['hcolor']) $boset['hcolor'] = 'black';

?>
<table>
<caption>목록스킨설정</caption>
<colgroup>
	<col class="grid_2">
	<col>
</colgroup>
<thead>
<tr>
	<th scope="col">구분</th>
	<th scope="col">설정</th>
</tr>
</thead>
<tbody>
<tr>
	<td align="center">목록모드</td>
	<td>
		<select name="boset[mode]">
			<option value="">일반</option>
			<option value="1"<?php echo get_selected($boset['mode'], "1");?>>더보기</option>
			<option value="2"<?php echo get_selected($boset['mode'], "2");?>>무한스크롤</option>
		</select>
		스타일
		&nbsp;
		<label><input type="checkbox" name="boset[ltop]" value="1"<?php echo get_checked('1', $boset['ltop']);?>> 상단 페이징/버튼 출력</label>
	</td>
</tr>
<tr>
	<td align="center">목록갯수</td>
	<td>
		<input type="text" name="bo_page_rows" value="<?php echo $board['bo_page_rows'];?>" size="4" class="frm_input" > 개 - PC
		&nbsp;
		<input type="text" name="bo_mobile_page_rows" value="<?php echo $board['bo_mobile_page_rows'];?>" size="4" class="frm_input" > 개 - 모바일
	</td>
</tr>
<tr>
	<td align="center">제목길이</td>
	<td>
		<input type="text" name="bo_subject_len" value="<?php echo $board['bo_subject_len'];?>" size="4" class="frm_input" > 자 - PC
		&nbsp;
		<input type="text" name="bo_mobile_subject_len" value="<?php echo $board['bo_mobile_subject_len'];?>" size="4" class="frm_input" > 자 - 모바일
	</td>
</tr>
</tbody>
</table>
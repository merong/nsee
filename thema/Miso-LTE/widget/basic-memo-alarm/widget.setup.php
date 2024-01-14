<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]
if(!$wset['delay']) $wset['delay'] = '60000';
?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
	<colgroup>
		<col class="grid_1">
		<col class="grid_2">
		<col>
	</colgroup>
	<thead>
	<tr>
		<th scope="col" colspan="2">구분</th>
		<th scope="col">설정</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center" rowspan="2">공용</td>
		<td align="center">알람 사용</td>
		<td>
			<label><input type="checkbox" name="wset[alarm_use]" value="1"<?php echo get_checked('1', $wset['alarm_use']); ?>> 사용</label>
		</td>
	</tr>
	<tr>
		<td align="center">작동 간격</td>
		<td>
			<?php echo help('기본 60000ms, 밀리초(ms)는 천분의 1초. ex) 60초 = 60000ms');?>
			<input type="text" name="wset[delay]" value="<?php echo $wset['delay']; ?>" class="frm_input" size="7"> ms 간격(60000 미만 입력시 60000으로 됨)
		</td>
	</tr>	
	</tbody>
	</table>
</div>
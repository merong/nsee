<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

?>

<div class="tbl_head01 tbl_wrap">
	<table>
	<caption>위젯설정</caption>
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
		<td align="center">사용설정</td>
		<td>
			<label><input type="checkbox" name="wset[use]" value="1"<?php echo get_checked('1', $wset['use']);?>> 애드온을 사용합니다.</label>
		</td>
	</tr>
	<tr>
		<td align="center">타이틀</td>
		<td>
			<textarea name="wset[title]" id="ftitle"><?php echo $wset['title']; ?></textarea>
			<div class="h10"></div>	
			<a href="<?php echo G5_BBS_URL;?>/icon.php?fid=ftitle" class="btn_frmline win_scrap">아이콘 선택</a>
		</td>
	</tr>
	<tr>
		<td align="center">세로수</td>
		<td>
			<?php echo help('출력될 게시물 세로갯수');?>
			<input type="text" name="wset[sero]" value="<?php echo $wset['sero']; ?>" class="frm_input" size="3"> 개 PC 출력
			&nbsp;
			<input type="text" name="wmset[sero]" value="<?php echo $wmset['sero']; ?>" class="frm_input" size="3"> 개 모바일 출력
			&nbsp;
			<input type="text" name="wset[page]" value="<?php echo $wset['page'];?>" size="3" class="frm_input"> 페이지 자료 추출
		</td>
	</tr>
	<tr>
		<td align="center">가로수</td>
		<td>
			<?php echo help('출력될 게시물 가로갯수');?>
			<select name="wset[garo]">
				<?php echo apms_cols_options($wset['garo'], '2,1,3,4'); ?>
			</select>
			개 PC 출력
			&nbsp;
			<select name="wmset[garo]">
				<?php echo apms_cols_options($wmset['garo'], '2,1,3,4'); ?>
			</select>
			개 모바일 출력
		</td>
	</tr>
	<tr>
		<td align="center">가로최소</td>
		<td>
			<select name="wset[xs]">
				<?php echo apms_cols_options($wset['xs'], '1,2,3'); ?>
			</select>
			개 PC 배치
			&nbsp;
			<select name="wmset[xs]">
				<?php echo apms_cols_options($wmset['xs'], '1,2,3'); ?>
			</select>
			개 모바일 최소 가로배치
		</td>
	</tr>
	<tr>
		<td align="center">랭크설정</td>
		<td>
			<select name="wset[sort]">
				<?php echo apms_rank_options($wset['sort']);?>
			</select>
			&nbsp;
			랭크표시
			<select name="wset[rank]">
				<?php echo apms_color_options($wset['rank']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">기간설정</td>
		<td>
			<select name="wset[term]">
				<?php echo apms_term_options($wset['term']);?>
			</select>
			&nbsp;
			<input type="text" name="wset[dayterm]" value="<?php echo $wset['dayterm'];?>" size="3" class="frm_input"> 일전까지 자료(일자지정 설정시 적용)
		</td>
	</tr>
	<tr>
		<td align="center">추출보드</td>
		<td>
			<?php echo help('보드아이디를 콤마(,)로 구분해서 복수 등록 가능, <b>미입력시 현재 게시판 적용</b>');?>
			<input type="text" name="wset[bo_list]" value="<?php echo $wset['bo_list']; ?>" size="60" class="frm_input">
		</td>
	</tr>
	<tr>
		<td align="center">추출그룹</td>
		<td>
			<?php echo help('그룹아이디를 콤마(,)로 구분해서 복수 등록 가능, 설정시 추출보드는 적용안됨');?>
			<input type="text" name="wset[gr_list]" value="<?php echo $wset['gr_list']; ?>" size="60" class="frm_input">
		</td>
	</tr>
	<tr>
		<td align="center">추출분류</td>
		<td>
			<?php echo help('분류를 콤마(,)로 구분해서 복수 등록 가능, 단일보드 추출시에만 적용됨');?>
			<input type="text" name="wset[ca_list]" value="<?php echo $wset['ca_list']; ?>" size="60" class="frm_input">
		</td>
	</tr>
	<tr>
		<td align="center">제외설정</td>
		<td>
			<label><input type="checkbox" name="wset[except]" value="1"<?php echo get_checked('1', $wset['except']);?>> 지정한 보드/그룹 제외</label>
			&nbsp;
			<label><input type="checkbox" name="wset[ex_ca]" value="1"<?php echo get_checked('1', $wset['ex_ca']);?>> 지정한 분류제외</label>
		</td>
	</tr>
	<tr>
		<td align="center">캐시사용</td>
		<td>
			<input type="text" name="wset[cache]" value="<?php echo $wset['cache']; ?>" class="frm_input" size="4"> 초 간격으로 캐싱 - 본인자료 추출설정시 캐시사용하면 안됩니다.
		</td>
	</tr>
	</tbody>
	</table>
</div>
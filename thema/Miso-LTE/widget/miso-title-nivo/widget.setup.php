<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키] 형태로 등록
// 모바일 설정값은 동일 배열키에 배열변수만 wmset으로 지정 → wmset[배열키]

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
		<td align="center" rowspan="10">공통</td>
		<td align="center">Effect</td>
		<td>
			<select name="wset[effect]">
				<option value="">Random</option>
				<option value="sliceDown"<?php echo get_selected("sliceDown", $wset['effect']);?>>sliceDown</option>
				<option value="sliceDownLeft"<?php echo get_selected("sliceDownLeft", $wset['effect']);?>>sliceDownLeft</option>
				<option value="sliceUp"<?php echo get_selected("sliceUp", $wset['effect']);?>>sliceUp</option>
				<option value="sliceUpLeft"<?php echo get_selected("sliceUpLeft", $wset['effect']);?>>sliceUpLeft</option>
				<option value="sliceUpDown"<?php echo get_selected("sliceUpDown", $wset['effect']);?>>sliceUpDown</option>
				<option value="sliceUpDownLeft"<?php echo get_selected("sliceUpDownLeft", $wset['effect']);?>>sliceUpDownLeft</option>
				<option value="fold"<?php echo get_selected("fold", $wset['effect']);?>>fold</option>
				<option value="fade"<?php echo get_selected("fade", $wset['effect']);?>>fade</option>
				<option value="slideInRight"<?php echo get_selected("slideInRight", $wset['effect']);?>>slideInRight</option>
				<option value="slideInLeft"<?php echo get_selected("slideInLeft", $wset['effect']);?>>slideInLeft</option>
				<option value="boxRandom"<?php echo get_selected("boxRandom", $wset['effect']);?>>boxRandom</option>
				<option value="boxRain"<?php echo get_selected("boxRain", $wset['effect']);?>>boxRain</option>
				<option value="boxRainReverse"<?php echo get_selected("boxRainReverse", $wset['effect']);?>>boxRainReverse</option>
				<option value="boxRainGrow"<?php echo get_selected("boxRainGrow", $wset['effect']);?>>boxRainGrow</option>
				<option value="boxRainGrowReverse"<?php echo get_selected("boxRainGrowReverse", $wset['effect']);?>>boxRainGrowReverse</option>
			</select>
			&nbsp;	
			<label><input type="checkbox" name="wset[cache]" value="1"<?php echo get_checked('1', $wset['cache']); ?>> 캐시 사용</label>
		</td>
	</tr>
	<tr>
		<td align="center">Slices</td>
		<td>
			<input type="text" name="wset[slices]" value="<?php echo $wset['slices']; ?>" class="frm_input" size="4"> 개 (기본 15) // For slice animations
		</td>
	</tr>
	<tr>
		<td align="center">boxCols</td>
		<td>
			<input type="text" name="wset[boxcols]" value="<?php echo $wset['boxcols']; ?>" class="frm_input" size="4"> 개 (기본 8) // For box animations
		</td>
	</tr>
	<tr>
		<td align="center">boxRows</td>
		<td>
			<input type="text" name="wset[boxrows]" value="<?php echo $wset['boxrows']; ?>" class="frm_input" size="4"> 개 (기본 4) // For box animations
		</td>
	</tr>
	<tr>
		<td align="center">animSpeed</td>
		<td>
			<?php echo help('밀리초(ms)는 천분의 1초입니다. ex) 3초 = 3000ms');?>
			<input type="text" name="wset[animspeed]" value="<?php echo $wset['animspeed']; ?>" class="frm_input" size="4"> ms (기본 500) // Slide transition speed
		</td>
	</tr>
	<tr>
		<td align="center">pauseTime</td>
		<td>
			<input type="text" name="wset[pausetime]" value="<?php echo $wset['pausetime']; ?>" class="frm_input" size="4"> ms (기본 3000) // How long each slide will show
		</td>
	</tr>
	<tr>
	<td align="center">보임설정</td>
		<td>
			<select name="wset[shadow]">
				<?php echo apms_shadow_options($wset['shadow']);?>
			</select>
			&nbsp;
			<label><input type="checkbox" name="wset[inshadow]" value="1"<?php echo get_checked('1', $wset['inshadow']); ?>> 내부그림자</label>
			&nbsp;
			<select name="wset[nav]">
				<option value="">네비없음</option>
				<option value="1"<?php echo get_selected("1", $wset['nav']);?>>점네비</option>
				<option value="2"<?php echo get_selected("2", $wset['nav']);?>>썸네비</option>
			</select>
			&nbsp;
			<label><input type="checkbox" name="wset[arrow]" value="1"<?php echo get_checked('1', $wset['arrow']); ?>> 화살표 숨김</label>
		</td>
	</tr>
	<tr>
		<td align="center">기타설정</td>
		<td>
			<select name="wset[caption]">
				<option value="">캡션설정</option>
				<option value="1"<?php echo get_selected("1", $wset['caption']);?>>기본캡션</option>
				<option value="2"<?php echo get_selected("2", $wset['caption']);?>>호버캡션</option>
				<option value="3"<?php echo get_selected("3", $wset['caption']);?>>미들캡션</option>
				<option value="4"<?php echo get_selected("4", $wset['caption']);?>>라지캡션</option>
			</select>
			&nbsp;
			<label><input type="checkbox" name="wset[pausehover]" value="1"<?php echo get_checked('1', $wset['pausehover']); ?>> 마우스 오버시 멈춤</label>
			&nbsp;
			<label><input type="checkbox" name="wset[rdmstart]" value="1"<?php echo get_checked('1', $wset['rdmstart']); ?>> 랜덤 슬라이더</label>
		</td>
	</tr>
	<tr>
		<td align="center">높이설정</td>
		<td>
			<?php echo help('반응구간별 너비대비 높이비율. 기본은 30%, 모바일은 xs 값이 적용됨');?>
			<table>
			<thead>
			<tr>
				<th scope="col">구분</th>
				<th scope="col">기본</th>
				<th scope="col">lg(1199px~)</th>
				<th scope="col">md(991px~)</th>
				<th scope="col">sm(767px~)</th>
				<th scope="col">xs(480px~)</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td align="center">높이(%)</td>
				<td align="center">
					<input type="text" name="wset[height]" value="<?php echo $wset['height']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[lg]" value="<?php echo $wset['lg']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[md]" value="<?php echo $wset['md']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[sm]" value="<?php echo $wset['sm']; ?>" class="frm_input" size="4">
				</td>
				<td align="center">
					<input type="text" name="wset[xs]" value="<?php echo $wset['xs']; ?>" class="frm_input" size="4">
				</td>
			</tr>
			</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><b>출력갯수</b></td>
		<td>
			<input type="text" name="wset[slider]" value="<?php echo $wset['slider']; ?>" class="frm_input" size="4"> 개 - 입력후 저장하시면 슬라이더가 생성됩니다.
		</td>
	</tr>
	<?php for ($i=1; $i <= $wset['slider']; $i++) { ?>
		<tr>
			<td align="center" rowspan="4">#<?php echo $i;?></td>
			<td align="center" class="bg-light"><b>사용여부</b></td>
			<td class="bg-light">
				<label><input type="checkbox" name="wset[use<?php echo $i;?>]" value="1"<?php echo get_checked('1', $wset['use'.$i]); ?>> <b>출력하기</b></label>
			</td>
		</tr>
		<tr>
			<td align="center">이미지</td>
			<td>
				<input type="text" name="wset[img<?php echo $i;?>]" value="<?php echo ($wset['img'.$i]);?>" id="img<?php echo $i;?>" size="44" class="frm_input"> 
				<a href="<?php echo G5_BBS_URL;?>/widget.image.php?fid=img<?php echo $i;?>" class="btn_frmline win_scrap">이미지 선택</a>
			</td>
		</tr>
		<tr>
			<td align="center">캡션</td>
			<td>
				<input type="text" name="wset[caption<?php echo $i;?>]" value="<?php echo ($wset['caption'.$i]);?>" id="caption<?php echo $i;?>" size="44" class="frm_input" placeholder="기타설정의 캡션설정을 해야 출력됨"> 
				<a href="<?php echo G5_BBS_URL;?>/ficon.php?fid=caption<?php echo $i;?>" class="btn_frmline win_scrap">아이콘 선택</a>
			</td>
		</tr>
		<tr>
			<td align="center">링크</td>
			<td>
				<input type="text" name="wset[link<?php echo $i;?>]" value="<?php echo $wset['link'.$i]; ?>" size="40" class="frm_input" placeholder="http://...">
				&nbsp;
				타켓
				<input type="text" name="wset[target<?php echo $i;?>]" value="<?php echo $wset['target'.$i]; ?>" size="8" class="frm_input">
			</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
</div>
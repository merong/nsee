<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록

$skinlist = array();

$boset['list_skin'] = (isset($boset['list_skin']) && $boset['list_skin']) ? $boset['list_skin'] : 'basic';
$boset['view_skin'] = (isset($boset['view_skin']) && $boset['view_skin']) ? $boset['view_skin'] : 'basic';
$boset['write_skin'] = (isset($boset['write_skin']) && $boset['write_skin']) ? $boset['write_skin'] : 'basic';

?>
<script>
function apms_change_skin(id, type, skin) {
	$.get("./board.skin.php?bo_table=<?php echo $bo_table;?>&type="+type+"&skin="+skin, function (data) {
		$("#"+id).html(data);
	});
}
$(function(){
	$("#howto").click(function() {
		$("#guide").toggle();
	});
});
</script>
<div class="tbl_head01 tbl_wrap">
	<p><b>■ 채택설정</b></p>
	<table>
	<caption>채택설정</caption>
	<colgroup>
		<col class="grid_2">
		<col>
	</colgroup>
	<tr>
		<th scope="col">구분</th>
		<th scope="col">설정</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td align="center">수수료</td>
		<td>
			<input type="text" name="boset[cpoint]" value="<?php echo (int)$boset['cpoint']; ?>" class="frm_input" size="4"> % 채택수수료 적용
			-
			<select name="boset[fee]">
				<option value="0"<?php echo get_selected('0', $boset['fee']); ?>>모두</option>
				<option value="1"<?php echo get_selected('1', $boset['fee']); ?>>등록자만</option>
				<option value="2"<?php echo get_selected('2', $boset['fee']); ?>>당첨자만</option>
			</select>
			부담
		</td>
	</tr>
	<tr>
		<td align="center">포인트</td>
		<td>
			<input type="text" name="boset[min_cp]" value="<?php echo (int)$boset['min_cp'];?>" size="4" class="frm_input"> 이상 
			~
			<input type="text" name="boset[max_cp]" value="<?php echo (int)$boset['max_cp'];?>" size="4" class="frm_input"> 이하로 채택 포인트 등록가능
		</td>
	</tr>
	<tr>
		<td align="center">등록제한</td>
		<td>
			<label><input type="checkbox" name="boset[limit_point]" value="1"<?php echo get_checked('1', $boset['limit_point']);?>> 보유포인트 부족시 글등록/수정 제한</label>
		</td>
	</tr>
	<tr>
		<td align="center">등록설정</td>
		<td>
			<?php echo help('채택포인트가 설정된 글만 대상으로 합니다.');?>
			<input type="text" name="boset[limit_cmt]" value="<?php echo (int)$boset['limit_cmt'];?>" size="4" class="frm_input">
			개 이상 댓글이 달린 미채택글이
			<input type="text" name="boset[limit_post]" value="<?php echo (int)$boset['limit_post'];?>" size="4" class="frm_input">
			개 이상일 때 글등록 불가
		</td>
	</tr>
	<tr>
		<td align="center">종료표시</td>
		<td>
			<input type="text" name="boset[end]" value="<?php echo (int)$boset['end'];?>" size="4" class="frm_input">
			일이 경과된 등록설정 미만의 미채택글은 종료표시
		</td>
	</tr>
	</tbody>
	</table>

	<br>

    <div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey="s">
		<button type="button" onclick="window.close();">닫기</button>
    </div>

	<br>
	<p><b>■ 태그분류</b></p>
	<table>
	<caption>태그분류</caption>
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
		<td align="center">항목설정</td>
		<td>
			<input type="text" name="boset[ctn]" value="<?php echo $boset['ctn']; ?>" class="frm_input" size="4"> 개 - 입력후 저장하시면 설정한 수만큼 태그분류 설정항목이 생성됨
		</td>
	</tr>
	<?php for ($i=1; $i <= $boset['ctn']; $i++) { ?>
		<?php if($i == 1) { ?>
		<tr>
			<td align="center">검색방법</td>
			<td>
				<label><input type="checkbox" name="boset[cts]" value="1"<?php echo get_checked('1', $boset['cts']);?>> 태그선택시 바로 검색(and 검색)</label>
			</td>
		</tr>
		<tr>
			<td align="center">설정안내</td>
			<td>
				<ol style="margin:0px; padding:0px; padding-left:25px;line-height:22px;">
					<li>구분명과 태그 모두 입력해야 출력되며, 태그는 단어로 콤마(,)로 구분해서 등록</li>
					<li>"아미나", "아미나빌더"처럼 태그를 포함하는 태그가 있으면 "아미나"로 정렬시 "아미나빌더"도 출력되니 포함단어가 없도록 등록</li>
					<li>태그 사이에 바(|)를 등록하면 단락구분이 됨 ex) 빌더,테마,|,스킨,위젯</li>
				</ol>
			</td>
		</tr>
		<tr>
			<td align="center">
				이용안내
				<br>
				<input type="text" name="boset[intxt]" value="<?php echo $boset['intxt'];?>" size="10" class="frm_input">
			</td>
			<td>
				<?php echo help('첫번째 탭에 이용안내 또는 공지 등을 출력시 그 내용을 등록해 주세요.');?>
				<textarea name="boset[intro]" style="width:98%; height:80px;"><?php echo $boset['intro'];?></textarea>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<td align="center">
				탭이름 #<?php echo $i;?>
				<br>
				<input type="text" name="boset[ct<?php echo $i;?>]" value="<?php echo $boset['ct'.$i];?>" size="10" class="frm_input">
			</td>
			<td>
				<textarea name="boset[ctc<?php echo $i;?>]" style="width:98%; height:80px;"><?php echo $boset['ctc'.$i];?></textarea>
			</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>

	<br>

    <div class="btn_confirm01 btn_confirm">
		<input type="submit" value="확인" class="btn_submit" accesskey="s">
		<button type="button" onclick="window.close();">닫기</button>
    </div>

	<br>

	<p><b>■ 보드설정</b></p>
	<table>
	<caption>보드설정</caption>
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
		<td align="center">
			헤더출력
		</td>
		<td>
			<select name="boset[header_skin]">
				<option value="">사용안함</option>
				<?php
					$skinlist = get_skin_dir('header');
					for ($k=0; $k<count($skinlist); $k++) {
						echo "<option value=\"".$skinlist[$k]."\"".get_selected($skinlist[$k], $boset['header_skin']).">".$skinlist[$k]."</option>\n";
					} 
				?>
			</select>
			&nbsp;
			<select name="boset[header_color]">
				<?php echo apms_color_options($boset['header_color']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">목록링크</td>
		<td>
			<select name="boset[modal]">
				<option value=""<?php echo get_selected('', $boset['modal']);?>>글내용 - 현재창</option>
				<option value="1"<?php echo get_selected('1', $boset['modal']);?>>글내용 - 모달창</option>
				<option value="2"<?php echo get_selected('2', $boset['modal']);?>>링크#1 - 새창</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">상단검색</td>
		<td>
			<select name="boset[tsearch]">
				<option value="">사용안함</option>
				<?php echo apms_color_options($boset['tsearch']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center">정렬추가</td>
		<td>
			<label><input type="checkbox" name="boset[scmt]" value="1"<?php echo get_checked('1', $boset['scmt']);?>> 댓글순</label>
			&nbsp;
			<label><input type="checkbox" name="boset[sdload]" value="1"<?php echo get_checked('1', $boset['sdload']);?>> 다운순</label>
			&nbsp;
			<label><input type="checkbox" name="boset[svisit]" value="1"<?php echo get_checked('1', $boset['svisit']);?>> 방문순</label>
			&nbsp;
			<label><input type="checkbox" name="boset[spoll]" value="1"<?php echo get_checked('1', $boset['spoll']);?>> 참여순</label>
			&nbsp;
			<label><input type="checkbox" name="boset[supdate]" value="1"<?php echo get_checked('1', $boset['supdate']);?>> 업데이트순</label>
			&nbsp;
			<label><input type="checkbox" name="boset[sdown]" value="1"<?php echo get_checked('1', $boset['sdown']);?>> 다운점수순</label>
		</td>
	</tr>
	<tr>
		<td align="center" rowspan="2">카테고리</td>
		<td>
			<select name="boset[tab]">
				<?php echo apms_tab_options($boset['tab']);?>
			</select>
			&nbsp;
			<label><input type="checkbox" name="boset[tabline]" value="1"<?php echo get_checked($boset['tabline'], '1');?>> 일반탭 상단라인 출력</label>
			-
			탭/버튼컬러
			<select name="boset[mctab]">
				<?php echo apms_color_options($boset['mctab']);?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<label><input type="radio" name="boset[ctype]" value=""<?php echo get_checked('', $boset['ctype']);?>> 일반형</label>
			&nbsp;
			<label><input type="radio" name="boset[ctype]" value="1"<?php echo get_checked('1', $boset['ctype']);?>> 배분형</label>
			&nbsp;
			<label><input type="radio" name="boset[ctype]" value="2"<?php echo get_checked('2', $boset['ctype']);?>> 분할형</label>
			-
			가로 최대 <input type="text" name="boset[bunhal]" value="<?php echo $boset['bunhal'];?>" size="2" class="frm_input"> 개 출력
		</td>
	</tr>
	<tr>
		<td align="center">버튼컬러</td>
		<td>
			<select name="boset[btn1]">
				<option value="">기본컬러</option>
				<?php echo apms_color_options($boset['btn1']);?>
			</select>
			&nbsp;
			주버튼컬러
			<select name="boset[btn2]">
				<option value="">기본컬러</option>
				<?php echo apms_color_options($boset['btn2']);?>
			</select>

		</td>
	</tr>
	<tr>
		<td align="center">포토컬러</td>
		<td>
			<select name="boset[icolor]">
				<?php echo apms_color_options($boset['icolor']);?>
			</select>
			&nbsp;
			<label><input type="checkbox" name="boset[ibg]" value="1"<?php echo get_checked('1', $boset['ibg']);?>> 배경색으로 적용</label>
		</td>
	</tr>
	<tr>
		<td align="center">대표포토</td>
		<td>
			<input type="text" name="boset[ficon]" id="ficon" value="<?php echo ($boset['ficon']);?>" size="30" class="frm_input"> 
			<a href="<?php echo G5_BBS_URL;?>/ficon.php?fid=ficon" class="btn_frmline win_scrap">아이콘 선택</a>
		</td>
	</tr>
	<tr>
		<td align="center">영상너비</td>
		<td>
			<?php echo help('본문 동영상 최대 너비로 미설정시 APMS 기본설정값이 적용됨');?>
			<input type="text" name="boset[video]" value="<?php echo $boset['video'];?>" size="8" class="frm_input" placeholder="ex) 800px"> % 또는 px 단위까지 입력
		</td>
	</tr>
	<tr>
		<td align="center">댓글설정</td>
		<td>
			회원사진
			<select name="boset[cmt_photo]">
				<option value=""<?php echo get_selected('', $boset['cmt_photo']); ?>>모두출력</option>
				<option value="1"<?php echo get_selected('1', $boset['cmt_photo']); ?>>PC만</option>
				<option value="2"<?php echo get_selected('2', $boset['cmt_photo']); ?>>모바일만</option>
				<option value="3"<?php echo get_selected('3', $boset['cmt_photo']); ?>>출력안함</option>
			</select>
			&nbsp;
			대댓글 이름
			<select name="boset[cmt_re]">
				<option value=""<?php echo get_selected('', $boset['cmt_re']); ?>>출력안함</option>
				<option value="1"<?php echo get_selected('1', $boset['cmt_re']); ?>>모두</option>
				<option value="2"<?php echo get_selected('2', $boset['cmt_re']); ?>>PC만</option>
				<option value="3"<?php echo get_selected('3', $boset['cmt_re']); ?>>모바일만</option>
			</select>
			&nbsp;
			<label><input type="checkbox" name="boset[cgood]" value="1"<?php echo get_checked('1', $boset['cgood']);?>> 댓글추천</label>
			&nbsp;
			<label><input type="checkbox" name="boset[cnogood]" value="1"<?php echo get_checked('1', $boset['cnogood']);?>> 비추천</label>
		</td>
	</tr>
	<tr>
		<td align="center">목록라벨</td>
		<td>
			<?php echo help('분류명|배경색|표시문구 형식으로 줄바꿈(엔터)로 구분<br>각 항목은 바(|)로 구분하며, 분류명은 콤마(,)로 복수등록 가능<br>배경색은 red, blue, green, orange, yellow, violet 등 지정가능(기본배경색 참고)');?>
			<label><input type="checkbox" name="boset[label]" value="1" <?php echo ($boset['label']) ? ' checked' : '';?>> 사용</label>
			-
			기본문구
			<input type="text" name="boset[label_name]" value="<?php echo $boset['label_name']; ?>" size="12" class="frm_input">
			&nbsp;
			기본배경색
			<select name="boset[label_color]">
				<?php echo apms_color_options($boset['label_color']);?>
			</select>
			<div style="height:8px;"></div>
			<textarea name="boset[label_list]" style="height:100px;"><?php echo $boset['label_list'];?></textarea>
		</td>
	</tr>
	<tr>
		<td align="center">태그등록</td>
		<td>
			<select name="boset[tag]">
				<option value="">사용안함</option>
				<?php echo apms_grade_options($boset['tag']);?>
			</select>
			등급 이상 회원만 태그등록 허용
		</td>
	</tr>
	</tbody>
	</table>

	<br><br>

	<p>
		<b>■ 목록스킨</b>
		&nbsp;
		<select name="boset[list_skin]" onchange="apms_change_skin('list_skin', 'list', this.value);">
		<?php
			unset($skinlist);
			$skinlist = get_skin_dir('list', $board_skin_path);
			$boset['list_skin'] = (is_dir($board_skin_path.'/list/'.$boset['list_skin'])) ? $boset['list_skin'] : $skinlist[0];
			for ($k=0; $k<count($skinlist); $k++) {
				echo "<option value=\"".$skinlist[$k]."\"".get_selected($skinlist[$k], $boset['list_skin']).">".$skinlist[$k]."</option>\n";
			} 
		?>
		</select>
	</p>
	<div id="list_skin">
		<?php @include_once($board_skin_path.'/list/'.$boset['list_skin'].'/setup.skin.php');?>
	</div>

	<br><br>

	<p>
		<b>■ 내용스킨</b>
		&nbsp;
		<select name="boset[view_skin]" onchange="apms_change_skin('view_skin', 'view', this.value);">
		<?php
			unset($skinlist);
			$skinlist = get_skin_dir('view', $board_skin_path);
			$boset['view_skin'] = (is_dir($board_skin_path.'/view/'.$boset['view_skin'])) ? $boset['view_skin'] : $skinlist[0];
			for ($k=0; $k<count($skinlist); $k++) {
				echo "<option value=\"".$skinlist[$k]."\"".get_selected($skinlist[$k], $boset['view_skin']).">".$skinlist[$k]."</option>\n";
			} 
		?>
		</select>
	</p>
	<div id="view_skin">
		<?php @include_once($board_skin_path.'/view/'.$boset['view_skin'].'/setup.skin.php');?>
	</div>

	<br><br>

	<p>
		<b>■ 쓰기스킨</b>
		&nbsp;
		<select name="boset[write_skin]" onchange="apms_change_skin('write_skin', 'write', this.value);">
		<?php
			unset($skinlist);
			$skinlist = get_skin_dir('write', $board_skin_path);
			$boset['write_skin'] = (is_dir($board_skin_path.'/write/'.$boset['write_skin'])) ? $boset['write_skin'] : $skinlist[0];
			for ($k=0; $k<count($skinlist); $k++) {
				echo "<option value=\"".$skinlist[$k]."\"".get_selected($skinlist[$k], $boset['write_skin']).">".$skinlist[$k]."</option>\n";
			} 
		?>
		</select>
	</p>
	<div id="write_skin">
		<?php @include_once($board_skin_path.'/write/'.$boset['write_skin'].'/setup.skin.php');?>
	</div>

	<br><br>


</div>
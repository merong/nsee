<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$write_skin_url.'/write.css" media="screen">', 0);

if(!$header_skin) { 
?>
<div class="well">
	<h2><?php echo $g5['title'] ?></h2>
</div>
<?php } ?>

<!-- 게시물 작성/수정 시작 { -->
<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" role="form" class="form-horizontal">
<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
<input type="hidden" name="sca" value="<?php echo $sca ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<?php
	$option = '';
	$option_hidden = '';
	if ($is_notice || $is_html || $is_secret || $is_mail) {
		if ($is_notice) {
			$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'> 공지</label>';
		}

		if ($is_html) {
			if ($is_dhtml_editor) {
				$option_hidden .= '<input type="hidden" value="html1" name="html">';
			} else {
				$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'> HTML</label>';
			}
		}

		if ($is_secret) {
			if ($is_admin || $is_secret==1) {
				$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'> 비밀글</label>';
			} else {
				$option_hidden .= '<input type="hidden" name="secret" value="secret">';
			}
		}

		if ($is_notice) {
			$main_checked = ($write['as_type']) ? ' checked' : '';
			$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="as_type" name="as_type" value="1" '.$main_checked.'> 메인글</label>';
		}

		if ($is_mail) {
			$option .= "\n".'<label class="control-label sp-label"><input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'> 답변메일받기</label>';
		}
	}

	echo $option_hidden;
?>

<?php if ($is_name) { ?>
	<div class="form-group has-feedback">
		<label class="col-sm-2 control-label" for="wr_name">이름<strong class="sound_only">필수</strong></label>
		<div class="col-sm-3">
			<input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="form-control input-sm" size="10" maxlength="20">
			<span class="fa fa-check form-control-feedback"></span>
		</div>
	</div>
<?php } ?>

<?php if ($is_password) { ?>
	<div class="form-group has-feedback">
		<label class="col-sm-2 control-label" for="wr_password">비밀번호<strong class="sound_only">필수</strong></label>
		<div class="col-sm-3">
			<input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="form-control input-sm" maxlength="20">
			<span class="fa fa-check form-control-feedback"></span>
		</div>
	</div>
<?php } ?>

<?php if ($is_email) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="wr_email">E-mail</label>
		<div class="col-sm-6">
			<input type="text" name="wr_email" id="wr_email" value="<?php echo $email ?>" class="form-control input-sm email" size="50" maxlength="100">
		</div>
	</div>
<?php } ?>

<?php if ($is_homepage) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="wr_homepage">홈페이지</label>
		<div class="col-sm-6">
			<input type="text" name="wr_homepage" id="wr_homepage" value="<?php echo $homepage ?>" class="form-control input-sm" size="50">
		</div>
	</div>
<?php } ?>

<div class="form-group">
	<label class="col-sm-2 control-label hidden-xs">포토</label>
	<div class="col-sm-10">
		<input type="hidden" name="as_icon" value="<?php echo $write['as_icon'];?>" id="picon">
		<?php
			$fa_photo = (isset($boset['ficon']) && $boset['ficon']) ? apms_fa($boset['ficon']) : '<i class="fa fa-user"></i>';		
			$myicon = ($w == 'u') ? apms_photo_url($write['mb_id']) : apms_photo_url($member['mb_id']);
			$myicon = ($myicon) ? '<img src="'.$myicon.'">' : $fa_photo;
			if($write['as_icon']) {
				$as_icon = apms_fa(apms_emo($write['as_icon']));
				$as_icon = ($as_icon) ? $as_icon : $myicon;
			} else {
				$as_icon = $myicon;
			}
		?>
		<style>
			.write-wrap .talker-photo i { 
				<?php echo (isset($boset['ibg']) && $boset['ibg']) ? 'background:'.apms_color($boset['icolor']).'; color:#fff' : 'color:'.apms_color($boset['icolor']);?>; 
			}
		</style>
		<span id="ticon" class="talker-photo"><?php echo $as_icon;?></span>
		&nbsp;
		<div class="btn-group" data-toggle="buttons">
			<label class="btn btn-default" onclick="apms_emoticon('picon', 'ticon');" title="이모티콘">
				<input type="radio" name="select_icon" id="select_icon1">
				<i class="fa fa-smile-o fa-lg"></i><span class="sound_only">이모티콘</span>
			</label>
			<label class="btn btn-default" onclick="win_scrap('<?php echo G5_BBS_URL;?>/ficon.php?fid=picon&sid=ticon');" title="FA아이콘">
				<input type="radio" name="select_icon" id="select_icon2">
				<i class="fa fa-info-circle fa-lg"></i><span class="sound_only">FA아이콘</span>
			</label>
			<label class="btn btn-default" onclick="apms_myicon();" title="내사진">
				<input type="radio" name="select_icon" id="select_icon3">
				<i class="fa fa-user fa-lg"></i><span class="sound_only">내사진</span>
			</label>
		</div>
	</div>
</div>

<?php if ($is_category || $option) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label hidden-xs"><?php echo ($is_category) ? '분류' : '옵션';?></label>
		<?php if ($is_category) { ?>
			<div class="col-sm-3">
				<select name="ca_name" id="ca_name" required class="form-control input-sm">
					<option value="">선택하세요</option>
					<?php echo $category_option ?>
				</select>
			</div>
		<?php } ?>
		<?php if ($option) { ?>
			<div class="col-sm-7">
				<div class="h10 visible-xs"></div>
				<?php echo $option ?>
			</div>
		<?php } ?>
	</div>
<?php } ?>

<?php if ($is_stag) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label hidden-xs">태그</label>
		<div class="col-sm-10">
			<input type="hidden" name="as_tag" id="as_tag" value="" class="form-control input-sm" size="50">
			<div class="list-tags">
				<div id="tags_tab" class="div-tab tabs trans-top" role="tabpanel">
					<ul class="nav nav-tabs" role="tablist">
					<?php
						$z = 1;
						for($k=1; $k <= $boset['ctn']; $k++) {
							$ctag_name = trim($boset['ct'.$k]);
							$ctag_list = trim($boset['ctc'.$k]);
							
							if(!$ctag_name || !$ctag_list) continue;
					?>
						<li<?php echo ($z == "1") ? ' class="active"' : '';?>>
							<a href="#tags_<?php echo $z;?>" aria-controls="tags_<?php echo $z;?>" role="tab" data-toggle="tab"><b><?php echo $ctag_name;?></b></a>
						</li>
					<?php $z++; } ?>
					</ul>
					<div class="tab-content">
						<?php
							$stag = explode(',', $write['as_tag']);
							$stag_cnt = count($stag);
							$z = 1;
							for($k=1; $k <= $boset['ctn']; $k++) {
								$ctag_name = trim($boset['ct'.$k]);
								$ctag_list = trim($boset['ctc'.$k]);
								
								if(!$ctag_name || !$ctag_list) continue;
						?>
							<div role="tabpanel" class="tab-pane<?php echo ($z == "1") ? ' active' : '';?>" id="tags_<?php echo $z;?>">
								<div class="tags-item" data-toggle="buttons">
									<?php
									$stags = explode(',', $ctag_list);
									$stags_cnt = count($stags);
									for($i=0; $i < $stags_cnt; $i++) {

										$ti = trim($stags[$i]);

										if(!$ti) 
											continue;

										if($ti == "|") { // 줄바꿈처리
											echo '<div class="tags-line"></div>'.PHP_EOL;
											continue;
										}

										$stag_active = $stag_checked = '';
										if($stag_cnt) {
											if(in_array($ti, $stag)) {
												$stag_active = ' active';
												$stag_checked = ' checked';
											}
										}
									?>
										<label class="btn btn-xs chk-tag<?php echo $stag_active;?>">
											<input name="stag[]" type="checkbox" value="<?php echo $ti;?>" autocomplete="off"<?php echo $stag_checked;?>>
											<span><?php echo $ti;?></span>
										</label>
									<?php } ?>
								</div>
							</div>
						<?php $z++; } ?>
					</div>
				</div>
			</div>
			<div class="text-muted">
				<i class="fa fa-bell"></i> 태그는 복수선택이 가능하며, 최소 1개 이상은 선택해야 합니다.
			</div>
		</div>
	</div>
<?php } ?>

<?php if ($is_member) { // 임시 저장된 글 기능 ?>
	<script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
	<?php if($editor_content_js) echo $editor_content_js; ?>
	<div class="modal fade" id="autosaveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">임시 저장된 글 목록</h4>
				</div>
				<div class="modal-body">
					<div id="autosave_wrapper">
						<div id="autosave_pop">
							<ul></ul>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<div class="form-group">
	<label class="col-sm-2 control-label" for="wr_subject">제목<strong class="sound_only">필수</strong></label>
	<div class="col-sm-10">
		<div class="input-group">
			<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="form-control input-sm" size="50" maxlength="255">
			<span class="input-group-btn" role="group">
				<a href="<?php echo G5_BBS_URL;?>/helper.php" target="_blank" class="btn btn-<?php echo $btn1;?> btn-sm hidden-xs win_scrap">안내</a>
				<a href="<?php echo G5_BBS_URL;?>/helper.php?act=map" target="_blank" class="btn btn-<?php echo $btn1;?> btn-sm hidden-xs win_scrap">지도</a>
				<?php if ($is_member) { // 임시 저장된 글 기능 ?>
					<button type="button" id="btn_autosave" data-toggle="modal" data-target="#autosaveModal" class="btn btn-<?php echo $btn1;?> btn-sm">저장 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
				<?php } ?>
			</span>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-12">
		<?php if($write_min || $write_max) { ?>
			<!-- 최소/최대 글자 수 사용 시 -->
			<div class="well well-sm" style="margin-bottom:15px;">
				현재 <strong><span id="char_count"></span></strong> 글자이며, 최소 <strong><?php echo $write_min; ?></strong> 글자 이상, 최대 <strong><?php echo $write_max; ?></strong> 글자 이하까지 쓰실 수 있습니다.
			</div>
		<?php } ?>
		<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
	</div>
</div>
<?php if($is_use_reading) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">열람설정</label>
		<div class="col-sm-3">
			<div class="input-group input-group-sm">
				<input type="text" class="form-control input-sm" name="as_view" id="as_view" value="<?php echo $write['as_view'];?>" placeholder="양수입력">
				<span class="input-group-addon"><?php echo AS_MP;?></span>
			</div>
		</div>
		<?php if($boset['rrp'] > 0) { ?>
			<div class="col-sm-7">
				<label class="control-label sp-label text-muted">
					열람시 <?php echo AS_MP;?>의 <?php echo $boset['rrp'];?>%가 등록자에게 적립됩니다.
				</label>
			</div>
		<?php } ?>
		<?php if($boset['nrp'] > 0 || $boset['xrp'] > 0) { ?>
			<div class="col-sm-10 col-sm-offset-2 text-muted" style="padding-top:4px;">
				열람 <?php echo AS_MP;?>는
				<?php if($boset['nrp'] > 0) { ?>
					<?php echo number_format($boset['nrp']);?> 이상
				<?php } ?>
				<?php if($boset['xrp'] > 0) { ?>
					<?php echo number_format($boset['xrp']);?> 이하
				<?php } ?>
				등록할 수 있습니다.	
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label>
		<div class="col-sm-10">
			<input type="text" name="wr_link<?php echo $i ?>" value="<?php echo $write['wr_link'.$i]; ?>" id="wr_link<?php echo $i ?>" class="form-control input-sm" size="50">
			<?php if($i == "1") { ?>
				<div class="text-muted font-12" style="margin-top:4px;">
					유튜브, 비메오 등 동영상 공유주소 등록시 해당 동영상은 본문 자동실행
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
<?php if($is_use_download) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">다운로드</label>
		<div class="col-sm-3">
			<div class="input-group input-group-sm">
				<input type="text" class="form-control input-sm" name="as_down" id="as_down" value="<?php echo $write['as_down'];?>" placeholder="양수입력">
				<span class="input-group-addon"><?php echo AS_MP;?></span>
			</div>
		</div>
		<?php if($boset['rdp'] > 0) { ?>
			<div class="col-sm-7">
				<label class="control-label sp-label text-muted">
					다운로드시 등록 <?php echo AS_MP;?>의 <?php echo $boset['rdp'];?>%가 등록자에게 적립됩니다.
				</label>
			</div>
		<?php } ?>
		<?php if($boset['ndp'] > 0 || $boset['xdp'] > 0) { ?>
			<div class="col-sm-10 col-sm-offset-2 text-muted" style="padding-top:4px;">
				다운로드 <?php echo AS_MP;?>는
				<?php if($boset['ndp'] > 0) { ?>
					<?php echo number_format($boset['ndp']);?> 이상
				<?php } ?>
				<?php if($boset['xdp'] > 0) { ?>
					<?php echo number_format($boset['xdp']);?> 이하
				<?php } ?>
				등록할 수 있습니다.	
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php if($is_use_tag) { ?>
	<div class="form-group">
		<?php if($is_stag) { // 추가태그 - wr_10 필드로 값을 옮김 ?>
			<label class="col-sm-2 control-label" for="wr_10">추가태그</label>
			<div class="col-sm-10">
				<input type="text" name="wr_10" id="wr_10" value="<?php echo $write['wr_10']; ?>" class="form-control input-sm" size="50">
			</div>
		<?php } else { ?>
			<label class="col-sm-2 control-label" for="as_tag">태그</label>
			<div class="col-sm-10">
				<input type="text" name="as_tag" id="as_tag" value="<?php echo $write['as_tag']; ?>" class="form-control input-sm" size="50">
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php if($is_use_poll) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">평가등록</label>
		<div class="col-sm-10">
			<label class="control-label sp-label" onclick="set_poll();">
				<input type="checkbox" name="as_extra" value="2"<?php echo get_checked($write['as_extra'], "2"); ?>>
				설문조사
			</label>
			<div id="po_set" style="display:<?php echo ($write['as_extra'] == "2") ? 'block' : 'none';?>; padding-top:8px;">
				<?php
					include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
					$po = array();
					if($w == 'u' && $write['as_extra']) {
						$po = apms_get_extra($write['as_extra'], $bo_table, $wr_id);
					}
				?>
				<input type="text" name="po_subject" id="po_subject" value="<?php echo $po['po_subject']; ?>" placeholder="설문 제목 입력(미입력시 등록안됨)" class="form-control input-sm">
				
				<div class="h10"></div>

				<textarea name="po_content" id="po_contnet" placeholder="설문 개요/소개/요약글 입력" class="form-control input-sm" style="height:80px;"><?php echo $po['po_content']; ?></textarea> 

				<?php for($k=1; $k <= 9; $k++) { ?>
					<div class="h10"></div>
					<input type="text" name="po_poll<?php echo $k;?>" id="po_poll<?php echo $k;?>" value="<?php echo $po['po_poll'.$k]; ?>" placeholder="설문 항목 <?php echo $k;?> 입력" class="form-control input-sm">
				<?php } ?>

				<div class="h10"></div>

				<div class="control-label input-group input-group-sm">
					<span class="input-group-addon">설문종료일</span>
					<input type="text" name="po_endtime" value="<?php echo ($po['po_end']) ? substr($po['po_endtime'],0,10) : ''; ?>" id="po_endtime" class="form-control input-sm" size="10" maxlength="20">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>	
			</div>
			<script>
				function set_poll() {
					if($('input[name="as_extra"]').is(":checked")) {
						$("#po_set").show();
					} else {
						$("#po_set").hide();
					}
					return true;
				}
				$(function(){
					$("#po_endtime").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true });
				});
			</script>
		</div>
	</div>
<?php } ?>
<?php if ($is_file) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label hidden-xs">첨부파일</label>
		<div class="col-sm-10">
			<p class="form-control-static text-muted" style="padding:0px; padding-top:4px;">
				<span class="cursor" onclick="add_file();"><i class="fa fa-plus-circle fa-lg"></i> 파일추가</span>
				&nbsp;
				<span class="cursor" onclick="del_file();"><i class="fa fa-times-circle fa-lg"></i> 파일삭제</span>
			</p>
		</div>
	</div>
	<div class="form-group" style="margin-bottom:0;">
		<div class="col-sm-10 col-sm-offset-2">
			<table id="variableFiles"></table>
		</div>
	</div>
	<script>
	var flen = 0;
	function add_file(delete_code) {
		var upload_count = <?php echo (int)$board['bo_upload_count']; ?>;
		if (upload_count && flen >= upload_count) {
			alert("이 게시판은 "+upload_count+"개 까지만 파일 업로드가 가능합니다.");
			return;
		}

		var objTbl;
		var objNum;
		var objRow;
		var objCell;
		var objContent;
		if (document.getElementById)
			objTbl = document.getElementById("variableFiles");
		else
			objTbl = document.all["variableFiles"];

		objNum = objTbl.rows.length;
		objRow = objTbl.insertRow(objNum);
		objCell = objRow.insertCell(0);

		objContent = "<div class='row'>";
		objContent += "<div class='col-sm-7'><div class='form-group'><div class='input-group input-group-sm'><span class='input-group-addon'>파일 "+objNum+"</span><input type='file' class='form-control input-sm' name='bf_file[]' title='파일 용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능'></div></div></div>";
		if (delete_code) {
			objContent += delete_code;
		} else {
			<?php if ($is_file_content) { ?>
			objContent += "<div class='col-sm-5'><div class='form-group'><input type='text'name='bf_content[]' class='form-control input-sm' placeholder='이미지에 대한 내용을 입력하세요.'></div></div>";
			<?php } ?>
			;
		}
		objContent += "</div>";

		objCell.innerHTML = objContent;

		flen++;
	}

	<?php echo $file_script; //수정시에 필요한 스크립트?>

	function del_file() {
		// file_length 이하로는 필드가 삭제되지 않아야 합니다.
		var file_length = <?php echo (int)$file_length; ?>;
		var objTbl = document.getElementById("variableFiles");
		if (objTbl.rows.length - 1 > file_length) {
			objTbl.deleteRow(objTbl.rows.length - 1);
			flen--;
		}
	}
	</script>

	<div class="form-group">
		<label class="col-sm-2 control-label">첨부사진</label>
		<div class="col-sm-10">
			<label class="control-label sp-label">
				<input type="radio" name="as_img" value="0"<?php if(!$write['as_img']) echo ' checked';?>> 상단출력
			</label>
			<label class="control-label sp-label">
				<input type="radio" name="as_img" value="1"<?php if($write['as_img'] == "1") echo ' checked';?>> 하단출력
			</label>
			<label class="control-label sp-label">
				<input type="radio" name="as_img" value="2"<?php if($write['as_img'] == "2") echo ' checked';?>> 본문삽입
			</label>
			<div class="text-muted font-12" style="margin-top:4px;">
				본문삽입시 {이미지:0}, {이미지:1} 형태로 글내용 입력시 지정 첨부사진이 출력됨
			</div>
		</div>
	</div>
<?php } ?>

<?php if ($captcha_html) { //자동등록방지  ?>
	<div class="well well-sm text-center">
		<?php echo $captcha_html; ?>
	</div>
<?php } ?>

<div class="write-btn pull-center">
	<button type="submit" id="btn_submit" accesskey="s" class="btn btn-<?php echo $btn2;?> btn-sm"><i class="fa fa-check"></i> <b>작성완료</b></button>
	<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn btn-<?php echo $btn1;?> btn-sm" role="button">취소</a>
</div>

<div class="clearfix"></div>

</form>

<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
	$("#wr_content").on("keyup", function() {
		check_byte("wr_content", "char_count");
	});
});
<?php } ?>

function apms_myicon() {
	document.getElementById("picon").value = '';
	document.getElementById("ticon").innerHTML = '<?php echo str_replace("'","\"", $myicon);?>';
	return true;
}

function html_auto_br(obj) {
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "html2";
		else
			obj.value = "html1";
	}
	else
		obj.value = "";
}

function fwrite_submit(f) {

	<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.wr_subject.value,
			"content": f.wr_content.value
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			subject = data.subject;
			content = data.content;
		}
	});

	if (subject) {
		alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
		f.wr_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_wr_content) != "undefined")
			ed_wr_content.returnFalse();
		else
			f.wr_content.focus();
		return false;
	}

	if (document.getElementById("char_count")) {
		if (char_min > 0 || char_max > 0) {
			var cnt = parseInt(check_byte("wr_content", "char_count"));
			if (char_min > 0 && char_min > cnt) {
				alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
				return false;
			}
			else if (char_max > 0 && char_max < cnt) {
				alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
				return false;
			}
		}
	}

	<?php if($is_stag) { //태그분류 ?>
	var chk_cnt = 0;
	var stag = '';

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "stag[]" && f.elements[i].checked) {
			chk_cnt++;
			if(chk_cnt == "1") {
				stag = f.elements[i].value;
			} else {
				stag = stag + ',' + f.elements[i].value;
			}
		}
	}
	
	if(chk_cnt > 20) {
		alert("태그는 최대 20개까지 선택할 수 있습니다.");
		return false;
	<?php if(!$is_admin) { // 관리자가 아니면 필수 ?>
	} else if (chk_cnt == 0) {
		alert("최소 1개의 태그는 선택하셔야 합니다.");
		return false;
	<?php } ?>
	} else {
		$("#as_tag").val(stag);
	}
	<?php } ?>

	<?php if(!$is_admin && $is_use_reading) { ?>
		var rpoint = f.as_view.value;

		if(rpoint == "" || rpoint >= 0) {
			;
		} else {
			alert("양수만 등록할 수 있습니다.");
			f.as_view.focus();
			return false;
		}
		<?php if($boset['nrp'] > 0) { ?>
			if(rpoint < <?php echo $boset['nrp'];?>) {
				alert("<?php echo $boset['nrp'].AS_MP;?> 이상 등록하셔야 합니다.");
				f.as_view.focus();
				return false;
			}
		<?php } ?>
		<?php if($boset['xrp'] > 0) { ?>
			if(rpoint > <?php echo $boset['xrp'];?>) {
				alert("<?php echo $boset['xrp'].AS_MP;?> 이하로만 등록할 수 있습니다.");
				f.as_view.focus();
				return false;
			}
		<?php } ?>
	<?php } ?>

	<?php if(!$is_admin && $is_use_download) { ?>
		var dpoint = f.as_down.value;

		if(dpoint == "" || dpoint >= 0) {
			;
		} else {
			alert("양수만 등록할 수 있습니다.");
			f.as_down.focus();
			return false;
		}
		<?php if($boset['ndp'] > 0) { ?>
			if(dpoint < <?php echo $boset['ndp'];?>) {
				alert("<?php echo $boset['ndp'].AS_MP;?> 이상 등록하셔야 합니다.");
				f.as_down.focus();
				return false;
			}
		<?php } ?>
		<?php if($boset['xdp'] > 0) { ?>
			if(dpoint > <?php echo $boset['xdp'];?>) {
				alert("<?php echo $boset['xdp'].AS_MP;?> 이하로만 등록할 수 있습니다.");
				f.as_down.focus();
				return false;
			}
		<?php } ?>
	<?php } ?>

	<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}

$(function(){
	$("#wr_content").addClass("form-control input-sm write-content");
});
</script>

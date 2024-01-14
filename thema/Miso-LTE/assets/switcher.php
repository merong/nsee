<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_ADMIN_PATH.'/apms_admin/apms.admin.lib.php');

// 설정토글
$toggle = 0;

// 테마스킨
$tmain = apms_file_list('thema/'.THEMA.'/main', 'php');
$tside = apms_file_list('thema/'.THEMA.'/side', 'php');
?>
<aside class="<?php echo $at_set['font'];?>">
	<script>
		var sw_url = "<?php echo THEMA_URL;?>";
		var sw_bgcolor = "<?php echo $at_set['body_bgcolor'];?>";
	</script>
	<link rel="stylesheet" href="<?php echo THEMA_URL;?>/assets/css/switcher.css">
	<link rel="stylesheet" href="<?php echo THEMA_URL;?>/assets/css/spectrum.css">
	<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/switcher.js"></script>
	<script type="text/javascript" src="<?php echo THEMA_URL;?>/assets/js/spectrum.js"></script>
	<section id="style-switcher" class="font-12 ko-12">
		<!--
		<div class="cursor switcher-icon layout-setup" title="테마설정">
			<i class="fa fa-desktop"></i>
		</div>
		<div class="cursor switcher-icon widget-setup" title="위젯설정">
			<i class="fa fa-cogs"></i>
		</div>
		-->
		<div class="switcher-wrap">
			<div class="switcher-title layout-setup cursor en">
				Style Switcher
				&nbsp;
				<i class="fa fa-arrow-circle-right"></i>
			</div>
			<div class="switcher-content">
				<?php if($is_demo) { ?>
					<form id="themaSwitcher" name="themaSwitcher" method="post" class="form">
					<input type="hidden" name="dpv" value="1" id="dvp">
				<?php } else { ?>
					<form id="themaSwitcher" name="themaSwitcher" action="<?php echo $at_href['switcher_submit'];?>" method="post" onsubmit="return switcher_submit(this);" class="form">
					<input type="hidden" name="sw_type" value="<?php echo $sw_type;?>">
					<input type="hidden" name="sw_code" value="<?php echo $sw_code;?>">
					<input type="hidden" name="sw_thema" value="<?php echo THEMA;?>">
					<input type="hidden" name="url" value="<?php echo urldecode($urlencode);?>">
				<?php } ?>
				<input type="hidden" name="at_set[thema]" value="<?php echo THEMA;?>">

				<div class="panel-group" id="switcherSet" role="tablist" aria-multiselectable="true">
					<div class="panel">
						<div class="panel-heading" role="tab" id="swHead<?php $toggle++; echo $toggle;?>" aria-expanded="true" aria-controls="swSet<?php echo $toggle;?>">
							<a data-toggle="collapse" data-parent="#switcherSet" href="#swSet<?php echo $toggle;?>">
								<i class="fa fa-caret-right"></i> 컬러셋 설정
							</a>
						</div>
						<div id="swSet<?php echo $toggle;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="swHead<?php echo $toggle;?>">
							<div class="panel-body">
								<div class="text-muted ko-11 font-11" style="margin-bottom:2px;">
									테마 내 /colorset 폴더
								</div>
								<select id="colorset-style" name="<?php echo ($is_demo) ? 'pvc' : 'colorset';?>" class="form-control input-sm input-bottom">
									<?php //Colorset
										$srow = thema_switcher('thema', 'colorset', COLORSET);
										for($i=0; $i < count($srow); $i++) {
									?>
										 <option value="<?php echo $srow[$i]['value'];?>"<?php echo ($srow[$i]['selected']) ? ' selected' : '';?>>
											<?php echo $srow[$i]['name'];?>
										</option>
									<?php } ?>
								</select>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">컬러</span>
									<select id="color-skin" name="at_set[color]" class="form-control input-sm">
										<?php $sets = array('skin-blue', 'skin-blue-light', 'skin-black', 'skin-black-light', 'skin-white', 'skin-white-light', 'skin-green', 'skin-green-light', 'skin-red', 'skin-red-light', 'skin-yellow', 'skin-yellow-light', 'skin-purple', 'skin-purple-light'); ?>	
										<?php for($i=0; $i < count($sets); $i++) { ?>
											<option value="<?php echo $sets[$i];?>"<?php echo get_selected($sets[$i], $at_set['color']);?>>
												<?php echo ucfirst(str_replace('skin-', '', $sets[$i]));?>
											</option>
										<?php } ?>
									</select>
								</div>

								<label>
									<input type="checkbox" id="sidebar-color" name="at_set[scolor]" value="1"<?php echo get_checked('1', $at_set['scolor']);?>>
									우측 밝은 사이드바 적용
								</label>
								<label>
									<input type="checkbox" id="font-style" name="at_set[font]" value="en"<?php echo get_checked('en', $at_set['font']);?>>
									영문폰트 적용
								</label>

							</div>
						</div>
					</div>

					<div class="panel">
						<div class="panel-heading" role="tab" id="swHead<?php $toggle++; echo $toggle;?>" aria-expanded="true" aria-controls="swSet<?php echo $toggle;?>">
							<a data-toggle="collapse" data-parent="#switcherSet" href="#swSet<?php echo $toggle;?>">
								<i class="fa fa-caret-right"></i> 스타일 설정
							</a>
						</div>
						<div id="swSet<?php echo $toggle;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="swHead<?php echo $toggle;?>">
							<div class="panel-body">

								<select id="pc-style" name="at_set[pc]" class="form-control input-sm input-bottom">
									<option value="">반응형 PC 스타일</option>
									<option value="1"<?php echo get_selected('1', $at_set['pc']);?>>비반응형 PC 스타일</option>
								</select>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">상단메뉴</span>
									<select id="font-style" name="at_set[mfont]" class="form-control input-sm">
										<option value="12"<?php echo get_selected('12', $at_set['mfont']);?>>12px</option>
										<option value="13"<?php echo get_selected('13', $at_set['mfont']);?>>13px</option>
										<option value="14"<?php echo get_selected('14', $at_set['mfont']);?>>14px</option>
										<option value="15"<?php echo get_selected('15', $at_set['mfont']);?>>15px</option>
									</select>
								</div>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">상단서브</span>
									<input type="text" class="form-control input-sm" name="at_set[subw]" value="<?php echo $at_set['subw'];?>" placeholder="180">
									<span class="input-group-addon">px</span>
								</div>

								<div class="input-group input-group-sm input-bottom" data-original-title="<nobr>박스형 전체너비</nobr>" data-toggle="tooltip" data-placement="top" data-html="true">
									<span class="input-group-addon">전체너비</span>
									<input type="text" class="form-control input-sm" name="at_set[cw]" value="<?php echo $at_set['cw'];?>" placeholder="1250">
									<span class="input-group-addon">px</span>
								</div>

								<div class="input-group input-group-sm input-bottom" data-original-title="<nobr>박스형 좌우여백</nobr>" data-toggle="tooltip" data-placement="top" data-html="true">
									<span class="input-group-addon">좌우여백</span>
									<input type="text" class="form-control input-sm" name="at_set[gap]" value="<?php echo $at_set['gap'];?>" placeholder="0">
									<span class="input-group-addon">px</span>
								</div>

								<input type="hidden" id="input-body-background" name="at_set[background]" value="<?php echo $at_set['background'];?>">
								<div style="margin-bottom:8px;">
									<a role="button" class="switcher-win btn btn-black btn-sm btn-block" target="_balnk" href="<?php echo $at_href['switcher'];?>&amp;type=html&amp;fid=input-body-background&amp;cid=body-background">
										<i class="fa fa-picture-o"></i> 배경이미지 선택
									</a>
								</div>
								<div class="pull-left">
									<input type="text" class="body-bgcolor" name="at_set[bgcolor]" value="<?php echo $at_set['bgcolor'];?>">
								</div>
								<div class="pull-left" style="margin-top:8px;">
									&nbsp; 배경색
								</div>
								<div class="clearfix"></div>

								<div class="text-muted ko-11 font-11" style="margin-top:8px;">
									배경은 고정 레이아웃이 아닌 PC의 박스형 레이아웃에서만 적용됨
								</div>

							</div>
						</div>
					</div>

					<div class="panel">
						<div class="panel-heading" role="tab" id="swHead<?php $toggle++; echo $toggle;?>" aria-expanded="true" aria-controls="swSet<?php echo $toggle;?>">
							<a data-toggle="collapse" data-parent="#switcherSet" href="#swSet<?php echo $toggle;?>">
								<i class="fa fa-caret-right"></i> 인덱스 설정
							</a>
						</div>
						<div id="swSet<?php echo $toggle;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="swHead<?php echo $toggle;?>">
							<div class="panel-body">
								<div class="text-muted ko-11" style="margin-bottom:2px;">
									테마 내 /main 폴더의 파일
								</div>
								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">메인영역</span>
									<select name="at_set[mfile]" class="form-control input-sm">
										<?php for ($i=0; $i<count($tmain); $i++) { ?>
											<option value="<?php echo $tmain[$i];?>"<?php echo get_selected($at_set['mfile'], $tmain[$i]);?>><?php echo $tmain[$i];?></option>
										<?php } ?>
									</select>
								</div>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">위치설정</span>
									<select id="content-style" name="at_set[content]" class="form-control input-sm">
										<option value="left"<?php echo get_selected('left', $at_set['content']);?>>좌측위치</option>
										<option value="center"<?php echo get_selected('center', $at_set['content']);?>>중앙위치</option>
										<option value="wide"<?php echo get_selected('wide', $at_set['content']);?>>와이드</option>
									</select>
								</div>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">배경설정</span>
									<select id="content-bg" name="at_set[content_bg]" class="form-control input-sm">
										<option value="content-white"<?php echo get_selected('content-white', $at_set['content_bg']);?>>흰색배경</option>
										<option value="content-boxed"<?php echo get_selected('content-boxed', $at_set['content_bg']);?>>박스배경</option>
										<option value="content-light"<?php echo get_selected('content-light', $at_set['content_bg']);?>>회색배경</option>
									</select>
								</div>

								<div class="text-muted ko-11">
									위치와 배경은 메인파일에 따라 적용여부가 다름
								</div>

							</div>
						</div>
					</div>

					<div class="panel">
						<div class="panel-heading" role="tab" id="swHead<?php $toggle++; echo $toggle;?>" aria-expanded="true" aria-controls="swSet<?php echo $toggle;?>">
							<a data-toggle="collapse" data-parent="#switcherSet" href="#swSet<?php echo $toggle;?>">
								<i class="fa fa-caret-right"></i> 인덱스 레이아웃
							</a>
						</div>
						<div id="swSet<?php echo $toggle;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="swHead<?php echo $toggle;?>">
							<div class="panel-body">

								<select id="layout-style" name="at_set[layout]" class="form-control input-sm input-bottom">
									<option value="">와이드</option>
									<option value="layout-boxed"<?php echo get_selected('layout-boxed', $at_set['layout']);?>>중앙박스</option>
									<option value="layout-boxed left"<?php echo get_selected('layout-boxed left', $at_set['layout']);?>>좌측박스</option>
									<option value="layout-boxed right"<?php echo get_selected('layout-boxed right', $at_set['layout']);?>>우측박스</option>
								</select>

								<label>
									<input type="checkbox" id="fixed-layout" name="at_set[fixed]" value="1"<?php echo get_checked('1', $at_set['fixed']);?>>
									고정 레이아웃
								</label>
								<label>
									<input type="checkbox" id="closed-sidebar" name="at_set[closed]" value="1"<?php echo get_checked('1', $at_set['closed']);?>>
									닫힌 사이드바
								</label>
								<label>
									<input type="checkbox" id="mini-style" name="at_set[mini]" value="1"<?php echo get_checked('1', $at_set['mini']);?>>
									미니 사용안함
								</label>
								<label>
									<input type="checkbox" id="hover-sidebar" name="at_set[hover]" value="1"<?php echo get_checked('1', $at_set['hover']);?>>
									호버 사이드바(저장)
								</label>
								<label>
									<input type="checkbox" id="tm-style" name="at_set[tm]" value="1"<?php echo get_checked('1', $at_set['tm']);?>>
									상단 메뉴네비(저장)
								</label>
								<label>
									<input type="checkbox" id="footer-style" name="at_set[ft]" value="1"<?php echo get_checked('1', $at_set['ft']);?>>
									풋터 중앙정렬
								</label>

								<div class="text-muted ko-11">
									고정은 와이드형 모양과 호버 사이드바로 자동전환
								</div>

							</div>
						</div>
					</div>

					<div class="panel">
						<div class="panel-heading" role="tab" id="swHead<?php $toggle++; echo $toggle;?>" aria-expanded="true" aria-controls="swSet<?php echo $toggle;?>">
							<a data-toggle="collapse" data-parent="#switcherSet" href="#swSet<?php echo $toggle;?>">
								<i class="fa fa-caret-right"></i> 페이지 설정
							</a>
						</div>
						<div id="swSet<?php echo $toggle;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="swHead<?php echo $toggle;?>">
							<div class="panel-body">
								<div class="text-muted ko-11" style="margin-bottom:2px;">
									테마 내 /side 폴더의 파일
								</div>
								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">좌측영역</span>
									<select name="at_set[ls]" class="form-control input-sm">
										<option value="">사용안함</option>
										<?php for ($i=0; $i<count($tside); $i++) { ?>
											<option value="<?php echo $tside[$i];?>"<?php echo get_selected($at_set['ls'], $tside[$i]);?>><?php echo $tside[$i];?></option>
										<?php } ?>
									</select>
								</div>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">좌측너비</span>
									<input type="text" class="form-control input-sm" name="at_set[lsw]" value="<?php echo $at_set['lsw'];?>" placeholder="260">
									<span class="input-group-addon">px</span>
								</div>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">우측영역</span>
									<select name="at_set[rs]" class="form-control input-sm">
										<option value="">사용안함</option>
										<?php for ($i=0; $i<count($tside); $i++) { ?>
											<option value="<?php echo $tside[$i];?>"<?php echo get_selected($at_set['rs'], $tside[$i]);?>><?php echo $tside[$i];?></option>
										<?php } ?>
									</select>
								</div>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">우측너비</span>
									<input type="text" class="form-control input-sm" name="at_set[rsw]" value="<?php echo $at_set['rsw'];?>" placeholder="260">
									<span class="input-group-addon">px</span>
								</div>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">좌우간격</span>
									<input type="text" class="form-control input-sm" name="at_set[lrg]" value="<?php echo $at_set['lrg'];?>" placeholder="15">
									<span class="input-group-addon">px</span>
								</div>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">위치설정</span>
									<select id="pcontent-style" name="at_set[pcontent]" class="form-control input-sm">
										<option value="left"<?php echo get_selected('left', $at_set['pcontent']);?>>좌측위치</option>
										<option value="center"<?php echo get_selected('center', $at_set['pcontent']);?>>중앙위치</option>
										<option value="wide"<?php echo get_selected('wide', $at_set['pcontent']);?>>와이드</option>
									</select>
								</div>

								<div class="input-group input-group-sm input-bottom">
									<span class="input-group-addon">배경설정</span>
									<select id="pcontent-bg" name="at_set[pcontent_bg]" class="form-control input-sm">
										<option value="content-white"<?php echo get_selected('content-white', $at_set['pcontent_bg']);?>>흰색배경</option>
										<option value="content-boxed"<?php echo get_selected('content-boxed', $at_set['pcontent_bg']);?>>박스배경</option>
										<option value="content-light"<?php echo get_selected('content-light', $at_set['pcontent_bg']);?>>회색배경</option>
									</select>
								</div>

							</div>
						</div>
					</div>

					<div class="panel">
						<div class="panel-heading" role="tab" id="swHead<?php $toggle++; echo $toggle;?>" aria-expanded="true" aria-controls="swSet<?php echo $toggle;?>">
							<a data-toggle="collapse" data-parent="#switcherSet" href="#swSet<?php echo $toggle;?>">
								<i class="fa fa-caret-right"></i> 페이지 레이아웃
							</a>
						</div>
						<div id="swSet<?php echo $toggle;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="swHead<?php echo $toggle;?>">
							<div class="panel-body">

								<select id="playout-style" name="at_set[playout]" class="form-control input-sm input-bottom">
									<option value="">와이드</option>
									<option value="layout-boxed"<?php echo get_selected('layout-boxed', $at_set['playout']);?>>중앙박스</option>
									<option value="layout-boxed left"<?php echo get_selected('layout-boxed left', $at_set['playout']);?>>좌측박스</option>
									<option value="layout-boxed right"<?php echo get_selected('layout-boxed right', $at_set['playout']);?>>우측박스</option>
								</select>

								<label>
									<input type="checkbox" id="pfixed-layout" name="at_set[pfixed]" value="1"<?php echo get_checked('1', $at_set['pfixed']);?>>
									고정 레이아웃
								</label>
								<label>
									<input type="checkbox" id="pclosed-sidebar" name="at_set[pclosed]" value="1"<?php echo get_checked('1', $at_set['pclosed']);?>>
									닫힌 사이드바
								</label>
								<label>
									<input type="checkbox" id="pmini-style" name="at_set[pmini]" value="1"<?php echo get_checked('1', $at_set['pmini']);?>>
									미니 사용안함
								</label>
								<label>
									<input type="checkbox" id="phover-sidebar" name="at_set[phover]" value="1"<?php echo get_checked('1', $at_set['phover']);?>>
									호버 사이드바(저장)
								</label>
								<label>
									<input type="checkbox" id="ptm-style" name="at_set[ptm]" value="1"<?php echo get_checked('1', $at_set['ptm']);?>>
									상단 메뉴네비(저장)
								</label>
								<label>
									<input type="checkbox" id="pfooter-style" name="at_set[pft]" value="1"<?php echo get_checked('1', $at_set['pft']);?>>
									풋터 중앙정렬
								</label>

								<div class="text-muted ko-11">
									고정은 와이드형 모양과 호버 사이드바로 자동전환
								</div>

							</div>
						</div>
					</div>

					<div class="panel">
						<div class="panel-heading" role="tab" id="swHead<?php $toggle++; echo $toggle;?>" aria-expanded="true" aria-controls="swSet<?php echo $toggle;?>">
							<a data-toggle="collapse" data-parent="#switcherSet" href="#swSet<?php echo $toggle;?>">
								<i class="fa fa-caret-right"></i> 실시간 알림
							</a>
						</div>
						<div id="swSet<?php echo $toggle;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="swHead<?php echo $toggle;?>">
							<div class="panel-body">

								<div class="input-group input-group-sm">
									<input type="text" class="form-control input-sm" name="at_set[msg]" value="<?php echo $at_set['msg'];?>" placeholder="0">
									<span class="input-group-addon">초 간격 알림</span>
								</div>

							</div>
						</div>
					</div>

				</div>
				<button type="submit" class="btn btn-color btn-sm btn-block">
					<i class="fa fa-check"></i> <?php echo ($is_demo) ? '데모적용' : '저장하기';?>
				</button>
				<?php if($is_demo) { ?>
					<label style="margin:8px 0px 0px;">
						<input type="checkbox" name="reset" value="1">
						데모설정 초기화
					</label>
				<?php } ?>
				</form>
			</div>
			<script>
				function switcher_submit(f) {
					<?php if(!$is_demo) { ?>
					if (!confirm("<?php echo $sw_msg;?>의 설정으로 저장하시겠습니까?")) {
						return false;
					}
					<?php } ?>
					return true;
				}
			</script>
		</div>
	</section>
</aside>


<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css" media="screen">', 0);

//점프 버튼 - 자기글만 체크
$is_jump_btn = ($is_jump && $view['mb_id'] && $view['mb_id'] == $member['mb_id']) ? true : false;

// 값정리
$boset['video'] = (isset($boset['video']) && $boset['video']) ? $boset['video'] : '';
$boset['view_skin'] = (isset($boset['view_skin']) && $boset['view_skin']) ? $boset['view_skin'] : 'basic';
$view_skin_url = $board_skin_url.'/view/'.$boset['view_skin'];
$view_skin_path = $board_skin_path.'/view/'.$boset['view_skin'];

// 검색링크
if($is_stag && isset($tag) && $tag && !$search_href) {
	$search_href = './board.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr;
}

// 모달 타켓
$modal_target = (APMS_PIM) ? ' target="_parent"' : '';
$modal_query = (APMS_PIM) ? '&amp;pim=1' : '';

// 다운포인트
$is_downpoint = (isset($boset['udp']) && $boset['udp']) ? true : false;
$is_downterm = (isset($boset['dterm']) && $boset['dterm'] > 0) ? $boset['dterm'] : 0;

if($is_downpoint) {
	$dpoint = $write['as_down'];
	$dpoint = ($dpoint > 0) ? $dpoint = $dpoint * (-1) : 0;
	$board['bo_download_point'] = ($dpoint < 0) ? $dpoint : $board['bo_download_point'];
}

// 다운로드 유지 체크
$is_download_js = false;
$is_download_free = 0;
if ($member['mb_id'] && $board['bo_download_point'] < 0) {
	if($is_admin) { // 관리자
		$is_download_free = 1;
	} else {
		$sql_term = ($is_downterm) ? apms_sql_term($is_downterm, 'po_datetime') : ''; // 기간(일수,today,yesterday,month,prev)
		$row = sql_fetch(" select po_datetime from {$g5['point_table']} where mb_id = '{$member['mb_id']}' and po_point < 0 and po_rel_table = '$bo_table' and po_rel_id = '$wr_id' and po_rel_action = '다운로드' $sql_term order by po_datetime desc");
		if($row['po_datetime']) {
			$is_download_free = ($is_downterm) ? date("Y년 m월 d일 H시 i분", (strtotime($row['po_datetime']) + ($is_downterm * 86400))) : 1;
		} else {
			$is_download_js = true;
		}
	}
}

// 아이콘
$view['photo'] = ($view['photo']) ? '<img src="'.$view['photo'].'" alt="'.$view['wr_name'].'">' : '';
if($view['as_icon']) {
	$view_icon = apms_fa(apms_emo($view['as_icon']));
	$view['photo'] = ($view_icon) ? $view_icon : $view['photo'];
}
?>
<?php if($boset['video'] || $view['photo']) { ?>
<style>
<?php if($view['photo']) { ?>
	.view-wrap h1 .talker-photo i { <?php echo (isset($boset['ibg']) && $boset['ibg']) ? 'background:'.apms_color($boset['icolor']).'; color:#fff' : 'color:'.apms_color($boset['icolor']);?>; }
<?php } ?>
<?php if($boset['video']) { ?>
	.view-wrap .apms-autowrap { max-width:<?php echo (G5_IS_MOBILE) ? '100%' : $boset['video'];?> !important; }
<?php } ?>
</style>
<?php } ?>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<div class="view-wrap<?php echo (G5_IS_MOBILE) ? ' view-mobile font-14' : '';?><?php echo (APMS_PIM) ? ' view-modal' : '';?>">

	<?php 
		// 내용스킨
		if(is_file($view_skin_path.'/view.skin.php')) {
			include_once($view_skin_path.'/view.skin.php');
		} else {
			echo '<div class="well text-center"><i class="fa fa-bell red"></i> 설정하신 내용스킨('.$boset['view_skin'].')이 존재하지 않습니다.</div>';
		}
	?>

	<div class="clearfix"></div>

	<div class="view-btn text-right">
		<div class="btn-group" role="group">
			<?php if ($prev_href) { ?>
				<a role="button" href="<?php echo $prev_href.$modal_query; ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="이전글">
					<i class="fa fa-chevron-circle-left"></i><span class="hidden-xs"> 이전</span>
				</a>
			<?php } ?>
			<?php if ($next_href) { ?>
				<a role="button" href="<?php echo $next_href.$modal_query; ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="다음글">
					<i class="fa fa-chevron-circle-right"></i><span class="hidden-xs"> 다음</span>
				</a>
			<?php } ?>
			<?php if ($copy_href) { ?>
				<a role="button" href="<?php echo $copy_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" onclick="board_move(this.href); return false;" title="복사">
					<i class="fa fa-clipboard"></i><span class="hidden-xs"> 복사</span>
				</a>
			<?php } ?>
			<?php if ($move_href) { ?>
				<a role="button" href="<?php echo $move_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" onclick="board_move(this.href); return false;" title="이동">
					<i class="fa fa-share"></i><span class="hidden-xs"> 이동</span>
				</a>
			<?php } ?>
			<?php if ($delete_href) { ?>
				<a role="button" href="<?php echo $delete_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="삭제" onclick="<?php echo (APMS_PIM) ? 'modal_' : '';?>del(this.href); return false;">
					<i class="fa fa-times"></i><span class="hidden-xs"> 삭제</span>
				</a>
			<?php } ?>
			<?php if ($update_href) { ?>
				<a role="button" href="<?php echo $update_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="수정"<?php echo $modal_target;?>>
					<i class="fa fa-plus"></i><span class="hidden-xs"> 수정</span>
				</a>
			<?php } ?>
			<?php if (!APMS_PIM) { // 모달에서는 출력안함 ?>
				<?php if ($search_href) { ?>
					<a role="button" href="<?php echo $search_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm">
						<i class="fa fa-search"></i><span class="hidden-xs"> 검색</span>
					</a>
				<?php } ?>
				<a role="button" href="<?php echo $list_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm">
					<i class="fa fa-bars"></i><span class="hidden-xs"> 목록</span>
				</a>
			<?php } ?>
			<?php if ($reply_href) { ?>
				<a role="button" href="<?php echo $reply_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm"<?php echo $modal_target;?>>
					<i class="fa fa-commenting"></i><span class="hidden-xs"> 답변</span>
				</a>
			<?php } ?>
			<?php if ($write_href) { ?>
				<a role="button" href="<?php echo $write_href ?>" class="btn btn-<?php echo $btn2;?> btn-sm"<?php echo $modal_target;?>>
					<i class="fa fa-pencil"></i><span class="hidden-xs"> 글쓰기</span>
				</a>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<script>
<?php if(APMS_PIM) { ?>
function modal_del(href) {
	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
		var iev = -1;
		if (navigator.appName == 'Microsoft Internet Explorer') {
			var ua = navigator.userAgent;
			var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
			if (re.exec(ua) != null)
				iev = parseFloat(RegExp.$1);
		}

		// IE6 이하에서 한글깨짐 방지
		if (iev != -1 && iev < 7) {
			parent.document.location.href = encodeURI(href);
		} else {
			parent.document.location.href = href;
		}
	}
}
<?php } ?>
function board_move(href){
	window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
<?php if(!$is_reading) { ?>
function apms_reading(bo_table, wr_id) {

	var href = '<?php echo $board_skin_url;?>/reading.php?bo_table=' + bo_table + '&wr_id=' + wr_id;

	if (confirm("열람하시겠습니까?")) {
		$.post(href, { js: "on" }, function(data) {
			if(data.msg) {
				alert(data.msg);
				return false;
			} else {
				location.reload(true);
			}
		}, "json");
	}
}
<?php } ?>
$(function() {
	$(".view-content a").each(function () {
		$(this).attr("target", "_blank");
    }); 

	$("a.view_image").click(function() {
		window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
		return false;
	});
	<?php if ($board['bo_download_point'] < 0) { ?>
	$("a.view_file_download").click(function() {
		if(!g5_is_member) {
			alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
			return false;
		}
		<?php if($is_download_js) { 
			$download_msg = ($is_downterm) ? number_format($is_downterm).'일 동안은 다시 다운로드 하셔도 중복 차감되지 않습니다.' : '한번만 차감되며 다시 다운로드 하셔도 중복 차감되지 않습니다.'; 
		?> 
		var msg = "파일을 다운로드 하시면 <?php echo AS_MP;?>가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n<?php echo $download_msg;?>\n\n그래도 다운로드 하시겠습니까?";

		if(confirm(msg)) {
			var href = $(this).attr("href")+"&js=on";
			$(this).attr("href", href);
			return true;
		} else {
			return false;
		}
		<?php } else { ?>
		var href = $(this).attr("href")+"&js=on";
		$(this).attr("href", href);
		return true;
		<?php } ?>
	});
	<?php } ?>
});
</script>

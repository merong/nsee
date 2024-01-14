<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
?>

<style>
	.page-content { line-height:22px; word-break: keep-all; word-wrap: break-word; }
	.page-content .article-title { color:#0083B9; font-weight:bold; padding-top:30px; padding-bottom:10px; }
	.page-content ul { list-style:none; padding:0px; margin:0px; font-weight:normal; }
	.page-content ol { margin-top:0px; margin-bottom:15px; }
	.page-content p { margin:0 0 15px; padding:0; }
	.page-content table { border-top:2px solid #999; border-bottom:1px solid #ddd; }
	.page-content th, 
	.page-content td { line-height:1.6 !important; }
	.page-content table.tbl-center th,
	.page-content table.tbl-center td,
	.page-content th.text-center, 
	.page-content td.text-center { text-align:center !important; }
</style>
<div class="page-content">

	<?php if(!$header_skin) { // 헤더 미사용시 출력 ?>
		<div class="text-center" style="margin:15px 0px;">
			<h3 class="div-title-underline-bold border-color">
				사이트 이용안내
			</h3>
		</div>
	<?php } ?>

	<div class="article-title" style="padding-top:0px;">1. 사이트 이용시 주의사항</div>

	<p>본 사이트 이용시 기본적으로 아래 5가지 사항은 반드시 지켜주세요.</p>

	<ol>
		<li>출석체크글 또는 댓글, 반말, 자음,욕설, 정치색을띈글,미성년자 언급 금지 
		<li>남녀불문 이성에게 만남을 요구하는 쪽지(1000포인트)및 모든글작성 금지
		<li>자유게시판내에 정답이 있는(품번, 배우명) 질문하지 않기
		<li>본인의 여자친구및 지인사진을 올리시 얼굴을 지우고 올리기 
		<li>리벤지포르노 관련 모든 내용 (링크, 사진 등) 금지
	</ol>

	<p>
		해당되는 게시물은 발견 즉시 차단되며, 해당 게시물을 작성한 회원은 불량회원이 되어 일정기간 접속이 차단되며,	욕설이나 광고글 등 분위기를 어지럽히는 글작성으로 차된되거나 불량회원이 되시면 직접 탈퇴하는 것이 불가능하니 주의해 주시길 바랍니다.
	</p>

  	<div class="article-title">2. 회원등급 제도 안내</div>

	<p>본 사이트는 회원등급에 따라 이용하실 수 있는 서비스에 차이가 발생할 수 있습니다.</p>

	<div class="table-responsive">
		<table class="table">
		<colgroup>
			<col width="120">
			<col width="120">
		</colgroup>
		<tr class="active">
			<th class="text-center">회원등급</th>
			<th class="text-center">등급명</th>
			<th class="text-center">설명</th>
			<th class="text-center">비고</th>
		</tr>
		<tr>
			<th class="text-center">Ⅰ</th>
			<td class="text-center"><?php echo $xp['xp_grade1'];?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th class="text-center">Ⅱ</th>
			<td class="text-center"><?php echo $xp['xp_grade2'];?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th class="text-center">Ⅲ</th>
			<td class="text-center"><?php echo $xp['xp_grade3'];?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th class="text-center">Ⅳ</th>
			<td class="text-center"><?php echo $xp['xp_grade4'];?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th class="text-center">Ⅴ</th>
			<td class="text-center"><?php echo $xp['xp_grade5'];?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th class="text-center">Ⅵ</th>
			<td class="text-center"><?php echo $xp['xp_grade6'];?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th class="text-center">Ⅶ</th>
			<td class="text-center"><?php echo $xp['xp_grade7'];?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th class="text-center">Ⅷ</th>
			<td class="text-center"><?php echo $xp['xp_grade8'];?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th class="text-center">Ⅸ</th>
			<td class="text-center"><?php echo $xp['xp_grade9'];?></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th class="text-center">Ⅹ</th>
			<td class="text-center"><?php echo $xp['xp_grade10'];?></td>
			<td></td>
			<td></td>
		</tr>
		</table>
	</div>

  	<div class="article-title">3. 포인트 제도 안내</div>

	<p>본 사이트는 사이트 활성화와 다양한 혜택을 서비스하기 위해 포인트 제도를 운영하고 있습니다.</p>

	<ol>
		<li> 포인트 정책은 수시로 변경될 수 있으며, 이를 별도로 통보하지 않습니다.
		<li> 포인트 획득을 위한 도배 및 어뷰징 등의 행위자는 통보없이 "포인트 몰수" 또는 "회원정지" 또는 "사이트 접근차단" 등의 조치를 받을 수 있습니다.
		<li> 적립된 포인트는 사이트내 서비스를 이용하는 목적 이외의 어떠한 효력도 갖고 있지 않습니다.
		<li> 회원가입시 <b><?php echo number_format($config['cf_register_point']);?></b> 포인트 적립(1회), 로그인시  <b><?php echo number_format($config['cf_login_point']);?></b> 포인트 적립(매일), 쪽지발송시 <b><?php echo number_format($config['cf_memo_send_point']);?></b> 포인트 차감(매회)
	</ol>

	<div class="table-responsive">
		<table class="table">
		<tr class="active">
			<th class="text-center">그룹명</th>
			<th class="text-center">보드명</th>
			<th class="text-center">읽기</th>
			<th class="text-center">쓰기</th>
			<th class="text-center">댓글</th>
			<th class="text-center">다운</th>
		</tr>
		<?php
			$result = sql_query(" select gr_id, gr_subject from {$g5['group_table']} where gr_order = '' or gr_order >= '0' order by gr_order ", false);
			for ($i=0; $row=sql_fetch_array($result); $i++) {
				$result1 = sql_query("select bo_table, bo_subject, bo_read_point, bo_write_point, bo_comment_point, bo_download_point from {$g5['board_table']} where gr_id = '{$row['gr_id']}' order by as_order ", false);
				$rowspan = sql_num_rows($result1);

				if(!$rowspan) continue; // 게시판이 없으면 통과

				for ($j=0; $row1=sql_fetch_array($result1); $j++) {

					$href = G5_BBS_URL.'/board.php?bo_table='.$row1['bo_table'];
					$read_point = $row1['bo_read_point'] ? number_format($row1['bo_read_point']) : '-';
					$write_point = $row1['bo_write_point'] ? number_format($row1['bo_write_point']) : '-';
					$cmt_point = $row1['bo_comment_point'] ? number_format($row1['bo_comment_point']) : '-';
					$down_point = $row1['bo_download_point'] ? number_format($row1['bo_download_point']) : '-';

				?>
				<tr>
				<?php if($j == 0) { ?>
					<th rowspan="<?php echo $rowspan;?>" class="text-center"><?php echo $row['gr_subject']; ?></th>
				<?php } ?>
				<td><a href="<?php echo $href; ?>"><?php echo $row1['bo_subject']; ?></a></td>
				<td class="text-center"><?php echo $read_point;?></td>
				<td class="text-center"><?php echo $write_point;?></td>
				<td class="text-center"><?php echo $cmt_point;?></td>
				<td class="text-center"><?php echo $down_point;?></td>
				</tr>
			<?php } ?>
		<?php } ?>
		</table>
	</div>

  	<div class="article-title">4. 레벨별 경험치 안내</div>

	<p>본 사이트에서는 회원등급과 별도로 회원레벨이 적용되며, 각 레벨별 경험치는 다음과 같습니다.</p>

	<?php
		//Exp
		$xp_point = $xp['xp_point'];
		$xp_max = $xp['xp_max'];
		$xp_rate = $xp['xp_rate'];
	?>

	<div class="table-responsive">
		<table class="table tbl-center">
		<tr class="active">
			<th>레벨</th>
			<th>최소 경험치</th>
			<th>최대 경험치</th>
			<th>레벨업 경험치</th>
			<th>비고</th>
		</tr>
		<tr>
			<th><?php echo xp_icon('@member', 1);?></th>
			<td>0</td>
			<td><?php echo number_format($xp_point);?></td>
			<td><?php echo number_format($xp_point);?></td>
			<td></td>
		</tr>
		<?php
			$min_xp = $xp_point;
			for ($i=2; $i <= $xp_max; $i++) {
				$xp_plus = $xp_point + $xp_point * ($i - 1) * $xp_rate;
				$max_xp = $min_xp + $xp_plus;
		?>
			<tr>
				<th><?php echo xp_icon('@member', $i);?></th>
				<td><?php echo number_format($min_xp);?></td>
				<td><?php echo number_format($max_xp);?></td>
				<td><?php echo number_format($xp_plus);?></td>
				<td></td>
			</tr>
			<?php $min_xp = $max_xp; } ?>
			<tr class="bg-light">
				<th><?php echo xp_icon('@admin', 0);?></th>
				<td>관리자</td>
				<td>-</td>
				<td>-</td>
				<td></td>
			</tr>
			<tr class="bg-light">
				<th><?php echo xp_icon('@special', 0);?></th>
				<td>스페셜</td>
				<td>-</td>
				<td>-</td>
				<td></td>
			</tr>
			<tr class="bg-light">
				<th><?php echo xp_icon('', 0);?></th>
				<td>비회원</td>
				<td>-</td>
				<td>-</td>
				<td></td>
			</tr>
		</table>
	</div>
  	

</div>

<div class="h30"></div>

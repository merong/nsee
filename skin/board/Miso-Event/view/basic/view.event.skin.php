<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="myEventModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							Event Info
						</h3>
					</div>
					<div class="panel-body">
						<?php if($is_guest) { // 비회원 ?>

							<div class="text-muted text-center">로그인해 주세요.</div>

						<?php } else if($ev['status'] == '시작전') { // 시작전 ?>

							<div class="text-muted text-center">이벤트 시작전입니다.</div>

						<?php } else if($ev['status'] == '종료') { // 종료 ?>
							<?php if($ev['type'] != "2") { //별도선정이 아니면 ?>
								<div class="text-center">
									<?php echo ($own[0]['is_win']) ? '<b>축하합니다. 당첨되었습니다.</b>' : '미당첨되었습니다.'; ?>
								</div>
							<?php } ?>
						<?php } else if($ev['type']) { // 랜덤 또는 별도선정일 때 ?>

								<?php if($own_cnt > 1) { ?>
									<p class="text-center">이미 참여하셨습니다.</p>
								<?php } else { ?>
									<a role="button" href="<?php echo $board_skin_url;?>/event.php?bo_table=<?php echo $bo_table;?>&amp;wr_id=<?php echo $wr_id;?><?php echo $qstr;?>" class="btn btn-color btn-block">
										<b>참여하기</b>
									</a>
								<?php } ?>

						<?php } else { // 입찰일 때	?>

							<ul style="padding:0px 0px 8px; padding-left:15px;">
								<li><b><?php echo number_format($ev['tender_limit']);?></b> <?php echo AS_MP;?> 이상 입찰 가능
								<li>총 <b><?php echo number_format($ev['tender']);?></b> 회까지 입찰 가능
								<li>현재 <b><?php echo number_format($own_cnt - 1);?></b> 회 입찰
							</ul>

							<?php if($ev['tender'] - $own_cnt < 0) { ?>
								<div class="well" style="margin-bottom:0px;">
									더이상 입찰할 수 없습니다.
								</div>
							<?php } else { ?>
								<form name="fevent" action="<?php echo $board_skin_url;?>/event.php" method="post" role="form" class="form">
									<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
									<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
									<input type="hidden" name="sca" value="<?php echo $sca ?>">
									<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
									<input type="hidden" name="stx" value="<?php echo $stx ?>">
									<input type="hidden" name="spt" value="<?php echo $spt ?>">
									<input type="hidden" name="sst" value="<?php echo $sst ?>">
									<input type="hidden" name="sod" value="<?php echo $sod ?>">
									<input type="hidden" name="page" value="<?php echo $page ?>">
									<div class="form-group">
										<div class="input-group input-group-sm">
											<span class="input-group-addon">입찰</span>
											<input type="text" name="point" value="<?php echo $ev['tender_limit'];?>" required class="form-control input-sm">
											<span class="input-group-addon"><?php echo AS_MP;?></span>
										</div>	
									</div>
									<button type="submit" class="btn btn-color btn-block"><b>입찰하기</b></button>
								</form>
							<?php } ?>
						<?php } ?>
					</div>
					<?php if($is_own && $own_cnt > 1) { ?>
						<ul class="list-group">
							<li class="list-group-item en"><i class="fa fa-gift"></i> <b>입찰내역</b></li>
							<?php for ($i=1; $i < $own_cnt; $i++) { ?>
								<li class="list-group-item font-12<?php echo ($i == $own[0]['is_win']) ? ' red' : '';?>">
									<span class="pull-right font-11"><?php echo $own[$i]['ev_datetime'];?></span>
									<?php echo number_format($own[$i]['ev_point']);?> <?php echo AS_MP;?>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
				</div>

				<p class="text-center">
					<button type="button" class="btn btn-black btn-sm" data-dismiss="modal">닫기</button>
				</p>
			</div>
		</div>
	</div>
</div>

<h1 class="text-center">
	<?php echo get_text($view['wr_subject']); ?>
</h1>

<div class="panel panel-default" style="margin-top:15px;">
	<div class="panel-heading">
		<h3 class="panel-title">
			<span class="pull-right font-14" style="font-weight:normal;">
				<i class="fa fa-users"></i>
				<?php echo ($ev['tender_count']) ? '<b class="blue">'.number_format($ev['tender_count']).'</b>' : 0; //참여수 ?>
				&nbsp; &nbsp;
				<i class="fa fa-comment"></i>
				<?php echo ($view['wr_comment']) ? '<b class="red">'.number_format($view['wr_comment']).'</b>' : 0; //댓글수 ?>
				&nbsp; &nbsp;
				<i class="fa fa-eye"></i>
				<?php echo number_format($view['wr_hit']); //조회수 ?>
			</span>
			<i class="fa fa-gift"></i> Event
		</h3>
	</div>
	<div class="panel-body">

		<div class="row">
			<div class="col-sm-4">
				시작일시 : <?php echo date("Y년 m월 d일 H시 i분", strtotime($ev['start_datetime'])); ?>
			</div>
			<div class="col-sm-4">
				종료일시 : <?php echo date("Y년 m월 d일 H시 i분", strtotime($ev['end_datetime'])); ?>
			</div>
			<div class="col-sm-4">
				남은시간 :
				<b>
				<?php 
					// 이벤트 상태
					switch($ev['status']) {
						case '시작전'	: echo '시작전'; break;
						case '종료'		: echo '<span class="text-muted">종료</span>'; break;
						default			: echo '<span class="red"><span id="end_timer"></span></span>'; break;
					}
				?>
				</b>
			</div>
			<div class="col-sm-4">
				당첨방법 : 
				<?php 
					switch($ev['type']) {
						case '1' : echo '랜덤당첨'; break;
						case '2' : echo '별도선정'; break;
						default	 : echo '최고입찰'; break;
					}
				?>
			</div>
			<?php if($win_point > 0) { ?>
				<div class="col-sm-4">
					당첨점수 : 
					<b class="orangered"><?php echo number_format($win_point);?></b> <?php echo AS_MP;?>
					(<?php echo ($ev['win_pay']) ? '변동' : '고정';?>)
				</div>
				<?php if($ev['win_pay']) { ?>
					<div class="col-sm-4">
						총 참가점수의 1/n 지급<?php echo ($ev['win_fee'] > 0) ? ' ('.$ev['win_fee'].'% 공제)' : ''; ?>
					</div>
				<?php } ?>
			<?php } ?>
			<div class="col-sm-4">
				당첨인원 : 총 <b><?php echo number_format($ev['win']); ?></b> 명
			</div>
			<?php if(!$ev['type']) { ?>
				<div class="col-sm-4">
					입찰점수 : <b><?php echo number_format($ev['tender_limit']); ?></b> <?php echo AS_MP;?> 이상
				</div>
				<?php if(!$ev['show_tender']) { 
					$max_tender = apms_event_tender($bo_table, $wr_id);
					if($max_tender > 0) {
				?>
					<div class="col-sm-4">
						<?php echo ($ev['end']) ? '낙찰점수' : '최고낙찰';?> : <b class="red"><?php echo number_format($max_tender); ?></b> <?php echo AS_MP;?>
					</div>
				<?php } } ?>
				<div class="col-sm-4">
					입찰횟수 : 총 <b><?php echo number_format($ev['tender']); ?></b> 회 가능
				</div>
			<?php } ?>
			<div class="col-sm-4">
				참가점수 : <b><?php echo number_format($ev['entry_point']); ?></b> <?php echo AS_MP;?>
			</div>
			<div class="col-sm-4">
				현재참가 : 총 <?php echo ($ev['tender_count']) ? '<b>'.number_format($ev['tender_count']).'</b>' : 0; //참여수 ?> 명
			</div>
		</div>
		
		<div class="view-line"></div>

		<div class="text-center">
			<?php if($is_guest) { ?>
				<button type="button" class="btn btn-color" onclick="alert('로그인해 주세요.');">
					<?php echo ($ev['status'] == '종료') ? '결과보기' : '참여하기';?>
				</button>
			<?php } else { ?>
				<?php if($ev['status'] == '진행중') { ?>
					<button type="button" class="btn btn-color" data-toggle="modal" data-target="#eventModal">
						참여하기(<?php echo number_format($own_cnt - 1);?>/<?php echo $ev['tender'];?>)
					</button>
				<?php } else if($ev['status'] == '종료') { ?>
					<?php if($own[0]['is_confirm']) { // 당첨처리 안된 이벤트 ?>
						<a role="button" href="<?php echo G5_BBS_URL;?>/event.php?bo_table=<?php echo $bo_table;?>&amp;wr_id=<?php echo $wr_id;?>&amp;ec=1<?php echo $qstr;?>" class="btn btn-color"><i class="fa fa-check"></i> 당첨처리</a>
						<a role="button" href="<?php echo G5_BBS_URL;?>/event.php?bo_table=<?php echo $bo_table;?>&amp;wr_id=<?php echo $wr_id;?>&amp;ed=1<?php echo $qstr;?>" class="btn btn-black"><i class="fa fa-times"></i> 당첨포기</a>
					<?php } else { ?>
						<button type="button" class="btn btn-color" data-toggle="modal" data-target="#eventModal">
							결과보기
						</button>
					<?php } ?>
				<?php } else { ?>
					<button type="button" class="btn btn-black" onclick="alert('이벤트 시작전입니다.');">
						참여하기
					</button>
				<?php } ?>
			<?php } ?>

			<a role="button" href="<?php echo $board_skin_url;?>/evlist.php?bo_table=<?php echo $bo_table;?>&amp;wr_id=<?php echo $wr_id;?>&amp;pim=1" class="btn btn-black win_scrap">참여회원</a>

			<a role="button" href="<?php echo $board_skin_url;?>/evlist.php?bo_table=<?php echo $bo_table;?>&amp;wr_id=<?php echo $wr_id;?>&amp;opt=1&amp;pim=1" class="btn btn-black win_scrap">댓글참여</a>
		</div>
	</div>
</div>

<?php if($view['wr_6']) { // 메모 ?>
	<div class="well"><?php echo get_text($view['wr_6']); ?></div>
<?php } ?>

<?php if($ev['end'] && !$ev['show_win']) { ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<i class="fa fa-trophy"></i> Winner
			</h3>
		</div>
		<div class="panel-body">
			<?php 
				for($i=0; $i < count($win); $i++) { 
					$winner = get_member($win[$i]['mb_id']);
					$winner_name = ($winner['mb_open']) ? apms_sideview($winner['mb_id'], $winner['mb_nick'], $winner['mb_email'], $winner['mb_homepage'], $winner['as_level']) : apms_sideview($winner['mb_id'], $winner['mb_nick'], '', '', $winner['as_level']);
					$win_tender = (!$ev['type'] && !$ev['show_tender_win']) ? ' ('.number_format($win[$i]['ev_point']).')' : '';
					echo '<b>'.$winner_name.'</b>'.$win_tender.' &nbsp;'.PHP_EOL;
				}
				if(!$i) echo '당첨자가 없습니다.'.PHP_EOL;
			?>
		</div>
	</div>
<?php } ?>

<?php
	$cnt = 0;
	if ($view['file']['count']) {
		for ($i=0; $i<count($view['file']); $i++) {
			if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
				$cnt++;
		}
	}
?>

<?php if($cnt) { ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<i class="fa fa-download"></i> Prize
			</h3>
		</div>
		<div class="list-group">
		   <?php
			// 가변 파일
			for ($i=0; $i<count($view['file']); $i++) {
				if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
					$file_tooltip = '';
					if($view['file'][$i]['content']) {
						$file_tooltip = ' data-original-title="'.strip_tags($view['file'][$i]['content']).'" data-toggle="tooltip"';
					}
			 ?>
				<a class="list-group-item view_file_download at-tip" href="<?php echo $view['file'][$i]['href'];  ?>"<?php echo $file_tooltip;?>>
					<i class="fa fa-gift"></i> <?php echo $view['file'][$i]['source'] ?>
					(<?php echo $view['file'][$i]['size'] ?>)
				</a>
			<?php
				}
			}
			 ?>
		</div>
	</div>
<?php } ?>
<?php
	// 링크
	$cnt = 0;
	for ($i=1; $i<=count($view['link']); $i++) {
		if ($view['link'][$i]) {
			$cnt++;
		}
	}
?>
<?php if ($cnt) { ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<i class="fa fa-home"></i> Links
			</h3>
		</div>
		<div class="list-group">
			<?php
				for ($i=1; $i<=count($view['link']); $i++) {
					if ($view['link'][$i]) {
						$link = cut_str($view['link'][$i], 70);
			?>
				<a class="list-group-item at-tip" href="<?php echo $view['link_href'][$i] ?>" target="_blank" data-original-title="<?php echo number_format($view['link_hit'][$i]); ?> 명 방문" data-toggle="tooltip">
					<i class="fa fa-link"></i> <?php echo $link ?>
				</a>
			<?php
				}
			}
			 ?>
		</div>
	</div>
<?php } ?>
<?php if ($ev['status'] == '진행중' && $end_time > 0 && !$is_view_notice) { ?>
<script>

	var end_time = <?php echo $end_time; ?>;

	function run_timer() {
		var timer = document.getElementById("end_timer");

		dd = Math.floor(end_time/(60*60*24));
		hh = Math.floor((end_time%(60*60*24))/(60*60));
		mm = Math.floor(((end_time%(60*60*24))%(60*60))/60);
		ii = Math.floor((((end_time%(60*60*24))%(60*60))%60));

		var str = "";

		if (dd > 0) str += dd + "일 ";
		if (hh > 0) str += hh + "시간 ";
		if (mm > 0) str += mm + "분 ";
		str += ii + "초 ";

		timer.style.color = "red";
		timer.style.fontWeight = "bold";
		timer.innerHTML = str;

		end_time--;

		if (end_time < 0) clearInterval(tid);
	}

	run_timer();

	tid = setInterval('run_timer()', 1000); 

</script>
<?php } ?>
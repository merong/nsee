<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 변수정리
$item_sero = (int)$wset['sero'];
$item_cols = (int)$wset['garo'];
$item_cols = ($item_cols > 0) ? $item_cols : 12;
$item_rows = 12 / $item_cols;
$item_xs = (int)$wset['xs'];
$item_xs = ($item_xs && $item_xs < 12) ? ' col-xs-'.$item_xs : '';

// 총추출수
$wset['rows'] = $item_sero * $item_rows;

// 글추출
$list = apms_board_rows($wset);
$list_cnt = count($list);

// 아이콘
$icon = apms_fa($wset['icon']);

// 랭킹시작
$rank = ($wset['page'] > 1) ?  (($wset['page'] - 1) * $wset['rows'] + 1) : 1;

?>
<div class="row">
	<div class="col-sm-<?php echo $item_cols.$item_xs;?> col">
		<ul>
		<?php for ($i=0; $i < $list_cnt; $i++) { ?>
			<?php if($i > 0 && $item_sero > 0 && $i%$item_sero == 0) { ?>
					</ul>
				</div> <!-- //col -->
				<div class="col-sm-<?php echo $item_cols.$item_xs;?> col">
					<ul>
			<?php } ?>
			<li>
				<a href="<?php echo $list[$i]['href'];?>"<?php echo $aimg;?>>
					<?php if($list[$i]['comment']) { // 댓글 ?>
						<span class="pull-right count"><?php echo number_format($list[$i]['comment']);?></span>
					<?php } ?>
					<?php if($wset['rank']) { // 랭크 ?>
						<span class="en rank-icon bg-<?php echo $wset['rank'];?>"><?php echo $rank; $rank++; ?></span>
					<?php } ?>
					<?php echo $list[$i]['subject']; //제목 ?>
				</a> 
			</li>
		<?php } ?>
		</ul>
	</div>
</div>
<?php if(!$list_cnt) { ?>
	<p class="text-muted text-center">글이 없습니다.</p>
<?php } ?>
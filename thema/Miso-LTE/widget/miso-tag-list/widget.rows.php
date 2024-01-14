<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 태그추출
$list = apms_tag_rows($wset);
$list_cnt = count($list);

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 태그섞기
if($list_cnt > 0 && isset($wset['rdm']) && $wset['rdm']) {
	shuffle($list);
}

for ($i=0; $i < $list_cnt; $i++) { 
?>
	<li>
		<a href="<?php echo $list[$i]['href'];?>" class="ellipsis">
			<span class="pull-right red"><?php echo number_format($list[$i]['cnt']);?></span>
			<?php if($wset['rank']) { ?>
				<span class="rank-icon bg-<?php echo $wset['rank'];?> en"><?php echo $rank; $rank++; ?></span>
			<?php } ?>
			<?php echo $list[$i]['name'];?>
		</a>
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="text-muted text-center">
		자료가 없습니다.
	</li>
<?php } ?>

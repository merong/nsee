<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// 랭킹출력시 회원레벨출력 안함
$wset['nolvl'] = ($wset['rank']) ? true : false;

// 추출하기
$list = apms_member_rows($wset);
$list_cnt = count($list);

// 랭킹
$rank = apms_rank_offset($wset['rows'], $wset['page']); 

// 텍스트
switch($wset['mode']) {
	case 'point'	: $txt = ' P'; break;
	case 'level'	: $txt = ' Exp'; break;
	default			: $txt = ''; break;	
}

$icolor = (isset($wset['icolor']) && $wset['icolor']) ? $wset['icolor'] : 'icon';

// 리스트
for ($i=0; $i < $list_cnt; $i++) { 
?>
	<li class="ellipsis">
		<span class="pull-right red"><?php echo number_format($list[$i]['cnt']).$txt;?></span>
		<?php if($wset['rank']) { ?>
			<span class="rank-icon bg-<?php echo $wset['rank'];?> en"><?php echo $rank; $rank++; ?></span>
		<?php } ?>
		<?php echo $list[$i]['name'];?>
	</li>
<?php } ?>
<?php if(!$list_cnt) { ?>
	<li class="text-muted text-center">
		자료가 없습니다.
	</li>
<?php } ?>

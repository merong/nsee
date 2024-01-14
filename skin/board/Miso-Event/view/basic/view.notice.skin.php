<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$attach_list = '';
if ($view['link']) {
	// 링크
	for ($i=1; $i<=count($view['link']); $i++) {
		if ($view['link'][$i]) {
			$attach_list .= '<a class="list-group-item break-word" href="'.$view['link_href'][$i].'" target="_blank">';
			$attach_list .= '<i class="fa fa-link"></i> '.cut_str($view['link'][$i], 70).' &nbsp;<span class="blue">+ '.$view['link_hit'][$i].'</span></a>'.PHP_EOL;
		}
	}
}

// 가변 파일
$j = 0;
if ($view['file']['count']) {
	for ($i=0; $i<count($view['file']); $i++) {
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
			if ($board['bo_download_point'] < 0 && $j == 0) {
				$attach_list .= '<a class="list-group-item"><i class="fa fa-bell red"></i> 다운로드시 <b>'.number_format(abs($board['bo_download_point'])).'</b>'.AS_MP.' 차감 (최초 1회 / 재다운로드시 차감없음)</a>'.PHP_EOL;
			}
			$file_tooltip = '';
			if($view['file'][$i]['content']) {
				$file_tooltip = ' data-original-title="'.strip_tags($view['file'][$i]['content']).'" data-toggle="tooltip"';
			}
			$attach_list .= '<a class="list-group-item break-word view_file_download at-tip" href="'.$view['file'][$i]['href'].'"'.$file_tooltip.'>';
			$attach_list .= '<span class="pull-right hidden-xs text-muted"><i class="fa fa-clock-o"></i> '.date("Y.m.d H:i", strtotime($view['file'][$i]['datetime'])).'</span>';
			$attach_list .= '<i class="fa fa-download"></i> '.$view['file'][$i]['source'].' ('.$view['file'][$i]['size'].') &nbsp;<span class="orangered">+ '.$view['file'][$i]['download'].'</span></a>'.PHP_EOL;
			$j++;
		}
	}
}

?>
<h1>
	<?php if($view['photo']) { ?><span class="talker-photo hidden-xs"><?php echo $view['photo'];?></span><?php } ?><?php echo cut_str(get_text($view['wr_subject']), 70); ?>
</h1>

<div class="panel panel-default view-head<?php echo ($attach_list) ? '' : ' no-attach';?>">
	<div class="panel-heading">
		<div class="ellipsis text-muted<?php echo $view_font;?>">
			<?php echo $view['name']; //등록자 ?>
			<?php echo ($is_ip_view) ? '<span class="hidden-xs">('.$ip.')</span>' : ''; ?>
			<?php if($view['ca_name']) { ?>
				<span class="hidden-xs">
					<span class="sp"></span>
					<i class="fa fa-tag"></i>
					<?php echo $view['ca_name']; //분류 ?>
				</span>
			<?php } ?>
			<span class="sp"></span>
			<i class="fa fa-comment"></i>
			<?php echo ($view['wr_comment']) ? '<b class="red">'.$view['wr_comment'].'</b>' : 0; //댓글수 ?>
			<span class="sp"></span>
			<i class="fa fa-eye"></i>
			<?php echo $view['wr_hit']; //조회수 ?>

			<?php if($is_good) { ?>
				<span class="sp"></span>
				<i class="fa fa-thumbs-up"></i>
				<?php echo $view['wr_good']; //추천수 ?>
			<?php } ?>
			<?php if($is_nogood) { ?>
				<span class="sp"></span>
				<i class="fa fa-thumbs-down"></i>
				<?php echo $view['wr_nogood']; //비추천수 ?>
			<?php } ?>
			<span class="hidden-xs pull-right">
				<i class="fa fa-clock-o"></i>
				<?php echo date('Y.m.d H:i', $view['date']); //날짜 ?>
			</span>
		</div>
	</div>
   <?php
		if($attach_list) {
			echo '<div class="list-group'.$view_font.'">'.$attach_list.'</div>'.PHP_EOL;
		}
	?>
</div>

<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$view_skin_url.'/view.css" media="screen">', 0);

$view_font = (G5_IS_MOBILE) ? '' : ' font-12';

if($is_view_notice) { // 공지글 
	include_once($view_skin_path.'/view.notice.skin.php');
} else {
	include_once($view_skin_path.'/view.event.skin.php');
}
?>

<div class="view-padding">
	<?php if ($is_torrent) { // 토렌트 파일정보 ?>
		<?php for($i=0; $i < count($torrent); $i++) { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-share-alt fa-lg"></i> <?php echo $torrent[$i]['name'];?></h3>
				</div>
				<div class="panel-body">
					<span class="pull-right hidden-xs text-muted en font-11"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d H:i", $torrent[$i]['date']);?></span>
					<?php if ($torrent[$i]['is_size']) { ?>
							<b class="en font-16"><i class="fa fa-cube"></i> <?php echo $torrent[$i]['info']['name'];?> (<?php echo $torrent[$i]['info']['size'];?>)</b>
					<?php } else { ?>
						<p><b class="en font-16"><i class="fa fa-cube"></i> Total <?php echo $torrent[$i]['info']['total_size'];?></b></p>
						<div class="text-muted<?php echo $view_font;?>">
							<?php for ($j=0;$j < count($torrent[$i]['info']['file']);$j++) { 
								echo ($j + 1).'. '.implode(', ', $torrent[$i]['info']['file'][$j]['name']).' ('.$torrent[$i]['info']['file'][$j]['size'].')<br>'."\n";
							} ?>
						</div>
					<?php } ?>
				</div>
				<ul class="list-group">
					<li class="list-group-item en font-14 break-wrod"><i class="fa fa-magnet"></i> <?php echo $torrent[$i]['magnet'];?></li>
					<li class="list-group-item break-word">
						<div class="text-muted<?php echo $view_font;?>">
							<?php for ($j=0;$j < count($torrent[$i]['tracker']);$j++) { ?>
								<i class="fa fa-tags"></i> <?php echo $torrent[$i]['tracker'][$j];?><br>
							<?php } ?>
						</div>
					</li>
					<?php if($torrent[$i]['comment']) { ?>
						<li class="list-group-item en font-14 break-word"><i class="fa fa-bell"></i> <?php echo $torrent[$i]['comment'];?></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
	<?php } ?>

	<?php
		// 이미지 상단 출력
		$v_img_count = count($view['file']);
		if($v_img_count && $is_img_head) {
			echo '<div class="view-img">'.PHP_EOL;
			for ($i=0; $i<=count($view['file']); $i++) {
				if ($view['file'][$i]['view']) {
					echo get_view_thumbnail($view['file'][$i]['view']);
				}
			}
			echo '</div>'.PHP_EOL;
		}
	 ?>

	<div class="view-content">
		<?php echo get_view_thumbnail($view['content']); ?>
	</div>

	<?php
		// 이미지 하단 출력
		if($v_img_count && $is_img_tail) {
			echo '<div class="view-img">'.PHP_EOL;
			for ($i=0; $i<=count($view['file']); $i++) {
				if ($view['file'][$i]['view']) {
					echo get_view_thumbnail($view['file'][$i]['view']);
				}
			}
			echo '</div>'.PHP_EOL;
		}
	?>
</div>

<?php if ($good_href || $nogood_href) { ?>
	<div class="view-good-box">
		<?php if ($good_href) { ?>
			<span class="view-good">
				<a href="#" onclick="apms_good('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'good', 'wr_good'); return false;">
					<b id="wr_good"><?php echo $view['wr_good']; ?></b>
					<br>
					<i class="fa fa-thumbs-up"></i>
				</a>
			</span>
		<?php } ?>
		<?php if ($nogood_href) { ?>
			<span class="view-nogood">
				<a href="#" onclick="apms_good('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'nogood', 'wr_nogood'); return false;">
					<b id="wr_nogood"><?php echo $view['wr_nogood']; ?></b>
					<br>
					<i class="fa fa-thumbs-down"></i>
				</a>
			</span>
		<?php } ?>
	</div>
	<p></p>
<?php } else { //여백주기 ?>
	<div class="h40"></div>
<?php } ?>

<?php if ($is_tag) { // 태그 ?>
	<p class="view-tag view-padding<?php echo $view_font;?>"><i class="fa fa-tags"></i> <?php echo $tag_list;?></p>
<?php } ?>

<div class="print-hide view-icon view-padding">
	<?php 
		// SNS 보내기
		if ($board['bo_use_sns']) {
			echo apms_sns_share_icon('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $view['subject'], $seometa['img']['src']);
		}
	?>
	<span class="pull-right">
		<img src="<?php echo G5_IMG_URL;?>/sns/print.png" alt="프린트" class="cursor at-tip" onclick="apms_print();" data-original-title="프린트" data-toggle="tooltip">
		<?php if ($scrap_href) { ?>
			<img src="<?php echo G5_IMG_URL;?>/sns/scrap.png" alt="스크랩" class="cursor at-tip" onclick="win_scrap('<?php echo $scrap_href;  ?>');" data-original-title="스크랩" data-toggle="tooltip">
		<?php } ?>
		<?php if ($is_shingo) { ?>
			<img src="<?php echo G5_IMG_URL;?>/sns/shingo.png" alt="신고" class="cursor at-tip" onclick="apms_shingo('<?php echo $bo_table;?>', '<?php echo $wr_id;?>');" data-original-title="신고" data-toggle="tooltip">
		<?php } ?>
		<?php if ($is_admin) { ?>
			<?php if ($view['is_lock']) { // 글이 잠긴상태이면 ?>
				<img src="<?php echo G5_IMG_URL;?>/sns/unlock.png" alt="해제" class="cursor at-tip" onclick="apms_shingo('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'unlock');" data-original-title="해제" data-toggle="tooltip">
			<?php } else { ?>
				<img src="<?php echo G5_IMG_URL;?>/sns/lock.png" alt="잠금" class="cursor at-tip" onclick="apms_shingo('<?php echo $bo_table;?>', '<?php echo $wr_id;?>', 'lock');" data-original-title="잠금" data-toggle="tooltip">
			<?php } ?>
		<?php } ?>
	</span>
	<div class="clearfix"></div>
</div>

<?php if($is_signature) { // 서명 ?>
	<div class="panel panel-default view-author">
		<div class="panel-heading">
			<h3 class="panel-title">
				<?php if($author['partner']) { ?>
					<a href="<?php echo $at_href['myshop'];?>?id=<?php echo $author['mb_id'];?>" class="pull-right">
						<span class="orangered font-14 en"><i class="fa fa-thumbs-o-up"></i> My Shop</span>
					</a>
				<?php } ?>
				Author
			</h3>
		</div>
		<div class="panel-body">
			<div class="pull-left text-center auth-photo">
				<div class="img-photo">
					<?php echo ($author['photo']) ? '<img src="'.$author['photo'].'" alt="">' : '<i class="fa fa-user"></i>'; ?>
				</div>
				<div class="btn-group" style="margin-top:-30px;white-space:nowrap;">
					<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $author['mb_id'];?>', 'like', 'it_like'); return false;" title="Like">
						<i class="fa fa-thumbs-up"></i> <span id="it_like"><?php echo $author['liked']; ?></span>
					</button>
					<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $author['mb_id'];?>', 'follow', 'it_follow'); return false;" title="Follow">
						<i class="fa fa-users"></i> <span id="it_follow"><?php echo $author['followed']; ?></span>
					</button>
				</div>
			</div>
			<div class="auth-info">
				<div style="margin-bottom:4px;">
					<span class="pull-right">Lv.<?php echo $author['level'];?></span>
					<b><?php echo $author['name']; ?></b> &nbsp;<span class="text-muted font-11"><?php echo $author['grade'];?></span>
				</div>
				<div class="div-progress progress progress-striped no-margin">
					<div class="progress-bar progress-bar-exp" role="progressbar" aria-valuenow="<?php echo round($author['exp_per']);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($author['exp_per']);?>%;">
						<span class="sr-only"><?php echo number_format($author['exp']);?> (<?php echo $author['exp_per'];?>%)</span>
					</div>
				</div>
				<p style="margin-top:10px;">
					<?php echo ($signature) ? $signature : '등록된 서명이 없습니다.'; ?>
				</p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>	
<?php } else { ?>
	<div class="view-author-none"></div>
<?php } ?>

<?php include_once('./view_comment.php'); ?>

<?php
include_once('./_common.php');

if(isset($count) && $count) { // 카운트

	if($is_guest) exit;

	$count = $member['as_response'] + $member['as_memo'];
	$count = ($count > 0) ? $count : 0;
	echo '{ "count": "' . $count . '" }';
	exit;

}

?>

<?php if($is_guest) { // 비회원 ?>
	<h3 class="control-sidebar-heading">
		<i class="fa fa-sign-in"></i>&nbsp; Login
	</h3>
	<ul class="control-sidebar-menu font-12 ko-12">
		<li>
			<a href="javascript::;">
				<h4 class="control-sidebar-subheading ko-12">
					로그인해 주세요.
				</h4>
			</a>
		</li>
	</ul>
<?php exit; } ?>

<?php
	// 내글반응
	$list = apms_response_rows();
	$response_cnt = count($list);
?>
<h3 class="control-sidebar-heading">
	<i class="fa fa-smile-o"></i>&nbsp; Response
	<?php if($response_cnt) { ?>
		<span class="count orangered">+<?php echo number_format($response_cnt);?></span>
	<?php } ?>
</h3>
<ul class="control-sidebar-menu font-12 ko-12">
	<?php 
	if($response_cnt) {
		for($i=0; $i < $response_cnt; $i++) {
	?>
			<li>
				<a href="javascript::;" onclick="<?php echo $list[$i]['href'];?>">
					<?php echo ($list[$i]['photo']) ? '<img src="'.$list[$i]['photo'].'" alt="" class="menu-icon">' : '<i class="menu-icon fa fa-user font-16 bg-orange"></i>'; ?>
					<div class="menu-info">
						<h4 class="control-sidebar-subheading ko-12 ellipsis">
							<?php echo $list[$i]['subject'];?>
						</h4>
						<p class="font-12 ko-11 ellipsis">
							<?php echo $list[$i]['name'];?> 외
							<?php if($list[$i]['reply_cnt']) { ?>
								<i class="fa fa-comments-o"></i> <?php echo $list[$i]['reply_cnt'];?>
							<?php } ?>
							<?php if($list[$i]['comment_cnt']) { ?>
								<i class="fa fa-comment"></i> <?php echo $list[$i]['comment_cnt'];?>
							<?php } ?>
							<?php if($list[$i]['comment_reply_cnt']) { ?>
								<i class="fa fa-comments"></i> <?php echo $list[$i]['comment_reply_cnt'];?>
							<?php } ?>
							<?php if($list[$i]['good_cnt']) { ?>
								<i class="fa fa-thumbs-up"></i> <?php echo $list[$i]['good_cnt'];?>
							<?php } ?>
							<?php if($list[$i]['nogood_cnt']) { ?>
								<i class="fa fa-thumbs-down"></i> <?php echo $list[$i]['nogood_cnt'];?>
							<?php } ?>
							<?php if($list[$i]['use_cnt']) { ?>
								<i class="fa fa-pencil"></i> <?php echo $list[$i]['use_cnt'];?>
							<?php } ?>
							<?php if($list[$i]['qa_cnt']) { ?>
								<i class="fa fa-question-circle"></i> <?php echo $list[$i]['qa_cnt'];?>
							<?php } ?>
							<i class="fa fa-clock-o"></i> <?php echo apms_datetime($list[$i]['date']);?>
						</p>
					</div>
				</a>
			</li>
		<?php }	?>
	<?php } else { ?>
		<li>
			<a href="javascript::;">
				<h4 class="control-sidebar-subheading ko-12">
					새로운 내글반응이 없습니다.
				</h4>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="javascript::;" onclick="win_memo('<?php echo $at_href['response'];?>');">
			<div class="menu-info no-margin">
				<p class="font-13 ko-12">
					<i class="fa fa-magic" style="margin-left:0px"></i> 일괄확인/리카운트</span>
				</p>
			</div>
		</a>
	</li>
</ul>

<?php
	// 쪽지
	$list = apms_memo_rows();
	$memo_cnt = count($list);
?>
<h3 class="control-sidebar-heading">
	<i class="fa fa-envelope"></i>&nbsp; Message
	<?php if($memo_cnt) { ?>
		<span class="count orangered">+<?php echo number_format($memo_cnt);?></span>
	<?php } ?>
</h3>
<ul class="control-sidebar-menu font-12 ko-12">
	<?php if($memo_cnt) {
		for($i=0; $i < $memo_cnt; $i++) {
	?>
			<li>
				<a href="javascript::;" onclick="win_memo('<?php echo $list[$i]['href'];?>');">
					<?php echo ($list[$i]['photo']) ? '<img src="'.$list[$i]['photo'].'" alt="" class="menu-icon">' : '<i class="menu-icon fa fa-user font-16 bg-blue"></i>'; ?>
					<div class="menu-info">
						<h4 class="control-sidebar-subheading ko-12">
							<b><?php echo ($list[$i]['mb_nick']) ? $list[$i]['mb_nick'] : '정보없음';?></b>
							&nbsp;
							<i class="fa fa-clock-o"></i>
							<?php echo apms_datetime($list[$i]['date']);?>
						</h4>
						<p class="font-13 ko-12">
							<?php echo apms_cut_text($list[$i]['me_memo'], 24,'… <span class="font-12 ko-11">더보기</span>');?>
						</p>
					</div>
				</a>
			</li>
		<?php } ?>
	<?php } else { ?>
		<li>
			<a href="javascript::;">
				<h4 class="control-sidebar-subheading ko-12">
					새로온 쪽지가 없습니다.
				</h4>
			</a>
		</li>
	<?php } ?>
	<li>
		<a href="javascript::;" onclick="win_memo('<?php echo $at_href['memo'];?>');">
			<div class="menu-info no-margin">
				<p class="font-13 ko-12">
					<i class="fa fa-envelope-o" style="margin-left:0px"></i> 쪽지함 열기</span>
				</p>
			</div>
		</a>
	</li>
</ul>

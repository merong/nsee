<?php
include_once('./_common.php');

thema_member('cart');

if(isset($del) && $del) {
	$tv_idx = (int)get_session("ss_tv_idx");
	for ($k=1;$k<=$tv_idx;$k++) {
		$sid = "ss_tv[".$k."]";
		unset($_SESSION[$sid]);
	}
	unset($_SESSION['ss_tv_idx']);
	$member['today'] = 0;
}

if($member['today']) {
?>
	<li class="header">
		<span class="ko-12">오늘 본 상품은 <b class="orangered"><?php echo number_format($member['today']);?></b>개 입니다.</span>
	</li>
	<li>
		<ul class="menu ko-12">
			<?php
				$list = apms_today_rows();
				$list_cnt = count($list);
				for($i=0; $i < $list_cnt; $i++) {
			?>
				<li>
					<a href="<?php echo $list[$i]['href'];?>">
						<div class="pull-left">
							<img src="<?php echo $list[$i]['img'];?>" alt="" class="img-circle">
						</div>
						<h4 class="ellipsis">
							<span class="ko-12"><?php echo $list[$i]['it_name'];?></span>
						</h4>
						<p style="margin-top:4px;">
							<?php echo number_format($list[$i]['it_price']);?>원
						</p>
					</a>
				</li>
			<?php } ?>
		</ul>
	</li>
	<li class="footer">
		<a class="cursor" onclick="miso_shop('tdel');"><span class="ko-12">비우기</span></a>
	</li>
<?php } else { ?>
	<li class="header text-center" style="padding:30px 0px;">
		<span class="ko-12">오늘 본 상품은 없습니다.</span>
	</li>
<?php } ?>

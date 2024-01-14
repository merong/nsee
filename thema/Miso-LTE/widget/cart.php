<?php
include_once('./_common.php');

thema_member('cart');

if($member['cart']) {
?>
	<li class="header">
		<span class="ko-12">장바구니에 <b class="orangered"><?php echo number_format($member['cart']);?></b>개의 상품이 있습니다.</span>
	</li>
	<li>
		<ul class="menu ko-12">
			<?php
				$list = apms_cart_rows();
				$list_cnt = count($list);
				for($i=0; $i < $list_cnt; $i++) {
			?>
				<li>
					<a href="<?php echo $list[$i]['href'];?>">
						<div class="pull-left">
							<img src="<?php echo $list[$i]['img'];?>" alt="" class="img-circle">
						</div>
						<h4 class="ellipsis">
							<span class="ko-12"><?php echo $list[$i]['it_name'];?><?php echo $list[$i]['it_name'];?><?php echo $list[$i]['it_name'];?></span>
						</h4>
						<p style="margin-top:4px;">
							<?php echo number_format($list[$i]['ct_price']);?>원
						</p>
					</a>
				</li>
			<?php } ?>
		</ul>
	</li>
	<li class="footer">
		<a href="<?php echo $at_href['cart'];?>">
			<span class="ko-12">장바구니 열기</span>
		</a>
	</li>
<?php } else { ?>
	<li class="header text-center" style="padding:30px 0px;">
		<span class="ko-12">장바구니가 비어 있습니다.</span>
	</li>
<?php } ?>

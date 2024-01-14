<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$po = apms_get_extra($view['as_extra'], $bo_table, $wr_id);
$po['po_content'] = trim($po['po_content']);

$po_arr = array();

//참여등급
if($po['po_level'] > 0) {
	$pmg = 'xp_grade'.$po['po_level'];
	$po_arr[] = $xp[$pmg].' 이상';
}

//참여점수
if($po['po_point'] > 0) {
	$po_arr[] = number_format($po['po_point']).AS_MP.' 적립';
}

//종료일
if($po['po_end']) {
	$po_arr[] = str_replace("-", ".", substr($po['po_endtime'],0,10)).' 까지';
}

//참여수
if($po['po_cnt']) {
	$po_arr[] = '총 '.number_format($po['po_cnt']).'명 참여';
}

//메시지
$po_msg = (!empty($po_arr)) ? implode(' / ', $po_arr) : '';	

?>
<div class="h20"></div>

<form name="fpollview" id="fpollview" action="./poll.php" method="post" role="form" class="form-inline" onsubmit="return vfpoll_submit(this);">
<input type="hidden" name="po_id" value="<?php echo $po['po_id'] ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sca" value="<?php echo $sca ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="sw" value="">
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">
					<i class="fa fa-bar-chart"></i>
					<?php echo get_text($po['po_subject']);?>
				</h4>
			</div>
			<ul class="list-group">
				<?php if($po['po_content']) { ?>
					<li class="list-group-item">
						<?php echo conv_content($po['po_content'], 0); ?>
					</li>
				<?php } ?>
				<?php for($i=1; $i <= 9; $i++) { 
					$po_stx = get_text($po['po_poll'.$i]);

					if(!$po_stx) continue;

					$po_cnt = $po['po_cnt'.$i];
					$po_per = ($po['po_cnt'] > 0) ? round(($po_cnt / $po['po_cnt']) * 1000) / 10 : 0; 

				?>
					<li class="list-group-item">
						<span class="pull-right">
							<?php echo number_format($po_cnt);?>명(<?php echo $po_per;?>%)
						</span>
						<label class="radio-inline cursor">
							<input type="radio" name="ans" value="<?php echo $i;?>"> 
							<?php echo $po_stx;?>
						</label>
					</li>
				<?php } ?>
				<li class="list-group-item text-center">
					<?php if($po_msg) { ?>
						<p class="help-block">
							<?php echo $po_msg;?> 
						</p>
					<?php } ?>
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-dot-circle-o"></i> 참여하기
					</button>
				</li>
			</ul>
		</div>
	</div>
</div>
</form>
<script>
	function vfpoll_submit(f) {
		var ans = $(':radio[name="ans"]:checked').val();

		if (!ans) {
			alert("항목을 선택해 주세요.");
			return false;
		}

		return true;
	}
</script>

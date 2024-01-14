<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<div class="well well-sm text-center">
	<div class="list-control pull-right">
		<div class="btn-group">
			<?php if ($rss_href) { ?>
				<a href="<?php echo $rss_href; ?>" class="btn btn-color btn-sm"><i class="fa fa-rss"></i></a>
			<?php } ?>
			<a href="#" class="btn btn-black btn-sm" data-toggle="modal" data-target="#searchModal" onclick="return false;"><i class="fa fa-search"></i></a>
			<?php if ($is_checkbox || $setup_href || $admin_href) { ?>
				<?php if ($is_checkbox) { ?>
					<button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-black btn-sm"><i class="fa fa-times"></i></button>
					<button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn-black btn-sm"><i class="fa fa-clipboard"></i></button>
					<button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn-black btn-sm"><i class="fa fa-arrows"></i></button>
					<button type="button" id="btn_chkall" class="btn btn-black btn-sm btn-chkall"><i class="fa fa-check"></i></button>
				<?php } ?>
				<?php if ($setup_href) { ?>
					<a href="<?php echo $setup_href; ?>" class="btn btn-color btn-sm win_memo"><i class="fa fa-cogs"></i></a>
				<?php } ?>
				<?php if ($admin_href) { ?>
					<a href="<?php echo $admin_href; ?>" class="btn btn-black btn-sm"><i class="fa fa-cog"></i></a>
				<?php } ?>
			<?php } ?>
			<?php if ($list_href) { ?><a href="<?php echo $list_href ?>" class="btn btn-black btn-sm"><i class="fa fa-bars"></i></a><?php } ?>
			<?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn btn-color btn-sm"><i class="fa fa-pencil"></i></a><?php } ?>
		</div>
	</div>
	<?php if($total_count > 0) { ?>
		<div class="list-control pull-left">
			<ul class="pagination pagination-sm en no-margin">
				<?php if($prev_part_href) { ?>
					<li><a href="<?php echo $prev_part_href;?>">이전검색</a></li>
				<?php } ?>
				<?php echo apms_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&amp;page=');?>
				<?php if($next_part_href) { ?>
					<li><a href="<?php echo $next_part_href;?>">다음검색</a></li>
				<?php } ?>
			</ul>
		</div>
	<?php } ?>
	<div class="clearfix"></div>
</div>

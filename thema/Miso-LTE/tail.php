<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
?>
				<?php if($col_name) { ?>
					<?php if($col_name == "two") { ?>
							</div><!-- #at-main -->
							<?php if($is_at_left) { //left side ?>
								<div id="at-left">
									<?php @include(THEMA_PATH.'/side/'.$at_set['ls'].'.php'); ?>
								</div><!-- #at-left -->
							<?php } ?>
							<?php if($is_at_right) { //right side ?>
								<div id="at-right">
									<?php @include(THEMA_PATH.'/side/'.$at_set['rs'].'.php'); ?>
								</div><!-- #at-right -->
							<?php } ?>
						</div><!-- #at-wrap -->
						<div class="clearfix"></div>
					<?php } ?>
				</div><!-- .at-content -->
			</div><!-- .content -->
		<?php } ?>
		</div><!-- /.content-wrapper -->

		<!-- Footer -->
		<footer id="thema_footer" class="main-footer ko-12<?php echo ($is_at_ft) ? ' text-center' : ''; //중앙정렬 ?>">
			<div class="info font-12 ko-11">
				<a href="<?php echo $as_href['pc_mobile'];?>">
					<?php echo (G5_IS_MOBILE) ? 'PC' : 'Mobile';?> Version
				</a>
				<span class="sp">|</span>
			</div>
			<div class="copyright">
				<strong><i class="fa fa-copyright"></i> <?php echo $config['cf_title'];?>.</strong>
				<span class="hidden-xs en">All rights reserved.</span>
				<span class="sp">|</span>
				<span class="hidden-xs en">DMCA - contact@avsee.tv</span>
			</div>
		</footer>
		<!--alarm of memo-->
		<?php echo apms_widget('basic-memo-alarm', 'basic-memo-alarm'); ?>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-<?php echo ($at_set['scolor']) ? 'light' : 'dark';?>">
			<div class="control-sidebar-content">
				<div id="sidebarList"></div>
				<div class="text-center">
					<a href="javascript::;" data-toggle="control-sidebar">
						<h3 class="control-sidebar-heading no-margin">
							Close
						</h3>
					</a>
				</div>
			</div>
		</aside><!-- /.control-sidebar -->

		<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div><!-- ./wrapper -->
</div>

<div id="go-btn" class="go-btn">
   	<a href="#" class="go-top"><img src="<?php echo THEMA_URL;?>/assets/img/btn-top.png"></a>
   	<a href="#" class="go-bottom"><img src="<?php echo THEMA_URL;?>/assets/img/btn-bottom.png"></a>
</div>

<!--[if lt IE 9]>
<script src="<?php echo THEMA_URL;?>/assets/js/respond.js"></script>
<![endif]-->

<script>
	var is_miso_thema = "<?php echo THEMA;?>";
	var is_response_time = "<?php echo (int)$at_set['msg']; ?>";
	var is_hover_sidebar = "<?php echo ($is_at_hover) ? '1' : '';?>";
</script>
<script src="<?php echo THEMA_URL;?>/assets/bs3/js/bootstrap.min.js"></script>
<?php if(!G5_IS_MOBILE && $is_at_tm) { ?>
<script src="<?php echo THEMA_URL;?>/assets/js/bootstrap-hover-dropdown.min.js"></script>
<?php } ?>
<script src="<?php echo THEMA_URL;?>/assets/js/slimscroll.min.js"></script>
<script src="<?php echo THEMA_URL;?>/assets/js/fastclick.js"></script>
<?php if($col_name == "two") { ?>
<script src="<?php echo THEMA_URL;?>/assets/js/layout.js"></script>
<?php } ?>
<script src="<?php echo THEMA_URL;?>/assets/js/app.js"></script>
<script src="<?php echo THEMA_URL;?>/assets/js/custom.js"></script>

<?php if($is_admin || $is_demo)	include_once(THEMA_PATH.'/assets/switcher.php'); //Style Switcher ?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
include_once(THEMA_PATH.'/assets/thema.php');
?>
<div id="thema_wrapper" class="hold-transition <?php echo $layout_wrapper;?>">
	<!-- Site wrapper -->
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo $at_href['home'];?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>AVsee.TV</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>AVsee</b>TV</span>
			</a>
			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<a class="cursor sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php if($is_at_tm) { //상단메뉴 ?>
					<button type="button" class="navbar-toggle collapsed btn-navbar-top" data-toggle="collapse" data-target="#navbar-collapse">
						<i class="fa fa-bars"></i>
					</button>
				<?php } ?>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<?php if(IS_YC) { // 영카트 이용시 ?>
							<li>
							<?php if(IS_SHOP) { // 쇼핑몰일 때 ?>
								<a href="<?php echo $at_href['change'];?>" data-original-title="<nobr>커뮤니티</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
									<i class="fa fa-commenting"></i>
									<span class="label label-circle bg-orangered en">BBS</span>
								</a>
							<?php } else { ?>
								<a href="<?php echo $at_href['change'];?>" data-original-title="<nobr>쇼핑몰</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
									<i class="fa fa-shopping-cart"></i>
									<span class="label label-circle bg-orangered en">SHOP</span>
								</a>
							<?php } ?>
							</li>
							<li id="cart-view" class="dropdown messages-menu">
								<a class="cursor dropdown-toggle" data-href="#" data-toggle="dropdown" style="padding:0px;" onclick="miso_shop('cart');"> 
									<div data-original-title="<nobr>장바구니</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true" style="padding:15px;">
										<i class="fa fa-shopping-basket"></i>
										<?php if($member['cart']) { ?>
											<span class="label label-circle label-info cartLabel en">
												<?php echo number_format($member['cart']);?>
											</span>
										<?php } ?>
									</div>
								</a>
								<ul id="cartViewList" class="dropdown-menu"></ul>
							</li>
							<li id="today-view" class="dropdown messages-menu">
								<a class="cursor dropdown-toggle" data-href="#" data-toggle="dropdown" style="padding:0px;" onclick="miso_shop('today');">
									<div data-original-title="<nobr>오늘 본 상품</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true" style="padding:15px;">
										<i class="fa fa-shopping-bag"></i>
										<?php if($member['today']) { ?>
											<span class="label label-circle label-success todayLabel en">
												<?php echo number_format($member['today']);?>
											</span>
										<?php } ?>
									</div>
								</a>
								<ul id="todayViewList" class="dropdown-menu"></ul>
							</li>
						<?php } ?>
						<li class="dropdown tasks-menu">
							<a class="cursor dropdown-toggle" data-href="#" data-toggle="dropdown" style="padding:0px;">
								<div data-original-title="<nobr>검색</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true" style="padding:15px;">
									<i class="fa fa-search"></i>
								</div>
							</a>
							<ul class="dropdown-menu ko-12">
								<li class="header">
									<form name="tallsearch" method="get" onsubmit="return tsearch_submit(this);" role="form" class="form">
									<div class="form-group" style="margin-bottom:8px;">
										<input type="text" name="stx" class="form-control input-sm" value="<?php echo $stx;?>" placeholder="두글자 이상 입력">
									</div>
									<div class="row row-10">
										<div class="col-xs-6 col-10">
											<select name="url" class="form-control input-sm">
												<option value="<?php echo $at_href['search'];?>">게시물</option>
												<?php if(IS_YC) { ?>
													<option value="<?php echo $at_href['isearch'];?>">상품</option>
													<option value="<?php echo $at_href['iuse'];?>">후기</option>
													<option value="<?php echo $at_href['iqa'];?>">문의</option>
												<?php } ?>
												<option value="<?php echo $at_href['tag'];?>">태그</option>
											</select>
										</div>
										<div class="col-xs-6 col-10">
											<button type="submit" class="btn btn-navy btn-sm btn-block"><i class="fa fa-search"></i> 검색하기</button>
										</div>
									</div>
									</form>				
								</li>
							</ul>
						</li>
						<li data-toggle="control-sidebar" onclick="miso_msg();">
							<a class="cursor" data-href="#" data-toggle="dropdown" style="padding:0px;">
								<div data-original-title="<nobr>알림</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true" style="padding:15px;">
									<i class="fa fa-bell"></i>
									<span class="label label-circle label-warning msgLabel en"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
										<span class="msgCount"><?php echo number_format($member['response'] + $member['memo']);?></span>
									</span>
								</div>
							</a>
						</li>
						<li class="hidden-xs hidden-boxed">
							<a href="<?php echo $at_href['rss'];?>" target="_blank" data-original-title="<nobr>RSS</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
								<i class="fa fa-rss"></i>
							</a>
						</li>
						<li class="hidden-xs hidden-boxed">
							<a class="cursor" data-href="#" onclick="window.external.AddFavorite(parent.location.href,document.title);" data-original-title="<nobr>북마크</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
								<i class="fa fa-bookmark"></i>
							</a>
						</li>
						<?php if($is_admin || $is_demo) { ?>
							<li class="hidden-xs widget-setup">
								<a class="cursor" data-href="#" data-original-title="<nobr>위젯설정</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
									<i class="fa fa-cogs"></i>
								</a>
							</li>
							<li class="hidden-xs layout-setup">
								<a class="cursor" data-href="#" data-original-title="<nobr>테마설정</nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
									<i class="fa fa-desktop"></i>
								</a>
							</li>
						<?php } ?>
						<li class="hidden-xs">
							<a href="<?php echo $as_href['pc_mobile'];?>" target="_blank" data-original-title="<nobr><?php echo (G5_IS_MOBILE) ? 'PC' : '모바일';?></nobr>" data-toggle="tooltip" data-placement="bottom" data-html="true">
								<i class="fa fa-exchange"></i>
							</a>
						</li>
					</ul>
				</div>
				<?php if($is_at_tm) { //상단메뉴 ?>
					<div class="at-navbar pull-left">
						<div class="navbar-collapse collapse" id="navbar-collapse">
							<ul class="nav navbar-nav nav-<?php echo $at_set['mfont'];?>">
								<?php //자동메뉴
								if(G5_IS_MOBILE) {
									$data_toggle = 'data-toggle="dropdown"';
									$submenu_toggle = ' class="submenu-toggle"';
								} else {
									$data_toggle = 'data-hover="dropdown"';
									$submenu_toggle = '';
								}
								for ($i=1; $i < $menu_cnt; $i++) { //메뉴출력 - 1번부터 출력
								?>
									<?php if($menu[$i]['is_sub']) { //서브메뉴가 있을 때 ?>
										<li class="dropdown<?php echo ($menu[$i]['on'] == "on") ? ' active' : '';?>">
											<a href="<?php echo $menu[$i]['href'];?>" class="dropdown-toggle" <?php echo $data_toggle;?> data-close-others="true"<?php echo $menu[$i]['target'];?>>
												<?php echo $menu[$i]['menu'];?>
												<?php if($menu[$i]['new'] == "new") { ?>
													<span class="label label-circle bg-<?php echo $narr[($i + 10)%10];?> en">N&nbsp;</span>
												<?php } else { ?>
													<i class="fa fa-caret-down visible-xs pull-right"></i>
												<?php } ?>
											</a>
											<div class="dropdown-menu dropdown-menu-head">
												<ul class="pull-left">
												<?php 
													$smw1 = 1; //나눔 체크
													for($j=0; $j < count($menu[$i]['sub']); $j++) { 
												?>
													<?php if($menu[$i]['sub'][$j]['sp']) { //나눔 ?>
														</ul>
														<ul class="pull-left">
													<?php $smw1++; } // 나눔 카운트 ?>
													<?php if($menu[$i]['sub'][$j]['line']) { //구분라인 ?>
														<li class="line hidden-xs"><a><?php echo $menu[$i]['sub'][$j]['line'];?></a></li>
													<?php } ?>
													<?php if($menu[$i]['sub'][$j]['is_sub']) { //서브메뉴가 있을 때 ?>
														<li class="dropdown-submenu sub-<?php echo ($menu[$i]['sub'][$j]['on'] == "on") ? 'on' : 'off';?>">
															<a tabindex="-1" href="<?php echo $menu[$i]['sub'][$j]['href'];?>"<?php echo $menu[$i]['sub'][$j]['target'];?><?php echo $submenu_toggle;?>>
																<?php echo $menu[$i]['sub'][$j]['menu'];?>
																<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
																	<i class="fa fa-circle red"></i>
																<?php } ?>
																<i class="fa fa-caret-right sub-caret pull-right"></i>
															</a>
															<div class="dropdown-menu dropdown-menu-sub">
																<ul class="pull-left">
																<?php 
																	$smw2 = 1; //나눔 체크
																	for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
																?>
																	<?php if($menu[$i]['sub'][$j]['sub'][$k]['sp']) { //나눔 ?>
																		</ul>
																		<ul class="pull-left">
																	<?php $smw2++; } // 나눔 카운트 ?>
																	<?php if($menu[$i]['sub'][$j]['sub'][$k]['line']) { //구분라인 ?>
																		<li class="line-sub hidden-xs"><a><?php echo $menu[$i]['sub'][$j]['sub'][$k]['line'];?></a></li>
																	<?php } ?>
																	<li class="sub2-<?php echo ($menu[$i]['sub'][$j]['sub'][$k]['on'] == "on") ? 'on' : 'off';?>">
																		<a tabindex="-1" href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>><?php echo $menu[$i]['sub'][$j]['sub'][$k]['menu'];?></a>
																	</li>
																<?php } ?>
																</ul>
																<?php $smw2 = ($smw2 > 1) ? $is_subw * $smw2 : 0; //서브메뉴 너비 ?>
																<div class="clearfix sub-nanum"<?php echo ($smw2) ? ' style="width:'.$smw2.'px;"' : '';?>></div>
															</div>
														</li>
													<?php } else { //서브메뉴가 없을 때 ?>
														<li class="sub-<?php echo ($menu[$i]['sub'][$j]['on'] == "on") ? 'on' : 'off';?>">
															<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
																<?php echo $menu[$i]['sub'][$j]['menu'];?>
																<?php if($menu[$i]['sub'][$j]['new'] == "new") { ?>
																	<i class="fa fa-circle red"></i>
																<?php } ?>
															</a>
														</li>
													<?php } ?>
												<?php } ?>
												</ul>
												<?php $smw1 = ($smw1 > 1) ? $is_subw * $smw1 : 0; //서브메뉴 너비 ?>
												<div class="clearfix sub-nanum"<?php echo ($smw1) ? ' style="width:'.$smw1.'px;"' : '';?>></div>
											</div>
										</li>
									<?php } else { //서브메뉴가 없을 때 ?>
										<li<?php echo ($menu[$i]['on'] == "on") ? ' class="active"' : '';?>>
											<a href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?>>
												<?php echo $menu[$i]['menu'];?>
												<?php if($menu[$i]['new'] == "new") { ?>
													<span class="label label-circle bg-<?php echo $narr[($i + 10)%10];?> en">N&nbsp;</span>
												<?php } ?>
											</a>
										</li>
									<?php } ?>
								<?php } ?>
							</ul>
						</div>
					</div>
				<?php } //상단메뉴 ?>
			</nav>
		</header>

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<section class="sidebar">
				<?php include_once(THEMA_PATH.'/sidebar.php'); // 로그인, 메뉴 등 좌측 사이드바 ?>
			</section>
		</aside>
		<!-- =============================================== -->

		<!-- Content Wrapper. Contains page content -->
		<div id="content_wrapper" class="content-wrapper <?php echo $wrapper;?> ko-12">
			<?php if($page_title) { // 페이지 타이틀 ?>
				<div class="page-title">
					<h2><?php echo ($bo_table) ? '<a href="'.G5_BBS_URL.'/board.php?bo_table='.$bo_table.'"><span>'.$page_title.'</span></a>' : $page_title;?></h2>
					<?php if($page_desc) { // 페이지 설명글 ?>
						<span class="page-desc hidden-xs">
							<?php echo $page_desc;?>
						</span>
					<?php } ?>
					<div class="clearfix"></div>
				</div>
			<?php } ?>

			<?php if($col_name) { ?>
				<div class="content">
					<div class="at-content">
					<?php if($col_name == "two") { ?>
						<div id="at-wrap">
							<div id="at-main">
					<?php } ?>
			<?php } ?>

<?php
if (!defined('_GNUBOARD_')) exit; // can not connect self 
?>


<div class="sidebar-misc">

	<!-- Sidebar User Panel -->
	<?php if($is_member) { // login status ?>
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo ($member['photo']) ? $member['photo'] : THEMA_URL.'/assets/img/photo.png';?>" class="img-circle cursor" alt="" onclick="win_memo('<?php echo $at_href['myphoto'];?>');" title="upload myphoto">
			</div>
			<div class="pull-left info">
				<p><?php echo $member['mb_nick'];?></p>
				<span class="font-12 ko-11">
					<a><?php echo $member['grade'];?></a>
					&nbsp;
					<a href="<?php echo $at_href['logout'];?>">
						<i class="fa fa-circle text-primary"></i> &nbsp;Logout
					</a>
				</span>
			</div>

			<div class="clearfix"></div>

			<?php if($member['admin'] || $member['partner']) { ?>
				<div class="sidebar-form btn-group btn-group-justified" style="margin:10px 0px 0px">
					<?php if($member['admin']) { ?>
						<a href="<?php echo G5_ADMIN_URL;?>" class="btn btn-flat btn-xs" style="height:auto;">
							<i class="fa fa-gear"></i> Manager
						</a>
					<?php } ?>
				</div>
			<?php } ?>

			<div class="progress progress-striped xs cursor" style="margin:10px 0px 0px;"  data-original-title="레벨업까지 <?php echo number_format($member['exp_up']);?>점 남았습니다." data-toggle="tooltip" data-placement="bottom" data-html="true">
				<div class="progress-bar progress-bar-blue" style="width: <?php echo round($member['exp_per']);?>%;"></div>
			</div>

			<ul class="sidebar-list no-margin" style="padding:10px 5px 0px;">
			<li>
				<span class="pull-right">
					Exp <?php echo number_format($member['exp']);?> (<?php echo $member['exp_per'];?>%)
				</span>
				Level <?php echo $member['level'];?> 
			</li>
			<li>
				<a href="<?php echo $at_href['point'];?>" target="_blank" class="win_point">
					<span class="pull-right">
						<?php echo number_format($member['mb_point']);?> Point
					</span>
					<?php echo AS_MP;?> 
				</a>
			</li>
			
			<li class="msgLabel"<?php echo ($member['response'] || $member['memo']) ? '' : ' style="display:none;"';?>>
				<a class="cursor" data-toggle="control-sidebar" onclick="miso_msg();">
					<span class="pull-right">
						<b class="orangered msgCount"><?php echo number_format($member['response'] + $member['memo']);?></b> 개
					</span>
					알림
				</a>
			</li>
			</ul>

		</div>

	<?php } else { // logout status ?>
		<!--
		<form id="miso_sidelogin" name="miso_sidelogin" method="post" action="<?php echo $at_href['login_check'];?>" autocomplete="off" class="form" onsubmit="return miso_sidelogin_form(this);">
		<input type="hidden" name="url" value="<?php echo $urlencode; ?>">
		
			<div class="media no-margin en">
				<div class="sidebar-form pull-right" style="width:60px; margin:10px 10px 0px 0px;">
					<button type="submit" class="btn btn-flat btn-block" tabindex="43" style="height:78px;"><i class="fa fa-power-off fa-2x"></i></button> 
				</div>
				<div class="media-body">
					<div class="sidebar-form" style="margin:10px 5px 0px 10px;">
						<div class="input-group">
							<input type="text" name="mb_id" id="mb_id" class="form-control sidebar-input" placeholder="User ID" tabindex="41">
							<span class="input-group-btn">
								<button type="button" class="btn btn-flat sidebar-input-text"><i class="fa fa-user"></i></button>
							</span>
						</div>
					</div>
					<div class="sidebar-form" style="margin:5px 5px 0px 10px;">
						<div class="input-group">
							<input type="password" name="mb_password" id="mb_password" class="form-control sidebar-input" placeholder="Password" tabindex="42">
							<span class="input-group-btn">
								<button type="button" class="btn btn-flat sidebar-input-text"><i class="fa fa-lock"></i></button>
							</span>
						</div>
					</div>
				</div>
			</div>
	-->
			<ul class="sidebar-list" style="padding:0px; margin:10px 10px 5px; letter-spacing:-1px;" >
				<li class="sidebar-text">
					
				

					<span class="">
						<a href="<?php echo G5_BBS_URL ?>/login.php">
							<span class="sidebar-text">Login</span>
						</a>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<a href="<?php echo $at_href['reg'];?>">
							<span class="sidebar-text">Sign up</span>
						</a>
						&nbsp;&nbsp;|&nbsp;&nbsp;
						<a href="<?php echo $at_href['lost'];?>" class="win_password_lost">
							<span class="sidebar-text">Find my info</span>
						</a>
					</span>
					<div class="clearfix"></div>
				</li>
			</ul>	
		<!--</form>-->
	<?php } ?>

</div>

<!-- =============================================== -->

<!-- Sidebar Menu -->

<ul class="sidebar-menu">
<!-- Main Menu -->
<li class="header en">MAIN NAVIGATION</li>
<li class="treeview<?php echo ($is_index) ? ' active' : '';?>">
	<a href="<?php echo $at_href['main'];?>">
		<i class="fa fa-home"></i><span>Main</span>
	</a>
</li>

<?php 
//Default FA icon
$fa1 = '<i class="fa fa-circle"></i>'; //main menu
$fa2 = '<i class="fa fa-circle-o"></i>'; //sub menu
$fa3 = '<i class="fa fa-genderless"></i>'; //subsub menu

for ($i=1; $i < $menu_cnt; $i++) { //meun echo - Output from No.1
?>
	<li class="treeview<?php echo ($menu[$i]['on'] == "on") ? ' active' : '';?>">
		<a href="<?php echo $menu[$i]['href'];?>"<?php echo $menu[$i]['target'];?> class="<?php echo $menu[$i]['new'];?>">
			<?php echo ($menu[$i]['icon']) ? $menu[$i]['icon'] : $fa1;?><span><?php echo $menu[$i]['menu'];?></span>
			<?php if($menu[$i]['new'] == "new") { // echo new post ?>
				<small class="label pull-right bg-<?php echo $narr[($i + 10)%10];?> en">new</small>
			<?php } else if($menu[$i]['is_sub']) { // submenu ?>
				<i class="fa fa-angle-left pull-right"></i>
			<?php } ?>
		</a>
		<?php if($menu[$i]['is_sub']) { //submenu ?>
			<ul class="treeview-menu">
			<?php //sub roop
				for($j=0; $j < count($menu[$i]['sub']); $j++) { 
					$ns = substr($j, 0, -1); 
			?>
				<li<?php echo ($menu[$i]['sub'][$j]['on'] == "on") ? ' class="active"' : '';?>>
					<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>"<?php echo $menu[$i]['sub'][$j]['target'];?> class="<?php echo $menu[$i]['sub'][$j]['new'];?>">
						<?php if($menu[$i]['sub'][$j]['new'] == "new") { // new output ?>
							<small class="label pull-right bg-<?php echo $narr[($j + 10)%10];?> en">new</small>
						<?php } else if($menu[$i]['sub'][$j]['is_sub']) { // sub menu ?>
							<i class="fa fa-angle-left pull-right"></i>
						<?php } ?>
						<?php echo ($menu[$i]['sub'][$j]['icon']) ? $menu[$i]['sub'][$j]['icon'] : $fa2;?><span><?php echo $menu[$i]['sub'][$j]['menu'];?></span>
					</a>
					<?php if($menu[$i]['sub'][$j]['is_sub']) { // when there is sub menu ?>
						<ul class="treeview-menu">
						<?php //서서브 루프 
							for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) { 
						?>
							<li<?php echo ($menu[$i]['sub'][$j]['sub'][$k]['on'] == "on") ? ' class="active"' : '';?>>
								<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?> class="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['new'];?>">
									<?php if($menu[$i]['sub'][$j]['sub'][$k]['new'] == "new") { ?>
										<small class="label pull-right bg-<?php echo $narr[($k + 10)%10];?> en">new</small>
									<?php } ?>
									<?php echo ($menu[$i]['sub'][$j]['sub'][$k]['icon']) ? $menu[$i]['sub'][$j]['sub'][$k]['icon'] : $fa3;?><span><?php echo $menu[$i]['sub'][$j]['sub'][$k]['menu'];?></span>
								</a>
							</li>
						<?php } ?>
						</ul>
					<?php } ?>
				</li>
			<?php } ?>
			</ul>
		<?php } ?>
	</li>
<?php } ?>

<!-- SIDE Menu -->
<li class="header en">SIDE NAVIGATION</li>
<?php if($is_member) { // when login ?>
	<li class="treeview">
		<a href="#">
			<i class="fa fa-angle-left pull-right"></i>
			<i class="fa fa-user"></i><span>My menu</span>
		</a>
		<ul class="treeview-menu">
			<li>
				<a href="<?php echo $at_href['mypage']; ?>">
					<i class="fa fa-dashboard"></i><span>My page</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $at_href['response'];?>" target="_blank" class="win_memo">
					<i class="fa fa-retweet"></i><span>My post reaction</span>
				</a>		
			</li>
			<li>
				<a href="<?php echo $at_href['memo'];?>" target="_blank" class="win_memo">
					<i class="fa fa-envelope-o"></i><span>Note</span>
				</a>		
			</li>
			<li>
				<a href="<?php echo $at_href['follow'];?>" target="_blank" class="win_memo">
					<i class="fa fa-users"></i><span>Follow</span>
				</a>		
			</li>
			<li>
				<a href="<?php echo $at_href['scrap'];?>" target="_blank" class="win_scrap">
					<i class="fa fa-clone"></i><span>Scrap</span>
				</a>		
			</li>
			<li>
				<a href="<?php echo $at_href['mypost']; ?>" target="_blank" class="win_memo">
					<i class="fa fa-pencil"></i><span>My post</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $at_href['myphoto'];?>" target="_blank" class="win_memo">
					<i class="fa fa-camera"></i><span>Photo Upload</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $at_href['edit'];?>">
					<i class="fa fa-user-plus"></i><span>Edit info</span>
				</a>
			</li>
			<li>
				<a href="<?php echo $at_href['leave'];?>" class="leave-me">
					<i class="fa fa-sign-out"></i><span>Leave</span>
				</a>
			</li>
		</ul>
	</li>
<?php } ?>

<li class="treeview">
	<a href="#">
		<i class="fa fa-angle-left pull-right"></i>
		<i class="fa fa-search"></i><span>Search</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<a href="<?php echo $at_href['search'];?>">
				<i class="fa fa-pencil"></i><span>Post Search</span>
			</a>
		</li>
		<li>
			<a href="<?php echo $at_href['tag'];?>">
				<i class="fa fa-tags"></i><span>Tag Search</span>
			</a>
		</li>
		<li>
			<a href="<?php echo $at_href['new'];?>">
				<i class="fa fa-bars"></i><span>New Post</span>
			</a>
		</li>
	</ul>
</li>
<li class="treeview">
	<a href="#">
		<i class="fa fa-angle-left pull-right"></i>
		<i class="fa fa-book"></i><span>How to Use</span>
	</a>
	<ul class="treeview-menu">
		<li>
			<a href="<?php echo G5_BBS_URL;?>/page.php?hid=intro">
				<i class="fa fa-leaf"></i><span>About us</span>
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL;?>/page.php?hid=provision">
				<i class="fa fa-credit-card"></i><span>TOS</span>
			</a>
		</li>	
		<li>
			<a href="<?php echo G5_BBS_URL;?>/page.php?hid=privacy">
				<i class="fa fa-user"></i><span>Privacy Policy</span>
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL;?>/page.php?hid=noemail">
				<i class="fa fa-ban"></i><span>Email Spam</span>
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL;?>/page.php?hid=guide">
				<i class="fa fa-info-circle"></i><span>How to use</span>
			</a>
		</li>
		<!--
		<li>
			<a href="<?php echo $at_href['faq'];?>">
				<i class="fa fa-commenting"></i><span>FAQ</span>
			</a>
		</li>
		
		<li>
			<a href="<?php echo G5_BBS_URL;?>/current_connect.php">
				<i class="fa fa-link"></i><span>Current connect</span>
			</a>
		</li>
		-->
		<li>
			<a href="<?php echo $at_href['secret'];?>">
				<i class="fa fa-user-secret"></i><span>1:1 QnA</span>
			</a>
		</li>
	</ul>
</li>
</ul>

<!-- =============================================== -->

<div class="sidebar-misc">

	<!-- search form -->
	<form name="allsearch" method="get" onsubmit="return tsearch_submit(this);" class="sidebar-form en">
	<input type="hidden" name="url" value="<?php echo (IS_SHOP) ? $at_href['isearch'] : $at_href['search'];?>">
		<div class="input-group">
			<input type="text" name="stx" class="form-control sidebar-input" value="<?php echo $stx;?>" placeholder="<?php echo (IS_SHOP) ? 'Item' : 'Post';?> Search...">
			<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
			</span>
		</div>
	</form>
	<!-- /.search form -->

</div>
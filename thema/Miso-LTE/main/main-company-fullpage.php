<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wshid = 'lte-cpfp';

// 메뉴버튼색 : darkred, crimson, red, orangered, orange, green, lightgreen, deepblue, blue, skyblue, navy, violet, yellow, darkgray, gray, lightgray, black, white
$menucolor = 'black';

// 헤더라인색 : darkred, crimson, red, orangered, orange, green, lightgreen, deepblue, blue, skyblue, navy, violet, yellow, darkgray, gray, lightgray, black, white
$headline = 'orangered';

// 경로설정
$main_url = THEMA_URL.'/main/fullpage';

?>

<link rel="stylesheet" type="text/css" href="<?php echo $main_url;?>/jquery.fullpage.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $main_url;?>/style.css" />
<script type="text/javascript" src="<?php echo $main_url;?>/jquery.fullpage.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#fullpage').fullpage({
			anchors: ['Page1', 'Page2', 'Page3', 'Page4', 'Page5'],
			menu: '#fullpage-menu',
			css3: true,
			scrollBar: false,
			verticalCentered: false,
			scrollOverflow: true,
			navigation: true,
			navigationPosition: 'right',
			slidesNavigation: true
		});

		$("#fullpage-menu a, .toggle-fullpage-nav").click(function(){
			$(".btn-fullpage-nav").toggleClass("active");
			$(".wrap-fullpage-nav").toggleClass("active");
		});
	});
</script>

<style>
	/* 페이지 배경설정 */
	#pagetitle { height:100%; }
	#pagetitle .carousel-inner { height:100%; }
	#pagetitle .carousel-inner .item { height:100%; }
	#pagetitle .item-1 { background: url('<?php echo $main_url;?>/img/bg1.jpg') no-repeat; background-size: cover; }
	#pagetitle .item-2 { background: url('<?php echo $main_url;?>/img/bg2.jpg') no-repeat; background-size: cover; }
	#pagetitle .item-3 { background: url('<?php echo $main_url;?>/img/bg3.jpg') no-repeat; background-size: cover; }
	#pagetitle .page-cell { padding:0px 0px 100px; }
	#section4 {
		background: url('<?php echo $main_url;?>/img/bg2.jpg') no-repeat; background-size: cover;
	}
</style>

<!-- Nav //-->
<div class="btn-fullpage-nav toggle-fullpage-nav">
	<a class="trans-bg-<?php echo $menucolor;?>" onclick="return false;" href="#">
		<i class="fa fa-angle-down fa-2x"></i>
	</a>
</div>

<div class="wrap-fullpage-nav en trans-bg-black">
	<div class="fullpage-nav">
		<div class="fullpage-nav-box">
			<div class="fullpage-nav-cell">
				<ul id="fullpage-menu">
					<li data-menuanchor="Page1" class="active"><a href="#Page1">Home</a></li>
					<li data-menuanchor="Page2"><a href="#Page2">Works</a></li>
					<li data-menuanchor="Page3"><a href="#Page3">Posts</a></li>
					<li data-menuanchor="Page4"><a href="#Page4">Company</a></li>
					<li data-menuanchor="Page5"><a href="#Page5">Contact</a></li>
					<li>
						<a class="toggle-fullpage-nav" onclick="return false;" href="#">
							<i class="fa fa-angle-up"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!--// End -->

<div id="fullpage" class="bg-white">

	<!-- Start //-->
	<div class="section" id="section0">

		<!-- Carousel Start //-->
		<div id="pagetitle" class="carousel slide" data-ride="carousel" data-pause="false">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#pagetitle" data-slide-to="0" class="active"></li>
				<li data-target="#pagetitle" data-slide-to="1"></li>
				<li data-target="#pagetitle" data-slide-to="2"></li>
			</ol>
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item item-1 active">
					<div class="page-box">
						<div class="page-cell cell-middle text-center">
							<img src="<?php echo $main_url;?>/img/logo.png" style="max-width:100%;">
						</div>
					</div>
				</div>
				<div class="item item-2">
					<div class="page-box">
						<div class="page-cell cell-middle text-center">

							<div class="trans-bg-black" style="padding:20px 15px 30px;">	

								<h1 class="en white">
									MISO-LTE THEMA
								</h1>

								<div class="h10"></div>
								
								<h3 class="en white" style="line-height:140%;">
									데모 사이트 <span style="color:yellowgreen;">상단 우측의 <i class="fa fa-desktop"></i> 아이콘</span>을 클릭하면
									
									<div class="h10"></div>
									
									테마설정에 대한 미리보기와 저장 후 적용이 가능합니다.
								</h3>

							</div>

						</div>
					</div>
				</div>
				<div class="item item-3">
					<div class="page-box page-bg">
						<div class="page-cell cell-middle">

							<div class="page-widget widget-white">
								<div class="trans-bg-black" style="padding:30px;">

									<h1 class="en text-center">
										Contact
									</h1>
									
									<div class="h30"></div>

									<div class="row">
										<div class="col-sm-6">
					
											<!-- Start //-->
											<h3 class="div-title-underbar white">
												<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
													Help Desk
												</span>
											</h3>
											<div class="widget-box text-center">

												<h1 class="en lightgreen" style="font-size:3.2em; letter-spacing:-1px;">
													<i class="fa fa-phone-square"></i> 000.0000.0000
												</h1>

												<div class="h10"></div>

												<p>
													월-금 : 9:30 ~ 17:30, 토/일/공휴일 휴무
													<br>
													런치타임 : 12:30 ~ 13:30
												</p>
											
											</div>
											<!--// End -->

										</div>
										<div class="col-sm-6">

											<!-- Start //-->
											<h3 class="div-title-underbar white">
												<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
													E-mail
												</span>
											</h3>
											<div class="widget-box text-center">

												<h3 class="en">
													<i class="fa fa-envelope-square"></i> WebMaster@email.com
												</h3>

												<div class="h20"></div>

												<p class="text-center">
													<a href="<?php echo $at_href['secret'];?>" class="btn btn btn-trans">
														<i class="fa fa-commenting"></i> 1:1 INQUIRY
													</a>
												</p>
												
											</div>
											<!--// End -->

										</div>
									</div>

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#pagetitle" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#pagetitle" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>

		</div>
		<div class="clearfix"></div>
		<!--// End Carousel -->
	
	</div>
	<!--// End -->

	<!-- Start //-->
	<div class="section" id="section1">
		<div class="page-box page-blue">
			<div class="page-cell cell-middle">

				<h1 class="en text-center white">
					New Works
				</h1>
				
				<div class="h30"></div>

				<?php echo apms_widget('miso-post-gallery', $wshid.'-gallery-m1', 'rows=6 lg=3 md=3 caption=3 gap=0 gapb=0'); ?>

				<div class="h40"></div>

				<p class="text-center">
					<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic" class="btn btn-lg btn-trans">
						MORE VIEW
					</a>
				</p>

			</div>
		</div>
	</div>
	<!--// End -->

	<!-- Start //-->
	<div class="section" id="section2">
		<div class="page-box page-dark">
			<div class="page-cell cell-middle">

				<div class="page-widget widget-white">
					<h1 class="en text-center">
						New Posts
					</h1>
					
					<div class="h30"></div>

					<div class="row">
						<div class="col-md-4">
	
							<!-- Start //-->
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
								<h3 class="div-title-underbar white">
									<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
										Specials
									</span>
									<span class="pull-right p-more">
										+ more
									</span>
								</h3>
							</a>
							<div class="widget-box">
								<?php echo apms_widget('miso-post-webzine', $wshid.'-webzine-m1', 'rows=4 item=1 lg=1 md=1 sm=1 date=1 bold=1'); ?>
							</div>
							<!--// End -->

						</div>
						<div class="col-md-4">

							<!-- Start //-->
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
								<h3 class="div-title-underbar white">
									<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
										Posts
									</span>
									<span class="pull-right p-more">
										+ more
									</span>
								</h3>
							</a>
							<div class="widget-box">
								<?php echo apms_widget('miso-post-multi', $wshid.'-multi-m1', 'irows=1 thumb_w=400 thumb_h=225 rows=8 caption=2 date=1 center=1 rdm=1 icon={아이콘:caret-right}'); ?>
							</div>
							<!--// End -->

						</div>
						<div class="col-md-4">

							<!-- Start //-->
							<a href="<?php echo $at_href['new'];?>?view=c">
								<h3 class="div-title-underbar white">
									<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
										Comments
									</span>
									<span class="pull-right p-more">
										+ more
									</span>
								</h3>
							</a>
							<div class="widget-box">
								<?php echo apms_widget('miso-post-icon', $wshid.'-comment-s1', 'comment=1'); ?>
							</div>
							<!--// End -->

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!--// End -->

	<!-- Start //-->
	<div class="section" id="section3">

		<div class="section-slide" id="slide1">

			<div class="page-box">
				<div class="page-cell cell-middle">

					<div class="page-widget">
						<h1 class="en text-center">
							Company
						</h1>
						
						<div class="h30"></div>

						<div class="row">
							<div class="col-md-4">
		
								<!-- Start //-->
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<h3 class="div-title-underbar">
										<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
											Event
										</span>
										<span class="pull-right p-more">
											+ more
										</span>
									</h3>
								</a>
								<div class="widget-box">
									<?php echo apms_widget('miso-post-owl', $wshid.'-event-s1', 'rows=5 item=1 lg=1 md=3 sm=2 nav=1 rdm=1 caption=2 thumb_w=400 thumb_h=300'); ?>
								</div>
								<!--// End -->

							</div>
							<div class="col-md-4">

								<!-- Start //-->
								<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
									<h3 class="div-title-underbar">
										<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
											Notice
										</span>
										<span class="pull-right p-more">
											+ more
										</span>
									</h3>
								</a>
								<div class="widget-box">
									<?php echo apms_widget('miso-post-mix', $wshid.'-notice-m1', 'rows=6 date=1 bold=1 rdm=1 icon={아이콘:bell}'); ?>
								</div>
								<!--// End -->

							</div>
							<div class="col-md-4">

								<!-- Start //-->
								<a href="<?php echo $at_href['new'];?>?view=c">
									<h3 class="div-title-underbar">
										<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
											Q & A
										</span>
										<span class="pull-right p-more">
											+ more
										</span>
									</h3>
								</a>
								<style>
									.fix-lineheight ul li { line-height:23px !important; }
								</style>
								<div class="widget-box fix-lineheight">
									<?php echo apms_widget('miso-post-list', $wshid.'-list-m1', 'rows=10 date=1 icon={아이콘:caret-right}'); ?>
								</div>
								<!--// End -->

							</div>
						</div>

						<!-- Start //-->
						<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=basic">
							<h3 class="div-title-underbar">
								<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
									Partner
								</span>
								<span class="pull-right p-more">
									+ more
								</span>
							</h3>
						</a>
						<div class="widget-box">
							<?php echo apms_widget('miso-post-owl', $wshid.'-event-s1', 'rows=8 item=4 lg=4 md=3 sm=2 xs=2 nav=1 rdm=1 caption=3 thumb_w=400 thumb_h=200 auto=0'); ?>
						</div>
						<!--// End -->

					</div>
		
				</div>
			</div>
		</div>

		<div class="section-slide" id="slide2">

			<div class="page-box">
				<div class="page-cell">

					<!-- Start //-->
					<div class="page-content">
						<h3 class="div-title-underbar">
							<span class="div-title-underbar-bold border-<?php echo $headline;?>">
								CEO 인사말
							</span>
						</h3>

						<br>	

						<div class="row">
							<div class="col-sm-4 text-center">
								<img src="<?php echo $main_url;?>/img/greeting.jpg" style="max-width:100%;">
								<div class="h15"></div>
							</div>
							<div class="col-sm-8">
								<h4 class="slogan color">
									<i class="fa fa-quote-left"></i>
									행복을 창조하는 기업
									<i class="fa fa-quote-right"></i>
								</h4>

								<p>환영합니다.</p>

								<p>도전이 있어 변화가 있고, 변화가 있어 발전이 있는 기업이 되고자 합니다.<p> 

								<p>새로운 삶의 가치와 트렌드로 여러분의 라이프스타일을 디자인하며, 'Life Innovation' 구현에 가치를 두고 있는 기업입니다.</p>

								<p>현대인들의 새로운 삶의 가치와 미래를 제시하는 기업이지만, 고객행복이 우선이라는 이념 아래 고객 여러분의 활력을 위한 삶의 휴식처, 행복을 위한 생활문화공간을 만들도록 더욱 노력하겠습니다.</p>

								<p>앞으로도 변함없는 관심과 성원을 부탁드리며, 오늘도 웃음과 행복이 가득한 하루 되시길 바랍니다.</p>

								<p>감사합니다.</p>

								<p>대표이사 CEO 홍 길 동</p>
							</div>
						</div>
					</div>
					<!--// End -->
				
				</div>
			</div>
		</div>

	    <div class="section-slide" id="slide3">

			<div class="page-box">
				<div class="page-cell">

					<!-- Start //-->
					<div class="page-content">
						<h3 class="div-title-underbar">
							<span class="div-title-underbar-bold border-<?php echo $headline;?>">
								회사개요
							</span>
						</h3>

						<br>	

						<h4 class="slogan color">
							<i class="fa fa-quote-left"></i>
							Life Innovation
							<i class="fa fa-quote-right"></i>
						</h4>

						<p>우리는 모두의 행복과 더 좋은 미래를 위해 "라이프 이노베이션(Life Innovation)"을 지향합니다.</p>

						<p>우리의 비전인 "라이프 이노베이션(Life Innovation)이란?<br>
						단순히 삶의 질을 업그레이드하는 차원이 아니라 여러분의 개성과 취향에 맞는 새로운 라이프 스타일을 창조하고 찾아드리는 것을 의미합니다.</p>

						<p>우리는 창조와 혁신이라는 두개의 키워드를 적극적으로 실천함으로 새로운 라이프스타일을 창조하고 혁신하는 기업이 되고자 합니다.</p>


						<ul class="list-inline div-ring">
							<li>
								<div class="ring-item bg-red">
									<h4 class="div-title-underline-thin border-white">
										기업이념
									</h4>
									<p>새로운 삶의 가치와<br> 미래창조</p>
								</div>
							</li>
							<li>
								<div class="ring-item bg-blue">
									<h4 class="div-title-underline-thin border-white">
										기업비전
									</h4>
									<p>Life Innonation<br> 라이프 이노베이션</p>
								</div>
							</li>
							<li>
								<div class="ring-item bg-orange">
									<h4 class="div-title-underline-thin border-white">
										비전추진
									</h4>
									<p>Creation & Innovation<br> 창조와 혁신</p>
								</div>
							</li>
							<li>
								<div class="ring-item bg-green">
									<h4 class="div-title-underline-thin border-white">
										비전목표
									</h4>
									<p>4C HAPPINESS<br> 고객/회사/지역/협력</p>
								</div>
							</li>
						</ul>

						<div class="table-responsive">
							<table class="table">
							<colgroup>
								<col width="120">
							</colgroup>
							<tr>
								<th class="active">회사명</th>
								<td>OOOO 주식회사</td>
							</tr>
							<tr>
								<th class="active" style="width:120px;">대표이사</th>
								<td style="min-width:400px;">홍 길 동</td>
							</tr>
							<tr>
								<th class="active">소재지</th>
								<td>서울특별시 중구 세종대로 110</td>
							</tr>
							<tr>
								<th class="active">설립일</th>
								<td>2013년 1월 1일</td>
							</tr>
							<tr>
								<th class="active">자본금</th>
								<td>1,000,000,000원 (2014년 12월말 기준)</td>
							</tr>
							<tr>
								<th class="active">임직원</th>
								<td>100명 (2014년 12월말 기준)</td>
							</tr>
							<tr>
								<th class="active">주요주주</th>
								<td>OOOO공사, OOOO유통, OOOO건설, OOOO개발, OOOO서비스</td>
							</tr>
							<tr>
								<th class="active">주요사업</th>
								<td>소프트웨어 개발, 전자상거래, 커뮤니티</td>
							</tr>
							<tr>
								<th class="active">대표전화</th>
								<td>02-000-0000 / FAX 02-000-0000</td>
							</tr>
							</table>
						</div>
					</div>
					<!--// End -->

				</div>
			</div>
		</div>

		<div class="section-slide" id="slide4">

			<div class="page-box">
				<div class="page-cell">

					<!-- Start //-->
					<div class="page-content">
						<h3 class="div-title-underbar">
							<span class="div-title-underbar-bold border-<?php echo $headline;?>">
								사업영역
							</span>
						</h3>

						<br>	

						<h4 class="slogan color text-center">
							<i class="fa fa-quote-left"></i>
							Life Innovation
							<i class="fa fa-quote-right"></i>
						</h4>

						<ul class="list-inline div-ring">
							<li>
								<div class="ring-item bg-red">
									<h4 class="div-title-underline-thin border-white">
										개발사업
									</h4>
									<p>소프트웨어 개발<br> IT/WEB/APP</p>
								</div>
							</li>
							<li>
								<div class="ring-item bg-blue">
									<h4 class="div-title-underline-thin border-white">
										전자상거래
									</h4>
									<p>OOOO 쇼핑몰<br> www.shop.co.kr</p>
								</div>
							</li>
							<li>
								<div class="ring-item bg-green">
									<h4 class="div-title-underline-thin border-white">
										커뮤니티
									</h4>
									<p>OOOO 커뮤니티<br>www.talk.co.kr</p>
								</div>
							</li>
						</ul>

						<div class="table-responsive">
							<table class="table">
							<colgroup>
								<col width="120">
								<col width="140">
							</colgroup>
							<tr class="active">
								<th>사업분야</th>
								<th>사업항목</th>
								<th>주요내용</th>
							</tr>
							<tr>
								<th rowspan="4">개발사업</th>
								<td>에이전시 사업</td>
								<td>웹/앱 외주제작 대행사업</td>
							</tr>
							<tr>
								<td>솔류션 사업</td>
								<td>웹/앱 소트트웨어 개발 및 판매사업</td>
							</tr>
							<tr>
								<td>광고사업</td>
								<td>개발 제품 내 배너를 통한 광고</td>
							</tr>
							<tr>
								<td>위탁관리 사업</td>
								<td>솔루션, 소프트웨어 위탁관리 및 운영</td>
							</tr>

							<tr>
								<th rowspan="2">전자상거래</th>
								<td>쇼핑몰 사업</td>
								<td>OOOO 쇼핑몰 운영</td>
							</tr>
							<tr>
								<td>위탁판매 사업</td>
								<td>협력 쇼핑몰 판매대행 사업</td>
							</tr>

							<tr>
								<th rowspan="2">커뮤니티</th>
								<td>커뮤니티 사업</td>
								<td>OOOO 커뮤니티 운영</td>
							</tr>
							<tr>
								<td>서비스 제휴사업</td>
								<td>광고, 미디어, 상품, 검색 등 서비스 제휴 사업</td>
							</tr>
							</table>
						</div>
					</div>
					<!--// End -->

				</div>
			</div>
		</div>

		<div class="section-slide" id="slide5">

			<div class="page-box">
				<div class="page-cell">

					<!-- Start //-->
					<div class="page-content">
						<h3 class="div-title-underbar">
							<span class="div-title-underbar-bold border-<?php echo $headline;?>">
								연혁
							</span>
						</h3>

						<br>

						<p>고객행복과 건전한 이윤 창출을 통해 글로벌 기업으로 나아가는 우리의 발자취입니다.</p>

						<div class="div-tab tabs trans-top history">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#history" data-toggle="tab">회사연역</a></li>
								<li><a href="#award" data-toggle="tab">수상내역</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="history">

									<!-- 회사연혁 -->
									<div class="table-responsive">
										<table class="table">
										<colgroup>
											<col width="80">
											<col width="60">
										</colgroup>
										<tr class="active">
											<th>년</th>
											<th>월</th>
											<th>주요내용</th>
										</tr>

										<!-- 2015년도 -->
										<tr>
											<th class="en color">2015</th>
											<th class="en">06</th>
											<td>정보보호관리체계(ISMS) 인증 획득 (한국인터넷진흥원)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">05</th>
											<td>'OOOO 주식회사'와 전략적 업무제휴 체결</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">04</th>
											<td>'OOOO 소프트웨어' 국제공통평가기준(CC) 인증 획득</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">02</th>
											<td>벤처사회적책임경영 인증 (벤처기업협회)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">02</th>
											<td>'OOOO 소프트웨어' Good Software 인증 획득 (한국정보통신기술협회)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">01</th>
											<td>'OOOO 소프트웨어' 출시</td>
										</tr>

										<!-- 2014년도 -->
										<tr>
											<th class="en color">2014</th>
											<th class="en">12</th>
											<td>기술혁신형 중소기업(INNO-BIZ) 확인</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">12</th>
											<td>우량기술기업 선정(기술신용보증기금)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">10</th>
											<td>벤처기업 확인(서울지방중소기업청장)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">07</th>
											<td>유상 증자 (자본금 450,000,000원)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">03</th>
											<td>사옥 이전 (서울특별시 중구 세종대로 110)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">03</th>
											<td>'OOOO 주식회사'와 'OOOO 프로그램' 개발을 위한 컨소시엄 결성</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">01</th>
											<td>'OOOO 소프트웨어' 출시</td>
										</tr>

										<!-- 2013년도 -->
										<tr>
											<th class="en color">2013</th>
											<th class="en">12</th>
											<td>기술혁신형 중소기업(INNO-BIZ) 확인</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">12</th>
											<td>우량기술기업 선정(기술신용보증기금)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">10</th>
											<td>벤처기업 확인(서울지방중소기업청장)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">08</th>
											<td>액면 분할 (자본금 225,000,000원)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">07</th>
											<td>유상 증자 (자본금 150,000,000원)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">05</th>
											<td>병역 특례 업체로 지정 (서울 지방 병무청)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">03</th>
											<td>사옥 이전 (서울특별시 중구 세종대로 110)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">02</th>
											<td>'OOOO 주식회사'와 'OOOO 프로그램' 개발을 위한 컨소시엄 결성</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">01</th>
											<td>'OOOO 주식회사' 설립 (서울특별시 중구 세종대로 110) (자본금 50,000,000원)</td>
										</tr>

										</table>
									</div>
								</div>
								<div class="tab-pane" id="award">

									<!-- 수상내역 -->
									<div class="table-responsive">
										<table class="table">
										<colgroup>
											<col width="80">
											<col width="60">
										</colgroup>
										<tr class="active">
											<th>년</th>
											<th>월</th>
											<th>주요내용</th>
										</tr>

										<!-- 2015년도 -->
										<tr>
											<th class="en color">2015</th>
											<th class="en">06</th>
											<td>정보보호관리체계(ISMS) 인증 획득 (한국인터넷진흥원)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">04</th>
											<td>'OOOO 소프트웨어' 국제공통평가기준(CC) 인증 획득</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">02</th>
											<td>벤처사회적책임경영 인증 (벤처기업협회)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">02</th>
											<td>'OOOO 소프트웨어' Good Software 인증 획득 (한국정보통신기술협회)</td>
										</tr>

										<!-- 2014년도 -->
										<tr>
											<th class="en color">2014</th>
											<th class="en">12</th>
											<td>기술혁신형 중소기업(INNO-BIZ) 확인</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">12</th>
											<td>우량기술기업 선정(기술신용보증기금)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">10</th>
											<td>벤처기업 확인(서울지방중소기업청장)</td>
										</tr>

										<!-- 2013년도 -->
										<tr>
											<th class="en color">2013</th>
											<th class="en">12</th>
											<td>기술혁신형 중소기업(INNO-BIZ) 확인</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">12</th>
											<td>우량기술기업 선정(기술신용보증기금)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">10</th>
											<td>벤처기업 확인(서울지방중소기업청장)</td>
										</tr>
										<tr>
											<th class="blank"></th>
											<th class="en">05</th>
											<td>병역 특례 업체로 지정 (서울 지방 병무청)</td>
										</tr>

										</table>
									</div>
								</div>
							</div>
						</div>

					</div>
					<!--// End -->

				</div>
			</div>
		</div>

		<div class="section-slide" id="slide6">

			<div class="page-box">
				<div class="page-cell">

					<!-- Start //-->
					<div class="page-content">
						<h3 class="div-title-underbar">
							<span class="div-title-underbar-bold border-<?php echo $headline;?>">
								조직도
							</span>
						</h3>

						<br>	

						<div class="row">
							<div class="col-sm-6 col-sm-offset-3">
								<div class="person">
									<div class="img-wrap">
										<div class="img-item">
											<img src="<?php echo $main_url;?>/img/photo.jpg">
										</div>
									</div>
									<div class="person-desc">
										<div class="person-author">
											<div class="person-author-wrapper">
												<span class="person-name"><strong>홍 길 동</strong></span>
												<span class="person-title">대표이사 CEO</span>
											</div>
											<div class="person-social social-icon">
												<a title="Facebook" class="at-tip" href="http://facebook.com" target="_blank" data-toggle="tooltip" data-title="Facebook" data-placement="top" data-original-title="Facebook">
													<i class="fa fa-facebook"></i>
												</a>
												<a title="Twitter" class="at-tip" href="http://twitter.com" target="_blank" data-toggle="tooltip" data-title="Twitter" data-placement="top" data-original-title="Twitter">
													<i class="fa fa-twitter"></i>				
												</a>
												<a title="Google+" class="at-tip " href="http://google.com" target="_blank" data-toggle="tooltip" data-title="Google+" data-placement="top" data-original-title="Google+">
													<i class="fa fa-google-plus"></i>				
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<br>

						<div class="row">
							<div class="col-sm-4">
								<div class="person">
									<div class="img-wrap">
										<div class="img-item">
											<img src="<?php echo $main_url;?>/img/photo.jpg">
										</div>
									</div>
									<div class="person-desc">
										<div class="person-author">
											<div class="person-author-wrapper">
												<span class="person-name"><strong>홍 길 동</strong></span>
												<span class="person-title">이사 COO</span>
											</div>
											<div class="person-social social-icon">
												<a title="Facebook" class="at-tip" href="http://facebook.com" target="_blank" data-toggle="tooltip" data-title="Facebook" data-placement="top" data-original-title="Facebook">
													<i class="fa fa-facebook"></i>
												</a>
												<a title="Twitter" class="at-tip" href="http://twitter.com" target="_blank" data-toggle="tooltip" data-title="Twitter" data-placement="top" data-original-title="Twitter">
													<i class="fa fa-twitter"></i>				
												</a>
												<a title="Google+" class="at-tip " href="http://google.com" target="_blank" data-toggle="tooltip" data-title="Google+" data-placement="top" data-original-title="Google+">
													<i class="fa fa-google-plus"></i>				
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="person">
									<div class="img-wrap">
										<div class="img-item">
											<img src="<?php echo $main_url;?>/img/photo.jpg">
										</div>
									</div>
									<div class="person-desc">
										<div class="person-author">
											<div class="person-author-wrapper">
												<span class="person-name"><strong>홍 길 동</strong></span>
												<span class="person-title">이사 CFO</span>
											</div>
											<div class="person-social social-icon">
												<a title="Facebook" class="at-tip" href="http://facebook.com" target="_blank" data-toggle="tooltip" data-title="Facebook" data-placement="top" data-original-title="Facebook">
													<i class="fa fa-facebook"></i>
												</a>
												<a title="Twitter" class="at-tip" href="http://twitter.com" target="_blank" data-toggle="tooltip" data-title="Twitter" data-placement="top" data-original-title="Twitter">
													<i class="fa fa-twitter"></i>				
												</a>
												<a title="Google+" class="at-tip " href="http://google.com" target="_blank" data-toggle="tooltip" data-title="Google+" data-placement="top" data-original-title="Google+">
													<i class="fa fa-google-plus"></i>				
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="person">
									<div class="img-wrap">
										<div class="img-item">
											<img src="<?php echo $main_url;?>/img/photo.jpg">
										</div>
									</div>
									<div class="person-desc">
										<div class="person-author">
											<div class="person-author-wrapper">
												<span class="person-name"><strong>홍 길 동</strong></span>
												<span class="person-title">이사 CTO</span>
											</div>
											<div class="person-social social-icon">
												<a title="Facebook" class="at-tip" href="http://facebook.com" target="_blank" data-toggle="tooltip" data-title="Facebook" data-placement="top" data-original-title="Facebook">
													<i class="fa fa-facebook"></i>
												</a>
												<a title="Twitter" class="at-tip" href="http://twitter.com" target="_blank" data-toggle="tooltip" data-title="Twitter" data-placement="top" data-original-title="Twitter">
													<i class="fa fa-twitter"></i>				
												</a>
												<a title="Google+" class="at-tip " href="http://google.com" target="_blank" data-toggle="tooltip" data-title="Google+" data-placement="top" data-original-title="Google+">
													<i class="fa fa-google-plus"></i>				
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table">
							<colgroup>
								<col width="120">
								<col width="120">
								<col>
								<col width="120">
							</colgroup>
							<tr class="active">
								<th>부서</th>
								<th>팀/파트</th>
								<th>주요업무</th>
								<th>대표번호</th>
							</tr>
							<tr>
								<th rowspan="3">기획실</th>
								<td>경영기획팀</td>
								<td>경영기획 업무</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>영업기획팀</td>
								<td>영업기획 업무</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>개발기획팀</td>
								<td>개발기획 업무</td>
								<td>02-0000-0000</td>
							</tr>

							<tr>
								<th rowspan="3">마케팅실</th>
								<td>마케팅팀</td>
								<td>이벤트, 프로모션 등 마케팅 업무</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>홍보팀</td>
								<td>홍보 및 PR 업무</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>대외협력팀</td>
								<td>서비스 제휴, 협찬후원 업무</td>
								<td>02-0000-0000</td>
							</tr>

							<tr>
								<th rowspan="3">개발실</th>
								<td>솔루션</td>
								<td>솔루션 개발</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>WEB개발</td>
								<td>홍보 및 PR 업무</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>APP개발</td>
								<td>APP개발 업무</td>
								<td>02-0000-0000</td>
							</tr>

							<tr>
								<th rowspan="2">디자인실</th>
								<td>디자인팀</td>
								<td>디자인</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>제작팀</td>
								<td>사진, 영상 제작</td>
								<td>02-0000-0000</td>
							</tr>

							<tr>
								<th rowspan="2">e-Biz실</th>
								<td>쇼핑몰팀</td>
								<td>쇼핑몰 운영관리 업무</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>커뮤니티팀</td>
								<td>커뮤니티 운영관리 업무</td>
								<td>02-0000-0000</td>
							</tr>

							<tr>
								<th rowspan="3">운영지원실</th>
								<td>재무회계팀</td>
								<td>재무회계 업무</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>인사팀</td>
								<td>인사 업무</td>
								<td>02-0000-0000</td>
							</tr>
							<tr>
								<td>총무팀</td>
								<td>총무 및 관리지원업무</td>
								<td>02-0000-0000</td>
							</tr>


							</table>
						</div>
					</div>
					<!--// End -->

				</div>
			</div>
		</div>


		<div class="section-slide" id="slide7">

			<div class="page-box">
				<div class="page-cell">

					<!-- Start //-->
					<div class="page-content">

						<h3 class="div-title-underbar">
							<span class="div-title-underbar-bold border-<?php echo $headline;?>">
								인재상
							</span>
						</h3>

						<br>	

						<h4 class="slogan color text-center">
							<i class="fa fa-quote-left"></i>
							열정과 열린생각, 그리고 도전정신
							<i class="fa fa-quote-right"></i>
						</h4>

						<ul class="list-inline div-ring">
							<li>
								<div class="ring-item bg-red">
									<h4 class="div-title-underline-thin border-white">
										Creativity
									</h4>
									<p>창의적인 인재<br> 개선하려는 人</p>
								</div>
							</li>
							<li>
								<div class="ring-item bg-blue">
									<h4 class="div-title-underline-thin border-white">
										Loyality
									</h4>
									<p>의리가 있는 인재<br> 신의를 지키는 人</p>
								</div>
							</li>
							<li>
								<div class="ring-item bg-green">
									<h4 class="div-title-underline-thin border-white">
										Challenge
									</h4>
									<p>도전적인 인재<br> 좌절하지 않는 人</p>
								</div>
							</li>
						</ul>

						<div class="table-responsive">
							<table class="table">
							<colgroup>
								<col width="120">
								<col width="140">
							</colgroup>
							<tr class="active">
								<th>구분</th>
								<th>항목</th>
								<th>주요내용</th>
							</tr>
							<tr>
								<th rowspan="4">인사제도</th>
								<td>근무제도</td>
								<td>
									전일 야근자를 배려한 지연 출근제<br>
									특정일의 업무 수고를 보상하는 대체휴가제<br>
									직무만족도 조사를 통한 직무전환 기회 부여<br>
									학업병행 지원제
								</td>
							</tr>
							<tr>
								<td>보상체계</td>
								<td>
									월 급여 + 개인성과급 + 조직성과급<br>
									월 급여 : 기본급+시간외수당+식대(해당자에 한해 특별급, 육아수당, 가족수당, 직책수당 추가지급)<br>
									개인성과급 : 개인별 성과/역량/태도 평가결과에 따라 개인별 차등지급(연 1회)<br>
									조직성과급 : 팀/본부 성과에 따라 조직별 차등지급(연 1회)<br>
								</td>
							</tr>
							<tr>
								<td>교육제도</td>
								<td>
									신입사원 입문교육(OJT), 팀장 및 간부사원 온오프라인 계층교육 실시<br>
									직군별 정보 교류 & 지식 공유, 직원들의 역량 향상을 위한 직능교육 지원<br>
									교육비 및 멘토링 지원
								</td>
							</tr>
							<tr>
								<td>포상제도</td>
								<td>호봉 특진/직무발명/사내추천/학위취득 포상</td>
							</tr>

							<tr>
								<th rowspan="6">복리후생</th>
								<td>가족친화제도</td>
								<td>산후근속장려금 지급 및 출산휴가(남성, 여성), 출산선물, 육아휴직</td>
							</tr>
							<tr>
								<td>장기근속자 우대</td>
								<td>안식휴가 및 종합 건강검진 비용 지원</td>
							</tr>
							<tr>
								<td>건강관리 지원</td>
								<td>정기 건강검진 지원 및 단체보험 가입</td>
							</tr>
							<tr>
								<td>경조사 지원</td>
								<td>경조휴가, 경조금, 경조화환, 상조용품 지원</td>
							</tr>
							<tr>
								<td>축하이벤트</td>
								<td>졸업, 수습종료, 생일, 입학 축하이벤트</td>
							</tr>
							<tr>
								<td>기타 지원</td>
								<td>
									놀이동산, 래프팅, 영화관람 등 각종 단합행사 개최<br>
									사내 각종 축하파티 지원
								</td>
							</tr>
							</table>
						</div>

					</div>
					<!--// End -->
				
				</div>
			</div>
		</div>

	</div>
	<!--// End -->

	<!-- Start //-->
	<div class="section" id="section4">
		<div class="page-box page-bg">
			<div class="page-cell cell-middle">

				<div class="page-widget widget-white">
					<div class="trans-bg-black" style="padding:30px;">

						<h1 class="en text-center">
							Contact
						</h1>
						
						<div class="h30"></div>

						<div class="row">
							<div class="col-sm-6">
		
								<!-- Start //-->
								<h3 class="div-title-underbar white">
									<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
										Help Desk
									</span>
								</h3>
								<div class="widget-box text-center">

									<h1 class="en lightgreen" style="font-size:3.2em; letter-spacing:-1px;">
										<i class="fa fa-phone-square"></i> 000.0000.0000
									</h1>

									<div class="h10"></div>

									<p>
										월-금 : 9:30 ~ 17:30, 토/일/공휴일 휴무
										<br>
										런치타임 : 12:30 ~ 13:30
									</p>
								
								</div>
								<!--// End -->

							</div>
							<div class="col-sm-6">

								<!-- Start //-->
								<h3 class="div-title-underbar white">
									<span class="en div-title-underbar-bold border-<?php echo $headline;?>">
										E-mail
									</span>
								</h3>
								<div class="widget-box text-center">

									<h3 class="en">
										<i class="fa fa-envelope-square"></i> WebMaster@email.com
									</h3>

									<div class="h20"></div>

									<p class="text-center">
										<a href="<?php echo $at_href['secret'];?>" class="btn btn btn-trans">
											<i class="fa fa-commenting"></i> 1:1 INQUIRY
										</a>
									</p>
									
								</div>
								<!--// End -->

							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
	<!--// End -->

</div>

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 위젯 설정값 아이디 접두어 지정
$wshid = 'guide';

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
			autoScrolling: false,
			css3: true,
			fitToSection: false
		});
	});
</script>

<style>
	/* 페이지 배경설정 */
	#section0 {
		background: url('<?php echo $main_url;?>/img/bg3.jpg') no-repeat; background-size: cover;
	}
	#fullpage {
		margin-top:0px !important;
	}
</style>

<div id="fullpage" class="bg-white">

	<!-- Start //-->
	<div class="section" id="section0">
		<div class="page-box page-bg">
			<div class="page-cell cell-middle text-center">

				<div class="trans-bg-black" style="padding:30px 20px 40px; margin-top:-120px;">	

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
	<!--// End -->

</div>
<style>
	.page-widget {
		max-width:900px !important;
		line-height:24px;
	}
	.page-widget h1 {
		text-align:center;
		margin:30px 0px;
	}
	.page-widget ul {
		margin:0px;
		padding:0px;
		padding-left:20px;
	}
	.page-widget th {
		vertical-align:middle !important;
	}
</style>
<div class="bg-white">
	<div class="page-content page-widget">

		<h1 class="en">
			Notice
		</h1>

		<div class="table-responsive">
			<table class="table">
			<colgroup>
				<col width="180">
			</colgroup>
			<tr class="active">
				<th class="text-center">구분</th>
				<th class="text-center">주요내용</th>
			</tr>
			<tr>
				<th class="text-center">
					주의사항
				</th>
				<td>
					<ul>
						<li>본 테마는 <b class="orangered">아미나빌더 1.6.0 이상</b> 버전에서 사용할 수 있습니다.</li>
						<li>본 테마는 <b>커뮤니티(G5) 테마와 쇼핑몰(YC5 내 쇼핑몰 부분) 테마가 각각 별도</b>로 있습니다.</li>
					</ul>
				</td>
			</tr>
			<tr>
				<th class="text-center">
					지원기기
				</th>
				<td>
					<ul>
						<li>본 테마는 <b>Bootstrap 3.2</b> 기반에 아래 두 자료를 기본으로 제작되었습니다.

							<div class="bg-light" style="padding:8px 10px; margin:10px 0px; border:1px solid #ddd;">
								<b>AdminLTE 2.3.2</b> - <a href="https://github.com/almasaeed2010/AdminLTE" target="_blank">https://github.com/almasaeed2010/AdminLTE</a>
								<br>
								<b>fullPage.js 2.7.7</b> - <a href="https://github.com/alvarotrigo/fullPage.js" target="_blank">https://github.com/alvarotrigo/fullPage.js</a>
							</div>

						</li>
						<li>그래서 <b class="orangered">IE9++ 이상</b>, Chrome, Firefox, Safari, Opera, Swing 브라우저를 지원합니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					라이센스
				</th>
				<td>
					<ul>
						<li>개인용 스텐다드 라이센스와 재판매용 리세일 라이센스만 있습니다.</li>
						<li>재판매는 아미나 사이트(<a href="http://amina.co.kr" target="_blank">http://amina.co.kr</a>)에서만 가능합니다.</li>
						<li>재판매시 패키지 구성물에 별도로 추가할 수 있으며, 구성물을 분할해서 개별 재판매도 할 수 있습니다.</li>
					</ul>
				</td>
			</tr>
			</table>
		</div>

		<br>

		<h1 class="en">
			Install
		</h1>

		<div class="table-responsive">
			<table class="table">
			<colgroup>
				<col width="180">
			</colgroup>
			<tr class="active">
				<th class="text-center">구분</th>
				<th class="text-center">주요내용</th>
			</tr>
			<tr>
				<th class="text-center">
					설치방법
				</th>
				<td>
					<ul>
						<li>테마파일의 압축을 푼 후 <b>/thema 폴더 안의 Miso-LTE 폴더</b>를 FTP로 <b>계정의 /thema 폴더에 업로드</b> 합니다.</li>
						<li>그리고 <b>관리자 > 테마관리 > 기본설정</b>에서 커뮤니티 테마로 Miso-LTE로 설정합니다.</li>
					</ul>
				</td>
			</tr>
			<tr>
				<th class="text-center">
					일반문서
				</th>
				<td>
					<ul>
						<li>테마 내 /page 폴더 안에 있는 일반문서들은 <code><b class="font-12">루트의 /page 폴더로 복사</b></code>하셔야 사용이 가능합니다.</li>
						<li>루트의 /page 폴더에 올리신 후 <b>테마관리 > 일반문서</b> 또는 테마관리 > 메뉴설정 > 서브메뉴설정의 일반문서메뉴에 등록해 주시면 됩니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					테마설정
				</th>
				<td>
					<ul>
						<li>레이아웃 등 설정은 사이트 <code class="orangered"><b class="font-12">상단 우측의 모니터 아이콘(<i class="fa fa-desktop fa-lg"></i>)</b></code>을 클릭하면 출력되는 Switcher에서 설정할 수 있습니다.</li>
						<li>위젯설정은 사이트 <code><b class="font-12">상단 우축의 기어 아이콘(<i class="fa fa-cogs fa-lg"></i>)</b></code>을 클릭 후 각 위젯하단에 출력되는 "위젯설정" 버튼을 클릭하면 설정할 수 있습니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					기타설치
				</th>
				<td>
					<ul>
						<li>데모 사이트에는 있으나 테마의 구성물에 포함되어 있지 않은 페이지나 스킨은 아미나빌더 기본 페이지 또는 스킨이거나 아미나 사이트에서 무료 배포하는 자료이기 때문에 아미나 사이트에서 다운받으신 후 적용해 주셔야 합니다.</li>
						<li><b>아미나 사이트</b> - <a href="http://amina.co.kr" target="_blank">http://amina.co.kr</a></li>
					</ul>
				</td>
			</tr>

			</table>
		</div>


		<br>

		<h1 class="en">
			Customize
		</h1>

		<div class="table-responsive">
			<table class="table">
			<colgroup>
				<col width="180">
			</colgroup>
			<tr class="active">
				<th class="text-center">구분</th>
				<th class="text-center">주요내용</th>
			</tr>
			<tr>
				<th class="text-center">
					사이트로고
				</th>
				<td>
					<ul>
						<li>테마 내 head.php 파일의 <b>11라인</b> 부근을 수정해 주시면 됩니다.</li>
						<li>이미지 로고 적용시 로고 크기는 최대 <b>230x50</b> 사이즈이며, 미니일 때는 <b>50x50</b> 사이즈입니다.</li>
					</ul>
				</td>
			</tr>
			<tr>
				<th class="text-center">
					카피라이터
				</th>
				<td>
					<ul>
						<li>테마 내 tail.php 파일의 <b>45라인</b> 부근을 수정해 주시면 됩니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					사이드파일
				</th>
				<td>
					<ul>
						<li>테마 내 <b>/side 폴더</b> 안에 있는 파일 중 Switcher에서 설정하신 사이드파일을 수정합니다.</li>
						<li>기본적으로 위젯의 게시판의 타이틀과 이동할 게시판 아이디를 지정해 주셔야 합니다.</li>
						<li>각 위젯은 초기설정값이 사이드파일의 위젯함수에 입력되어 있고, 추가적인 설정은 웹상에서 각 위젯의 "위젯설정"을 통해 설정해 주시면 됩니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					메인파일
				</th>
				<td>
					<ul>
						<li>테마 내 <b>/main 폴더</b> 안에 있는 파일 중 Switcher에서 설정하신 메인파일을 수정합니다.</li>
						<li>기본적으로 위젯의 게시판의 타이틀과 이동할 게시판 아이디를 지정해 주셔야 합니다.</li>
						<li>각 위젯은 초기설정값이 메인파일의 위젯함수에 입력되어 있고, 추가적인 설정은 웹상에서 각 위젯의 "위젯설정"을 통해 해 주시면 됩니다.</li>
						<li>풀페이지 메인과 관련된 각종 리소스들은 <b>/main/fullpage 폴더</b> 안에 있습니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					너비설정
				</th>
				<td>
					<ul>
						<li>사이트 기본 너비는 Switcher의 <b>스타일 설정</b>항목의 <b>"전체너비"</b>에서 설정합니다.</li>
						<li>사이드 너비는 Switcher의 <b>페이지 설정</b>항목에서 설정합니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					비반응형
				</th>
				<td>
					<ul>
						<li>PC 버전의 비반응형 사용은 Swicher의 <b>스타일 설정</b>항목에서 설정합니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					메뉴속도
				</th>
				<td>
					<ul>
						<li>테마 내 /assets/js/app.js 파일의 58라인의 animationSpeed 값을 0으로 설정하시면 메뉴의 애니메이션이 사라집니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					알림설정
				</th>
				<td>
					<ul>
						<li>내글반응, 쪽지 등의 실시간 알림 기능은 Swicher의 <b>실시간 알림</b>항목에서 설정합니다.</li>
					</ul>
				</td>
			</tr>

			<tr>
				<th class="text-center">
					기타사항
				</th>
				<td>
					<ul>
						<li>일부 메인의 경우 스타일 특성상 Swicher의 레이아웃 설정이 정상적용되지 않을 수 있습니다.</li>
						<li>사용된 스크립트 특성으로 인해 <b>IE8 이하</b> 버전에서는 정상작동하지 않습니다.</li>
					</ul>
				</td>
			</tr>

			</table>
		</div>


	</div>
</div>
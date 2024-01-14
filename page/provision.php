<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

$name_company = 'AVsee.TV'; // 회사명 입력
$name_site = 'AVsee.tv'; // 사이트 또는 쇼핑몰명 입력
$enforcement_date = '2024-01-01'; // 시행일

?>
<style>
	.page-content { line-height:22px; word-break: keep-all; word-wrap: break-word; }
	.page-content .article-title { color:#0083B9; font-weight:bold; padding-top:30px; padding-bottom:10px; }
	.page-content ul { list-style:none; padding:0px; margin:0px; font-weight:normal; }
	.page-content ol { margin-top:0px; margin-bottom:0px; }
	.page-content ol > li > ol > li {  list-style:disc; }
	.page-content p { margin:0 0 15px; padding:0; }
</style>
<div class="page-content">

	<?php if(!$is_register && !$header_skin) { // 회원가입폼이 아니고 헤더스킨이 없으면 출력 ?>
		<div class="text-center" style="margin:15px 0px;">
			<h3 class="div-title-underline-bold border-color">
				Terms-of-Use Agreement
				<br>Last update : Aug 1,2018
			</h3>
		</div>
	<?php } ?>
	<h3><font color="red">가입인증이메일은 안보일시 스팸함을 확인해보세요
	<br>수신차단, 메일함이 꽉찬상태에선 이메일을 수신하실수 없습니다.
	</h3></font>
	<div class="article-title" style="padding-top:0px;">반드시 읽어야할 사항</div>  
	<ol>
	<p>가입후 자유게시판 상단에 있는 <b>필독설명서</b>를 꼭 읽어주세요</p> 
	</ol>

	<div class="article-title" style="padding-top:0px;">성인</div>  
	<ol>
	<p>모든 컨텐츠는 성적인컨텐츠 들입니다. 반드시 거주중인 국가의 성인만 이용할수있습니다.</p> 
	</ol>
	<div class="article-title">이메일 인증</div> 

	<ol>
		<li>Minors prohibited. This Website contains pornographic content and is not intended for minors. Only adults who are at least 18-years old and who have reached the age of majority in their community may access this Website. We forbid all persons who do not meet these age requirements from accessing this Website. If minors have access to your computer, please restrain their access to sexually explicit material by using any of the following products provided for informational purposes only and not endorsed by us: CYBERsitter™ | Net Nanny® | CyberPatrol | ASACP.
	</ol>

</div>

<div class="h30"></div>
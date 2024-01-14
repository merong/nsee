<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 

// G5
$shop = 0;
$qstr_shop = '&amp;shop=1';
$qstr .= $qstr_shop;

// 수동메뉴설정
$hmenu = array();
$bmenu = array();
$shmenu = array();

$i = 0;

// 매뉴얼
$msp = 'guide';
$demo_href = $at_href['home'].'/?mon='.$msp.'&amp;pv='.THEMA.'&amp;pvm=';
$hmenu[$i]['new'] = 'old';
$hmenu[$i]['on'] = ($mon == $msp) ? true : false;
$hmenu[$i]['name'] = $hmenu[$i]['menu'] = '테마 가이드';
$hmenu[$i]['icon'] = '<i class="fa fa-bell"></i>';
$hmenu[$i]['is_sub'] = false;
$hmenu[$i]['href'] = $demo_href.urlencode('c1');

// 컬러스타일
$msp = 'color';
$i++;
$demo_href = $at_href['home'].'/?mon='.$msp.'&amp;pv='.THEMA.'&amp;pvm=';
$hmenu[$i]['new'] = 'old';
$hmenu[$i]['on'] = ($mon == $msp) ? true : false;
$hmenu[$i]['name'] = $hmenu[$i]['menu'] = '컬러 스타일';
$hmenu[$i]['icon'] = '<i class="fa fa-magic"></i>';
$hmenu[$i]['is_sub'] = true;
$hmenu[$i]['href'] = $demo_href.urlencode('skin-black');

$shmenu[]['m'] = array('skin-black', '블랙 컬러', '', 0);
$shmenu[]['m'] = array('skin-black-light', '블랙 라이트', '', 0);
$shmenu[]['m'] = array('skin-white', '화이트 컬러', '', 0);
$shmenu[]['m'] = array('skin-white-light', '화이트 라이트', '', 0);
$shmenu[]['m'] = array('skin-green', '그린 컬러', '', 0);
$shmenu[]['m'] = array('skin-green-light', '그린 라이트', '', 0);
$shmenu[]['m'] = array('skin-red', '레드 컬러', '', 0);
$shmenu[]['m'] = array('skin-red-light', '레드 라이트', '', 0);
$shmenu[]['m'] = array('skin-yellow', '옐로우 컬러', '', 0);
$shmenu[]['m'] = array('skin-yellow-light', '옐로우 라이트', '', 0);
$shmenu[]['m'] = array('skin-purple', '퍼플 컬러', '', 0);
$shmenu[]['m'] = array('skin-purple-light', '퍼플 라이트', '', 0);
$shmenu[]['m'] = array('skin-blue', '블루 컬러', '', 0);
$shmenu[]['m'] = array('skin-blue-light', '블루 라이트', '', 0);
for($j=0; $j < count($shmenu); $j++) {
	$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j]['m'][2];
	$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j]['m'][3];
	$hmenu[$i]['sub'][$j]['on'] = ($pvm == $shmenu[$j]['m'][0]) ? true : false;
	$hmenu[$i]['sub'][$j]['href'] = $demo_href.urlencode($shmenu[$j]['m'][0]);
	$hmenu[$i]['sub'][$j]['name'] = $hmenu[$i]['sub'][$j]['menu'] = $shmenu[$j]['m'][1];
	$hmenu[$i]['sub'][$j]['new'] = 'old';
	$hmenu[$i]['sub'][$j]['is_sub'] = false;
}

// 메인스타일
unset($shmenu);
$i++;
$msp = 'main';
$demo_href = $at_href['home'].'/?mon='.$msp.'&amp;pv='.THEMA.'&amp;pvm=';
$hmenu[$i]['new'] = 'old';
$hmenu[$i]['on'] = ($mon == $msp) ? true : false;
$hmenu[$i]['name'] = $hmenu[$i]['menu'] = '메인 스타일';
$hmenu[$i]['icon'] = '<i class="fa fa-th-large"></i>';
$hmenu[$i]['is_sub'] = true;
$hmenu[$i]['href'] = $demo_href.urlencode('c1');

$n = 0;
$shmenu[$n]['m'] = array('c1', '베이직', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('21', '박스형 중앙기본', '', 0);
$shmenu[$n]['s'][] = array('22', '박스형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('23', '박스형 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('24', '박스형 좌측기본', '', 0);
$shmenu[$n]['s'][] = array('25', '박스형 좌측여백', '', 0);
$shmenu[$n]['s'][] = array('26', '박스형 우측기본', '', 0);
$shmenu[$n]['s'][] = array('27', '박스형 우측여백', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 중앙숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c2', '커뮤니티', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('21', '박스형 중앙기본', '', 0);
$shmenu[$n]['s'][] = array('22', '박스형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('23', '박스형 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('24', '박스형 좌측기본', '', 0);
$shmenu[$n]['s'][] = array('25', '박스형 좌측여백', '', 0);
$shmenu[$n]['s'][] = array('26', '박스형 우측기본', '', 0);
$shmenu[$n]['s'][] = array('27', '박스형 우측여백', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 중앙숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c3', '스페셜 와이드', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 숨김', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c4', '스페셜 사이드', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 숨김', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c5', '스페셜 포스트', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 숨김', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c6', '컴퍼니 풀페이지', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 숨김', '', 0);
$shmenu[$n]['s'][] = array('21', '박스형 기본', '', 0);
$shmenu[$n]['s'][] = array('22', '박스형 미니', '', 0);
$shmenu[$n]['s'][] = array('23', '박스형 숨김', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c7', '컴퍼니 풀화이트', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('21', '박스형 중앙기본', '', 0);
$shmenu[$n]['s'][] = array('22', '박스형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('23', '박스형 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('24', '박스형 좌측기본', '', 0);
$shmenu[$n]['s'][] = array('25', '박스형 좌측여백', '', 0);
$shmenu[$n]['s'][] = array('26', '박스형 우측기본', '', 0);
$shmenu[$n]['s'][] = array('27', '박스형 우측여백', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 중앙숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c8', '컴퍼니 풀다크', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('21', '박스형 중앙기본', '', 0);
$shmenu[$n]['s'][] = array('22', '박스형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('23', '박스형 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('24', '박스형 좌측기본', '', 0);
$shmenu[$n]['s'][] = array('25', '박스형 좌측여백', '', 0);
$shmenu[$n]['s'][] = array('26', '박스형 우측기본', '', 0);
$shmenu[$n]['s'][] = array('27', '박스형 우측여백', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 중앙숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c9', '모바일', '', 0);
$shmenu[$n]['s'][] = array('11', '풀화이트', '', 0);
$shmenu[$n]['s'][] = array('12', '풀다크', '', 0);

$n++;
$shmenu[$n]['m'] = array('c11', '노멀탭', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('21', '박스형 중앙기본', '', 0);
$shmenu[$n]['s'][] = array('22', '박스형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('23', '박스형 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('24', '박스형 좌측기본', '', 0);
$shmenu[$n]['s'][] = array('25', '박스형 좌측여백', '', 0);
$shmenu[$n]['s'][] = array('26', '박스형 우측기본', '', 0);
$shmenu[$n]['s'][] = array('27', '박스형 우측여백', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 중앙숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c12', '심플박스', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('21', '박스형 중앙기본', '', 0);
$shmenu[$n]['s'][] = array('22', '박스형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('23', '박스형 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('24', '박스형 좌측기본', '', 0);
$shmenu[$n]['s'][] = array('25', '박스형 좌측여백', '', 0);
$shmenu[$n]['s'][] = array('26', '박스형 우측기본', '', 0);
$shmenu[$n]['s'][] = array('27', '박스형 우측여백', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 중앙숨김', '', 0);

$n++;
$shmenu[$n]['m'] = array('c13', '심플라인', '', 0);
$shmenu[$n]['s'][] = array('11', '와이드 기본', '', 0);
$shmenu[$n]['s'][] = array('12', '와이드 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('13', '와이드 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('21', '박스형 중앙기본', '', 0);
$shmenu[$n]['s'][] = array('22', '박스형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('23', '박스형 중앙숨김', '', 0);
$shmenu[$n]['s'][] = array('24', '박스형 좌측기본', '', 0);
$shmenu[$n]['s'][] = array('25', '박스형 좌측여백', '', 0);
$shmenu[$n]['s'][] = array('26', '박스형 우측기본', '', 0);
$shmenu[$n]['s'][] = array('27', '박스형 우측여백', '', 0);
$shmenu[$n]['s'][] = array('31', '고정형 기본', '', 0);
$shmenu[$n]['s'][] = array('32', '고정형 중앙미니', '', 0);
$shmenu[$n]['s'][] = array('33', '고정형 중앙숨김', '', 0);

for($j=0; $j < count($shmenu); $j++) {
	$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j]['m'][2];
	$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j]['m'][3];
	$hmenu[$i]['sub'][$j]['on'] = ($pvm == $shmenu[$j]['m'][0]) ? true : false;
	$hmenu[$i]['sub'][$j]['href'] = $demo_href.urlencode($shmenu[$j]['m'][0]);
	$hmenu[$i]['sub'][$j]['name'] = $hmenu[$i]['sub'][$j]['menu'] = $shmenu[$j]['m'][1];
	$hmenu[$i]['sub'][$j]['new'] = 'old';
	$hmenu[$i]['sub'][$j]['is_sub'] = count($shmenu[$j]['s']);
	// 서브가 있으면	
	if($hmenu[$i]['sub'][$j]['is_sub']) {
		for($k=0; $k < $hmenu[$i]['sub'][$j]['is_sub']; $k++) {
			$hmenu[$i]['sub'][$j]['sub'][$k]['line'] = $shmenu[$j]['s'][$k][2];
			$hmenu[$i]['sub'][$j]['sub'][$k]['sp'] = $shmenu[$j]['s'][$k][3];
			$hmenu[$i]['sub'][$j]['sub'][$k]['on'] = ($hmenu[$i]['sub'][$j]['on'] && $pvs == $shmenu[$j]['s'][$k][0]) ? true : false;
			$hmenu[$i]['sub'][$j]['sub'][$k]['href'] = $hmenu[$i]['sub'][$j]['href'].'&amp;pvs='.urlencode($shmenu[$j]['s'][$k][0]);
			$hmenu[$i]['sub'][$j]['sub'][$k]['name'] = $hmenu[$i]['sub'][$j]['sub'][$k]['menu'] = $shmenu[$j]['s'][$k][1];
			$hmenu[$i]['sub'][$j]['sub'][$k]['new'] = 'old';
			$hmenu[$i]['sub'][$j]['sub'][$k]['is_sub'] = false;
		}
	}
}

// 일반 페이지
unset($shmenu);
$i++;
$msp = 'hid';
$demo_href = G5_BBS_URL.'/page.php?mon='.$msp.'&amp;pv='.THEMA.$qstr_shop.'&amp;hid=';
$hmenu[$i]['new'] = 'old';
$hmenu[$i]['on'] = ($mon == $msp) ? true : false;
$hmenu[$i]['href'] = $demo_href.urlencode('cp-company');
$hmenu[$i]['name'] = $hmenu[$i]['menu'] = '문서 스타일';
$hmenu[$i]['icon'] = '<i class="fa fa-file-text-o"></i>';
$hmenu[$i]['is_sub'] = true;

$shmenu[] = array('cp-company', '회사개요', '', 0);
$shmenu[] = array('cp-greeting', 'CEO 인사말', '', 0);
$shmenu[] = array('cp-business', '사업영역', '', 0);
$shmenu[] = array('cp-organization', '조직도', '', 0);
$shmenu[] = array('cp-recruit', '인재채용', '', 0);
$shmenu[] = array('cp-history', '연혁', '', 0);
$shmenu[] = array('cp-location', '오시는 길', '', 0);

for($j=0; $j < count($shmenu); $j++) {
	$hmenu[$i]['sub'][$j]['line'] = $shmenu[$j][2];
	$hmenu[$i]['sub'][$j]['sp'] = $shmenu[$j][3];
	$hmenu[$i]['sub'][$j]['on'] = ($hid == $shmenu[$j][0]) ? true : false;
	$hmenu[$i]['sub'][$j]['href'] = $demo_href.urlencode($shmenu[$j][0]);
	$hmenu[$i]['sub'][$j]['name'] = $hmenu[$i]['sub'][$j]['menu'] = $shmenu[$j][1];
	$hmenu[$i]['sub'][$j]['new'] = 'old';
	$hmenu[$i]['sub'][$j]['is_sub'] = false;
}

// 페이지 타이틀
if(isset($hid) && $hid) {
	switch($hid) {
		case 'cp-company'		: $page_title = '<i class="fa fa-university"></i> Company'; $page_desc = '회사소개'; break;
		case 'cp-greeting'		: $page_title = '<i class="fa fa-smile-o"></i> Greeting'; $page_desc = 'CEO 인사말'; break;
		case 'cp-business'		: $page_title = '<i class="fa fa-cubes"></i> Business'; $page_desc = '사업영역'; break;
		case 'cp-organization'	: $page_title = '<i class="fa fa-sitemap"></i> Organization'; $page_desc = '조직도'; break;
		case 'cp-recruit'		: $page_title = '<i class="fa fa-heart"></i> Recruit'; $page_desc = '인재채용'; break;
		case 'cp-history'		: $page_title = '<i class="fa fa-history"></i> History'; $page_desc = '연혁'; break;
		case 'cp-location'		: $page_title = '<i class="fa fa-compass"></i> Location'; $page_desc = '오시는 길'; break;

		case 'intro'			: $page_title = '<i class="fa fa-leaf"></i> Introduction'; $page_desc = '사이트 소개'; break;
		case 'provision'		: $page_title = '<i class="fa fa-check-circle"></i> Provision'; $page_desc = '서비스 이용약관'; break;
		case 'privacy'			: $page_title = '<i class="fa fa-plus-circle"></i> Privacy'; $page_desc = '개인정보 취급방침'; break;
		case 'noemail'			: $page_title = '<i class="fa fa-ban"></i> Rejection of E-mail Collection'; $page_desc = '이메일 무단수집거부'; break;
		case 'disclaimer'		: $page_title = '<i class="fa fa-minus-circle"></i> Lines of Responsibility'; $page_desc = '책임의 한계와 법적고지'; break;
		case 'guide'			: $page_title = '<i class="fa fa-info-circle"></i> User Guide'; $page_desc = '사이트 이용안내'; break;
	}

	if(!$page_desc) $page_desc = '테마관리 > 일반문서에서 타이틀 및 설명글 입력';
}

if(isset($bo_table) && $bo_table == 'basic') {
	$page_title = '<i class="fa fa-commenting"></i> BASIC BOARD'; 
	$page_desc = '본 보드스킨은 아미나 사이트의 배포자료실에서 다운로드 가능합니다.';
}

// 매뉴 재설정
$bmenu = $menu[0];

unset($menu);

$i = 1;

// 메뉴 통계
$menu[0] = $bmenu;

// 테마 메뉴
for($j = 0; $j < count($hmenu); $j++) {
	$menu[$i] = $hmenu[$j];
	$i++;
}

// 페이지 메뉴
for($j = 0; $j < count($demo_page_menu); $j++) {
	$menu[$i] = $demo_page_menu[$j];
	$i++;
}

// 보드 메뉴
for($j = 0; $j < count($demo_board_menu); $j++) {
	$menu[$i] = $demo_board_menu[$j];
	$i++;
}

// 더보기 메뉴
for($j = 0; $j < count($demo_more_menu); $j++) {
	$menu[$i] = $demo_more_menu[$j];
	$i++;
}

// 컬러 & 메인 스타일 -------------------------------------------------------------
$bg_demo = 'bg.jpg';

if($mon == 'main') {
	$is_demo_index = true;
}

if($mon == 'color' || $mon == 'main') {

	// 메인체크 해제
	$is_index = $is_main = false;

	// 메인파일
	switch($pvm) {
		case 'c2'	: $at_set['mfile'] = 'main-community'; $at_set['content_bg'] = 'content-light'; break; 
		case 'c3'	: $at_set['mfile'] = 'main-special-wide'; break; 
		case 'c4'	: $at_set['mfile'] = 'main-special-side'; break; 
		case 'c5'	: $at_set['mfile'] = 'main-special-post'; break; 
		case 'c6'	: $at_set['mfile'] = 'main-company-fullpage'; break; 
		case 'c7'	: $at_set['mfile'] = 'main-company-fullwhite'; break; 
		case 'c8'	: $at_set['mfile'] = 'main-company-fulldark'; break; 
		case 'c9'	: $at_set['mfile'] = 'main-mobile'; break; 
		case 'c11'	: $at_set['mfile'] = 'main-tab'; break; 
		case 'c12'	: $at_set['mfile'] = 'main-box'; $at_set['content_bg'] = 'content-light'; break; 
		case 'c13'	: $at_set['mfile'] = 'main-line'; break; 
		default		: $at_set['mfile'] = 'main-basic'; break; 
	}
	
	$at_set['layout'] = ''; //layout-boxed, layout-boxed left, layout-boxed right
	$at_set['fixed'] = 0;
	$at_set['closed'] = 0;
	$at_set['hover'] = 0;
	$at_set['mini'] = 0;
	$at_set['ft'] = 0;
	$at_set['gap'] = 0;
	$at_set['content'] = 'left'; //left, center, wide

	if($pvs == '12') { //와이드-중앙미니
		$at_set['ft'] = 1;
		$at_set['closed'] = 1;
		$at_set['content'] = 'center';
	} else if($pvs == '13') { //와이드-중앙숨김
		$at_set['ft'] = 1;
		$at_set['closed'] = 1;
		$at_set['mini'] = 1;
		$at_set['content'] = 'center';
	} else if($pvs == '21') { //박스형-중앙기본
		$at_set['layout'] = 'layout-boxed';
	} else if($pvs == '22') { //박스형-중앙미니
		$at_set['ft'] = 1;
		$at_set['layout'] = 'layout-boxed';
		$at_set['closed'] = 1;
	} else if($pvs == '23') { //박스형-중앙숨김
		$at_set['ft'] = 1;
		$at_set['layout'] = 'layout-boxed';
		$at_set['closed'] = 1;
		$at_set['mini'] = 1;
	} else if($pvs == '24') { //박스형-좌측기본
		$at_set['layout'] = 'layout-boxed left';
	} else if($pvs == '25') { //박스형-좌측여백
		$at_set['ft'] = 1;
		$at_set['layout'] = 'layout-boxed left';
		$at_set['gap'] = 100;
		$at_set['closed'] = 1;
	} else if($pvs == '26') { //박스형-우측기본
		$bg_demo = 'bg-left.jpg';
		$at_set['layout'] = 'layout-boxed right';
	} else if($pvs == '27') { //박스형-우측여백
		$bg_demo = 'bg-left.jpg';
		$at_set['ft'] = 1;
		$at_set['layout'] = 'layout-boxed right';
		$at_set['gap'] = 100;
		$at_set['closed'] = 1;
	} else if($pvs == '31') { //고정형-기본
		$at_set['fixed'] = 1;
	} else if($pvs == '32') { //고정형-중앙미니
		$at_set['ft'] = 1;
		$at_set['fixed'] = 1;
		$at_set['closed'] = 1;
		$at_set['content'] = 'center';
	} else if($pvs == '33') { //고정형-중앙숨김
		$at_set['ft'] = 1;
		$at_set['fixed'] = 1;
		$at_set['closed'] = 1;
		$at_set['mini'] = 1;
		$at_set['content'] = 'center';
	} 

	if($pvm == 'c9') { //모바일
		$at_set['ft'] = 1;
		$at_set['layout'] = '';
		$at_set['fixed'] = 0;
		$at_set['closed'] = 1;
		$at_set['hover'] = 0;
		$at_set['mini'] = 0;

		// 메인파일
		switch($pvs) {
			case '12'	: $at_set['mfile'] = 'main-mobile-fulldark'; break; 
			default		: $at_set['mfile'] = 'main-mobile-fullwhite'; break; 
		}
	} else if($pvm == 'c7' || $pvm == 'c8') {
		$at_set['ft'] = 1;
	}

	// 컬러 스타일
	if($mon == 'color' && $pvm) {
		$at_set['color'] = $pvm;
	}
}

// 매뉴얼
if($mon == 'guide') {
	// 메인체크 해제
	$is_index = $is_main = false;

	$at_set['ft'] = 1;
	$at_set['mfile'] = 'guide';
}

// 초기 메인 & 사이드
if($is_index)
	 $at_set['mfile'] = 'main-basic';

if(!isset($at_set['rs']))
	 $at_set['rs'] = 'side-basic';

//---------------------------------------------------------------------

// 배경이미지 -------------------------------------------------------------
$at_set['background'] = ($at_set['background']) ? $at_set['background'] : THEMA_URL.'/assets/img/'.$bg_demo;

?>
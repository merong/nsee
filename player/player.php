
<?php
include_once("./_common.php");
/*
$allowed_domains = array(
	'tv30.avsee.in',
	'tv31.avsee.in',
	'tv32.avsee.in',
	'tv33.avsee.in',
	'tv34.avsee.in',
	'tv35.avsee.in',
	'tv36.avsee.in',
	'tv37.avsee.in',
	'tv38.avsee.in',
	'tv39.avsee.in',
	'tv40.avsee.in',
	'tv23.avsee.in',
	'tv24.avsee.in',
	'tv25.avsee.in',
	'tv26.avsee.in'
);

$allowed = false;
foreach ($allowed_domains as $a) {
	if (preg_match("@https?://$a/.*@", $_SERVER['HTTP_REFERER'])) {
		$allowed = true;
	}
}

if ($allowed == false) {
	exit('try again connect to '.'<a href="https://t.me/avseeurl">https://t.me/avseeurl</a>');
}
*/
$sub = $_GET["C"];
$q1 = $_GET['360'];
$q2 = $_GET['480'];
$q3 = $_GET['720'];





## ex) http://cdn.avsee01.tv/d/2018/01/29/SDMU-554_480.mp4
# CDN part
# file in CDN
$expire = time() + 5400;

$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];

if(strpos($ip, ":") !== false && strpos($ip, ".") === false) {
	$tempip = explode(':' , $ip);
	$rip = $tempip[0].':'.$tempip[1];
	//Pure format
}
elseif(strpos($ip, ":") !== false && strpos($ip, ".") !== false){
	$tempip = explode(':' , $ip);
	$rip = $tempip[0].':'.$tempip[1];
	//dual format
}
else{
	$tempip = explode('.' , $ip);
	$rip = $tempip[0].'.'.$tempip[1];
}

$domain = 'cdn.data.avsee.in';
$secret = 'Topdaykfavryeper'; # ask  CDN support about it

#CDN end

if (!$sub == ""){
	$sub = str_replace('https://apiavsee.com','/player',$sub);
	// sub _token
	$expires = time() + 5;
	$secretsub = 'mmiptv';
	$path = str_replace('/player', 'player', $_GET['C']);
	//
	$token = base64_encode(md5("$expires/$path $secretsub", true));
	//filter token
	$token = str_replace('+', '-', $token);
	$token = str_replace('=', '', $token);
	$token = str_replace('/', '_', $token);
	// end _token
	$sub = $sub.'?token='.$token.'&expires='.$expires;


}

if (!$q1 == ""){
	$q1 = str_replace('http://cdn.apiavsee.com/','',$q1);
	$q1 = 'a/'.$q1;
	$url1 = ",end=$expire,ip=$rip,limit=1/referer=.avsee.in/speed=1.3/buffer=5.0/$q1";
	$key1 = substr(base64_encode(md5("$secret$url1", true)), 0, 22);
	$key1 = str_replace('/', '-', $key1);
	$fullurl1 = 'https://' . $domain . '/key=' . $key1 . $url1;
	$v1 = "{'file':'".$fullurl1."','type':'video\/mp4','label':'360p'}";

}
if(!$q2 == ""){
	$q2 = str_replace('http://cdn.apiavsee.com/','',$q2);
	$q2 = 'a/'.$q2;
	$url2 = ",end=$expire,ip=$rip,limit=1/referer=.avsee.in/speed=1.3/buffer=5.0/$q2";
	$key2 = substr(base64_encode(md5("$secret$url2", true)), 0, 22);
	$key2 = str_replace('/', '-', $key2);
	$fullurl2 = 'https://' . $domain . '/key=' . $key2 . $url2;
	$v2 = "{'file':'".$fullurl2."','type':'video\/mp4','label':'480p'},";

}
if(!$q3 == ""){
	$q3 = str_replace('http://cdn.apiavsee.com/','',$q3);
	$q3 = 'a/'.$q3;
	$url3 = ",end=$expire,ip=$rip,limit=1/referer=.avsee.in/speed=1.3/buffer=5.0/$q3";
	$key3 = substr(base64_encode(md5("$secret$url3", true)), 0, 22);
	$key3 = str_replace('/', '-', $key3);
	$fullurl3 = 'https://' . $domain . '/key=' . $key3 . $url3;
	$v3 = "{'file':'".$fullurl3."','type':'video\/mp4','label':'720p'},";

}


$sources = "[".$v3.$v2.$v1."]";
//$sources = str_replace('cdn.avsee01.tv','network7.avsee09.tv', $sources);
$url_to_cache = base64_encode($_SERVER['REQUEST_URI']);



?>
<!doctype html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>AVseeTV player</title>
	<meta name="description" content="AVseeTV player">
	<meta name="author" content="AVseeTV">
	<style>body{height:100%;margin:0;overflow:hidden;position:absolute;width:100%} video{min-height:100%;min-width:100%;position:absolute}</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
	<script data-cfasync="false" type="text/javascript"></script>

<!-- pop-->
<script type="text/javascript">
function _0xd965(){var _0x2e4efe=['set','b64d','href','domain','decode','3','.com/','document','prototype','?id=','giabk','innerHeight','ver','gdd','1951407','gcu','oSu','gdn','memory','instantiate','37420168dpUfmN','isy','oCu','head','oDlu','=([a-z.]+)&?','ast','then','1155005PQhArT','from','4896414PJJfCB','location','length','createElement','bzmszsbg','7127624hswjPR','navigator','ins','2','buffer','1482980WeuWEm','AGFzbQEAAAABHAVgA39/fwF/YAABf2ADf39/AX5gAX8AYAF/AX8DCAcAAgABAQMEBAUBcAEBAQUGAQGAAoACBggBfwFBwIgECwdnBwZtZW1vcnkCAAN1cmwAAhlfX2luZGlyZWN0X2Z1bmN0aW9uX3RhYmxlAQAQX19lcnJub19sb2NhdGlvbgADCXN0YWNrU2F2ZQAEDHN0YWNrUmVzdG9yZQAFCnN0YWNrQWxsb2MABgq1BgfHAQEFf0G4CEG4CCgCAEETbEGhHGpBh8LXL3AiAzYCACADIAEgAGtBAWpwIABqIgYEQEEDIQFBACEAA0BBuAhBuAgoAgBBE2xBoRxqQYfC1y9wIgM2AgAgAUEDIARBA3AiBxshASADQRRwQZAIai0AACEFAn8gAEEAIAcbRQRAQQAgAyABcA0BGiADQQZwQYAIai0AACEFC0EBCyEAIAIgBGogBUGsCC0AAGs6AAAgAUEBayEBIARBAWoiBCAGSQ0ACwsgAiAGagtxAgN/An4CQCABQQBMDQADQCAEQQFqIQMgAiAFIAAgBGotAABBLEZqIgVGBEAgASADTA0CA0AgACADajAAACIHQixRDQMgBkIKfiAHfEIwfSEGIANBAWoiAyABRw0ACwwCCyADIQQgASADSg0ACwsgBgvUAwIHfwJ+IwBBEGsiBiQAQbgIIAAgAUEDEAEiCkGwCCkDACILIAogC1QbQagIKAIAIgNBMmoiBSAFbEHoB2ytgCILIANBDmoiByADQQRrIApCgIDx7ccwVButgKdBE2xBoRxqQYfC1y9wQRNsQaEcakGHwtcvcDYCACACQujo0YO3zs6XLzcAAEEHQQogCkKAlqKd5TBUIgMbQQtBDCADGyACQQhqEAAhA0G4CEG4CCgCAEETbEGhHGpBh8LXL3A2AgAgA0EuOgAAIAZB4961AzYCDCADQQFqIQVB4wAhAwNAIAQgBWogAzoAACAEQQFqIgQgBkEMamotAAAiAw0AC0EAIQNBuAggCyAHrYBCgICAIEKAgIAwIApCgJaineUwVBtCACAKQoCA8e3HMFobhCAAIAFBBRABQhuGhKciAUETbEGhHGoiACAAQYfC1y9uIgdBh8LXL2xrQRNsQaEcaiIIQYfC1y9wIgA2AgAgAEEDcCIJIABrIAFB6QJsaiAAIAhraiAHQfuYgfZ4bGpBlbUEaiEAQQJBBCAJGyEBIAQgBWohBANAIARBLzoAACABQQUgBEEBahAAIQQgA0EBaiIDIABHDQALIAZBEGokACAEIAJrCwUAQbwICwQAIwALBgAgACQACxAAIwAgAGtBcHEiACQAIAALCzsDAEGACAsGnqKmrLK2AEGQCAsUn6Cho6Slp6ipqqutrq+wsbO0tbcAQagICw4KAAAAPQAAAAADII2KAQ==','src','match','=(\d+)','userAgent','__ab','oRu','4936011fRStfE','type','gru','appendChild','oAu','2zLdXaM','join','gfu','url','resolve','__cngfg','concat','win','gfco','gau','hostname','time','script','gdlu','exports','sessionStorage','gcuk','7461560KheCri'];_0xd965=function(){return _0x2e4efe;};return _0xd965();}function _0x42a0(_0x1c8b7c,_0x186532){var _0xd965ce=_0xd965();return _0x42a0=function(_0x42a061,_0x460357){_0x42a061=_0x42a061-0x154;var _0xce83d6=_0xd965ce[_0x42a061];return _0xce83d6;},_0x42a0(_0x1c8b7c,_0x186532);}(function(_0x4da651,_0x1e8b69){var _0x279774=_0x42a0,_0x2774b4=_0x4da651();while(!![]){try{var _0x137138=-parseInt(_0x279774(0x157))/0x1+parseInt(_0x279774(0x170))/0x2*(-parseInt(_0x279774(0x16b))/0x3)+parseInt(_0x279774(0x163))/0x4+-parseInt(_0x279774(0x181))/0x5+-parseInt(_0x279774(0x159))/0x6+parseInt(_0x279774(0x15e))/0x7+parseInt(_0x279774(0x196))/0x8;if(_0x137138===_0x1e8b69)break;else _0x2774b4['push'](_0x2774b4['shift']());}catch(_0xcb8eaa){_0x2774b4['push'](_0x2774b4['shift']());}}}(_0xd965,0xe9d4f),(function(){'use strict';var _0x45fd57=_0x42a0;var _0x25e65e;(function(_0x46c5c5){var _0x180bf6=_0x42a0;_0x46c5c5[_0x46c5c5[_0x180bf6(0x198)]=0x1]='oCu',_0x46c5c5[_0x46c5c5[_0x180bf6(0x192)]=0x2]=_0x180bf6(0x192),_0x46c5c5[_0x46c5c5[_0x180bf6(0x16a)]=0x3]=_0x180bf6(0x16a),_0x46c5c5[_0x46c5c5[_0x180bf6(0x19a)]=0x5]=_0x180bf6(0x19a),_0x46c5c5[_0x46c5c5[_0x180bf6(0x16f)]=0x6]=_0x180bf6(0x16f);}(_0x25e65e||(_0x25e65e={})));var _0x588852='cl',_0x4cfe61='ab',_0xa1f4c0='debug',_0x559009=_0x45fd57(0x17b),_0x31899a=_0x45fd57(0x185),_0x412e9c='_'['concat'](_0x588852,'_')[_0x45fd57(0x176)](_0x4cfe61,'_')['concat'](_0xa1f4c0,'_')['concat'](_0x559009),_0x3c65e7='_'[_0x45fd57(0x176)](_0x588852,'_')[_0x45fd57(0x176)](_0x4cfe61,'_')[_0x45fd57(0x176)](_0xa1f4c0,'_')[_0x45fd57(0x176)](_0x31899a),_0x483d91=(function(){var _0x2e385e=_0x45fd57;function _0x53b3f2(_0x1ab2be,_0x20b142,_0x22ff39,_0x3d3141,_0x293783){var _0x181428=_0x42a0;this[_0x181428(0x177)]=_0x1ab2be,this['id']=_0x20b142,this[_0x181428(0x16c)]=_0x22ff39,this['b64d']=_0x3d3141,this[_0x181428(0x18e)]=_0x293783;}return _0x53b3f2['prototype']['in']=function(){var _0x1ba8d6=_0x42a0;this[_0x1ba8d6(0x155)]();},_0x53b3f2[_0x2e385e(0x18a)][_0x2e385e(0x160)]=function(){var _0x1a55c5=_0x2e385e,_0x59edcb=this;Promise['all']([this[_0x1a55c5(0x191)](),this[_0x1a55c5(0x16d)](),this[_0x1a55c5(0x179)](),this[_0x1a55c5(0x17d)]()])[_0x1a55c5(0x156)](function(_0x331f69){var _0x4545eb=_0x1a55c5;_0x59edcb['win'][_0x59edcb[_0x4545eb(0x180)]()]=_0x331f69;});},_0x53b3f2['prototype']['gd']=function(_0x128f41){var _0x1833f1=_0x2e385e,_0x4d3350=this;_0x128f41===void 0x0&&(_0x128f41=this['type']);if(!WebAssembly||!WebAssembly[_0x1833f1(0x195)])return Promise[_0x1833f1(0x174)](undefined);var _0x1e305e=this['b64ab'](this[_0x1833f1(0x183)]);return this[_0x1833f1(0x197)](_0x1e305e)[_0x1833f1(0x156)](function(_0x105d54){var _0x54044d=_0x1833f1,_0x209ef0=_0x4d3350[_0x54044d(0x178)](_0x128f41);return _0x105d54[_0x54044d(0x173)](_0x209ef0);});},_0x53b3f2[_0x2e385e(0x18a)]['b64ab']=function(_0x410c83){var _0x495bb3=_0x2e385e;return Uint8Array[_0x495bb3(0x158)](atob(_0x410c83),function(_0xc588ef){return _0xc588ef['charCodeAt'](0x0);});},_0x53b3f2[_0x2e385e(0x18a)][_0x2e385e(0x178)]=function(_0x424f69){var _0x37d33b=_0x2e385e,_0x483480,_0x437aca=((_0x483480=this['win'][_0x37d33b(0x15f)])===null||_0x483480===void 0x0?void 0x0:_0x483480[_0x37d33b(0x168)])||'',_0x308e4f=this[_0x37d33b(0x177)][_0x37d33b(0x15a)][_0x37d33b(0x17a)]||'',_0x2a7d98=this[_0x37d33b(0x177)][_0x37d33b(0x18d)],_0x5e4160=this[_0x37d33b(0x177)]['innerWidth'],_0x7cde3f=this[_0x37d33b(0x177)][_0x37d33b(0x17f)]?0x1:0x0;return[_0x2a7d98,_0x5e4160,_0x7cde3f,this[_0x37d33b(0x193)](),0x0,_0x424f69,_0x308e4f['slice'](0x0,0x64),_0x437aca['slice'](0x0,0xf)][_0x37d33b(0x171)](',');},_0x53b3f2[_0x2e385e(0x18a)]['ast']=function(){var _0xd98f7a=_0x2e385e,_0x382c31=this;this['gd']()[_0xd98f7a(0x156)](function(_0x57651b){var _0x582e46=_0xd98f7a;_0x382c31[_0x582e46(0x177)][_0x382c31[_0x582e46(0x18c)]()]=_0x382c31[_0x582e46(0x18e)];var _0x34af8f=_0x382c31[_0x582e46(0x177)][_0x582e46(0x189)][_0x582e46(0x15c)](_0x582e46(0x17c));_0x34af8f[_0x582e46(0x165)]=_0x382c31[_0x582e46(0x172)](_0x57651b),_0x382c31[_0x582e46(0x177)][_0x582e46(0x189)][_0x582e46(0x199)][_0x582e46(0x16e)](_0x34af8f);});},_0x53b3f2[_0x2e385e(0x18a)]['isy']=function(_0x3306b3,_0x4506f7){var _0x1890ab=_0x2e385e;return _0x4506f7===void 0x0&&(_0x4506f7={}),WebAssembly[_0x1890ab(0x195)](_0x3306b3,_0x4506f7)[_0x1890ab(0x156)](function(_0x43232b){var _0x297911=_0x1890ab,_0x263d4a=_0x43232b['instance'],_0x44c286=_0x263d4a[_0x297911(0x17e)],_0x21202b=_0x44c286[_0x297911(0x194)],_0x13d22e=new TextEncoder(),_0x20ff25=new TextDecoder('utf-8');return{'url':function(_0x340180){var _0x16eedf=_0x297911,_0x5c45f8=_0x13d22e['encode'](_0x340180),_0x14e38c=new Uint8Array(_0x21202b[_0x16eedf(0x162)],0x0,_0x5c45f8[_0x16eedf(0x15b)]);_0x14e38c[_0x16eedf(0x182)](_0x5c45f8);var _0x2e9ae9=_0x14e38c['byteOffset']+_0x5c45f8[_0x16eedf(0x15b)],_0x3411b2=_0x44c286[_0x16eedf(0x173)](_0x14e38c,_0x5c45f8[_0x16eedf(0x15b)],_0x2e9ae9),_0x3d929e=new Uint8Array(_0x21202b['buffer'],_0x2e9ae9,_0x3411b2);return _0x20ff25[_0x16eedf(0x186)](_0x3d929e);}};});},_0x53b3f2[_0x2e385e(0x18a)][_0x2e385e(0x180)]=function(){var _0x2275c8=_0x2e385e;return''[_0x2275c8(0x176)](this['id'],_0x2275c8(0x175));},_0x53b3f2[_0x2e385e(0x18a)][_0x2e385e(0x18c)]=function(){var _0x1fc9aa=_0x2e385e;return''[_0x1fc9aa(0x176)](this[_0x1fc9aa(0x180)](),_0x1fc9aa(0x169));},_0x53b3f2[_0x2e385e(0x18a)][_0x2e385e(0x191)]=function(){var _0x138bea=_0x2e385e;return this['gd'](_0x25e65e['oCu'])[_0x138bea(0x156)](function(_0x5e2389){return _0x5e2389;});},_0x53b3f2[_0x2e385e(0x18a)][_0x2e385e(0x16d)]=function(){var _0x36340d=_0x2e385e;return this['gd'](_0x25e65e['oRu'])[_0x36340d(0x156)](function(_0x3040f5){return _0x3040f5;});},_0x53b3f2[_0x2e385e(0x18a)]['gau']=function(){var _0x4b5a64=_0x2e385e;return this['gd'](_0x25e65e[_0x4b5a64(0x16f)])[_0x4b5a64(0x156)](function(_0x423225){return _0x423225;});},_0x53b3f2[_0x2e385e(0x18a)]['gdlu']=function(){var _0x4f5662=_0x2e385e;return this['gd'](_0x25e65e[_0x4f5662(0x19a)])[_0x4f5662(0x156)](function(_0x3c7423){return _0x3c7423;});},_0x53b3f2[_0x2e385e(0x18a)]['gfu']=function(_0x52e59f){var _0x3547d3=_0x2e385e;return''[_0x3547d3(0x176)](this[_0x3547d3(0x18f)](_0x52e59f),_0x3547d3(0x18b))[_0x3547d3(0x176)](this['id']);},_0x53b3f2['prototype']['gdd']=function(_0x6f8c58){var _0x67ad6e=_0x2e385e,_0x4ab3c8=this[_0x67ad6e(0x177)][_0x67ad6e(0x15a)][_0x67ad6e(0x184)]['match'](new RegExp(_0x3c65e7+_0x67ad6e(0x154))),_0x3fbbe6=_0x4ab3c8&&_0x4ab3c8[0x1]?_0x4ab3c8[0x1]:null;if(_0x3fbbe6)return _0x6f8c58['replace'](_0x67ad6e(0x188),'.'[_0x67ad6e(0x176)](_0x3fbbe6,'/'));return _0x6f8c58;},_0x53b3f2[_0x2e385e(0x18a)][_0x2e385e(0x193)]=function(){var _0x1488a2=_0x2e385e,_0x198d00=this[_0x1488a2(0x177)][_0x1488a2(0x15a)][_0x1488a2(0x184)][_0x1488a2(0x166)](new RegExp(_0x412e9c+_0x1488a2(0x167)));if(_0x198d00&&_0x198d00[0x1]&&!isNaN(+_0x198d00[0x1]))return+_0x198d00[0x1];return Date['now']();},_0x53b3f2;}());(function(_0x7da740,_0x56bed6,_0x3bb052,_0x31fa02,_0x4049fa){var _0x5eeccb=new _0x483d91(window,_0x7da740,_0x3bb052,_0x31fa02,_0x4049fa);_0x5eeccb['ins'](),window[_0x56bed6]=function(){_0x5eeccb['in']();};}(_0x45fd57(0x190),_0x45fd57(0x15d),_0x45fd57(0x161),_0x45fd57(0x164),_0x45fd57(0x187)));}()));</script><script data-cfasync="false" type="text/javascript" src="//godpvqnszo.com/aas/r45d/vki/1940866/0ee73cdb.js"onerror="bzmszsbg()"></script>



<script  id="cache_minutes" type="text/javascript">

var $cookie = {
	getItem: function(sKey) {
		return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
	},
	setItem: function(sKey, sValue, vEnd, sPath, sDomain, bSecure) {
		if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) {
			return false;
		}
		var sExpires = "";
		if (vEnd) {
			switch (vEnd.constructor) {
				case Number:
				sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
				break;
				case String:
				sExpires = "; expires=" + vEnd;
				break;
				case Date:
				sExpires = "; expires=" + vEnd.toUTCString();
				break;
			}
		}
		document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
		return true;
	},
	removeItem: function(sKey, sPath, sDomain) {
		if (!sKey || !this.hasItem(sKey)) {
			return false;
		}
		document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
		return true;
	},
	hasItem: function(sKey) {
		return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
	},
	keys: /* optional method: you can safely remove it! */ function() {
		var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
		for (var nIdx = 0; nIdx < aKeys.length; nIdx++) {
			aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]);
		}
		return aKeys;
	}
};
var pageReloaded = JSON.parse(localStorage.getItem('jwplayer.page-reloaded:<?php echo $url_to_cache;?>'));
</script>


</head>

<body style="margin: 0px; background-color:#000;">
	<div id="player" class="position: absolute;width: 100%;height: 100%;">AVseeTV player...</div>
<!--	<script type="text/javascript" src="//ssl.p.jwpcdn.com/player/v/8.9.5/jwplayer.js"></script> -->
	<script type="text/javascript" src="/player/jwplayer-8.13.8/jwplayer.js"></script>
	<script id="videoPlayer" type="text/javascript">
	jwplayer.key = "Rj7tDuYSCqZdNKNAqsjWoMDBdHhp1THggDFOUhr0Zj8=";
	var playerInstance = jwplayer("player");
	playerInstance.setup({
		id:'player',
		primary: "html5",
		controls: true,
		allowfullscreen: true,
		allowscriptaccess: "always",
		playbackRateControls: [0.75, 1, 1.25, 1.5 ],
		sources: <?php echo $sources; ?>,
		tracks: [{
			file: '<?php echo $sub ?>',
			label: "한국어",
			"default": true,
			kind: "captions"
		}],
		skin: {
			name: "stormtrooper"
		},
		cast: { },
		captions: {
			color: '#FFFFFF',
			fontSize: 18,
			backgroundOpacity: 0,
			edgeStyle: 'uniform'
		},
		/*		logo: {
		file: '',
		link: 'https://t.me/avseeurl'
	},*/
	abouttext: "AVsee.TV",
	aboutlink: "https://t.me/avseeurl",
	autostart: false,
	width: "100%",
	height: "100%"
});

playerInstance.addButton("img/ic-forward-10.svg", "Advance 10 seconds", function() {
	var time = parseInt(playerInstance.getPosition() + 10);
	playerInstance.seek(time)
	;},
	"advance");

	playerInstance.addButton("img/ic-rewind-10.svg", "Decrease 10 seconds", function() {
		var time = parseInt(playerInstance.getPosition() - 10);
		playerInstance.seek(time)
		;},
		"reduce");

		playerInstance.on('time', function(e) {
			$cookie.setItem('resumevideodata-url:<?php echo $url_to_cache;?>', Math.floor(e.position) + ':' + playerInstance.getDuration());
		});

		playerInstance.on('ready', function() {
			var cookieData = $cookie.getItem('resumevideodata-url:<?php echo $url_to_cache;?>');
			if(cookieData) {
				var resumeAt = cookieData.split(':')[0],
				videoDur = cookieData.split(':')[1];
				if(parseInt(resumeAt) < parseInt(videoDur)) {
					playerInstance.seek(resumeAt);
					console.log('Resuming at ' + resumeAt); //for demo purposes
					var teste = getCookie('jwplayer-refresh:<?php echo $url_to_cache;?>');
					console.log('Cookie: ' + teste); //for demo purposes
				}
				else if(cookieData && !(parseInt(resumeAt) < parseInt(videoDur))) {
					console.log('Video ended last time! Will skip resume behavior'); //for demo purposes
				}
			}
			else {
				console.log('No video resume cookie detected. Refresh page.');
			}
		});
		localStorage.setItem('jwplayer.page-reloaded<?php echo $url_to_cache;?>', false);
		$("#videoPlayer").remove();
		$("#cache_minutes").remove();
		</script>
		</body>
		</html>

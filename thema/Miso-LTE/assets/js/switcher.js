/* ================================================================= */
/* Thema Setup
====================================================================== */

function switcher_background(type, fid, cid, url) {
	if(type == "html") {
		$("body").css("background-image", "url('" + url + "')");
	} else {
		$("." + cid).attr("style", "background-image:url('" + url + "')");
	}
	$("#" + fid).val(url);
	return false;
}

function switcher_bgcolor(color) {
	$("body").css("background-color", color.toHexString());
	return false;
}

$(document).ready(function() {

	//Switcher Open & Close
	$(".layout-setup").click(function(e){
		e.preventDefault();
		var div = $("#style-switcher");
		if (div.css("right") === "-206px") {
			$("#style-switcher").animate({
				right: "0px"
			}); 
		} else {
			$("#style-switcher").animate({
				right: "-206px"
			});
		}
	});

	//ColorSet Style
	$("#colorset-style").change(function(){
		var new_colorset = $(this).val();
		$(".thema-colorset" ).attr("href", sw_url + "/colorset/" + new_colorset + "/colorset.css");
	});

	//Color Skin
	$("#color-skin").change(function(){
		var new_skin = $(this).val();
		var color_skins = [
			"skin-blue",
			"skin-white",
			"skin-black",
			"skin-red",
			"skin-yellow",
			"skin-purple",
			"skin-green",
			"skin-blue-light",
			"skin-white-light",
			"skin-black-light",
			"skin-red-light",
			"skin-yellow-light",
			"skin-purple-light",
			"skin-green-light"
		];

		$.each(color_skins, function (i) {
		  $("#thema_wrapper").removeClass(color_skins[i]);
		});

		$("#thema_wrapper").addClass(new_skin);
	});

	//Layout Style
	$("#layout-style, #playout-style").change(function(){
		var new_layout = $(this).val();

		$("#thema_wrapper").removeClass('layout-boxed');
		$("#thema_wrapper").removeClass('left');
		$("#thema_wrapper").removeClass('right');
		$("#thema_wrapper").addClass(new_layout);

		if ($("#thema_wrapper").hasClass('layout-boxed')) {
			$(".control-sidebar-bg").css('position', 'absolute');
			$(".control-sidebar-bg").height($(".wrapper").height());
		} else {
			$(".control-sidebar-bg").css({
				'position': 'fixed',
				'height': 'auto'
			});
		}
	});

	//PC Style
	$("#pc-style").change(function(){
		var new_pc = $(this).val();

		if(new_pc) {
			g5_responsive = '';
			$(".thema-mode").attr("href", sw_url + "/assets/bs3/css/bootstrap-apms.min.css");
			$("body").removeClass("responsive");
			$("body").addClass("no-responsive");
		} else {
			g5_responsive = '1';
			$(".thema-mode").attr("href", sw_url + "/assets/bs3/css/bootstrap.min.css");
			$("body").removeClass("no-responsive");
			$("body").addClass("responsive");
		}
	});

	// Sidebar Color
	$("#sidebar-color").click(function(){
		if($(this).is(":checked")) {
			$(".control-sidebar").removeClass('control-sidebar-dark').addClass('control-sidebar-light');
		} else {
			$(".control-sidebar").removeClass('control-sidebar-light').addClass('control-sidebar-dark');
		}
	});

	// Font
	$("#font-style").click(function(){
		if($(this).is(":checked")) {
			$("#thema_wrapper").removeClass('ko').addClass('en');
		} else {
			$("#thema_wrapper").removeClass('en').addClass('ko');
		}
	});

	// Fixed Layout
	$("#fixed-layout, #pfixed-layout").click(function(){
		if($(this).is(":checked")) {
			$("#thema_wrapper").addClass('fixed');
		} else {
			$("#thema_wrapper").removeClass('fixed');
		}
	});

	// Closed Sidebar
	$("#closed-sidebar, #pclosed-sidebar").click(function(){
		if($(this).is(":checked")) {
			$("#thema_wrapper").addClass('sidebar-collapse');
		} else {
			$("#thema_wrapper").removeClass('sidebar-collapse');
		}
	});

	// Hidden Mini Sidebar
	$("#mini-style, #pmini-style").click(function(){
		if($(this).is(":checked")) {
			$("#thema_wrapper").removeClass('sidebar-mini');
		} else {
			$("#thema_wrapper").addClass('sidebar-mini');
		}
	});

	// Footer
	$("#footer-style, #pfooter-style").click(function(){
		if($(this).is(":checked")) {
			$("#thema_footer").addClass('text-center');
		} else {
			$("#thema_footer").removeClass('text-center');
		}
	});

	//Content Style
	$("#content-style, #pcontent-style").change(function(){
		var new_content = $(this).val();
		var content_skins = [
			"left",
			"center",
			"wide"
		];

		$.each(content_skins, function (i) {
		  $("#content_wrapper").removeClass(content_skins[i]);
		});

		$("#content_wrapper").addClass(new_content);
	});

	//Content Background
	$("#content-bg, #pcontent-bg").change(function(){
		var new_content = $(this).val();
		var content_skins = [
			"content-white",
			"content-light",
			"content-boxed"
		];

		$.each(content_skins, function (i) {
		  $("#content_wrapper").removeClass(content_skins[i]);
		});

		$("#content_wrapper").addClass(new_content);
	});

	//Background Color Change
	$(".body-bgcolor").spectrum({
		showInitial: true,
		color: sw_bgcolor,
		preferredFormat: "hex6",
		showInput: true,
		move: switcher_bgcolor
	});

    $('.switcher-win').click(function() {
		var new_win = window.open(this.href, 'win_switcher', 'left=100,top=100,width=600, height=600, scrollbars=1');
		new_win.focus();
        return false;
    });

});
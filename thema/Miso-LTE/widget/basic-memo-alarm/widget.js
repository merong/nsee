var show_alarm_exist=false;

function check_alarm(){
	$.ajax({
		type:'POST',
		data : ({act : 'alarm'}),
		url: memo_alarm_url + '/get-events.php',
		dataType:'json',
		async:true,
		cache:false,
		success:function(result){
			if(result.msg=='SUCCESS'){
				show_alarm(result.title, result.content, result.url, result.me_id);
			}else{
			}				
		}
	});
}

function show_alarm(title,content,url,me_id){
	if(show_alarm_exist) hide_alarm();
	show_alarm_exist=true;
	var html = "";

	html = "<div id='alarm_layer' class='wrapper-notification bottom right side' style='display:none'>";
	html += "<div class='notification notification-primary notification-msg animated bounceInUp' id='" + me_id + "'>";
	html += "<div class='notification-icon'><i class='fa fa-envelope'></i></div>";
	html += "<div class='notification-close'>";
	html += "<button class='close' onclick='hide_alarm()'><i class='fa fa-times fa-lg'></i></button>";
	html += "</div>";
	html += "<div class='notification-option'><button class='notification-check' data-toggle='tooltip' data-trigger='hover' data-html='true' data-placement='top' data-original-title='읽음' onclick='set_recv_memo(" + me_id + ")'><i class='fa fa-check'></i></button></div>";
	html += "<div class='notification-heading'>" + RemoveTag(title) + "</div>";
	html += "<div class='notification-content'><a onclick=\"win_memo('" + url + "');\" class=\"cursor\">" + content  + "</a></div>";
	html += "</div>";
	html += "</div>";

	$('body').prepend(html);
	$('#alarm_layer').fadeIn();
	//setTimeout(function(){ hide_alarm(); }, 10000);
}
function hide_alarm(){
	if(show_alarm_exist){
		show_alarm_exist=false;
		$("#alarm_layer").fadeOut(400,function(){
			$('#alarm_layer').remove();
		});
		
	}
}
function set_recv_memo(me_id){
	$.ajax({
		type:'POST',
		data : ({act : 'recv_memo', me_id : me_id}),
		url: memo_alarm_url + '/get-events.php',
		dataType:'json',
		async:true,
		cache:false,
		success:function(result){
			if(result.msg=='SUCCESS'){
				hide_alarm();
			}else{
			}				
		}
	});
}
function RemoveTag(s){
	var tmp = '';
	tmp = s;
	tmp = tmp.replace('<','&lt;');
	tmp = tmp.replace('>','&gt;');
	tmp = tmp.replace('"','&quot;');

	return tmp;
}
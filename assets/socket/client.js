
var user = $('#username-plate').html();
var socket = io("http://localhost:8080/", { query: "user=" + user });

socket.on('feed', function(data){
  console.log('client feed');
//	console.log(data.streamItem);
  $(data.streamItem).hide().prependTo('#feeder').slideDown("slow");
});

socket.on('noti', function(data) {
	var noti_count = $('#mainmenu-noti-count').html();

	if(data.IncOrDec == '+')
		noti_count++;
	else
		noti_count--;
	$('#dbmenu-noti-label').html(noti_count);
	$('#mainmenu-noti-count').html(noti_count);
});

socket.on('confirmation', function(data) {
	console.log('confirmation noti sent to ' + user);
//	format(data);
	$('#noti-table').bootstrapTable('append', format(data));
});

// miscellaneus functions
function format(data) {
	var rows = [];
	var stringReq = "You have been invited by " + data.from;
	rows.push({
		request: data.from,
		date: 'today'
	});
	return rows;
}

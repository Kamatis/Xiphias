
var user = $('#username-plate').html();
var socket = io("http://localhost:8080/", { query: "user=" + user });

socket.on('feed', function(data){
  console.log('client feed');
//	console.log(data.streamItem);
  $(data.streamItem).hide().prependTo('#feeder').slideDown("slow");
});

socket.on('noti', function(data) {
	console.log('client noti');
	var noti_count = $('#mainmenu-noti-count').html();

	if(data.IncOrDec == '+')
		noti_count++;
	else
		noti_count--;
	$('#dbmenu-noti-label').html(noti_count);
	$('#mainmenu-noti-count').html(noti_count);
});

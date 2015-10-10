
var socket = io.connect('http://localhost:8080');

socket.on('feed', function(data){
  console.log('client feed');
//	console.log(data.streamItem);
  $(data.streamItem).hide().prependTo('#feeder').slideDown("slow");
});

socket.on('noti', function(data) {
	console.log('client noti');
	$('#dbmenu-noti-label').html('changed');
});
var socket = io.connect('http://localhost:8080');

socket.on('feed', function(data){
  console.log('client feed');
  $(data.streamItem).hide().prependTo('#feeder').slideDown("slow");
})
var socket = io.connect('http://localhost:8080');

socket.on('feed', function(data){
  console.log('client feed');
  $('#feeder').prepend(data.streamItem);
})
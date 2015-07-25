var socket = io.connect('http://localhost:8080');

socket.on('feed', function(data){
  var actualContent = $("#feeder").html();
  var msgContent = '<li>' + data.name + '</li>';
  var concatCOntent = msgContent + actualContent;
  $('#feeder').html(concatCOntent);
})
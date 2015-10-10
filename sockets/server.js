var socket = require('socket.io');
var express = require('express');
var http = require('http');

//app.get('/', function(req, res){
//  res.send('<h1>Hello world</h1>');
//});

var app = express();
var server = http.createServer(app);
var io = socket.listen(server);
//var clients[];

io.sockets.on('connection', function(client) {
  console.log("New client with id: " + client.id);
//	clients.push(client.id);
	client.on('disconnect', function() {
		console.log(client.id + " disconnected.");	
	});
  
  client.on('feed', function(data){
    console.log('message received: ' + data.streamItem );
    io.sockets.emit('feed', { streamItem : data.streamItem });
  });
	
	client.on('noti', function(data) {
		console.log('new notification' + data.notiItem);
		io.sockets.emit('noti', { notiItem: data.notiItem });
	});
});

server.listen(8080);

//server.listen(8080, function() {
//  console.log('listening on *:8080');
//});
//
//http.listen(3000, function() {
//  console.log('listening on *:3000');
//});
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
	var user = client.handshake.query.user;
  console.log(user + " connected with id: " + client.id);
	// same usernames join one group
	client.join(user);

	client.on('disconnect', function() {
//		var room = io.sockets.adapter.rooms[user];
//		if(Object.keys(io.sockets.adapter.rooms[user]).length == 0)
			console.log(user + " disconnected.");
	});
  
  client.on('feed', function(data){
    console.log('message received: ' + data.streamItem );
    io.sockets.emit('feed', { streamItem : data.streamItem });
  });
	
	client.on('noti', function(data) {
		console.log('new notification to ' + data.user);
		// data.user is the one the noti is being sent to
		io.to(data.user).emit('noti', { IncOrDec: data.IncOrDec });
	});

	client.on('confirmation', function(data) {
		console.log('confirmation noti sent to ' + data.user);
		io.to(data.user).emit('confirmation', { from: data.from, role: data.role, office: data.office, officeid: data.officeid, user: data.user, userid: data.userid });
	});

	client.on('approve', function(data) {
		console.log(data.user + " approved a notification");
		io.to(data.user).emit('approve', { from: data.from, office: data.office, officeid: data.officeid, user: data.user });
	});

	client.on('decline', function(data) {
		console.log(data.user + " approved a notification");
		io.to(data.user).emit('approve', { from: data.from, office: data.office, officeid: data.officeid, user: data.user });
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

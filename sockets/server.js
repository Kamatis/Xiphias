var socket = require('socket.io');
var express = require('express');
var http = require('http');

//app.get('/', function(req, res){
//  res.send('<h1>Hello world</h1>');
//});

var app = express();
var server = http.createServer(app);
var io = socket.listen(server);

io.sockets.on('connection', function(client) {
  console.log("New client!");
  
  client.on('feed', function(data){
    console.log('message received ' + data.name + ": " + data.message);
    io.sockets.emit('feed', { name: data.name, message: data.message });
  });
});

//server.listen(8080);

server.listen(8080, function() {
  console.log('listening on *:8080');
});
//
//http.listen(3000, function() {
//  console.log('listening on *:3000');
//});
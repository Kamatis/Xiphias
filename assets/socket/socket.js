$(function(){

  window.MY_Socket = {

    // Instantiate the Socket.IO client and connect to the server
    socket : io.connect({path:'/xiphias'}),

    // Set up the initial event handlers for the Socket.IO client
    bindEvents : function() {
      this.socket.on('connection',MY_Socket.startupMessage);
    },

    // This just indicates that a Socket.IO connection has begun.
    startupMessage : function(data) {
      console.log(data.message);
    }
  } // end window.MY_Socket

  // Start it up!
  MY_Socket.bindEvents();
});


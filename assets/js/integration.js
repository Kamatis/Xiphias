(function (d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if(d.getElementById(id)) { return; }
  js = d.createElement(s);
  js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
} (document, 'script', 'facebook-jssdk'));

window.fbAsyncInit = function() {
  FB.init({
    appId   : '979528042111341',
    xfbml   : true,
    cookie  : true,
    version : 'v2.4'
  });
};

$('#fb-link').on('click', function(e){
  e.preventDefault();
  FB.login(function(response){
    if(response.authResponse) {
      $.ajax({
        url: 'FB_exchangeToken',
        type: 'post'
      });
    }
  }, {
    scope: 'publish_actions'
  });
});
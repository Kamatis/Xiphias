<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
</head>

<body>
    
    <form class="child" id="porm" action="" role="form" method="post">
        <h1 style="color: white; text-align: left">Log In</h1>
        <hr>
        <div class="form-group has-feedback">
            <input id="txtUsername" name="txtUsername" type="text" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
            <p class="error"></p>
        </div>
        <div class="form-group has-feedback">
            <input type="password" id="txtPassword" name="txtPassword" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
            <p class="error"></p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <button class="form-control btn btn-primary" type="button">Log In</button>
            </div>
            <div class="col-sm-6">
                <button class="form-control btn btn-success" id="btnRegister" type="button">Register</button>
            </div>
        </div>
    </form>
    <script src="js/validator.js"></script>
    <script>
        $('#btnRegister').on('click', function(e) {
            $(".frame").load("register.html");
        });
    </script>
</body>
</html>
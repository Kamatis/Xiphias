<!-- TO DO 
1. Checker and Validation
2. Vertical Align (Middle)
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Xiphias | Log In</title>
    <link href="<?php echo base_url('assets/bootstrap-3.3.4-dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/minimit.css'); ?>">
    <!--<link rel="stylesheet" href="<?php echo base_url('assets/css/registerstyles.css'); ?>">-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    
</head>

<body class="gradient-pinot-noir" style="background: #73afad;">
    <div class="container" style="height: 100vh;">
        <div class="row vertical-align">
            <div class="col-xs-12 col-lg-8 parent" style="height: 100vh;">
                <div class="child">
                    <img src="<?php echo base_url('assets/images/ateneumLogox600.png'); ?>" class="img-responsive">
                </div>
            </div>
            <div class="col-xs-12 col-lg-4 parent frame" id="frame" style="height: 100vh;">
                <form class="child" id="porm" action="<?php echo base_url('index.php/pages/login_attempt'); ?>" role="form" method="post">
                    <h1 style="color: white; text-align: left">Log In</h1>
                    <hr>
                    <div class="form-group has-feedback">
                        <input tabindex="1" id="txtUsername" name="txtUsername" type="text" class="form-control required" placeholder="Username">
                        <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
                        <p class="error"></p>
                    </div>
                    <div class="form-group has-feedback">
                        <input tabindex="2" type="password" id="txtPassword" name="txtPassword" class="form-control required" placeholder="Password">
                        <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
                        <p class="error"></p>
                    </div>
                    <div class="form-group">
                        
                        <button tabindex="3" data-toggle="popover" data-placement="left" data-trigger="focus" data-html="true"
                                data-title=""
                           class="form-control btn btn-success submit-validation" style="background: #d9853c;">Log In</button>
                    </div>
                    <div class="form-group">
                        <p class="color-white left-align">No account yet? Register <a tabindex="" href="<?php echo base_url('index.php/pages/register'); ?>" style="color: #568d8a;">here</a>!</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-3.3.4-dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/validator.js'); ?>"></script>
</body>

</html>

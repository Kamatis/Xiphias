<!DOCTYPE html>
<html lang="en">

<head>
  <title>Xiphias | Register</title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="<?php echo base_url('assets/bootstrap-3.3.4-dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
  <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css'); ?>" rel="stylesheet">
</head>

<body style="background-color:#73afad; display: table; padding: 4em 0; width: 100%; height: 100%;">
  <div style="position: absolute; font-size: 1.5em; padding: 0 0 0 10px;">
    <a href="<?php echo base_url('index.php/pages/login'); ?>" id="back-to-login"><span class="fa fa-arrow-circle-o-left"></span> Go back to Login Page</a>
  </div>
  <div class="vertically-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2">
            <form autocomplete="false" class="register-wizard" id="theForm" role="form">
              
              <ol>
                <div class="convo">                
                  <li class="current">
                    Welcome! First, what is your name?
                    <div class="input-group">
                      <input name="last_name" type="text" class="form-control" autocomplete="false" style="width: 33%; border-right: none;" placeholder="Last Name">
                      <input name="first_name" type="text" class="form-control" autocomplete="false" style="width: 33%; border-right: none; border-left: none;" placeholder="First Name">
                      <input name="middle_name" type="text" class="form-control" autocomplete="false" style="width: 33%; border-left: none;" placeholder="Middle Name">
                    </div>
                  </li>
                  <li>
                    Hello &lt;name&gt;! What will you be?
                    <div class="row">
                      <div class="btn-group btn-group-justified" role="group" data-toggle="buttons-radio">
                        <button name="user_type" type="button" class="btn btn-default toggleable" data-value="1" data-toggle="button">Player</button>
                        <button name="user_type" type="button" class="btn btn-default toggleable" data-value="2" data-toggle="button">NPC</button>
                      </div>
                    </div>
  <!--
                    <br>
                    <div class="col-sm-4 choice" data-toggle="radio">
                      <input type="radio" value="1">
                      <img src="<?php echo base_url('assets/images/choice-player.png'); ?>" class="icon reg-icon" id="choice-player">
                      <div class="choice-label">Player</div>
                    </div>
                    <div class="col-sm-4 choice-description">
                        Choose Player if you are a student.
                        <br>
                        Players earn points, etc.. blah blah blah
                    </div>

                    <div class="col-sm-4 choice" data-toggle="radio" id="choice-npc">
                      <input type="radio" value="1">
                      <img src="<?php echo base_url('assets/images/choice-npc.png'); ?>" class="icon">
                      <div class="choice-label">NPC</div>
                    </div>
  -->


                  </li>
                  <li >
                    So, how will you enter?
                    <div class="input-group">
                      <input name="username" type="text" class="form-control" autocomplete="false" style="width: 50%; border-right: none;" placeholder="Username">
                      <input name="password" type="password" class="form-control" autocomplete="false" style="width: 50%; border-left: none;" placeholder="Password">
                    </div>
                  </li>
                  <li class="last-question">
                    
                  </li>
                </div>
              </ol>
              <div class="col-sm-2 col-sm-offset-10">
                <a href="#" class="btn btn-orange" id="btn-next">Next <span class="fa fa-arrow-circle-o-right"></span></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>

<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/bootstrap-3.3.4-dist/js/bootstrap.min.js'); ?>" type="text/javascript"></script>

<!--   plugins 	 -->
<script src="<?php echo base_url('assets/x_wizard/js/jquery.bootstrap.wizard.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/x_wizard/js/wizard.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/xiphias.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/controls.js'); ?>"></script>

</html>
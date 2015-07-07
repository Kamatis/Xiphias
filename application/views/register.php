<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register</title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="<?php echo base_url('assets/bootstrap-3.3.4-dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/x_wizard/css/gsdk-base.css'); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">

</head>

<body>
  <div class="image-container set-full-height" style="background: #73afad;">
    <!-- style="background-image: url('images/wizard.jpg')" -->

    <!--   Big container   -->
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

          <!--      Wizard container        -->
          <div class="wizard-container">
            <form action="" method="">
              <div class="card wizard-card ct-wizard-orange" id="wizard">

                <!--        You can switch "ct-wizard-orange"  with one of the next bright colors: "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"             -->

                <div class="wizard-header">
                  <h3>
                        	   <b>BUILD</b> YOUR PROFILE <br>
                        	   <small>This information will let us know more about you.</small>
                        	</h3>
                </div>
                <ul>
                  <li><a href="#role" data-toggle="tab">Role</a>
                  </li>
                  <li><a href="#about" data-toggle="tab">About</a>
                  </li>
                  <li><a href="#account" data-toggle="tab">Account</a>
                  </li>
                  <li><a href="#house" data-toggle="tab">House</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane" id="role">
                    <div class="row">
                      <h4 class="info-text"> What will you be?</h4>
                      <div class="col-sm-6">
                        <div class="choice" data-toggle="wizard-radio">
                          <input type="radio" name="job" value="Player">
                          <div class="icon">
                            <i class="fa fa-pencil"></i>
                          </div>
                          <h6>Player</h6>
                          <h6 class="caption" style="display: none;">Choose Player if you are a student.<br>Players earn points, etc.. blah blah blah</h6>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="choice" data-toggle="wizard-radio">
                          <input type="radio" name="job" value="NPC">
                          <div class="icon">
                            <i class="fa fa-terminal"></i>
                          </div>
                          <h6>NPC</h6>
                          <h6 class="caption" style="display: none;">Choose NPC if you are an employee or a teacher.<br>NPC's create quests and parties for the players. Extra verification are required.</h6>
                        </div>

                      </div>
                    </div>
                  </div>

                  <!-- ABout section -->
                  <div class="tab-pane" id="about">
                    <h4 class="info-text"> Who are you? </h4>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                          <label for="txtLastname"><b>Last Name</b></label>
                          <input id="txtLastname" name="txtLastname" type="text" class="form-control required validation"
                                 data-toggle="popover" data-placement="left" data-trigger="focus" data-html="true"
                                 data-title=""
                                 data-valid="required alphanumspace">
                          <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
                        </div>
                        <div class="form-group has-feedback">
                          <label for="txtFirstname"><b>First Name</b></label>
                          <input id="txtFirstname" name="txtFirstname" type="text" class="form-control required validation"
                                 data-toggle="popover" data-placement="left" data-trigger="focus" data-html="true"
                                 data-title=""
                                 data-valid="required alphanumspace">
                          <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
                        </div>
                        <div class="form-group has-feedback">
                          <label for="txtMiddlename"><b>Middle Name</b></label>
                          <input id="txtMiddlename" name="txtMiddlename" type="text" class="form-control required validation"
                                 data-toggle="popover" data-placement="left" data-trigger="focus" data-html="true"
                                 data-title=""
                                 data-valid="required alphanumspace">
                          <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group has-feedback">
                          <label for="selCourse"><b>Course</b></label>
                          <select name="selCourse" class="form-control">
                              <?php echo $courses ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Account Section -->
                  <div class="tab-pane" id="account">
                    <div class="row">
                      <div class="col-sm-12">
                        <h4 class="info-text"> How should you log in? </h4>
                      </div>
                      <div class="col-sm-10 col-sm-offset-1">
                        <div class="form-group has-feedback">
                          <label for="txtUsername"><b>Username</b></label>
                          <input id="txtUsername" name="txtUsername" type="text" class="form-control required validation"
                                 data-toggle="popover" data-placement="left" data-trigger="focus" data-html="true"
                                 data-title=""
                                 data-valid="required alpha_num reqlength"
                                 data-min-length="7" data-max-length="32">
                          <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
                        </div>
                      </div>
                      <div class="row-fluid">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                          <label class="form-group has-feedback">
                            <label for="txtPassword"><b>Password</b></label>
                            <input id="txtPassword" name="txtPassword" type="password" class="form-control required validation"
                                   data-toggle="popover" data-placement="left" data-trigger="focus" data-html="true"
                                   data-title=""
                                   data-valid="required alpha_num reqlength"
                                   data-min-length="7" data-max-length="32">
                            <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
                          </label>
                        </div>
                        <div class="col-sm-5">
                          <label class="form-group has-feedback">
                            <label for="txtRepeatPassword"><b>Repeat password</b></label>
                            <input id="txtRepeatPassword" name="txtRepeatPassword" type="password" class="form-control required validation"
                                   data-toggle="popover" data-placement="left" data-trigger="focus" data-html="true"
                                   data-title=""
                                   data-valid="required alpha_num reqlength match"
                                   data-match="#txtPassword"
                                   data-min-length="7" data-max-length="32">
                            <span class="glyphicon glyphicon-remove color-red form-control-feedback x-mark" style="display: none"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End of Account Section -->
                  
                  <!-- House Section -->
                  <div class="tab-pane" id="house">
                    <h4 class="info-text">Knock! Knock!</h4>
                    <div class="row">
                      <div class="col-sm-12">
                      
                      </div>
                    </div>
                  </div>
                  <!-- End of House Section -->
                </div>                
                
                <div class="wizard-footer">
                  <div class="pull-right">
                    <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' />
                    <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Finish' />

                  </div>
                  <div class="pull-left">
                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </form>
          </div>
          <!-- wizard container -->
        </div>
      </div>
      <!-- end row -->
    </div>
    <!--  big container -->

  </div>

</body>

<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/bootstrap-3.3.4-dist/js/bootstrap.min.js'); ?>" type="text/javascript"></script>

<!--   plugins 	 -->
<script src="<?php echo base_url('assets/x_wizard/js/jquery.bootstrap.wizard.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/x_wizard/js/wizard.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/xiphias.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/validator.js'); ?>"></script>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title><?php echo $title ?></title>
  <link href="<?php echo base_url('assets/bootstrap-3.3.4-dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" >
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'" rel="stylesheet">
</head>

<body style="margin:0px">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #73afad; border: none;">
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="xiphiasMenu">
            <a href="#" style="color: #ececea">News</a>
          </li>
          <li class="xiphiasMenu">
            <a href="#" style="color: #ececea">Quests</a>
          </li>
          <li class="xiphiasMenu">
            <a href="#" style="color: #ececea">Leaderboards</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right" style="padding-right: 15px;">
          <li class="dropdown">
            <a href="#" style="color: #ececea" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <img class="user-image" src="<?php echo $user_image?>"> <?php echo $username?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?php echo base_url('index.php/pages/profile/'.$username); ?>">Profile</a>
              </li>
              <li><a href="#">Settings</a>
              </li>
              <li class="divider"></li>
              <li><a href="<?php echo base_url('index.php/pages/logout'); ?>">Log Out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  
    <div class="container" style="margin-top: 100px">
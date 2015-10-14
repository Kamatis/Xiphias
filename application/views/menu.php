<nav class="navbar navbar-inverse navbar-fixed-top dashed-bottom" role="navigation" style="background: #73afad; border-bottom: 3px dashed #f6f6f6;">
  
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" style="color: #ececea" href="<?php echo base_url(); ?>">Xiphias</a>
  </div>
  
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="xiphiasMenu">
        <a href="#" style="color: #ececea">News</a>
      </li>
      <li class="xiphiasMenu">
        <a href="<?php echo base_url('index.php/pages/questboard'); ?>" style="color: #ececea">Quests</a>
      </li>
      <li class="xiphiasMenu">
        <a href="<?php echo base_url('index.php/pages/leaderboards'); ?>" style="color: #ececea">Leaderboards</a>
      </li>
      <li class="xiphiasMenu">
        <a href="<?php echo base_url('index.php/pages/famehall'); ?>" style="color: #ececea">Hall of Fame</a>
      </li>
      <?php if($isNPC) { ?>
      <li class="xiphiasMenu">
        <a href="<?php echo base_url('index.php/pages/dashboard'); ?>" style="color: #ececea"> 
          Dashboard 
          <?php if(!$isVerified) { ?>
          <i class="glyphicon glyphicon-lock"></i>
          <?php } else { ?>
					<span class="label label-danger" id="mainmenu-noti-count"><?php echo $noti; ?></span>
					<?php } ?>
        </a>
      </li>
      <?php } ?>
      <li>
        <form class="navbar-form" role="search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search user..." name="srch-term" id="srch-term">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
        </form>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="padding-right: 15px;">
      <li class="dropdown">
        <a href="#" style="color: #ececea" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        <img class="user-image" src="<?php echo $user_image; ?>" style="height:20px; width:auto"> <b id="username-plate" data-id="<?php echo $user_id; ?>"><?php echo $username;?></b> <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <?php if($isNPC) { ?>
            <?php if($isVerified) {?>
              <li class="dropdown-header">Use Xiphias as:</li>
              <?php foreach($offices as $office): ?>
                <li><a href=""><?php echo $office['officeName']; ?></a></li>
              <?php endforeach; ?>
            <?php }?>
            <?php if(!$isVerified) {?>
              <li><a href="#" id="verify-account"><span class="glyphicon glyphicon-ok"></span> Verify Account</a></li>
            <?php }?>
            <li class="divider"></li>
          <?php } ?>
          <li><a href="<?php echo base_url('index.php/pages/profile/' . $username); ?>"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
          <li><a href="<?php echo base_url('index.php/pages/settings'); ?>"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
					<li class="divider"></li>
					<li><a id="btn-view-party" href="#"><span class="fa fa-users"></span> View Parties</a></li>
					<li><a id="btn-join-party" href="#"><span class=""> Join Party</span></a></li>
          <li class="divider"></li>
          <li><a href="<?php echo base_url('index.php/pages/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

<li style="list-style: none; padding: 10px;">
  <div class="col-sm-10">
    <strong><a href="#"><?php echo $username; ?></a></strong> <?php echo $description; ?>
  </div>
  <div class="col-sm-2" style="padding: 0px !important;" width="50" height="50">
    <img src="<?php echo $pic_src; ?>" width="50" height="50"
         <?php if ($pic_src == "") echo 'style="opacity: 0;"'; ?>
         >
  </div>
  <div style="padding-left: 15px; font-size: 9pt; color: #868686"><small><?php echo $date; ?></small></div>
</li>
<div class="container-fluid" style="padding: 0px;">
  <hr style="margin: 0px;">
</div>

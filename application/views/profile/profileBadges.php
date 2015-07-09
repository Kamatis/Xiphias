<div class="profileEntry">
  <legend>Badges</legend>
  <div class="container-fluid">
    <?php
        $badge_count = count($badge);
        for($x = 0; $x < $badge_count; $x++) {
    ?>
    <div class="col-sm-2">
      <img class="badgeShow" src="<?php echo base_url($badge[$x]['imageSource']); ?>">
    </div>
    <?php } ?>
  </div>
</div>
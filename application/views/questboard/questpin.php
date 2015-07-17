<div class="flip-container" ontouchstart="this.classList.toggle('hover);" >
  <div class="flipper" >
    <div class="front 
      <?php if($rarity == 1) {
        echo "rarity-card-common";
      }
      else if($rarity == 2) {
        echo "rarity-card-uncommon";
      }
      else if($rarity == 3) {
        echo "rarity-card-rare";
      }
      else if($rarity == 4) {
        echo "rarity-card-legendary";
      }
      else if($rarity == 5) {
        echo "rarity-card-bluemoon";
      }?>">
      <div class="stitched">
        <!-- front content -->
        <div class="choice">
          <img class="icon" src="<?php echo $creator_logo; ?>">
        </div>
        <div class="choice" style="overflow: hidden;">
          <text style="display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;"><strong><?php echo $title; ?></strong></text>
        </div>
        <div class="choice" style="overflow: hidden;">
          <text style="font-size: 9pt; font-style: italic; display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;"><?php echo $description; ?></text>
        </div>
      </div>
    </div>
    <div class="back
      <?php if($rarity == 1) {
        echo "rarity-card-common";
      }
      else if($rarity == 2) {
        echo "rarity-card-uncommon";
      }
      else if($rarity == 3) {
        echo "rarity-card-rare";
      }
      else if($rarity == 4) {
        echo "rarity-card-legendary";
      }
      else if($rarity == 5) {
        echo "rarity-card-bluemoon";
      }?>">
      <div class="stitched">
        <div class="questpin-info">
          <div>
            <h4 style="text-align: center"><strong><?php echo $title; ?></strong></h4>
          </div>
          <div>
            <text style="text-align: center"><?php echo $description; ?></text>
          </div>
          <div>
            <h6><b>Venue and Date</b></h6>
            <p style="font-size: 12px;"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $venue; ?></p>
            <p style="font-size: 12px;"><span class="glyphicon glyphicon-calendar"></span> <?php echo $quest_date; ?></p>
          </div>
          <div>
            <h6><b>Rewards:</b></h6>
            <div>
              <img src="<?php echo $badge_image; ?>" style="width: 20px; height: 20px; border: 0;">
              <text style="font-size: 12px;"><?php echo $badge_name; ?></text>
            </div>
            <text style="font-size: 12px;"><?php echo $experience; ?> XP</text>
            <text style="font-size: 12px;"><?php echo $house_points; ?> HP</text>
          </div>
        </div>
        <?php if(!$isNPC) { ?>
        <div class="questpin-control">
          <a href="#" class="btn btn-success form-control btn-join-quest" data-questId="<?php echo $quest_id; ?>" style="background-color: #740AB8;"><?php if(!$joined) {?>Join<?php } else { ?>Abort<?php } ?></a>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
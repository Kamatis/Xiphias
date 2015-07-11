<div class="flip-container" ontouchstart="this.classList.toggle('hover);">
  <div class="flipper">
    <div class="front 
      <?php if($rarity == 0) {
        echo "rarity-card-common";
      }
      else if($rarity == 1) {
        echo "rarit-card-uncommon";
      }
      else if($rarity == 2) {
        echo "rarity-card-rare";
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
      </div>
    </div>
    <div class="back
      <?php if($rarity == 0) {
        echo "rarity-card-common";
      }
      else if($rarity == 1) {
        echo "rarit-card-uncommon";
      }
      else if($rarity == 2) {
        echo "rarity-card-rare";
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
        <!-- back content -->
      </div>
    </div>
  </div>
</div>
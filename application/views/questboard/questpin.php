<div class="flip-container" ontouchstart="this.classList.toggle('hover);">
  <div class="flipper">
    <div class="front 
      <?php if($rarity == 0) {
        echo "rarity-card-common";
      }
      else if($rarity == 1) {
        echo "rarity-card-uncommon";
      }
      else if($rarity == 2) {
        echo "rarity-card-rare";
      }
      else if($rarity == 3) {
        echo "rarity-card-legendary";
      }
      else if($rarity == 4) {
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
  -webkit-box-orient: vertical;">The QUick brown fox jumps over the lazy dog The QUick brown fox jumps over the lazy dog</text>
        </div>
        <div class="choice" style="overflow: hidden;">
          <text style="font-size: 9pt; font-style: italic; display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lacus lacus, consectetur nec vulputate eu, laoreet ut nisl. Mauris nec ante sed elit iaculis pulvinar a quis quam. Praesent et urna ac turpis tincidunt rhoncus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed vitae nisi interdum, rutrum ipsum vitae, fringilla libero. Nunc sed tincidunt mauris. Mauris a imperdiet felis, ut sodales tortor. Proin vitae venenatis nulla, vel efficitur ante. Nulla vel metus rhoncus, imperdiet augue a, posuere risus.</text>
        </div>
      </div>
    </div>
    <div class="back
      <?php if($rarity == 0) {
        echo "rarity-card-common";
      }
      else if($rarity == 1) {
        echo "rarity-card-uncommon";
      }
      else if($rarity == 2) {
        echo "rarity-card-rare";
      }
      else if($rarity == 3) {
        echo "rarity-card-legendary";
      }
      else if($rarity == 4) {
        echo "rarity-card-bluemoon";
      }?>">
      <div class="stitched">
        <div class="questpin-info">
          <div>
            <h4 style="text-align: center"><strong>Quest Title</strong></h4>
          </div>
          <div>
            <text>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi lacus lacus, consectetur nec vulputate eu, laoreet ut nisl. Mauris nec ante sed elit iaculis pulvinar a quis quam. Praesent et urna ac turpis tincidunt rhoncus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed vitae nisi interdum, rutrum ipsum vitae, fringilla libero. Nunc sed tincidunt mauris. Mauris a imperdiet felis, ut sodales tortor. Proin vitae venenatis nulla, vel efficitur ante. Nulla vel metus rhoncus, imperdiet augue a, posuere risus.</text>
          </div>
          <div>
            <text>Quest Venue</text>
          </div>
          <div>
            <text>Quest Date</text>
          </div>
          <div>
            <h6><b>Rewards:</b></h6>
            <div>
              <div>
                <img src="http://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2014/11/1415490092badge.png" style="width: 20px; height: 20px">
                <text>Badge Name</text>
              </div>
              
              <text>100 XP</text>
              <text>10 HP</text>
            </div>
          </div>
        </div>
        <div class="questpin-control">
          <a href="#" class="btn btn-success form-control" style="background-color: #740AB8;">Join</a>
        </div>
      </div>
    </div>
  </div>
</div>
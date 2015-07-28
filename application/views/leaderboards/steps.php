<div class="stair-step house-<?php if($houseid1 != "") echo $houseid1; else echo "gray"; ?>">
  <div class="header-name house-<?php if($houseid1 != "") echo $houseid1; else echo "gray"; ?>">
    <a href="<?php echo $namelink1; ?>" class="white-link">
      <?php if($name1 != "" ) echo $name1; else echo "--" ?>
    </a>
  </div>
  <div class="header-lvl-house house-<?php if($houseid1 != "") echo $houseid1; else echo "gray"; ?>">
    <p>Lvl
      <?php if($playerLevel1 != "" ) echo $playerLevel1; else echo "--"; ?>
    </p>
    <img src="<?php echo $houseLogo; ?>" style="width: 50px; height: 50px;">
  </div>
  <div class="body-badge-award">
    <img src="<?php echo $sembadge; ?>" class="place-second">
  </div>
  <div class="footer-place house-<?php if($houseid1 != "") echo $houseid1; else echo "gray"; ?>">
    2nd
  </div>
</div>

<div class="stair-step house-<?php if($houseid0 != "") echo $houseid0; else echo "gray"; ?>">
  <div class="header-name house-<?php if($houseid0 != "") echo $houseid0; else echo "gray"; ?>">
    <a href="<?php echo $namelink0; ?>" class="white-link">
      <?php if($name0 != "" ) echo $name0; else echo "--" ?>
    </a>
  </div>
  <div class="header-lvl-house house-<?php if($houseid0 != "") echo $houseid0; else echo "gray"; ?>">
    <p>Lvl
      <?php if($playerLevel0 != "" ) echo $playerLevel0; else echo "--"; ?>
    </p>
    <img src="<?php echo $houseLogo; ?>" style="width: 50px; height: 50px;">
  </div>
  <div class="body-badge-award">
    <img src="<?php echo $sembadge; ?>" class="place-first">
  </div>
  <div class="footer-place house-<?php if($houseid0 != "") echo $houseid0; else echo "gray"; ?>">
    1st
  </div>
</div>

<div class="stair-step house-<?php if($houseid2 != "") echo $houseid2; else echo "gray"; ?>">
  <div class="header-name house-<?php if($houseid2 != "") echo $houseid2; else echo "gray"; ?>">
    <a href="<?php echo $namelink2; ?>" class="white-link">
      <?php if($name2 != "" ) echo $name2; else echo "--" ?>
    </a>
  </div>
  <div class="header-lvl-house house-<?php if($houseid2 != "") echo $houseid2; else echo "gray"; ?>">
    <p>Lvl
      <?php if($playerLevel2 != "" ) echo $playerLevel2; else echo "--"; ?>
    </p>
    <img src="<?php echo $houseLogo; ?>" style="width: 50px; height: 50px;">
  </div>
  <div class="body-badge-award">
    <img src="<?php echo $sembadge; ?>" class="place-third">
  </div>
  <div class="footer-place house-<?php if($houseid2 != "") echo $houseid2; else echo "gray"; ?>">
    3rd
  </div>
</div>
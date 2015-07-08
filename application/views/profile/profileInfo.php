<!-- value: current exp -->
<!-- data-min: exp-to-go of lvl -->
<!-- data-max: exp-to-go of lvl+1 -->
<?php if(!$isNPC){ ?>

<img id="profile-pic" style="display:none" src="<?php echo base_url($lvl_image); ?>">
<input class="knob" data-fgcolor="#c33131" data-thickness=".25" readonly="readonly" data-width="200" value="<?php echo $experience; ?>" data-min="<?php echo $min_exp; ?>" data-max="<?php echo $max_exp; ?>">
<?php } ?>

<h2 class=""><?php echo $username ?></h2>
<?php if(!$isNPC){ ?>
    <h4> Lvl <?php echo $player_level; ?> </h4>
<?php } ?>

<hr>
<h5><?php echo $name ?></h5>
<?php if(!$isNPC){ ?>
    <h5> <?php echo $course; ?> </h5>
<?php } ?>

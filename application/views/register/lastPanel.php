<!-- $isPlayer kung 1 ang value kang user_type -->
<!-- $houseName = house na makukua mo duman sa sequence -->

<?php if($isPlayer) {?>

I've picked a house for you already. You now belong to <?php echo $house['house_name'] ?>! Your very own adventure in the university is about to unfold! You can now go back to log in. Let's go!

<?php } else {?>

Hold on! You can't create badges and quests quite yet. In order for me to verify you, you should ask the admin for a serial code.
You can now go back to log in, though, and experience the adventure in the university. Let's go!

<?php
  }
?>
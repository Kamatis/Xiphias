<form method="post" id="edit-profile" class="form-horizontal" role="form">
  
<!--  INFO -->
  <legend>Info</legend>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Description:</label>
    <div class="col-sm-10">
      <textarea name="description" class="form-control" id="user-description" placeholder="What's up?" value="<?php echo $description; ?>"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Program:</label>
    <div class="col-sm-10"> 
      <select class="form-control" name="program_code">
        <?php echo $programs; ?>
      </select>
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button id="btn-save-profile" type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
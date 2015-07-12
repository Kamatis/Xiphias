<div class="row badge-level">
  <div class="col-sm-2">
    <div class="picture-container">
      <div class="upgrade-picture">
        <img src="<?php echo $imageSource; ?>" class="picture-src" >
        <input type="file" class="input-preview" name="badge-pix[]">
      </div>
    </div>
  </div>
  <div class="badge-level-content col-sm-9">
    <div class="input-group">
      <span class="input-group-addon"><i>Name: </i></span>
      <input type="text" value="<?php echo $badgeName; ?>" class="form-control" name="txtBadgeName[]">
      <span class="input-group-addon"><i>Req: </i></span>
      <input type="text" value="<?php echo $requirement; ?>" class="form-control" style="width: 50px;" name="txtRequirement[]">
    </div>
  </div>
  <div class="col-sm-offset-1 badge-level-delete">
    <button type="button" class="btn btn-danger btn-delete-upgrade">
      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    </button>
  </div>
</div>


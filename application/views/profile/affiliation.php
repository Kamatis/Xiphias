<div class="form-group"> 
  <label class="control-label col-sm-2" for="email">Affiliation <?php echo $affilNum; ?>:</label>
  <div class="col-sm-7">
    <input type="text" class="form-control input-affil"style="display: none">
    <select class="form-control select-affil">
      <?php echo $affiliations; ?>
    </select>
  </div>
  <div class="col-sm-1">
    <a href="#" class="btn btn-default form-control affil-add"><span class="glyphicon glyphicon-plus"></span> Add</a>
    <a href="#" class="btn btn-default form-control affil-list" style="display: none;"><i class="fa fa-th-list"></i> List</a>
  </div>
  <div class="col-sm-2">
    <select class="form-control">
      <?php echo $years; ?>
    </select>
  </div>
</div>
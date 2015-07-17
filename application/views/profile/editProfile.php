<form class="form-horizontal" role="form">
  
<!--  INFO -->
  <legend>Info</legend>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Description:</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="email" placeholder="What's up?" value="<?php echo $description; ?>"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Program:</label>
    <div class="col-sm-10"> 
      <select class="form-control">
        <?php echo $programs; ?>
      </select>
    </div>
  </div>
  
<!--  EDUC -->
  <legend>Educational Background</legend>
  <div class="form-group"> 
    <label class="control-label col-sm-2" for="email">Primary School/Graduate Year:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control typeahead" id="input-primary" style="display: none" data-provide="typeahead">
      <select class="form-control" id="select-primary">
        <?php echo $primary; ?>
      </select>
    </div>
    <div class="col-sm-1">
      <a href="#" class="btn btn-default form-control" id="primary-add"><span class="glyphicon glyphicon-plus"></span> Add</a>
      <a href="#" class="btn btn-default form-control" id="primary-list" style="display:none;"><i class="fa fa-th-list"></i> List</a>
    </div>
    <div class="col-sm-2">
      <select class="form-control">
        <?php echo $years; ?>
      </select>
    </div>
  </div>
  <div class="form-group"> 
    <label class="control-label col-sm-2" for="email">Secondary School/Graduate Year:</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="input-secondary" style="display: none">
      <select class="form-control" id="select-secondary">
        <?php echo $secondary; ?>
      </select>
    </div>
    <div class="col-sm-1">
      <a href="#" class="btn btn-default form-control" id="secondary-add"><span class="glyphicon glyphicon-plus"></span> Add</a>
      <a href="#" class="btn btn-default form-control" id="secondary-list" style="display: none;"><i class="fa fa-th-list"></i> List</a>
    </div>
    <div class="col-sm-2">
      <select class="form-control">
        <?php echo $years; ?>
      </select>
    </div>
  </div>
  
<!--  Affiliations-->
  <legend>Affiliations<a href="#" class="btn pull-right"><i class="fa fa-plus"></i> Add</a></legend>
  <div class="form-group">
    <?php if(count($affiliations) == 0) { ?> 
      <div class="col-sm-12 text-center">No affiliations yet.</div>
    <?php } else { ?>
      <?php echo $affiliations; ?>
    <?php } ?>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
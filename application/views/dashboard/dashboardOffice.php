<div id="dashboard-office" class="dashboard-page" style="display: none">
  <a href="#">
    <strong>
      Office Dashboard
    </strong>
  </a>
  <hr>

  <div class="col-md-7">
    <form id="office-form" method="post" action="" class="form-horizontal">
      <div class="form-group">
        <div class="picture-container">
          <div class="picture">
            <img id="office-logo" src="<?php echo base_url('assets/images/emptyBadge.png'); ?>" class="picture-src" title>
            <input name="office-pix" type="file" class="input-preview">
          </div>
        </div>
      </div>

      <div class="form-group">
        <legend><h5><strong>Name</strong></h5></legend>
        <input name="officeName" type="text" id="txt-office-name" class="form-control" placeholder="Enter office name">
      </div>

      <div class="form-group">
        <legend><h5><strong>Description</strong></h5></legend>
        <textarea name="officeDescription" id="txt-office-description" class="form-control" placeholder="Enter office description"></textarea>
      </div>
      
      <div class="row">
        <div class="form-group">
          <a class="btn btn-primary pull-right m-right">Revert</a>
          <a class="btn btn-success pull-right m-right" id="btn-office-save" style="display: none">Save</a>
          <a class="btn btn-success pull-right m-right" id="btn-office-add">Add</a>
        </div>
      </div>
    </form>
  </div>

  <!-- My Offices Panel -->
  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        My Offices
      </div>
      <div class="panel-body">
        <input type="text" id="txt-search" class="form-control" placeholder="Search office">
        <ul id="office-list" class="nav nav-stacked scrollable-menu">
          <?php echo $myOffices; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
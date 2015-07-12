<div id="dashboard-office" class="dashboard-page" style="display: none">
  <a href="#">
    <strong>
      Office Dashboard
    </strong>
  </a>
  <hr>

  <div class="col-md-7">
    <form method="post" action="" class="form-horizontal">
      <div class="form-group">
        <div class="picture-container">
          <div class="picture">
            <img id="base-lvl-badge" src="<?php echo base_url('assets/images/emptyBadge.png'); ?>" class="picture-src" title>
            <input type="file" class="input-preview">
          </div>
        </div>
      </div>

      <div class="form-group">
        <legend><h5><strong>Name</strong></h5></legend>
        <input type="text" id="txtBadgeName" class="form-control" placeholder="Enter office name">
      </div>

      <div class="form-group">
        <legend><h5><strong>Description</strong></h5></legend>
        <textarea id="txtaDescription" class="form-control" placeholder="Enter office description"></textarea>
      </div>
      
      <div class="row">
        <div class="form-group">
          <a class="btn btn-primary pull-right m-right">Revert</a>
          <a class="btn btn-success pull-right m-right" id="btn-save" style="display: none">Save</a>
          <a class="btn btn-success pull-right m-right" id="btn-add">Add</a>
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
        <ul class="grid columns-3">
          <?php echo $mybadges ?>
        </ul>
      </div>
    </div>
  </div>
</div>
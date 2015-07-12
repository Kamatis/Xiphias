<div id="dashboard-badge" class="dashboard-page">
  <a href="#">
    <strong>
      Badge Dashboard
    </strong>
  </a>
  <hr>

  <div class="col-md-7">
    <form id="badge-form" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
      <div class="form-group">
        <div class="picture-container">
          <div class="picture">
            <img id="base-lvl-badge" src="<?php echo base_url('assets/images/emptyBadge.png'); ?>" class="picture-src" title>
            <input type="file" name="badge-pix[]" class="input-preview" accept="image/*">
          </div>    
        </div>
      </div>

      <div class="form-group">
        <legend><h5><strong>Name</strong></h5></legend>
        <input type="text" name="txtBadgeName[]" id="txtBadgeName" class="form-control" placeholder="Badge Name">
      </div>

      <div class="form-group">
        <legend><h5><strong>Description</strong></h5></legend>
        <textarea name="txtaBadgeDescription" id="txtaDescription" class="form-control" placeholder="Enter badge description"></textarea>
      </div>

      <!-- Upgrades of Badges -->      
      <div id="badge-level-wrapper" class="badge-level-wrapper form-group">
        <legend><h5><strong>Upgrades</strong></h5></legend>
        <?php echo $badgeUpgrades; ?>
      </div>
      
      <div class="form-group" >
        <button id="btnAddBadge" type="button" class="btn btn-default btn-lg btn-block badge-add" style="border: 3px dashed gray; border-radius: 0px;">
          <i class="glyphicon glyphicon-plus"></i>
          Add Badge Level
        </button>
      </div>
      
      <div class="row">
        <div class="form-group">
          <a class="btn btn-primary pull-right m-right">Revert</a>
          <a class="btn btn-success pull-right m-right" id="btn-save" style="display: none">Save</a>
          <a class="btn btn-success pull-right m-right" id="btn-add-badge">Add</a>
        </div>
      </div>
    </form>
  </div>

  <!-- My Badges Panel -->
  <div class="col-md-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        My Badges
      </div>
      <div class="panel-body" id="badge-panel-body">
        <ul class="grid columns-3" id="my-badges">
          <?php echo $mybadges ?>
        </ul>
      </div>
    </div>
  </div>
</div>
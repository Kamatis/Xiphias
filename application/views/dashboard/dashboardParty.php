<!-- Party dashboard Starts here -->

<div id="dashboard-party" class="dashboard-page" style="display: none">
  <a href="#">
    <strong>
      Party Dashboard
    </strong>
  </a>
  <hr>

  <div class="col-md-7">
    <form id="party-form" method="post" action="" class="form-horizontal">
      <div class="form-group">
        <legend><h5><strong>Name</strong></h5></legend>
        <input name="partyName" type="text" class="form-control" placeholder="Party Name" id="txt-party-name">
      </div>
      
      <div class="form-group">
        <legend><h5><strong>Passcode</strong></h5></legend>
        <div class="col-sm-8">
          <input name="partyPasscode" type="password" class="form-control" placeholder="Enter Passcode" id="pw-passcode">
        </div>
        <div class="col-sm-4">
          <button class="btn btn-default form-control" id="btn-change-passcode" data-selparty="">Change Passcode</button>
        </div>
      </div>

      <div class="form-group">
        <legend><h5><strong>Description</strong></h5></legend>
        <textarea name="partyDescription" class="form-control" placeholder="Enter party description" id="txt-party-description"></textarea>
      </div>
      
      <!-- Party Members -->      
      <div class="row">
        <div class="form-group">
          <a class="btn btn-primary pull-right m-right">Revert</a>
          <a class="btn btn-success pull-right m-right" id="btn-party-save" style="display: none">Save</a>
          <a class="btn btn-success pull-right m-right" id="btn-party-add">Add</a>
        </div>
      </div>
    </form>
  </div>
  
  <div class="col-md-5">
    <!-- My Parties Panel -->
    <div class="panel panel-default">
      <div class="panel-heading">
        My Parties
      </div>
      <div class="panel-body">
        <input type="text" id="txt-search" class="form-control" placeholder="Search party">
        <ul id="party-list" class="nav nav-stacked scrollable-menu">
          <?php echo $myParties; ?>
        </ul>
      </div>
    </div>
    
    <!-- Party Members -->
    <div class="panel panel-default">
      <div class="panel-heading">
        Party Members
        <a id="btn-del-pmember" class="btn btn-danger btn-xs pull-right"><i class="glyphicon glyphicon-trash"></i></a>
        <a class="btn btn-warning btn-xs m-right pull-right" id="btn-award-badge"><i class="glyphicon glyphicon-star"></i></a>
      </div>
      <div class="panel-body">
        <input type="text" class="form-control txt-search" data-where="party_member" placeholder="Search party member">
        <ul id="party-member-list" class="nav nav-stacked scrollable-menu">
          
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Quest dashboard Starts here -->
<div id="dashboard-quest" data-form="#form-quest" class="dashboard-page" style="display: none">
  <a href="#">
    <strong>
      Quest Dashboard
    </strong>
  </a>
  <hr>

  <div class="col-md-7">
    <form name="quest-form" id="form-quest" method="post" action="" class="form-horizontal">
      <div class="form-group">
        <legend><h5><strong>Title</strong></h5></legend>
        <input name="questName" type="text" class="form-control" placeholder="Quest Title" id="quest-name">
      </div>

      <div class="form-group">
        <legend><h5><strong>Description</strong></h5></legend>
        <textarea name="questDescription" class="form-control" placeholder="Enter quest description" id="quest-description"></textarea>
      </div>

      <!-- rarity of quests -->
      <div class="form-group">
        <legend><h5><strong>Quest Rarity</strong></h5></legend>
        <div class="col-md-5ths">
          <div class="choice" data-toggle="radio">
            <input type="radio" name="rarity" value="1" id="rarity1">
            <div class="icon">
              <i class="fa fa-pencil"></i>
            </div>
            <h6>Common</h6>
            <h6 class="caption" style="display: none;">Choose Player if you are a student.<br>Players earn points, etc.. blah blah blah</h6>
          </div>
        </div>
        <div class="col-md-5ths">
          <div class="choice" data-toggle="radio">
            <input type="radio" name="rarity" value="2" id="rarity2">
            <div class="icon">
              <i class="fa fa-pencil"></i>
            </div>
            <h6>Uncommon</h6>
          </div>
        </div>
        <div class="col-md-5ths">
          <div class="choice" data-toggle="radio">
            <input type="radio" name="rarity" value="3" id="rarity3">
            <div class="icon">
              <i class="fa fa-pencil"></i>
            </div>
            <h6>Rare</h6>
          </div>
        </div>
        <div class="col-md-5ths">
          <div class="choice" data-toggle="radio">
            <input type="radio" name="rarity" value="4" id="rarity4">
            <div class="icon">
              <i class="fa fa-pencil"></i>
            </div>
            <h6>Legendary</h6>
          </div>
        </div>
        <div class="col-md-5ths">
          <div class="choice" data-toggle="radio">
            <input type="radio" name="rarity" value="5" id="rarity5">
            <div class="icon">
              <i class="fa fa-pencil"></i>
            </div>
            <h6>Blue Moon</h6>
          </div>
        </div>
      </div>
      
      <!-- Date -->
      <div class="form-group">
        <legend><h5><strong>Date</strong></h5></legend>
        <input type="text" name="date-range" id="quest-date" class="form-control"> 
      </div>
      
      <!-- Venue -->
      <div class="form-group">
        <legend><h5><strong>Venue</strong></h5></legend>
        <input type="text" name="questVenue" id="quest-venue" class="form-control">
      </div>
      
      <!-- Quest Rewards -->
      <div class="form-group">
        <legend><h5><strong>Rewards</strong></h5></legend>
        <input type="text" placeholder="Enter EXP" name="questExp" id="quest-exp" class="form-control">
      </div>
      
      <div class="row">
        <div class="form-group">
          <button class="btn btn-primary pull-right m-right">Revert</button>
          <button class="btn btn-success pull-right m-right" id="btn-quest-save" style="display: none">Save</button>
          <button class="btn btn-success pull-right m-right" id="btn-quest-add">Add</button>
        </div>
      </div>
    </form>
  </div>

  <div class="col-md-5">
    <!-- My Quests Panel -->
    <div class="panel panel-default">
      <div class="panel-heading">
        My Quests
      </div>
      <div class="panel-body">
        <input type="text" id="txt-search" class="form-control" placeholder="Search quest">
        <ul id="quest-list" class="nav nav-stacked scrollable-menu">
          <?php echo $myQuests; ?>
        </ul>
      </div>
    </div>
    
    <!-- Quest Registrants -->
    <div class="panel panel-default">
      <div class="panel-heading">
        Registrants
        <button id="btn-del-qmember" class="btn btn-danger btn-xs pull-right"><i class="glyphicon glyphicon-trash"></i></button>
        <button type="button" class="btn btn-warning btn-xs m-right pull-right" id="btn-award-badge"><i class="glyphicon glyphicon-star"></i></button>
        <button type="button" class="btn btn-success btn-xs m-right pull-right" id="btn-qreg-refresh"><i class="glyphicon glyphicon-refresh"></i></button>

      </div>
      <div class="panel-body">
        <input type="text" id="txt-search" data-where="quest-member" class="form-control" placeholder="Search registrants">
        <ul id="quest-members" class="nav nav-stacked scrollable-menu">
          
        </ul>
      </div>
    </div>
  </div>
</div>
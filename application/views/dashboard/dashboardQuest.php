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
        <div id="questRarities">
          <?php echo $questRarities; ?>
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
        <div class="range range-success">
          <output id="exp-label">EXP</output>
          <input type="range" name="range" min="" max="" value="" oninput="rangeSuccess.value=value" disabled>
          <output id="rangeSuccess">--</output>
        </div>
        <div id="quest-badge-reward" class="choice" data-badgeid="0" data-toggle="popover" data-trigger="focus" data-placement="top" title="Badge Reward" data-html="true" data-content="">
          <img class="icon" id="badge-reward-img" src="" alt="Badge">
        </div>
      </div>
      
      <div class="row">
        <div class="form-group">
          <button class="btn btn-primary pull-right m-right" id="btn-quest-revert">Revert</button>
          <button class="btn btn-success pull-right m-right" id="btn-quest-save" style="display: none">Save</button>
          <a class="btn btn-success pull-right m-right" id="btn-quest-add">Add</a>
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
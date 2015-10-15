<!-- Quest dashboard Starts here -->
<div id="dashboard-quest" data-form="#form-quest" class="dashboard-page" style="display: none">
  <a href="#">
    <strong>
      Quest Dashboard
    </strong>
  </a>
  <hr>

  <div class="col-md-7">
    <form name="quest-form" id="form-quest" method="post" action="#" class="form-horizontal" enctype="multipart/form-data">
      <div class="form-group">
        <legend><h5><strong>Title</strong></h5></legend>
        <input name="questName" type="text" class="form-control" placeholder="Quest Title" id="quest-name">
      </div>

      <div class="form-group">
        <legend><h5><strong>Description</strong></h5></legend>
        <textarea name="questDescription" class="form-control" placeholder="Enter quest description" id="quest-description"></textarea>
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
      
			<!-- Frequency -->
			<div class="form-group">
				<legend><h5><strong>Frequency</strong></h5></legend>
				<div class="btn-group" data-toggle="buttons" role="group" aria-label="...">
					<label class="btn btn-default db-freq active" id="quest-frq-1">
						<input type="radio" name="quest_frequency" value="1" autocomplete="off" checked>
						<span class="glyphicon glyphicon-ok"></span> Once
					</label>
					<label class="btn btn-default db-freq" id="quest-frq-2">
						<input type="radio" name="quest_frequency" value="2" autocomplete="off">
						<span class="glyphicon glyphicon-ok"></span> Weekly
					</label>
					<label class="btn btn-default db-freq" id="quest-frq-3">
						<input type="radio" name="quest_frequency" value="3" autocomplete="off">
						<span class="glyphicon glyphicon-ok"></span> Monthly
					</label>
					<label class="btn btn-default db-freq" id="quest-frq-4">
						<input type="radio" name="quest_frequency" value="4" autocomplete="off">
						<span class="glyphicon glyphicon-ok"></span> Semestral
					</label>
					<label class="btn btn-default db-freq" id="quest-frq-5">
						<input type="radio" name="quest_frequency" value="5" autocomplete="off">
						<span class="glyphicon glyphicon-ok"></span> Annual
					</label>
				</div>
			</div>

			<!-- Type -->
			<div class="form-group">
				<legend><h5><strong>Type</strong></h5></legend>
				<div class="btn-group" data-toggle="buttons" role="group" aria-label="...">
					<label class="btn btn-default db-type" id="quest-typ-1">
						<input type="radio" name="quest_type" value="1" autocomplete="off">
						<span class="glyphicon glyphicon-ok"></span> Academic
					</label>
					<label class="btn btn-default db-type" id="quest-typ-2">
						<input type="radio" name="quest_type" value="2" autocomplete="off">
						<span class="glyphicon glyphicon-ok"></span> Co-curricular
					</label>
					<label class="btn btn-default db-type" id="quest-typ-3">
						<input type="radio" name="quest_type" value="3" autocomplete="off">
						<span class="glyphicon glyphicon-ok"></span> Extra Curricular
					</label>
				</div>
			</div>

      <!-- Quest Rewards -->
      <div class="form-group">
        <legend><h5><strong>Badge Reward</strong></h5></legend>

        <div class="badge-reward-list">
          <?php echo $badgeRewards; ?>
        </div>
      </div>
      
      <div class="row">
        <div class="form-group">
          <a class="btn btn-primary pull-right m-right" id="btn-quest-revert">Revert</a>
          <a class="btn btn-success pull-right m-right" id="btn-quest-save" style="display: none">Save</a>
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
      <form action="#" id="quest-registrants" method="post" class="panel-body">
        <input name="reg-search" type="text" id="txt-search" data-where="quest-member" class="form-control" placeholder="Search registrants">
        <ul id="quest-members" class="nav nav-stacked scrollable-menu">
          
        </ul>
      </form>
    </div>
  </div>
</div>

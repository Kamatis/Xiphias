<div id="dashboard-office" class="dashboard-page" style="display: none">
  <a href="#">
    <strong>
      Office Dashboard
    </strong>
  </a>
  <hr>

  <div class="col-md-7">
    <form id="office-add-form" method="post" action="" class="form-horizontal" style="display: none;">
			<legend>Request for Office Addition</legend>
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
        <input name="officeLongName" type="text" id="txt-office-name" class="form-control" placeholder="Enter office name">
      </div>

			<div class="form-group">
        <legend><h5><strong>Short Name</strong></h5></legend>
        <input name="officeShortName" type="text" id="txt-office-name" class="form-control" placeholder="Enter abbreviation or acronym of office">
      </div>
      
      <div class="row">
        <div class="form-group">
          <a class="btn btn-primary pull-right m-right">Revert</a>
          <a class="btn btn-success pull-right m-right" id="btn-office-save" style="display: none">Save</a>
          <a class="btn btn-success pull-right m-right" id="btn-office-add">Add</a>
        </div>
      </div>

			<legend>Join an Office</legend>
			<div class="form-group">
				<select class="form-control combobox" id="select-office">
					<?php echo $officeOptions; ?>
				</select>
			</div>
        <div class="form-group">
          <a class="btn btn-success">Join</a>
        </div>
    </form>

		<form id="office-manage-form" method="post" action="" class="form-horizontal">
			<div class="form-group">
				<h3 style="margin-bottom: 0px" id="office-shortname"></h3>
				<h6 style="margin-bottom: 20px;" id="office-longname"></h6>
			</div>

			<div class="form-group">
				<legend>Roles</legend>
				<div class="col-sm-12">
					<div id="add-success-alert" class="alert alert-danger alert-dismissible" style="display: none" role="alert">
						<a id="add-success-alert-close" class="close" aria-label="Close" aria-hidden="true"><span aria-hidden="true">&times;</span></a>
						<span id="add-success-alert-msg"><strong>Error!</strong> Username not found.</span>

					</div>
					<div class="row">
						<div class="col-sm-5">
							<input type="text" id="role-user-name" class="form-control" placeholder="Username">
						</div>
						<div class="col-sm-5">
							<input type="text" id="role-user-role" class="form-control" placeholder="Role">
						</div>
						<a id="add-role-member" class="btn btn-default">Add</a>
					</div>

					<div class="roles-table-container" style="padding-top: 10px;">
						<table id="roles-table" data-toggle="table" data-url="" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, 500]">
							<thead>
								<tr>
									<th data-field="approved" data-align="center" data-formatter="approval" class="col-lg-1 col-sm-1"></th>
									<th data-field="username" data-formatter="namelink" class="col-lg-5 col-sm-5">USERNAME</th>
									<th data-field="role" data-align="center" class="col-lg-3 col-sm-3">ROLE</th>
									<th data-field="badge-actions" data-formatter="boolIcon" data-align="center" class="col-lg-1 col-sm-3"><img src="http://localhost/xiphias/assets/images/badge_icon.png" style="width: 20px; height: 20px;" title="Let user create, edit and delete a badge"></th>
									<th data-field="quest-actions" data-formatter="boolIcon" data-align="center" class="col-lg-1 col-sm-1"><img src="http://localhost/xiphias/assets/images/quest_icon.png" style="width: 18px; height: 18px;" title="Let user create, edit and postpone quests"></th>
									<th data-field="deleteRole" data-formatter="delButton" data-align="center" class="col-lg-1 col-sm-1 role-del-button"></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>

			<div class="form-group">
				<legend>Leadership</legend>
				<div class="col-sm-12">
					<div class="input-group">
						<input type="text" id="pass-leader-name" class="form-control" placeholder="Enter username or full name">
						<span class="input-group-btn">
							<a id="pass-leadership" class="btn btn-default" type="button">Pass leadership</a>
						</span>
					</div>
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

<script>
$(document).ready(function(){
	$('.combobox').combobox();
});
</script>

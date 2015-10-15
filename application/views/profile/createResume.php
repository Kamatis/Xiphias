<form action="http://localhost/xiphias/index.php/pages/resume" method="post" class="form-horizontal" role="form">
  
<!--  picture-->
  <legend>Photo</legend>
  <div class="form-group">
    <div class="picture-container">
      <div class="picture" style="border-radius: 0px;">
        <img id="base-lvl-badge" src="<?php echo base_url('assets/images/emptyBadge.png'); ?>" class="picture-src"  title>
        <input type="file" name="resumePhoto" class="input-preview" accept="image/*">
      </div>    
    </div>
  </div>
	
	<legend>Personal</legend>
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Address:</label>
    <div class="col-sm-10">
      <textarea id="address" name="address" class="form-control"><?php echo $address; ?></textarea>
    </div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Contact #:</label>
    <div class="col-sm-10">
      <input id="contact" class="form-control" name="contact" type="text" value="<?php echo $contact; ?>">
    </div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Email Address:</label>
    <div class="col-sm-10">
      <input id="email" class="form-control" type="text" name="emailadd" value="<?php echo $emailadd; ?>">
    </div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Career Objective:</label>
    <div class="col-sm-10">
      <textarea name="objective" id="objective" class="form-control"><?php echo $objective; ?></textarea>
    </div>
	</div>
  
<!--  EDUC -->
  <legend>Educational Background</legend>
  <div class="form-group"> 
    <label class="control-label col-sm-2" for="email">Primary School/Graduate Year:</label>
    <div class="col-sm-6">
      <select name="pschool" class="form-control combobox" id="select-primary">
        <?php echo $primary; ?>
      </select>
    </div>
		<div class="col-sm-2">
      <select name="pstart" class="form-control" id="pyears-from">
				<?php for($x = 2015; $x>=1970; $x--) {
					if($x == $school[0]['start_year'])
						echo '<option value="' . $x . '" selected>' . $x . '</option>';
					else
						echo '<option value="' . $x . '">' . $x . '</option>';
				} ?>
      </select>
    </div>
    <div class="col-sm-2">
      <select name="pend" class="form-control" id="pyears-to">
        <?php for($x = 2015; $x>=1970; $x--) {
					if($x == $school[0]['end_year'])
						echo '<option value="' . $x . '" selected>' . $x . '</option>';
					else
						echo '<option value="' . $x . '">' . $x . '</option>';
				} ?>
      </select>
    </div>
  </div>
  <div class="form-group"> 
    <label class="control-label col-sm-2" for="email">Secondary School/Graduate Year:</label>
    <div class="col-sm-6">
      <select name="sschool" class="form-control combobox" id="select-secondary">
        <?php echo $secondary; ?>
      </select>
    </div>
		<div class="col-sm-2">
      <select name="sstart" class="form-control" id="syears-from">
        <?php for($x = 2015; $x>=1970; $x--) {
					if($x == $school[1]['start_year'])
						echo '<option value="' . $x . '" selected>' . $x . '</option>';
					else
						echo '<option value="' . $x . '">' . $x . '</option>';
				} ?>
      </select>
    </div>
    <div class="col-sm-2">
      <select name="send" class="form-control" id="syears-to">
        <?php for($x = 2015; $x>=1970; $x--) {
					if($x == $school[1]['end_year'])
						echo '<option value="' . $x . '" selected>' . $x . '</option>';
					else
						echo '<option value="' . $x . '">' . $x . '</option>';
				} ?>
      </select>
    </div>
  </div>
  
  
  
<!--  Affiliations-->
  <legend>Affiliations</legend>
  <div class="form-group">
              <!-- affiliations Table custom TOOLBAR  -->
              <div id="affil-add-toolbar">
                  <a href="#" class="btn btn-default" id="add-affil"> Add</a>
              </div>
    <?php if(count($affiliations) != 0) { ?> 
      <div class="col-sm-12 text-center">No affiliations yet.</div>
    <?php } else { ?>
      <table id="affil-table" data-toggle="table" data-toolbar="#affil-add-toolbar" data-url="<?php echo base_url('index.php/pages/getAffilJson'); ?>" data-pagination="true" data-page-list="[5, 10, 20]" data-search="true" data-show-refresh="true">
          <thead>
            <tr>
              <th data-field="organization" data-sortable="true" class="col-sm-12">ORGANIZATION</th>
              <th data-field="position" data-sortable="true" class="col-sm-2">POSITION</th>
              <th data-field="start_date" data-sortable="true" data-align="center" class="col-sm-3">START DATE</th>
              <th data-field="end_date" data-sortable="true" class="col-sm-3">END DATE</th>
            </tr>
          </thead>
        </table>
    <?php } ?>
  </div>
  
<!--  Involvements -->
  <legend>Involvements</legend>
  <div class="form-group">
    <?php if(count($affiliations) != 0) { ?> 
      <div class="col-sm-12 text-center">No involvements yet. Join a quest or add one!</div>
    <?php } else { ?>
      
      <!-- involvements Table custom TOOLBAR  -->
              <div id="involve-add-toolbar">
                  <a href="#" class="btn btn-default" id="add-involve"> Add</a>
              </div>
      <table id="involve-table" data-toggle="table" data-toolbar="#involve-add-toolbar" data-url="<?php echo base_url('index.php/pages/getInvolvementJson'); ?>" data-pagination="true" data-page-list="[5, 10, 20]" data-search="true" data-show-refresh="true">
          <thead>
            <tr>
              <th data-field="state" data-checkbox="true"></th>
              <th data-field="name" data-sortable="true" class="col-sm-4">NAME</th>
              <th data-field="venue" data-sortable="true" class="col-sm-4">VENUE</th>
              <th data-field="start_date" data-sortable="true" data-align="center" class="col-sm-2">START DATE</th>
              <th data-field="end_date" data-sortable="true" class="col-sm-2">END DATE</th>
            </tr>
          </thead>
        </table>
    <?php } ?>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-11 col-sm-2">
      <button href="#" type="submit" id="btn-form-create" class="btn btn-default">Create Resume</button>
    </div>
  </div>
</form>

<script>
//  This script is needed for dynamically generated elements to work
  $('#affil-table').bootstrapTable({});
  $('#involve-table').bootstrapTable({});
  $(document).ready(function(){
    $('.combobox').combobox();
  });
</script>

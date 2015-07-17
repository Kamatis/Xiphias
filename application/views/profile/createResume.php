<form class="form-horizontal" role="form">
  
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
  
<!--  EDUC -->
  <legend>Educational Background</legend>
  <div class="form-group"> 
    <label class="control-label col-sm-2" for="email">Primary School/Graduate Year:</label>
    <div class="col-sm-8">
      <select class="form-control combobox" id="select-primary">
        <?php echo $primary; ?>
      </select>
    </div>
    <div class="col-sm-2">
      <select class="form-control">
        <?php echo $years; ?>
      </select>
    </div>
  </div>
  <div class="form-group"> 
    <label class="control-label col-sm-2" for="email">Secondary School/Graduate Year:</label>
    <div class="col-sm-8">
      <select class="form-control combobox" id="select-secondary">
        <?php echo $secondary; ?>
      </select>
    </div>
    <div class="col-sm-2">
      <select class="form-control">
        <?php echo $years; ?>
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
      <table id="affil-table" data-toggle="table" data-toolbar="#affil-add-toolbar" data-url="<?php echo $affilJson; ?>" data-pagination="true" data-page-list="[5, 10, 20]" data-search="true" data-show-refresh="true">
          <thead>
            <tr>
              <th data-field="id" data-sortable="true" class="col-sm-12">ORGANIZATION</th>
              <th data-field="title" data-sortable="true" class="col-sm-2">POSITION</th>
              <th data-field="start" data-sortable="true" data-align="center" class="col-sm-3">START DATE</th>
              <th data-field="end" data-sortable="true" class="col-sm-3">END DATE</th>
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
      <table id="involve-table" data-toggle="table" data-toolbar="#involve-add-toolbar" data-url="<?php echo $involveJson; ?>" data-pagination="true" data-page-list="[5, 10, 20]" data-search="true" data-show-refresh="true">
          <thead>
            <tr>
              <th data-field="state" data-checkbox="true"></th>
              <th data-field="name" data-sortable="true" class="col-sm-4">Name</th>
              <th data-field="venue" data-sortable="true" class="col-sm-4">Venue</th>
              <th data-field="start" data-sortable="true" data-align="center" class="col-sm-2">START DATE</th>
              <th data-field="end" data-sortable="true" class="col-sm-2">END DATE</th>
            </tr>
          </thead>
        </table>
    <?php } ?>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-11 col-sm-2">
      <button type="submit" class="btn btn-default">Create Resume</button>
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
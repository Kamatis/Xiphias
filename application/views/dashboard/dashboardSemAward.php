<div id="dashboard-semaward" class="dashboard-page" style="display:none;">
  <a href="#">
    <strong>
      Semestral Award Dashboard
    </strong>
  </a>
  <hr>

  <div class="col-md-7">
    <form id="semaward-form" method="post" action="" class="form-horizontal">

			<div class="form-group">
				<label>Start Date: </label>
				<span id="startdate"><?php echo $startdate; ?></span>
			</div>
			<div class="form-group">
				<a href="#" id="btn-start-sem" class="btn btn-success" style="margin-top: 10px; <?php if($started) echo "display: none;"; ?>">Start Semester</a>
				<a href="#" id="btn-stop-sem" class="btn btn-danger" style="margin-top: 10px; <?php if(!$started) echo "display: none;"; ?>" >Stop Semester</a>
			</div>
    </form>
  </div>
</div>

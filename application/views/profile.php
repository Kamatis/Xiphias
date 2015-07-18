<!-- Main Layout of profile content -->
<div class="container">
  <?php if($isOwner) { ?>
  <div class="row" style="font-size: 20px;">
    <a href="javascript:void(0)" class="btn btn-default" id="btn-edit-profile" style="float: right"><i class="glyphicon glyphicon-cog"></i>Edit profile </a>
    <a href="javascript:void(0)" class="btn btn-default" id="btn-create-resume" style="float: right"><i class="glyphicon glyphicon-file"></i> Create Resume</a>
  </div>
  <?php } ?>
  <div class="col-sm-3">
    <?php echo $profileInfo ?>
  </div>

  <div class="col-sm-9">
    <?php echo $profileDescription ?>
    <?php echo $profileBadges ?>
    <?php echo $profileTimeline ?>
  </div>
</div>
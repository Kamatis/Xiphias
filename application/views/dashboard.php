<div class="wrapper">
  <div class="container-fluid">
    <div class="row">
      <?php if($isVerified) { ?>
      <div class="col-sm-3" style="position: fixed">
        <?php echo $dashboardMenu ?>
      </div>
      
      <div class="col-sm-9 col-sm-offset-3">
        <?php
          echo $dashboardBadge;
          echo $dashboardQuest;
          echo $dashboardParty;
          echo $dashboardOffice;
          if($isAdmin){
            echo $dashboardSerial;
            echo $dashboardNotification;
          }
        }
        else {
          echo $error;
        } ?>
      </div>
    </div>
  </div>
</div>

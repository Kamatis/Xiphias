<div class="wrapper" style="margin-left: 50px; margin-right: 50px;">
  <div class="col-sm-6">
    <h4><span class="glyphicon glyphicon-info-sign"></span> <strong>Info</strong></h4>
    
    <div class="row">
      <div class="col-sm-11">
        <form method="post" action="<?php echo base_url('index.php/pages/changePassword'); ?>">
        <h5><strong>Change Password</strong></h5>
        <input type="password" name="old-pass" class="form-control" placeholder="Old Password" style="margin-bottom:5px;">
        <input type="password" name="new-pass" class="form-control" placeholder="New Password" style="margin-bottom:5px;">
        <input type="password" name="re-new-pass" class="form-control" placeholder="Confirm New Password" style="margin-bottom:5px;">
        <button type="submit" class="btn btn-success btn-sm" style="margin-top: 5px;">Change Password</button>
        </form>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-6">
        <h5><strong>Integrations</strong></h5>
        <a id="fb-link" href="#" class="btn btn-default form-control" style="text-align: left; background-color: #3a5795; border: 1px solid #133783; color: white;"><span style="border-right: 1px solid #133783; padding: 8px 10px 8px 0px;"><i class="fa fa-facebook" style="font-size: 13pt;"></i></span> Connect to Facebook </a>
        
      </div>
    </div>
  </div>
  
  <div class="col-sm-6">
    <h4><span class="glyphicon glyphicon-sunglasses"></span> <strong>Privacy</strong></h4>
    
    <div class="row">
      <h5 class="col-sm-6">
        <div>
          <label style="font-weight: normal; font-size: 14px;"><input type="checkbox" value="" checked> Show earned badges</label>
        </div>
        <div>
          <label style="font-weight: normal; font-size: 14px;"><input type="checkbox" value="" checked> Show timeline</label>
        </div>
        <div>
          <label style="font-weight: normal; font-size: 14px;"><input type="checkbox" value="" checked> Show educational background</label>
        </div>
        <div>
          <label style="font-weight: normal; font-size: 14px;"><input type="checkbox" value="" checked> Publish earned badges in Facebook</label>
        </div>
        <a href="#" class="btn btn-success btn-sm" style="margin-top: 5px;">Save</a>
      </h5>
    </div>
  </div>
  
</div>
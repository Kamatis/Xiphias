<div id="dashboard-noti" class="dashboard-page">
  <div class="table-container">
    <table id="noti-table" data-toggle="table" data-show-header="false" data-url="url">
      <thead>
        <tr>
          <th data-field="request" class="col-md-10">Request</th>
          <th data-field="date" class="col-md-2">Date</th>
        </tr>
      </thead>
      <tbody>
				<!--
					'from'        = username kung kiisay hali ang notification
					'from_url'    = profile link ni from
					'office_id'   = no need to explain.. haha
					'office_name' = again, no need
					'role'        = bla bla
					'noti_type'   = type kang notification.. 1 = confirm or decline option
					'noti_date'   = 
			  -->
		  <?php for($x = 0; $x < count($notif); $x++) { ?>
				<tr data-notiId="<?php echo $notif[$x]['noti_id']; ?>">

					<!-- If confirmation -->
					<?php if($notif[$x]['noti_type'] == 1) { ?>
						<td>
							<a href="<?php echo $notif[$x]['from_url']; ?>"><?php echo $notif[$x]['from'];?></a>
							<?php
							echo ' asked you to be the ';
							echo ' <i>';
							echo $notif[$x]['role'];
							echo ' </i>';
							echo ' of ';
							echo $notif[$x]['office_name'];
							?>
							<div class="row-fluid">
								<div class="form-group">
									<a href="#" class="btn btn-success btn-xs" data-notiId="<?php echo $notif[$x]['noti_id']; ?>">Approve</a>
									<a href="#" class="btn btn-danger btn-xs" data-notiId="<?php echo $notif[$x]['noti_id']; ?>">Decline</a>
								</div>
							</div>
						</td>
						<td><?php echo $notif[$x]['noti_date'] ?></td>
					<?php } ?> <!-- endif confirmation -->

				</tr>
		  <?php } ?>
      </tbody>
    </table>
  </div>
</div>

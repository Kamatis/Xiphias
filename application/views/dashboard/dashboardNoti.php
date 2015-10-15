<div id="dashboard-noti" class="dashboard-page">
  <div class="table-container">
    <table id="noti-table" data-toggle="table" data-show-header="false">
      <thead>
        <tr>
          <th data-field="id" data-visible="false" class="col-md-1">ID</th>
          <th data-field="request" class="col-md-9">Request</th>
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
				<tr>

					<!-- If confirmation -->
					<?php if($notif[$x]['noti_type'] == 1) { ?>
                        <td><?php echo $notif[$x]['office_id']; echo $notif[$x]['to']; ?></td>
						<td>
							<a href="<?php echo $notif[$x]['from_url']; ?>"><?php echo $notif[$x]['from'];?></a>
							<?php
							echo ' asked you to be the ';
							echo ' <i>';
							echo $notif[$x]['role'];
							echo ' </i>';
							echo ' of ';
							echo $notif[$x]['office_name'];
							echo '.';
							?>
							<div class="row-fluid">
								<div class="form-group">
									<a href="#" class="btn btn-success btn-xs btn-noti-approve"
										 data-notiId="<?php
																		echo $notif[$x]['office_id'];
																		echo '_';
																		echo $notif[$x]['to'];
																		echo '_';
																		echo $notif[$x]['from']; ?>"
										 data-ofcName="<?php
																		echo $notif[$x]['office_name'];
																		?>">Approve</a>
									<a href="#" class="btn btn-danger btn-xs btn-noti-decline"
										 data-notiId="<?php
																		echo $notif[$x]['office_id'];
																		echo '_';
																		echo $notif[$x]['to'];
																		echo '_';
																		echo $notif[$x]['from']; ?>"
										 data-ofcName="<?php
																		echo $notif[$x]['office_name'];
																		?>">Decline</a>
								</div>
							</div>
						</td>
					<?php } ?> <!-- endif confirmation -->

					<!-- If approve -->
					<?php if($notif[$x]['noti_type'] == 2) { ?>
						<td>
							<a href="<?php echo $notif[$x]['from_url']; ?>"><?php echo $notif[$x]['from'];?></a>
							<?php
							echo ' agreed to be ';
							echo ' <i>';
							echo $notif[$x]['role'];
							echo ' </i>';
							echo ' of ';
							echo $notif[$x]['office_name'];
							echo '.';
							?>
							<div class="row-fluid">
								<div class="form-group">
									<a href="#" class="btn btn-success btn-xs btn-noti-ok"
											 data-notiId="<?php
																			echo $notif[$x]['office_id'];
																			echo '_';
																			echo $notif[$x]['to'];
																			echo '_';
																			echo $notif[$x]['from']; ?>">OK</a>
								</div>
							</div>
						</td>

					<?php } ?> <!-- endif approve -->

					<!-- If decline -->
					<?php if($notif[$x]['noti_type'] == 3) { ?>
						<td>
							<a href="<?php echo $notif[$x]['from_url']; ?>"><?php echo $notif[$x]['from'];?></a>
							<?php
							echo ' declined to be ';
							echo ' <i>';
							echo $notif[$x]['role'];
							echo ' </i>';
							echo ' of ';
							echo $notif[$x]['office_name'];
							echo '.';
							?>
							<div class="row-fluid">
								<div class="form-group">
									<a href="#" class="btn btn-success btn-xs btn-noti-ok"
											 data-notiId="<?php
																			echo $notif[$x]['office_id'];
																			echo '_';
																			echo $notif[$x]['to'];
																			echo '_';
																			echo $notif[$x]['from']; ?>">OK</a>
								</div>
							</div>
						</td>

					<?php } ?> <!-- endif decline -->

					<td><?php echo $notif[$x]['noti_date']; ?></td>
				</tr>
		  <?php } ?>
      </tbody>
    </table>
  </div>
</div>

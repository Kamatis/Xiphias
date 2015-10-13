<div id="dashboard-noti" class="dashboard-page">
  <div class="table-container">
    <table id="noti-table" data-toggle="table" data-show-header="false">
      <thead>
        <tr>
          <th data-field="request" class="col-md-12">Request</th>
          <th data-field="date" class="col-md-3">Date</th>
        </tr>
      </thead>
      <tbody>
		  <?php for($x = 0; $x < count($notif); $x++) { ?>
        <tr>
          <td>
			  <a href="<?php echo $notif[$x]['from_url']; ?>"> <?php echo $notif[$x]['from'];?></a>
			  <?php
				echo ' asked you to be the ';
				echo $notif[$x]['role'];
				echo ' of ';
				echo $notif[$x]['office_name'];
			  ?>
		  </td>
          <td> <?php echo $notif[$x]['noti_date'] ?> </td>
        </tr>
		  <?php } ?>
      </tbody>
    </table>
  </div>
</div>

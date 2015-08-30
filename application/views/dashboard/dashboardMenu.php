<a href="#">
	<strong>
		<i class="glyphicon glyphicon-wrench">
		</i>
		Tools
	</strong>
</a>
<hr>
<ul class="nav nav-stacked">
	<li class="btn-dashboard-menu" data-idlink="#dashboard-badge">
		<a href="#badge" class="dashboard-menuitem dashboard-active">
			Badge
			<span class="pull-right"><button class="dashboard-button" data-form="#badge-form"><i class="glyphicon glyphicon-plus"></i></button></span>
		</a>
	</li>
	<li  class="btn-dashboard-menu" data-idlink="#dashboard-quest">
		<a href="#quest" class="dashboard-menuitem">
			Quest
			<span class="pull-right"><button class="dashboard-button" data-form="#form-quest"><i class="glyphicon glyphicon-plus"></i></button></span>
		</a>
	</li>
	<li class="btn-dashboard-menu" data-idlink="#dashboard-party">
		<a href="#party" class="dashboard-menuitem">
			Party
			<span class="pull-right"><button class="dashboard-button" data-form="#party-form"><i class="glyphicon glyphicon-plus"></i></button></span>
		</a>
	</li>
	<li class="btn-dashboard-menu" data-idlink="#dashboard-office">
		<a href="#office" class="dashboard-menuitem">
			Office
			<span class="pull-right"><button class="dashboard-button" data-form="#office-form"><i class="glyphicon glyphicon-plus"></i></button></span>
		</a>
	</li>
	<?php if($isAdmin) { ?>
	<li class="btn-dashboard-menu" data-idlink="#dashboard-serial">
		<a href="#serial" class="dashboard-menuitem">
			Serial
		</a>
	</li>
	<?php } ?>
	<li class="btn-dashboard-menu" data-idlink="#dashboard-noti">
		<a href="#noti" class="dashboard-menuitem">
			Notifications
			<span class="pull-right label label-danger" id="dbmenu-noti-label"><?php echo $noti; ?></span>
		</a>
	</li>
</ul>

<script>
	$(function() {
		$('.dashboard-page').hide();
		$('.dashboard-menuitem').removeClass('dashboard-active');
		//get URL and the page
		var url = window.location.href;
		var page = url.substring(url.lastIndexOf('#') + 1);
		if(page.length > 10) page = "badge";
		$('a[href=#' + page + ']').addClass('dashboard-active');
		var pagepanel = $('.dashboard-active').parent().data('idlink');
		$(pagepanel).show();
	});
</script>

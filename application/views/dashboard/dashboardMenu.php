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
            <a href="#">Badge <i class="glyphicon glyphicon-plus pull-right"></i></a>
          </li>
          <li  class="btn-dashboard-menu" data-idlink="#dashboard-quest">
            <a href="#">Quest <i class="glyphicon glyphicon-plus pull-right"></i></a>
          </li>
          <li class="btn-dashboard-menu" data-idlink="#dashboard-party">
            <a href="#">Party <i class="glyphicon glyphicon-plus pull-right"></i></a>
          </li>
          <li class="btn-dashboard-menu" data-idlink="#dashboard-office">
            <a href="#">Office <i class="glyphicon glyphicon-plus pull-right "></i></a>
          </li>
          <?php if($isAdmin) { ?>
          <li class="btn-dashboard-menu" data-idlink="#dashboard-serial">
            <a href="#">Serial <i class="glyphicon glyphicon-plus pull-right badge-add" ></i></a>
          </li>
          <li class="btn-dashboard-menu" data-idlink="#dashboard-notifs">
            <a href="#">Notifications <span class="badge">4</span> <i class="glyphicon glyphicon-plus pull-right"></i></a>
          </li>
          <?php } ?>
          
        </ul>
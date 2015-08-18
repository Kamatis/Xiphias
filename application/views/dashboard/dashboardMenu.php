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
            <a href="#" class="dashboard-menuitem">
              Badge
              <span class="pull-right"><button class="dashboard-button"><i class="glyphicon glyphicon-plus"></i></button></span>
            </a>
          </li>
          <li  class="btn-dashboard-menu" data-idlink="#dashboard-quest">
            <a href="#" class="dashboard-menuitem">
              Quest
              <span class="pull-right"><button class="dashboard-button"><i class="glyphicon glyphicon-plus"></i></button></span>
            </a>
          </li>
          <li class="btn-dashboard-menu" data-idlink="#dashboard-party">
            <a href="#" class="dashboard-menuitem">
              Party
              <span class="pull-right"><button class="dashboard-button"><i class="glyphicon glyphicon-plus"></i></button></span>
            </a>
          </li>
          <li class="btn-dashboard-menu" data-idlink="#dashboard-office">
            <a href="#" class="dashboard-menuitem">
              Office
              <span class="pull-right"><button class="dashboard-button"><i class="glyphicon glyphicon-plus"></i></button></span>
            </a>
          </li>
          <?php if($isAdmin) { ?>
          <li class="btn-dashboard-menu" data-idlink="#dashboard-serial">
            <a href="#" class="dashboard-menuitem">
              Serial
              <span class="pull-right"><button class="dashboard-button"><i class="glyphicon glyphicon-plus"></i></button></span>
            </a>
          </li>
          <li class="btn-dashboard-menu" data-idlink="#dashboard-noti">
            <a href="#" class="dashboard-menuitem">
              Notifications
              <span class="pull-right"><button class="dashboard-button"><i class="glyphicon glyphicon-plus"></i></button></span>
            </a>
          </li>
          <?php } ?>
          
        </ul>

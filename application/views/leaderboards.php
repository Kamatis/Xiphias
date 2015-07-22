<div class="wrapper" >
  <a name="top-three"></a>
  <section style="height: 75vh;">
    <div class="stair-container" style="overflow-x: auto;">
      <div class="staircase">
        <?php echo $steps; ?>

      </div>
    </div>
    
    </section>
  
  
  <section style="height: 75vh;">
    <div id="leaderboard-controls" style="margin-top: 10px; margin-left: 100px; margin-right: 100px;">
      <div class="col-sm-6">
<!--        <a name="showall" href="#showall">Show all</a>-->
        <input type="text" class="form-control">
      </div>
      <div class="col-sm-3 col-sm-offset-3">
        <select id="sel-quest-type" class="form-control">
          <option value="1">Academic</option>
          <option value="2">Co-Curricular</option>
          <option value="3">Extra Curricular</option>
        </select>
      </div>
    </div>
    <!-- https://api.github.com/users/Ocramius/repos -->
    <!-- https://api.github.com/users/mralexgray/repos -->
    <div class="col-sm-12" style="margin-top: 35px;">
      <div class="" style="margin-left: 100px; margin-right: 100px;">
        <table id="rank-table" data-toggle="table" data-url="<?php echo base_url('index.php/pages/getRankings/Academic'); ?>" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, 500]" data-search="true" data-show-refresh="true">
          <thead>
            <tr>
              <th data-field="id" data-sortable="true" class="col-lg-1 col-sm-1">#</th>
              <th data-field="name" data-sortable="true" data-formatter="namelink" class="col-lg-7 col-sm-7">USERNAME</th>
              <th data-field="level" data-sortable="true" data-align="center" class="col-lg-1 col-sm-1">LEVEL</th>
              <th data-field="house" data-sortable="true" data-align="center" class="col-lg-2 col-sm-2">HOUSE</th>
              <th data-field="points" data-sortable="true" class="col-lg-1 col-sm-1">POINTS</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>
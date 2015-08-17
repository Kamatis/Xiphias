<div class="wrapper" >
  <a name="top-three"></a>
    <div class="stair-container" style="overflow-x: auto;">
      <div class="staircase">
        <?php echo $steps; ?>
      </div>
    </div>
    
    <div id="leaderboard-controls">
        <select id="sel-quest-type" class="form-control">
          <option value="Academic">Academic</option>
          <option value="Co-Curricular">Co-Curricular</option>
          <option value="Extra Curricular">Extra Curricular</option>
        </select>
    </div>

    <div class="col-sm-12" style="margin-top: 35px;">
      <div class="table-container">
        <table id="rank-table" data-toggle="table" data-toolbar="#leaderboard-controls" data-url="<?php echo base_url('index.php/pages/getRankings/Academic'); ?>" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, 500]" data-search="true" data-show-refresh="true">
          <thead>
            <tr>
              <th data-field="id" data-sortable="true" class="col-lg-1 col-sm-1">#</th>
              <th data-field="name" data-sortable="true" data-formatter="namelink" class="col-lg-7 col-sm-7">USERNAME</th>
              <th data-field="level" data-sortable="true" data-align="center" class="col-lg-1 col-sm-1">LEVEL</th>
              <th data-field="house" data-sortable="true" data-align="center" class="col-lg-2 col-sm-2">HOUSE</th>
              <th data-field="points" data-sortable="true" data-align="center" class="col-lg-1 col-sm-1">EXPERIENCE</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>

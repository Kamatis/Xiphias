<div class="wrapper" >
  <a name="top-three"></a>
  <section style="height: 75vh;">
    <div class="stair-container" style="overflow-x: auto;">
      <div class="staircase">
        <!-- <?php echo $steps; ?> -->
        <div class="stair-step house-3">
          <div class="header-name house-3">Kamatis</div>
          <div class="header-lvl-house house-3">
            <p>Lvl 16</p>
            <img src="" style="width: 50px; height: 50px;">
          </div>
          <div class="body-badge-award">
            <img src="" class="place-second">
          </div>
          <div class="footer-place house-3">
            2nd
          </div>
        </div>

        <div class="stair-step house-2">
          <div class="header-name house-2">Kamatis</div>
          <div class="header-lvl-house house-2">
            <p>Lvl 16</p>
            <img src="" style="width: 50px; height: 50px;">
          </div>
          <div class="body-badge-award">
            <img src="" class="place-first">
          </div>
          <div class="footer-place house-2">
            1st
          </div>
        </div>

        <div class="stair-step house-4">
          <div class="header-name house-4">Kamatis</div>
          <div class="header-lvl-house house-4">
            <p>Lvl 16</p>
            <img src="" style="width: 50px; height: 50px;">
          </div>
          <div class="body-badge-award">
            <img src="" class="place-third">
          </div>
          <div class="footer-place house-4">
            3rd
          </div>
        </div>

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
        <table id="rank-table" data-toggle="table" data-url="https://api.github.com/users/Ocramius/repos" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, 500]" data-search="true" data-show-refresh="true">
          <thead>
            <tr>
              <th data-field="id" data-sortable="true" class="col-sm-1">#</th>
              <th data-field="name" data-sortable="true" class="col-sm-12">USERNAME</th>
              <th data-field="price" data-sortable="true" data-align="center" class="col-sm-1">HOUSE</th>
              <th data-field="points" data-sortable="true" class="col-sm-1">POINTS</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>
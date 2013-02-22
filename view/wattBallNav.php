<div class='row-fluid'>
    <div class="span3 contentbox">
        <ul class="nav nav-list">
           <li <?php if($pageName == 'wattBall'){ echo "class='active'";}  ?>>
                <a href="?page=wattBall">Results for Tournament</a>
          </li>
          <li <?php if($pageName == 'wattBallScheduling'){ echo "class='active'";}  ?>>
            <a href="?page=wattBallScheduling">Schedule for Tournament</a>
          </li>
          <li <?php if($pageName == 'wattBallRegistration'){ echo "class='active'";}  ?>>
                  <a href="?page=wattBallRegistration">Register for Tournament</a>
          </li>
          <li <?php if($pageName == 'teams'){ echo "class='active'";}  ?>>
                  <a href="?page=teams">Teams</a>
          </li>
          <li <?php if($pageName == 'ranking'){ echo "class='active'";}  ?>>
                  <a href="?page=ranking">Ranking</a>
          </li>
        </ul>
    </div>

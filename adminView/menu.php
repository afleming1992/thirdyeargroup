<div class='row-fluid'>
    <div class='span3 contentbox'>
	
        <div class="accordion" id="accordion2">
                  <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                Scheduling
                          </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                          <div class="accordion-inner">
                                <a href="index.php?adminPage=wattBallScheduling">Initiate WattBall Scheduling</a>
                                <p>Initiate Hurdles Scheduling</p>
                                <p>Edit WattBall Schedule</p>
                                <p>Edit Hurdle Schedule</p>
                                <a href='index.php?adminPage=umpireManagement'>Umpire Management</a>
                                <p>Update Performance Time</p>
                          </div>
                        </div>
                  </div>
                  <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                Registration
                          </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                          <div class="accordion-inner">
                                <p>View Wattball</p>
                                <p>View Male Hurdles</p>
                                <p>View Female Hurdles</p>
                          </div>
                        </div>
                  </div>
                   <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                                Ticketing
                          </a>
                        </div>
                        <div id="collapseThree" class="accordion-body collapse">
                          <div class="accordion-inner">
                                <p>Ticket Status</p>
                                <p>Process Ticket Purchase</p>
                                <p>Postal Ticket Sales List</p>
                                <p>On Day Ticket Sales List</p>
                          </div>
                        </div>
                  </div>
        <?php
                if($staff->getManager() == 1)
                {
        ?>
                  <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                                Management
                          </a>
                        </div>
                        <div id="collapseFour" class="accordion-body collapse">
                          <div class="accordion-inner">
                                        <a href='index.php?adminPage=tournamentManagement'>Tournaments Managment</a>
                                        <p>Staff Manager</p>
                          </div>
                        </div>
                  </div>
        <?php
                }
        ?>
                </div>
        
    </div>

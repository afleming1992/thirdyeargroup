<script type='text/javascript' src='javascript/home.js' ></script>
<div id='home' class='row-fluid'>
	<div class="span12">
		<div id='latestResult' class='span4 contentbox'>
			<h4>Latest results</h4>
				
                                    <div class="alert alert-info">
                                        <div style='font-weight:bold;text-align:center;text-decoration:underline'><a href="?page=wattBall">Wattball</a></div>
                                            <?php 
                                            if($data != FALSE)
                                            {
                                                echo "<a href='?result=".$matchResult->getResultID()."'>";
                                                echo "<div style='font-weight:bold;text-align:center;'>".$matchResult->getTeam1()->getTeamName()." VS ".$matchResult->getTeam2()->getTeamName()."</div>";
                                                echo "<p style='text-align:center'>".$matchResult->getTeam1Score()." - ".$matchResult->getTeam2Score()."</p>";
                                                echo "</a>";
                                            }
                                            else
                                                echo "No results !";

                                            ?>
                                    </div>
				
		</div>
		
		<div id='content' class='span8'>
			<div id='carousel' class='span12 contentbox'>
				<div id="myCarousel" class="carousel slide">
				  <!-- Carousel items -->
				  <div class="carousel-inner">
					<div class="active item">
						<img src="images/caroseul/centre.jpg" />
						<div class='carousel-caption'><h4>Welcome to Riccarton Sports Centre</h4><p>We host many tournaments from WattBall to Hurdling</p></div>
					</div>
					<div class="item"><a href='index.php?page=wattBall'><img src="images/caroseul/wattball.jpg" /><div class='carousel-caption'><h4>Wattball</h4><p>Find out more about our Wattball Tournament by Clicking Here</p></div></a></div>
					<div class="item"><a href='index.php?page=tickets'><img src="images/caroseul/tickets.jpg" /><div class='carousel-caption'><h4>Tickets</h4><p>You can buy tickets for our Tournaments by clicking here</p></div></a></div>
				  </div>
				  <!-- Carousel nav -->
				  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>
			</div>
		</div>
	</div>
	<div class='row-fluid'>
		<div class='contentbox home-info span12'>
			<div class='row-fluid'>
				<div class='span6 pull-left well'>
					  <p style='font-size:small'>Based on the outskirts of Edinburgh close to Currie</p>
					  <p>
						We are a Sports Centre which hosts an Annual Tournament comprising of both Wattball and Hurdles. We are a National Wattball Association Recognised Centre.
					  </p>
				</div>
				<div class='span6 well pull-right'>
					<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Heriot+Watt+University+Edinburgh+Campus,+Edinburgh,+UK+Sports+Centre&amp;aq=&amp;sll=55.909699,-3.317571&amp;sspn=0.006434,0.01929&amp;t=h&amp;ie=UTF8&amp;hq=Heriot+Watt+University+Edinburgh+Campus,+Edinburgh,+UK+Sports+Centre&amp;hnear=&amp;ll=55.908761,-3.316497&amp;spn=0.006434,0.01929&amp;z=14&amp;iwloc=A&amp;cid=1277698930982743566&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Heriot+Watt+University+Edinburgh+Campus,+Edinburgh,+UK+Sports+Centre&amp;aq=&amp;sll=55.909699,-3.317571&amp;sspn=0.006434,0.01929&amp;t=h&amp;ie=UTF8&amp;hq=Heriot+Watt+University+Edinburgh+Campus,+Edinburgh,+UK+Sports+Centre&amp;hnear=&amp;ll=55.908761,-3.316497&amp;spn=0.006434,0.01929&amp;z=14&amp;iwloc=A&amp;cid=1277698930982743566" style="color:#0000FF;text-align:left">View Larger Map</a></small>
				</div>
			</div>
		</div>
	</div>
</div>

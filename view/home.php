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
				<h1>Testing</h1>
		</div>
	</div>
</div>

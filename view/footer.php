</body>
<div id='footer' class="row-fluid">
	<div class='span12'>
		<div class='span3'></div>
		<div class='span6' style='text-align: center'>
			<p>Technological Development&copy 2012 | 
			<a href='/project/'>Home</a> | 
			<?php 
			if(isset($_SESSION['login']) && $_SESSION['login'] == true)
			{
			?> 
			<a href='signout.html'>Sign out</a>
			<?php 
			}
			else
			{
			?>
			<a href='#login' data-toggle='modal'>Staff Login</a>
			<?php 
			}
			?>
			</p>
		</div>
		<div class='span3'></div>
	</div>
</div>
</html>

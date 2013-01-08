<?php
	if(isset($_GET['signout']) && $_GET['signout'] == 1)
	{
		?>
		<div class="alert alert-success" style='text-align:center'>
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <b>You are now signed out!</b>
		</div>
		<?php
	}
	
	if(isset($_SESSION['login-popup']) && $_SESSION['login-popup'] == true)
	{
		?>
		<div class="alert alert-success" style='text-align:center'>
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <b>Welcome back <?php echo $_SESSION['username'] ?>!</b> You are now signed in.
		</div>
		<?php
		
		$_SESSION['login-popup'] = false;
	}
?>
<div id='banner' class='page-header'>
	<h1><img src='images/banner.png' /></h1>	
</div>
<body class='container'>
	<div class='wrapper'>
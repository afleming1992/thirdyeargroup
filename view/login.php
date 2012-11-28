<div id='login'class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
	    <h3 id="myModalLabel">Staff Login</h3>
  	</div>
  	<form action="index.php" method="post">
	  	<div class="modal-body">		
				<label for="username">Username: </label>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" name="username" autocomplete="on" placeholder="Username">
				</div>	
						
				<label for="password">Password: </label>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-lock"></i></span>
					<input type="password" name="password" autocomplete="off" placeholder="Password"></br>
				</div>
		</div>
		<div class="modal-footer">
			<a href='#' class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
			<input type="submit" class="btn btn-primary" name="submitButtonLogin" value="Sign in">		  	 		  
	  </div>
  </form>
</div>
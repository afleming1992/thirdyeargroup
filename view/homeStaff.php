<?php
//Function which display the login form if user try to go to the staff page without sign in
function addLogin()
{
    require_once 'view/login.php';
    ?>
    <div class="alert alert-block" style="text-align: center">
      <h4>Warning!</h4>
      You must be logged in to view this page ! </br></br>
      <a role='button' class='btn btn-warning' href='#login' data-toggle='modal'>Staff Login</a>
    </div>
    <?php
    require_once 'view/footer.php';
}

if(!isset($_SESSION['login']))
{
    addLogin();
    die();
}
else if(isset($_SESSION['login']) && $_SESSION['login']==FALSE)
{
    addLogin();
    die();
}
?>

<div class='row-fluid'>
	<div class='span3 contentbox'>
<?php
require_once 'view/menu-staff.php';
?>
	</div>
		<div class='span9 contentbox'>
			<div class='hero-unit'>
				<h1>Welcome!</h1>
				<p>Please select the function you wish to access by using the panel on the right</p>
			</div>
		</div>
	</div>

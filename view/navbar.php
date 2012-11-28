<nav class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <ul class="nav">
        <li> <a href="index.php">Home</a> </li>
        <li> <a href="about-us.html">About us</a> </li>
        <li> <a href="wattball.html">WattBall</a> </li>
        <li> <a href="men-hurdles.html">Men's Hurdles</a> </li>
        <li> <a href="female-hurdles.html">Female's Hurdles</a> </li>
        <?php 
        if(isset($_SESSION['login']) && $_SESSION['login'] == true)
        	echo "<li> <a href='staff.html'>Staff</a> </li>";
        ?>
      </ul>
    </div>
  </div>
</nav>
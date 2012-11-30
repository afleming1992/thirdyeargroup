<nav class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <ul class="nav">
        <li> <a href="index.php">Home</a> </li>
        <li> <a href="index.php?page=aboutUs">About us</a> </li>
        <li> <a href="index.php?page=wattBall">WattBall</a> </li>
        <li> <a href="index.php?page=menHurdles">Men's Hurdles</a> </li>
        <li> <a href="index.php?page=femaleHurdles">Female's Hurdles</a> </li>
        <?php 
        if(isset($_SESSION['login']) && $_SESSION['login'] == true)
        	echo "<li> <a href='index.php?page=homeStaff'>Staff</a> </li>";
        ?>
      </ul>
    </div>
  </div>
</nav>
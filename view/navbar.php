<nav class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <ul class="nav">
            <li <?php if(strcmp($_SESSION['section'],"home") == 0){echo "class='active'";} ?>><a href="index.php">Home</a></li>
            <li <?php if(strcmp($_SESSION['section'],"wattball") == 0){ echo "class='active'";} ?>> <a href="index.php?page=wattBall">WattBall</a> </li>
            <li <?php if(strcmp($_SESSION['section'],"menhurdles") == 0){ echo "class='active'";} ?>> <a href="index.php?page=menHurdlesRegistration">Men's Hurdles</a> </li>
            <li <?php if(strcmp($_SESSION['section'],"femalehurdles") == 0){ echo "class='active'";} ?>> <a href="index.php?page=femaleHurdlesRegistration">Female's Hurdles</a> </li>
            <li <?php if(strcmp($_SESSION['section'],"tickets") == 0){echo "class='active'";} ?>> <a href='index.php?page=tickets'>Tickets for Tournament</a></li>
            <?php
                    if(isset($_SESSION['login']) && $_SESSION['login'] == true)
                    {
            ?>
                        <li <?php if(strcmp($_SESSION['section'],"admin") == 0){echo "class='active'";} ?>> <a href='index.php?adminPage=home'>Staff</a></li>
            <?php
                    }
            ?>
      </ul>
    </div>
  </div>
</nav>



<!DOCTYPE html>
<html lang="nl">

<?php session_start(); ?>

<nav>
  <div class="submenu1">
    <ul>
      <li><a href="index.php?default">Home</a> </li>
      <li><a href="Over_ons_&_Privacy_verklaaring.php">Over ons & Privacy verklaaring</a> </li>
      <li><a href="Inloggen.php">Inloggen</a> </li>
      <li><a href="Registreren.php">Registreren</a> </li>
      <li><a href="Blog.php?zoek=default">Blog</a> </li>
    </ul>
    <ul class="submenu2">
      <li>
<?php  if(isset($_SESSION['loggedin'])){
  ?>
   <a href="Inloggen.php"> U bent ingelogd</a> 
  <?php }else { ?>
    <a href="Inloggen.php"> U bent nog niet inlogd</a> <?php } ?>
      </li>
      <li class="zoekknop">
      <form action="Opzoeken99.php" method="GET">
          <input type="search" name="zoeken" placeholder="Zoeken op titel..." />
          <input type="submit" value="Search" />
      </form>
    </li>
    </ul>
  </div>
</nav>
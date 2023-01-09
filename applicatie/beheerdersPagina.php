<!DOCTYPE html>
<html lang="nl">

<?php require_once 'header.php';
require_once 'navbar.php';
?>
<h8>BeheerdersPagina</h8>

<?

function zoekGebruiker($gebruiker)
{
  $sql = "SELECT * FROM MOVIE WHERE title LIKE ?"; 
  $verbinding = maakVerbinding();
  $query = $verbinding->prepare($sql);
  $query->execute([$gebruiker]);


while ($film = $query->fetch()) {
    echo $film['title'];
    echo "<br>";
    echo $film['description'];
    echo "<br>";
} }
?>




</body>

<?php require_once 'footer.php'; ?>

</html>
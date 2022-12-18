<!DOCTYPE html>
<html lang="nl">

<?php require_once 'header.php';
require_once 'navbar.php';
$zoek="default";
$zoek = "%{$_GET['zoek']}%";
$blogContent= "";
?> <br> <h8>Hier komen de door de beheerder geposte blogs</h8> <?php
require_once 'db_connectie.php';



  $sql = "SELECT * FROM adminBlog"; 
  $verbinding = maakVerbinding();
  $query = $verbinding->prepare($sql);
  $query->execute();


$blogTitels = array();
$blogContent = array();
while ($rij = $query->fetch()) {
    array_push($blogTitels, $rij[0]);
    array_push($blogContent, $rij[1]);
} 

$blogArray = array(
$blogTitels,
  $blogContent
);

?> <div class="BlogsPrint"> <?php
foreach($blogArray as $blog ){

  echo("<h10>$blog[0]</h10><br>");
  echo("<p>$blog[1]<br>");

}


$sql = "SELECT title, blogContent FROM adminBlog WHERE title LIKE :title OR blogContent LIKE :blogContent";
$db = maakVerbinding();
$query = $db->prepare($sql);

$query->execute(array('title' => $zoek, 'blogContent' => $zoek));
$blogTitelss=array();
$blogInhouds = array();
while($rij = $query->fetch()){
    array_push($blogTitelss, $rij[0]);
    array_push($blogInhouds, $rij[1]);
    ?> <br> <h8>Zoekresultaten</h8> <?php

    $blogsArrays = array(
      $blogTitelss,
      $bloginhouds
      );

    foreach($blogArrays as $blog ){

      echo("<h10>$blog[0]</h10><br>");
      echo("<p>$blog[1]<br>");
    
    }
  }

?>


  <form action="blog.php" method="GET">
  <input type="search" name="zoek" placeholder="Zoeken op blog..." /> 
  <input type="submit" value="Search" />
</form>


</body>

<?php require_once 'footer.php'; ?>

</html>
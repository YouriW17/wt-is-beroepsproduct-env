<!DOCTYPE html>
<html lang="nl">

<?php require_once 'header.php';
require_once 'navbar.php';
$zoek="default";
$zoek = "%{$_GET['zoek']}%";
$blogContent= "";
?> <br> <h8>Hier komen de door de beheerder geposte blogs</h8> <?php
require_once 'db_connectie.php';


$sql = "SELECT COUNT(*) FROM adminBlog";
$verbinding = maakVerbinding();
$query = $verbinding->prepare($sql);
$query->execute();
$AantalBlogs = $query->fetchColumn();

if($AantalBlogs > 0){

  
  $sql = "SELECT title, blogContent
  FROM adminBlog"; 
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

$i = 0;
?> <div class="BlogsPrint"> <?php
foreach($blogArray as $blog ){
 if($i == 1){
 echo("<p>$blog[0]</p><br>");
}
if($i == 0){
  echo("<h10>$blog[0]</h10><br>");
$i++;
if($i == 2){
  $i = 0;
}
}
}


$sql = "SELECT title, blogContent FROM adminBlog WHERE title LIKE :title OR blogContent LIKE :blogContent";
$db = maakVerbinding();
$query = $db->prepare($sql);

$query->execute(array('title' => $zoek, 'blogContent' => $zoek));
$blogTitels=array();
$blogContent = array();
while($rij = $query->fetch()){
    ?> <br> <h8>Zoekresultaten</h8><br><br> <?php

    array_push($blogTitels, $rij[0]);
    array_push($blogContent, $rij[1]);

    $blogsArray = array(
      $blogTitels,
      $blogContent
      );
   $i = 0;
  foreach($blogArray as $blog ){
 if($i == 1){
 echo("<p>$blog[0]</p><br>");
}
if($i == 0){
  echo("<h10>$blog[0]</h10><br>");
$i++;
if($i == 2){
  $i = 0;
}
}
}
}

?>



  <form action="blog.php" method="GET">
  <input type="search" name="zoek" placeholder="Zoeken op blog..." /> 
  <input type="submit" value="Search" />
</form>

 <?php } 

if ($AantalBlogs == 0){
  ?> <div class="GeenInfo"> <br> <p>Er zijn op dit moment nog geen blogs geplaatst.</p> </div><?php
} ?>

</body>

<?php require_once 'footer.php'; ?>

</html>
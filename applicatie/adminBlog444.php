<!DOCTYPE html>
<html lang="nl">

<?php
  require_once 'header.php';
  require_once 'navbar.php';
require_once('db_connectie.php');
if($_SESSION['admin'] == 1){

  $Toevoegen= "";
?> 
 <h2> Hier kan de admin een blog of film toevoegen </h2>
 <div class="form_film_blog">
 <form name="adminBlog444.php" action="" method="post">
 <input type="radio"  name="toevoegen" value="film">
  <label for="film">Film</label>
  <input type="radio"  name="toevoegen" value="blog">
  <label for="blog">Blog</label>
  <button class="post_knop" type="submit">Confirm</button>
  </div>
  </form>
<?php if(isset($_POST['toevoegen'])){
if($_POST['toevoegen'] == 'film'){
  $Toevoegen = "Film";
}else{
    $Toevoegen = "Blog";
  }
}


if($Toevoegen == 'Blog') { ?>
<h2>Hier kan de admin blogs posten</h2> 
<form name="adminBlogFormulier.php" action="adminBlogFormulier.php" method="post">
            <strong>Titel</strong> <br>
            <input type="text" name="title" placeholder="Naam van de blog" required /><br>
            <strong>Blog inhoud</strong> <br>
            <input type="textBlog" name="blogContent" id="blogContent" placeholder="Typ hier de inhoud van de blog" required><br><br>
            <button class="post_knop" type="submit">Confirm</button>
        </form>
<?php 
}
if($Toevoegen == 'Film') { ?>
  <h2>Hier kan de admin nieuwe films toevoegen</h2> 
  <div class="adminFilmFormulier">
  <form name="adminFilmFormulier" action="adminFilmFormulier.php" method="post">
              <strong>Titel</strong> <br>
              <input type="text" name="title" placeholder="Typ hier de naam van de film" required /><br>
              <strong>Movie Id</strong> <br>
              <input type="number" name="movie_id" placeholder="Typ hier het movie id" required /><br>
              <strong>Samenvatting</strong> <br>
              <input type="textSamenvatting" name="description"  placeholder="Typ hier de samenvatting van de film" required><br>
              <strong>Director</strong> <br>
              <input type="number" name="director_person_id"  placeholder="Typ hier het id director" required><br>
              <strong>Acteurs</strong> <br>
              <input type="number" name="crew_person_id"  placeholder="Typ hier het id acteur" required><br>
              <strong>Rol</strong> <br>
              <input type="text" name="role" placeholder="Typ hier de rol van de acteur" required><br>
              <strong>Tijdsduur</strong> <br>
              <input type="number" name="duration" placeholder="Typ hier de tijdsduur van de film" required><br>
              <strong>Publicatiejaar</strong> <br>
              <input type="number" name="publication_year" placeholder="Typ hier het publicatiejaar van de film" required><br>
              <strong>Genre</strong> <br>
              <input type="text" name="genre_name" placeholder="Typ hier het genre van de film" required><br>
              <strong>Image (optioneel)</strong> <br>
              <input type="text" name="cover_image" placeholder="Voeg hier de image toe"><br>
              <strong>Trailer (optioneel)</strong> <br>
              <input type="text" name="URL" placeholder="Typ hier de URL van de trailer"><br>
              <strong>Previous part (optioneel)</strong> <br>
              <input type="number" name="previous_part" placeholder="Typ het id van de vorige film"><br>
              <strong>Price</strong> <br>
              <input type="number" name="price" placeholder="Typ hier de prijs van de film" required><br><br>
              <button class="post_knop" type="submit">Confirm</button>
              </form>
              </div>
  <?php }

$sql = "SELECT COUNT(*) FROM contactFormulier";
$verbinding = maakVerbinding();
$query = $verbinding->prepare($sql);
$query->execute();
$AantalContactFormulieren = $query->fetchColumn();


$sql = "SELECT * FROM contactFormulier"; 
$verbinding = maakVerbinding();
$query = $verbinding->prepare($sql);
$query->execute();

$Titels = array();
$Inhouds = array();
$Emails = array();

if($AantalContactFormulieren > 0){ 

while ($rij = $query->fetch()) {
    array_push($Titels, $rij[0]);
    array_push($Inhouds, $rij[1]);
    array_push($Emails, $rij[2]);
}


$contactArray = array(
  $Titels,
  $Inhouds,
  $Emails
);



?> 
 <h2> Ingevulde contactformuleren </h2>
<div class="contactPrint"> <?php
$Rij = 0;
$i = 0;
$aantalKerenUitgevoerd = 0;
foreach($contactArray as $contact ){


 if($Rij == 0){ ?>   <table>
      <tr>
        <?php } ?>
        <?php if($Rij == 0){ ?> 
      <th>Titel</th>
      <td><?php echo($contact[$i]) ?></td>
      <?php } if($Rij == 1) { ?>
      <th>Inhoud</th>
      <td><?php echo($contact[$i])  ?></td>
      <?php } if($Rij == 2) { ?>
      <th>Email</th>
      <td><?php echo($contact[$i])  ?></td>
      <?php } $Rij++; ?>
 <?php if($Rij == 3){ ?>
  </tr>
</table>
<?php if($Rij == 3){
  $Rij = 0;
  $i = $i + 1;
} } }
?>

 <?php } 

if ($AantalContactFormulieren == 0){
  
 ?> <h2> Contactformuleren </h2>
  <div class="GeenInfo"> <p> Er zijn nog geen contactformulieren ingevuld. </p> </div> <?php
}
?>
</div>
</body>

<?php require_once 'footer.php';
}else{
  header("location:index.php?default");
} ?>

</html>


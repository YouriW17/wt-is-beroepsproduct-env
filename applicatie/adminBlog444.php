<!DOCTYPE html>
<html lang="nl">

<?php require_once 'header.php';
require_once 'navbar.php';
require_once('db_connectie.php');

// require_once('db_connectie.php');
// if (isset($_POST['title'])){
// 	$title = htmlspecialchars($_POST['title']);
// 	$blogContent = htmlspecialchars($_POST['blogContent']);
//         $sql = "INSERT into adminBlog (title, blogContent) VALUES (?, ?)";
//         $verbinding = maakVerbinding();
//         $query = $verbinding->prepare($sql);
//         $query->execute([$title, $blogContent]);
//         // header("location:adminBlog.php");
// }
// heb snel naam van titel naar title aangepast moet weer terug!!!!!!!!!!! 
// Eerste post:
//Dit is de aller eerste blog van Fletnix. Bedankt voor het kiezen Fletnix. Geniet van alle films en series! Wij zullen u informeren zodra er nieuwe content wordt toegevoegd!
//Toevoeging samen kijken
//Dit de 2e post. Zoals u wellicht gemerkt heeft zijn we de afgelopen weken en beta functie: genaamd samen kijken toegevoegd. Deze functie brengen wij bij deze officieel uit. Samen kijk maakt het mogelijk om op afstand toch synchroon met vrienden of familie dezelfde film te kijken. Helemaal door corona waarbij alles op afstand wordt gedaan leek dit ons een nuttige implementatie. Kijk geregeld op de blog pagina om op de hoogte te blijven van de nieuwste updates. Groet Fletnix





$sql = "SELECT * FROM contactFormulier"; 
$verbinding = maakVerbinding();
$query = $verbinding->prepare($sql);
$query->execute();


?>


<h2>Hier kan de admin blogs posten</h2> 
<form name="adminBlogFormulier.php" action="" method="post">
            <strong>Titel</strong> <br>
            <input type="text" name="title" placeholder="Naam van de blog" required /><br>
            <strong>Blog inhoud</strong> <br>
            <input type="textBlog" name="blogContent" id="blogContent" placeholder="Typ hier de inhoud van de blog" required><br><br>
            <button class="post_knop" type="submit">Post</button>

        
            <h2> Ingevulde contactformuleren </h2>
            <div class="contactformuleren">
            <?php 


$sql = "SELECT * FROM contactFormulier"; 
$verbinding = maakVerbinding();
$query = $verbinding->prepare($sql);
$query->execute();

$Titels = array();
$Inhouds = array();
$Emails = array();
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



?> <div class="contactPrint"> <?php
foreach($contactArray as $contact ){

  ?>   <table>
      <tr>
      <th>Titel</th>
      <th>Inhoud</th>
      <th>Email</th>
</tr>
  <tr>
    <td><?php echo($contact[0])  ?></td>
    <td><?php echo($contact[1]) ?></td>
    <td><?php echo($contact[2]) ?></td>
  </tr>
</table>

 <?php }

?>
</div>
</body>

<?php require_once 'footer.php'; ?>

</html>


<!DOCTYPE html>
<html lang="nl">

<?php require_once 'header.php';
require_once 'navbar.php';
?>
<div class="contactFormulier";>
<h8>Contactformulier</h8>

<?php
require_once('db_connectie.php');
if (isset($_POST['Onderwerp'])){
	$Onderwerp = htmlspecialchars($_POST['Onderwerp']);
	$Inhoud = htmlspecialchars($_POST['Inhoud']);
        $Email = htmlspecialchars($_POST['Email']);
        $sql = "INSERT INTO contactFormulier (Onderwerp, Inhoud, Email) VALUES (?, ?, ?)";
        $verbinding = maakVerbinding();
        $query = $verbinding->prepare($sql);
        $query->execute([$Onderwerp, $Inhoud, $Email]);
        $_SESSION_['today'] = getdate();  //
        header("location:index.php?default");
}
?>

<form name="contactFormulier" action="" method="post">
            <strong>Onderwerp</strong> <br>
            <input type="text" name="Onderwerp" placeholder="Typ hier kort waarover u vraag/opmerking" required /><br>
            <strong>Inhoud vraag/opmerking</strong> <br>
            <input type="textInhoud" name="Inhoud" placeholder="beschrijf hier uw opmerking/vraag" required><br>
            <strong>Het e-mail adress waarop wij indien nodig contact mee op kunnen nemen</strong> <br> <!-- Dit zou ik kunnen als de gebruikers is ingelogd door de email uit de database te halen, maar niet ingelogde gebruikers kunnen dit ook invullen. Daarnaast wil je misschien dat er liever op een andere email contact opgenomen wordt. -->
            <input type="Email" name="Email" placeholder="Optioneel: vul uw e-mail adress in"><br><br>
            <button class="post_knop" type="submit">Post</button>




</div>
</body>
<?php require_once 'footer.php'; ?>
</html>
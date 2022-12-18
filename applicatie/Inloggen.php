<!DOCTYPE html>
<html lang="nl">

<?php require_once 'header.php';
require_once 'navbar.php';
?>

<main>

    <div>
        <p><?php


        if(isset($_SESSION["login_check"])){
            $_SESSION['error_login'] = $_SESSION["login_check"];
        }else{$_SESSION['error_login'] ="";}


        ?></p>
            <form action="Login22.php" method="POST">
                <p>
                    <label for="user_name">Gebruikersnaam</label><br>
                    <input type="text" id="user_name" placeholder="Enter uw gebruikersnaam" name="user_name" required><br>
                    <label for="wachtwoord">Wachtwoord</label><br>
                    <input type="password" id="wachtwoord" placeholder="Enter uw wachtwoord" name="Wachtwoord" required><br><br>
                    <input type="submit" value="Login">
                </p>
                <a href="uitloggen.php"> Uitloggen</a> <br> <br>
                <a href="Registreren.php"> Heeft u nog geen account? Registreren?</a>

               <?php echo ($_SESSION['error_login']); ?>    
    </div>
</main>


</body>
<?php require_once 'footer.php'; ?>

</html>
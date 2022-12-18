<?php 
require 'db_connectie.php';
require_once 'header.php';      
require_once 'navbar.php';
$db = maakVerbinding();

$user_name = htmlspecialchars($_POST['user_name']);
$Wachtwoord = htmlspecialchars($_POST['Wachtwoord']);

$sql_Controle_user_name = "SELECT user_name, password, admin FROM Customer WHERE user_name = :user_name";      // docker compose up en down werkt na blue screen niet meer zonder dit werkt inloggen
$query_Controle_user_name = $db->prepare($sql_Controle_user_name);
$query_Controle_user_name->execute(array('user_name' => $user_name));

while($rij = $query_Controle_user_name->fetch()) {
    if($rij[0]==$user_name){
        $gebruikte_user_name= "gebruikt";
        $password = $rij[1];
        $admin = $rij[2];     // docker compose up en down werkt na blue screen niet meer zonder dit werkt inloggen
    }
}
if($admin == 'yes'){    // docker compose up en down werkt na blue screen niet meer zonder dit werkt inloggen
    header("location:adminBlog444.php");     // docker compose up en down werkt na blue screen niet meer zonder dit werkt inloggen
}          // docker compose up en down werkt na blue screen niet meer zonder dit werkt inloggen
if(isset($gebruikte_user_name)){
    $_SESSION["Login_check"] = "";
    if(password_verify($Wachtwoord, $password)){
        $_SESSION["Login_check"] = "";
        $_SESSION['loggedin'] = 1;
        header("location:hoofdPagina.php?default");
        
}else{
    $_SESSION["Login_check"] = "Gebuikersnaam / wachtwoord is onjuist";
    header("location:inloggen.php");
}
}else{
    $_SESSION["Login_check"] = "Gebuikersnaam / wachtwoord is onjuist";
    header("location:inloggen.php");
}

?>
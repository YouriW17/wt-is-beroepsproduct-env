<?php 
require 'db_connectie.php';
require_once 'header.php';      
require_once 'navbar.php';
$db = maakVerbinding();

$user_name = htmlspecialchars($_POST['user_name']);
$Wachtwoord = htmlspecialchars($_POST['Wachtwoord']);

$sql_Controle_user_name = "SELECT user_name, password FROM Customer WHERE user_name = :user_name";     
$query_Controle_user_name = $db->prepare($sql_Controle_user_name);
$query_Controle_user_name->execute(array('user_name' => $user_name));

while($rij = $query_Controle_user_name->fetch()) {
    if($rij[0]==$user_name){
        $gebruikte_user_name = "gebruikt";
        $password = $rij[1];
    }
}

if(isset($gebruikte_user_name)){
    $_SESSION["Login_check"] = "";
    if(password_verify($Wachtwoord, $password)  && $user_name != "Youri1"){
        $_SESSION["Login_check"] = "";
        $_SESSION['loggedin'] = 1;
        header("location:hoofdPagina.php?default");
     } else if($user_name == "Youri1" && password_verify($Wachtwoord, $password)){ //admin
        $_SESSION["Login_check"] = "";
        $_SESSION['loggedin'] = 1;
        $_SESSION['admin'] = 1;
        header("location:adminBlog444.php");        
}else{
    $_SESSION["Login_check"] = "Gebuikersnaam / wachtwoord is onjuist";
    header("location:inloggen.php");
}
}else{
    $_SESSION["Login_check"] = "Gebuikersnaam / wachtwoord is onjuist";
    header("location:inloggen.php");
}
?>
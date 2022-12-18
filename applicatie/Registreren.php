<?php
require_once('db_connectie.php');

if (isset($_POST['user_name'])){
	$user_name = htmlspecialchars($_POST['user_name']);
	$customer_mail_address = htmlspecialchars($_POST['customer_mail_address']);
	$password = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']); 
        $passwordHashed = password_hash($password,  PASSWORD_DEFAULT);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $birth_date = htmlspecialchars($_POST['birth_date']);
        $gender = htmlspecialchars($_POST['gender']);
        $payment_card_number = htmlspecialchars($_POST['payment_card_number']);
        $contract_type = htmlspecialchars($_POST['contract_type']);
        $country_name = htmlspecialchars($_POST['country_name']);
        $payment_method =  htmlspecialchars($_POST['payment_method']);
        $subscription_start =  htmlspecialchars($_POST['subscription_start']);
        $subscription_end =  htmlspecialchars($_POST['subscription_end']);
        $sql = "INSERT into Customer (user_name, password, customer_mail_address, firstname, lastname, birth_date, payment_card_number, gender, contract_type, country_name, payment_method, subscription_start, subscription_end) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $verbinding = maakVerbinding();
        $query = $verbinding->prepare($sql);
        if($password == $password2){
          $query->execute([$user_name, $password, $customer_mail_address, $firstname, $lastname, $birth_date, $payment_card_number, $gender, $contract_type, $country_name, $payment_method, $subscription_start, $subscription_end]);
          header("location:inloggen.php");
        } else {
          echo "Wachtwoorden komen niet overeen";
        }
}

?>
<!DOCTYPE html>
<html lang="nl">

<?php require_once 'header.php';
require_once 'navbar.php';
?>

<main>
    <div>
        <form name="registration" action="" method="post">
            <strong>Voornaam</strong> <br>
            <input type="text" name="firstname" placeholder="Enter uw voornaam" required /><br>
            <strong>Achternaam</strong> <br>
            <input type="text" name="lastname" placeholder="Enter uw achternaam" required><br>
            <strong>Gebruikersnaam</strong> <br>
            <input type="text" name="user_name" placeholder="Enter uw gebruikersnaam" required> <br>
            <strong>E-mailadress</strong> <br>
            <input type="email" name="customer_mail_address" placeholder="Enter uw e-mailadress" required /><br>
            <strong>Geboortedatum</strong> <br>
            <input type="date" name="birth_date" placeholder="Enter uw geboortedatum" required> <br>
            <strong>Geslacht</strong> <br>
             <div class="form-field">
          <select name="gender" id="gender" required>
            <option value="" default>Maak een keuze</option>
            <option value="f" default>Vrouw</option>
            <option value="m" default>Man</option>
            <option value="n" default>Non-binary</option>
            <option value="o" default>Iets anders</option>
            <option value="r" default>Wil niet zeggen</option>
          </select>
            </div>
            <strong>Wachtwoord</strong> <br>
            <input type="password" name="password" placeholder="Enter uw wachtwoord" required /><br>
            <strong>Wachtwoord</strong> <br>
            <input type="password" name="password2" placeholder="Herhaal uw wachtwoord" required /> <br>
            <strong>Contract type</strong> <br>
            <div class="form-field">
          <select name="contract_type" id="contract_type" required>
            <option value="" default>Maak een keuze</option>
            <option value="Basic" default>Basic: €4.99 per maand. HD kwaliteit. 1 personen</option>
            <option value="Premium" default>Plus: €7.99 per maand. 2K kwaliteit. 2 personen</option>
            <option value="Pro" default>Deluxe: €8.99 per maand. 4K kwaliteit. 5 personen</option>
          </select>
            </div>
            <strong>Land</strong> <br>
            <div class="form-field">
          <select name="country_name" id="country_name" required>
            <option value="" default>Maak een keuze</option>
            <option value="Netherlands" default>Nederland</option>
            <option value="Belgium" default>België</option>
          </select>
            </div>
            <strong>Betaal methode</strong> <br>
            <div class="form-field">
          <select name="payment_method" id="payment_method" required>
            <option value="" default>Maak een keuze</option>
            <option value="Amex" default>Amex</option>
            <option value="Mastercard" default>Mastercard</option>
            <option value="Visa" default>Visa</option>
          </select>
            </div>
            <strong>Begin datum abbonement</strong> <br>  <!-- is je start datum later dan huidige datum kan je toch pas kijken vanaf de start datum -->
            <input type="date" name="subscription_start" placeholder="Enter uw begin datum" required> <br>
            <strong>Eind datum abbonement</strong> <br>
            <input type="date" name="subscription_end" placeholder="Enter uw eind datum" required> <br>
            <strong>Rekeningnummer</strong> <br>
            <input type="text" name="payment_card_number" placeholder="Enter uw rekeningnummer" required> <br> <br>
            <a class="privacyverklaaring_akkoord" href="Over_ons_&_Privacy_verklaaring.php">Door op registeren te klikken
                gaat u akkoord met de privacy verklaaring</a> <br> <br>
            <button class="register_knop" type="submit">Registeren</button><br> <br>
            <a href="Inloggen.php"> Heeft u al een account? Inloggen? </a> <br>
    </div>
</main>


</body>
<?php require_once 'footer.php'; ?>
</html>


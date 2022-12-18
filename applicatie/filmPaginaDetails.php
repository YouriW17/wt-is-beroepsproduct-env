<?php require_once 'header.php';
require_once 'navbar.php';
?>

<?php 
require 'db_connectie.php';

if (isset($_GET['movie_id'])) {     //Als dit namelijk niet gevonden is heeft het geen zin om de andere gevens wel weer te geven.
    $movie_id = htmlspecialchars($_GET['movie_id']);  
    $db = maakVerbinding();
    $sql_film = "SELECT * FROM movie WHERE movie_id = :movie_id";
    $query_film = $db->prepare($sql_film);
    $query_film->execute(array('movie_id' => $movie_id));

    while($rij = $query_film->fetch()) {
        $titel = $rij[1];
        $Tijdsduur = $rij[2];
        $samenvatting = $rij[3];
        $Publicatiejaar = $rij[4];
        $img_titel = $rij[5];
        $prev_part = $rij[6];
        };
        if($img_titel == NULL){ 
        $img_titel = '<img src="Foto/placeholder.png" width = 300 height = 300 alt="placeholder">';}

        $sql_director = "SELECT (firstname + ' ' + lastname) AS Naam FROM movie_director JOIN person ON person.person_id = movie_director.person_id WHERE movie_id = :movie_id";
        $query_director = $db->prepare($sql_director);
        $query_director->execute(array('movie_id' => $movie_id));
        
        while($rij_d = $query_director->fetch()) {
            $director = $rij_d[0];
        }
        if(isset($director)){
        }else{$director = "Could not be found";}

        $sql_cast = "SELECT (firstname + ' ' + lastname) AS Naam, role FROM movie_cast JOIN person ON person.person_id = movie_cast.person_id WHERE movie_id = :movie_id";
        $query_cast = $db->prepare($sql_cast);
        $query_cast->execute(array('movie_id' => $movie_id));
        
        $cast = "";
        while($rij_c = $query_cast->fetch()) {
            $cast .= $rij_c[0]." als ".$rij_c[1]."<br>";
        }
        if($cast == ""){
        $cast = "Could not be found";}

        $sql_genres = "SELECT genre_name FROM movie_genre WHERE movie_id = :movie_id";
        $query_genres = $db->prepare($sql_genres);
        $query_genres->execute(array('movie_id' => $movie_id));

        $genres = "";
        while($rij_g = $query_genres->fetch()) {
            $genres .= $rij_g[0]."<br>";
        }

}else {
    $foutmelding = "Deze film is niet gevonden!";
}
?>
<main class="Grid_main">
    <Section>
        <h8><?php echo($titel);?></h8> <br>
        <?php echo($img_titel)?>
    </Section>
    <Section>
        <h8>Samenvatting</h8><br>
        <p><?php echo($samenvatting); ?></p>
    </Section>
    <section>
        <h8>Director</h8>
        <p><?php echo($director);?></p><br>
    </section> 
    <section>
        <h8>Cast</h8>
        <p><?php echo($cast. '<br>');
        ?><p>

    </p>
    </section>
    <section>
        <h8>Tijdsduur in minuten en Publicatiejaar</h8>
        <p><?php echo($Tijdsduur);?> Minuten<br>
        <?php echo($Publicatiejaar);?>
        </p>
    </section>
    <section>
        <h8>Genre's</h8>
        <p><?php echo($genres);?><p>
    </section>
    </main>
    

    <?php require_once 'footer.php'; ?>
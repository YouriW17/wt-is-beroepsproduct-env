<?php require_once 'header.php';
require_once 'navbar.php';
?>

<?php 
require 'db_connectie.php';

$admin = false;
if(isset($_SESSION['admin'])){
    if($_SESSION['admin'] == 1){
     $admin = true;
    }
}

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
            $actor = 658737;
            $rol = 2;  
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

$minimaalEenIngevuld = false;
if (isset($_POST['titel'])){
	$title = htmlspecialchars($_POST['titel']);
    $minimaalEenIngevuld = true;
} else {
    $title = $titel;
}
if(isset($_POST['samenvatting']) && $_POST['samenvatting'] != ""){
    $description = htmlspecialchars($_POST['samenvatting']);
    $minimaalEenIngevuld = true;
} else {
    $description = $samenvatting;
}
    if(isset($_POST['Director']) && $_POST['Director'] != ""){
	$Director = htmlspecialchars($_POST['Director']);
    $minimaalEenIngevuld = true;
    } else {
        $Director = $director;
    }
    if(isset($_POST['cast']) && $_POST['cast'] != ""){
        $crew = htmlspecialchars($_POST['cast']); 
        $minimaalEenIngevuld = true;
    } else {
        $crew = $actor;
    }
    if(isset($_POST['genre']) && $_POST['genre'] != ""){
        $genre = htmlspecialchars($_POST['genre']);
        $minimaalEenIngevuld = true;
    } else {
        $genre = $genres;
    }
    if(isset($_POST['Tijdsduur']) && $_POST['Tijdsduur'] != ""){

        $duration = htmlspecialchars($_POST['Tijdsduur']);
        $minimaalEenIngevuld = true;
    } else {
        $duration = $Tijdsduur;
    }
    if(isset($_POST['rol']) && $_POST['rol'] != ""){
        $role = htmlspecialchars($_POST['rol']);
        $minimaalEenIngevuld = true;
    } else {
        $role = $rol;
    }
    if(isset($_POST['Publicatiejaar']) && $_POST['Publicatiejaar'] != ""){
        $publication_year = htmlspecialchars($_POST['Publicatiejaar']);
        $minimaalEenIngevuld = true;
    } else{
        $publication_year = $Publicatiejaar;
    }
if($minimaalEenIngevuld == true){
            $sql = "UPDATE Movie SET title = ?, duration = ?, description = ?, publication_year = ? WHERE movie_id = ?"; //movie id is huidige movie id en moet met update 
            $query = $verbinding->prepare($sql);
            $query->execute([$title, $duration, $description, $publication_year, $movie_id]);
            
            $sql = "UPDATE Movie_Cast SET role = ? WHERE movie_id = ? and person_id = ?";
            $query = $verbinding->prepare($sql);
            $query->execute([$crew, $role, $movie_id]);
            
            $sql = "UPDATE Movie_Director SET person_id = ? WHERE movie_id = ?";
            $query = $verbinding->prepare($sql);
            $query->execute([$Director, $movie_id]);

            $sql = "UPDATE Movie_Genre SET genre_name = ? WHERE movie_id = ?";
            $query = $verbinding->prepare($sql);
            $query->execute([$genre, $movie_id]);
        
          header("location:index.php?default");
}



?>
<main class="Grid_main">
 <?php   if($admin == true){ ?>
<form name="filmsAanpassen" action="" method="post">
<?php } ?>
    <Section>
        <h8><?php echo($titel);?></h8> <br>
        <?php if($admin == true){ ?>
        <input type="text" name="titel" value="<?php $title ?>" placeholder="Enter de nieuwe titel" /><br>
        <?php } echo($img_titel)?>
    </Section>
    <Section>
        <h8>Samenvatting</h8><br>
        <p><?php echo($samenvatting); ?></p>
        <?php if($admin == true){ ?>
        <input type="textSamenvatting" name="samenvatting" <?php $description ?> placeholder="Enter de nieuwe samenvatting" /><br>
        <?php } ?>
    </Section>
    <section>
        <h8>Director</h8>
        <p><?php echo($director);?></p><br>
        <?php if($admin == true){ ?>
        <input type="number" name="Director" <?php $Director ?> placeholder="Enter de id van de nieuwe Director" /><br>
        <?php } ?>
    </section> 
    <section>
        <h8>Cast</h8>
        <p><?php echo($cast. '<br>'); ?><p>
        <?php if($admin == true){ ?>
            <input type="number" name="cast" <?php $cast ?> placeholder="Enter het id van de actor waarvan je de rol wil veranderen" /><br>
            <input type="text2" name="rol" <?php $role ?> placeholder="Enter de nieuwe rol" /><br>
        <?php }?>

    </p>
    </section>
    <section>
        <h8>Tijdsduur in minuten en Publicatiejaar</h8>
        <p><?php echo($Tijdsduur);?> Minuten<br>
        <?php if($admin == true){ ?>
        <input type="number" name="Tijdsduur" <?php $duration ?> placeholder="Enter de nieuwe Tijdsduur" /><br>
        <?php } ?>
        <?php echo($Publicatiejaar);?> <br>
        <?php if($admin == true){ ?>
        <input type="number" name="Publicatiejaar" <?php $publication_year ?> placeholder="Enter het nieuwe Publicatiejaar" /><br>
        <?php } ?>
        </p>
    </section>
    <section>
        <h8>Genre's</h8>
        <p><?php echo($genres);?><p>
        <?php if($admin == true){ ?>
        <input type="text2" name="genre" <?php $genres ?> placeholder="Enter de nieuwe genres" /><br><br>
        <input type="number" name="movie_id" value="<?php $movie_id ?>" hidden><br>
        <?php } 
        if($admin == true){
            ?>
            <button class="post_knop" type="submit">Wijzegingen doorvoeren</button><br> <br> <?php
        }?>      
    </section>
    </main>
    

    <?php require_once 'footer.php'; ?>
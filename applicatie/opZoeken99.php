<!DOCTYPE html>
<html lang="nl">

<?php require_once 'header.php';
require_once 'navbar.php';
?>


<?php 
require_once 'db_connectie.php';
$db = maakVerbinding();
$zoek = "%{$_GET['zoeken']}%"; 

$sql = "SELECT title, movie.movie_id FROM movie JOIN Movie_genre ON movie.movie_id = movie_genre.movie_id
WHERE title LIKE :title OR genre_name LIKE :genre or publication_year like :pub_year";

$query = $db->prepare($sql);
$query->execute(array('title' => $zoek, 'genre' => $zoek, 'pub_year' => $zoek));
$films=array();
$film_ids = array();
while($rij = $query->fetch()){
    array_push($films, $rij[0]);
    array_push($film_ids, $rij[1]);
}


$query_genre = 'SELECT genre_name FROM Genre';
$query_genre = $db->query($query_genre);
$genres = array();
while($rij = $query_genre->fetch()){
    array_push($genres, $rij[0]);
}
?>
<main>      <div class="genre">
            <?php 
            foreach($genres as $genre){
                echo("<section >
                <div><a href=opZoeken99.php?zoeken={$genre}>{$genre}</a></div>         
                </section>");
            }
            ?>   
</div>

<h2>Film Aanbod</h2>
        <div class="film aanbod">
        <p><?php 
            foreach($film_ids as $id){
                $index = array_search($id, $film_ids); 
                echo("
                <section>
                <div><a href='opZoeken99.php?movie_id={$id}'>{$films[$index]}</a></div>         
                <a href='filmPaginaDetails.php?movie_id={$id}'><img src='foto/placeholder.png' width = 200 height = 200 alt= 'placeholder' /></a>
                </section>");
            }
            ?><p>

</body>
<?php require_once 'footer.php'; ?>
</main>
</html>

<?php

require_once 'header.php';
require_once 'navbar.php';
require_once('db_connectie.php');

if($_SESSION['admin'] == 1){

$required = array('movie_id', 'title', 'duration', 'description', 'publication_year', 'price', 'crew_person_id', 'role', 'director_person_id', 'genre_name');
$error = false;

foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}
if($error == true){
  header("location:adminBlog444.php?error=nietAlleVeldenIngevuld");
}else{
        $movie_id = htmlspecialchars($_POST['movie_id']);
        $title = htmlspecialchars($_POST['title']);
        $duration = htmlspecialchars($_POST['duration']);
        $description = htmlspecialchars($_POST['description']);
        $publication_year = htmlspecialchars($_POST['publication_year']);
        if(isset($_POST['cover_image']) && $_POST['cover_image'] != ""){
            $cover_image = htmlspecialchars($_POST['cover_image']);
        } else {
            $cover_image = NULL;
        }
        if(isset($_POST['previous_part']) && $_POST['previous_part'] != ""){
            $previous_part = htmlspecialchars($_POST['previous_part']);
        } else {
            $previous_part = NULL;
        }
        $price = htmlspecialchars($_POST['price']);
        if(isset($_POST['URL']) && $_POST['URL'] != ""){
            $URL = htmlspecialchars($_POST['URL']);
        } else {
            $URL = NULL;
        }
        $crew = htmlspecialchars($_POST['crew_person_id']);
        $role = htmlspecialchars($_POST['role']);
        $Director = htmlspecialchars($_POST['director_person_id']);
        $genre = htmlspecialchars($_POST['genre_name']);
        
            $sql = "INSERT INTO Movie  (movie_id, title, duration, description, publication_year, cover_image, previous_part, price, URL) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";  
            $query = $verbinding->prepare($sql);
            $query->execute([$movie_id, $title, $duration, $description, $publication_year, $cover_image, $previous_part, $price, $URL]);

            $sql = "INSERT INTO Movie_Genre (movie_id, genre_name) VALUES (?, ?)";
            $query = $verbinding->prepare($sql);
            $query->execute([$movie_id, $genre]);
         
            $sql = "INSERT INTO Movie_Cast (person_id, role, movie_id) VALUES (?, ?, ?) ";
            $query = $verbinding->prepare($sql);
            $query->execute([$crew, $role, $movie_id]);

            $sql = "INSERT INTO Movie_Director (person_id, movie_id) VALUES (?, ?)";
            $query = $verbinding->prepare($sql);
            $query->execute([$Director, $movie_id]);


          
            header("location:adminBlog444.php?filmToegevoegd=success");

} 
}else{
    header("location:index.php?default");
}
?>
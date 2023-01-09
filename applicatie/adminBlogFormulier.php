<?php
  require_once 'header.php';
  require_once 'navbar.php';
require_once('db_connectie.php');

if($_SESSION['admin'] == 1){

if (isset($_POST['title']) && isset($_POST['blogContent'])) {
	$title = htmlspecialchars($_POST['title']);
	$blogContent = htmlspecialchars($_POST['blogContent']);
        $sql = "INSERT INTO adminBlog (title, blogContent) VALUES (?, ?)";
        $verbinding = maakVerbinding();
        $query = $verbinding->prepare($sql);
        $query->execute([$title, $blogContent]);
        echo("het werkt");
        header("location:Blog.php?zoek=default");
}
else {
        header("location:adminBlog444.php?Error=Toevoegen_mislukt");
}
}else{
        header("location:index.php?default");
}
?>
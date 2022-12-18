<?php

require_once('db_connectie.php');
if (isset($_POST['title'])){
	$title = htmlspecialchars($_POST['title']);
	$blogContent = htmlspecialchars($_POST['blogContent']);
        $sql = "INSERT into adminBlog (title, blogContent) VALUES (?, ?)";
        $verbinding = maakVerbinding();
        $query = $verbinding->prepare($sql);
        $query->execute([$title, $blogContent]);
        header("location:adminBlog.php");
}

?>
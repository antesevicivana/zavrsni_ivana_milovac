<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite

    if (!isset($_GET['id'])) {
        var_dump($_GET['id']);
        die('404');
    }

    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "Ivana_Zavrsni";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    $sql_delete_post_comments = "DELETE FROM comments WHERE Post_id = ?";
    $statement_delete_post_comments = $connection->prepare($sql_delete_post_comments);
    $statement_delete_post_comments->execute([$_GET['id']]);


    $sql_delete_post = "DELETE FROM posts WHERE Id = ?";
    $statement_delete_post = $connection->prepare($sql_delete_post);
    $statement_delete_post->execute([$_GET['id']]);

    
    
    header('Location: /posts.php');

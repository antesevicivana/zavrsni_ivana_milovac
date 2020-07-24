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




    $sql_delete = "DELETE FROM comments WHERE Id = ?";
    $statement_delete = $connection->prepare($sql_delete);
    $statement_delete->execute([$_GET['id']]);

    $post_id=$_GET['postId'];
    
    header('Location: /single-post.php?id=' . $post_id);


   
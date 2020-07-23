<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite

    

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

    if (!empty($_POST['author']) && !empty($_POST['text']) && !empty($_POST['post_id']) ) {

    

    $author = $_POST['author'];
    $text = $_POST['text'];
    $post_id = $_POST['post_id'];

    $sql= "INSERT INTO comments (Author, Text, Post_id) VALUES (?, ?, ?)";

        $statement = $connection->prepare($sql);


        $statement->execute([$author, $text, $post_id]);

        header('Location: /single-post.php?id=' . $post_id);

    }

   

               


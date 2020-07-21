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
?>

<?php
    include "header.php"

?>

<main role="main" class="container">
<div class="row">

<div class="col-sm-8 blog-main">

            <?php

                // pripremamo upit
                $sql = "SELECT * FROM posts ORDER BY Created_at DESC";
                $statement = $connection->prepare($sql);

                // izvrsavamo upit
                $statement->execute();

                // zelimo da se rezultat vrati kao asocijativni niz.
                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                $statement->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita
                $posts = $statement->fetchAll();

                

            ?>

            <?php
                foreach ($posts as $post) {
            ?>


    <div class="blog-post">
        <a href="single-post.php?id=<?php echo($post['Id']) ?>"><h2 class="blog-post-title"><?php echo($post['Title'])?></h2></a>
        <p class="blog-post-meta"><?php echo($post['Created_at']) ?> by <a href="#"><?php echo($post['Author']) ?></a></p>
        <div><p><?php echo($post['Body']); ?></p></div>
        
    </div><!-- /.blog-post -->

            <?php
                }
            ?>

    

    <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
    </nav>

</div><!-- /.blog-main -->
<?php
    
    include "sidebar.php"; 
    include "footer.php"
?>






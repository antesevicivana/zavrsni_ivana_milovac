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
                $sql = "SELECT * FROM posts WHERE Id = ?";
                $statement = $connection->prepare($sql);

                // izvrsavamo upit
                $statement->execute([$_GET['id']]);

                // zelimo da se rezultat vrati kao asocijativni niz.
                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                $statement->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita
                $single_post = $statement->fetch();

                

            ?>

            



    <div class="blog-post">
        <a href="single-post.php?id=<?php echo($single_post['Id']) ?>"><h2 class="blog-post-title"><?php echo($single_post['Title'])?></h2></a>
        <p class="blog-post-meta"><?php echo($single_post['Created_at']) ?> by <a href="#"><?php echo($single_post['Author']) ?></a></p>
        <div><p><?php echo($single_post['Body']); ?></p></div>
        
    </div><!-- /.blog-post -->

    

    

</div><!-- /.blog-main -->
<?php
    
    include "sidebar.php"; 
    include "footer.php"
?>






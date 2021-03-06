<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite

    if (!isset($_GET['id'])) {
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
                $sql_comments = "SELECT * FROM comments WHERE Post_id = ?";
                
                $statement = $connection->prepare($sql);
                $statement_comments = $connection->prepare($sql_comments);
                

                // izvrsavamo upit
                $statement->execute([$_GET['id']]);
                $statement_comments->execute([$_GET['id']]);
                

                // zelimo da se rezultat vrati kao asocijativni niz.
                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $statement_comments->setFetchMode(PDO::FETCH_ASSOC);
                

                // punimo promenjivu sa rezultatom upita
                $single_post = $statement->fetch();
                $comments = $statement_comments->fetchAll();
                
               
          
            ?>

            



    <div class="blog-post">
        <a href="single-post.php?id=<?php echo($single_post['Id']) ?>"><h2 class="blog-post-title"><?php echo($single_post['Title'])?></h2></a>
        <p class="blog-post-meta"><?php echo($single_post['Created_at']) ?> by <a href="#"><?php echo($single_post['Author']) ?></a></p>
        <div><p><?php echo($single_post['Body']); ?></p></div>

        <button class='btn' id='deletePost' onclick="DeletePost(<?php echo($single_post['Id']) ?>  )">Delete post</button>

    
        
    </div><!-- /.blog-post -->

                <script type="text/javascript">
                    function ShowHideComments(btn) {
                        
                        var comments = document.getElementById("comments");
                        if (btn.value == "No") {
                            comments.style.display = "block";
                            btn.value = "Yes";
                            btn.innerText = 'Hide comments';
                            
                        } else {
                            comments.style.display = "none";
                            btn.value = "No";
                            btn.innerText = 'Show comments';
                        }
                    
                    }

                    function Delete(commentId, postId){
                        console.log(commentId, postId);
                        var deleted = document.getElementById('delete');
                        window.location='/delete-comment.php?id=' +  commentId + '&postId=' + postId;

                    }

                    function DeletePost(postId){
                        var deletedPost=document.getElementById('deletePost');
                        confirm("Do you really want to delete this post?!");
                        window.location='delete-post.php?id=' + postId;
                        
                    }

                    
                </script>


        


        
<?php
    
    
    include "comments.php"
?>


    

</div><!-- /.blog-main -->

            
<?php
    
    include "sidebar.php"; 
    include "footer.php"
?>






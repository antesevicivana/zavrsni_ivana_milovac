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

    
    

    if (!empty($_POST['title']) && !empty($_POST['body']) && !empty($_POST['postAuthor'])  ) {

        

        $title = $_POST['title'];
        $author = $_POST['postAuthor'];
        $body = $_POST['body'];
        $created_at = date('Y-m-d h:i:s');
    
        $sql= "INSERT INTO posts (Title, Body, Author, Created_at) VALUES (?, ?, ?, ?)";
    
            $statement = $connection->prepare($sql);
    
    
            $statement->execute([$title, $author, $body, $created_at]);
    
            header('Location: /posts.php');
         
    
        }
    


        include "header.php"
?>

<main role="main" class="container">
<div class="row">


    <div class='alert-danger' id='postAlert'></div>
                <form method="POST" action="" id='postForm' name = "postForm" >
                    <p>
                        
                        <label>Title post:</label>
                        <input type='text' id='title' name='title' /></br>
                        <label>Add a content:</label>
                        <input type='text' id='body' name='body' /><br>
                        <label>Author:</label>
                        <input type='text' id='postAuthor' name='postAuthor' /><br>                        
                        <input type='submit' value='Create post'/>
                    </p>
                </form>
    </div>


<?php
    
    include "sidebar.php"; 
    include "footer.php"
?>


        <script type="text/javascript">
            (function() {
            var postForm = document.getElementById("postForm");
            postForm.addEventListener("submit", function(event){

            event.preventDefault();

                
            
                if(document.getElementById('title').value==''){
                    document.getElementById('postAlert').style.display = "block";
                    document.getElementById('postAlert').innerText = 'You must write title!';
                    return;
                }
                
                if(document.getElementById('body').value==''){
                    document.getElementById('postAlert').style.display = "block";
                    document.getElementById('postAlert').innerText = 'You must write your content!';
                    return;
                }
                if(document.getElementById('postAuthor').value==''){
                    document.getElementById('postAlert').style.display = "block";
                    document.getElementById('postAlert').innerText = 'You must write your name!';
                    return;
                }
                

            postForm.submit();
            
            });
            })();

            
            
                    


          
        </script>
        
       
       
       <h3>Comments</h3>
        <div class="col-sm-8 blog-main">
            <div class='alert-danger' id='alert'>OVDE JE</div>



                <form method="POST" action="/create-comment.php" id='form' name = "form" ">
                    <p>
                        <input type='hidden' name='post_id' value='<?php echo $single_post['Id']; ?>'/>
                        <label>Your name:</label>
                        <input type='text' id='author' name='author' /></br>
                        <label>Add a comment:</label>
                        <input type='text' id='text' name='text' /><br>
                        <input type='submit' value='Post comment'/>
                    </p>
                </form>
        </div>


        <button class='btn' value="Yes" onclick="ShowHideComments(this)">Hide comments</button>
        <div id='comments'>

            
​
            
            <?php 
                foreach($comments as $comment) {
            ?>
                        
                <ul>
                    <li>Author: <br/> <?php echo($comment['Author']) ?></li><br/>
                    <li>Comment: <br/> <?php echo($comment['Text']) ?></li><br/>
                    <hr>
                </ul>             
                
            <?php
            
                }
            ?>    

        </div>
        <script type="text/javascript">
            (function() {
            var form = document.getElementById("form");
            form.addEventListener("submit", function(event){

            event.preventDefault();

                console.log(document.getElementById('author').value);
                console.log(document.getElementById('text').value);
            
                if(document.getElementById('author').value==''){
                    document.getElementById('alert').style.display = "block";
                    document.getElementById('alert').innerText = 'You must write your name!';
                    return;
                }
                
                if(document.getElementById('text').value==''){
                    document.getElementById('alert').style.display = "block";
                    document.getElementById('alert').innerText = 'You must write your comment!';
                    return;
                }
                

            form.submit();
            
            });
            })();

        </script>
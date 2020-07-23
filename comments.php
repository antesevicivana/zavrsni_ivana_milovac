        <h3>Comments</h3>
        <div class="col-sm-8 blog-main">
                <form method="POST" action="/create-comment.php">
                    <p>
                        <input type='hidden' name='post_id' value='<?php echo $single_post['Id']; ?>'/>
                        <label>Your name:</label>
                        <input type='text' name='author'/></br>
                        <label>Add a comment:</label>
                        <input type='text' name='text'/><br>
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
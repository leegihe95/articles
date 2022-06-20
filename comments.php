<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Single Article</title>
    </head>
    <style>
        h3{
            text-align : center;
        }
        h3{
            background-color : black;
            color : white;
            font-size : 0.9em;
            margin-bottom : 0px;
        }
        .news p{
            background-color : #CCCCCC;
            margin-top : 0px;
        }
        .news{
            width : 70%;
            margin : auto;
        }
        a{
            text-decoration : none;
            color : blue;
        }
        fieldset{
            width: 500px;
        }
        #comment{
            vertical-align: middle;
        }
        #commentSec{
            width: 500px;
            box-shadow: 0px 0px 2px 0px black;
        }
        #user{
            background-color: #CCCCCC;
            width: 500px;
        }
    
    </style>
    <body>
        <?php 
            if(!empty($_GET)){
                try{
                    $db = new PDO('mysql:host=localhost;dbname=camiladb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                }catch (Exception $e){
                    die('Error : ' . $e->getMessage());
                }
                
                // DEFINING WHICH ARTICLE TO DISPLAY
                $article_id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null; // 1, 2, 3, 4, 5
                
            ?>

            <a href="index.php"><em>Back to the Main Page</em></a>
            <?php
                // REQUEST DISPLAY THE ARTICLE CHOSEN
                $response = $db->query("SELECT id, title, content, date_creation FROM articles WHERE id = $article_id ORDER BY date_creation");
                $data = $response->fetch(PDO::FETCH_OBJ);
                $response->closeCursor();
                
                if($data){
                    include("articleView.php");
            ?>
                <h1>Comments</h1>
            <?php
                // REQUEST TO DISPLAY THE COMMENTS FOR SELECTED ARTICLE
                $response = $db->query("SELECT article_id, author, comment, date_posted FROM comments WHERE article_id = $article_id");
                while($data = $response->fetch(PDO::FETCH_OBJ)){
                    ?>      
                <div id="commentSec">
                    <p id="user"><strong><?php echo htmlspecialchars($data->author)?></strong> at <?php echo htmlspecialchars($data->date_posted).' :<br>'?></p>
                    <p><?php echo htmlspecialchars($data->comment) ?></p>          
                </div>
                <?php
                }
                $response->closeCursor();
            ?>
                <br>
                <form action="comments_post.php" method="POST">
                    <fieldset>
                        <!-- when devs want to pass hidden information to other pages, use input:hidden  -->
                        <input type="hidden" name="article" value="<?php echo $article_id?>"> 
                        <legend>Add a comment:</legend>
                        <label for="author">Username: </label>
                        <input type="text" id="author" name="author" placeholder="Username">
                        <br><br>
                        <label for="comment">Comment: </label>
                        <textarea name="comment" id="comment" cols="30" rows="5" placeholder="Write a comment."></textarea>
                        <br><br>
                        <input type="submit" value="Submit">
                    </fieldset>
                </form>
            <?php
                }else{
                    echo "<br><br>Article does not exist.";
                }
            }else{
                echo "the url does not contain an article ID";
            }
            ?>
        
    </body>
</html>
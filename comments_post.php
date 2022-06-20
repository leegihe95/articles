<?php 
    if((!empty($_POST['author'])) AND (!empty($_POST['comment'])) AND (!empty($_POST['article']))){
        $author = $_POST['author'];
        $comment = $_POST['comment'];
        $article = $_POST['article'];
        
        try{
            $db = new PDO('mysql:host=localhost;dbname=camiladb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch (Exception $e){
            die('Error : ' . $e->getMessage());
        }
        
        // only put in the array what needs to be calculated; since id and date are given by us, insert directly on VALUE()
        $req = $db->prepare("INSERT INTO comments(id, article_id, author, comment, date_posted) VALUES (null, :article_id, :author, :comment, NOW())") or die (print_r($db->errorInfo()));
        $req->execute(array(
            'article_id' => $article,
            'author' => $author,
            'comment' => $comment
        ));
        
        $req->closeCursor();

    }
    header('Location: comments.php?id='. $article);
?>
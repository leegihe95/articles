<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <style>
        h1,h3{
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
    </style>
</head>
<body>
    <?php 
        try{
            $db = new PDO('mysql:host=localhost;dbname=camiladb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch (Exception $e){
            die('Error : ' . $e->getMessage());
        }

        $response = $db->query("SELECT id, title, content, date_creation FROM articles ORDER BY date_creation");
        while($data = $response->fetch(PDO::FETCH_OBJ)){
            include("articleView.php");
        }
        $response->closeCursor();
    ?>
    
</body>
</html>
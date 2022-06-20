<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Articles</title>
</head>
<body>
    <h1>Articles</h1>
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
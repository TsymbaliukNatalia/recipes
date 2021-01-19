<?php
    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("Location:index.php");
    } 
    // else {
    //     header("Location:index.php");
    // }
    $user_id = $_SESSION["user_id"];
    if(isset($_POST["submit"])){
        if(isset($_POST["title"]) && !empty($_POST["title"])){
            $title = trim(htmlspecialchars($_POST["title"]));
        } 
        if(isset($_POST["time_cookin"]) && !empty($_POST["time_cookin"])){
            $time_cookin = trim(htmlspecialchars($_POST["time_cookin"]));
        }
        if(isset($_POST["description_recipe"]) && !empty($_POST["description_recipe"])){
            $description_recipe = trim(htmlspecialchars($_POST["description_recipe"]));
        }
        if(isset($_POST["ingridients"]) && !empty($_POST["ingridients"])){
            $ingridients = trim(htmlspecialchars($_POST["ingridients"]));
            $ingridients = explode(",",$ingridients);
        }
    }
    if(isset($title)&&isset($time_cookin)&&isset($description_recipe)&&isset($ingridients)){
        require "connection.php";
        // $query = "INSERT INTO recipe (title, description, `time`, `user_id`, `date_add`) VALUES (`$title`,`$description_recipe`,`$time_cookin`,`$user_id`,now()";
        // $statement = $connection->exec($query);

        $sth = $connection->prepare("INSERT INTO recipe (`title`, `description`, `time`, `user_id`, `date_add`) VALUES (`:_title`,`:description_recipe`,`:time_cookin`,`:user_id`,:date_add)");
        $sth->execute(array(
            '_title' => $title, 
            'description_recipe' => $description_recipe,
            'time_cookin' => $time_cookin,
            'user_id' => $user_id,
            'date_add' => date('Y-m-d')
         ));
         $info = $sth->errorInfo();
print_r($info);
        // Получаем id вставленной записи
        $insert_id = $connection->lastInsertId();
        echo $insert_id;

    //    $row = $statement->fetch(PDO::FETCH_ASSOC);
    }
    var_dump($_FILES);
    $dir_img ="images/";
    if(isset($_FILES["image"]) && $_FILES["image"]["error"]===UPLOAD_ERR_OK){
        move_uploaded_file($_FILES["image"]["tmp_name"], $dir_img.$_FILES["image"]["name"]);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <label> 
        <p>Title</p>
        <p><input type="text" name="title" required></p>
        </label>
        <label> 
        <p>Time</p>
        <p><input type="number" name="time_cookin" required></p>
        </label>
        <label> 
        <p>Description</p>
        <textarea name="description_recipe" required></textarea>
        </label>
        <label> 
        <p>Ingridients</p>
        <p><input type="text" name="ingridients" required></p>
        </label>
        <label> 
        <p>Image</p>
        <p><input type="file" name="image"></p>
        </label>
        <input type="submit" name="submit">
        
    </form>
</body>
</html>
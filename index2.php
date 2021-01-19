<?php

session_start();
// var_dump($_SESSION);
require('connection.php');
$query = 'SELECT id, title FROM recipe';
$statement = $connection->query($query);

while ($row = $statement->fetch(PDO::FETCH_OBJ)) {
    $rows[] = $row;
}
$show_recipe = false;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $recipe_query = "SELECT title,description,time,date_add,alias 
FROM recipe 
LEFT JOIN user ON recipe.user_id=user.id
WHERE recipe.id=$id";
    $recipe_statement = $connection->query($recipe_query);
    $recipe = $recipe_statement->fetch(PDO::FETCH_ASSOC);
    // var_dump($recipe);

    $ingridients_query = "SELECT name,quantity 
FROM recipe_ingridient 
LEFT JOIN ingridient ON recipe_ingridient.ingridient_id=ingridient.id 
WHERE recipe_id=$id";
    $ingridients_statement = $connection->query($ingridients_query);

    while ($ingridient = $ingridients_statement->fetch(PDO::FETCH_ASSOC)) {
        $ingridients[] = $ingridient;
    }
    // var_dump($ingridients);

    $propertys_query = "SELECT name 
FROM recipe_property 
LEFT JOIN property ON recipe_property.property_id=property.id 
WHERE recipe_id=$id";
    $propertys_statement = $connection->query($propertys_query);

    while ($property = $propertys_statement->fetch(PDO::FETCH_NUM)) {
        $propertys[] = $property;
    }
    // var_dump($propertys);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recipes</title>
</head>

<body>
    <?php  if(isset($_SESSION["user_name"])){
        echo "<p>Hello, ".$_SESSION["user_name"]."</p>";
        echo "<a href='add.php'>Add new</a>";
    } else{
    ?>
    <form action="user_auth.php" method="post">
        <label for="">
            <p>Email :</p>
            <input type="text" name="email">
        </label>
        <label for="">
            <p>Password :</p>
            <input type="text" name="password">
        </label>
        <p><input type="submit"></p>
    </form>
    <?php }?>
    <div class="wrapper">
        <div class="catalog">
            <div>
                <h1>Каталог рецептів</h1>
            </div>
            <?php foreach ($rows as $row) {
                $row_arr = get_object_vars($row);
            ?>
                <div>
                    <h2><?= $row_arr['title'] ?></h2>
                </div>
                <div>
                    <button><a href="?id=<?= $row_arr['id'] ?>">Дивитись рецепт</a></button>
                </div>
            <?php } ?>
        </div>
        <div class="recipe">
            <h2><?= $recipe['title'] ?></h2>
            <p><?= "Час приготування : " . $recipe['time'] . " хв" ?></p>
            <ul>
                <?php foreach ($ingridients as $ingridient) { ?>
                    <li><?= $ingridient['name'] . " " . $ingridient['quantity'] ?></li>
                <?php } ?>
            </ul>
            <p class="recipe_description"><?= $recipe['description'] ?></p>
            <div class="signature">
                <div>
                    <?php if (isset($propertys) && !empty($propertys)) {
                        foreach ($propertys as $property) {
                            foreach ($property as $item) { ?>
                                <p><?= $item ?></p>
                    <?php }
                        }
                    } ?>
                </div>
                <div>
                    <p><?= $recipe['alias'] ?></p>
                    <p><?= $recipe['date_add'] ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
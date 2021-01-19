<?php 
    require "connection.php";
    $email=$_POST["email"];
    $password=$_POST["password"];
    $query = "SELECT id, name FROM user WHERE email='$email' && password='$password'";
    $statement = $connection->query($query);

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if(!empty($user)){
        session_start();
        $_SESSION['user_id'] = $user["id"];
        $_SESSION['user_name'] = $user["name"];
    }
    // header("Location:index.php");
?>
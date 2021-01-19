<?php

require "connection.php";

class User
{
    private $id;
    private $name;
    private $alias;
    private $password;
    private $email;
    // з'єднання з базою даних
    private $connection;
    // колонка за якою здійснюється пошук в БД
    // (id або email)
    private $user_search_column;

    // конструктор методу
    // в нього передаємо з'єднання і (id або email)
    public function __construct($connection, $user_search_column)
    {
        $this->connection = $connection;
        $this->user_search_column = $user_search_column;
    }

    function __set($property, $value) { 
        $this->property = $value;
    }

    // функція присвоює властивостям методу значення
    // отримані з БД
    public function setUserProperty(){
        // якщо user_search_column число, тоді пошук користувача
        // здійснюємо по id
        if(gettype($this->user_search_column)=="integer"){
            $query = "SELECT * FROM user WHERE id=$this->user_search_column";
        // якщо user_search_column строка, то здійснюємо пошук по електронній адресі
        } else if(gettype($this->user_search_column)=="string"){
            $query = "SELECT * FROM user WHERE email=$this->user_search_column";
        }
        // передаємо запит в БД і отримуємо дані про знайденого користувача
        $us = $this->connection->query($query);
        $rows = $us->fetchAll(PDO::FETCH_ASSOC);
        // присвоюємо кожній властивості значення (магічний метод __set)
        foreach($rows as $row){
            foreach($row as $property=>$value){
                $this->$property = $value;
            }
        }   
    }
}
$u = new User($connection,2);
$u->setUserProperty();
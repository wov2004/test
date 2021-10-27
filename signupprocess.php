<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include 'db.php';
if(!empty($_POST)){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $flag = $_POST['flag'];

    //Подключение к БД
    $link = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
    if($link->connect_errno){
        echo "Ошибка при подключении к БД: $link->connect_error";
        exit();
    }
    //Проверяеем уникальность логина и email
    /*$query = "SELECT * FROM `users` WHERE `login`='$login' OR `email`='$email'";
    $result = $link->query($query);
    if($result->num_rows > 0){
        header("Location: /signup.php?error=Пользователь с таким логином или email уже существует");
        exit();
    }*/

    //sql-запрос
    $password = md5($password);
    $query = "INSERT INTO `users` (`firstname`,`lastname`,`middlename`,`login`,`email`,`password`) 
    VALUES ('$firstname','$lastname', '$middlename', '$login','$email','$password')";
    //echo $query;
    $link->query($query);
    $link->close();
    header("Location: /index.php");
}

?>
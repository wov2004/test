<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include 'db.php';
if(!empty($_POST)){
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    //Подключение к БД
    $link = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
    if($link->connect_errno){
        echo "Ошибка при подключении к БД: $link->connect_error";
        exit();
    }
    //Проверяеем уникальность логина и email
    $query = "SELECT * FROM `users` WHERE (`login`='$login' OR `email`='$login') AND `password`='$password'";
    $result = $link->query($query);
    if($result->num_rows == 0){
        header("Location: /signin.php?error=Неправильные логин или пароль");
        exit();
    }
    $row = $result->fetch_assoc();
    $userId = $row['id'];
    $firstName = $row['firstname'];
    $login = $row['login'];
    $_SESSION['userId'] = $userId;
    $_SESSION['user'] = $firstName;
    $_SESSION['login'] = $login;
    $link->close();
    if($login == 'admin' ){
    header("Location: /admin.php");}
    else{
        header("Location: /lk.php");
    };
}
?>
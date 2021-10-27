<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include 'db.php';
if(!empty($_POST)){
    $category = $_POST['category'];

    //Подключение к БД
 
/// Проверить уникальность категории - ДЗ

$query = "SELECT * FROM `categories` WHERE `name` = '$category'";
$result = $link->query($query);
if($result->num_rows == 0)
 {
$query = "INSERT INTO `categories` (`name`) VALUES ('$category')";
$link->query($query);
$link->close();
 header("Location: /admin.php");
}
 else {
    header("Location: /admin.php?error=Категоря с таким названием уже существует");
}
} 
?>
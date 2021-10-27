<?php
include 'db.php';
if(empty($_GET))
  exit();
    $id = $_GET['id'];
/*     echo $id; */
   //Подключение к БД

//Запрос на удаление всех заказов этой категории
$query = "DELETE FROM `orders` WHERE `categoryid` = $id";
//Запрос на удаление категории
$query = "DELETE FROM `categories` WHERE `id` = $id";
/* echo $query; */
$link->query($query);
header("Location: /admin.php");

?>
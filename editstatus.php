<?php
session_start(); 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$id = $_POST['id'];

$status = $_POST['status'];



include 'db.php';
//Подключение к БД
$link = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if($link->connect_errno){
    echo "Ошибка при подключении к БД: $link->connect_error";
    exit();
}
$query = "UPDATE `orders` SET `status` = $status WHERE `id` = $id";
$result = $link->query($query) or die($link->error);
/* $row = $result->fetch_assoc(); */
header("Location: admin.php");
?>
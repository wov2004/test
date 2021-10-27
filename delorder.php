<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

include 'db.php';

if(empty($_GET['id']))

{

    header("Location: /lk.php");

    exit();

}

$userId = $_SESSION['userId'];

//Подключение к БД

$link = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if($link->connect_errno){

    echo "Ошибка при подключении к БД: $link->connect_error";

    exit();

}

$id = $_GET['id'];
//Удаление фотографии заказа
$dquery = "SELECT photo FROM `orders` WHERE `id`= $id";
echo $dquery;
/* $link->query($dquery); */
$dresult = $link->query($dquery) or die($link->error);
$drow = $dresult->fetch_assoc();
$dphoto = $drow['photo'];
echo $dphoto;
/* $path = '.'; */

if(!unlink($dphoto)){
    echo "Delete error";
};

//Удаление заказа из БД
$query = "DELETE FROM `orders` WHERE `id`=$id AND `userId` = $userId";
$link->query($query);
header("Location: /lk.php");

?>
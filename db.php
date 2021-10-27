<?php
$dbhost = 'localhost';
$dbname = 'tvoizadcom_php';
$dbuser = 'tvoizadcom_php';
$dbpassword = '@!123-qweghjLVY';

$link = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if ($link->connect_errno) {
    echo "Ошибка при подключении к БД: $link->connect_error";
    exit();
}
?>
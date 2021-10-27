<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include 'db.php';
if(!empty($_POST)){
    $login = $_POST['login'];
    $email = $_POST['email'];
    //Подключение к БД
 
    //Проверяеем уникальность логина и email
    $query = "SELECT * FROM `users` WHERE (`login`='$login' OR `email`='$email')";
    $result = $link->query($query);
    if($result->num_rows !== 0){
       $message = "Пользователь с такими логином или емейл уже существует";
      $response = ['status' => 'error', 'message' => $message];
    }  
      else{
        $response = ['status' => 'ok'];        
      }      
      echo json_encode($response);
}
    
?>
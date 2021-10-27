<?php
session_start(); 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design.Pro</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="logo"><a href="index.php"><img src="img/люди/industrial_worker_PNG11452.png" alt="логотип"></a>
        </div>
        <h2>Design.Pro</h2>
    </header>
    <?php
        include "template/nav.php";
        nav(0);
        ?>
    <main>
    <?php 
    include 'db.php';
 //Подключение к БД
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 $link = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
 if($link->connect_errno){
     echo "Ошибка при подключении к БД: $link->connect_error";
     exit();
 }
 $query = "SELECT o.id, o.title, o.photo, o.datetime, c.name, o.status  FROM `orders` o INNER JOIN `categories` c ON o.categoryId = c.id WHERE `status` = 2 ORDER BY o.datetime DESC LIMIT 4";
 $result = $link->query($query);
 $i = 1;
  while($row = $result->fetch_assoc())
 {  $title = $row['title'];    
     $category = $row['name'];    
     $datetime = $row['datetime'];
     $photo = $row['photo'];
     $status = $row['status'];
     if ($status == 2){
     $status = "Завершено"; }
     echo <<<END
     <div class='order'>
            <h3>$title</h3>
            <p class='status'>$status</p>
            <img src='$photo' alt='$title'>
        <div>
            <p>$datetime</p>
            <p class='cat'>$category</p>
        </div> 
     </div>
     END;
     $i++;
 }

?>
</main>
<?php

include 'footer.php';
?>
</body>

</html>
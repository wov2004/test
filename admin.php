<?php
session_start(); 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
if($_SESSION['login']!='admin')
    header("Location: /index.php");
?>

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
        <?php
        include "template/nav.php";
        nav(1);
        ?>
    <h2>Заявки</h2>
    <table>
        <tr>
            <th>№</th>
            <th>Дата</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Категория</th>
            <th>Статус</th>
        </tr>
        <?php
        include 'db.php';
        //Подключение к БД
      
        $query = "SELECT o.id, o.title, o.description, c.name, o.datetime, o.status 
        FROM `orders` o INNER JOIN `categories` c ON o.categoryId = c.id
        ORDER BY o.datetime DESC";
     
        $result = $link->query($query) or die($link->error);
        $i = 1;
        while($row = $result->fetch_assoc())
        {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $category = $row['name'];
            $status = $row['status'];
            if($status ==0){
                $status = "Новая";
            }
            if($status ==1){
                $status = "Принято в работу";
            }
            if($status ==2){
                $status = "Выполнено";
            }
            $datetime = $row['datetime'];
            echo "<tr><td>$i</td><td>$datetime</td><td>
            <a href='editorder.php?id=$id'>$title
            </td><td>$description</td>
            <td>$category</td><td>$status</td></tr>";
            $i++;
        }
        ?>
    </table>
    <h2>Категории заявок</h2>
    <table>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th></th>
        </tr>
        <?php
        include 'db.php';
        
        //Подключение к БД
      
        //Запрос
        $query = "SELECT * FROM `categories` ORDER BY `name`";
        $result = $link->query($query);
        $i = 1;
        while($row = $result->fetch_assoc())
        {
            $id = $row['id'];
            $cat = $row['name'];
            echo "<tr><td>$i</td><td>$cat</td><td><a href='delcategory.php?id=$id'>Удалить</a></td></tr>";
            $i++;
        }
        ?>
    </table>
    <form action="addcategory.php" method="POST">
        <input type="text" placeholder="Название категории" name="category">
        <button>Добавить</button>
    </form>
</body>
</html>
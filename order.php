<?php
session_start();
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
nav(2);
?>
 <h2>Новая заявка</h2>
 <div class="neworder">
 <form action="addorder.php" method="POST" enctype="multipart/form-data">
 <input type="text" placeholder="Название" name="title">
 <textarea placeholder="Описание" name="description"></textarea>
 <select name="category" placeholder="Выбрать">
     
 <?php
include 'db.php';

$query = "SELECT * FROM categories";
$result = $link->query($query);
while ($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $name = $row["name"];
    echo "<option value='$id'>$name</option>";
}
$link->close();
?>
 </select>
 <input type="file" placeholder="Выбрать изображение" name="photo">
 <input type="submit" value="Отправить">
 <?php
if (!empty($_GET)) {
    $error = $_GET['error'];
    echo "<p class='error'>$error</p>";
}
?>
 </form>
 </div>
</body>
</html>
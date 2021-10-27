<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
if (empty($_SESSION['login'])) {
    header('Location: /index.php');
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design.Pro</title>
    <link rel="stylesheet" href="css/style.css">
    <script defer>
    function confirmRemove(event) {
  if (!confirm("Вы действительно хотите удалить заявку?")) {
    event.preventDefault();
  }}
</script> 
</head>
<body>
            <?php
            include "template/nav.php";
            nav(2);
            $user = $_SESSION['user'];
            echo "<h2>Привет, $user!</h2>";

            ?>
    <h2>Мои заявки</h2>
    <form action="lk.php" method="POST">
<label><input type="radio" name="status" value="0" <?php if (isset($_POST["status"]) && $_POST["status"] == 0) {  echo "checked"; } ?>>Новая</label>
<label ><input type="radio" name="status" value="1" <?php if (isset($_POST["status"]) && $_POST["status"] == 1) { echo "checked"; } ?> >Принято в работу</label>
<label ><input type="radio" name="status" value="2"  <?php if (isset($_POST["status"]) && $_POST["status"] == 2) { echo "checked"; } ?> >Выполнено</label>
<label ><input type="radio" name="status" value="3"  <?php if (isset($_POST["status"]) && $_POST["status"] == "Все заявки") { echo "checked"; } ?> >Все заявки</label>
    <button>Посмотреть</button> 
    </form>

    <table>
        <tr>
            <th>№</th>
            <th>Дата</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Категория</th>
            <th>Статус</th>
            <th>Удаление</th>
           
        </tr>
        <?php
include 'db.php';
//Подключение к БД
   $userId = $_SESSION['userId'];
        if(!isset($_POST["status"]) || $_POST["status"] == 3)
        {
           // $status = "Все";
            $query = "SELECT o.userid, o.id, o.title, o.description, c.name, o.datetime, o.status 
            FROM `orders` o INNER JOIN `categories` c ON o.categoryId = c.id
            WHERE `userId`=$userId ORDER BY o.datetime DESC";
        }
        else
        {
            $status = $_POST["status"];
            $query = "SELECT o.userid, o.id, o.title, o.description, c.name, o.datetime, o.status 
            FROM `orders` o INNER JOIN `categories` c ON o.categoryId = c.id
            WHERE `userId`=$userId AND `status`= $status ORDER BY o.datetime DESC";
        };
$result = $link->query($query) or die($link->error); 
$i = 1;
while ($row = $result->fetch_assoc())
{
     $id = $row['id'];
    $order = $i;
    $datetime = $row['datetime'];
    $title = $row['title'];
    $description = $row['description'];
    $category = $row['name'];
    $status = $row['status'];
    if ($status == 0) {
        $statusname = 'Новая';       
    };
    if ($status == 1) {
        $statusname = 'Принято в работу';
    };
    if ($status == 2) {
        $statusname = 'Завершена';
    };      
    if ($status == 0) {
               $del = "<a href='delorder.php?id=$id' onclick='confirmRemove(event);'>Удалить</a>"; }
               else { $del = "*";};
               
               echo "<tr> <td>$i</td> <td>$datetime</td> <td>$title</td> <td>$description</td> <td>$category</td> <td>$statusname</td> <td>$del</td> </tr>";
    $i++;   
  
};
?>

</table>

<a href="/order.php" class="order_link">Добавить заявку</a>
<?php
include 'footer.php';
?>
</body>
</html>  
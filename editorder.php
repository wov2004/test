<?php
session_start(); 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

{
if($_SESSION['login']!='admin')
    header("Location: /index.php");}
if(empty($_GET)){
header("Location: admin.php");
exit();}
$id = $_GET["id"];
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
            include 'db.php';
           
        $query = "SELECT o.id, o.title, o.description, c.name, o.photo, o.datetime, o.status 
        FROM `orders` o INNER JOIN `categories` c ON o.categoryid = c.id WHERE o.id = $id 
        ORDER BY o.datetime DESC";
                $result = $link->query($query) or die ($link->error);
                $row = $result->fetch_assoc();                
                $id = $row["id"];
                    $title = $row["title"];
                    $description = $row["description"];
                    $category = $row["name"];
                    $status = $row["status"];
                    $datetime = $row["datetime"];
                    $category =  $row["name"];
                    $photo = $row["photo"];

            echo "<div id='order'>
            <h2>$title</h2>
            <p>$category</p>
            <p>$datetime</p>
            <p>$description</p>
            <img src='$photo' alt='$title'>
            <p>$status</p>
            </div>";
            ?>

            <form action="editstatus.php" method="POST">
                <input type="hidden" name ="id" value=" <?php echo $id; ?> ">
                <select name="status" >
<option value="1">Принято в работу</option>
<option value="2">Выполнено</option>

                </select><button>Изменить статус</button>
            </form>
</body>
</html>
 <?php
//запуск сессии
session_start();
//Вывод ошибок
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//проверка сессии
if (empty($_SESSION['login'])) {
    header("Location: /index.php");
    exit();
}
//Проверка содержимого формы
if (!empty($_POST)) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $userid = $_SESSION['userId'];
    //Загрузка файлов на сервер
    //проверка формата файла
    if ($_FILES["photo"]["type"] != "image/jpg" && $_FILES["photo"]["type"] != "image/jpeg" && $_FILES["photo"]["type"] != "image/png" && $_FILES["photo"]["type"] != "image/bmp") {
        header("Location: /order.php?error=Не верный формат файла, используйте файлы формата *.jpg, *.jpeg, *.png");
        exit();
    }

    //Проверка размера файла $_FILES["photo"]["size"] - размер в байтах;
    $KB = 1024;
    $MB = 1048576;

    if ($_FILES["photo"]["size"] > 2 * $MB) {
        header("Location: /order.php?error=Размер файла превышает 2 МБ, используйте файл меньшего объема");
        exit();
    }

    if ($_FILES["photo"]["size"] < 1 * $KB) {
        header("Location: /order.php?error=Размер файла менее 10 КБ, используйте файл большего объема");
        exit();
    }

    $uploaddir = "files/";   
     $filename = $_FILES["photo"]["name"];
    $uloadfile = $uploaddir.date('j-m-y_h-i-s_').md5(microtime()).strrchr($filename, '.');

    
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $uloadfile)) {include 'db.php';
        //Подключение к БД
      

        $query = "INSERT INTO `orders` (`title`,`description`, `photo`,`categoryid`, `userid`, `status`) VALUES ('$title', '$description','$uloadfile', $category, $userid, 0)";
        $link->query($query);
        header("Location: /lk.php");
    } else {
        header("Location: /order.php?error=Произошла ошибка при загрузке файла");
        exit();
    } 
}
?>
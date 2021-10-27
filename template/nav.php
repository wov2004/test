<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
function nav($item)
{
    if(empty($_SESSION['login']))
    {
        $items = [
            "index.php" => "Главная",
            "signin.php" => "Вход",
            "signup.php" => "Регистрация",
        ];
    }
    elseif($_SESSION['login'] == 'admin'){
        $items = [
            "index.php" => "Главная",
            "admin.php" => "Администрирование",
            "logout.php" => "Выход"
        ];
    }
    else{
        $items = [
            "index.php" => "Главная",
            "lk.php" => "Личный кабинет",
            "logout.php" => "Выход"
        ];
    }
    $i = 0;
    echo "<nav>";
    foreach($items as $key => $value)
    {
        if($i == $item)
            echo "<a href='$key' class='active'>$value</a>";
        else
            echo "<a href='$key'>$value</a>";
        $i++;
    }
    echo "</nav>";
}

?>
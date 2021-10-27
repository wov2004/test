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
        nav(3);
        ?>
    <div class="signin">
        <form action="signinprocess.php" method="POST">
            <input type="text" placeholder="Логин или email" name="login">
            <input type="password" placeholder="Пароль" name="password">
            <input type="submit" value="Войти">
            <a href="signup.php">Регистрация</a>
            <p id="error"></p>
            <?php
                if(isset($_GET['error']))
                {
                    $error = $_GET['error'];
                    echo "<p class='error'>$error</p>";
                }
            ?>
        </form>
    </div>
</body>
</html>
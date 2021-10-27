<?php
session_start(); 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design.Pro</title>
    <link rel="stylesheet" href="css/style.css">
 <script src="js/main.js" defer></script>
</head>
<body>
<?php
        include "template/nav.php";
        nav(4);
        ?>
    <div class="signup">
        <form action="signupprocess.php" method="POST" id="signupForm">
            <input type="text" placeholder="Фамилия" name='lastname' pattern="^[А-Яа-яЁё]+$" required id="lastname">
            <input type="text" placeholder="Имя" name='firstname' pattern="^[А-Яа-яЁё]+$" required>
            <input type="text" placeholder="Отчество" name='middlename' pattern="^[А-Яа-яЁё]+$" required>
            <input type="text" placeholder="Логин" name='login' pattern="^[A-Za-z0-9]+$" id="login" required>
            <input type="email" placeholder="email" name='email' id="email" required>
            <input type="password" placeholder="Пароль" name='password' id="password" required pattern="^[A-Za-z0-9]+$">
            <input type="password" placeholder="Повтор пароля" name='repassword' id="repassword" required pattern="^[A-Za-z0-9]+$">
            <label><input type="checkbox" name='flag' id="flag">Согласие на обработку персональных данных</label>
            <input type="submit" value="Зарегистрироваться">
            <p id="error">
            <?php
                if(isset($_GET['error']))
                {
                    $error = $_GET['error'];
                    echo "<p class='error'>$error</p>";
                }
            ?></p>
        </form>
    </div>
    <script>
        function test(event) {
  this.classList.add('error');
  event.preventDefault();
}
    </script>
</body>
</html>
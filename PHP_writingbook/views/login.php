<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AUTORIZATION</title>
</head>
<body>
    <?php
        require_once '../controller.php';
        use CONTROLLER\Login;

        session_start();

        $a = new Login();
        $a->login();
        $login = $a->get_login();      
     ?>
    <h1>Авторизация</h1>
    <form action="view.php" enctype='multipart/form-data' method="POST">
        <label for="login">Логин</label>
        <input type="text" name="login" id="login" placeholder="login" value=<?=$login?>>
        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" placeholder="password">
        <input type="submit">
    </form>
    <br>
    <a href="registration.php">Регистрация</a>
</body>
</html>
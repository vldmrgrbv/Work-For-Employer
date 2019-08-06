<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA_ADMIN</title>
</head>
<body>
    <table border="1">
    <tr >
        <td ></td>
        <td>Клиент</td>
        <td>Баланс</td>
    </tr>
    <?php
        require_once '../controller.php';
        require_once '../model.php';
        use CONTROLLER\Data_Admin;
        $a = new Data_Admin();
        $a->check();
        $i = 1;        
        foreach($users as $key=>$value)
            if($users["$key"]["admin"] != true) {
            ?>
            <tr>
                <td><?=$i?></td>
                <td><?=$key?></td>
                <td><?=$users["$key"]["balance"]?></td>
            </tr>
            <?php $i++;};?>
    </table>
    <a href="view.php">Назад</a>
    <a href="edit_admin.php">Изменить</a>
</body>
</html>

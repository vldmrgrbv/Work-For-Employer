<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDIT_ADMIN</title>
</head>
<body>
    <form action="data_admin.php" enctype='multipart/form-data' method="POST">
        <?php
            require_once "../model.php";
            $i = 1;
            foreach($users as $key=>$value)
                if($users[$key]["admin"] == false) {?>
                <input type="text" name='name_<?=$i?>' value="<?=$key?>" placeholder="name">
                <input type="text" name='balance_<?=$i?>' value="<?=$users["$key"]["balance"]?>" placeholder="balance"><br><br>
                <?php $i++;}; ?>
        <input type="submit" value="Готово">
    </form>
    <br><a href="view.php">Назад</a>
</body>
</html>

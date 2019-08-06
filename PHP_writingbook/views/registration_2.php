<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Success</title>
</head>
<body>
	<?php
		require_once '../controller.php';

    use CONTROLLER\Registration;
    use CONTROLLER\DataCheck;

    session_start();

    $a = new Registration();
    $result = $a->data_checking();

    if($result != '') {
    	$array_data = $a->get_data();
  ?>

  <h1>Ошибка!</h1><br>
  <p><?="$result"?></p><br>
	<a href="registration.php?f_name=<?=$array_data[0]?>&s_name=<?=$array_data[1]?>&login=<?=$array_data[2]?>&e_mail=<?=$array_data[3]?>'"><---Назад</a>

	<?php

    } else {
	    $data_transfer = $a->data_transfer();
	    if($data_transfer) {
    	$fst_name = $a->get_name();

  ?>

	<h1><?="$fst_name"?>, Вы успешно зарегистрировались!</h1>
	<p>Авторизуйтесь, чтобы войти в свою учётную запись.</p>
	<a href="login.php">Авторизация</a>

	<?php

		} else {

	?>

	<h1>Ошибка!</h1>
	<a href="registration.php"><---Назад</a>

	<?php

		}
	}

	?>

</body>
</html>
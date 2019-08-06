<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../css/style.css">
	<meta charset="UTF-8">
	<title>RECORDS</title>
</head>
<body>

	<?php

		session_start();
		
		require_once '../controller.php';
    use CONTROLLER\Records;

   	$a = new Records();

   	if (isset($_POST['title'])) $a->add();

    $a->deleteData();

    $a->updateData();

   	$a->selectData();


	?>

	<form action="records.php" method="POST">
		<h2>Заголовок</h2>
		<input type="text" name="title" size="80" required><br>
		<h2>Текст</h2>
		<textarea name="main_text" id="main_text" cols="60" rows="10"></textarea><br>
		<input type="submit" value="Записать">
	</form>

	<a href="view.php">Главная</a>

</body>
</html>
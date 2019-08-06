<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>UPDATE_RECORD</title>
</head>
<body>

	<?php

		session_start();
		
		require_once '../controller.php';
    use CONTROLLER\Records;

   	$a = new Records();

   	$id_upd = $_GET['id_upd'];

   	$rec = $a->selectRecord($id_upd);

	?>

	<h1>Изменение записи</h1>
	<form action="records.php?id_upd=<?=$id_upd?>" method="POST">
		<h2>Заголовок</h2>
		<input type="text" name="title" size="80" value="<?=$rec[1]?>" required><br>
		<h2>Текст</h2>
		<textarea name="main_text" id="main_text" cols="60" rows="10"><?=$rec[2]?></textarea><br>
		<input type="submit" value="Записать">
	</form>

</body>
</html>
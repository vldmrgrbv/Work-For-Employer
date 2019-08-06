<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="../css/style.css">
	<meta charset="UTF-8">
	<title>REGISTRATION</title>
</head>
<body>
	<div class="block_reg">
	<?php

		if (isset($_GET['f_name'])) {
  ?>  
    <form action="registration_2.php" method="POST" class="block_reg__form">
			
			<label for="first_name">Имя</label>
			<input type="text" id="first_name" name="first_name" placeholder="Имя" value="<?=$_GET['f_name']?>" required>
			
			<label for="second_name">Фамилия</label>
			<input type="text" id="second_name" name="second_name" placeholder="Фамилия" value="<?=$_GET['s_name']?>"  required>
			
			<label for="login">Логин</label>
			<input type="text" id="login" name="login" placeholder="Логин" value="<?=$_GET['login']?>" required>
			
			<label for="password">Пароль</label>
			<input type="password" id="password" name="password" placeholder="Пароль" required>
	    
	    <label for="password_rep">Повторите пароль</label>
	    <input type="password" id="password_rep" name="password_rep" placeholder="Повторите пароль" required>
	   
	    <label for="e_mail">Ваш e-mail</label>
	    <input type="email" id="e_mail" name="e_mail" placeholder="e-mail" value="<?=$_GET['e_mail']?>" required>
			
			<input type="submit" value="Зарегистрироваться">
    
    </form> 
  <?php 

    } else {

  ?> 
  	<form action="registration_2.php" method="POST" class="block_reg__form">
			
			<label for="first_name">Имя</label>
			<input type="text" id="first_name" name="first_name" placeholder="Имя" required>
			
			<label for="second_name">Фамилия</label>
			<input type="text" id="second_name" name="second_name" placeholder="Фамилия"  required>
			
			<label for="login">Логин</label>
			<input type="text" id="login" name="login" placeholder="Логин" required>
			
			<label for="password">Пароль</label>
			<input type="password" id="password" name="password" placeholder="Пароль" required>
	    
	    <label for="password_rep">Повторите пароль</label>
	    <input type="password" id="password_rep" name="password_rep" placeholder="Повторите пароль" required>
	   
	    <label for="e_mail">Ваш e-mail</label>
	    <input type="email" id="e_mail" name="e_mail" placeholder="e-mail" required>
			
			<input type="submit" value="Зарегистрироваться">
    
    </form>

  <?php  	

    }

	?>

    <a href="login.php">Авторизация</a>

	</div>
	
</body>
</html>
<!-- <input type="password" id="password" placeholder="Пароль"  pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*" required> -->
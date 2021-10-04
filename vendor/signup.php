<?php
	session_start();
	require_once("connection.php");
	
	$email = $_POST['signupEmail'];
	$password = $_POST['signupPassword'];
	$passwordConfirm = $_POST['signupPasswordConfirm'];
	$surname = $_POST['signupSurname'];
	$name = $_POST['signupName'];
	$patronymic = $_POST['signupPatronymic'];
	$phone = $_POST['signupPhone'];
	if($password != $passwordConfirm){
		$_SESSION['errorSignUp'] = 'Ошибка! Пароли не совпадают.';
		header("Location: index.php");
	}
	if(empty($email) && empty($password) && empty($passwordConfirm) && empty($surname) && empty($name) && empty($patronymic) && 		empty($phone)){
		$_SESSION['errorSignUp'] = "Ошибка! Заполните все поля.";
		header("Location: ../index.php");
	} else{
		$password = md5($password);
		mysqli_query($con, "INSERT INTO `users` (`user_id`, `email`, `password`, `surname`, `name`, `patronymic`, `phone`, `isAdmin`) VALUES (NULL, '$email', '$password', '$surname', '$name', '$patronymic', '$phone', 0)");
		$_SESSION['signupSuccess'] = "Регистрация прошла успешно! Выполните авторизацию";
		header("Location: ../index.php");
	}
	?>
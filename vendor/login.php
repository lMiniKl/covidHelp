<?php 
	session_start();
	require_once("connection.php");
	$email = $_POST['loginEmail'];
	$password = md5($_POST['loginPassword']);
	$check_user = mysqli_query($con,"SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
	if(mysqli_num_rows($check_user) > 0){
		$user = mysqli_fetch_assoc($check_user);
		$_SESSION['user'] = [
			'id' => $user['user_id'],
			'email' => $user['email'],
			'isAdmin' => $user['isAdmin']
		];
		header('Location: ../index.php');
	} else{
		$_SESSION['errorLogin'] = 'Ошибка! Неправильный логин или пароль';
		header('Location: ../index.php');
	}
	?>
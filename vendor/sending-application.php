<?php
	session_start();
	require_once("connection.php");
	$id = $_SESSION['user']['id']; //ID пользователя
	unset($_SESSION['user_id']); 

	$app_id = $_SESSION['app_id']; // ID заявки
	unset($_SESSION['app_id']);

	$surname = $_POST['sendAppSurname'];
	$name = $_POST['sendAppName'];
	$patronymic = $_POST['sendAppPatronymic'];
	$email = $_POST['sendAppEmail'];
	$phone = $_POST['sendAppPhone'];
	$today = date("Y-m-d"); // Системная дата

	if(empty($surname) || empty($name) || empty($patronymic) || empty($email) || empty($phone)){
		$_SESSION['sendAppError'] = "Ошибка! Заполните все поля.";
		header("Location: ../application/new-application.php?id=$app_id");
	} 
	else{
		if(is_null($id)){
			mysqli_query($con,
			"INSERT INTO `sendofapplications` (`sendOfApplications_id`, `applications_id`, `user_id`, `dateSendingApplications`, `surname`, `name`, `patronymic`, `email`, `phone`, `dateConsedirationApplication`,`isChecked`, `isAccepted`, `comment`) VALUES (NULL, '$app_id', NULL, '$today', '$surname', '$name', '$patronymic', '$email', '$phone', NULL,NULL, NULL, NULL)") or die("ERROR");
		} else{
			mysqli_query($con,
			"INSERT INTO `sendofapplications` (`sendOfApplications_id`, `applications_id`, `user_id`, `dateSendingApplications`, `surname`, `name`, `patronymic`, `email`, `phone`, `dateConsedirationApplication`,`isChecked`, `isAccepted`, `comment`) VALUES (NULL, '$app_id', 
			$id, '$today', '$surname', '$name', '$patronymic', '$email', '$phone', NULL,NULL, NULL, NULL)") or die("ERROR");
		}
		$_SESSION['sendAppSuccess'] = "Заявка успешно отправлена! С вами свяжутся в течении суток с момента отправки заявки";
		header("Location: ../application/new-application.php?id=$app_id");
	}
	?>
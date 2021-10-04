<?php
	session_start();
	require_once("connection.php");
	
	$orgName = $_POST['orgName'];
	$orgCategory = $_POST['orgCategory'];
	$orgEmail = $_POST['orgEmail'];
	$orgPhone = $_POST['orgPhone'];
	$user_id = $_SESSION['user']['id'];
	$today = date("Y-m-d");
	
	if(empty($orgName) || empty($orgName) || empty($orgEmail) || empty($orgPhone)){
		$_SESSION['orgError'] = "Ошибка! Заполните все поля.";
		header("Location: ../organization/organization-create-page.php");
	} else{
		mysqli_query($con, "INSERT INTO `organization` (`organization_id`, `user_id`, `organization_name`, `category`, `email`, `phone`,`date_create`) VALUES (NULL, '$user_id', '$orgName', '$orgCategory', '$orgEmail', '$orgPhone', '$today');") or die("Ошибка запроса");
		$_SESSION['orgSuccess'] = "Организация успешно добавлена!";
		header("Location: ../organization/organization-create-page.php");
	}
	?>
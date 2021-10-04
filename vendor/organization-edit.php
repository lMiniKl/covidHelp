<?php
	session_start();
	require_once("connection.php");
	$id = $_SESSION['orgId'];
	unset($_SESSION['orgId']);
	$name = $_POST['orgName'];
	$category = $_POST['orgCategory'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	if(empty($name) || empty($category) || empty($email) || empty($phone)){
		$_SESSION['orgUpdError'] = "Ошибка! Заполните все поля.";
		header("Location: ../organization/organization-edit-page.php?id=$id");
	} else{
		mysqli_query($con, 
			"UPDATE `organization` SET `organization_name` = '$name', `category` = '$category', `email` = '$email', `phone` = '$phone' WHERE `organization`.`organization_id` = '$id'") or die("Ошибка запроса базы данных");
		$_SESSION['orgUpdSuccess'] = "Организация успешно отредактирована!";
		header("Location: ../organization/organization-edit-page.php?id=$id");
	}
	?>
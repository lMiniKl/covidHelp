<?php
	session_start();
	require_once("connection.php");
	$id = $_SESSION['appId'];
	unset($_SESSION['appId']);
	$title = $_POST['appTitle'];
	$section = $_POST['appSection'];
	$org = $_POST['orgName'];
	$query = mysqli_query($con, "SELECT *FROM organization WHERE organization_name = '$org'");
	$orgID = mysqli_fetch_array($query);
	$orgID = $orgID['organization_id'];

	if(empty($title) || empty($section) || empty($org)){
		$_SESSION['appUpdError'] = "Ошибка! Заполните все поля.";
		header("Location: ../application/application-edit.php?id=$id");
	} else{
		mysqli_query($con, 
			"UPDATE `applications` SET `section` = '$section', `organization_id` = '$orgID', `title` = '$title' WHERE `applications`.`applications_id` = '$id'") or die("Ошибка запроса к базе данных!");
		$_SESSION['appUpdSuccess'] = "заявка успешно отредактирована!";
		header("Location: ../application/application-edit.php?id=$id");
	}
	?>
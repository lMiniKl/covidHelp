<?php
	session_start();
	require_once("connection.php");
	
	$appTitle = $_POST['appTitle'];
	$appSection = $_POST['appSection'];
	$user_id = $_SESSION['user']['id'];
	$org = $_POST['orgName'];
	$query = mysqli_query($con, "SELECT *FROM organization WHERE organization_name = '$org'");
	$orgID = mysqli_fetch_array($query);
	$orgID = $orgID['organization_id'];
	
	if(empty($appTitle) || empty($appSection) || empty($org)){
		$_SESSION['appError'] = "Ошибка! Заполните все поля.";
		header("Location: ../application/application-create-page.php");
	} else{
		mysqli_query($con, "INSERT INTO `applications` (`applications_id`, `user_id`, `section`, `title`,`organization_id`) VALUES (NULL, '$user_id', '$appSection', '$appTitle','$orgID');") or die("Ошибка запроса");
		$_SESSION['appSuccess'] = "Заявка успешно создана!";
		header("Location: ../application/application-create-page.php");
	}
	?>
<?php
	session_start();
	require_once("connection.php");
	$id = $_GET['id'];
	$queryForCheck =  mysqli_query($con,"SELECT *FROM `articles` WHERE `articles`.`applications_id` = $id") or die('Query error');
	while($articles = mysqli_fetch_array($queryForCheck)){
		$_SESSION['appDeleteError'] = "Ошибка! Данная заявка привязана к статье.<br> Статья: ". $articles['title'];
		header("Location: ../application/application.php");
	}

	mysqli_query($con,"DELETE FROM `applications` WHERE `applications`.`applications_id` = $id") or die('Query error');
	$_SESSION['appDelete'] = "Заявка успешно удалена!";
	header("Location: ../application/application.php");
	?>
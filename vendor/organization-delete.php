<?php
	session_start();
	require_once("connection.php");
	$id = $_GET['id'];
	$queryForCheck =  mysqli_query($con,"SELECT *FROM `applications` WHERE `applications`.`organization_id` = $id") or die('Query error');
	while($app = mysqli_fetch_array($queryForCheck)){
		$_SESSION['orgDeleteError'] = "Ошибка! Данная организация привязана к форме заявки.<br> Статья: ". $app['title'];
		header("Location: ../organization/organization.php");
	}
	mysqli_query($con,"DELETE FROM `organization` WHERE `organization`.`organization_id` = $id") or die('Query error');
	$_SESSION['orgDelete'] = "Организация успешно удалена!";
	header("Location: ../organization/organization.php");
	?>
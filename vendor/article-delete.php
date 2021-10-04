<?php
	session_start();
	require_once("connection.php");
	$id = $_GET['id'];
	$section = $_GET['section'];

	if(strcmp($section, 'Новости') == 0){
		$section = "../section/news/news.php";
	} 
	if(strcmp($section, 'Защита и профилактика') == 0) {
		$section = '../section/protection-and-prevention/protection-and-prevention.php';
	} 
	if(strcmp($section, 'Государственная помощь') == 0){
		$section = '../section/state-support/state-support.php';
	} 
	if(strcmp($section, 'Волонтерская помощь') == 0){
		$section = '../section/volunteer-support/volunteer-support.php';
	} 
	if(strcmp($section, 'Полезные ссылки') == 0){
		$section = '../section/usefull-links/usefull-links.php';
	} 
	if(strcmp($section, 'Помощь (FAQ)') == 0){
		$section = '../section/faq/faq.php';
	}

	$queryForCheck =  mysqli_query($con,"SELECT *FROM `articles` WHERE `articles`.`applications_id` = $id") or die('Query error');
	
	mysqli_query($con,"DELETE FROM `articles` WHERE `articles`.`articles_id` = $id") or die('Query error');

	$_SESSION['articleDelete'] = "Статья успешно удалена!";
	header("Location: $section");
	?>
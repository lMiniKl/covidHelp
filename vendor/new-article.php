<?php
	session_start();
	require_once("connection.php");
	
	$articleSection = $_POST['articleSection'];
	$articleTitle = $_POST['articleTitle'];
	$articleContent = $_POST['articleContent'];
	$articleApps = $_POST['articleApps'];
	$articleSource = $_POST['articleSource'];
	$today = date("Y-m-d");
	$user_id = $_SESSION['user']['id'];
	if($articleApps == 'Нет'){
		$articleApps = 1;
	} else{
		$result = mysqli_query($con,"SELECT *from applications WHERE title = '$articleApps'");
		$articleApps = mysqli_fetch_array($result);
		$articleApps = $articleApps['applications_id'];
	}

	if($articleSection != 'Государственная помощь' && $articleSection != 'Волонтерская помощь' && $articleApps != 1){
		$_SESSION['articleError'] = 'Ошибка! Заявку можно прикрепить только к статьям из разделов "Государственная помощь" и "Волонтерская помощь"';
		header("Location: ../admin/article-create.php");

	}
	if(empty($articleSection) || empty($articleTitle) || empty($articleContent || empty($articleSource))){
		$_SESSION['articleError'] = "Ошибка! Заполните все поля.";
		header("Location: ../admin/article-create.php");
	} else{
		mysqli_query($con, "INSERT INTO `articles` (`articles_id`, `user_id`, `section`, `title`, `content`,`date_of_publication`, `source`, `applications_id`) VALUES (NULL, '$user_id', '$articleSection', '$articleTitle', '$articleContent','$today','$articleSource','$articleApps')") or die('Ошибка запроса');
		$_SESSION['articleSuccess'] = "Статься успешно создана!";
		header("Location: ../admin/article-create.php");
	}
	?>
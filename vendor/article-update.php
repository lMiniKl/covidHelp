<?php
	session_start();
	require_once("connection.php");
	$articles_id = $_SESSION['article_id'];
	unset($_SESSION['article_id']);
	$articleSection = $_POST['articleSection'];
	$articleTitle = $_POST['articleTitle'];
	$articleContent = $_POST['articleContent'];
	$articleApps = $_POST['articleApps'];
	$articleSource = $_POST['articleSource'];
	$result = mysqli_query($con,"SELECT *from applications where title = '$articleApps'");
	$articleApps_id = mysqli_fetch_array($result);
	$articleApps_id = $articleApps_id['applications_id'];

	if($articleApps == 'Нет'){
		$articleApps = 'NULL';
	}

	if(empty($articleSection) || empty($articleTitle) || empty($articleContent)){
		$_SESSION['articleError'] = "Ошибка! Заполните все поля.";
		header("Location: article-edit.php?id=$articles_id");
	} else{
		mysqli_query($con, 
			"UPDATE `articles` SET `section` = '$articleSection', `title` = '$articleTitle', `content` = '$articleContent', `applications_id` = '$articleApps_id', `source` = '$articleSource'  WHERE `articles`.`articles_id` = '$articles_id'") or die("ERROR");
		$_SESSION['articleSuccess'] = "Статья успешно отредактирована!";
		header("Location: ../admin/article-edit.php?id=$articles_id");
	}
	?>
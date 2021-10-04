<?php 
	session_start();
	$dir = $_SERVER['DOCUMENT_ROOT'];
	require_once($dir.'/vendor/connection.php');
	$article_id = $_GET['id'];
	$result = mysqli_query($con,"SELECT *FROM articles where articles_id = '$article_id'");
	$articles = mysqli_fetch_array($result);
	$appId = $articles['applications_id'];

	if(strcmp($articles['section'], 'Новости') == 0){
		$section = "/section/news/news.php";
	} 
	if(strcmp($articles['section'], 'Защита и профилактика') == 0) {
		$section = '/section/protection-and-prevention/protection-and-prevention.php';
	} 
	if(strcmp($articles['section'], 'Государственная помощь') == 0){
		$section = '/section/state-support/state-support.php';
	} 
	if(strcmp($articles['section'], 'Волонтерская помощь') == 0){
		$section = '/section/volunteer-support/volunteer-support.php';
	} 
	if(strcmp($articles['section'], 'Полезные ссылки') == 0){
		$section = '/section/usefull-links/usefull-links.php';
	} 
	if(strcmp($articles['section'], 'Помощь (FAQ)') == 0){
		$section = '/section/faq/faq.php';
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Портал социальной помощи пострадавшим от короновируса</title>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>  
</head>
<body>
	<script>
		document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + 
		':35729/livereload.js?snipver=1"></' + 'script>')
	</script>
	<?php include("../blocks/haeder.php");?>
	<br>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/index.php">Главная</a></li>
		<li class="breadcrumb-item"><a href="<?php echo $section?>"> <?php echo $articles['section']?></a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php echo $articles['title']?></li>
	</ol>
	<br><br>
	<div class="Content">
		<div class="article col-md-12" style="padding: 20px;">
			<?php
				echo'
				<div class="float-right">
					<p>'.$articles['date_of_publication'].'</p>
				</div>
				<h2>'. $articles["title"] .'</h2>
				<br>
				<p>
					'. $articles['content']. ' 
				</p>';
				if ($articles['section']!= 'Помощь (FAQ)') {
					echo '<a href="https://'.$articles['source'].'">Источник: '.$articles['source'].'</a>
					<br><br>';
				}
				if(isset($_SESSION['articleEditSuccess'])){
					echo '<label class="alert alert-success">'.$_SESSION['articleEditSuccess'].'</label><br>';
					unset($_SESSION['articleEditSuccess']);
				}
				if (isset($_SESSION['articleEditError'])) {
	    		 	echo '<label class="alert alert-danger">'.$_SESSION['articleEditError'].'</label><br>';
	    		 	unset($_SESSION['articleEditError']);
	    		 }
				if ($articles['applications_id'] != 1) {
					echo '
						<br>
						<label>Есть возможность подать заявку на данную услугу</label>
						<a href="/application/new-application.php?id='.$appId.'"class="btn btn-primary">Подать заявку</a>
					';
				}
				if ($_SESSION['user']['isAdmin']==1) {
					echo '<a href="/admin/article-edit.php?id='. $article_id . '" class="btn btn-primary">Редактировать</a> ';
					echo '<a href="/vendor/article-delete.php?id='. $article_id . '&section='.$articles['section'].'" class="btn btn-danger">Удалить</a>';
				}
				?>
		</div>
	</div>
</body>
</html>
<?php 
	session_start();
	require_once("connection.php");
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Портал социальной помощи пострадавшим от короновируса</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
	<?php include("haeder-non-authorize.php");?>
	<br>
	<nav aria-label="breadcrumb">
  		<ol class="breadcrumb">
    		<li class="breadcrumb-item"><a href="index.php">Главная</a></li>
    		<li class="breadcrumb-item"><a href="section.php">Название раздела</a></li>
    		<li class="breadcrumb-item active" aria-current="page">Название статьи</li>
  		</ol>
	</nav>
	<br><br>
	<div class="Content">
		<div class="article" style="padding: 20px;">
			<?php
				$article_id = $_GET['id'];
				$result = mysqli_query($con,"SELECT *FROM articles where articles_id = '$article_id'");
				$articles = mysqli_fetch_array($result);
				$appId = $articles['applications_id'];
				echo'
				<h3>'. $articles["title"] .'</h3>
				<br>
				<p>
					'. $articles['content']. ' 
				</p>
				';
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
						<a href="new-application.php?id='.$appId.'"class="btn btn-primary">Подать заявку</a>
					';
				}
				if ($_SESSION['user']['isAdmin']==1) {
					echo '<a href="article-edit.php?id='. $article_id . '" class="btn btn-primary">Редактировать</a> ';
					echo '<a href="article-delete.php?id='. $article_id . '" class="btn btn-danger">Удалить</a>';
				}
				?>
		</div>
	</div>
	<?php include("footer.php");?>
</body>
</html>
<?php
	session_start();
	require_once('../../vendor/connection.php');
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
	<?php include("../../blocks/haeder.php");?>
	<br>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/index.php">Главная</a></li>
		<li class="breadcrumb-item active" aria-current="page">Полезные ссылки</li>
	</ol>
	<br><br>
	<h1 class="fluid" style="text-align: center;">Полезные ссылки</h1>
	<br>
	<div class="Content">
		<div class="fluid col-md-12">
			<?php
					if (isset($_SESSION['articleDelete'])) {
		    		 	echo '<label class="alert alert-danger">'.$_SESSION['articleDelete'].'</label><br><br>';
		    		 	unset($_SESSION['articleDelete']);
		    		 }
				$result = mysqli_query($con,"SELECT *FROM articles WHERE section = 'Полезные ссылки' ORDER BY `articles`.`date_of_publication` DESC");
				while ($articles = mysqli_fetch_array($result)){
					echo'
					<div class="article">
						<div class="float-right">
							<p>'.$articles['date_of_publication'].'</p>
						</div>
						<h3>'. $articles["title"] .'</h3>
						<!-- Ограничение не предпросмотр 896 знаков -->
						<p>
							'. substr($articles["content"], 0,895) .'... 
						</p>
						<br>
						<a href="/section/article.php?id='.$articles['articles_id'].'" class="btn btn-primary btn-md" style="right: 0%;">Читать полностью</a>
						<br>
					</div>';
				}
				?>
		</div>
		<br><br>
	</div>
</body>
</html>
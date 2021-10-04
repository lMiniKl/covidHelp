<?php 
	session_start();
	require_once('vendor/connection.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Портал социальной помощи пострадавшим от короновируса</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>  
	<!-- Подключаем CSS слайдера -->
	<link rel="stylesheet" href="simple-adaptive-slider.css">
	<!-- Подключаем JS слайдера -->
	<script defer src="simple-adaptive-slider.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function () {
			  // инициализация слайдера
			  new SimpleAdaptiveSlider('.slider', {
			    loop: true,
			    autoplay: false,
			    interval: 5000,
			    swipe: true,
			  });
			});
	</script>
	<!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>
<body>
<?php include("blocks/haeder.php");?>
<br><br>
<div class="Content">
	<h2 style="text-align: center;">Социальная помощь пострадавшим от короновирусной инфекции</h2>
	<br>
	<div class="article col-md-12">
		<p>
			Данный портал предоставляет актуальную информацию из официальных интернет-ресурсов об эпидемиологической ситуации в стране и мире. О профилактике распространения и о защите от короновирусной инфекции, а также об услугах предоставляемыми государством и волонтерскими организациями гражданам пострадавшим от короновирусной инфекции. 
		</p>
	</div>
	<br>
	<h2 class="hidden-xs" style="text-align: center;">Разделы</h2>
	<br>
	<br>
	<div class="row">
		<div class="article col-md-5">
			<h2 style="text-align: center;">Новости</h2>
			<h3 style="text-align: center;">Последняя статья</h3><br>
			<?php 
				$query = mysqli_query($con,"SELECT *FROM articles WHERE section = 'Новости'");
				$news = mysqli_fetch_array($query);

				echo '<h2>'.$news['title'].'</h2>';
				echo '<p>'.substr($news["content"], 0,800).'...</p>';
			?>
			<a href="/section/news/news.php" class="btn btn-primary" style="display: inherit;">Перейти в раздел</a>
		</div>
		<div class="article col-md-5">
			<h2 style="text-align: center;">Защита и профилактика</h2>
			<h3 style="text-align: center;">Последняя статья</h3><br>
			<?php 
				$query = mysqli_query($con,"SELECT *FROM articles WHERE section = 'Защита и профилактика'");
				$protect = mysqli_fetch_array($query);

				echo '<h2>'.$protect['title'].'</h2>';
				echo '<p>'.substr($protect["content"], 0,800).'...</p>';
			?>
			<a href="/section/news/news.php" class="btn btn-primary" style="display: inherit;">Перейти в раздел</a>
		</div>
	</div>
	<div class="row">
		<div class="article col-md-5">
			<h2 style="text-align: center;">Государственная помощь</h2>
			<h3 style="text-align: center;">Последняя статья</h3><br>
			<?php 
				$query = mysqli_query($con,"SELECT *FROM articles WHERE section = 'Государственная помощь'");
				$state = mysqli_fetch_array($query);

				echo '<h2>'.$state['title'].'</h2>';
				echo '<p>'.substr($state["content"], 0,800).'...</p>';
			?>
			<a href="/section/news/news.php" class="btn btn-primary" style="display: inherit;">Перейти в раздел</a>
		</div>
		<div class="article col-md-5">
			<h2 style="text-align: center;">Волонтерская помощь</h2>
			<h3 style="text-align: center;">Последняя статья</h3><br>
			<?php 
				$query = mysqli_query($con,"SELECT *FROM articles WHERE section = 'Волонтерская помощь'");
				$volon = mysqli_fetch_array($query);

				echo '<h2>'.$volon['title'].'</h2>';
				echo '<p>'.substr($volon["content"], 0,800).'...</p>';
			?>
			<a href="/section/news/news.php" class="btn btn-primary" style="display: inherit;">Перейти в раздел</a>
		</div>
	</div>
	<div class="row">
		<div class="article col-md-5">
			<h2 style="text-align: center;">Полезные ссылки</h2>
			<h3 style="text-align: center;">Последняя статья</h3><br>
			<?php 
				$query = mysqli_query($con,"SELECT *FROM articles WHERE section = 'Полезные ссылки'");
				$service = mysqli_fetch_array($query);

				echo '<h2>'.$service['title'].'</h2>';
				echo '<p>'.substr($service["content"], 0,800).'...</p>';
			?>
			<a href="/section/news/news.php" class="btn btn-primary" style="display: inherit;">Перейти в раздел</a>
		</div>
		<div class="article col-md-5">
			<h2>Часто задаваемые вопросы (FAQ)</h2>
			<h3 style="text-align: center;">Последняя статья</h3><br>
			<?php 
				$query = mysqli_query($con,"SELECT *FROM articles WHERE section = 'Помощь (FAQ)'");
				$faq = mysqli_fetch_array($query);

				echo '<h2>'.$faq['title'].'</h2>';
				echo '<p>'.substr($faq["content"], 0,800).'...</p>';
			?>
			<a href="/section/news/news.php" class="btn btn-primary" style="display: inherit;">Перейти в раздел</a>
		</div>
	</div>
	<br>
</div>
</body>
</html>
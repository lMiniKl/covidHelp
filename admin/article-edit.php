<?php 
	session_start();
	require_once('../vendor/connection.php');
	$article_id = $_GET['id'];
	$result = mysqli_query($con,"SELECT *FROM articles where articles_id = '$article_id'");
	$articles = mysqli_fetch_array($result);
	$_SESSION['article_id'] = $article_id;
	
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
	<div class="Content">
		<br>
  		<ol class="breadcrumb">
    		<li class="breadcrumb-item"><a href="/index.php">Главная</a></li>
			<li class="breadcrumb-item"><a href="<?php echo $section?>"> <?php echo $articles['section']?></a></li>
			<li class="breadcrumb-item active" aria-current="page">Редактирование записи</li>
  		</ol>
		<br><br>
		<h1 class="fluid" style="text-align: center;">Редактирование записи</h1>
		<div class="article-create">
			<form class="col-md-6" action="/vendor/article-update.php" method="post">
				<h3>Выберите раздел</h3>
				<select class="form-control" style="width: 260px;" name="articleSection">
					<option><?php echo $articles['section']?></option>
					<option>Новости</option>
					<option>Защита и профилактика</option>
					<option>Государственная помощь</option>
					<option>Волонтерская помощь</option>
				</select>
				<h3>Заголовок</h3>
				<input type="text" name="articleTitle" class="form-control" name="articleTitle" 
				value="<?php echo $articles['title'];?>">
				<br>
				<h3>Текст статьи</h3>
				<textarea class="form-control" class="fluid" name="articleContent"><?php echo $articles['content'];?></textarea>
				<br>
				<h3>Источник</h3>
				<br>
				<input type="text" class="form-control" name="articleSource" value="<?php echo $articles['source'];?>">
				<br>
				<h3>Наличие заявки на помощь</h3>
				<select class="form-control" style="width: 35%;" name="articleApps">
					<?php
						$result = mysqli_query($con,"SELECT *from applications");
						$i = 0;
						while ($option = mysqli_fetch_array($result)) {	
							if($articles['applications_id']==$option['applications_id']){
								echo '<option selected ="selected">'.$option['title'].'</option>';
							}						
							else{
								echo '<option>'.$option['title'].'</option>';
							}
						}
						?>
				</select>
				<br>
				<br>
				<?php
					if (isset($_SESSION['articleError'])) {
		    		 	echo '<label class="alert alert-danger">'.$_SESSION['articleError'].'</label><br><br>';
		    		 	unset($_SESSION['articleError']);
		    		 }
		    		 if (isset($_SESSION['articleSuccess'])) {
		    		 	echo '<label class="alert alert-success">'.$_SESSION['articleSuccess'].'</label><br><br>';
		    		 	unset($_SESSION['articleSuccess']);
		    		 }
					?>
				<button type="submit" class="btn btn-primary">Редактировать</button>
			</form>
		</div>
	</div>
</body>
</html>
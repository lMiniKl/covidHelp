<?php 
	session_start();
	require_once('../vendor/connection.php');
	$app_id = $_GET['id'];
	$_SESSION['app_id'] = $app_id;
	$result = mysqli_query($con,"SELECT *FROM applications where applications_id = '$app_id'");
	$applications = mysqli_fetch_array($result);
	$result = mysqli_query($con,"SELECT *FROM articles where applications_id = '$app_id'");
	$article = mysqli_fetch_array($result);
	$article_id = $article['articles_id'];
	if(isset($_SESSION['user']['id'])){
		$user_id = $_SESSION['user']['id'];
		$query = mysqli_query($con, "SELECT *FROM users WHERE user_id = $user_id");
		$userInfo = mysqli_fetch_array($query);
	}

	if($article['section'] == 'Государственная помощь')
		$section = '/section/state-support/state-support.php';

	if($article['section' == 'Волонтерская помощь'])
		$section = '/section/volunteer-support/volunteer-support.php';

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
		<li class="breadcrumb-item"><a href="index.php">Главная</a></li>
		<li class="breadcrumb-item"><a href="<?php echo $section?>"> <?php echo $article['section'];?></a></li>
		<li class="breadcrumb-item"><a href="/section/article.php?id=<?php echo $article_id?>"><?php echo $applications['title'];?></a></li>
		<li class="breadcrumb-item active" aria-current="page">Заявка на услугу</li>
	</ol>
		<br><br>
		<h1 class="fluid" style="text-align: center;"><?php echo $applications['title']?></h1>
		<div class="article-create">
			<form class="col-md-6" action="/vendor/sending-application.php" method="post">
				<h3>Заполните поля заявки</h3>
				<br>
				<input type="text" name="sendAppSurname" class="form-control" placeholder="Введите фамилию" 
				value="<?php if($userInfo!=null){
					echo $userInfo['surname'];
				}?>">
				<br>
				<input type="text" name="sendAppName" class="form-control" placeholder="Введите имя"
					value="<?php if($userInfo!=null){
					echo $userInfo['name'];
				}?>">
				<br>
				<input type="text" name="sendAppPatronymic" class="form-control" placeholder="Введите отчество"
				value="<?php if($userInfo!=null){
					echo $userInfo['patronymic'];
				}?>">
				<br>
				<input type="text" name="sendAppEmail" class="form-control" placeholder="Введите адрес электронной почты"
					value="<?php if($userInfo!=null){
					echo $userInfo['email'];
				}?>">
				<br>
				<input type="text" name="sendAppPhone" class="form-control" placeholder="Введите номер телефона"
					value="<?php if($userInfo!=null){
					echo $userInfo['phone'];
				}?>"
				><br>
				<?php
					if (isset($_SESSION['sendAppError'])) {
		    		 	echo '<label class="alert alert-danger">'.$_SESSION['sendAppError'].'</label><br><br>';
		    		 	unset($_SESSION['sendAppError']);
		    		 }
		    		 if (isset($_SESSION['sendAppSuccess'])) {
		    		 	echo '<label class="alert alert-success">'.$_SESSION['sendAppSuccess'].'</label><br><br>';
		    		 	unset($_SESSION['sendAppSuccess']);
		    		 }
					?>
				<br>
				<button type="submit" class="btn btn-primary">Отправить заявку</button>
			</form>
		</div>
	</div>
</body>
</html>
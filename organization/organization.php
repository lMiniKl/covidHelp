<?php
	session_start();
	require_once("../vendor/connection.php");
	if($_SESSION['user']['isAdmin']!=1){
		header("Location: /index.php");
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
	<nav aria-label="breadcrumb">
  		<ol class="breadcrumb">
    		<li class="breadcrumb-item"><a href="/index.php">Главная</a></li>
    		<li class="breadcrumb-item active" aria-current="page">Заявки</li>
  		</ol>
	</nav>
	<br><br>
	<h1 class="fluid" style="text-align: center;">Организации</h1>
	<br>
	<div class="Content">
		<div class="fluid col-md-12">
			<a href="/organization/organization-create-page.php" class="btn btn-primary">Добавить новую организацию</a>
			<br><br>
			<?php
				if (isset($_SESSION['orgDelete'])) {
	    		 	echo '<label class="alert alert-danger">'.$_SESSION['orgDelete'].'</label><br>';
	    		 	unset($_SESSION['orgDelete']);
	    		 }
	    		 if (isset($_SESSION['orgDeleteError'])) {
	    		 	echo '<label class="alert alert-danger">'.$_SESSION['orgDeleteError'].'</label><br>';
	    		 	unset($_SESSION['orgDeleteError']);
	    		 }
				$result = mysqli_query($con,"SELECT *FROM organization ORDER BY date_create DESC");
				while ($organization = mysqli_fetch_array($result)){
					echo'
					<div class="article">
						<h3>'. $organization["organization_name"] .'</h3>
						<br>
						<label class="alert alert-primary">Категория организации: '.$organization['category'].'</label>
						<br>
						<label class="alert alert-primary">Электронная почта: '.$organization['email'].'</label><br>
						<label class="alert alert-primary">Контактный номер телефона: '.$organization['phone'].'</label><br>
						<label class="alert alert-primary">Дата создания: '.$organization['date_create'].'</label><br>
						<a href="organization-edit-page.php?id='.$organization['organization_id'].'" class="btn btn-primary btn-md">Редактировать</a>
						<a href="/vendor/organization-delete.php?id='.$organization['organization_id'].'" class="btn btn-danger">Удалить</a>
						<br>
					</div>';
				}
				?>
		</div>
		<br><br>
	</div>
</body>
</html>
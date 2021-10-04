<?php
	session_start();
	require_once("../vendor/connection.php");
	if($_SESSION['user']['isAdmin']!=1){
		header("Location: index.php");
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
	<h1 class="fluid" style="text-align: center;">Заявки</h1>
	<br>
	<div class="Content">
		<div class="fluid col-md-12">
			<a href="/application/application-create-page.php" class="btn btn-primary">Создать новую форму заявки</a>
			<br><br>
			<?php
				if (isset($_SESSION['appDelete'])) {
	    		 	echo '<label class="alert alert-danger">'.$_SESSION['appDelete'].'</label><br>';
	    		 	unset($_SESSION['appDelete']);
	    		 }
	    		 if (isset($_SESSION['appDeleteError'])) {
	    		 	echo '<label class="alert alert-danger">'.$_SESSION['appDeleteError'].'</label><br>';
	    		 	unset($_SESSION['appDeleteError']);
	    		 }
				$result = mysqli_query($con,"SELECT *FROM applications");
				while ($applications = mysqli_fetch_array($result)){
					if($applications['applications_id']!=1){
						$orgId = $applications['organization_id'];
						$query = mysqli_query($con,"SELECT *FROM organization WHERE organization_id = $orgId");
						$org = mysqli_fetch_array($query);
						echo'
						<div class="article">
							<h3>'. $applications["title"] .'</h3>
							<br>
							<label class="alert alert-primary">Категория: '.$applications['section'].'</label>
							<br>
							<label class="alert alert-primary">Организация: '.$org['organization_name'].'</label><br>
							<a href="application-edit.php?id='.$applications['applications_id'].'" class="btn btn-primary btn-md">Редактировать</a>
							<a href="/vendor/application-delete.php?id='.$applications['applications_id'].'" class="btn btn-danger">Удалить</a>
							<br>
						</div>';
					}
				}
				?>
		</div>
		<br><br>
	</div>
</body>
</html>
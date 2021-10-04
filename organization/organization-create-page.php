<?php
	session_start();
	require_once("../vendor/connection.php");
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
		<li class="breadcrumb-item"><a href="index.php">Главная</a></li>
		<li class="breadcrumb-item"><a href="/organization/organization.php">Организации</a></li>
		<li class="breadcrumb-item active" aria-current="page">Новая организация</li>
	</ol>
	<br><br>
	<h1 style="text-align: center;">Новая организация</h1>
	<br>
	<div class="Content">
		<div>
	      	<form action="/vendor/organization-create.php" method="post" class="col-md-5 col-xs-12">    
	        	<label>Имя организации</label>
		        <input type="text" class="form-control" name="orgName">
		        <br>
		        <label>Выберите категорию организации</label>
		    	<select class="form-control" name="orgCategory">
		    		<option>Государственная организация</option>
		    		<option>Волонтерская организация</option>
		    	</select>
		    	<br>
		    	<label>Электронный адрес организации</label>
				<input type="text" class="form-control" name="orgEmail">
				<label>Контактный номер телефона организации</label>
				<input type="text" class="form-control" name="orgPhone">
		    	<br>
		    	<?php
		    		if (isset($_SESSION['orgError'])) {
		    		 	echo '<label class="alert alert-danger">'.$_SESSION['orgError'].'</label><br>';
		    		 	unset($_SESSION['orgError']);
		    		 }
		    		 if (isset($_SESSION['orgSuccess'])) {
		    		 	echo '<label class="alert alert-success">'.$_SESSION['orgSuccess'].'</label><br>';
		    		 	unset($_SESSION['orgSuccess']);
		    		 }
		    		?>
		    	<button type="submit" class="btn btn-primary">Добавить</button>
		   </form>
	   </div>
	</div>
</body>
</html>
<?php
	session_start();
	require_once("../vendor/connection.php");

	$query = mysqli_query($con, "SELECT *FROM organization ORDER BY organization_name ASC");
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
		<li class="breadcrumb-item"><a href="/application/application.php">Заявки</a></li>
		<li class="breadcrumb-item active" aria-current="page">Новая заявка</li>
	</ol>
	<br><br>
	<h1 style="text-align: center;">Новая заявка</h1>
	<br>
	<div class="Content">
		<div>
	      	<form action="/vendor/application-create.php" method="post" class="col-md-5 col-xs-12">    
	        	<label>Название заявки</label>
		        <input type="text" class="form-control" name="appTitle" aria-describedby="appTitle">
		        <br>
		        <label>Выберите категорию</label>
		    	<select class="form-control" name="appSection">
		    		<option>Государственная помощь</option>
		    		<option>Волонтерская помощь</option>
		    	</select>
		    	<br>
		    	<label>Выберите организацию</label>
		    	<select class="form-control" name="orgName">
		    		<option></option>
		    		<?php
		    			while($organization = mysqli_fetch_array($query)){
		    				echo '<option>'.$organization['organization_name'].'</option>';	
		    			}
		    			?>
		    	</select> 
		    	<br>
		    	<?php
		    		if (isset($_SESSION['appError'])) {
		    		 	echo '<label class="alert alert-danger">'.$_SESSION['appError'].'</label><br>';
		    		 	unset($_SESSION['appError']);
		    		 }
		    		 if (isset($_SESSION['appSuccess'])) {
		    		 	echo '<label class="alert alert-success">'.$_SESSION['appSuccess'].'</label><br>';
		    		 	unset($_SESSION['appSuccess']);
		    		 }
		    		?>
		    	<button type="submit" class="btn btn-primary">Создать новую форму заявки</button>
		   </form>
	   </div>
	</div>
</body>
</html>
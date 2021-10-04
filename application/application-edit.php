<?php
	session_start();
	require_once("../vendor/connection.php");
	$id = $_GET['id'];
	$query = mysqli_query($con,"SELECT *FROM applications WHERE applications_id = $id") or die('Ошибка запроса');
	$applications = mysqli_fetch_array($query);
	$title = $applications['title'];
	$section = $applications['section'];
	$org = $applications['organization_id'];
	$query = mysqli_query($con,"SELECT *FROM organization WHERE organization_id = $org");
	$orgName = mysqli_fetch_array($query);
	$_SESSION['appId'] = $id;
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
		<li class="breadcrumb-item"><a href="application.php">Заявки</a></li>
		<li class="breadcrumb-item active" aria-current="page">Редактирование заявки</li>
	</ol>
	<br><br>
	<h1 class="fluid" style="text-align: center;">Редактирование заявки</h1>
	<br>
	<div class="Content">
		<div class="modal-body">
      	<form action="/vendor/applications-update.php" method="post" style="width: 50%;">    
        	<label>Заголовок заявки</label>
	        <input type="text" class="form-control" name="appTitle" aria-describedby="appTitle" 
	        value="<?php echo $title;?>">
	        <br>
	        <label>Выберите категорию</label>
	    	<select class="form-control" name="appSection">
	    		<?php
	    			echo "<option>$section</option>"
	    			?>
	    		<option>Государственная помощь</option>
	    		<option>Волонтерская помощь</option>
	    	</select>
	    	<br>
	    	<label>Организация</label>
	    	<select class="form-control" name="orgName">
	    		<?php 
	    		echo '<option style = "font-weight:bold">'.$orgName['organization_name'].'</option>';
	    		$result = mysqli_query($con,"SELECT *FROM organization ORDER BY `organization`.`organization_name` ASC");
	    		while ($org = mysqli_fetch_array($result)) {
	    			echo '<option>'.$org['organization_name'].'</option>';
	    		}
	    		?>
	    	</select>
	    	<br>
	    	<?php
	    		if (isset($_SESSION['appUpdError'])) {
	    		 	echo '<label class="alert alert-danger">'.$_SESSION['appUpdError'].'</label><br>';
	    		 	unset($_SESSION['appUpdError']);
	    		 }
	    		 if (isset($_SESSION['appUpdSuccess'])) {
	    		 	echo '<label class="alert alert-success">'.$_SESSION['appUpdSuccess'].'</label><br>';
	    		 	unset($_SESSION['appUpdSuccess']);
	    		 }
	    		?>
	    	<button type="submit" class="btn btn-primary">Редактировать заявку</button>
	   </form>
</body>
</html>
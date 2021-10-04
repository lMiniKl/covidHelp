<?php
	session_start();
	require_once("../vendor/connection.php");
	$id = $_GET['id'];
	$_SESSION['orgId'] = $id;
	$query = mysqli_query($con,"SELECT *FROM organization WHERE organization_id = $id") or die('Ошибка запроса');
	$organization = mysqli_fetch_array($query);
	$name = $organization['organization_name'];
	$category = $organization['category'];
	$email = $organization['email'];
	$phone = $organization['phone'];
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
		<li class="breadcrumb-item"><a href="/index.php">Главная</a></li>
		<li class="breadcrumb-item"><a href="organization.php">Организации</a></li>
		<li class="breadcrumb-item active" aria-current="page">Редактирование организации</li>
	</ol>
	<br><br>
	<h1 class="fluid" style="text-align: center;">Редактирование заявки</h1>
	<br>
	<div class="Content">
		<div class="modal-body">
      	<form action="/vendor/organization-edit.php" method="post" style="width: 50%;">    
        	<label>Имя организации</label>
	        <input type="text" class="form-control" name="orgName" 
	        value="<?php echo $name;?>">
	        <br>
	        <label>Выберите категорию</label>
	    	<select class="form-control" name="orgCategory">
	    		<?php
	    			echo "<option>$category</option>"
	    			?>
	    		<option>Государственная организация</option>
	    		<option>Волонтерская организация</option>
	    	</select>
	    	<br>
	    	<label>Электронная почта</label>
	    	<input type="text" class="form-control" name="email" aria-describedby="orgEmail" 
	        value="<?php echo $email;?>">
	        <label>Контактный номер телефона</label>
	        <input type="text" class="form-control" name="phone" aria-describedby="orgPhone" 
	        value="<?php echo $phone;?>">
	    	<br>
	    	<?php
	    		if (isset($_SESSION['orgUpdError'])) {
	    		 	echo '<label class="alert alert-danger">'.$_SESSION['orgUpdError'].'</label><br>';
	    		 	unset($_SESSION['orgUpdError']);
	    		 }
	    		 if (isset($_SESSION['orgUpdSuccess'])) {
	    		 	echo '<label class="alert alert-success">'.$_SESSION['orgUpdSuccess'].'</label><br>';
	    		 	unset($_SESSION['orgUpdSuccess']);
	    		 }
	    		?>
	    	<button type="submit" class="btn btn-primary">Редактировать организацию</button>
	   </form>
</body>
</html>
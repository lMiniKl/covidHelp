<?php
	session_start();
	require_once("vendor/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Портал социальной помощи пострадавшим от короновируса</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>  
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
</head>
<body>
	<script>
		document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + 
		':35729/livereload.js?snipver=1"></' + 'script>')
	</script>
	<?php include("blocks/haeder.php");?>
	<br>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Главная</a></li>
		<li class="breadcrumb-item active" aria-current="page">Мой профиль</li>
	</ol>
	<h1 style="text-align: center;">Мой профиль</h1>
	<br><br>
	<div class="Content">
		<div class="profile">
			<div class="profile-fio">
				<?php
					$user_id = $_SESSION['user']['id'];
					$result = mysqli_query($con,"SELECT *FROM users WHERE user_id = '$user_id'");
					$userData = mysqli_fetch_array($result);
					?>
				<label>Фамилия</label>
				<input type="text" readonly class="form-control col-md-2" value="<?php echo $userData['surname'];?>">
				<label>Имя</label>
				<input type="text" readonly class="form-control col-md-2" id="staticName" value="<?php echo $userData['name'];?>">
				<label>Отчество</label>
				<input type="text" readonly class="form-control col-md-2" id="staticPatronymic" value="<?php echo $userData['patronymic'];?>">
			</div>
			<div class="profile-phone">
				<label>Электронная почта</label>
				<input type="text" readonly class="form-control col-md-2" id="staticEmail" value="<?php echo $userData['email'];?>">
				<label>Контактный телефон</label>
				<input type="text" readonly class="form-control col-md-2" id="staticEmail" value="<?php echo $userData['phone'];?>">
			</div>
		</div>
	</div>
</body>
</html>
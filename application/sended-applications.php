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
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/index.php">Главная</a></li>
		<li class="breadcrumb-item active" aria-current="page">Поданные заявки</li>
	</ol>
	<br><br>
	<h1 class="fluid" style="text-align: center;">Поданные заявки</h1>
	<br>
	<div class="Content">
		<div class="fluid col-md-12">
			<?php
	    		 if (isset($_SESSION['confirmAppSuccess'])) {
	    		 	echo '<label class="alert alert-success">'.$_SESSION['confirmAppSuccess'].'</label><br>';
	    		 	unset($_SESSION['confirmAppSuccess']);
	    		 }
				?>
				<br>
				<h3 style="text-align: center;">Не расмотренные заявки</h3>
				<?php
				$result = mysqli_query($con,"SELECT *FROM `sendofapplications` ORDER BY `sendofapplications`.`dateSendingApplications` DESC");
				while ($sendedApp = mysqli_fetch_array($result)){
					if($sendedApp['isAccepted']==null){
						$app_id = $sendedApp['applications_id'];
						$query = mysqli_query($con,"SELECT *FROM applications WHERE applications_id = $app_id");
						$app = mysqli_fetch_array($query);
						echo'
						<div class="article">
							<form action="/vendor/confirm-application.php" method="post">
								<h3>'. $applications["title"] .'</h3>
								<br>

								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="inputGroup-sizing-default">Заявка №</span>
								  </div>
								  <input type="text" class="form-control col-md-1" aria-label="Default" aria-describedby="inputGroup-sizing-default"
								  value="'.$sendedApp['sendOfApplications_id'].'" readonly name="sendApp_id">
								</div>

								<label class="alert alert-primary">Дата отправки заявки: '.$sendedApp['dateSendingApplications'].'</label>
								<br>
								<label class="alert alert-primary">Заявка: '.$app['title'].'</label>
								<br>
								<label class="alert alert-primary">Фамилия: '.$sendedApp['surname'].'</label>
								<br>
								<label class="alert alert-primary">Имя: '.$sendedApp['name'].'</label>
								<br>
								<label class="alert alert-primary">Отчество: '.$sendedApp['patronymic'].'</label>
								<br>
								<label class="alert alert-primary">Контактный телефон: '.$sendedApp['phone'].'</label>
								<br>
								<label class="alert alert-primary">Электронная почта: '.$sendedApp['email'].'</label>
								<br>
								<label>Решение по заявке</label>
								<select class="form-control col-md-2" name="appDecision">
									<option>Принять</option>
									<option>Отлонить</option>
								<select>
								<br>
								<label>Комментарий к заявке</label>
								<textarea class="form-control col-md-6" name="appComment"></textarea><br>
								<button class="btn btn-primary" type="submit">Подтвердить заявку</button>
							</form>
						</div>';

					}
				}
				echo $sendedApp;
				?>

				<br>
				<h3 style="text-align: center;">Расмотренные заявки</h3>
				<?php
				$result = mysqli_query($con,"SELECT *FROM `sendofapplications` ORDER BY `sendofapplications`.`dateConsedirationApplication` DESC");
				while ($sendedApp = mysqli_fetch_array($result)){
					if($sendedApp['isChecked']==1){
						$app_id = $sendedApp['applications_id'];
						$query = mysqli_query($con,"SELECT *FROM applications WHERE applications_id = $app_id");
						$app = mysqli_fetch_array($query);
						if($sendedApp['isAccepted']==1){
							$isAccepted = 'Принята';
						} else $isAccepted = 'Отклонена';			
						echo'
						<div class="article">
							<h3>'. $applications["title"] .'</h3>
							<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="inputGroup-sizing-default">Заявка №</span>
								  </div>
								  <input type="text" class="form-control col-md-1" aria-label="Default" aria-describedby="inputGroup-sizing-default"
								  value="'.$sendedApp['sendOfApplications_id'].'" readonly>
								</div>
							<label class="alert alert-primary">Дата отправки заявки: '.$sendedApp['dateSendingApplications'].'</label>
							<br>
							<label class="alert alert-primary">Дата рассмотрения заявки: '.$sendedApp['dateConsedirationApplication'].'</label>
							<br>
							<label class="alert alert-primary">Заявка: '.$app['title'].'</label>
							<br>
							<label class="alert alert-primary">Фамилия: '.$sendedApp['surname'].'</label>
							<br>
							<label class="alert alert-primary">Имя: '.$sendedApp['name'].'</label>
							<br>
							<label class="alert alert-primary">Отчество: '.$sendedApp['patronymic'].'</label>
							<br>
							<label class="alert alert-primary">Контактный телефон: '.$sendedApp['phone'].'</label>
							<br>
							<label class="alert alert-primary">Электронная почта: '.$sendedApp['email'].'</label>
							<br>
							<label class="alert alert-primary">Решение по заявке: '.$isAccepted.'</label>
							<br>
							<label class="alert alert-primary">Комментарий: '.$sendedApp['comment'].'</label>
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
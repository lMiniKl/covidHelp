<?php
	session_start();
	require_once("connection.php");
	$sendedApp_id = $_POST['sendApp_id'];
	$appDecision = $_POST['appDecision'];
	$appComment = $_POST['appComment'];
	if($appDecision == 'Принять'){
		$appDecision = 1;
	} else $appDecision = 0;
	$today = date("Y-m-d"); // Системная дата

	mysqli_query($con,
	"UPDATE `sendofapplications` SET `dateConsedirationApplication` = '$today', `isChecked` = '1', `isAccepted` = '$appDecision', `comment` = '$appComment' WHERE `sendofapplications`.`sendOfApplications_id` = $sendedApp_id") or die("ERROR");
	$_SESSION['confirmAppSuccess'] = "Рассмотрение заявки успешно подтверждено!";
	header("Location: ../application/sended-applications.php");
	?>
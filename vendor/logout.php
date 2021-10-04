<?php
	session_start();
	require_once("connection.php");
	unset($_SESSION['user']);
	header("Location: ../index.php");
	?>
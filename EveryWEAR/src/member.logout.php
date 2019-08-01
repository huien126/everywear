<?php 
	include 'module/default.php';

	unset($_SESSION["EWUID"]);
	header("location: /member/login");
?>
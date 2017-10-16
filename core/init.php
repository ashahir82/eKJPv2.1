<?php
session_start();
error_reporting(1);

date_default_timezone_set('Asia/Kuala_Lumpur');

require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/course.php';

if (logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'id', 'username', 'fullname', 'pass', 'email','telnum', 'last_login', 'level', 'active');
	
	if ($_SESSION['logintime'] <> $user_data['last_login']) {
		session_destroy();
		$URL="index.php?p=logout";
		echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
		exit();
	}
	
	if (user_active($user_data['username']) === false) {
		session_destroy();
		$URL="index.php";
		echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
		exit();
	}
}

$errors = array();
?>
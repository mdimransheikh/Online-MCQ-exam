<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/classes/Users.php');
	$usr = new User();

	$name 	  = $_POST['name'];
	$username = $_POST['username'];
	$userpass = $_POST['userpass'];
	$email 	  = $_POST['email'];

	$userregi = $usr->userRegistration($name, $username, $userpass, $email);
?>
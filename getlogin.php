<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/classes/Users.php');
	$usr = new User();

	$email 	  = $_POST['email'];
	$userpass = $_POST['userpass'];
	
	$userlogin = $usr->userLogin($email, $userpass);
?>
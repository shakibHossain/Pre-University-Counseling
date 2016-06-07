<?php
session_start();


if($_SESSION['login_status']){
	echo $_SESSION["name"];
	echo "\n";
	echo "you are logged out";
	session_destroy();
	header( 'Location: index01.php') ;
}
else{
	echo "you are already logged out";
}
?>
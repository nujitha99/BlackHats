<?php

session_start();
if(isset($_SESSION['user_name'])){
	unset($_SESSION['user_name']);
	header("location:login.php");
}else{
	header("location:login.php;");
}
 
?>
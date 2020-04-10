<!DOCTYPE html>
<html>
<title>Signup Page</title>
<head>
<style>
*{
	margin:0px;
	padding:0px;
}
#main{
	
	width:200px;
	margin:24px auto;
}
</style>
</head>

<body>
<?php

include("connection.php"); //inclue db


if(isset($_POST['register'])){                  //POST METHODS
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$user_name=$_POST['user_name'];
	$password=$_POST['password'];
	
	if($first_name != "" and $last_name != "" and $password != ""){
		$q="INSERT INTO `user` (`id`, `first_name`, `last_name`, `user_name`, `password`)
		VALUES('', '".$first_name."', '".$last_name."', '".$user_name."', '".$password."')";
		if(mysqli_query($conn, $q)){
			header("location:login.php");
		}else{
			echo $q;
		}
	}else{
		echo "please fill all the boxex"; //validation for the form register
	}
}
?>


<div id="main">
<h2 align="center">Registration</h2>
<form method="post">
First Name:<br>
<input type="text" name="first_name" placeholder="First Name"/>
<br><br>
Last Name:<br>
<input type="text" name="last_name" placeholder="Last Name"/><br><br>
User Name:<br>
<input type="text" name="user_name" placeholder="user Name"/><br><br>
Password:<br>
<input type="password" name="password" placeholder="password"/><br><br>
<input type="submit" name="register" placeholder="Register"/>
</form>
<div>
</body>
</html>
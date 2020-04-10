<!DOCTYPE html>
<html>
<title>LOGIN PAGE</title>
<style>
*{
	margin:0px;
	padding:0px;
}
#main{
	width:200px;
	margin:20px auto;
}
</style>
<body>
<div id="main">

<?php 

session_start();   //session for the user name
include("connection.php"); //inclue db


if(isset($_POST['login'])){
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];
	
	$q='SELECT * FROM `user` where `user_name`="'.$user_name.'" and `password`="'.$password.'"';
	$r= mysqli_query($conn, $q);
	if(mysqli_num_rows($r)>0){
		
		$_SESSION['user_name'] = $user_name;   //adding to a session here
		header("location:index.php");
	}else{
		echo 'your password and user name do not match';
	}
}

?>




<h2 style="text-align:center;">Login</h2>
<form method="post">
User Name:<br>
<input type="text" name="user_name" placeholder="user name" required /><br><br> 
Password:<br>
<input type="password" name="password" placeholder="password" />
<br><br>
<input type="submit" name="login" value="Login"/><br>
<br>
<a href="registration.php">create an account</a>
</div>
</body>


</html>
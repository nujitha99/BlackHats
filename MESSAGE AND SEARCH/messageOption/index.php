<!DOCTYPE html>
<html>
<title>Message Room
</title>
<style>
*{
	margin:0px;
	padding:0px;
}

#main{
	border:1px solid black;
	width:500px;
	height:500px;
	margin:24px auto;
}
#message_area{
	width:98%;
	border:1px solid blue;
	height:440px;
	padding:0% 1%;
}
</style>

<body>

<?php 
session_start();   //to start the php session

if(isset($_SESSION['user_name'])){   //to set the session variable

	echo 'Welcome '.$_SESSION['user_name'];
	echo '<br>';
	echo '<a href="logout.php">LOGOUT</a>';
}
else{
	header("location:login.php"); //to redirect
}
?>

<div id="main">                   
<div id="message_area">  

<?php
include("connection.php");                
$q1 = "SELECT * FROM `message` ";
$r1 = mysqli_query($conn, $q1);
while($row = mysqli_fetch_assoc($r1)){
	$message = $row['message'];
	$user_name = $row['user_name'];
	echo '<h4 style="color:red;">'.$user_name.'</h4>';
	echo '<p>'.$message.'</p>';
	echo '<hr>';
}

if(isset($_POST['submit'])){
	$message = $_POST['message'];
	$q='INSERT INTO `message` (`id`,`message`,`user_name`)VALUES("","'.$message.'", "'.$_SESSION['user_name'].'")';
	
	
	if(!isset($message) || trim($message) == ''){
		echo '<script language="javascript">';
		echo 'alert("Please Check again")';
		echo '</script>';
	}
	else if(mysqli_query($conn, $q)){
		echo '<h4 style="color:red;">'.$_SESSION['user_name'].'</h4>';
		echo '<p>'.$message.'</p>';
	}
}

 
?>

</div>



<form method="post">
<input type="text" name="message" style="width:420px;height:50px;margin-top:2px;"  placeholder="Say something..." />
<input type="submit" name="submit" style="width:70px;height:50px;" value="Send" />
</form>


</div>
</body>
</html>
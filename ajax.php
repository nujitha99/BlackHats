<?php
require_once 'config.php';

    if($_POST['act'] == 'rate'){
    	$ip = $_SESSION['user'];
    	$therate = $_POST['rate'];
    	$thepost = $_POST['post_id'];

    	$query = mysqli_query($db,"SELECT * FROM star where ip= '$ip'  ");
    	while($data = mysqli_fetch_assoc($query)){
    		$rate_db[] = $data;
    	}

    	if(@count($rate_db) == 0 ){
    		mysqli_query($db,"INSERT INTO star (id_post, ip, rate)VALUES('$thepost', '$ip', '$therate')");
    	}else{
    		mysqli_query($db,"UPDATE star SET rate= '$therate' WHERE ip = '$ip'");
    	}
    } 
?>
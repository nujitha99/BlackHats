<?php
$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "ecomm";
$conn = mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname);
if(!$conn){
    echo "Couldn't connect to database $dbname.";
}
mysqli_select_db($conn,$dbname);

?>
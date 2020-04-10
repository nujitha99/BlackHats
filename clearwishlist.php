<?php
session_start();

$pagename="Clear the wishlist"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=stylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("detectLogin.php"); 

echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

unset($_SESSION['wishlist']);
echo "<p>Your wishlist has been cleared</p>";


echo "</body>";
?>
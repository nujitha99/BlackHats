<?php
if(isset($_SESSION['user']['userid'])){
    echo "<p align='right'><i>".$_SESSION['user']['username']." / ".$_SESSION['user']['userid']."</i></p>";
}
?>
<?php
session_start();
include("db.php");
$pagename="View our products"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>$pagename</title>"; //display name of the page as window title
echo "<body>";
echo "<h4>$pagename</h4>"; //display name of the page on the web page
$SQL = "SELECT showId, showName, showPic, showDesc, price, qty FROM shows";
$exeSQL = mysqli_query($conn,$SQL) or die (mysqli_error($conn));

echo "<table style='border:0px;'>";
while($arrayp=mysqli_fetch_array($exeSQL)){
    $prodId = $arrayp['showId'];
    echo "<tr>";
        echo "<td  style='border: 0px'><a href=prodbuy.php?u_prod_id=".$arrayp['showId']."><img src=images/".$arrayp['showPic']." height=200 width=200/></a></td>";
        echo "<td style='border: 0px'><p><h5>".$arrayp['showName']."</h5>";
        echo "<p>".$arrayp['showDesc']."</p>";
        echo "<p><b>$".$arrayp['price']."</b></p>";
        echo "<p>Number of stocks left: ".$arrayp['qty']."</p>";
        echo "<p>Number to be purchased: </p>";
        echo "<form method=post action=cart.php>";
            echo "<select name='p_quantity'>";
            for($i=1;$i<=$arrayp['qty'];$i++){
                echo "<option value='$i'>$i</option>";
            }
            echo "</select>";
            echo "<input type=submit value='Add to basket'/>";
            echo "<input type=hidden name='hidden_prodId' value='$prodId'/>";
        echo "</form>";
        echo "</td>";
    echo "</tr>";
}
echo "</table>";
include("footfile.html"); //include head layout
echo "</body>";
?>
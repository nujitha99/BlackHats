<?php
session_start();
include ("db.php");
$pagename="Checkout"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>$pagename</title>"; //display name of the page as window title
echo "<body>";
echo "<h4>$pagename</h4>"; //display name of the page on the web page
$currentdatetime = date('Y-m-d H:i:s');
$userId = $_SESSION['userid'];
$SQL = "INSERT INTO Orders (userId, orderDateTime, orderTotal, orderStatus) VALUES ($userId,'$currentdatetime',0.00,'Placed')";
$exeSQL =  mysqli_query($conn,$SQL) or die (mysqli_error($conn));
$error_number = mysqli_errno($conn);
if((!mysqli_error($conn)) && $error_number==0){
    $SQL = "SELECT MAX(orderNo) AS orderNo FROM Orders WHERE userId=$userId";
    $exeSQL =  mysqli_query($conn,$SQL) or die (mysqli_error($conn));
    $arrayord = mysqli_fetch_array($exeSQL);
    $orderNo = $arrayord['orderNo'];
    echo "<p><b>Order placed successfully</b> - Order reference no: $orderNo</p>";
    $total=0;
        echo "<table style='border:0px;'>";
        echo "<th>Product name</th>";
        echo "<th>Price</th>";
        echo "<th>Quantity</th>";
        echo "<th>Subtotal</th>";
        foreach($_SESSION['basket'] as $index => $value){
            $SQL = "SELECT prodName, prodPrice, prodQuantity FROM Product WHERE prodId='$index'";
            $exeSQL =  mysqli_query($conn,$SQL) or die (mysqli_error($conn));
            $arrayp=mysqli_fetch_array($exeSQL);
                echo "<tr>";
                echo "<td>".$arrayp['prodName']."</td>";
                echo "<td>$".$arrayp['prodPrice']."</td>";
                echo "<td>$value</td>";
                $subtotal = $arrayp['prodPrice']*$value;
                $total += $subtotal; 
                echo "<td>$$subtotal</td>";
                echo "</tr>";
                $SQL = "INSERT INTO Order_Line(orderNo, prodId, quantityOrdered, subTotal) VALUES ($orderNo,$index,$value,$subtotal)";
                $exeSQL = mysqli_query($conn,$SQL) or die (mysqli_error($conn));
        }
        echo "<tr>";
            echo "<td colspan='3'><b>Total</b></td>";
            echo "<td>$$total</td>";
        echo "</tr>";
        $SQL2 = "UPDATE Orders SET orderTotal=$total WHERE orderNo=$orderNo";
        $exeSQL2 = mysqli_query($conn,$SQL2) or die (mysqli_error($conn));
        echo "</table>";
    }else{
        echo "There is an error with placing the order";
    }
    unset($_SESSION['basket']);
include("footfile.html"); //include head layout
echo "</body>";
?>
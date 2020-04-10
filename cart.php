<?php
session_start();
include("db.php");
$pagename="Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>$pagename</title>"; //display name of the page as window title
echo "<body>";
echo "<h4>$pagename</h4>"; //display name of the page on the web page
if(isset($_POST['delete_hidden_prodId'])){
    $delprodid = $_POST['delete_hidden_prodId'];
    unset($_SESSION['basket'][$delprodid]);
    echo "<br>";
    echo "1 item removed from the basket";
    echo "<br>";
}
if(isset($_POST['hidden_prodId'])){
    $newprodid = $_POST['hidden_prodId'];
    $reququantity = $_POST['p_quantity'];
    $_SESSION['basket'][$newprodid]=$reququantity;
    echo "1 item added to basket";
    if(isset($_SESSION['basket'])){
        $total=0;
        echo "<table style='border:0px;'>";
        echo "<th>Product name</th>";
        echo "<th>Price</th>";
        echo "<th>Quantity</th>";
        echo "<th>Subtotal</th>";
        echo "<th></th>";
        foreach($_SESSION['basket'] as $index => $value){
            $SQL = "SELECT showName, price, qty FROM shows WHERE showId='$index'";
            $exeSQL =  mysqli_query($conn,$SQL) or die (mysqli_error($conn));
            $arrayp=mysqli_fetch_array($exeSQL);
                echo "<tr>";
                echo "<td>".$arrayp['showName']."</td>";
                echo "<td>$".$arrayp['price']."</td>";
                echo "<td>$value</td>";
                $subtotal = $arrayp['price']*$value;
                $total += $subtotal; 
                echo "<td>$$subtotal</td>";
                echo "<td>";
                echo "<form method = post  action = cart.php>";
                echo "<button>Remove</button>";
                echo "<input type=hidden name='delete_hidden_prodId' value='$index'/>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
        }
        echo "<tr>";
            echo "<td colspan='3'><b>Total</b></td>";
            echo "<td>$$total</td>";
            echo "<td></td>";
        echo "</tr>";
        echo "</table>";
    }else{
        echo "<br>";
        echo "<br>";
        echo "Basket is empty";
        echo "<table style='border:0px;'>";
        echo "<th>Product name</th>";
        echo "<th>Price</th>";
        echo "<th>Quantity</th>";
        echo "<th>Subtotal</th>";
        echo "<tr>";
        echo "<td colspan='3'><b>Total</b></td>";
        echo "<td>$0.00</td>";
        echo "</tr>";
        echo "</table>";
    }
}else{
    echo "Current basket unchanged";
    if(isset($_SESSION['basket'])){
        $total=0;
        echo "<table style='border:0px;'>";
        echo "<th>Product name</th>";
        echo "<th>Price</th>";
        echo "<th>Quantity</th>";
        echo "<th>Subtotal</th>";
        echo "<th></th>";
        foreach($_SESSION['basket'] as $index => $value){
            $SQL = "SELECT showName, price, qty FROM shows WHERE showId='$index'";
            $exeSQL = $exeSQL = mysqli_query($conn,$SQL) or die (mysqli_error($conn));
            $arrayp=mysqli_fetch_array($exeSQL);
                echo "<tr>";
                echo "<td>".$arrayp['showName']."</td>";
                echo "<td>$".$arrayp['price']."</td>";
                echo "<td>$value</td>";
                $subtotal = $arrayp['price']*$value;
                $total += $subtotal; 
                echo "<td>$$subtotal</td>";
                echo "<td>";
                echo "<form method = post  action = cart.php>";
                echo "<button>Remove</button>";
                echo "<input type=hidden name='hidden_prodId' value='$index'/>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
        }
        echo "<tr>";
            echo "<td colspan='3'><b>Total</b></td>";
            echo "<td>$$total</td>";
            echo "<td></td>";
        echo "</tr>";
        echo "</table>";
    }else{
        echo "<br>";
        echo "<br>";
        echo "Basket is empty";
        echo "<table style='border:0px;'>";
        echo "<th>Product name</th>";
        echo "<th>Price</th>";
        echo "<th>Quantity</th>";
        echo "<th>Subtotal</th>";
        echo "<tr>";
        echo "<td colspan='3'><b>Total</b></td>";
        echo "<td>$0.00</td>";
        echo "</tr>";
        echo "</table>";
    }
}
echo "<br>";
echo "<a href='clearbasket.php'>Clear basket</a>";
echo "<br>";
if(isset($_SESSION['userid'])){
    echo "<p>To finalize your order: <a href='checkout.php'>Checkout</a></p>";
}else{
    echo "<p>New Homteq customer: <a href='signup.php'>Sign up</a></p>";
    echo "<p>Returnning Homteq customer: <a href='login.php'>Login</a></p>";
}
echo "</body>";
?>
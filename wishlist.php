<?php
session_start();


$pagename="Your Wish list"; //Create and populate a variable called $pagename

echo "<link rel=stylesheet type=text/css href=styleSheet.css>"; //Call in stylesheet

echo "<title>".$pagename."</title>"; //display name of the page as window title

echo "<body>";

include ("detectLogin.php"); 
if(isset($_SESSION['user']['userid'])){
    echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

    // should be changed according to the name that is passed when the delete button is selected
    if (isset($_POST['wishlistprodid'])){
        unset($_SESSION['wishlist'][$_POST['wishlistprodid']]);
        echo "1 item removed";
    }

    //getting passed from another page
    if((isset($_POST['h_showid']))){
        $newshowid=$_POST['h_prodid']; //to get the product id
        $requantity=$_POST['p_quantity'];//to get the product quantity
        $userid = $_SESSION['user']['userid'];
        $prodName;
        $prodPrice;
        //data retrieval evalaccording to PDO
        include('db.php');

        $statement1 = $conn->prepare("SELECT showName, price FROM shows WHERE showId = $newshowid");
        $statement1->execute();
        
        // get all:
        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result1 as $row){
            foreach($row as $col_name => $val)
                {
                    if($col_name == 'showName'){
                        $prodName = $val;
                    }elseif($col_name == 'price'){
                        $prodPrice = $val;
                    }
                }
            }

        $prepared_statement1 = $conn->prepare("INSERT INTO  wishlist (userId, showId, showName, qty, price) VALUES ( :userId, :showId, :showName, :qty, :prodPrice)");
        $prepared_statement1->execute(['userId' => $userid, 'showId' => $newprodid, 'showName' => $prodName, 'qty' => $requantity, 'price' => $prodPrice]);

        $prepared_statement1->execute();

        $_SESSION['wishlist'][$newprodid]=$requantity;
        //echo "<p>The doc id ".$newdocid." has been ".$_SESSION['basket'][$newdocid];
        echo "<p>1 item added to the wishlist</p>";
    }
    else if(!isset($_SESSION['wishlist']))
        echo "<p>Current wishlist unchanged </p>";
        
    $total=0;

        //adding the wishlist data to the session
        echo "<table>";
        echo "<tr>";
        echo "<th>Product Name</th>";
        echo "<th>Price</th>";
        echo "<th>Quantity</th>";
        echo "<th>Sub Total</th>";
        echo "<th></th>";
        echo "</tr>";
    if (isset($_SESSION['wishlist'])){

        foreach ($_SESSION['wishlist'] as $index => $value){

            //data retrieval evalaccording to PDO
            include('db.php');
            $statement = $conn->prepare("SELECT showId, showName, price FROM shows WHERE showId = $index");
            $statement->execute();
            $prodName1;
            $prodPrice1;
            // get all:
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row){
                echo "<tr>";
                foreach($row as $col_name => $val)
                 {
                    if($col_name == 'showName'){
                        echo "<td>".$val."</td>";
                        $prodName1 = $val;
                    }elseif($col_name == 'price'){
                        echo "<td>".$val."</td>";
                        $prodPrice1 = $val;
                    }

                 }
                 echo "<td>".$value."</td>";
                 $subtotal=$value*$prodPrice1;
                 $GLOBALS['total']+=$subtotal;
                 echo "<td>".$subtotal."</td>";
                 echo "<td>";
                 echo "<form action='wishlist.php' method='post'>";
                 echo "<button type='submit'>Remove from wishlist</button>";
                 echo "<input type='hidden' name='wishlistprodid' value='$index'>";
                 echo "</form>";
                 echo "</td>";
                 echo "</tr>";
                echo"Next Row<br />";
             }

        }

    }
    function removeitem(){
        unset($_SESSION['wishlist'][$_post['prodid']]);
    }

    echo "<tr>";
    echo "<td colspan='3'>Total</td>";
    echo "<td>".$GLOBALS['total']."</td>";
    echo "<td></td>";
    echo "</tr>";
    echo "</table>";

    echo "<a href='clearwishlist.php'>CLEAR WISHLIST</a>";
    echo "<br>";
    
}
else{
	echo "<p>Please login or sign up to the system before you add items to the Wishlist</p>";
    echo "<p>New Hometeq customers: <a href='signup.php'>Sign up</a></p>"; //to sign up to the system
    echo "<p>Returning Hometeq customers: <a href='login.php'>Login</a></p>"; //to login to the system
}

echo "</body>";
?>
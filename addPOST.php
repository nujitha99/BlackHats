<?php

echo "<form action='wishlist.php' method='post'>";
$showid = 1;	

echo "<select name='p_quantity'>";
$counter=0;
while ($counter<=50){
    echo "<option value='$counter'>$counter</option>";
    $counter+=1;
}
echo "</select>";
    
echo "<input type=submit value='ADD TO WISHLIST'>";
//pass the product id to the next page basket.php as a hidden value
echo "<input type=hidden name='h_prodid' value='$showid'>";
echo "</form>";


// echo "<form action='wishlist.php' method='post'>";
// echo "<button type='submit'>Remove from wishlist</button>";
// echo "<input type='hidden' name='wishlistprodid' value='$index'>";
// echo "</form>";

?>
<?php
function bookCard($thumb, $name, $price, $bookid , $incart, $isbuyed, $booklink){
    
    echo "<div class='book-item-card'>
        <a class='book-item-dtl' href='bookdetail.php?bookid=$bookid'>
            <img class='bookthumbimg' src='$thumb' height='200px' width='150px' draggable='false'>
            <b class='bookname'>$name</b>
        </a><label style='color: green;font-size:15px;'><b>";
    if($price == 0) echo "Free";
    else{
        if($isbuyed) echo "Purchased";
        else echo "&#8377 $price"; 
    }
    echo "</b></label><div class='bookactions'>";
    if(!$isbuyed and $price != 0){
        if(!$incart)
            echo "<button style='width:100%;' class='secbtn'>
                <a href='UserHome.php?addcart=$bookid'>Add to Cart</a>
            </button>";
        else
            echo "<p><p>";
        echo "<button class='primarybtn'><a href='payment.php?solo=$bookid'>Buy</a></button>";
    }
    else
        echo "<button class='primarybtn jucent' style='width:100%;'><a href='$booklink' target='_blank'>Open</a></button>";

    echo "</div></div>";
}
?>
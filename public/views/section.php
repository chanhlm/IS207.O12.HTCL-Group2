<?php
    if(isset($_GET['link'])){
        $link = $_GET['link'];
    }
    else{
        $link = 'homepage';
    }
    if($link == "product"){
        include("./product.php");
    }
    elseif($link == "cart"){
        include("./cart.php");
    }
    else{
        include("./homepage.php");
    }
    ?>
<?php 
    $rand = rand(1,2);
    
    if($rand == 1){
        header("location: Home");
        exit;
    }
    elseif($rand == 2){
        header("location: Shop");
        exit;
    }
?>
    
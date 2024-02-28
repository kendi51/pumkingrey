<?php

$title = "Welcome To Dashboard: Pumkin";
$page = "";
require "../php/components.php";
include_once "adminHeader.php";

$sql = "SELECT * FROM users;";

$results = mysqli_query($conn, $sql);
$resultsCheck = mysqli_num_rows($results);
$count = 0;

if($resultsCheck > 0){

	while($row = mysqli_fetch_assoc($results)){
	 $count++;   
	}
}
$i=0;
$found = false;
$countUsers = 0;
$orders = 0;
$usersArr = array();
$findUser = array();
$sql = "SELECT * FROM pumkinorderdetails;";

$results = mysqli_query($conn, $sql);
$resultsCheck = mysqli_num_rows($results);
$total = 0;
$tax = 0;
if($resultsCheck > 0){

    while($row = mysqli_fetch_assoc($results)){
        if($countUsers == 0){
            array_push($findUser, $row['userId']);
        }
    	$orders++;
    	$total+=$row['orderTotalPrice'];
    	 
        array_push($findUser, $row['userName']);
    	array_push($usersArr, $row['userName']);
    	$arrayCount = count($usersArr);
    	if($arrayCount == 0){
    	    $countUsers++;
    	    array_push($usersArr, $findUser);
    	    $found = true;
    	}
    	
    	while($i<$arrayCount){
    	    if(strcasecmp($findUser[$i],$usersArr[$i]) == 0){
    	        $found = true;
    	    }
        	$i++;
    	}
    	if(!$found){
    	    $countUsers++;	    
        } 
	}
}
$tax = $total * 0.15;

$totalCost = $total - $tax - ($total * 0.20);
$totalP = $total * 0.20;
?>


    <div class="container-fluid bg-dark">
        <!-- Page Heading -->
        <div class="col-12 text-center py-3">
            <h3>D A S H B O A R D</h3>
        </div>
                   
        <!-- CATEGORIES -->
        <div class="col-12">
            <div class="row text-center">

                <div class='col-6 col-md-3 col-lg-3 py-3'>
                    <div class='px-3 py-5 gradient'>
                        <a class='' href='orders.php'>
                            <h1 class='text-warning pb-2'><?php echo $count; ?> <i class="fas fa-file-contract"></i></h1>
                            <span class='text-white'>Total Accounts</span>
                        </a>
                    </div>
                </div>


                <div class='col-6 col-md-3 col-lg-3 py-3'>
                    <div class='px-3 py-5 gradient'>
                        <a class='' href='users.php'>
                            <h1 class='text-warning pb-2'>6<?php //echo $countUsers; ?> <i class='fas fa-users'></i></h1>
                            <span class='text-white'>Buying Users</span>
                        </a>
                    </div>
                </div>


                <div class='col-6 col-md-3 col-lg-3 py-3'>
                    <div class='px-3 py-5 gradient'>
                        <a class='' href='productHandler.php'>
                            <h1 class='text-warning pb-2'><?php echo $orders; ?> <i class="fa-solid fa-cart-arrow-down"></i></h1>
                            <span class='text-white'>Total Orders</span>
                        </a>
                    </div>
                </div>


                <div class='col-6 col-md-3 col-lg-3 py-3'>
                    <div class='px-3 py-5 gradient'>
                        <a class='' href='returns.php'>
                            <h1 class='text-warning pb-2'>0 <i class="fa fa-rotate-left mx-1"></i></h1>
                            <span class='text-white'>Total Returns</span>
                        </a>
                    </div>
                </div>
                
                <div class='col-6 col-md-3 col-lg-3 py-3 text-center'>
                    <div class='px-3 py-5 gradient'>
                        <a class='' href='orders.php'>
                            <h4 class='text-warning pb-2'><i class="fa-solid fa-store fa-lg"></i><br/><?php echo "R ".number_format($totalCost, 2); ?></h4>
                            <span class='text-white'>Suppliers Total</span>
                        </a>
                    </div>
                </div>

                <div class='col-6 col-md-3 col-lg-3 py-3 text-center'>
                    <div class='px-3 py-5 gradient'>
                        <a class='' href='orders.php'>
                            <h4 class='text-warning pb-2'><i class="fa-solid fa-scale-balanced fa-lg"></i><br/><?php echo "R ".number_format($tax, 2); ?></h4>
                            <span class='text-white'>Total Tax</span>
                        </a>
                    </div>
                </div>

                <div class='col-6 col-md-3 col-lg-3 py-3 text-center'>
                    <div class='px-3 py-5 gradient'>
                        <a class='' href='orders.php'>
                            <h4 class='text-warning pb-2'><i class="fas fa-dollar-sign fa-lg" style='text-align: center'></i><br/><?php echo "R ".number_format($total, 2); ?></h4>
                            <span class='text-white'>Total Revenue</span>
                        </a>
                    </div>
                </div>
                
                <div class='col-6 col-md-3 col-lg-3 py-3 text-center'>

                    <div class='px-3 py-5 gradient'>

                        <a class='' href='orders.php'>
                            <h4 class='text-warning pb-2'><i class="fas fa-sack-dollar fa-lg" style='text-align: center'></i><br/><?php echo "R ".number_format($totalP, 2); ?></h4>
                            <span class='text-white'>Total Profit</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
	include_once 'adminFooter.php';
?>
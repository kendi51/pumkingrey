<?php
session_start();
include_once '../includes/dbh.inc.php';

// if(isset($_SESSION['useruid']) && isset($_POST['orderId'])){

//     if($_SESSION['useruid'] == 'admin'){

        $orderId = $_POST['orderId'];

            $sql = "UPDATE pumkinorderdetails SET paymentSuccess = 'Order Placed'
            WHERE id = $orderId;";
                
            $results = $conn->query($sql);

            if(!$results) {
                header("location: orders.php?error=stmtfailed2");
                exit();
            }

            header('location: orders.php?error=none');
            exit;
//     }
//     else{
//         header('location : ../orders.php');
//         exit;
//     }
// }
// else{
//     header('location : ../profile.php');
//     exit;
// }
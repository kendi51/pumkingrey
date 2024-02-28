<?php

$orderId = 211;
//$toEmail = $email;
$title = 'Successful Payment: Pumkin';
include_once 'emailHeader.php';

$db = new CreateDb("u843931047_productdb", "producttb"); //online db
// $db = new CreateDb("Productdb", "Producttb"); //local db
    
// COLLECTING ORDER INFO
$sql = "SELECT * FROM pumkinorderdetails WHERE id = $orderId;";
$results = mysqli_query($conn, $sql);
$resultsCheck = mysqli_num_rows($results);
while($row = mysqli_fetch_assoc($results)){
    if($row['id'] == $orderId){
        $userName = $row['userName'];
        $userId = $row['userId'];
        $orderRef = $row['orderRef'];
		$totalPrice = $row['orderTotalPrice'];
		$delAddress = $row['deliveryAddress'];
		$paySuccess = $row['paymentSuccess'];
		$newDate = date('d-m-Y', strtotime($row['dateOfTrans']));
		$cart = $row['orderContent'];
    }
}

?>

<?php
session_start();

if(isset($_SESSION['cart']) && isset($_SESSION['useruid'])){

include_once 'php/createDb.php';
include_once 'php/components.php';
include_once 'includes/functions.inc.php';
include_once 'includes/dbh.inc.php';
include_once "admin/in.db.php";
$indb = new CreateDb("u843931047_productdb", "inventorytb"); // Local db

$db = new CreateDb("u843931047_productdb", "producttb"); //online db
// $db = new CreateDb("Productdb", "Producttb"); //local db

// UPDATING USER ADDRESS
$street = $_GET['street'];
$suburb = $_GET['suburb'];
$city = $_GET['city'];
$province = $_GET['province'];
$postalCode = $_GET['postalCode'];

if(emptyInputSignup($street, $suburb, $city, $province, $postalCode)){
  echo  $street."#".$suburb."#".$city."#".$province."#".$postalCode;
  exit;
}

$saveAddress = $street."#".$suburb."#".$city."#".$province."#".$postalCode;

updateUserAddress($conn, $_SESSION['useruid'], $saveAddress);

// LOADING USER VARIABLES
$uid = $_SESSION["useruid"];
$sql = "SELECT * FROM users WHERE usersUid = ?;";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: users.php?error=stmtfailed");
    exit();
}
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);


while($row = mysqli_fetch_assoc($resultData)){
  $phoneNumber = $row['usersPhoneNum'];
  $email = $row['usersEmail'];
  $name = $row['usersName'];
  $address = $row['usersBillingAddress'];
}
// ORDER VARIABLES

if($_SESSION['total'] > 750) {
  $_SESSION['delivery'] = "<p><font color=green>FREE</font></p>";
  
}
// elseif(strcasecmp('cape town', $city) == 0){
//   $_SESSION['total'] += 100;
//   $_SESSION['delivery'] = "R 100";
// }
else{
  $_SESSION['total'] += 100;
  $_SESSION['delivery'] = "R 100";
} 

$orderContent = serialize($_SESSION['cart']);
$time = date('Y-m-d H:i:s');


// INVENTORY PROCESSING 

$product_id = array_column($_SESSION['cart'], 'product_id');
$size = array_column($_SESSION['cart'], 'size');

$results = $indb->getData();
while($row = mysqli_fetch_assoc($results)){
foreach($product_id as $id){
  if($row['product_id'] == $id){
  $i = array_search($row['product_id'], $product_id);
  if($row['size_type'] == 1){
    
    $sizeName = "size" . $size[$i];
    $sizeQty =  $row[$sizeName];
    $newSizeQty = $sizeQty - 1;
    // if()
    // print_r($sizes);
    $sql = "UPDATE inventorytb 
    SET $sizeName = '$newSizeQty' 
    WHERE product_id = '$id';";

    $checkResults = mysqli_query($in_db, $sql);

  }
  elseif($row['size_type'] == 2){

    $sizeName = strtolower($size[$i]);
    $sizeQty =  $row[$sizeName];
    $newSizeQty = $sizeQty - 1;
    // if()
    // print_r($sizes);
    $sql = "UPDATE inventorytb 
    SET $sizeName = '$newSizeQty' 
    WHERE product_id = '$id';";

    $checkResults = mysqli_query($in_db, $sql);
  }
  else{
    echo "ERROR FINDING INVENTORY!!!";
  }
  }
}
}

// END OF INVENTORY PROCESSING 



// LOADING ORDER INTO DB
$pSuccess = null;
if(!orderExists($conn, $orderContent, $_SESSION['userid'])){
  if(orderExists($conn, $orderContent, $_SESSION['userid'])){
    echo "
      <script>
        alert('<h5>This order has been created. View your profile and check your order</h5>');
      </script>
    ";
  }
  else{

      $sql = "INSERT INTO pumkinOrderDetails (orderRef, userId, userName, orderContent, orderTotalPrice, deliveryAddress, dateOfTrans) VALUES (?, ?, ?, ?, ?, ?, ?);";

      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt, $sql)){
          header("location: checkout.php?error=stmtfailed");
          exit();
      }

      mysqli_stmt_bind_param($stmt, "sssssss", $_SESSION['orderRef'], $_SESSION['userid'], $name, $orderContent, $_SESSION['total'], $address, $time);
      mysqli_stmt_execute($stmt);

      unset($_SESSION['cart']);
      unset($_SESSION['cartFound']);
      deleteCart($conn, $uid);
      mysqli_stmt_close($stmt);
    
  }
}

  //** START OF CHECKOUT PAGE!!!!! */
  //******************************************************* */ 
  /**
  * @param array $data
  * @param null $passPhrase
  * @return string
  */
  function generateSignature($data, $passPhrase) {
    // Create parameter string
    $pfOutput = '';
    foreach( $data as $key => $val ) {
        if($val !== '') {
            $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
        }
    }
    // Remove last ampersand
    $getString = substr( $pfOutput, 0, -1 );
    if( $passPhrase !== null ) {
        $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
    }
    return md5( $getString );
  }
  // GETTING ORDER ID FROM PUMKIN ORDER DETAILS
    $orderExists = orderExists($conn, $orderContent, $_SESSION['userid']);
    $orderId = $orderExists['id'];
	$cart = $orderExists['orderContent'];
	
	// SETTING ORDER ID FOR SUCCESS PAGE
    $_SESSION['orderId'] = $orderId;
      
    $title = 'Your Order Is Ready: PumkinGrey';

    include_once 'header.php';

  // $db = new CreateDb("id20059711_productdb", "producttb");

  // $serverName = "localhost";
  // $dBUserName = "id20059711_pumkingrey";
  // $dBPassword = "(q]iqtdsBk+2S6/*";
  // $dBName = "id20059711_pumpkin_users";


  carousel($text1, $text2);

  // USER DETAILS INSIDE FORM
  ?>
  <div class="container-fluid text-left">
    <div class="row">
      <div class="col-lg-12 mt-3">
          <h2 class="text-center">Finalizing Your Order <i class="fas fa-shopping-cart"></i></h2>
          <hr>
      </div>

    <div class="shopping-cart col-lg-7 col-md-7">
    <form class="needs-validation" action='users.php'  method='POST'>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Full name</label>
                <input type="text" class="form-control" id="firstName" placeholder="Full Name" value="<?php echo $name; ?>" disabled>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phoneNum">Phone Number</label>
                <div class="input-group">
                <input type="text" class="form-control" id="phoneNum" value="<?php echo $phoneNumber; ?>" disabled>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email </label>
              <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
            </div>
            
  </form>

  <!-- START OF PAYMENT FORM -->
  <!-- PAYMENT DETAILS -->

  <?php
                    $uid = $_SESSION["useruid"];
                    $sql = "SELECT * FROM users WHERE usersUid = ?;";
                
                    $stmt = mysqli_stmt_init($conn);
                
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("location: checkout.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt, "s", $uid);
                    mysqli_stmt_execute($stmt);
                
                    $resultData = mysqli_stmt_get_result($stmt);
                
                
                    $row = mysqli_fetch_assoc($resultData);
                    
                    $nameStrArray = explode(" ", $row['usersName']);
                    if(count($nameStrArray)>2) {
                      $firstName = $nameStrArray[0]." ".$nameStrArray[1];
                      $lastName = $nameStrArray[2]; 
                    }
                    elseif(count($nameStrArray)>3){
                      $firstName = $nameStrArray[0]." ".$nameStrArray[1];
                      $lastName = $nameStrArray[2]." ".$nameStrArray[3];
                    }
                    else{
                      $firstName = $nameStrArray[0];
                      $lastName = $nameStrArray[1]; 
                    }
                    // ORDER NUMBERS/DETAILS
                    $orderNum = $_SESSION['orderNum'];
                    $orderRef = $_SESSION['orderRef'];

                    // Construct variables
                    $cartTotal = $_SESSION['total']; // This amount needs to be sourced from your application
                    $passphrase = 'NkoSiYomZi20May7519'; //'TestpUmKintEst';
                    $data = array(
                        // Merchant details
                        'merchant_id' => '21730041', // - sand - 10028383
                        'merchant_key' => 'smrdos4s88cna', // sand - chts2w118450h
                        'return_url' => 'https://pumkingrey.com/success.php',
                        'cancel_url' => 'https://pumkingrey.com/orders.php',
                        'notify_url' => 'https://pumkingrey.com/notify.php',
                        // Buyer details
                        'name_first' => $firstName,
                        'name_last'  => $lastName,
                        'email_address'=> $row['usersEmail'],
                        // Transaction details
                        'm_payment_id' => $orderId, //Unique payment ID to pass through to notify_url
                        'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', '' ),
                        'item_name' => $orderRef
                    );

                    $signature = generateSignature($data, $passphrase);
                    $data['signature'] = $signature;

                    // If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
                    $testingMode = false;
                    $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
                    $htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post">';
                    foreach($data as $name=> $value)
                    {
                        $htmlForm .= '<input name="'.$name.'" type="hidden" value=\''.$value.'\' />';
                    }
                    $htmlForm .= '<button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</buttom>';
  ?>
  <!-- END OF PAYMENT DETAILS -->
  <!-- START OF ADDRESS SORTING -->
  <?php
    $addressArray = explode("#", $address);
    $street = $addressArray[0];
    $suburb = $addressArray[1];
    $city = $addressArray[2];
    $province = $addressArray[3];
    $postalCode = $addressArray[4];

  ?>
  <!-- END OF ADDRESS SORTING -->

            <div class="mb-3">
              <label for="address" class="text-right">Delivery Address</label>
              <input type="text" class="form-control" name="street" value="<?php echo $street; ?>" disabled>
            </div>

            <div class="mb-3">
              <label for="suburb">Suburb </label>
              <input type="text" class="form-control" name="suburb" value="<?php echo $suburb; ?>" disabled>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" disabled>
              </div>
              <div class="col-md-4 mb-3">
                <label for="province">Province</label>
                <input type="text" class="form-control" name="province" value="<?php echo $province; ?>" disabled>
              </div>
              <div class="col-md-3 mb-0">
                <label for="zip">Postal Code</label>
                <input type="text" class="form-control" name="postalCode" value="<?php echo $postalCode; ?>" disabled>
              </div>
            </div>
          </div>

          <div class="col-lg-5 col-md-5">

          <div class="border rounded bg-white px-2 mb-4 mt-4">
            <h3 class='heading text-center mt-1'>summary</h3>
            <h5 class="para text-center" style="text-transform: uppercase"><?php echo $orderRef ?></h5>
            <hr>
              <div class="">

                <?php
                    $cart = unserialize($cart);
                    $total = 0;
                    $product_id = array_column($cart, 'product_id');
                    $size = array_column($cart, 'size');

                    $results = $db->getData();
                    while($row = mysqli_fetch_assoc($results)){
                      foreach($product_id as $id){
                        if($row['id'] == $id){
                          //$qty = $_POST['qty-input'];
                          checkOutElement($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);
                          $total += $row['product_price'];
                        }
                      }
                    }

                ?>

                <div class="p-2">

                  <div class="row">
                    <div class="col-8 mt-2">
                      <h6>Delivery: </h6>
                      <hr>
                    </div>
                    <div class="col-4 mt-2">
                      <h6>
                        <?php echo $_SESSION['delivery']; ?>
                        </h6>
                        <hr>
                    </div>

                

                    <div class="col-8">
                      <h4>Total: </h4>
                    </div>
                    <div class="col-4">
                      <h5 id="totalPrice">R <?php echo number_format($_SESSION['total'], 2); ?></h5>
                    </div>

                  </div>
                </div>
                

              </div>

        </div>

            <!-- PAYMENT OPTION -->
            <div class="d-block mb-2">
              <div class="custom-radio">
               <img class="img-fluid w-100" src="images/payFast/PayFast_Images/720x90.png" alt="PayFast_Banner">
              </div>
            </div> 

            <?php echo $htmlForm; ?> 
          </div>

      </div>

      <div class='col-lg-5 col-md-5 mt-4'>
        
      </div>
    </div>
  </div>
  <?php

  include_once 'footer.php';
}
else{
  header('location: Homepage.php');
  exit;
}
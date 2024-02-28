<?php
session_start();

include_once 'php/createDb.php';
include_once 'php/components.php';
include_once 'includes/functions.inc.php';
include_once 'includes/dbh.inc.php';

$db = new CreateDb("u843931047_productdb", "producttb"); //online db
// $db = new CreateDb("Productdb", "Producttb"); //local db

// Local db
// $serverName = "localhost";
// $dBUserName = "root";
// $dBPassword = "";
// $dBName = "pumpkin_users";

// Online db
$serverName = "localhost";
$dBUserName = "u843931047_pumkingrey";
$dBPassword = "G2O9+euM^c;";
$dBName = "u843931047_pumpkin_users";
              
$conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);

if(isset($_SESSION['cart'])){

  if(isset($_SESSION['useruid'])) {

      $title = 'Ready To Order?: Pumpkin';
      include_once 'header.php';

    

      carousel($text1, $text2);

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
?>
      <div class="container-fluid text-left">
        <div class="row">
          <div class="col-lg-12 mt-3 text-center signup-link link">
              <h2 class="">Delivery Details <i class="fas fa-shopping-cart"></i></h2>
              <hr>
              <?php
                // ORDER NUMBERS/DETAILS           
                if(!orderExists($conn, serialize($_SESSION['cart']), $_SESSION['userid'])){
                    
                  $pre = "pg";
                  $_SESSION['orderNum'] = rand(1000000, 9999999);
                  $_SESSION['orderRef'] = $pre.$_SESSION['orderNum'];
                }
                elseif(orderExists($conn, serialize($_SESSION['cart']), $_SESSION['userid'])){
                  
                  $pre = "pg";
                  $_SESSION['orderNum'] = rand(1000000, 9999999);
                  $_SESSION['orderRef'] = $pre.$_SESSION['orderNum'];
                  echo "<font color='#ffc107'><h6>This order exist, if it is not a duplicate order please continue.</h6></font>";
                  echo "If it is a duplicate, please <a href='/Orders'>Click here.</a>";
                }
              ?>
          </div>

        <div class="shopping-cart col-lg-6 col-md-6">
        <form action='/Profile'  method='POST'>
                <div class="row">
                  <div class="col-md-6 mb-4 ">
                    <label for="firstName">Full name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="Full Name" value="<?php echo $row['usersName']; ?>" disabled>
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 ">
            <label for="username">Username</label>
            <div class="input-group">
              <input type="text" class="form-control" id="username" value="<?php echo $row['usersUid']; ?>" disabled>
              <div class="invalid-feedback" style="width: 100%;">
              Your username is required.
              </div>
            </div>
          </div>
        </div>
           
                <div class="mb-3 pt-2">
                 <div class="row">
                   <div class="col-6">
                    <label for="phoneNum">Phone Number</label>
                   </div>
                   <div class="col-6">
                    <label for="phoneNum">
                    <?php
                        if(strlen($phoneNumber)< 10){
                            echo "<p><font color=red>Update Phone Number...</font></p>";
                        }
                    ?>
                </label>
                   </div>
                 </div>
                 
                  <div class="input-group">
                    <input type="text" class="form-control" id="phoneNum" value="<?php echo $row['usersPhoneNum']; ?>" disabled>
                    <div class="invalid-feedback" style="width: 100%;">
                      Your username is required.
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="email">Email </label>
                  <input type="email" class="form-control" id="email" value="<?php echo $row['usersEmail']; }?>" disabled>
                  <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                  </div>
                </div>
                
          <button  class='btn btn-outline-primary mx-auto justify-content-right' name='editUser'>Update User Info</button>
        </form>
        </div>

        <div class="shopping-cart col-lg-6 col-md-6">

          <form action="/Checkout" methoud="POST">
                  <?php
                  
                    if($_SESSION['address'] == null){
                  ?>
                  <div class="mb-4">
                    <label  class="text-right">Delivery Address</label>
                    <input type="text" class="form-control" name="street" placeholder="1234 Main St" required="">
                  </div>

                  <div class="mb-3 pt-2">
                    <label >Suburb </label>
                    <input type="text" class="form-control" name="suburb" placeholder="Suburb">
                  </div>

                  <div class="row">
                    <div class="col-md-5 mb-0">
                      <label >City</label>
                      <input type="text" class="form-control" name="city" placeholder="" required="">
                    </div>
                    
                    <div class="col-md-4 mb-0">
                      <label >Province</label>
                      <select class="custom-select d-block w-100 mt-0" name="province" required="">
                        <option value="none">Choose...</option>
                        <option value="Eastern Cape">Eastern Cape</option>
                        <option value="Free State">Free State</option>
                        <option value="Gauteng">Gauteng</option>
                        <option value="KwaZulu-Natal">KwaZulu-Natal</option>
                        <option value="Limpopo">Limpopo</option>
                        <option value="Mpumalanga">Mpumalanga</option>
                        <option value="North West">North West</option>
                        <option value="Northern Cape">Northern Cape</option>
                        <option value="Western Cape">Western Cape</option>
                      </select>
                    </div>
                    <div class="col-md-3 mb-0">
                      <label>Postal Code</label>
                      <input type="text" class="form-control" name="postalCode" placeholder="" required="">
                    </div>
                  </div> 

      <?php
                 
                  }
                  else{
                    $addressArray = explode("#", $_SESSION['address']);
                    $street = $addressArray[0];
                    $suburb = $addressArray[1];
                    $city = $addressArray[2];
                    $province = $addressArray[3];
                    $postalCode = $addressArray[4];

                  ?>
                  <div class="mb-4">
                    <label for="address" class="text-right">Delivery Address</label>
                    <input type="text" id="addr" class="form-control" name="street" value="<?php echo $street; ?>">
                  </div>
        
                  <div class="mb-3 pt-2">
                    <label for="suburb">Suburb </label>
                    <input type="text" id="addr" class="form-control" name="suburb" value="<?php echo $suburb; ?>">
                  </div>
        
                  <div class="row mb-3">
                    <div class="col-md-5 mb-0 ">
                      <label for="city">City</label>
                      <input type="text" id="addr" class="form-control" name="city" value="<?php echo $city; ?>">
                    </div>

                    <div class="col-md-4 mb-0">
                      <label >Province</label>
                      <select class="custom-select d-block w-100 mt-0" id="addr" name="province" required="">
                        <option value="<?php echo $province; ?>"><?php echo $province; ?></option>
                        <option value="Eastern Cape">Eastern Cape</option>
                        <option value="Free State">Free State</option>
                        <option value="Gauteng">Gauteng</option>
                        <option value="KwaZulu-Natal">KwaZulu-Natal</option>
                        <option value="Limpopo">Limpopo</option>
                        <option value="Mpumalanga">Mpumalanga</option>
                        <option value="North West">North West</option>
                        <option value="Northern Cape">Northern Cape</option>
                        <option value="Western Cape">Western Cape</option>
                      </select>
                    </div>

                    <div class="col-md-3">
                      <label for="postalCode">Postal Code</label>
                      <input type="text" id="postalCode" class="form-control" name="postalCode" value="<?php echo $postalCode; ?>">
                    </div>
                  </div>
                

                  <?php
                  }

                  

                  ?>

                  <button  class='btn btn-outline-success' name='submit'>Save Address</button>
            </form>
          </div>
        </div>
      </div>

      <?php
      
      include_once 'footer.php';
                
    }


	else{
		header("location: Login");
        exit();
	}
}
else{
  header("location: Home");
  exit();
}
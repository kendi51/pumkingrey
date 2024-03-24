<?php


function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result;
    if(empty($name) || empty($email)|| empty($username)|| empty($pwd)|| empty($pwdRepeat)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUid($username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdLength($pwd){
    if(strlen($pwd) < 8) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result;
    if($pwd !== $pwdRepeat){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }

    else {
        $results = false;
        return $results;
    }

    mysqli_stmt_close($stmt);
}

function uidExistsReset($conn, $email){

    $sql = "SELECT * FROM users WHERE usersEmail = ?;";


    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../forgotPassword.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }

    else {
        $results = false;
        return $results;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn,$name, $email, $username, $pwd){
    $sql = "INSERT INTO users (usersName,usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($email, $pwd){
    $result;
    if(empty($email)|| empty($pwd)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
function loginUser($conn, $email, $pwd, $location){
    $uidExists = uidExists($conn, $email, $email);
    

    if($uidExists === false){
        header("location: ../login.php?error=wrongLogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false){
        header("location: ../login.php?error=wrongPassword");
        exit();
    }
    elseif($checkPwd === true){
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        $_SESSION["username"] = $uidExists["usersName"];
        $_SESSION["address"] = $uidExists["usersBillingAddress"];
        $_SESSION['l_l_time'] = time();
        $_SESSION['cartFound'] = unserialize($uidExists["usersCart"]);
        $_SESSION["accType"] = $uidExists["usersAccType"];

        if($_SESSION['cartFound'] == null){
            unset($_SESSION['cartFound']);
        }

        if(strcasecmp($_SESSION['accType'], "admin") == 0){
            header("location: /Admin/Dashboard");
            exit();
        }
        elseif(empty($location)) {
            header("location: /Home");
            exit();
        }
        else{
            header("location: $location");
            exit();
        }
    }

}

function updateCart($conn, $uid, $cart){
    if(isset($_SESSION['useruid'])){
        $cart = serialize($cart);

        $sql = "UPDATE users SET usersCart = '$cart'
        WHERE usersUid = '$uid';";

        $results = $conn->query($sql);

        if(!$results) {
            echo "
                <script>
                    alert('There was an error saving cart');
                </script>
            ";
        }
    }
}

function deleteCart($conn, $uid){
    if(isset($_SESSION['useruid'])){

        $sql = "UPDATE users SET usersCart = null
        WHERE usersUid = '$uid';";

        $results = $conn->query($sql);

        if(!$results) {
            echo "
                <script>
                    alert('There was an error saving cart');
                </script>
            ";
        }
    }
}
function updateUserAddress($conn, $uid, $address){

    $sql = "UPDATE users SET usersBillingAddress = '$address'
    WHERE usersUid = '$uid';";

    $results = $conn->query($sql);

    if(!$results) {
        echo "
            <script>
                alert('There was an error saving address');
            </script>
        ";
    }
}

function orderExists($conn, $cart, $userId){
    $sql = "SELECT * FROM pumkinorderdetails WHERE orderContent = ? AND userId = ?;";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: checkout.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $cart, $userId);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){

        return $row;
    }

    else {
        $results = false;
        return $results;
    }

    mysqli_stmt_close($stmt);
}

function checkOrders($conn, $currntTime){
    $indb = new CreateDb("u849136244_pumkin_grey", "inventorytb"); // Local db
    
    // DB CONNECTION
    $serverName = "srv1350.hstgr.io";
    $dBUserName = "u849136244_pumkingrey";
    $dBPassword = "G2O9+euM^c;";
    $dBName = "u849136244_pumkin_grey";
    
    $in_db = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);
    
    if(!$in_db){
        die("Connection Failed: " . mysqli_connect_error());
    }
    // END OF DB CONNECTION
    
    $sql = "SELECT * FROM pumkinOrderDetails;";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: checkout.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    while($row = mysqli_fetch_assoc($resultData)){

        $timeOrderPlaced = strtotime($row['dateOfTrans']);
        // echo $currntTime - $timeOrderPlaced;echo "<br/>";
        if(($currntTime - $timeOrderPlaced) > 200 && $row['paymentSuccess'] == null){
            unset($_SESSION['orderId']);
            $orderId = $row['id'];
            
            
            // INVENTORY PROCESSING 
            $_SESSION['cartInv'] = unserialize($row["orderContent"]);
            
            $product_id = array_column($_SESSION['cartInv'], 'product_id');
            $size = array_column($_SESSION['cartInv'], 'size');
            
            $results = $indb->getData();
            while($row = mysqli_fetch_assoc($results)){
                foreach($product_id as $id){
                    if($row['product_id'] == $id){
                    $i = array_search($row['product_id'], $product_id);
                        if($row['size_type'] == 1){
                            
                            $sizeName = "size" . $size[$i];
                            $sizeQty =  $row[$sizeName];
                            $newSizeQty = $sizeQty + 1;
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
                            $newSizeQty = $sizeQty + 1;
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
            
            
            $sql = "DELETE FROM pumkinorderdetails 
            WHERE id = '$orderId';";

            $results = $conn->query($sql);

            if(!$results) {
                header("location: Homepage.php?id=$id&error=stmtfailed");
                exit();
            }
            unset($_SESSION['cartInv']);
        }
    }
}

function isNullFound($resultData){
    while($row = mysqli_fetch_assoc($resultData)){
        if($row['paymentSuccess'] == null){
            $found = $row;
        }
    }
    if($found){
        return $found;
    }
    else{
        return false;
    }
}
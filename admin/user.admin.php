<?php
session_start();

if(isset($_POST['changePassword'])) {
    $uid = $_SESSION["useruid"];

    $current = $_POST['currentPassword'];
    $newPass = $_POST['newPassword'];
    $confirmPass = $_POST['confirmPassword'];

    require_once '../includes/dbh.inc.php';
    require_once '../includes/functions.inc.php';


    $sql = "SELECT * FROM users WHERE usersUid = ?;";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../users.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $uid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($resultData);

    $pwdHashed = $row["usersPwd"];
    $checkPwd = password_verify($current, $pwdHashed);

    if($checkPwd === false){
        header("location: ../users.php?error=wrongPassword");
        exit();
    }
    if(pwdLength($newPass) !== false){
        header("location: ../users.php?error=passwordshort");
        exit();
    }

    if(pwdMatch($newPass, $confirmPass) !== false) {
        header("location: ../users.php?error=passworddontmatch");
        exit();
    }
    $hashedPwd = password_hash($newPass, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET usersPwd = '$hashedPwd' WHERE usersUid = '$uid';";

    $results = $conn->query($sql);

    if(!$results) {
        header("location: ../users.php?error=stmtfailed2");
        exit();
    }
    
    header("location: ../users.php?error=none");
    exit();
 }

 elseif(isset($_POST['updateUser'])) {
    $uid = $_SESSION["useruid"];

    $name = rtrim($_POST['name']);
    $email = rtrim($_POST['email']);
    $phoneNum = rtrim($_POST['phoneNum']);
    $location = rtrim($_POST['location']);
    $checkOut = "https://pumkingrey.000webhostapp.com/checkout.php";

    $name = ltrim($name);
    $email = ltrim($email);
    $phoneNum = ltrim($phoneNum);
    $location = ltrim($location);
    

    require_once '../includes/dbh.inc.php';
    require_once '../includes/functions.inc.php';


    $sql = "UPDATE users SET usersName = '$name' ,
    usersEmail = '$email' ,
    usersPhoneNum = '$phoneNum' 
    WHERE usersUid = '$uid';";

    $results = $conn->query($sql);

    if(!$results) {
        header("location: ../users.php?error=stmtfailed2");
        exit();
    }
    
    if(strcasecmp($location, $checkOut) == 0){
        header("location: $location");
        exit;
    }
    else{
    header("location: $location");

        exit;
    }
 }
 
 elseif(isset($_POST['updateAccount'])) {
     
    $userid = $_GET['id'];

    $accType = $_POST['accType'];

    require_once '../includes/dbh.inc.php';
    require_once '../includes/functions.inc.php';

    
    $sql = "UPDATE users SET usersAccType = '$accType'
    WHERE usersId = $userid;";

    $results = $conn->query($sql);

    if(!$results) {
        header("location: users.php?error=stmtfailed2");
        exit();
    }
    
    header("location: users.php?error=none");
    exit;

 }
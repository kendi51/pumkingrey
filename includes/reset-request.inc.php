<?php

if(isset($_POST['reset-request-submit'])){
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    
    $url = 'www.pumkingrey.com/resetPassword.php?selector=' . $selector . '&validator=' . bin2hex($token);
    
    $expires = date('U') + 1800;
    
    require 'dbh.inc.php';
    require 'functions.inc.php';
    
    $email = $_POST['email'];
    
    $sql = 'DELETE FROM pwdReset WHERE pwdResetEmail = ?;';
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "THERE WAS AN ERROR...";
        exit;
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
    }
    
    if(uidExistsReset($conn, $email) == FALSE){
        header("location: ../forgotPassword.php?error=noUser");
        exit();
    }
    else {
    $sql = 'INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);';
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "THERE WAS AN ERROR... 2";
        exit;
    }
    else{
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, 'ssss', $email, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    $to = $email;
    $subject = 'Reset Your PumkinGrey Password';
    $setUrl = $url;
    $header = array(
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=UTF-8",
        "From" => "nonreply@pumkingrey.com",
        "Reply-To" => "nonreply@pumkingrey.com"
    );
    $id = $orderId;
    ob_start();    
    include("../email/emailReset.php");
    $message = ob_get_contents();
    ob_get_clean();
    
    if(!mail($to, $subject, $message, $header)){
        header('location: ../forgotPassword.php?error=mail-error');
        exit;
    }
    
    header('location: ../forgotPassword.php?error=success');
    exit;
    }
}
else{
    header('location: /Login');
}
<?php
    
if(isset($_POST['reset-password-submit'])){
    
    $location = $_POST['location'];
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $newPwd = $_POST['newPwd'];
    $confirmPwd = $_POST['confirmPwd'];
    
    if(empty($newPwd) || empty($confirmPwd)){
        header("location: $location");
        exit;
    }
    elseif($newPwd !== $confirmPwd){
        header("location: $location");
        exit;
    }
    
    $currentDate = date("U");
    
    require 'dbh.inc.php';
    
    $sql = 'SELECT * FROM pwdReset WHERE pwdResetSelector = ? && pwdResetExpires >= ?;';
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "THERE WAS AN ERROR...";
        exit;
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);
    }
    
    $results = mysqli_stmt_get_result($stmt);
    if(!$row = mysqli_fetch_assoc($results)){
        echo "You need to re-send your reset password";
        exit;
    }
    else{
        $tokenBin = hex2bin($validator);
        
        $tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);
        
        if($tokenCheck === false){
            echo "You need to re-send your reset password";
            exit;
        }
        elseif($tokenCheck === true){
            $tokenEmail = $row['pwdResetEmail'];
            
            $sql = "SELECT * FROM users WHERE usersEmail = ?;";
            $stmt = mysqli_stmt_init($conn);
    
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "THERE WAS AN ERROR...";
                exit;
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                mysqli_stmt_execute($stmt);
            }
            
            $results = mysqli_stmt_get_result($stmt);
            if(!$row = mysqli_fetch_assoc($results)){
                echo "there was an erroR";
                exit;
            }
            else{
                $sql = "UPDATE users SET usersPwd = ? WHERE usersEmail = ?;";
                $stmt = mysqli_stmt_init($conn);
    
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "THERE WAS AN ERROR... 2";
                    exit;
                }
                else{
                    $hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    
                    $sql = 'DELETE FROM pwdReset WHERE pwdResetEmail = ?;';
                    $stmt = mysqli_stmt_init($conn);
                    
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "THERE WAS AN ERROR...";
                        exit;
                    }
                    else{
                        mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                        mysqli_stmt_execute($stmt);
                        header('location: /Login?error=updated');
                    }
                }
            }
        }
    }
}
else{
    header('location: /Login');
    exit;
}

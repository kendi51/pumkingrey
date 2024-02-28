<?php

if(isset($_POST["submit"])){
    
     function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6Lfz0RMkAAAAAOf3dju151CnmPHBfe-fWC3vN-3Z',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }
    
    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        header('location: ../signup.php?error=notchecked');
        exit;
    }
    // } else {
    //     // If CAPTCHA is successfully completed...

    //     // Paste mail function or whatever else you want to happen here!
    //     echo '<br><p>CAPTCHA was completed successfully!</p><br>';
    // }
    
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== FALSE){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($username) !== FALSE){
        header("location: ../signup.php?error=invalidUid");
        exit();
    }
    if(invalidEmail($email) !== FALSE){
        header("location: ../signup.php?error=invalidEmail");
        exit();
    }
    if(pwdMatch($pwd, $pwdRepeat) !== FALSE){
        header("location: ../signup.php?error=passworddontmatch");
        exit();
    }
    if(pwdLength($pwd) !== false){
        header("location: ../signup.php?error=passwordshort");
        exit();
    }
    if(uidExists($conn, $username,$email) !== FALSE){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn,$name, $email, $username, $pwd);
}
else{
    header("location: /Signup");
    exit();
}
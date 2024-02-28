<?php
// Tell PayFast that this page is reachable by triggering a header 200
header( 'HTTP/1.0 200 OK' );
flush();

define( 'SANDBOX_MODE', true );
$pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
// Posted variables from ITN
$pfData = $_POST;

// Strip any slashes in data
foreach( $pfData as $key => $val ) {
    $pfData[$key] = stripslashes( $val );
}

// Convert posted variables to a string
foreach( $pfData as $key => $val ) {
    if( $key !== 'signature' ) {
        $pfParamString .= $key .'='. urlencode( $val ) .'&';
    } else {
        break;
    }
}

$pfParamString = substr( $pfParamString, 0, -1 );


include_once 'php/createDb.php';
include_once 'php/components.php';
include_once 'includes/functions.inc.php';
include_once 'includes/dbh.inc.php';

$serverName = "localhost";
$dBUserName = "u843931047_pumkingrey";
$dBPassword = "G2O9+euM^c;";
$dBName = "u843931047_pumpkin_users";

$conn = mysqli_connect($serverName,$dBUserName,$dBPassword,$dBName);


// GETTING DATA FROM PUMKINORDERDETAILS
$orderId = $pfData['m_payment_id'];
$email = $pfData['email_address'];
$pfPassphrase = 'NkoSiYomZi20May7519'; //'TestpUmKintEst';

$sql = "SELECT * FROM pumkinorderdetails WHERE id = $orderId;";
			
	$results = mysqli_query($conn, $sql);
	$resultsCheck = mysqli_num_rows($results);
	while($row = mysqli_fetch_assoc($results)){
	    if($row['id'] == $orderId){
			$totalPrice = $row['orderTotalPrice'];
	    }
	}


function pfValidSignature( $pfData, $pfParamString, $pfPassphrase) {
    // Calculate security signature
    if($pfPassphrase === null) {
        $tempParamString = $pfParamString;
    } else {
        $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
    }

    $signature = md5( $tempParamString );
    return ( $pfData['signature'] === $signature );
}


function pfValidIP() {
    // Variable initialization
    $validHosts = array(
        'www.payfast.co.za',
        'sandbox.payfast.co.za',
        'w1w.payfast.co.za',
        'w2w.payfast.co.za',
        );

    $validIps = [];

    foreach( $validHosts as $pfHostname ) {
        $ips = gethostbynamel( $pfHostname );

        if( $ips !== false )
            $validIps = array_merge( $validIps, $ips );
    }

    // Remove duplicates
    $validIps = array_unique( $validIps );
    $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
    if( in_array( $referrerIp, $validIps, true ) ) {
        return true;
    }
    return false;
}


function pfValidPaymentData( $cartTotal, $pfData ) {
    return !(abs((float)$cartTotal - (float)$pfData['amount_gross']) > 0.01);
}


function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ) {
    // Use cURL (if available)
    if( in_array( 'curl', get_loaded_extensions(), true ) ) {
        // Variable initialization
        $url = 'https://'. $pfHost .'/eng/query/validate';

        // Create default cURL object
        $ch = curl_init();
    
        // Set cURL options - Use curl_setopt for greater PHP compatibility
        // Base settings
        curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
        curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
        
        // Standard settings
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
        if( !empty( $pfProxy ) )
            curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
    
        // Execute cURL
        $response = curl_exec( $ch );
        curl_close( $ch );
        if ($response === 'VALID') {
            return true;
        }
    }
    return false;
}

// myFile = fopen('notify.txt', 'wb') or die();

$check1 = pfValidSignature($pfData, $pfParamString, $pfPassphrase);
$check2 = pfValidIP();
$check3 = pfValidPaymentData($totalPrice, $pfData);
$check4 = pfValidServerConfirmation($pfParamString, $pfHost);

$authCode = $pfData['signature'];
$status = $pfData['payment_status'];
   
if($check1 && $check2 && $check3 && $check4) {
    // All checks have passed, the payment is successful
    $sql = "UPDATE pumkinorderdetails SET paymentSuccess = '$status',
    transAuthKey = '$authCode',
    check1 = '$check1',
    check2 = '$check2',
    check3 = '$check3',
    check4 = '$check4'
    WHERE id = $orderId;";
                
    $results = $conn->query($sql);

    if(!$results) {
        header("location: ../orders.php?error=stmtfailed2");
        exit();
    }
    $to = $email;
    $subject = "Thank you for your purchase: PumkinGrey";
    
    $header = array(
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=UTF-8",
        "From" => "nonreply@pumkingrey.com",
        "Reply-To" => "olwethu@pumkingrey.com"
    );
    $id = $orderId;
    ob_start();    
    include("email/email.php");
    $message = ob_get_contents();
    ob_get_clean();
    
    $send = mail($to, $subject, $message, $header);
    
} else {
    // Some checks have failed, check payment manually and log for investigation
    $sql = "UPDATE pumkinorderdetails SET paymentSuccess = '$status',
    transAuthKey = '$authCode',
    check1 = '$check1',
    check2 = '$check2',
    check3 = '$check3',
    check4 = '$check4'
    WHERE id = $orderId;";

    $results = $conn->query($sql);
} 
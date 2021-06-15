<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

if ( $text == "" ) {

	 // This is the first request. Note how we start the response with CON
	 $response  = "CON What would you want to check \n";
	 $response .= "1. My Account \n";
	 $response .= "2. My phone number";

}

else if ( $text == "1" ) {
  // Business logic for first level response
  $response = "CON Choose account information you want to view \n";
  $response .= "1. Account number \n";
  $response .= "2. Account balance";
  
 }
 
 else if($text == "2") {
  // This is a terminal request. Note how we start the response with END
  $response = "END Your phone number is $phoneNumber";
 }

 
 else if($text == "1*1") {
 
  // This is a second level response where the user selected 1 in the first instance
  $accountNumber  = "ACC1001";
  // This is a terminal request. Note how we start the response with END
  $response = "END Your account number is $accountNumber";
 }
	
 else if ( $text == "1*2" ) {
  
	// This is a second level response where the user selected 1 in the first instance
    $response = "END Your account number is NGN 10,000";
	// SMS New Balance
	$code = '20880';//use a senderId mapped to your account
	//you can call a db for user number and data
	$recipients = $phoneNumber;
	$message    = "Your new balance is ".$balance.". Thank you.";
	$gateway    = new AfricasTalkingGateway($username, $apikey);
	try { $results = $gateway->sendMessage($recipients, $message, $code); }
	catch ( AfricasTalkingGatewayException $e ) {echo "Encountered an error while sending: ".$e->getMessage(); }

	 
	 // This is a terminal request. Note how we start the response with END
	 $response = "END Your balance is $balance";

}

// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;

// DONE!!!
?>
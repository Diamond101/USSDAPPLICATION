<?php
// Read the variables sent via POST from our API
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];

if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "CON What  \n";
    $response .= "1. My A \n";
    $response .= "2. My p";

} else if ($text == "1") {
    // Business logic for first level response
    $response = "CON Choose a view \n";
    $response .= "1. Acc \n";

} else if ($text == "2") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
    $response = "END Your number is ".$phoneNumber;

} else if($text == "1*1") { 
    // This is a second level response where the user selected 1 in the first instance
    $accountNumber  = "ACC1001";

    // This is a terminal request. Note how we start the response with END
    $response = "END Your acc is ".$accountNumber;

}
// Echo the response back to the API
header('Content-type: text/plain');
echo $response;

?>
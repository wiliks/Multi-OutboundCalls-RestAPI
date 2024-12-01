<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;

$sid = getenv('TWILIO_ACCOUNT_SID'); 
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);


// The phone number or client identifier to use as the caller id.
$from = "+XXXXXXXXXX";
// Read Phone Number from text file
// Specify the file path
$file = 'numbers.txt';

// Check if the file exists and is readable
if (is_readable($file)) {
    // Open the file for reading
    $lines = [];
    $fileHandle = fopen($file, 'r');
    
    // Read each line and add it to the array
    while (($line = fgets($fileHandle)) !== false) {
        $lines[] = rtrim($line);  // Remove the newline character
    }

    } else {
    echo "File does not exist or is not readable.";
}

// Make a phone call
$length = count($lines); //count number of phone numbers in file
for ($i=0;$i<=$length;$i++){
    $call = $client->calls->create(
        $line[i],
        $from,
        ["url" => "https://twilio.com"]
    );
    print("Call made successfully with sid: ".$call->sid."\n\n");
}


// Get some call list to see details of calls successfully placed
$callsList = $client->calls->read([],null,2);
foreach ($callsList as $call) {
    print("Call {$call->sid}: {$call->duration} seconds\n");
}
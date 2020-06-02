<?php
require 'functions.php';
$conn = OpenCon();

$server_key = "SB-Mid-server-O1dyX36O_aHIrrJePcEs-NLG";

$is_production = false;

$api_url = $is_production ? 
  'https://app.midtrans.com/snap/v1/transactions' : 
  'https://app.sandbox.midtrans.com/snap/v1/transactions';

// if( !strpos($_SERVER['REQUEST_URI'], '/charge') ) {
//   http_response_code(404); 
//   echo "wrong path, make sure it's `/charge`"; exit();
// }

if( $_SERVER['REQUEST_METHOD'] !== 'POST'){
  http_response_code(404);
  
  // //buat test aja jdi taronya disini
  // $inputBody = file_get_contents('php://input'); 
  // $array = json_decode($inputBody, true);
  // $grossAmount = $array["transaction_details"]["gross_amount"];
  
  // echo 'returned id in index php: ' . storeToDatabase($grossAmount); 
  
  echo "Page not found or wrong HTTP request method is used"; exit();
}

//costumise ini
$inputBody = file_get_contents('php://input'); 
$array = json_decode($inputBody, true);
$grossAmount = $array["transaction_details"]["gross_amount"];
$returnedId = storeToDatabase($grossAmount);

$request_body = "{
  \"transaction_details\": {
     \"order_id\" : \"ORDER-$returnedId\",
    \"gross_amount\": $grossAmount
  } 
}";


// 	'transaction_details': {
// 		'order_id': 'ORDER-' . storeToDatabase($grossAmount),
// 		'gross_amount': $grossAmount
// 	} hans gw udah balikk


header('Content-Type: application/json');
// $charge_result = chargeAPI($api_url, $server_key, $request_body);
echo chargeAPI($api_url, $server_key, $request_body);

http_response_code($charge_result['http_code']);

echo $charge_result['body'];


function chargeAPI($api_url, $server_key, $request_body){
  return $request_body;
  // $ch = curl_init();
  // $curl_options = array(
  //   CURLOPT_URL => $api_url,
  //   CURLOPT_RETURNTRANSFER => 1,
  //   CURLOPT_POST => 1,
  //   CURLOPT_HEADER => 0,


  //   CURLOPT_HTTPHEADER => array(
  //     'Content-Type: application/json',
  //     'Accept: application/json',
  //     'Authorization: Basic ' . base64_encode($server_key . ':')
  //   ),
  //   CURLOPT_POSTFIELDS => $request_body
  // );
  // curl_setopt_array($ch, $curl_options);
  // $result = array(
  //   'body' => curl_exec($ch),
  //   'http_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
  // );
  // return $result;
}
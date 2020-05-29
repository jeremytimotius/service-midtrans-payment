<?php

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
  $inputBody = file_get_contents('php://input'); 

  // hasil input body 
  //"transaction_details": {
  //   "gross_amount": 10000
  // }

  $obj = json_decode($inputBody);
  echo "hei";
  echo $obj;
  echo "hei1";
  echo $obj->{'transaction_details'};
  echo "hei2";

  //harusnya balikanny {
  //   "gross_amount": 10000
  // }
  
  echo "Page not found or wrong HTTP request method is used"; exit();
}

$request_body = file_get_contents('php://input'); 
header('Content-Type: application/json');
echo 'php://input';
$charge_result = chargeAPI($api_url, $server_key, $request_body);

http_response_code($charge_result['http_code']);

echo $charge_result['body'];


function chargeAPI($api_url, $server_key, $request_body){
  $ch = curl_init();
  $curl_options = array(
    CURLOPT_URL => $api_url,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POST => 1,
    CURLOPT_HEADER => 0,


    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'Accept: application/json',
      'Authorization: Basic ' . base64_encode($server_key . ':')
    ),
    CURLOPT_POSTFIELDS => $request_body
  );
  curl_setopt_array($ch, $curl_options);
  $result = array(
    'body' => curl_exec($ch),
    'http_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
  );
  return $result;
}
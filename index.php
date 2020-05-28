<?php
    $SERVER_KEY = 'SB-Mid-server-O1dyX36O_aHIrrJePcEs-NLG';
    $API_URL = 'https://app.sandbox.midtrans.com/snap/v1/transactions';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(404);
        exit();
    }

    $REQUEST_BODY = file_get_contents('php://input'); 
    header('Content-Type: application/json');

    $chargeResult = chargeAPI($API_URL, $SERVER_KEY, $REQUEST_BODY);
    http_response_code($chargeResult['http_code']);

    function chargeAPI($API_URL, $SERVER_KEY, $REQUEST_BODY){
        $ch = curl_init();
        $curl_options = array(
            CURLOPT_URL => $API_URL,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode($SERVER_KEY . ':')
            ),
            CURLOPT_POSTFIELDS => $REQUEST_BODY
        );

        curl_setopt_array($ch, $curl_options);

        $result = array(
            'body' => curl_exec($ch),
            'http_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
        );

        return $result;
    }
?>
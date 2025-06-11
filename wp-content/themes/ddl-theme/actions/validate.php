<?php

$recaptcha_secret   =   "6LeoAgorAAAAAHoO4XysLc64x66qJUWKx2VML3ZI";  //testing key

$error_output = '';
$success_output = '';

$recaptcha_response = $_POST['recaptcha_response'];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
  CURLOPT_POST => 1,
  CURLOPT_POSTFIELDS => array(
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response
  )
));

$response = curl_exec($curl);
curl_close($curl);

$response_data = json_decode($response, true);

if (isset($response_data['success']) && $response_data['success'] === true) {
  $success_output = "Your message was sent successfully";
} else {
  $error_output = "You're a robot";
}

$output = array(
  'error'     =>  $error_output,
  'success'   =>  $success_output
);

echo json_encode($output);
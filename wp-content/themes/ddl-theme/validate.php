<?php

$error_output = '';
$success_output = '';

$recaptcha_secret = '6LeeB2wqAAAAAJ5JjLpAmOVrUsRWt_-1hbsna5Pw';
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

if(strpos($response, '"success": true') !== FALSE) {

  $success_output = "Your message sent successfully";

} else {

  $error_output = "Your a robot";

} 

$output = array(
  'error'     =>  $error_output,
  'success'   =>  $success_output
);

echo json_encode($output);
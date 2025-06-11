<?php 

require_once __DIR__ . '../../variables/global.php';

$error_output = '';
$success_output = '';

$status = 'subscribed'; // 'subscribe' to subscribe a user. 'unsubscribe' or 'pending' if it is required to send a confirmation email

$first = $_POST['FNAME'];
$last = $_POST['LNAME'];
$email = $_POST['MERGE0'];

// Mailchimp connection

$connection = curl_init();
curl_setopt( 
	$connection, 
	CURLOPT_URL, 
	'https://' . substr( $mailchimp_api_key, strpos( $mailchimp_api_key, '-' ) + 1 ) . '.api.mailchimp.com/3.0/lists/' . $mailchimp_list_id . '/members/' . md5( strtolower( $email ) )
);
curl_setopt( $connection, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Authorization: Basic '. base64_encode( 'user:'.$mailchimp_api_key ) ) );
curl_setopt( $connection, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $connection, CURLOPT_CUSTOMREQUEST, 'PUT' );
curl_setopt( $connection, CURLOPT_POST, true );
curl_setopt( $connection, CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( 
	$connection, 
	CURLOPT_POSTFIELDS, 
	json_encode( array(
		'apikey'        => $mailchimp_api_key,
		'email_address' => $email,
		'status'        => $status,
    'merge_fields'  => [
      'FNAME'     => $first,
      'LNAME'     => $last
    ]
	) )
);

$result = curl_exec( $connection );

curl_close( $connection );

$result = json_decode( $result );

if( 400 === $result->status ){

	foreach( $result->errors as $error ) {

    $error_output = "'Error: ' . $error->message ";

	}

} elseif( 'subscribed' === $result->status ){

  $success_output = "' . $result->full_name . ' successfully subscribed";

}

$output = array(
  'error'     =>  $error_output,
  'success'   =>  $success_output
);

echo json_encode($output);
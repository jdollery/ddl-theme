<?php 

// remember to need API key and list id on go live

$error_output = '';
$success_output = '';

$api_key = 'a87429b04b23ed7601949b45d5c6200b-us2'; //https://us2.admin.mailchimp.com/account/api/ 
$status = 'subscribed'; // 'subscribe' to subscribe a user. 'unsubscribe' or 'pending' if it is required to send a confirmation email
$list_id = '358eff84d6'; // https://us2.admin.mailchimp.com/lists/settings/defaults?id=1789974

$first = $_POST['FNAME'];
$last = $_POST['LNAME'];
$email = $_POST['MERGE0'];
$tag = $_POST['TAG'];

$connection = curl_init();
curl_setopt( $connection, CURLOPT_URL, 'https://us2.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5( strtolower( $email ) ));
curl_setopt( $connection, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Authorization: Basic '. base64_encode( 'user:'. $api_key ) ) );
curl_setopt( $connection, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $connection, CURLOPT_CUSTOMREQUEST, 'PUT' );
curl_setopt( $connection, CURLOPT_POST, true );
curl_setopt( $connection, CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( 
	$connection, 
	CURLOPT_POSTFIELDS, 
	json_encode( array(
		'apikey'        => $api_key,
		'email_address' => $email,
		'status'        => $status,
    "tags"          => [$tag],
    'merge_fields'  => [
      'FNAME'     => $first,
      'LNAME'     => $last
    ]
	) )
);

$result = curl_exec( $connection );

curl_close( $connection );

$result = json_decode( $result );

$result_http_status = curl_getinfo($trigger, CURLINFO_HTTP_CODE);

if ($result_http_status === 400) {

	foreach( $result->errors as $error ) {

    $error_output = "Error: " . $error->message;

	}

} elseif( 'subscribed' === $result->status ){

  if( $tag == "Whitening Offer" || $tag == "Voucher Offer") {

    $trigger = curl_init();

    if( $tag == "Whitening Offer"){
      curl_setopt( $trigger, CURLOPT_URL, 'https://us2.api.mailchimp.com/3.0/customer-journeys/journeys/12/steps/33/actions/trigger' );
    } elseif( $tag == "Voucher Offer"){
      curl_setopt( $trigger, CURLOPT_URL, 'https://us2.api.mailchimp.com/3.0/customer-journeys/journeys/13/steps/35/actions/trigger' );
    }

    curl_setopt( $trigger, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Authorization: Basic '. base64_encode( 'user:'. $api_key ) ) );
    curl_setopt( $trigger, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $trigger, CURLOPT_CUSTOMREQUEST, 'POST' );
    curl_setopt( $trigger, CURLOPT_POST, true );
    curl_setopt( $trigger, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( 
      $trigger, 
      CURLOPT_POSTFIELDS, 
      json_encode( array(
        'apikey'        => $api_key,
        'email_address' => $email,
      ) )
    );

    $response = curl_exec( $trigger );

    $response_http_status = curl_getinfo($trigger, CURLINFO_HTTP_CODE); 

    curl_close( $trigger );

    $response_data = json_decode($response);

    if ($response_http_status === 400) {

      foreach ($response_data->errors as $error) {
        $error_output = "Error: " . $error->message;
      }

    } else {
      $success_output = 'Successfully subscribed';
    }

  } else {

    $success_output = 'Successfully subscribed';

  }

}

$output = array(
  'error'   => $error_output,
  'success' => $success_output
);

echo json_encode($output);
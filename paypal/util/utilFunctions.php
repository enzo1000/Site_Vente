<?php

function initCurl() {
	//set the cURL parameters
	$ch = curl_init(PP_ENDPOINT);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_SSLVERSION , 'CURL_SSLVERSION_TLSv1_2');
	curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, true);

	return $ch;
}


function curlCall($curlPostData) {
	$resp = false;

	// init curl
	$ch = initCurl();
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlPostData));
	//getting response from server
	$response = curl_exec($ch);

	if(curl_error($ch))
	{
		error_log('Curl error: ' . curl_error($ch));
		$response = curl_error($ch);
	}

	$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch); // close cURL handler

	// some kind of an error happened
	if (empty($response)) {
		return $resp;
	}

	parse_str( $response, $resp );

	return $resp;
}

function callCurlMulti($curlPostDataArray) {
	$chArray = array();
	$buttonDetailsArray = array();

	//create the multiple cURL handle
	$mh = curl_multi_init();

	foreach ($curlPostDataArray as $key=>$curlPostData) {
		// init curl
		$ch = initCurl();
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curlPostData));
		array_push($chArray, $ch);
		curl_multi_add_handle($mh, $chArray[$key]);
	}

	// execute all queries simultaneously, and continue when all are complete
	$running = null;
	do {
	  curl_multi_exec($mh, $running);
	} while ($running);

	//close the handles
	foreach ($chArray as $ch) {
		$buttonDetail;
		parse_str( curl_multi_getcontent($ch), $buttonDetail);
		array_push($buttonDetailsArray, $buttonDetail);
		curl_multi_remove_handle($mh, $ch);
	}
	curl_multi_close($mh);

	return $buttonDetailsArray;
}

/**
 * Prevents Cross-Site Scripting Forgery
 * @return boolean
 */
function verify_nonce() {
	if( isset($_GET['csrf']) && $_GET['csrf'] == $_SESSION['csrf'] ) {
		return true;
	}
	if( isset($_POST['csrf']) && $_POST['csrf'] == $_SESSION['csrf'] ) {
		return true;
	}
	return false;
}

?>
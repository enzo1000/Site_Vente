<?php
/********************************************
	Module contains calls to PayPal APIs
	********************************************/
	require_once( __DIR__. '/../paypalConfig.php');
	require_once('utilFunctions.php');
/*
	* Purpose: 	Gets the list of hosted buttons from PayPal
	* Inputs:
	* Returns:  curlResponse
	*
	*/
function getButtons($merchantId = NULL, $startDate = '1990-01-01T00:00:00Z', $endDate = NULL) {
	$req = [
		'USER' => PARTNER_API_USER,
		'PWD' => PARTNER_API_PWD,
		'SIGNATURE' => PARTNER_API_SIG,
		'METHOD' => 'BMButtonSearch',
		'VERSION' => '204.0',
		'STARTDATE' => $startDate
	  ];

	  if($endDate !== NULL) {
		  $req['ENDDATE'] = $endDate;
	  }
	
	  if($merchantId !== NULL) {
		$req['SUBJECT'] = $merchantId;
	  }

	$curlResponse = curlCall($req);

	return $curlResponse;
}


function getButtonDetails($buttonId, $merchantId = NULL) {
	$req = [
		'USER' => PARTNER_API_USER,
		'PWD' => PARTNER_API_PWD,
		'SIGNATURE' => PARTNER_API_SIG,
		'METHOD' => 'BMGetButtonDetails',
		'VERSION' => '204.0',
		'HOSTEDBUTTONID' => $buttonId
	];

	if($merchantId !== NULL) {
		$req['SUBJECT'] = $merchantId;
	}
	$curlResponse = curlCall($req);
	
	return $curlResponse;
}

function getMultiButtonDetails($buttonIds, $merchantId = NULL) {
	$reqs = array();
	
	foreach ($buttonIds as $buttonId) {
		$req = [
			'USER' => PARTNER_API_USER,
			'PWD' => PARTNER_API_PWD,
			'SIGNATURE' => PARTNER_API_SIG,
			'METHOD' => 'BMGetButtonDetails',
			'VERSION' => '204.0',
			'HOSTEDBUTTONID' => $buttonId
		];

		if($merchantId !== NULL) {
			$req['SUBJECT'] = $merchantId;
		}
		array_push($reqs, $req);
	}

	return callCurlMulti($reqs);
}

function parseButtonVars($buttonDetails) {
	$index = 0;
	$buttonVarArray = array();
	while(array_key_exists('L_BUTTONVAR' . $index, $buttonDetails)) {
		parse_str(trim(urldecode($buttonDetails['L_BUTTONVAR' . $index]), '"'), $buttonVar);
		$buttonVar = [
			'name' => key($buttonVar),
			'value' => current($buttonVar)
		];
		array_push($buttonVarArray, $buttonVar);
		$index += 1;
	}
	return $buttonVarArray;
}

function parseButtonOptions($buttonDetails) {
	$index = 0;
	$buttonOptionsArray = array();
	while(array_key_exists('OPTION' . $index . 'NAME', $buttonDetails)) {
		$buttonOption = [
			'name' => trim($buttonDetails['OPTION' . $index . 'NAME'], '"')
		];

		$subindex = 0;		
		$buttonOption['items'] = array();
		while(array_key_exists('L_OPTION' . $index . 'SELECT' . $subindex, $buttonDetails)) {
			$item = [
				'name' => trim($buttonDetails['L_OPTION' . $index . 'SELECT' . $subindex], '"')
			];
			if(array_key_exists('L_OPTION' . $index . 'PRICE' . $subindex, $buttonDetails)) {
				$item['price'] =  trim($buttonDetails['L_OPTION' . $index . 'PRICE' . $subindex], '"');	
			} 
			array_push($buttonOption['items'], $item); 
			$subindex += 1;	
		}
		array_push($buttonOptionsArray, $buttonOption);
		$index += 1;
	}
	return $buttonOptionsArray;
}

?>
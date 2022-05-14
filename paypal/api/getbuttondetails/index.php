<?php
    header('Content-Type: application/json;charset=utf-8');
    require_once( __DIR__. '/../sessionHelper.php');
    require_once( __DIR__. '/../../paypalConfig.php');
    require_once( __DIR__. '/../../util/paypalFunctions.php');
    
    $buttonDetails = getButtonDetails($_GET['buttonId'], @$_GET['merchantIdInPayPal']?: NULL);

    $buttonDetailsResponse = [
        'buttonId' => $buttonDetails['HOSTEDBUTTONID'],
        'type' => $buttonDetails['BUTTONTYPE'],
        'subtype' =>  @$buttonDetail['BUTTONSUBTYPE']?: NULL,
        'htmlVars' => parseButtonVars($buttonDetails),
        'options' => parseButtonOptions($buttonDetails)
    ];

    echo json_encode($buttonDetailsResponse);
?>
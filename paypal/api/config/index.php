<?php
    header('Content-Type: application/json;charset=utf-8');
    require_once( __DIR__. '/../sessionHelper.php');
    require_once( __DIR__. '/../../paypalConfig.php');
    
    $configData = [
        "DEV_LANG" => "PHP",
        "PP_BASEURL" => PP_BASEURL,
        "PARTNER_ID" => PARTNER_ID
    ];

    echo json_encode($configData);
?>

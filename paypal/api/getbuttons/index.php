<?php
    header('Content-Type: application/json;charset=utf-8');
    require_once( __DIR__. '/../sessionHelper.php');
    require_once( __DIR__. '/../../paypalConfig.php');
    require_once( __DIR__. '/../../util/paypalFunctions.php');
    
    $buttons = getButtons(@$_GET['merchantIdInPayPal']?: NULL);

    $buttonArray = array();

    //format button response to an array of buttons
    $bn = 0;
    while(array_key_exists('L_HOSTEDBUTTONID' . $bn, $buttons )) {
        $button = [
            "id" => $buttons['L_HOSTEDBUTTONID' . $bn],
            "type" => $buttons['L_BUTTONTYPE' . $bn],
            "itemName" =>  @$buttons['L_ITEMNAME' . $bn]?:'',
            "modified" =>   $buttons['L_MODIFYDATE' . $bn]
        ];
        array_push($buttonArray, $button);
        $bn += 1;
    }    

    echo json_encode($buttonArray);
?>
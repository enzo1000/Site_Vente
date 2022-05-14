<?php
    /*
        * Config for PayPal specific values
    */
    //Whether Sandbox environment is being used, Keep it true for testing
    define("SANDBOX_FLAG", true);
    define("WEBHOOK_CONFIGURED", false);

    //PayPal API endpoints
    define("PP_BASEURL", ((SANDBOX_FLAG)? "sandbox." : "") . "paypal.com");
    define("PP_ENDPOINT", "https://api-3t." . PP_BASEURL . "/nvp");

    //Partner credentials - Need to fill in with your credentials
    define("PARTNER_ID","FJJRDLNJCCCYE");
    define("PARTNER_API_USER", "");
    define("PARTNER_API_PWD", "");
    define("PARTNER_API_SIG", "");
    define("PARTNER_BN_CODE", "PseudoShop_MP");

    //Return URL
    $protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
    if($_SESSION['demo-ui'] == true) {
        define("RETURN_URL", $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?step=2&csrf=" . $_SESSION['csrf']);
    }
    else {
        define("RETURN_URL", $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?step=2" );
    }
    
    define("ONBOARDING_URL","https://www.". PP_BASEURL
        ."/webapps/merchantboarding/webflow/externalpartnerflow?partnerId=". PARTNER_ID 
        ."&productIntentId=addipmt&integrationType=T&permissionNeeded=BUTTON_MANAGER&showPermissions=true" 
        ."&returnToPartnerUrl=" . urlencode(RETURN_URL));


   
?>

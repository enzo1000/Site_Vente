<?php
    if (session_id() == "") {
        session_start();
        $_SESSION['demo-ui'] = true;
        $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
    }	
?>
<?php

//67 mms ovg équipe, la sessino est lancée.
if(!isset($_SESSION))
    session_start();

require_once "./lib/File.php";
include_once File::build_path(array("model", "Model.php"));

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once File::build_path(array("controller", "routeur.php"));
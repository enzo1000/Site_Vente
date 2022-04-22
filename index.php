<?php
require_once "./lib/File.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once File::build_path(array("controller", "routeur.php"));

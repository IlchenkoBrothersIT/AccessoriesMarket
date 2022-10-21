<?php

session_start();

require_once "modules/db-settings.php";
require_once "modules/main-scripts.php";

block_product($connection);

$_SESSION["phone-number"] = $_POST['consumer-telephone-for-block-db'];



exit();
?>
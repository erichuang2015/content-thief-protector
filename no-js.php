<?php
session_start();
$_SESSION["no_js"] = "true";
$referrer = $_GET['referrer']; 
//echo $referrer;
header("Location: ".$referrer);
?>
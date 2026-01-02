<?php
include_once('../initialize.inc.php');

$capp     = $_SESSION['captcha']['code'];
$gelencap = $_GET['field'];

if ($capp == $gelencap) { echo "1"; exit;}  else  { echo "2"; exit;}

?>